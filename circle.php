<?php
$rozmerObrazku['x'] = 300;
$rozmerObrazku['y'] = 50;

 //nastaveni barvy
$cerna	= ImageColorAllocate ($pic, 0, 0, 0);
$bila	= ImageColorAllocate($pic, 255,255,255);


//BEZ KOMPRESE
header("Content-type: image/png");

$pic = ImageCreate ($rozmerObrazku['x'],$rozmerObrazku['y']); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

//vysledek
ImagePNG ($pic,'circle.png'); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet




//nacteni obrazku

//vypis puvodnich hodnot

//vypis po RLE kompresi



?>