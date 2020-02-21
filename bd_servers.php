<?php
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
// Total serveurs
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT COUNT(*) FROM servers');
while($row=$reponse->fetch()){
    $servers  = $row['COUNT(*)'];
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total serveurs
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=0');
while($row=$reponse->fetch()){
    $ffa  = $row['COUNT(*)'];
    array_push($listgametype['FFA'], $ffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=1');
while($row=$reponse->fetch()){
    $lms  = $row['COUNT(*)'];
    array_push($listgametype['LMS'], $lms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=3');
while($row=$reponse->fetch()){
    $tdm  = $row['COUNT(*)'];
    array_push($listgametype['TDM'], $tdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=4');
while($row=$reponse->fetch()){
    $ts  = $row['COUNT(*)'];
    array_push($listgametype['TS'], $ts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=5');
while($row=$reponse->fetch()){
    $ftl  = $row['COUNT(*)'];
    array_push($listgametype['FTL'], $ftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=6');
while($row=$reponse->fetch()){
    $candh  = $row['COUNT(*)'];
    array_push($listgametype['CandH'], $candh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=7');
while($row=$reponse->fetch()){
    $ctf  = $row['COUNT(*)'];
    array_push($listgametype['CTF'], $ctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=8');
while($row=$reponse->fetch()){
    $bomb  = $row['COUNT(*)'];
    array_push($listgametype['Bomb'], $bomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=9');
while($row=$reponse->fetch()){
    $jump  = $row['COUNT(*)'];
    array_push($listgametype['Jump'], $jump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=10');
while($row=$reponse->fetch()){
    $freeze  = $row['COUNT(*)'];
    array_push($listgametype['Freeze'], $freeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT COUNT(*) FROM servers WHERE gametype=11');
while($row=$reponse->fetch()){
    $gungame  = $row['COUNT(*)'];
    array_push($listgametype['GunGame'], $gungame);
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Serveurs total joueurs, total nbots
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers');
while($row = $reponse->fetch()){
    $nplayers = $row['SUM(nplayers)'];

}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers');
while($row = $reponse->fetch()){
    $nbots = $row['SUM(nbots)'];
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total joueurs
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=0');
while($row=$reponse->fetch()){
    $pffa  = $row['SUM(nplayers)'];
    array_push($listgametype['FFA'], $pffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=1');
while($row=$reponse->fetch()){
    $plms  = $row['SUM(nplayers)'];
    array_push($listgametype['LMS'], $plms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=3');
while($row=$reponse->fetch()){
    $ptdm  = $row['SUM(nplayers)'];
    array_push($listgametype['TDM'], $ptdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=4');
while($row=$reponse->fetch()){
    $pts  = $row['SUM(nplayers)'];
    array_push($listgametype['TS'], $pts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=5');
while($row=$reponse->fetch()){
    $pftl  = $row['SUM(nplayers)'];
    array_push($listgametype['FTL'], $pftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=6');
while($row=$reponse->fetch()){
    $pcandh  = $row['SUM(nplayers)'];
    array_push($listgametype['CandH'], $pcandh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=7');
while($row=$reponse->fetch()){
    $pctf  = $row['SUM(nplayers)'];
    array_push($listgametype['CTF'], $pctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=8');
while($row=$reponse->fetch()){
    $pbomb  = $row['SUM(nplayers)'];
    array_push($listgametype['Bomb'], $pbomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=9');
while($row=$reponse->fetch()){
    $pjump  = $row['SUM(nplayers)'];
    array_push($listgametype['Jump'], $pjump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=10');
while($row=$reponse->fetch()){
    $pfreeze  = $row['SUM(nplayers)'];
    array_push($listgametype['Freeze'], $pfreeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nplayers) FROM servers WHERE gametype=11');
while($row=$reponse->fetch()){
    $pgungame  = $row['SUM(nplayers)'];
    array_push($listgametype['GunGame'], $pgungame);
}
$reponse->closeCursor();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GameType total nbots
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=0');
while($row=$reponse->fetch()){
    $bffa  = $row['SUM(nbots)'];
    array_push($listgametype['FFA'], $bffa);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=1');
while($row=$reponse->fetch()){
    $blms  = $row['SUM(nbots)'];
    array_push($listgametype['LMS'], $blms);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=3');
while($row=$reponse->fetch()){
    $btdm  = $row['SUM(nbots)'];
    array_push($listgametype['TDM'], $btdm);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=4');
while($row=$reponse->fetch()){
    $bts  = $row['SUM(nbots)'];
    array_push($listgametype['TS'], $bts);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=5');
while($row=$reponse->fetch()){
    $bftl  = $row['SUM(nbots)'];
    array_push($listgametype['FTL'], $bftl);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=6');
while($row=$reponse->fetch()){
    $bcandh  = $row['SUM(nbots)'];
    array_push($listgametype['CandH'], $bcandh);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=7');
while($row=$reponse->fetch()){
    $bctf  = $row['SUM(nbots)'];
    array_push($listgametype['CTF'], $bctf);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=8');
while($row=$reponse->fetch()){
    $bbomb  = $row['SUM(nbots)'];
    array_push($listgametype['Bomb'], $bbomb);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=9');
while($row=$reponse->fetch()){
    $bjump  = $row['SUM(nbots)'];
    array_push($listgametype['Jump'], $bjump);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=10');
while($row=$reponse->fetch()){
    $bfreeze  = $row['SUM(nbots)'];
    array_push($listgametype['Freeze'], $bfreeze);
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT SUM(nbots) FROM servers WHERE gametype=11');
while($row=$reponse->fetch()){
    $bgungame  = $row['SUM(nbots)'];
    array_push($listgametype['GunGame'], $bgungame);
}
$reponse->closeCursor();
?>