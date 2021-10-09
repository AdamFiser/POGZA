<?php


$xz=1;
$yz=1;
$xk=100;
$yk=20;

//hranice
$hrx=80;
$hry=20; 


header("Content-type: image/png");

$rozmerObrazku['x'] = 300;
$rozmerObrazku['y'] = 300;

$pic = ImageCreate ($rozmerObrazku['x'],$rozmerObrazku['y']); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

 //nastaveni barvy
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255,255,255);


if (abs($xk-$xz) > abs($yk-$yz)) { //podminka zjistujici zda je usecka ma sklon vyssi ci mensi nez 45 stupnu

$pom=($yk-$yz)/($xk-$xz); //DDA usecka
$y=$yz;

for($x=$xz; $x<$xk; $x++){
    if ($hrx< $x){$sourX=bcmod($xz+($x-$xz),$hrx-$xz); }//podminka na zjistovani hranic a meneni souradnic orezavane casti
    else{$sourX=$x;}
    if ($hry< $y){$sourY=bcmod($yz+($y-$yz),$hry-$yz); }
    else{$sourY=$y;}

  ImageSetPixel($pic, $sourX, $sourY, $barva["cerna"]);
  $y=$y+$pom;
}
}

else{
$pom=($xk-$xz)/($yk-$yz);
$x=$xz;

for($y=$yz; $y<$yk; $y++){
    if ($hrx< $x){$sourX=bcmod($xz+($x-$xz),$hrx-$xz); }
    else{$sourX=$x;}
    if ($hry< $y){$sourY=bcmod($yz+($y-$yz),$hry-$yz); }
    else{$sourY=$y;}
  ImageSetPixel($pic, $sourX, $sourY, $barva["cerna"]);
  $x=$x+$pom;
}} 

//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet

?>