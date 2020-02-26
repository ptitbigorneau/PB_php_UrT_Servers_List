<?php
session_start();
include 'functions.php';
include 'bd_servers.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
}
if (!isset($_SESSION['tab1'])) { $_SESSION['tab1'] = 0;}
if (!isset($_SESSION['tab2'])) { $_SESSION['tab2'] = 0;}
if (!isset($_SESSION['tab3'])) { $_SESSION['tab3'] = 0;}
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

$urtserverslist = '<div id="gauche"><div id="hleft"><div id="tableau1"><table>
    <tr>
        <th class="th1">Servers</th>
        <td class="td1">'.$servers.'</td>
    </tr>
    <tr>
        <th class="th1-2">Player(s)</th>
        <td class="td1-2">'.$nplayers.'</td>
    </tr>
    <tr>
        <th class="th1">Bot(s)</th>
        <td class="td1">'.$nbots.'</td>
    </tr>
</table></div><div id="tableau2"><table><thead>
    <tr class="tr2">
        <th class="th2"><span class="th2-l">Country</span><div class="th2-r"><span onclick="FunctionTableTry(1)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(2)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Server(s)</span><div class="th2-r"><span onclick="FunctionTableTry(3)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(4)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Player(s)</span><div class="th2-r"><span onclick="FunctionTableTry(5)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(6)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Bot(s)</span><div class="th2-r"><span onclick="FunctionTableTry(7)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(8)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
    </tr>
</thead><tbody>';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach ($listpays as $key => $value){
    $paysdb = $key;

    $reponse = $bdd->query('SELECT nplayers, nbots FROM servers WHERE pays="'.$paysdb.'"');

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row["nplayers"];
        $nbots = $nbots + $row["nbots"];

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
else {arsort($listpays);}

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
$urtserverslist = $urtserverslist.'</tbody></table></div></div><div id="hright"><div id="tableau3"><table><thead>
    <tr class="tr2">
        <th class="th2">Version</th>
        <th class="th2b">Server(s)</th>
        <th class="th2b">Player(s)</th>
        <th class="th2b">Bot(s)</th>
    </tr>
</thead><tbody>';

