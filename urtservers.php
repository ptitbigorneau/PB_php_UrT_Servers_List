<?php
session_start();
include 'pays.php';

$a=$_GET["data"];
if(isset($_GET["data"])) {
    if ($_GET["data"] >= 1 AND $_GET["data"] <= 8 ) {
	    $_SESSION['tab1'] = $_GET["data"];
    }
    if ($_GET["data"] >= 9 AND $_GET["data"] <= 16 ) {
	    $_SESSION['tab2'] = $_GET["data"];
    }
    if ($_GET["data"] >= 17 AND $_GET["data"] <= 34 ) {
	    $_SESSION['tab3'] = $_GET["data"];
    }
};

$config = parse_ini_file('config/config.ini', false);

$dbhost = $config['host'];
$dbuser = $config['user'];
$dbpassword = $config['password'];
$dbname = $config['name'];

$listpays = array();
$listgametype = array('FFA' => array(), 'LMS' => array(), 'TDM' => array(), 'TS' => array(), 'FTL' => array(), 'CandH' => array(), 'CTF' => array(), 'Bomb' => array(), 'Jump' => array(), 'Freeze' => array(), 'GunGame' => array());

$bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpassword);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Liste pays
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT pays FROM servers');
while($row=$reponse->fetch()){

    if (!in_array($row['pays'], $listpays)){
        $listpays[$row['pays']] = array();
    }
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT COUNT(*) FROM servers');
while($row=$reponse->fetch()){
    $servers  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE players=0');
while($row=$reponse->fetch()){
    $empty  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE players=1');
while($row=$reponse->fetch()){
    $un  = $row['COUNT(*)'];
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total serveurs
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="FFA"');
while($row=$reponse->fetch()){
    $ffa  = $row['COUNT(*)'];
    array_push($listgametype['FFA'], $ffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="LMS"');
while($row=$reponse->fetch()){
    $lms  = $row['COUNT(*)'];
    array_push($listgametype['LMS'], $lms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="TDM"');
while($row=$reponse->fetch()){
    $tdm  = $row['COUNT(*)'];
    array_push($listgametype['TDM'], $tdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="TS"');
while($row=$reponse->fetch()){
    $ts  = $row['COUNT(*)'];
    array_push($listgametype['TS'], $ts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="FTL"');
while($row=$reponse->fetch()){
    $ftl  = $row['COUNT(*)'];
    array_push($listgametype['FTL'], $ftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="CandH"');
while($row=$reponse->fetch()){
    $candh  = $row['COUNT(*)'];
    array_push($listgametype['CandH'], $candh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="CTF"');
while($row=$reponse->fetch()){
    $ctf  = $row['COUNT(*)'];
    array_push($listgametype['CTF'], $ctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="Bomb"');
while($row=$reponse->fetch()){
    $bomb  = $row['COUNT(*)'];
    array_push($listgametype['Bomb'], $bomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="Jump"');
while($row=$reponse->fetch()){
    $jump  = $row['COUNT(*)'];
    array_push($listgametype['Jump'], $jump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="Freeze"');
while($row=$reponse->fetch()){
    $freeze  = $row['COUNT(*)'];
    array_push($listgametype['Freeze'], $freeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype="GunGame"');
while($row=$reponse->fetch()){
    $gungame  = $row['COUNT(*)'];
    array_push($listgametype['GunGame'], $gungame);
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Serveurs total joueurs, total bots
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(players) FROM servers');
while($row = $reponse->fetch()){
    $players = $row['SUM(players)'];

}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers');
while($row = $reponse->fetch()){
    $bots = $row['SUM(bots)'];
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total joueurs
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="FFA"');
while($row=$reponse->fetch()){
    $pffa  = $row['SUM(players)'];
    array_push($listgametype['FFA'], $pffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="LMS"');
while($row=$reponse->fetch()){
    $plms  = $row['SUM(players)'];
    array_push($listgametype['LMS'], $plms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="TDM"');
while($row=$reponse->fetch()){
    $ptdm  = $row['SUM(players)'];
    array_push($listgametype['TDM'], $ptdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="TS"');
while($row=$reponse->fetch()){
    $pts  = $row['SUM(players)'];
    array_push($listgametype['TS'], $pts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="FTL"');
while($row=$reponse->fetch()){
    $pftl  = $row['SUM(players)'];
    array_push($listgametype['FTL'], $pftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="CandH"');
while($row=$reponse->fetch()){
    $pcandh  = $row['SUM(players)'];
    array_push($listgametype['CandH'], $pcandh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="CTF"');
while($row=$reponse->fetch()){
    $pctf  = $row['SUM(players)'];
    array_push($listgametype['CTF'], $pctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="Bomb"');
while($row=$reponse->fetch()){
    $pbomb  = $row['SUM(players)'];
    array_push($listgametype['Bomb'], $pbomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="Jump"');
while($row=$reponse->fetch()){
    $pjump  = $row['SUM(players)'];
    array_push($listgametype['Jump'], $pjump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="Freeze"');
while($row=$reponse->fetch()){
    $pfreeze  = $row['SUM(players)'];
    array_push($listgametype['Freeze'], $pfreeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(players) FROM servers WHERE gametype="GunGame"');
while($row=$reponse->fetch()){
    $pgungame  = $row['SUM(players)'];
    array_push($listgametype['GunGame'], $pgungame);
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total bots
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="FFA"');
while($row=$reponse->fetch()){
    $bffa  = $row['SUM(bots)'];
    array_push($listgametype['FFA'], $bffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="LMS"');
while($row=$reponse->fetch()){
    $blms  = $row['SUM(bots)'];
    array_push($listgametype['LMS'], $blms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="TDM"');
while($row=$reponse->fetch()){
    $btdm  = $row['SUM(bots)'];
    array_push($listgametype['TDM'], $btdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="TS"');
while($row=$reponse->fetch()){
    $bts  = $row['SUM(bots)'];
    array_push($listgametype['TS'], $bts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="FTL"');
while($row=$reponse->fetch()){
    $bftl  = $row['SUM(bots)'];
    array_push($listgametype['FTL'], $bftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="CandH"');
while($row=$reponse->fetch()){
    $bcandh  = $row['SUM(bots)'];
    array_push($listgametype['CandH'], $bcandh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="CTF"');
while($row=$reponse->fetch()){
    $bctf  = $row['SUM(bots)'];
    array_push($listgametype['CTF'], $bctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="Bomb"');
while($row=$reponse->fetch()){
    $bbomb  = $row['SUM(bots)'];
    array_push($listgametype['Bomb'], $bbomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="Jump"');
while($row=$reponse->fetch()){
    $bjump  = $row['SUM(bots)'];
    array_push($listgametype['Jump'], $bjump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="Freeze"');
while($row=$reponse->fetch()){
    $bfreeze  = $row['SUM(bots)'];
    array_push($listgametype['Freeze'], $bfreeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(bots) FROM servers WHERE gametype="GunGame"');
while($row=$reponse->fetch()){
    $bgungame  = $row['SUM(bots)'];
    array_push($listgametype['GunGame'], $bgungame);
}
$reponse->closeCursor();

$deux = $servers - $empty - $un;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT version FROM servers order by version desc');

$listversion = array();

while($row = $reponse->fetch()){

    $version = $row['version'];
    if (!in_array($version, $listversion)) {
        array_push($listversion, $version);
    }
}
$reponse->closeCursor();
$undeux = $un + $deux;

$urtserverslist = '
            <div id="droite">
                <div class="tableau">
                    <table>
                        <tr>
                            <th class="th1">Servers</th>
                            <td class="td1">'.$servers.'</td>
                        </tr>
                        <tr>
                            <th class="th12">Servers without Players</th>
                            <td class="td12"> '.$empty.'</td>
                        </tr>
                        <tr>
                            <th class="th1">Servers with Players</th>
                            <td class="td1">'.$undeux.'</td>
                        </tr>
                        <tr>
                            <th class="th12">Player(s)</th>
                            <td class="td12">'.$players.'</td>
                        </tr>
                        <tr>
                            <th class="th1">Bot(s)</th>
                            <td class="td1">'.$bots.'</td>
                        </tr>

                    </table>
                </div>
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr2">
                                <th class="th2"><span class="th2l">Country</span><div class="th2r"><span onclick="myFunction(1)"><a>&#8657; </a> </span><span onclick="myFunction(2)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Server(s)</span><div class="th2r"><span onclick="myFunction(3)"><a>&#8657; </a> </span><span onclick="myFunction(4)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Player(s)</span><div class="th2r"><span onclick="myFunction(5)"><a>&#8657; </a> </span><span onclick="myFunction(6)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Bot(s)</span><div class="th2r"><span onclick="myFunction(7)"><a>&#8657; </a> </span><span onclick="myFunction(8)"> <a> &#8659;</a></span></div></th>
                            </tr>
                        </thead>
                        <tbody>';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach ($listpays as $key => $value){
    $paysdb = $key;

    $reponse = $bdd->query('SELECT players, bots FROM servers WHERE pays="'.$paysdb.'"');

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row["players"];
        $nbots = $nbots + $row["bots"];

    }
    $reponse->closeCursor();

    array_push($listpays[$key], $ns, $nplayers, $nbots);
    
}

if ($_SESSION['tab1'] == 1) {ksort($listpays);}
elseif ($_SESSION['tab1'] == 2) {krsort($listpays);}
elseif ($_SESSION['tab1'] == 3) {arsort($listpays);}
elseif ($_SESSION['tab1'] == 4) {asort($listpays);}
elseif ($_SESSION['tab1'] == 5) {
	uasort($listpays, function ($a, $b) {
        if($a[1] == $b[1]) {
            return 0;
        }
        return ($a[1] > $b[1]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab1'] == 6) {
    uasort($listpays, function ($a, $b) {
        if($a[1] == $b[1]) {
            return 0;
        }
        return ($a[1] < $b[1]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab1'] == 7) {
	uasort($listpays, function ($a, $b) {
        if($a[2] == $b[2]) {
            return 0;
        }
        return ($a[2] > $b[2]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab1'] == 8) {
    uasort($listpays, function ($a, $b) {
        if($a[2] == $b[2]) {
            return 0;
        }
        return ($a[2] < $b[2]) ? -1 : 1;
    });
}
else {ksort($listpays);}

foreach ($listpays as $key => $value){
    $paysdb = $key;
    $ns = $value[0];
    $nplayers = $value[1];
    $nbots = $value[2];

    $urtserverslist = $urtserverslist.'<tr class="tr1">';

    if ($paysdb) {

        $urtserverslist = $urtserverslist.'<td class="td5"><a><img src="flags/'.strtolower($paysdb).'.png"; " title="'.$arraypays[$paysdb].'"/></a></td>';

    }
    else {

        $urtserverslist = $urtserverslist.'<td class="td2"> </td>';

    }

    $urtserverslist = $urtserverslist.'<td class="td2">'.$ns.'</td><td class="td2">'.$nplayers.'</td><td class="td2">'.$nbots.'</td></tr>';

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$urtserverslist = $urtserverslist.'</tbody></table></div>
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr3">
                                <th class="th2">Version</th>
                                <th class="th2b">Server(s)</th>
                                <th class="th2b">Player(s)</th>
                                <th class="th2b">Bot(s)</th>
                            </tr>
                        </thead>
                        <tbody>';

for ($numero = 0; $numero < count($listversion); $numero++) {
    $versiondb = $listversion[$numero];

    $reponse = $bdd->query('SELECT players, bots FROM servers WHERE version="'.$versiondb.'"');

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row["players"];
        $nbots = $nbots + $row["bots"];

    }
    $reponse->closeCursor();

    $urtserverslist = $urtserverslist.'
                            <tr class="tr1">
                                <td class="td7">  '.$versiondb.' </td>
                                <td class="td2">  '.$ns.' </td>
                                <td class="td2">  '.$nplayers.' </td>
                                <td class="td2">  '.$nbots.' </td>
                            </tr>';

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$urtserverslist = $urtserverslist.'
                        </tbody>
                    </table>
                </div>
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr4">
                                <th class="th2"><span class="th2l">GameType</span><div class="th2r"><span onclick="myFunction(9)"><a>&#8657; </a> </span><span onclick="myFunction(10)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Server(s)</span><div class="th2r"><span onclick="myFunction(11)"><a>&#8657; </a> </span><span onclick="myFunction(12)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Player(s)</span><div class="th2r"><span onclick="myFunction(13)"><a>&#8657; </a> </span><span onclick="myFunction(14)"> <a> &#8659;</a></span></div></th>
                                <th class="th2"><span class="th2l">Bot(s)</span><div class="th2r"><span onclick="myFunction(15)"><a>&#8657; </a> </span><span onclick="myFunction(16)"> <a> &#8659;</a></span></div></th>
                            </tr>
                        </thead>
                        <tbody>';

if ($_SESSION['tab2'] == 9) {ksort($listgametype);}
elseif ($_SESSION['tab2'] == 10) {krsort($listgametype);}
elseif ($_SESSION['tab2'] == 11) {arsort($listgametype);}
elseif ($_SESSION['tab2'] == 12) {asort($listgametype);}
elseif ($_SESSION['tab2'] == 13) {
	uasort($listgametype, function ($a, $b) {
        if($a[1] == $b[1]) {
            return 0;
        }
        return ($a[1] > $b[1]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab2'] == 14) {
    uasort($listgametype, function ($a, $b) {
        if($a[1] == $b[1]) {
            return 0;
        }
        return ($a[1] < $b[1]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab2'] == 15) {
	uasort($listgametype, function ($a, $b) {
        if($a[2] == $b[2]) {
            return 0;
        }
        return ($a[2] > $b[2]) ? -1 : 1;
    });
}
elseif ($_SESSION['tab2'] == 16) {
    uasort($listgametype, function ($a, $b) {
        if($a[2] == $b[2]) {
            return 0;
        }
        return ($a[2] < $b[2]) ? -1 : 1;
    });
}
else {arsort($listgametype);}

foreach ($listgametype as $key => $value){
    $gt = $key;
    $ns = $value[0];
    $nplayers = $value[1];
    $nbots = $value[2];
	
    $urtserverslist = $urtserverslist.'<tr class="tr1">
                                <td class="td7">'.$gt.'</td><td class="td2">  '.$ns.' </td><td class="td2">  '.$nplayers.' </td><td class="td2">  '.$nbots.' </td></tr>';
}
$urtserverslist = $urtserverslist.'</tbody></table></div></div><div id="gauche">';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_SESSION['tab3'] == 17) {$reponse = $bdd->query("SELECT * FROM servers order by version desc, players desc");}
elseif ($_SESSION['tab3'] == 18) {$reponse = $bdd->query("SELECT * FROM servers order by version asc, players desc");}
elseif ($_SESSION['tab3'] == 19) {$reponse = $bdd->query("SELECT * FROM servers order by pays desc, players desc");}
elseif ($_SESSION['tab3'] == 20) {$reponse = $bdd->query("SELECT * FROM servers order by pays asc, players desc");}
elseif ($_SESSION['tab3'] == 21) {$reponse = $bdd->query("SELECT * FROM servers order by name desc");}
elseif ($_SESSION['tab3'] == 22) {$reponse = $bdd->query("SELECT * FROM servers order by name asc");}
elseif ($_SESSION['tab3'] == 23) {$reponse = $bdd->query("SELECT * FROM servers order by adresse desc");}
elseif ($_SESSION['tab3'] == 24) {$reponse = $bdd->query("SELECT * FROM servers order by adresse asc");}
elseif ($_SESSION['tab3'] == 25) {$reponse = $bdd->query("SELECT * FROM servers order by gametype desc, players desc");}
elseif ($_SESSION['tab3'] == 26) {$reponse = $bdd->query("SELECT * FROM servers order by gametype asc, players desc");}
elseif ($_SESSION['tab3'] == 27) {$reponse = $bdd->query("SELECT * FROM servers order by players desc");}
elseif ($_SESSION['tab3'] == 28) {$reponse = $bdd->query("SELECT * FROM servers order by players asc");}
elseif ($_SESSION['tab3'] == 29) {$reponse = $bdd->query("SELECT * FROM servers order by bots desc, players desc");}
elseif ($_SESSION['tab3'] == 30) {$reponse = $bdd->query("SELECT * FROM servers order by bots asc, players desc");}
elseif ($_SESSION['tab3'] == 31) {$reponse = $bdd->query("SELECT * FROM servers order by slots desc, players desc");}
elseif ($_SESSION['tab3'] == 32) {$reponse = $bdd->query("SELECT * FROM servers order by slots asc, players desc");}
elseif ($_SESSION['tab3'] == 33) {$reponse = $bdd->query("SELECT * FROM servers order by date desc, players desc");}
elseif ($_SESSION['tab3'] == 34) {$reponse = $bdd->query("SELECT * FROM servers order by date asc, players desc");}
else {$reponse = $bdd->query("SELECT * FROM servers order by version desc, players desc");}

$urtserverslist = $urtserverslist.'
                <table>
                    <thead>
                        <tr class="tr5">
                            <th class="th22"><span class="th2l">Version</span><div class="th2r"><span onclick="myFunction(17)"><a>&#8657; </a> </span><span onclick="myFunction(18)"> <a> &#8659;</a></span></div></th>
                            <th class="th23"><span onclick="myFunction(19)"><a>&#8657; </a> </span><span onclick="myFunction(20)"> <a> &#8659;</a></span></th>
                            <th class="th_server"><span class="th2l">Server</span><div class="th2r"><span onclick="myFunction(21)"><a>&#8657; </a> </span><span onclick="myFunction(22)"> <a> &#8659;</a></span></div></th>
                            <th class="th22"><span class="th2l">Address</span><div class="th2r"><span onclick="myFunction(23)"><a>&#8657; </a> </span><span onclick="myFunction(24)"> <a> &#8659;</a></span></div></th>
                            <th class="th22b"><span class="th2l">Gametype</span><div class="th2r"><span onclick="myFunction(25)"><a>&#8657; </a> </span><span onclick="myFunction(26)"> <a> &#8659;</a></span></div></th>
                            <th class="th22b"><span class="th2l">Player(s)</span><div class="th2r"><span onclick="myFunction(27)"><a>&#8657; </a> </span><span onclick="myFunction(28)"> <a> &#8659;</a></span></div></th>
                            <th class="th22"><span class="th2l">Bot(s)</span><div class="th2r"><span onclick="myFunction(29)"><a>&#8657; </a> </span><span onclick="myFunction(30)"> <a> &#8659;</a></span></div></th>
                            <th class="th22"><span class="th2l">Slots</span><div class="th2r"><span onclick="myFunction(31)"><a>&#8657; </a> </span><span onclick="myFunction(32)"> <a> &#8659;</a></span></div></th>
                            <th class="th22"><span class="th2l">Update</span><div class="th2r"><span onclick="myFunction(33)"><a>&#8657; </a> </span><span onclick="myFunction(34)"> <a>&#8659;</a></span></div></th>
                        </tr>
                    </thead>
                    <tbody>';
while($row=$reponse->fetch()){
    $ip = explode(":", $row["adresse"]);
    $pays = $row["pays"];
    $urtserverslist = $urtserverslist.'
                        <tr class="tr1">
                            <td class="td3">  '.$row["version"].' </td>';

    if ($pays) {
        $urtserverslist = $urtserverslist.'
                            <td class="td6"><a><img src="flags/'.strtolower($pays).'.png"; " title="'.$arraypays[$pays].'"/></a></td>';

    }
    else {
        $urtserverslist = $urtserverslist.'
                            <td class="td3"> </td>';

    }
        $urtserverslist = $urtserverslist.'
                            <td class="td7">  '.$row["name"].' </td>
                            <td class="td3">  '.$row["adresse"].' </td>
                            <td class="td4">  '.$row["gametype"].' </td>
                            <td class="td4">  '.$row["players"].' </td>
                            <td class="td4">  '.$row["bots"].' </td>
                            <td class="td4">  '.$row["slots"].' </td>
                            <td class="td4">  '.date("H:i",$row["date"]).' </td>
                        </tr>';

}
$reponse->closeCursor();
$urtserverslist = $urtserverslist.'
                    </tbody>
                </table>
            </div>';

$reponse->closeCursor();

echo $urtserverslist;
?>
    