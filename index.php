<?php


echo '
<html>
<head>
<title>POGZA</title>
</head>
<body>
';


$aCvNazev = array('B/W','R/B','Zelena/Zluta','Maticove rozptyleni','Usecka','Usecka - Bresenham','orez usecky','RLE','konvoluce','rgb2bw','z-buffer','krivky - Bezier','vyplnovani - inverzni','vyplnovani - scan-line');
$aCvSoubor = array('cv1.php','cv2.php','cv3.php','matice.php','line.php','lineBresenham.php','orezUsecky-cs.php','rle2.php','konvoluce2.php','rgb2bw.php','zbuffer-koule.php','krivky-bezier.php','vyplnovani-inverzni.php','vyplnovani-scan-line.php');

echo '<a href="barvy.php">barvy</a><br>';
for($iIndex=0; $iIndex< sizeof($aCvNazev); $iIndex++) {
	echo '<a href="#'.$aCvSoubor[$iIndex].'">'.$aCvNazev[$iIndex].'</a><br>';
}

$aBezObrazku = array('rle2.php','konvoluce2.php');
for($iIndex=0; $iIndex< sizeof($aCvNazev); $iIndex++) {

echo '
<hr>
<h1><A NAME="'.$aCvSoubor[$iIndex].'">'.$aCvNazev[$iIndex].'</a></h1>';
if($aCvSoubor[$iIndex] == 'rgb2bw.php') {
	echo '<img src="barevnyPic.png">';
}

if(!in_array($aCvSoubor[$iIndex],$aBezObrazku)) {
	echo '<img src="'.$aCvSoubor[$iIndex].'">';
	} else {
		include($aCvSoubor[$iIndex]);
	}

echo '<br>';

show_source($aCvSoubor[$iIndex]);
}


echo '
</body>
</html>
';

?>