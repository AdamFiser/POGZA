<?php

$maska[] = array(1,1,1);
$maska[] = array(1,9,1);
$maska[] = array(1,1,1);

$velikost["maska"] = sizeof($maska);

//vypocet konstanty
for($i=0; $i<=sizeof($maska[0]); $i++) {
    for($j=0; $j<=sizeof($maska); $j++) {
        $con += $maska[$i][$j]; //konstanta
    }
}



//schody

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





//$vstup - vypocet velikosti
$velikost["x"] = sizeof($input[0]);
$velikost["y"] = sizeof($input);


echo "<table border=0>";
for($x=0; $x<$velikost["y"]; $x++ ) {
	echo '<tr>';
    for($y=0; $y<$velikost["x"]; $y++ ) {
        
    	$sum = 0;
		$prumer = 0;

        //aplikace masky
        for($mx=0; $mx<$velikost["maska"]; $mx++ ) {
        	
            for($my=0; $my<$velikost["maska"]; $my++ ) {
                //soucet hodnot okoli (vc. bodu) s aplikovanou hodnotou masky
                $hodnota = $input[($x-1)+$mx][($y-1)+$my];
                $sum = $sum + ($hodnota * $maska[$mx][$my]);
                
            }
            //$maskaPozice["x"]++;
        }
        

        $vystup[$x][$y] = round($sum / $con,0); //prumer zaokrouhlime na cela cisla
        
        //echo str_pad($vystup[$x][$y], 4, " ", STR_PAD_LEFT);
        echo '<td style="text-align:right;">'.$vystup[$x][$y].'</td>';
        }
    echo '</tr>';
}
echo "</table>";
?> 