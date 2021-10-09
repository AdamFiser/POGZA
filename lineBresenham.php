<?php




header("Content-type: image/png");

$rozmerObrazku['x'] = 300;
$rozmerObrazku['y'] = 300;

$pic = ImageCreate ($rozmerObrazku['x'],$rozmerObrazku['y']); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

 //nastaveni barvy
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255,255,255);


//deklarace funkci

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



//pouziti

$zacatek["x"] = 5;
$zacatek["y"] = 15;
$konec["x"] = 200;
$konec["y"] = 20;

nakresliUsecku($zacatek["x"],$zacatek["y"],$konec["x"],$konec["y"]);


//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet

?>