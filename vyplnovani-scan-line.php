<?php

require_once('fce.php');
$pic = vytvorObrazek();

//nastaveni barvy
$barva = array();
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255, 255, 255);
$barva["zelena"] = ImageColorAllocate ($pic, 34, 177, 76);
$barva["cervena"] = ImageColorAllocate ($pic, 255, 0, 0);


//souradnice uplneho lomenne cary
$bodX = array(50,70,50,10,50);
$bodY = array(2,50,30,50,2);

$velikostPole = sizeof($bodyY);

//hranice
//zapis obecne primky
sort($bodY); //Seradime od min po max hodnotu
$min=$bodY[0];
$max=$bodY[4];

$bodX = array(50,70,50,10,50);
$bodY = array(2,50,30,50,2);



for($i=0; $i<4; $i++) {
	$tmp = $i+1;
	$zx[$i]=$bodX[$i];
	$zy[$i]=$bodY[$i];
	$kx[$i]=$bodX[$tmp];
	$ky[$i]=$bodY[$tmp];



/*
//uplna lomenna cara
	$xp=$zy-$ky;
	$yp=$kx-$zx;
	$cp=$zx*$ky-$kx*$zy;
	
	if ($zy > $ky){
		$apom=$zy;
		$zy=$ky;
		$ky=$apom;
	}
*/

	$xp[$i] = $zy[$i]-$ky[$i];
	$yp[$i] = $kx[$i]-$zx[$i];
	$cp[$i] = $zx[$i]*$ky[$i]-$kx[$i]*$zy[$i];

	if ($zy[$i] > $ky[$i]) {
		$apom	= $zy[$i];
		$zy[$i]	= $ky[$i];
		$ky[$i]	= $apom;
	}
}
	

for($y=$min; $y<$max; $y++) {
	
	$pocet=0;
	
	for($a=0;$a<4;$a++) {
		if ( $y> $zy[$a]-1 and $y<$ky[$a]+1) {
			//for($y=2;$y<15;$y++){
			$pom=0-($yp[$a]*$y);
			$x[$a]=ceil(($pom - $cp[$a])/$xp[$a]);
 			$pocet++;
		} else {
			$x[$a]=1000;
		}
	}


	if($pocet<>1) {
		if($pocet==4) {
			sort($x);
			
			if($x[0]<>$x[1]) {
				nakresliUseckuBres($x[0],$y,$x[1],$y,$barva["cervena"]);
				nakresliUseckuBres($x[2],$y,$x[3],$y,$barva["cervena"]);
			} else {
				nakresliUseckuBres($x[0],$y,$x[3],$y,$barva["cervena"]);
			}
	
		} else {
			
			if($pocet==3) {
				sort($x);
				nakresliUseckuBres($x[0],$y,$x[2],$y,$barva["cervena"]);
			} else {
				if ($pocet==2) {
					sort($x);
					nakresliUseckuBres($x[0],$y,$x[1],$y,$barva["cervena"]);
				}
			}
		}
	
	}//if
}//for






       

ImagePNG ($pic);
imagedestroy($pic);



?>