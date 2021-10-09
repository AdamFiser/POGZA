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
	if($zacatekX > $konecX) {
		nakresliUsecku($konecX,$konecY,$zacatekX,$zacatekY);
	}
	
	$pozice	= $zacatekY; //prirustek
	$smernice	= ($konecY - $zacatekY)/($konecX-$zacatekX);
	
	//  Pokud ma smernice mensi sklon nez 45 stupnu k ose x, je osa x ridici
 	if(abs($smernice) <= 1) {
 		
 		for($i=$zacatekX; $i <= $konecX; $i++) {
 			ImageSetPixel($pic, round($pozice), $i, $barva["cerna"]); //Zobrazeni pixelu
 			/*echo "pozice: ".round($pozice);
 			echo " i: ".$i;
 			echo "<br>";*/
 			$pozice = $pozice + $smernice;
 		}
 		
 	} else {
 		nakresliSvislouUsecku($zacatekX,$zacatekY,$konecX,$konecY);
 	}

}


function nakresliSvislouUsecku($zacatekX,$zacatekY,$konecX,$konecY) {
	global $pic;
	global $barva;
	//pokud je zacatek na pravo od konce, prohodime 
	if($zacatekX > $konecX) {
		nakresliSvislouUsecku($konecX,$konecY,$zacatekX,$zacatekY);
	}
	
	$pozice	= $zacatekY; //prirustek
	$smernice	= ($konecX - $zacatekX)/($konecY-$zacatekY);
	
	//  Pokud ma smernice mensi sklon nez 45 stupnu k ose x, je osa x ridici
	for($i=$zacatekY; $i <= $konecY; $i++) {
 		ImageSetPixel($pic, round($pozice), $i, $barva["cerna"]); //Zobrazeni pixelu
 		/*echo "pozice: ".$pozice;
 		echo " i: ".$i;
 		echo "<br>";*/
 		$pozice = $pozice + $smernice;
 	}
	
}



//pouziti

$zacatek["x"] = 5;
$zacatek["y"] = 15;
$konec["x"] = 80;
$konec["y"] = 80;

nakresliUsecku($zacatek["x"],$zacatek["y"],$konec["x"],$konec["y"]);
nakresliUsecku(15,5,20,80);
nakresliUsecku(150,50,120,100);


//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet

?>