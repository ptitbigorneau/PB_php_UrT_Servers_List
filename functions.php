<?php
include 'pays.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$config = parse_ini_file('config/config.ini', false);

$dbhost = $config['host'];
$dbuser = $config['user'];
$dbpassword = $config['password'];
$dbname = $config['name'];
$style = $config['style'];

if (!file_exists($style)) {
    $style = "css/light-style.css";
}

$listpays = array();
$listgametype = array('FFA' => array(), 'LMS' => array(), 'TDM' => array(), 'TS' => array(), 'FTL' => array(), 'CandH' => array(), 'CTF' => array(), 'Bomb' => array(), 'Jump' => array(), 'Freeze' => array(), 'GunGame' => array());

$bdd = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser, $dbpassword);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UrT Liste Maps
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$dirname = 'images/levelshots/';
$dir = opendir($dirname);
$list = "";

while($file = readdir($dir)) {
    if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
        $list =  $list . " " . $file;
    }
}
closedir($dir);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UrT Name Gametype
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function name_gametype ( $n ) {
    if ($n == 0) {$gametype=array("FFA", "Free For All");}
    elseif ($n == 1) {$gametype=array("LMS", "Last Man Standing");}
    elseif ($n == 3) {$gametype=array("TDM", "Team DeathMatch");}
    elseif ($n == 4) {$gametype=array("TS", "Team Survivor");}
    elseif ($n == 5) {$gametype=array("FTL", "Follow The Leader");}
    elseif ($n == 6) {$gametype=array("CandH", "Capture And Hold");}
    elseif ($n == 7) {$gametype=array("CTF", "Capture The Flags");}
    elseif ($n == 8) {$gametype=array("Bomb", "Bomb Mode");}
    elseif ($n == 9) {$gametype=array("Jump", "Jump Mode");}
    elseif ($n == 10) {$gametype=array("Freeze", "Freeze Tag");}
    elseif ($n == 11) {$gametype=array("GunGame", "GunGame");}
    else {$gametype=array("","unknown");}
    
    return $gametype;
}
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
?>