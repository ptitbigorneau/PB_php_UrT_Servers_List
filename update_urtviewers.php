<?php
session_start();
include 'bd_viewers.php';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$urtviewer = '
    <div class="blocknameserver">'.$sv_hostname.'</div>
        <div class="blockinfoserver" style="background-image: url(\'images/levelshots/'.$mapjpg.'\');">
            <div class="infoserver">
                <img src="flags/'.strtolower($pays).'.png" title="'.$arraypays[$pays].'" width="18" align="top"/><span class="country"> '.$arraypays[$pays].'</span>
                <table>
                    <tr>
                        <th class="vth1">Address</th>
                        <td class="vtd1"> : '.$address.'</td>
                    </tr>
                    <tr>
                        <th class="vth1">GameType</th>
                        <td class="vtd1"> : '.$gametype.'</td>
                    </tr>
                    <tr>
                        <th class="vth1">Map</th>
                        <td class="vtd1"> : '.$map.'</td>
                    </tr>
                    <tr>
                        <th class="vth1">Players</th>
                        <td class="vtd1">'; 
                        if ($nbots > 0) {
                            $urtviewer = $urtviewer.': '.$nplayers.' + '.$nbots.' '.$tbots;
                        }
                        else { $urtviewer = $urtviewer.': '.$nplayers; }
$urtviewer = $urtviewer.'
                        </td>
                    </tr>
                    <tr>
                        <th class="vth1">Slots</th>
                        <td class="vtd1">';
                        if ($privateslots > 0) {
                            $urtviewer = $urtviewer.': '.$slots.' &#40; '.$privateslots.' &#41';
                        }
                        else { $urtviewer = $urtviewer.': '.$slots; }
$urtviewer = $urtviewer.'
                        </td>
                    </tr>
                    <tr class="vtr-vide"><td></td></tr>
                    <tr>
                        <th class="vth1">Version</th>
                        <td class="vtd1">: '.$modversion.'</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="blockplayers">
            <div class="online_players">';
            if ($nplayers + $nbots == 0){
                $urtviewer = $urtviewer.'<div class="noplayers">No players on this server !</div>';
            }
            else {
$urtviewer = $urtviewer.'
                <table>
                    <thead>
                        <tr class="vtr1">
                            <th class="vth2">Player</th>
                            <th class="vth3">Score</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($playerslist as $playerdata) {
                        $playerdata = explode(" ", $playerdata);
                        $name = clean_and_colors('^7'. $playerdata[1]);
                        $score = $playerdata[0];
$urtviewer = $urtviewer.'
                        <tr class="vtr2">
                            <td class="vtd2">'.$name.'</td>
                            <td class="vtd3">'.$score.'</td>
                        </tr>';
                    }
$urtviewer = $urtviewer.'</tbody></table>';

                        }
$urtviewer = $urtviewer.'</div></div>';

echo $urtviewer;
?>
