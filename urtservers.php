<?php
include 'pays.php';

$config = parse_ini_file("config/config.ini", false);

$dbhost = $config['host'];
$dbuser = $config['user'];
$dbpassword = $config['password'];
$dbname = $config['name'];

$listpays = array();

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$reponse = $mysqli->query("SELECT * FROM servers");

while($row=mysqli_fetch_array($reponse)){

    if (!in_array($row['pays'], $listpays)){

        array_push($listpays, $row['pays']);

    }
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers");

while($row=mysqli_fetch_array($reponse)){
    $servers  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE players=0");

while($row=mysqli_fetch_array($reponse)){
    $empty  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE players=1");

while($row=mysqli_fetch_array($reponse)){
    $un  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='FFA'");

while($row=mysqli_fetch_array($reponse)){
    $ffa  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='LMS'");

while($row=mysqli_fetch_array($reponse)){
    $lms  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='TDM'");

while($row=mysqli_fetch_array($reponse)){
    $tdm  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='TS'");

while($row=mysqli_fetch_array($reponse)){
    $ts  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='FTL'");

while($row=mysqli_fetch_array($reponse)){
    $ftl  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='CandH'");

while($row=mysqli_fetch_array($reponse)){
    $candh  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='CTF'");

while($row=mysqli_fetch_array($reponse)){
    $ctf  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='Bomb'");

while($row=mysqli_fetch_array($reponse)){
    $bomb  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='Jump'");

while($row=mysqli_fetch_array($reponse)){
    $jump  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='Freeze'");

while($row=mysqli_fetch_array($reponse)){
    $freeze  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT COUNT(*) FROM servers WHERE gametype='GunGame'");

while($row=mysqli_fetch_array($reponse)){
    $gungame  = $row['COUNT(*)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers");

while($row = mysqli_fetch_array($reponse)){
     $players = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers");

while($row = mysqli_fetch_array($reponse)){
     $bots = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='FFA'");

while($row=mysqli_fetch_array($reponse)){
    $pffa  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='LMS'");

while($row=mysqli_fetch_array($reponse)){
    $plms  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='TDM'");

while($row=mysqli_fetch_array($reponse)){
    $ptdm  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='TS'");

while($row=mysqli_fetch_array($reponse)){
    $pts  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='FTL'");

while($row=mysqli_fetch_array($reponse)){
    $pftl  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='CandH'");

while($row=mysqli_fetch_array($reponse)){
    $pcandh  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='CTF'");

while($row=mysqli_fetch_array($reponse)){
    $pctf  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='Bomb'");

while($row=mysqli_fetch_array($reponse)){
    $pbomb  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='Jump'");

while($row=mysqli_fetch_array($reponse)){
    $pjump  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='Freeze'");

while($row=mysqli_fetch_array($reponse)){
    $pfreeze  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(players) FROM servers WHERE gametype='GunGame'");

while($row=mysqli_fetch_array($reponse)){
    $pgungame  = $row['SUM(players)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='FFA'");

while($row=mysqli_fetch_array($reponse)){
    $bffa  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='LMS'");

while($row=mysqli_fetch_array($reponse)){
    $blms  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='TDM'");

while($row=mysqli_fetch_array($reponse)){
    $btdm  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='TS'");

while($row=mysqli_fetch_array($reponse)){
    $bts  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='FTL'");

while($row=mysqli_fetch_array($reponse)){
    $bftl  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='CandH'");

while($row=mysqli_fetch_array($reponse)){
    $bcandh  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='CTF'");

while($row=mysqli_fetch_array($reponse)){
    $bctf  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='Bomb'");

while($row=mysqli_fetch_array($reponse)){
    $bbomb  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='Jump'");

while($row=mysqli_fetch_array($reponse)){
    $bjump  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='Freeze'");

while($row=mysqli_fetch_array($reponse)){
    $bfreeze  = $row['SUM(bots)'];
}

$reponse = $mysqli->query("SELECT SUM(bots) FROM servers WHERE gametype='GunGame'");

while($row=mysqli_fetch_array($reponse)){
    $bgungame  = $row['SUM(bots)'];
}

$deux = $servers - $empty - $un;

$reponse = $mysqli->query("SELECT * FROM servers order by version desc");

$listversion = array();

while($row = mysqli_fetch_array($reponse)){

    $version = $row['version'];
    if (!in_array($version, $listversion)) {
        array_push($listversion, $version);
    }
}
?>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css" />
            <title>PtitBigorneau - Servers Urban Terror</title>
        </head>
    <body>
        <h1>Servers UrbanTerror 4.3</h1>
        <div id="contenu">
            <p id="compteur">updated :</p>
            <section id="droite">
<!--- Tableau 1 ----------------------------------------------------------------------------------------------------------------------------------->
                <article>
                    <table style='border-collapse: collapse;'>
                        <tr>
                            <th class="th1">Servers</th>
                            <td class="td1"><?php echo $servers ?></td>
                        </tr>
                        <tr>
                            <th class="th12">Servers without Players</th>
                            <td class="td1"><?php echo $empty ?></td>
                        </tr>
                        <tr>
                            <th class="th1">Servers with Players</th>
                            <td class="td1"><?php echo $un+$deux ?></td>
                        </tr>
                        <tr>
                            <th class="th12">Player(s)</th>
                            <td class="td1"> <?php echo $players ?></td>
                        </tr>
                        <tr>
                            <th class="th1">Bot(s)</th>
                            <td class="td1"><?php echo $bots ?></td>
                        </tr>

                    </table>
                </article>
<!--- Tableau 2 Pays ------------------------------------------------------------------------------------------------------------------------------>
                <article>
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

    $reponse = $mysqli->query("SELECT * FROM servers WHERE pays='".$paysdb."'");

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = mysqli_fetch_array($reponse)){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row['players'];
        $nbots = $nbots + $row['bots'];

    }
?>
                            <tr class="tr1">
<?php
    if ($paysdb) {
?>
                                <td class="td5"><a href='#'><img src='flags/<?php echo strtolower($paysdb).".png" ?>' border='0' title='<?php echo $arraypays[$paysdb] ?>'></img></a></td>
<?php
    }
    else {
?>
                                <td class="td2"> </td>
<?php
    }
?>
                                <td class="td2"> <?php echo $ns ?></td>
                                <td class="td2"> <?php echo $nplayers ?></td>
                                <td class="td2"> <?php echo $nbots ?></td>
                            </tr>
<?php
}
?>
                         </tbody>
                    </table>

                </article>
<!--- Tableau 3 versions -------------------------------------------------------------------------------------------------------------------------->
                <article>
                    <table style='border-collapse: collapse;'>
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

    $reponse = $mysqli->query("SELECT * FROM servers WHERE version='".$versiondb."'");

    $ns = 0;
    $nplayers = 0;
    $nbots = 0;

    while($row = mysqli_fetch_array($reponse)){

        $ns = $ns + 1;
        $nplayers = $nplayers + $row['players'];
        $nbots = $nbots + $row['bots'];

    }
?>
                            <tr class="tr1">
                                <td class="td7"> <?php echo $versiondb ?></td>
                                <td class="td2"> <?php echo $ns ?></td>
                                <td class="td2"> <?php echo $nplayers ?></td>
                                <td class="td2"> <?php echo $nbots ?></td>
                            </tr>
<?php
}
?>
                        </tbody>
                    </table>
                </article>
<!--- Tableau 4 gametypes ------------------------------------------------------------------------------------------------------------------------->
                <article>
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
                                <td class="td2"> <?php echo $ffa ?></td>
                                <td class="td2"> <?php echo $pffa ?></td>
                                <td class="td2"> <?php echo $bffa ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">LMS</td>
                                <td class="td2"> <?php echo $lms ?></td>
                                <td class="td2"> <?php echo $plms ?></td>
                                <td class="td2"> <?php echo $blms ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">TDM</td>
                                <td class="td2"> <?php echo $tdm ?></td>
                                <td class="td2"> <?php echo $ptdm ?></td>
                                <td class="td2"> <?php echo $btdm ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">TS</td>
                                <td class="td2"> <?php echo $ts ?></td>
                                <td class="td2"> <?php echo $pts ?></td>
                                <td class="td2"> <?php echo $bts ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">FTL</td>
                                <td class="td2"> <?php echo $ftl ?></td>
                                <td class="td2"> <?php echo $pftl ?></td>
                                <td class="td2"> <?php echo $bftl ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">CandH</td>
                                <td class="td2"> <?php echo $candh ?></td>
                                <td class="td2"> <?php echo $pcandh ?></td>
                                <td class="td2"> <?php echo $bcandh ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">CTF</td>
                                <td class="td2"> <?php echo $ctf ?></td>
                                <td class="td2"> <?php echo $pctf ?></td>
                                <td class="td2"> <?php echo $bctf ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Bomb</td>
                                <td class="td2"> <?php echo $bomb ?></td>
                                <td class="td2"> <?php echo $pbomb ?></td>
                                <td class="td2"> <?php echo $bbomb ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Jump</td>
                                <td class="td2"> <?php echo $jump ?></td>
                                <td class="td2"> <?php echo $pjump ?></td>
                                <td class="td2"> <?php echo $bjump ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">Freeze</td>
                                <td class="td2"> <?php echo $freeze ?></td>
                                <td class="td2"> <?php echo $pfreeze ?></td>
                                <td class="td2"> <?php echo $bfreeze ?></td>
                            </tr>
                            <tr class="tr1">
                                <td class="td7">GunGame</td>
                                <td class="td2"> <?php echo $gungame ?></td>
                                <td class="td2"> <?php echo $pgungame ?></td>
                                <td class="td2"> <?php echo $bgungame ?></td>
                            </tr>

                        </tbody>
                    </table>
                </article>
            </section>
<!--- Tableau 5 servers --------------------------------------------------------------------------------------------------------------------------->
            <section id="gauche">

<?php
$reponse = $mysqli->query("SELECT * FROM servers order by version desc, players desc");
?>
                <table>
                    <thead>
                        <tr class="tr5">
                            <th class='th2'>Version</th>
                            <th class='th2'> </th>
                            <th class='th2' style="width:330px;">Server</th>
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
while($row=mysqli_fetch_array($reponse)){
    $ip = explode(":", $row['adresse']);
    $pays = $row['pays'];
?>
                        <tr class="tr1">
                            <td class="td3"> <?php echo $row['version'] ?></td>
<?php
    if ($pays) {
?>
                            <td class="td6"><a href='#'><img src='flags/<?php echo strtolower($pays).".png" ?>' border='0' title='<?php echo $arraypays[$pays] ?>'></img></a></td>
<?php
    }
    else {
?>
                            <td class="td3"> </td>
<?php
    }
?>
                            <td class="td7"> <?php echo $row['name'] ?></td>
                            <td class="td3"> <?php echo $row['adresse'] ?></td>
                            <td class="td3"> <?php echo $row['gametype'] ?></td>
                            <td class="td4"> <?php echo $row['players'] ?></td>
                            <td class="td4"> <?php echo $row['bots'] ?></td>
                            <td class="td4"> <?php echo $row['slots'] ?></td>
                            <td class="td4"> <?php echo date('H:i',$row['date']) ?></td>
                        </tr>
<?php
}
?>
                    </tbody>
                </table>
            </section>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
mysqli_close();
?>
        </div>
        <footer>
            <div class="bas-page">
                <span style ="color:green;">P</span><span style="color: #000;">tit</span><span style ="color:green;">B</span><span style="color: #000;">igorneau</span> © 2018 <a href="https://ptitbigorneau.fr">ptitbigorneau.fr</a>
            </div>
        </footer>
    </body>

    <script src="js/javascript.js"></script>

</html>
