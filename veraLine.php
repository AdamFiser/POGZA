<?php
// mame 2 body X[1,2] Y[10,6]
//A[1,2]B[4,6]
$xz=1;
$yz=2;
$xk=10;
$yk=6;

header("Content-type: image/png");
$pic = ImageCreate (300,300); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

//nastaveni barvy
$barva["cerna"]    = ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]    = ImageColorAllocate($pic, 255,255,255);


if (abs($xk-$xz) > abs($yk-$yz)){
  // vypocty konstant
    $h1=2*($yk-$yz);
    $h2=$h1-2*($xk-$xz);
    $h=$h1-($xk-$xz);
    $i=0;

  for($x=$xz; $x<$xk; $x++){
     if($h>0){
            $a[$i]=$yz++;
            $h+=$h2;}
       else{
               $h+=$h1;
            $a[$i]=$yz;   
       }
       $i++;
    
}

for($j=0; $j<$i; $j++){
    ImageSetPixel($pic, $xz, $a[$j], $barva["cerna"]);
//echo "souradnice bodu usecky<br>".$xz.",".$a[$j]."<br>";
$xz++;
}}
else{
    // vypocty konstant pro y
    $h1=2*($xk-$xz);
    $h2=$h1-2*($yk-$yz);
    $h=$h1-($yk-$yz);
    $i=0;
    
    for($y=$yz; $y<$yk; $y++){
     if($h>0){
            $a[$i]=$xz++;
            $h+=$h2;}
       else{
               $h+=$h1;
            $a[$i]=$xz;   
       }
       $i++;
    
}
echo"$i";
for($j=0; $j<5; $j++){
//echo "souradnice bodu usecky<br>".$a[$j].",".$yz."<br>";
 ImageSetPixel($pic, $yz, $a[$j], $barva["cerna"]);
$yz++;
}
} 

//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet
?>