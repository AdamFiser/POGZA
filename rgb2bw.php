<?php




header("Content-type: image/png");
//cernobily
$pic = imagecreatefrompng('barevnyPic.png');
//ImageColorAllocate($pic, 255,255,255);

for ($x=1;$x<164;$x++){
for ($y=1;$y<118;$y++){
    
        
$rgb = ImageColorAt($pic, $x, $y);
$r= ($rgb >> 16) & 0xFF;
$g= ($rgb >> 8) & 0xFF;
$b=$rgb & 0xFF;

$odstin = ceil((0.299*$r)+(0.587*$g)+(0.114*$b));
$bw = ImageColorAllocate($pic, $odstin, $odstin, $odstin);
ImageSetPixel($pic, $x, $y, $bw);

    }
}

ImagePng($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet
?> 