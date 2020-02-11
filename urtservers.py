# -*-coding:Utf-8 -*

# UrTServers (PYTHON 3)
# Copyright (C) 2018-2020 PtitBigorneau
#
# PtitBigorneau - www.ptitbigorneau.fr
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
#
__author__  = 'PtitBigorneau'
__version__ = '3'
#########################################################################################################
import sys

if sys.version_info < (3,):
    raise SystemExit("Sorry, requires Python 3, not Python 2.")
#########################################################################################################
import socket
import pymysql
import _thread
import datetime, time, calendar
from time import gmtime, strftime
from datetime import datetime
import geoip2.database
import configparser
from q3masterserver import Q3masterServer
#########################################################################################################
# ConfigParser
#########################################################################################################
config = configparser.ConfigParser()
config.read("config/config.ini")
dbhost = config.get('database', 'host')
dbuser = config.get('database', 'user')
dbpassword = config.get('database', 'password')
dbname = config.get('database', 'name')

geoip2_path = config.get('geoip2', 'path')
#########################################################################################################
# Date
#########################################################################################################
def cdate():

    time_epoch = time.time()
    time_struct = time.gmtime(time_epoch)
    date = time.strftime('%Y-%m-%d %H:%M:%S', time_struct)
    mysql_time_struct = time.strptime(date, '%Y-%m-%d %H:%M:%S')
    cdate = calendar.timegm( mysql_time_struct)

    return cdate
#########################################################################################################
# Clean Name
#########################################################################################################
def cleanname(data):

    data = data.replace('     ',' ')
    data = data.replace('    ',' ')
    data = data.replace('   ',' ')
    data = data.replace('  ',' ')
    data = data.replace('\x07','')

    return data
#########################################################################################################
# Clean Color Name
#########################################################################################################
def cleancolorname(data):

    data = data.replace('^1','')
    data = data.replace('^2','')
    data = data.replace('^3','')
    data = data.replace('^4','')
    data = data.replace('^5','')
    data = data.replace('^6','')
    data = data.replace('^7','')
    data = data.replace('^8','')
    data = data.replace('^9','')
    data = data.replace('^0','')
    data = data.replace('     ',' ')
    data = data.replace('    ',' ')
    data = data.replace('   ',' ')
    data = data.replace('  ',' ')
    data = data.replace('\x07','')

    return data
#########################################################################################################
# List servers
#########################################################################################################
def listserv(opt):

    servers = []
    port = 27900
    listmaster1 = intmaster("master.urbanterror.info", port, opt)
    listmaster2 = intmaster("master2.urbanterror.info", port, opt)

    servers = listmaster1

    for server in listmaster2:
        if server not in listmaster1:
            servers.append(server)

    return servers

def intmaster(host, port, opt):

    m = Q3masterServer(host, port, opt)
    listservers = m.ListServers()
    return listservers
#########################################################################################################
#  Test Server in DataBase
#########################################################################################################
def testserverindb(adresse):
    rows = None
    
    try:
        dbconnect = pymysql.connect(dbhost, dbuser, dbpassword, dbname)
        cursor = dbconnect.cursor()
        cursor.execute('SELECT * FROM servers WHERE adresse = "%s"'%(adresse))
        rows = cursor.fetchall()
        cursor.close()

    except pymysql.Error as error:
        print("Mysql: ", error)
    finally:
        if (dbconnect):
            dbconnect.close()
    if rows:
        return True
    else:
        return False
#########################################################################################################
#  Update DataBase
#########################################################################################################
def updatedb(data, opt):

    if opt == 1:
        requete = 'INSERT INTO servers(adresse, name, version, gametype, players, bots, slots, date, pays) VALUES ("%s", "%s", "%s", "%s", %s, %s, %s, %s, "%s")'%data
    if opt == 2:
        requete = 'UPDATE servers SET adresse = "%s", name = "%s", version = "%s", gametype = "%s", players = %s, bots = %s, slots = %s, date = %s, pays = "%s" WHERE adresse = "%s"'%data
    if opt == 3:
        requete = 'DELETE FROM servers WHERE date < %s'%(data - 180)
    try:
        dbconnect = pymysql.connect(dbhost, dbuser, dbpassword, dbname)
        cursor = dbconnect.cursor()
        cursor.execute(requete)
        dbconnect.commit()
        cursor.close()

    except pymysql.Error as error:
        print("Mysql: ", error)
    finally:
        if (dbconnect):
            dbconnect.close()
