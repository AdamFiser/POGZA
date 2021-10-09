<?php

header("Content-type: image/png");

$pic = ImageCreate (300,60);

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadí

$barva["cerna"] = ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255,255,255);

 

$matice[] = array(1,13,4,16);
$matice[] = array(9,5,12,8);
$matice[] = array(3,15,2,14);
$matice[] = array(11,7,10,6);

$rozmer["x"] 	= sizeof($matice[0]);
$rozmer["y"] 	= sizeof($matice);
$odstin 		= 0;

for ($i=0; $i < ($rozmer["x"]*$rozmer["y"]); $i++) {
	for($x=0; $x<$rozmer["x"]; $x++){
	    for($y=0; $y<$rozmer["y"]; $y++){
			if($matice[$x][$y] <= $odstin) {
		        ImageSetPixel ($pic, $x+$posun, $y, $barva["cerna"]);
			}
	    }
	}
	
	$posun = $posun + $rozmer["x"];
	$odstin++;
}
ImagePNG ($pic); //zobrazime obrazek
ImageDestroy($pic); //uvolnime pamet

?> 