<?php

require_once('fce.php');
$pic = vytvorObrazek();

//nastaveni barvy
$barva = array();
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255, 255, 255);
$barva["zelena"] = ImageColorAllocate ($pic, 34, 177, 76);	// Orezove okno
$barva["cervena"] = ImageColorAllocate ($pic, 255, 0, 0);	// Opetovne vykresleni



//souradnice uplneho lomenne cary
$bodX = array(60,30,70,10,60);
$bodY = array(2,30,50,30,2);

//hranice
//zapis obecne primky


for($i=0;$i<4;$i++) {
	$tmp = $i+1;
	$zx=$bodX[$i];
	$zy=$bodY[$i];
	$kx=$bodX[$tmp];
	$ky=$bodY[$tmp];

	//uplna lomenna cara
	$xp=$zy-$ky;
	$yp=$kx-$zx;
	$cp=$zx*$ky-$kx*$zy;
	
	if ($zy > $ky){
		$apom=$zy;
		$zy=$ky;
		$ky=$apom;
	}
	

	for($y=$zy;$y<$ky;$y++) {
		$pom=0-($yp*$y);
		$x=ceil(($pom - $cp)/$xp);

		//vykresleni usecky
		nakresliUseckuBres($x,$y,164,$y,$barva["cerna"]);
	}

}
       

ImagePNG ($pic);
imagedestroy($pic);
?>

