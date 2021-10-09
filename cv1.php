<?php

header("Content-type: image/png");

$rozmerObrazku['x'] = 300;
$rozmerObrazku['y'] = 50;

$pic = ImageCreate ($rozmerObrazku['x'],$rozmerObrazku['y']); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

 //nastaveni barvy
$cerna	= ImageColorAllocate ($pic, 0, 0, 0);
$bila	= ImageColorAllocate($pic, 255,255,255);


for($x=0; $x < $rozmerObrazku['x']; $x++) {
	for($y=0; $y < $rozmerObrazku['y']; $y++) {
		
		//$intenzita[$x][$y] = rand(0,255);
		
		if($x > rand(0,$rozmerObrazku['x'])) {
			ImageSetPixel ($pic, $x, $y, $cerna);
		} else {
			ImageSetPixel ($pic, $x, $y, $bila);
		}
		
	}
}

//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet

?>