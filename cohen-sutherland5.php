<?php


$okno["zacatek"]["x"] 	=100 ;
$okno["zacatek"]["y"] 	=50 ;
$okno["konec"]["x"] 	= 200;
$okno["konec"]["y"] 	= 150;


$usecka["zacatek"]["x"]	= 100;
$usecka["zacatek"]["y"]	= 50;
$usecka["konec"]["x"]	= 200;
$usecka["konec"]["y"]	= 150;


header("Content-type: image/png");

$pic = ImageCreate (300,300);

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadí

$barva["cerna"] = ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255,255,255);




//Vykresleni okna
function nakresliUsecku($zacatekX,$zacatekY,$konecX,$konecY) {
	global $pic;
	global $barva;
	
	//pokud je zacatek na pravo od konce, prohodime 
	if(($zacatekX - $konecX) > 0) {
		nakresliUsecku($konecX,$konecY,$zacatekX,$zacatekY);
	}
	
	//sklon usecky
	if(abs($konecY - $zacatekY) > abs($konecX - $zacatekX)) {
		// ano - usecka svira s y mensi uhel nez 45
		kresli($zacatekY,$zacatekX,$konecY,$konecX);
	}
	
	
	//tmp
	$x 		= $zacatekX;
	$y 		= $zacatekY;
	$rozdil 	= $konecX-$zacatekX;
	$rozdil2 	= $konecX-$zacatekX; //pouze pro podminku foru, at nemusime stale pocitat
	$dx 	= 2*($konecX-$zacatekX);
	$dy 	= abs(2*($konecY-$zacatekY));
	 
	//plusDy
	if(($konecY - $zacatekY) > 0) {
		$plusDy = 1;
	} else {
		$plusDy = -1;
	}
	
	
	//vykresli usecku
	for ($i = 0; $i <= $rozdil2; $i++) {
		ImageSetPixel($pic, $x, $y, $barva["cerna"]); //Zobrazeni pixelu
 		$x++;
		$rozdil = $rozdil - $dy;
		
		if ($rozdil < 0) {
			$y = $y + $plusDy;
			$rozdil = $rozdil + $dx;
		}
	}
			
 }
	
	
 
 
function kresli($zacatekX,$zacatekY,$konecX,$konecY) {
	global $pic;
	global $barva;
	
	//pokud je zacatek na pravo od konce, prohodime 
	if(($zacatekX - $konecX) > 0) {
		kresli($konecX, $konecY, $zacatekX, $zacatekY);
	}

	$x 		= $zacatekX;
	$y 		= $zacatekY;
	$rozdil 	= $konecX-$zacatekX;
	$rozdil2 	= $konecX-$zacatekX; //pouze pro podminku foru, at nemusime stale pocitat
	$dx 	= 2*($konecX-$zacatekX);
	$dy 	= abs(2*($konecY-$zacatekY));
	
	//plusDy
	if(($konecY - $zacatekY) > 0) {
		$plusDy = 1;
	} else {
		$plusDy = -1;
	}
	
	//vykresli usecku
	for ($i = 0; $i <= $rozdil2; $i++) {
		ImageSetPixel($pic, $x, $y, $barva["cerna"]); //Zobrazeni pixelu
 		$x++;
		$rozdil = $rozdil - $dy;
		
		if ($rozdil < 0) {
			$y = $y + $plusDy;
			$rozdil = $rozdil + $dx;
		}
	}
}
ImageRectangle ($pic, $okno["zacatek"]["x"],$okno["zacatek"]["y"],$okno["konec"]["x"],$okno["konec"]["y"], $barva["cerna"]);



function kodBodu($x,$y) {
	return "0";
}

//prirazeni kodu bodum
$kodBoduA = $kodBodu($usecka["zacatek"]["x"],$usecka["zacatek"]["y"]);
$kodBoduB = $kodBodu($usecka["konec"]["x"],$usecka["konec"]["y"]);

//Je-li cela usecka uvnitr
if()

ImagePNG ($pic); //zobrazime obrazek
ImageDestroy($pic); //uvolnime pamet

?>