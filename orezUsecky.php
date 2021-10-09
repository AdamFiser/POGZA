<?php
// mame 2 body X[1,1] Y[100,20]

$xz=1;
$yz=1;
$xk=100;
$yk=20;

//hranice
$hrx=80;
$hry=20;

header("Content-type: image/png");
$pic = ImageCreate (300,300); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi

//nastaveni barvy
$cerna    = ImageColorAllocate ($pic, 0, 0, 0);
$bila    = ImageColorAllocate($pic, 255,255,255);

if (abs($xk-$xz) > abs($yk-$yz)) { //podminka zjistujici zda je usecka ma sklon vyssi ci mensi nez 45 stupnu

$pom=($yk-$yz)/($xk-$xz); //DDA usecka
$y=$yz;

for($x=$xz; $x<$xk; $x++){
    if ($hrx< $x){$sourX=bcmod($xz+($x-$xz),$hrx-$xz); }//podminka na zjistovani hranic a meneni souradnic orezavane casti
    else{$sourX=$x;}
    if ($hry< $y){$sourY=bcmod($yz+($y-$yz),$hry-$yz); }
    else{$sourY=$y;}

  ImageSetPixel($pic, $sourX, $sourY, $cerna);
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
  ImageSetPixel($pic, $sourX, $sourY, $cerna);
  $x=$x+$pom;
}}


ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet
?> 