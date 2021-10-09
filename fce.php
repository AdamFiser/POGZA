<?php

function vytvorObrazek($rozmerObrazkuX = 300, $rozmerObrazkuY = 300) {
	header("Content-type: image/png");
	
	$pic = ImageCreate ($rozmerObrazkuX,$rozmerObrazkuY); //vytvoreni pic sirka,delka
	
	ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra
	return $pic;
}


function nakresliUseckuBres($xz,$yz,$xk,$yk,$barva) {
global $pic;


	if (abs($xk-$xz) > abs($yk-$yz)) {
		// vypocty konstant
		$h1 = 2 * abs($yk - $yz);
		$h2 = $h1 - 2 * ($xk - $xz);
    	$h = $h1 - ($xk - $xz);
    
    	$i=0;

		if(($yk - $yz) > 0) {
			for($x = $xz; $x < $xk; $x++) {
				if($h>0) {
					$a[$i] = $yz++; //ulozeni souradnice do pom pole
            		$h += $h2;
				} else {
					$h += $h1;
					$a[$i] = $yz;
				} //end if

				$i++;
			} //end for
		} else {
			for($x=$xz; $x<$xk; $x++) {
				if($h>0) {
					$yz=$yz-1;
           			$a[$i]=$yz; //ulozeni souradnice do pom pole
            		$h+=$h2;
				} else {
					$h+=$h1;
					$a[$i]=$yz;
				}
				
				$i++;
			}
		} //end if



		for($j=0; $j<$i; $j++) {
			ImageSetPixel($pic, $xz, $a[$j], $barva);
			$xz++; 
		}
		
		
	} else { 
    	// vypocty konstant pro y 
		$h1=2*($xk-$xz); 
		$h2=$h1-2*abs($yk-$yz);
		$h=$h1-abs($yk-$yz);
		$i=0;

		//plusDy
		if(($yk - $yz) > 0) {
			for($y=$yz; $y<$yk; $y++) {
				if($h>0) {
					$a[$i]=$xz++;
					$h+=$h2;
				} else {
					$h+=$h1;
					$a[$i]=$xz;
				}
				
				$i++;
			}
			
		} else {
			
			for($y=$yz; $y>$yk; $y=$y-1) {
				if($h>0) {
					$a[$i]=$xz++;
					$h+=$h2;
				} else {
					$h+=$h1;
					$a[$i]=$xz;
				}
       
				$i++;
			}
		}


		for($j=0; $j<$i; $j++) {
			//echo "Bod usecky <br>".$a[$j].",".$yz."<br>"; 
			ImageSetPixel($pic, $a[$j], $yz, $barva); 
			$yz++;
		} 
	} //if
}


//faktorial s rekurzi
function faktorial ($cislo) {
	if ($cislo == 0) {
		return 1;
	} else {
		return ($cislo * faktorial($cislo - 1));
	}
}
?>