<?php
include 'pays.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$config = parse_ini_file('config/config.ini', false);

$dbhost = $config['host'];
$dbuser = $config['user'];
$dbpassword = $config['password'];
$dbname = $config['name'];

$listpays = array();
$listgametype = array('FFA' => array(), 'LMS' => array(), 'TDM' => array(), 'TS' => array(), 'FTL' => array(), 'CandH' => array(), 'CTF' => array(), 'Bomb' => array(), 'Jump' => array(), 'Freeze' => array(), 'GunGame' => array());

$bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpassword);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Clean & Colors Name
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function clean_and_colors( $str ) {
    $colors = array(
        0 =>'black',
        1 =>'red',
        2 =>'green',
        3 =>'yellow',
        4 =>'blue',
        5 =>'cyan',
        6 =>'#FF00FF',
        7 =>'white',
        8 =>'#FF6600',
        9 =>'grey');
    $str = htmlentities($str);
    $i = 0;
    $nb = 0;
    $pos = strpos($str, '^' , $i);
    while ($pos !== false) {
        $i = $pos;
        if ( isset( $str[$i+1] , $colors[ $str[$i+1] ] ) ) {
            if ($str[$i+1] != 0) {$replace = '<span style="color: '.$colors[ $str[$i+1] ].'; text-shadow: 1px 1px #000;">';}
            else {$replace = '<span style="color: '.$colors[ $str[$i+1] ].';">';}
            if ($nb >0)
                $replace = '</span>'.$replace;
                $tmp = $i - 1 + strlen($replace);
                $str = substr($str, 0, $i  ). $replace . substr($str, $i + 2 );
                $i = $tmp;
                $nb ++;
            }
            $pos = strpos($str, '^', $i + 1 );
        }
        if ( $nb >0 )
            $str .= '</span>';
    return $str;
}
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
?>   