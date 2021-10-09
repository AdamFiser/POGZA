<?php

require_once('class.color.php');

if ( empty($x) )
    $x = 10;
$number = $x;
echo '
<html>
<head><title>Color Class Test</title></head>
<body bgcolor="white">
	<h1 align="center">Pøíklady použití tøídy Image_color projektu wasysIS</h1>
    <table cellspacing="0" cellpadding="2" width="400" border="0" align="center">
    <caption><b>Barevny pøechod: FF0000 na 0000FF s zmìnou odstinu (HUE)</b></caption>
';

$color = new Image_Color;

//Porovnavame bilou a cervenou
$color->setColors("FFFFFF", "F28580");

echo "\t\t</tr>\n";
//$i = 1;

//bila - cervena
for ($x = 1; $x <= 25; $x++ ) {
	$colors = $color->getRange($number);
	echo "\t\t<tr>\n";
	
	foreach ( $colors as $key => $col ) {
		echo "\t\t\t".'<td bgcolor="'.$col.'"><font color="#'.Image_Color::getTextColor($col).'">'.$col.'</font></td>'."\n";
		$i++;
    }
    echo "\t\t</tr>\n";
	
    //Zmena odstinu o -10 stupnu (- = ztmaveni)
    $color->changeHue(-10);
}

//cervena - cerna
$color->setWebSafe();
$color->setColors("FF0000", "0000FF");

echo '<tr><td colspan="'.$number.'">Zapnuto ColorSafety</td></tr>';

for ( $x = 1; $x <= 25; $x++ ) {
	$colors = $color->getRange($number);
	echo "\t\t<tr>\n";
    
	foreach ( $colors as $key => $col ) {
		echo "\t\t\t".'<td bgcolor="'.$col.'"><font color="#'.Image_Color::getTextColor($col).'">'.$col.'</font></td>'."\n";  $i++;
    }
    
    echo "\t\t</tr>\n";
    
    $color->changeHue(-10);
}


$bgcolor = $color->mixColors('336699', 'ffffff');
echo '
    </table>
    
    <table cellspacing="0" cellpadding="2" width="400" height="50" border="1" align="center">
    <caption><b>Color Mix dvou barev: 336699 a FFFFFF Web Safe</b></caption>
    <tr>
        <td bgcolor="#336699">336699</td>
    </tr>
    <tr>
        <td bgcolor="#'.$bgcolor.'"><font color="#'.Image_Color::getTextColor($bgcolor).'">'.$bgcolor.'</font></td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF">FFFFFF</td>
    </tr>
    </table>
    ';
    
$color->setWebSafe(false);
$bgcolor = $color->mixColors('336699', 'ffffff');
echo '
    </table>
    
    <table cellspacing="0" cellpadding="2" width="400" height="50" border="1" align="center">
	<caption><b>Color Mix dvou barev: 336699 a FFFFFF Web Safe = false</b></caption>  <tr>
        <td bgcolor="#336699">336699</td>
    </tr>
    <tr>
        <td bgcolor="#'.$bgcolor.'"><font color="#'.Image_Color::getTextColor($bgcolor).'">'.$bgcolor.'</font></td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF">FFFFFF</td>
    </tr>
    </table>
    ';

$rgb = Image_Color::hex2rgb("336699");
echo "<h1>hex2rgb()</h1>";
echo '<pre>';
print_r($rgb);
echo '</pre>';

$rgb = Image_Color::rgb2hex($rgb);
echo "<h1>rgb2hex()</h1>";
echo '<pre>';
print_r($rgb);
echo '</pre>';

    echo '
</body>
</html>
';

?>