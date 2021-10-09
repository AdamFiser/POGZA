<?php

/*
begin
	for každý pixel obrazovky do
		begin
			Pixel(x,y).Barva:=Barva pozadí;
			Pixel(x,y).Hloubka := Maximální hloubka {- Z-buffer }
		end;
	for každý plát do
		for každý vnitøní pixel(x,y) promítnutého plátu do
			begin
				Nová hloubka := Hloubka plátu v místì pixelu(x,y);
				Nová barva:= Barva plátu v místì pixelu(x,y);
				if Pixel(x,y).Hloubka >= Nová hloubka then
					begin
						Pixel[x,y].Barva:=Nová barva;
						Pixel[x,y].Hloubka:=Nová hloubka
					end
			end
end;

koule (x0-xs)^2 + k^2 + (z0-zs)^2 - r^2 = 0
*/

require_once('fce.php');
$pic = vytvorObrazek();
$n = 300; //velikost pic

//nastaveni barvy
$barva = array();
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255, 255, 255);
$barva["zelena"] = ImageColorAllocate ($pic, 34, 177, 76);
$barva["cervena"] = ImageColorAllocate ($pic, 255, 0, 0);
$barva["oranzova"] = ImageColorAllocate ($pic, 255, 125, 0);

$aKoule = array('a','b','c');

//Pozice
$pozice["a"]["rx"] = 50;
$pozice["a"]["ry"] = 60;
$pozice["a"]["rz"] = 60;

$pozice["b"]["rx"] = 100;
$pozice["b"]["ry"] = 60;
$pozice["b"]["rz"] = 15;
/*
$pozice["c"]["rx"] = 75;
$pozice["c"]["ry"] = 100;
$pozice["c"]["rz"] = 30;
*/
//polomer
$koule["a"]["r"]	= 2500;
$koule["b"]["r"]	= 2500;
//$koule["c"]["r"]	= 2500;

//barvy
$koule["a"]["barva"]	= $barva["zelena"];
$koule["b"]["barva"]	= $barva["cervena"];
//$koule["c"]["barva"]	= $barva["oranzova"];

//output
$kouleOut = array();



for ($y=1; $y<$n; $y++) {
	for ($x=1 ;$x<$n; $x++) {
		
		foreach($aKoule as $k => $v) {
			//Vypocet kvadratickych ploch
			$kvadratPlocha[$v] = $koule[$v]["r"] - pow($x-$pozice[$v]["rx"],2) - pow($y-$pozice[$v]["ry"],2);
			
			//Vypocet nove hloubky (z) pro vsechny koule
			if($kvadratPlocha[$v]>0){
				$kouleOut[$v]["z"] = sqrt($kvadratPlocha[$v]) + $pozice[$v]["rz"];
			}
		}
		
		foreach($aKoule as $k => $v) {
			//vykresleni dle porovnane hloubky
			if ($kouleOut[$v]["z"] < $kouleOut[$k]["z"]) {
				imagesetpixel($pic,$x,$y,$koule[$v]["barva"]);
			}
		}
		
		//Urceni barvy viditelne koule
		if ($kouleOut["a"]["z"] < $kouleOut["b"]["z"]) {
			imagesetpixel($pic,$x,$y,$koule["a"]["barva"]);
			
		} elseif ($kouleOut["a"]["z"] > $kouleOut["b"]["z"]) {
			imagesetpixel($pic,$x,$y,$koule["b"]["barva"]);
		}
		
		foreach($aKoule as $k => $v) {
			$kouleOut[$v]["z"]=0;
		}
		
	}
}
 	
ImagePNG ($pic);
imagedestroy($pic);


?>