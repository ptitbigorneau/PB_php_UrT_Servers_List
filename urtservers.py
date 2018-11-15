# -*-coding:Utf-8 -*

# UrTServers
# Copyright (C) 2018 PtitBigorneau
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
__version__ = '1.0'

import socket
import pymysql
import thread
import datetime, time, calendar
from time import gmtime, strftime
from datetime import datetime
from q3masterserver import Q3masterServer
import pygeoip
import ConfigParser

config = ConfigParser.ConfigParser()
config.read("config/config.ini")
dbhost = config.get('database', 'host')
dbuser = config.get('database', 'user')
dbpassword = config.get('database', 'password')
dbname = config.get('database', 'name')

geoipdat_path = config.get('geoip', 'path')

def cdate():

    time_epoch = time.time()
    time_struct = time.gmtime(time_epoch)
    date = time.strftime('%Y-%m-%d %H:%M:%S', time_struct)
    mysql_time_struct = time.strptime(date, '%Y-%m-%d %H:%M:%S')
    cdate = calendar.timegm( mysql_time_struct)

    return cdate

def status(adresse, port):

    retries = 5
    timeout = 20
    packet_prefix = '\xff' * 4
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    s.connect((adresse, int(port)))
    s.settimeout(timeout)
    cmd = packet_prefix+"getstatus\n"
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

        index1 = reponse.find('\n')
        infoline = reponse[index1+1:]

        index2 = infoline.find('\n')
        infoline = infoline[:index2]

        playerlines = reponse[index1+index2+1:]

        split = infoline[1:].split('\\')
        vars = dict(zip(split[::2], split[1::2]))

        playerslist = playerlines.split('\n')

        bots = 0

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

    else:

        vars = None
        nplayers = 0
        bots = 0

    return vars, nplayers, bots

def supurtcolors(data):

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
    data = data.replace('^','')
    data = data.replace("'",' ')
    data = data.replace('"',' ')
    data = data.replace('     ',' ')
    data = data.replace('    ',' ')
    data = data.replace('   ',' ')
    data = data.replace('  ',' ')
    data = data.replace('<','&lt;')
    data = data.replace('>','&gt;')
    return data

def allservers(opt):

    print "Search all servers"
    listallservers = listserv(opt)
    updateserversoffindb(listallservers)

    for server in listallservers:
        data = server.split(":")
        adresse = data[0]
        port = data[1]
        thread.start_new_thread(updateserversonindb, (server, adresse, port,))
        time.sleep(0.1)

def noemptyservers(opt):

    print "Search no empty servers"
    listnoemptyservers = listserv(opt)
    updateserversonindb(listnoemptyservers)

def updateserversonindb(server, adresse, port):

    conn = pymysql.connect(dbhost, dbuser, dbpassword, dbname)

    data = infoserver(adresse, port)

    sname = data[0]
    sversion = data[1]
    sgametype = data[2]
    sslots = data[5]

    if "//" in sname:
        sname = sname.split("//")[0]

    if "4.1" in sversion:
        sversion = "4.1"

    date = cdate()
    cur = conn.cursor()
    cur.execute("SELECT * FROM servers WHERE adresse = '%s'"%server)

    ipdata = server.split(':')

    gi = pygeoip.GeoIP(geoipdat_path)

    pays =  pays = gi.country_code_by_name(ipdata[0])

    resultat = cur.fetchone()

    if not resultat:

        if sname != "Unknown" and sversion != "Unknown"  and sversion != "4.1":
            print "insert %s"%server
            cur.execute("INSERT INTO servers VALUES ('%s','%s','%s','%s',%s, %s, %s, %s, '%s')"%(server, sname, sversion, sgametype, data[3], data[4], sslots, date, pays))
            conn.commit()

    else:
        print resultat
        name = resultat[1]
        version = resultat[2]
        gametype = resultat[3]
        slots = int(resultat[6])

        if sname == "Unknown":
            sname = name
        if sversion == "Unknown":
            sversion = version
        if sgametype == "???":
            sgametype = gametype
        if sslots == 0:
            sslots = slots

        if sname != "Unknown" and sversion != "Unknown" and sversion != "4.1":
            print "update %s"%server
            cur.execute("UPDATE servers SET name = '%s', version = '%s', gametype = '%s', players = %s, bots = %s, slots = %s, date = %s, pays = '%s' WHERE adresse = '%s'"%(sname, sversion, sgametype, data[3], data[4], sslots, date, pays, server))
            conn.commit()

    cur.close()
    conn.close()

def updateserversoffindb(listservers):

    conn = pymysql.connect('localhost','master','motdepasse', 'master')

    with conn:

        cur = conn.cursor()
        cur.execute("SELECT * FROM servers")

        resultat = cur.fetchall()

        if not resultat:
            print "la db est vide"

        for x in resultat:
            if x[0] not in listservers:
                print "db delete server: %s"%x[0]
                cur.execute("DELETE FROM servers WHERE adresse='%s'"%x[0])

    cur.close()
    conn.close()

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

def infoserver(adresse, port):

    print "infoserver %s:%s"%(adresse, port)

    data = status(adresse, port)

    vars = data[0]
    players = data[1]
    bots = data[2]

    if vars == None:

        servername = "Unknown"
        version = "Unknown"
        players = 0
        bots = 0
        slots = 0
        gametype = "???"

    else:

        if 'sv_hostname' in vars:
            servername = vars['sv_hostname']
            servername = supurtcolors(servername)
        else:
            servername = "Unknown"

        if 'g_modversion' in vars:
            version = vars['g_modversion']
        else:
            version = "Unknown"

        if 'sv_privateClients' in vars:
            privateslots = int(vars['sv_privateClients'])
        else:
            privateslots = 0

        if 'sv_privateclients' in vars:
            privateslots = int(vars['sv_privateclients'])
        else:
            privateslots = 0

        if 'sv_maxclients' in vars:
            slots = int(vars['sv_maxclients']) - privateslots
        else:
            slots = 0

        if 'g_gametype' in vars:
            gametype = vars['g_gametype']
        else:
            gametype = "???"

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

    print "%s %s %s %s %s %s"%(servername, version, gametype, players, bots, slots)

    return servername, version, gametype, players, bots, slots

def main():

    allservers("full empty")

if __name__ == '__main__':

    while True:
        main()
        time.sleep(30)

