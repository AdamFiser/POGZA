<?php

echo '<h3>Pùvodní sbm</h3><code>';
echo '<form method="post" action="#rle2.php"><textarea name="data" cols="50" rows="10">';
include('auto.sbm');
echo '</textarea><input type="submit" value="spustit"></form>';
$aDataTmp = explode("\n\r",$_POST["data"]);
$aData[1] = explode(" ", $aDataTmp[0]);


$velikostDatPole = sizeof($aData[1]);


//RLE
$konec=false;
$k=$int=$i=0;
while ($i <= $velikostDatPole) {
	if ($aData[1][$i] == $aData[1][$i+1]) {
		$pocetA = 1;

		while (($i < $velikostDatPole) AND ($aData[1][$i] == $aData[1][$i+1])) {
			$int = $aData[1][$i];
			$pocetA++;
			$i++;
		}
		
		$i++;
	} else {
	
		$j = $pocetA = 1;
		$pocetB = 0;

		while (($i <= ($velikostDatPole+1)) AND ($aData[1][$i] <> $aData[1][$i+1])) {
			$pom[$j] = $aData[1][$i];
			$pocetB++;
			$i++;
			$j++;
		}
	}

	
	if (!$konec) {
		if($pocetA <> 1) {
			//$pocetA			= 1;
			$output[$k]		= $pocetA;
			$output[$k+1]	= $int;
			$k				= $k + 2;
			
        } else {
			$output[$k]		= 0;
			$output[$k+1]	= $pocetB;
			
			for ($m=1; $m <= $pocetB+1; $m++) {
				$output[$m+$k+1] = $pom[$m];
			}
			
			$k = $k + $m + 2;
		}
		
		if ($i== $velikostDatPole) {
			$konec = true;
		}

	}

}
//Zobrazeni vysledku
//$radek = implode(" ", $a);
echo '<h3>Po RLE</h3><code>';
echo '<textarea name="data" cols="50" rows="10">';
echo implode(" ", $output);
echo '</textarea>';
echo '</code><br>';
