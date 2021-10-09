<?php
 
require_once('fce.php');
$pic = vytvorObrazek();

//nastaveni barvy
$barva = array();
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255, 255, 255);
$barva["zelena"] = ImageColorAllocate ($pic, 34, 177, 76);	// Orezove okno
$barva["cervena"] = ImageColorAllocate ($pic, 255, 0, 0);	// Opetovne vykresleni
$barva["modra"] = ImageColorAllocate($pic,0,0,255);



// levyS, pravyS, pravy bod, levy bod
$bodX= array(0,200,250,25);
$bodY= array(0,00,200,50);


$pocetBodu=3;
$krok=0.5; //cim mensi, tim lepsi rastrovani

$zx=$bodX[1];
$zy=$bodY[1];

if ($pocetBodu>2) {
	$n=$pocetBodu-1;
	$t=0; // parametr smeru
 	
	while ($t < 1) {
		$x=0;
		$y=0;
 		
 		for ($i=1;$i<$pocetBodu;$i++){
			
 			//berstainuv polynom
 			$iMin = $i-1;
 			$nIMin = $n-$iMin;
			$bp=((faktorial($n)/faktorial($nIMin))/faktorial($iMin))*pow($t,$iMin)*pow(1-$t,$nIMin);
 			
			// vynasobeni bodu berstainovym polynomem
			$x=ceil($x + ($bodX[$i]*$bp));
			$y=ceil($y + ($bodY[$i]*$bp));
 		}
 		
 		//vykresleni krivky
 		imageLine($pic,$zx,$zy,$x,$y,$barva["cerna"]);
 		
 		$zx=$x;
 		$zy=$y;
 		$t=$t + $krok;
 	}
 	
 	imageLine($pic,$zx,$zy,$bodX[$pocetBodu],$bodY[$pocetBodu],$barva["cerna"]);
 		
 	//vedeni		
 	for ($a=0;$a<4;$a++) {
 		imageLine($pic,$bodX[$a],$bodY[$a],$bodX[$a+1],$bodY[$a+1],$barva["modra"]);
 	}
 	
} else {
	imageLine($pic,$bodX[0],$bodY[0],$bodX[$pocetBodu],$bodY[$pocetBodu],$barva["cerna"]);
}
 	
 	
ImagePNG ($pic);
imagedestroy($pic);



?>