#########################################################################################################
# Status
#########################################################################################################
def status(adresse, port):

    serveradresse = "%s:%s"%(adresse, port)
    hostname = serveradresse
    gametype = 0
    mapname = None
    modversion = None
    maxclients = 0
    privateclients = 0
    nplayers = 0
    bots = 0
    retries = 1
    timeout = 2
    packet_prefix = bytes([0xff] * 4)
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect((adresse, int(port)))
    s.settimeout(timeout)
    cmd = packet_prefix + b"getstatus\n"
    reponse = None

    while retries:
        s.send(cmd)
        try:
            reponse = s.recv(2048)
            retries = 0
        except:
            reponse = None
            retries -= 1

    s.close()

    if reponse:
        playerlines = None

        reponse = reponse.replace(b"\xff",b"*")

        reponse = reponse.decode()
        index1 = reponse.find('\n')
        infoline = reponse[index1+1:]

        index2 = infoline.find('\n')
        infoline = infoline[:index2]

        playerlines = reponse[index1+index2+1:]

        split = infoline[1:].split('\\')
        vars = dict(zip(split[::2], split[1::2]))

        playerslist = playerlines.split('\n')

        for x in playerslist:
            if not x:
                playerslist.remove(x)

        np = 0
        for x in playerslist:
            if x != '':
                playerdata = x.split('"')
                playerdata2 = playerdata[0].split(" ")
                ping = playerdata2[1]
                np = np + 1

                if ping == "0":
                    bots = bots + 1

        nplayers = np - bots
        try:
            hostname = vars["sv_hostname"]
        except:
            hostname = "unknown"
        try:                   
            gametype = vars["g_gametype"]
        except:
            gametype = 0              
        try:
            mapname = vars["mapname"]
        except:
            mapname = "unknown"
        try:
            modversion = vars["g_modversion"]
        except:
            modversion = "unknown"
        try:
            maxclients = vars["sv_maxclients"]
        except:                   
            maxclients = 0
        try:
            privateclients = vars["sv_privateClients"]
        except:
            privateclients = 0               
        
        if (gametype == '0') or (gametype == '2'):
            gametype='FFA'
        if (gametype == '1'):
            gametype='LMS'
        if (gametype == '3'):
            gametype='TDM'
        if (gametype == '4'):
            gametype='TS'
        if (gametype == '5'):
            gametype='FTL'
        if (gametype == '6'):
            gametype='CandH'
        if (gametype == '7'):
            gametype='CTF'
        if (gametype == '8'):
            gametype='Bomb'
        if (gametype == '9'):
            gametype='Jump'
        if (gametype == '10'):
           gametype='Freeze'
        if (gametype == '11'):
           gametype='GunGame'

        online = 1
        print("%s online"%(serveradresse))
        hostname = cleanname(vars["sv_hostname"])
    
    else:
        online = 0
        print("%s offline"%(serveradresse))
    
    date = cdate()
    ############################################
    # GeoIp
    ############################################
    reader = geoip2.database.Reader(geoip2_path)
    try:
        r = reader.city(adresse)
        pays = r.country.iso_code
    except:
        pays = ""
    ############################################
    if testserverindb("%s"%(serveradresse)):
        if online == 1:
            data = (serveradresse, hostname, modversion, gametype, nplayers, bots, maxclients, date, pays, serveradresse,)
            updatedb(data, 2)
    else:
        if online == 1:
            data = (serveradresse, hostname, modversion, gametype, nplayers, bots, maxclients, date, pays)
            updatedb(data, 1)
    
    updatedb(date, 3)   

#########################################################################################################
# Main
#########################################################################################################
def main():
    listservers = []
    listservers = listserv("full")
    print("---------------------------------------")
    for server in listservers:
        data = server.split(':')
        _thread.start_new_thread(status, (data[0], data[1],))
        time.sleep(0.1)
    listservers = []
    listservers = listserv("empty")
    print("---------------------------------------")
    for server in listservers:
        data = server.split(':')
        _thread.start_new_thread(status, (data[0], data[1],))
        time.sleep(0.1)
#########################################################################################################
if __name__ == '__main__':
    while True:
        print("start")
        main()

