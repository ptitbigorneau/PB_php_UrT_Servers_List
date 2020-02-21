<?php
session_start();
include 'bd_viewers.php';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
    <html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="<?php echo $style;?>" />
            <title>PtitBigorneau - Servers Urban Terror</title>
        </head>
    <body>
        <div id="viewer">
            <div class="returnlist"><a href="./" >&#139;&#139;&#139; Servers List </a></div>
            <div id="blockviewer">
                <div class="blocknameserver"><?php echo $sv_hostname;?></div>
                <div class="blockinfoserver" style="background-image: url('images/levelshots/<?php echo $mapjpg;?>');">
                <div class="infoserver">
                    <img src="flags/<?php echo strtolower($pays).'.png';?>"; " title="<?php echo $arraypays[$pays];?>" width="18" align="top"/><span class="country"> <?php echo $arraypays[$pays];?></span>
                    <table>
                        <tr>
                            <th class="vth1">Address</th>
                            <td class="vtd1"><?php echo ': '.$address;?></td>
                        </tr>
                        <tr>
                            <th class="vth1">GameType</th>
                            <td class="vtd1"><?php echo ': '.$gametype;?></td>
                        </tr>
                        <tr>
                            <th class="vth1">Map</th>
                            <td class="vtd1"><?php echo ': '.$map;?></td>
                        </tr>
                        <tr>
                            <th class="vth1">Players</th>
                            <td class="vtd1"><?php 
                                if ($nbots > 0) {
                                    echo ': '.$nplayers.' + '.$nbots.' '.$tbots;
                                }
                                else { echo ': '.$nplayers; }
                            ?></td>
                        </tr>
                        <tr>
                            <th class="vth1">Slots</th>
                            <td class="vtd1"><?php
                                if ($privateslots > 0) {
                                    echo ': '.$slots.' &#40; '.$privateslots.' &#41';
                                }
                                else { echo ': '.$slots; }
                            ?></td>
                        </tr>
                        <tr class="vtr-vide"><td></td></tr>
                        <tr>
                            <th class="vth1">Version</th>
                            <td class="vtd1"><?php echo ': '.$modversion;?></td>
                        </tr>
                    </table>
                </div>
                </div>
                <div class="blockplayers">
                    <div class="online_players">
                        <?php
                        if ($nplayers + $nbots == 0){
                        ?>   
                        <div class="noplayers">No players on this server !</div>
                        <?php
                        }
                        else {
                        ?>
                        <table>
                            <thead>
                                <tr class="vtr1">
                                    <th class="vth2">Player</th>
                                    <th class="vth3">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php    
                            foreach ($playerslist as $playerdata) {
                                $playerdata = explode(" ", $playerdata);
                                $name = clean_and_colors('^7'. $playerdata[1]);
                                $score = $playerdata[0];
                            ?>
                            <tr class="vtr2">
                                <td class="vtd2"><?php echo $name;?></td>
                                <td class="vtd3"><?php echo $score;?></td>
                            </tr>
                            <?php                            
                            }
                        ?>
                            </tbody>   
                        </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div id="bas-page">
                <span style ="color:green;">P</span><span>tit</span><span style ="color:green;">B</span><span>igorneau</span> © 2020 <a href="https://ptitbigorneau.fr">ptitbigorneau.fr</a>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/urtviewers.js"></script>
    </body>

</html>