for ($numero = 0; $numero < count($listversion); $numero++) {
    $versiondb = $listversion[$numero];

    $reponse = $bdd->query('SELECT nplayers, nbots FROM servers WHERE version="'.$versiondb.'"');

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row["nplayers"];
        $nbots = $nbots + $row["nbots"];

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
$urtserverslist = $urtserverslist.'</tbody></table></div><div id="tableau4"><table><thead>
    <tr class="tr2">
        <th class="th2"><span class="th2-l">GameType</span><div class="th2-r"><span onclick="FunctionTableTry(9)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(10)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Server(s)</span><div class="th2-r"><span onclick="FunctionTableTry(11)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(12)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Player(s)</span><div class="th2-r"><span onclick="FunctionTableTry(13)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(14)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
        <th class="th2"><span class="th2-l">Bot(s)</span><div class="th2-r"><span onclick="FunctionTableTry(15)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(16)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
    </tr>
</thead><tbody>';

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
    
    $urtserverslist = $urtserverslist.'<tr class="tr1"><td class="td7">'.$gt.'</td><td class="td2">  '.$ns.' </td><td class="td2">  '.$nplayers.' </td><td class="td2">  '.$nbots.' </td></tr>';
}
$urtserverslist = $urtserverslist.'</tbody></table></div></div></div>';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_SESSION['tab3'] == 17) {$requete = "SELECT * FROM servers order by version desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 18) {$requete = "SELECT * FROM servers order by version asc, nplayers desc";}
elseif ($_SESSION['tab3'] == 19) {$requete = "SELECT * FROM servers order by pays desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 20) {$requete = "SELECT * FROM servers order by pays asc, nplayers desc";}
elseif ($_SESSION['tab3'] == 21) {$requete = "SELECT * FROM servers order by name desc";}
elseif ($_SESSION['tab3'] == 22) {$requete = "SELECT * FROM servers order by name asc";}
elseif ($_SESSION['tab3'] == 23) {$requete = "SELECT * FROM servers order by adresse desc";}
elseif ($_SESSION['tab3'] == 24) {$requete = "SELECT * FROM servers order by adresse asc";}
elseif ($_SESSION['tab3'] == 25) {$requete = "SELECT * FROM servers order by gametype desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 26) {$requete = "SELECT * FROM servers order by gametype asc, nplayers desc";}
elseif ($_SESSION['tab3'] == 27) {$requete = "SELECT * FROM servers order by nplayers desc";}
elseif ($_SESSION['tab3'] == 28) {$requete = "SELECT * FROM servers order by nplayers asc";}
elseif ($_SESSION['tab3'] == 29) {$requete = "SELECT * FROM servers order by nbots desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 30) {$requete = "SELECT * FROM servers order by nbots asc, nplayers desc";}
elseif ($_SESSION['tab3'] == 31) {$requete = "SELECT * FROM servers order by slots desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 32) {$requete = "SELECT * FROM servers order by slots asc, nplayers desc";}
elseif ($_SESSION['tab3'] == 33) {$requete = "SELECT * FROM servers order by date desc, nplayers desc";}
elseif ($_SESSION['tab3'] == 34) {$requete = "SELECT * FROM servers order by date asc, nplayers desc";}
else {$requete = "SELECT * FROM servers order by version desc, nplayers desc";}

$reponse = $bdd->query($requete);

$urtserverslist = $urtserverslist.'
<div id="droite"><table id="tableau5">
    <thead>
        <tr class="tr2">
            <th class="th3"><span class="th2-l">Version</span><div class="th2-r"><span onclick="FunctionTableTry(17)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(18)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th5"><span onclick="FunctionTableTry(19)"><a href="javascript:void(0)">&#8657; </a> </span><span onclick="FunctionTableTry(20)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th_server"><span class="th2-l">Server</span><div class="th2-r"><span onclick="FunctionTableTry(21)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(22)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th3"><span class="th2-l">Address</span><div class="th2-r"><span onclick="FunctionTableTry(23)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(24)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th4"><span class="th2-l">Gametype</span><div class="th2-r"><span onclick="FunctionTableTry(25)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(26)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th4"><span class="th2-l">Player(s)</span><div class="th2-r"><span onclick="FunctionTableTry(27)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(28)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th3"><span class="th2-l">Bot(s)</span><div class="th2-r"><span onclick="FunctionTableTry(29)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(30)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th3"><span class="th2-l">Slots</span><div class="th2-r"><span onclick="FunctionTableTry(31)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(32)"><a href="javascript:void(0)"> &#8659;</a></span></div></th>
            <th class="th3"><span class="th2-l">Update</span><div class="th2-r"><span onclick="FunctionTableTry(33)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(34)"><a href="javascript:void(0)">&#8659;</a></span></div></th>
        </tr>
    </thead><tbody>';
while($row=$reponse->fetch()){
    $ip = explode(":", $row["adresse"]);
    $pays = $row["pays"];
    $urtserverslist = $urtserverslist.'<tr class="tr1"><td class="td3">'.$row["version"].'</td>';

    if ($pays) {
        $urtserverslist = $urtserverslist.'<td class="td6"><a><img src="flags/'.strtolower($pays).'.png"; " title="'.$arraypays[$pays].'"/></a></td>';

    }
    else {
        $urtserverslist = $urtserverslist.'<td class="td3"> </td>';

    }
    $urtserverslist = $urtserverslist.'
    <td class="td7"><a href="urtviewers.php?adr='.$row["adresse"].'">'.clean_and_colors($row["name"]).'</a></td>
    <td class="td3"><a href="urtviewers.php?adr='.$row["adresse"].'">'.$row["adresse"].'</a></td>
    <td class="td3">'.name_gametype($row["gametype"])[0].'</td>
    <td class="td4">'.$row["nplayers"].'</td>
    <td class="td4">'.$row["nbots"].'</td>
    <td class="td4">'.$row["slots"].'</td>
    <td class="td4">'.date("H:i",$row["date"]).'</td>
</tr>';

}
$reponse->closeCursor();
$urtserverslist = $urtserverslist.'</tbody></table></div>';

$reponse = $bdd->query($requete);

$urtserverslist = $urtserverslist.'
<div id="droite2"><table id="tableau6">
    <caption>Player(s), Bot(s), Slots, Update</caption>
    <thead>
        <tr class="tr2">
            <th class="th6"><span onclick="FunctionTableTry(17)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(18)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(19)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(20)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(21)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(22)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(23)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(24)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(25)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(26)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(27)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(28)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(29)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(30)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(31)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(32)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(33)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(34)"><a href="javascript:void(0)"> &#8659;</a></span></th>
        </tr>
    </thead><tbody>';
while($row=$reponse->fetch()){
    $ip = explode(":", $row["adresse"]);
    $pays = $row["pays"];
    $urtserverslist = $urtserverslist.'<tr class="tr1"><td class="td3">  '.$row["version"].' </td>';

    if ($pays) {
        $urtserverslist = $urtserverslist.'<td class="td6"><a><img src="flags/'.strtolower($pays).'.png"; " title="'.$arraypays[$pays].'"/></a></td>';

    }
    else {
        $urtserverslist = $urtserverslist.'<td class="td3"> </td>';

    }
    $urtserverslist = $urtserverslist.'
    <td class="td7"><a href="urtviewers.php?adr='.$row["adresse"].'">'.clean_and_colors($row["name"]).'</a></td>
    <td class="td3"><a href="urtviewers.php?adr='.$row["adresse"].'">'.$row["adresse"].'</a></td>
    <td class="td3">'.name_gametype($row["gametype"])[0].'</td>
    <td class="td4">'.$row["nplayers"].'</td>
    <td class="td4">'.$row["nbots"].'</td>
    <td class="td4">'.$row["slots"].'</td>
    <td class="td4">'.date("H:i",$row["date"]).'</td>
</tr>';

}
$reponse->closeCursor();
$urtserverslist = $urtserverslist.'</tbody></table></div>';

$reponse = $bdd->query($requete);

$urtserverslist = $urtserverslist.'
<div id="droite3"><table id="tableau7">
    <caption>Player(s)/Slots[Bot(s)]</caption>
    <thead>
        <tr class="tr2">
            <th class="th6"><span onclick="FunctionTableTry(17)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(18)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(19)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(20)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(21)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(22)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(23)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(24)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(25)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(26)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(27)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(28)"><a href="javascript:void(0)"> &#8659;</a></span></th>
        </tr>
    </thead><tbody>';
while($row=$reponse->fetch()){
    $ip = explode(":", $row["adresse"]);
    $pays = $row["pays"];
    $urtserverslist = $urtserverslist.'<tr class="tr1"><td class="td3">'.$row["version"].'</td>';

    if ($pays) {
        $urtserverslist = $urtserverslist.'<td class="td6"><a><img src="flags/'.strtolower($pays).'.png"; " title="'.$arraypays[$pays].'"/></a></td>';

    }
    else {
        $urtserverslist = $urtserverslist.'<td class="td3"> </td>';

    }
    $urtserverslist = $urtserverslist.'
    <td class="td7"><a href="urtviewers.php?adr='.$row["adresse"].'">'.clean_and_colors($row["name"]).'</a></td>
    <td class="td3"><a href="urtviewers.php?adr='.$row["adresse"].'">'.$row["adresse"].'</a></td>
    <td class="td3">'.name_gametype($row["gametype"])[0].'</td>
    <td class="td4">'.$row["nplayers"].'/'.$row["slots"].'['.$row["nbots"].']</td>
</tr>';

}
$reponse->closeCursor();
$urtserverslist = $urtserverslist.'</tbody></table></div>';

$reponse = $bdd->query($requete);

$urtserverslist = $urtserverslist.'
<div id="droite4"><table id="tableau7">
    <caption><span>Player(s)/Slots[Bot(s)]</span></caption>
    <thead>
        <tr class="tr2">
             <th class="th6"><span onclick="FunctionTableTry(17)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(18)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(19)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(20)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(21)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(22)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th6"><span onclick="FunctionTableTry(23)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(24)"><a href="javascript:void(0)"> &#8659;</a></span></th>
            <th class="th7"><span onclick="FunctionTableTry(27)"><a href="javascript:void(0)">&#8657; </a></span><span onclick="FunctionTableTry(28)"><a href="javascript:void(0)"> &#8659;</a></span></th>
        </tr>
    </thead><tbody>';
while($row=$reponse->fetch()){
    $version = $row["version"];
    if (substr($version, 0, 3) == "4.2") {$version = "4.2";}
    $ip = explode(":", $row["adresse"]);
    $pays = $row["pays"];
    $urtserverslist = $urtserverslist.'<tr class="tr1"><td class="td3">'.$version.'</td>';

    if ($pays) {
        $urtserverslist = $urtserverslist.'<td class="td6"><a><img src="flags/'.strtolower($pays).'.png"; " title="'.$arraypays[$pays].'"/></a></td>';

    }
    else {
        $urtserverslist = $urtserverslist.'<td class="td3"> </td>';

    }

    $gametype = name_gametype($row["gametype"])[0];
    if ($gametype == "GunGame") {$gametype = "GG";}
    if ($gametype == "Freeze") {$gametype = "FT";}

    $urtserverslist = $urtserverslist.'
    <td class="td7"><p><a href="urtviewers.php?adr='.$row["adresse"].'">'.clean_and_colors($row["name"]).'<br /><span class="td7-2">'.$row["adresse"].'</span></a></p></td>
    <td class="td3">'.$gametype.' </td>
    <td class="td4"><p>'.$row["nplayers"].'/'.$row["slots"].'<br />['.$row["nbots"].']</p></td>
</tr>';

}
$reponse->closeCursor();
$urtserverslist = $urtserverslist.'</tbody></table></div>';

$reponse = $bdd->query($requete);

?>
    