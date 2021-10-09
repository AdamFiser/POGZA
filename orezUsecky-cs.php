<?php
include_once('fce.php');

$pic = vytvorObrazek();

//nastaveni barvy
$barva = array();
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255, 255, 255);
$barva["zelena"] = ImageColorAllocate ($pic, 34, 177, 76);	// Orezove okno
$barva["cervena"] = ImageColorAllocate ($pic, 255, 0, 0);	// Opetovne vykresleni



$barvaOkna = $barva["zelena"];

//Souradnice usecky
$zx = 1;
$zy = 100;
$kx = 180;
$ky = 170;

//souradnice okna
$xmin=20;
$ymin=20;
$xmax=150;
$ymax=150;

//Cela usecka - neorezana
nakresliUseckuBres($zx,$zy,$kx,$ky,$barva["cerna"]);


// a nyni budeme "rezat" :-()
//pruseciky orezane usecky
$xp=$zy-$ky;
$yp=$kx-$zx;
$cp=$zx*$ky-$kx*$zy;

//echo $cp;

//Vypocet souradnic
//x=xmin
$y1=((0-($xp*$xmin)) - $cp)/$yp;
$souradniceX[0]=$xmin;
$souradniceY[0]=round($y1); //pro zvyrazneni rozdilu mezi useckamy mozno pouzit fci ceil pro zaokrouhleni cisla nahoru

//y=ymin
$x1=((0-($yp*$ymin)) - $cp)/$xp;
$souradniceX[1]=round($x1);
$souradniceY[1]=$ymin;

//x=xmax
$y2=((0-($xp*$xmax)) - $cp)/$yp;
$souradniceX[2]=$xmax;
$souradniceY[2]=round($y2);

//y=ymax
$x2=((0-($yp*$ymax)) - $cp)/$xp;
$souradniceX[3]=round($x2);
$souradniceY[3]=$ymax;


//Porovnani souradnice bodu s hranicnim oknem
$xxmax=$souradniceX[0];
for ($i=0;$i<=3;$i++) {
	if ($souradniceX[$i]>$xxmax) {
		$xxmax=$souradniceX[$i];
	}
	
	//echo $xxmax."<br>";
}



$xxmin=$souradniceX[0];
for ($i=0;$i<=3;$i++){
	if ($souradniceX[$i]<$xxmin) {
		$xxmin=$souradniceX[$i];
	}
}


$a=0;
for ($i=0;$i<=3;$i++) {
	if ($souradniceX[$i]>$xmin-1) {
		if ($souradniceX[$i]<$xmax+1) {
			$souOrezUsecky[$a]=$i; //Urceni souradnice orezane 
			$a++;
		}
	}
}




//pro y
//hlavni problem s spodni hranici orezoveho okna
$yymax=$souradniceY[0];
for ($i=0;$i<=3;$i++) {
	if ($souradniceY[$i]>$yymax) {
		$yymax=$souradniceY[$i];
	}
	
	//echo $xxmax."<br>";
}



$yymin=$souradniceY[0];
for ($i=0;$i<=3;$i++){
	if ($souradniceY[$i]<$yymin) {
		$yymin=$souradniceY[$i];
	}
}


$a=0;
for ($i=0;$i<=3;$i++) {
	if ($souradniceY[$i]>$ymin-1) {
		if ($souradniceY[$i]<$ymax+1) {
			$souOrezUsecky[$a]=$i; //Urceni souradnice orezane 
			$a++;
		}
	}
}



$b=$souOrezUsecky[0];
$c=$souOrezUsecky[2];
//echo $b;
//echo $c;

//prohozeni pro vykresleni (z leva do prava)
if($souradniceX[$b]>$souradniceX[$c]) {
	$swap=$souradniceX[$b];
	$souradniceX[$b]=$souradniceX[$c];
	$souradniceX[$c]=$swap;

	$swap=$souradniceY[$b];
	$souradniceY[$b]=$souradniceY[$c];
	$souradniceY[$c]=$swap;
}


//Nakreslime orezove okno
nakresliUseckuBres($xmin,$ymin,$xmin,$ymax,$barvaOkna);
nakresliUseckuBres($xmin,$ymin,$xmax,$ymin,$barvaOkna);
nakresliUseckuBres($xmax,$ymin,$xmax,$ymax,$barvaOkna);
nakresliUseckuBres($xmin,$ymax,$xmax,$ymax,$barvaOkna);

//Usecka nerezana
nakresliUseckuBres($souradniceX[$b],$souradniceY[$b],$souradniceX[$c],$souradniceY[$c],$barva["cervena"]);

ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet