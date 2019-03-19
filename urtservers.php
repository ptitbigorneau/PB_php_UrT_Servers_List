<?php
include 'pays.php';

$config = parse_ini_file("config/config.ini", false);

$dbhost = $config['host'];
$dbuser = $config['user'];
$dbpassword = $config['password'];
$dbname = $config['name'];

$listpays = array();

$bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpassword);

$reponse = $bdd->query("SELECT pays FROM servers");
while($row=$reponse->fetch()){

    if (!in_array($row['pays'], $listpays)){

        array_push($listpays, $row['pays']);

    }
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers");
while($row=$reponse->fetch()){
    $servers  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE players=0");
while($row=$reponse->fetch()){
    $empty  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE players=1");
while($row=$reponse->fetch()){
    $un  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='FFA'");
while($row=$reponse->fetch()){
    $ffa  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='LMS'");
while($row=$reponse->fetch()){
    $lms  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='TDM'");
while($row=$reponse->fetch()){
    $tdm  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='TS'");
while($row=$reponse->fetch()){
    $ts  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='FTL'");
while($row=$reponse->fetch()){
    $ftl  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='CandH'");
while($row=$reponse->fetch()){
    $candh  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='CTF'");
while($row=$reponse->fetch()){
    $ctf  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='Bomb'");
while($row=$reponse->fetch()){
    $bomb  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='Jump'");
while($row=$reponse->fetch()){
    $jump  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='Freeze'");
while($row=$reponse->fetch()){
    $freeze  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT COUNT(*) FROM servers WHERE gametype='GunGame'");
while($row=$reponse->fetch()){
    $gungame  = $row['COUNT(*)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers");
while($row = $reponse->fetch()){
     $players = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers");
while($row = $reponse->fetch()){
     $bots = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='FFA'");
while($row=$reponse->fetch()){
    $pffa  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='LMS'");
while($row=$reponse->fetch()){
    $plms  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='TDM'");
while($row=$reponse->fetch()){
    $ptdm  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='TS'");
while($row=$reponse->fetch()){
    $pts  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='FTL'");
while($row=$reponse->fetch()){
    $pftl  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='CandH'");
while($row=$reponse->fetch()){
    $pcandh  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='CTF'");
while($row=$reponse->fetch()){
    $pctf  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='Bomb'");
while($row=$reponse->fetch()){
    $pbomb  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='Jump'");
while($row=$reponse->fetch()){
    $pjump  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='Freeze'");
while($row=$reponse->fetch()){
    $pfreeze  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(players) FROM servers WHERE gametype='GunGame'");
while($row=$reponse->fetch()){
    $pgungame  = $row['SUM(players)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='FFA'");
while($row=$reponse->fetch()){
    $bffa  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='LMS'");
while($row=$reponse->fetch()){
    $blms  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='TDM'");
while($row=$reponse->fetch()){
    $btdm  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='TS'");
while($row=$reponse->fetch()){
    $bts  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='FTL'");
while($row=$reponse->fetch()){
    $bftl  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='CandH'");
while($row=$reponse->fetch()){
    $bcandh  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='CTF'");
while($row=$reponse->fetch()){
    $bctf  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='Bomb'");
while($row=$reponse->fetch()){
    $bbomb  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='Jump'");
while($row=$reponse->fetch()){
    $bjump  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='Freeze'");
while($row=$reponse->fetch()){
    $bfreeze  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$reponse = $bdd->query("SELECT SUM(bots) FROM servers WHERE gametype='GunGame'");
while($row=$reponse->fetch()){
    $bgungame  = $row['SUM(bots)'];
}
$reponse->closeCursor();

$deux = $servers - $empty - $un;

$reponse = $bdd->query("SELECT version FROM servers order by version desc");

$listversion = array();

while($row = $reponse->fetch()){

    $version = $row['version'];
    if (!in_array($version, $listversion)) {
        array_push($listversion, $version);
    }
}
$reponse->closeCursor();
?>
<!--                                                                                                                                                  -->
<!DOCTYPE html>
    <html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css" />
            <title>PtitBigorneau - Servers Urban Terror</title>
        </head>
    <body>
        <h1>Servers UrbanTerror 4.3</h1>
        <div id="contenu">
            <p id="compteur">updated :</p>
            <div id="droite">
<!-- Tableau 1 -->
                <div class="tableau">
                    <table>
                        <tr>
                            <th class="th1">Servers</th>
                            <td class="td1"><?php echo $servers; ?></td>
                        </tr>
                        <tr>
                            <th class="th12">Servers without Players</th>
                            <td class="td1"><?php echo $empty; ?></td>
                        </tr>
                        <tr>
                            <th class="th1">Servers with Players</th>
                            <td class="td1"><?php echo $un+$deux; ?></td>
                        </tr>
                        <tr>
                            <th class="th12">Player(s)</th>
                            <td class="td1"> <?php echo $players; ?></td>
                        </tr>
                        <tr>
                            <th class="th1">Bot(s)</th>
                            <td class="td1"><?php echo $bots; ?></td>
                        </tr>

                    </table>
                </div>
<!-- Tableau 2 Pays -->
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr2">
                                <th class='th2'>Country</th>
                                <th class='th2'>Server(s)</th>
                                <th class='th2'>Player(s)</th>
                                <th class='th2'>Bot(s)</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
sort($listpays);
for ($numero = 0; $numero < count($listpays); $numero++)
{
    $paysdb = $listpays[$numero];

    $reponse = $bdd->query("SELECT players, bots FROM servers WHERE pays='".$paysdb."'");

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row['players'];
        $nbots = $nbots + $row['bots'];

    }
    $reponse->closeCursor();
?>
                            <tr class="tr1">
<?php
    if ($paysdb) {
?>
                                <td class="td5"><a href='#'><img src='flags/<?php echo strtolower($paysdb).".png"; ?>' title='<?php echo $arraypays[$paysdb]; ?>'/></a></td>
<?php
    }
    else {
?>
                                <td class="td2"> </td>
<?php
    }
?>
                                <td class="td2"> <?php echo $ns; ?></td>
                                <td class="td2"> <?php echo $nplayers; ?></td>
                                <td class="td2"> <?php echo $nbots; ?></td>
                            </tr>
<?php
}
?>
                         </tbody>
                    </table>

                </div>
<!-- Tableau 3 versions -->
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr3">
                                <th class='th2'>Version</th>
                                <th class='th2'>Server(s)</th>
                                <th class='th2'>Player(s)</th>
                                <th class='th2'>Bot(s)</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
for ($numero = 0; $numero < count($listversion); $numero++)
{
    $versiondb = $listversion[$numero];

    $reponse = $bdd->query("SELECT players, bots FROM servers WHERE version='".$versiondb."'");

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = $reponse->fetch()){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row['players'];
        $nbots = $nbots + $row['bots'];

    }
    $reponse->closeCursor();
?>
                            <tr class="tr1">
                                <td class="td7"> <?php echo $versiondb; ?></td>
                                <td class="td2"> <?php echo $ns; ?></td>
                                <td class="td2"> <?php echo $nplayers; ?></td>
                                <td class="td2"> <?php echo $nbots; ?></td>
                            </tr>
<?php
}
?>
                        </tbody>
                    </table>
                </div>
<!-- Tableau 4 gametypes -->
                <div class="tableau">
                    <table>
                        <thead>
                            <tr class="tr4">
                               <th class='th2'>GameType</th>
                               <th class='th2'>Server(s)</th>
                               <th class='th2'>Player(s)</th>
                               <th class='th2'>Bot(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr1">
                                <td class="td7">FFA</td>
                                <td class="td2"> <?php echo $ffa; ?></td>
                                <td class="td2"> <?php echo $pffa; ?></td>
                                <td class="td2"> <?php echo $bffa; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">LMS</td>
                                <td class="td2"> <?php echo $lms; ?></td>
                                <td class="td2"> <?php echo $plms; ?></td>
                                <td class="td2"> <?php echo $blms; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">TDM</td>
                                <td class="td2"> <?php echo $tdm; ?></td>
                                <td class="td2"> <?php echo $ptdm; ?></td>
                                <td class="td2"> <?php echo $btdm; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">TS</td>
                                <td class="td2"> <?php echo $ts; ?></td>
                                <td class="td2"> <?php echo $pts; ?></td>
                                <td class="td2"> <?php echo $bts; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">FTL</td>
                                <td class="td2"> <?php echo $ftl; ?></td>
                                <td class="td2"> <?php echo $pftl; ?></td>
                                <td class="td2"> <?php echo $bftl; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">CandH</td>
                                <td class="td2"> <?php echo $candh; ?></td>
                                <td class="td2"> <?php echo $pcandh; ?></td>
                                <td class="td2"> <?php echo $bcandh; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">CTF</td>
                                <td class="td2"> <?php echo $ctf; ?></td>
                                <td class="td2"> <?php echo $pctf; ?></td>
                                <td class="td2"> <?php echo $bctf; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Bomb</td>
                                <td class="td2"> <?php echo $bomb; ?></td>
                                <td class="td2"> <?php echo $pbomb; ?></td>
                                <td class="td2"> <?php echo $bbomb; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Jump</td>
                                <td class="td2"> <?php echo $jump; ?></td>
                                <td class="td2"> <?php echo $pjump; ?></td>
                                <td class="td2"> <?php echo $bjump; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Freeze</td>
                                <td class="td2"> <?php echo $freeze; ?></td>
                                <td class="td2"> <?php echo $pfreeze; ?></td>
                                <td class="td2"> <?php echo $bfreeze; ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">GunGame</td>
                                <td class="td2"> <?php echo $gungame; ?></td>
                                <td class="td2"> <?php echo $pgungame; ?></td>
                                <td class="td2"> <?php echo $bgungame; ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
<!-- Tableau 5 servers  -->
            <div id="gauche">

<?php
$reponse = $bdd->query("SELECT * FROM servers order by version desc, players desc");
?>
                <table>
                    <thead>
                        <tr class="tr5">
                            <th class='th2'>Version</th>
                            <th class='th2'> </th>
                            <th class='th_server'>Server</th>
                            <th class='th2'>Address</th>
                            <th class='th2'>Gametype</th>
                            <th class='th2'>Player(s)</th>
                            <th class='th2'>Bot(s)</th>
                            <th class='th2'>Slots</th>
                            <th class='th2'>Update</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
while($row=$reponse->fetch()){
    $ip = explode(":", $row['adresse']);
    $pays = $row['pays'];
?>
                        <tr class="tr1">
                            <td class="td3"> <?php echo $row['version']; ?></td>
<?php
    if ($pays) {
?>
                            <td class="td6"><a href='#'><img src='flags/<?php echo strtolower($pays).".png"; ?>' title='<?php echo $arraypays[$pays]; ?>'/></a></td>
<?php
    }
    else {
?>
                            <td class="td3"> </td>
<?php
    }
?>
                            <td class="td7"> <?php echo $row['name']; ?></td>
                            <td class="td3"> <?php echo $row['adresse']; ?></td>
                            <td class="td3"> <?php echo $row['gametype']; ?></td>
                            <td class="td4"> <?php echo $row['players']; ?></td>
                            <td class="td4"> <?php echo $row['bots']; ?></td>
                            <td class="td4"> <?php echo $row['slots']; ?></td>
                            <td class="td4"> <?php echo date('H:i',$row['date']); ?></td>
                        </tr>
<?php
}
$reponse->closeCursor();
?>
                    </tbody>
                </table>
            </div>
<!--                                                                                                                                                  -->
<?php
$reponse->closeCursor();
?>
        </div>
        <footer>
            <div class="bas-page">
                <span style ="color:green;">P</span><span style="color: #000;">tit</span><span style ="color:green;">B</span><span style="color: #000;">igorneau</span> © 2018 <a href="https://ptitbigorneau.fr">ptitbigorneau.fr</a>
            </div>
        </footer>
        <script src="js/javascript.js"></script>
    </body>

</html>
