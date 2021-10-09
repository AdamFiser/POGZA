<?php

$nazevSouboru = 'auto.sbm';
$soubor = fopen($nazevSouboru,'r');

echo '<h3>Pùvodní sbm</h3><code>';
$i=0;
while($a = fgetcsv($soubor,'',' ')) {
if(!empty($i))
	//vypis puvodnich hodnot uzivateli
	$radek = implode(" ", $a);
	$aData[] = $a;
	echo $radek;
	$i++;
}
echo '</code><br>';

//RLE

//for($i=0; $i<=sizeof($aData[1]); $i++) {
	
$b=$cislo=$i=0;

$velikostPole = sizeof($aData[1]);

for($i=0; $i<=$velikostPole; $i++) {
	if ($aData[1][$i] == $aData[1][$i+1]) {
		$numA=1;

		while (($aData[1][$i] == $aData[1][$i+1]) AND ($i < $velikostPole)) {
			$numA++;
			$cislo = $aData[1][$i];
			$i++;
		}
	$i++;
	
	} else {
	
		$pocet=1;
		$numB=0;
		$j=1;
	
		while (($aData[1][$i] <> $aData[1][$i+1]) AND ($i < $velikost+2)) {
			$numB++;
			$tmp[$j]=$aData[1][$i];
			$i++;
			$j++;
		}
	}


	if ($konec <> 1) {
		if($numA <> 1){
			$output[$b] 	= $numA;
			$output[$b+1] 	= $cislo;
			$b = $b + 2;
			$numA = 1;
		} else {
			$output[$b]		= 0;
			$output[$b+1]	= $numB;
			
			for ($l=1; $l<= $numB+1; $l++) {
				$output[$b+$l+1]= $tmp[$l];
			}
	        
			$b=$b+2+$l;
		}
	
		if ($i == $velikost) {
			$konec=1;
		}
	
	}
} 


//Zobrazeni vysledku
//$radek = implode(" ", $a);
echo '<h3>Po RLE</h3><code>';
echo implode(" ", $output);;
echo '</code><br>';