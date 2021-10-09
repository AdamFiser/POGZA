<?php

$maska[] = array(1,1,1);
$maska[] = array(1,9,1);
$maska[] = array(1,1,1);

$velikost["maska"] = sizeof($maska);

//vypocet konstanty
for($i=0; $i<=sizeof($velikost["maska"]); $i++) {
	for($j=0; $j<=sizeof($velikost["maska"]); $j++) {
		$con = $con + $maska[$i][$j]; //konstanta
	}
}



//schody
/*
$input[] = array(0,0,0,0,0,0,0,0,0,63);
$input[] = array(0,0,0,0,0,0,0,0,63,63);
$input[] = array(0,63,0,0,0,0,0,63,63,63);
$input[] = array(0,0,0,0,0,0,63,63,63,63);
$input[] = array(0,0,0,0,0,63,63,63,63,63);
$input[] = array(0,0,0,0,0,63,63,63,63,63);
$input[] = array(0,0,0,63,63,63,63,63,63,63);
$input[] = array(0,0,0,63,63,63,63,63,63,63);
$input[] = array(0,0,0,63,63,63,63,63,63,63);
$input[] = array(63,63,63,63,63,63,63,63,63,63);
$input[] = array(63,63,63,63,63,63,63,63,63,63);
*/


$input[] = array(0,0,0,0,0);
$input[] = array(0,0,0,0,0);
$input[] = array(0,0,9,0,0);
$input[] = array(0,0,0,0,0);
$input[] = array(0,0,0,0,0);
$input[] = array(0,0,1,0,0);
$input[] = array(0,0,0,0,0);
$input[] = array(0,0,0,0,0);

//$vstup - vypocet velikosti
$velikost["x"] = sizeof($input[0]);
$velikost["y"] = sizeof($input);

for($x=0; $x<$velikost["y"]; $x++ ) {
	for($y=0; $y<$velikost["x"]; $y++ ) {
		
		$spodniHranice["x"]	= $x-1;
		$horniHranice["x"] 	= $x+1;
		$spodniHranice["y"]	= $y-1;
		$horniHranice["y"] 	= $y+1;
		$sum = 0;
		$prumer = 0;
		$maskaPozice["x"] = 0;
		
		
		//aplikace masky
		for($mx=$spodniHranice["x"]; $mx<$horniHranice["x"]; $mx++ ) {
			$maskaPozice["y"] = 0;
			for($my=$spodniHranice["y"]; $my<$horniHranice["y"]; $my++ ) {
				$sum = $sum + ($maska[$maskaPozice["x"]][$maskaPozice["y"]] * $input[$x+$mx][$y+$my]); //soucet hodnot okoli (vc. bodu) s aplikovanou hodnotou masky
				//echo $sum."<br>";
				$maskaPozice["y"]++;
			}
			$maskaPozice["x"]++;
		}
		
		$prumer = round($sum / $con,0); //prumer zaokrouhlime na cela cisla
		$vystup[$x][$y] = $prumer;
		
		echo str_pad($vystup[$x][$y], 3, '_', STR_PAD_LEFT);
		}
	echo "<br>";
}

?>
