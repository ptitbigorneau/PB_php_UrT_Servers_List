<?php
include 'functions.php';
if(isset($_GET["adr"])) {
    $_SESSION['viewer'] = $_GET["adr"];
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT * FROM servers WHERE adresse = "'.$_SESSION['viewer'].'"');

while ($donnees = $reponse->fetch()) {
    $pays = $donnees["pays"];
    $gametype = name_gametype($donnees['gametype'])[1];
    $map = $donnees['map'];
    $slots = $donnees['slots'];
    $privateslots = $donnees['privateslots'];
    $nplayers = $donnees['nplayers'];
    $sv_hostname = clean_and_colors('^7'. $donnees['name'] );
    $modversion = $donnees['version'];
    $address = $_SESSION['viewer'];
    $nbots = $donnees['nbots'];
    $mapjpg = explode("_bots",$map)[0]. '.jpg';
    if(!strstr($list, $mapjpg)) {$mapjpg="ut4_default.jpg";}

    $players = explode(" ", $donnees['lplayers']);
    $scores = explode(" ", $donnees['lscores']);
    $playerslist = array();
                
    for ($i = 1; $i <= count($players); $i++) {
        array_push($playerslist ,$scores[$i-1] . ' ' .$players[$i-1]) ;
    }    
    
    natsort($playerslist);
    $playerslist = array_reverse($playerslist, false);
    
    $tbots = "Bots";
    if ($nbots == 1) {$tbots = "Bot";}
}
$reponse->closeCursor();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
