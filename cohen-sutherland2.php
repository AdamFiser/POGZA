<?php




header("Content-type: image/png");

$rozmerObrazku['x'] = 300;
$rozmerObrazku['y'] = 300;

$pic = ImageCreate ($rozmerObrazku['x'],$rozmerObrazku['y']); //vytvoreni pic sirka,delka

ImageColorAllocate($pic, 255,255,255); //prvni vyskyt nastavuje pozadi, cervena, zelena, modra

 //nastaveni barvy
$barva["cerna"]	= ImageColorAllocate ($pic, 0, 0, 0);
$barva["bila"]	= ImageColorAllocate($pic, 255,255,255);


$Xi = 100;
$Yi = 50;
$Xa = 200;
$Ya = 150;


TYPE TRastr = Array[1..200,1..320] of Byte;
     Tbod   = Record
                    x,y : Integer;
              End;
     Tbody  = Array[1..4] of Tbod;
Var Rastr           : Trastr absolute $A000:$0000;
    Reg             : Registers;
    A,B,X           : Tbod;
    ca,cb,cx        : Byte;
    P               : Tbody;

Procedure Graf_Mod(Mode:Byte);
Begin
Reg.Ah = 0;
Reg.Al = mode;
Intr($10,Reg);
End;

function kod(){
	$pom = 0;
	
	If (Bod.x<$Xi) {
		$pom = $pom+1;
	} elseif (Bod.x>$Xa) {
		$pom = $pom+4;
	}

	If (Bod.y<$Yi) {
		$pom = $pom+2;
	} elseif (Bod.y>$Ya) {
		$pom = $pom+8;
	}
	
	return $pom;
}


function najdi($Bod,$Zac,$Kon) {

If(Kon.x=Zac.x) {
	$Konst = 0;
	$K2 = 0;
} else {
    $Konst = (Kon.y-Zac.y)/(Kon.x-Zac.x);
     $K2 = 1/$Konst;
}

	Bod[1]["x"] = $Xi;
	Bod[1]["y"] = Round($Konst*($Xi-Zac.x)+Zac.Y);
	Bod[2]["x"] = Round(K2*($Yi-Zac.y)+Zac.X);
	Bod[2]["y"] = $Yi;
	Bod[3]["x"] = $Xa;
	Bod[3]["y"] = Round($Konst*($Xa-Zac.x)+Zac.Y);
	Bod[4]["x"] = Round(K2*($Ya-Zac.Y)+Zac.X);
	Bod[4]["y"] = $Ya;
}

/*
Procedure Cara_Bres(X1,Y1,X2,Y2,Col:Integer);
Var c1,c2,i,pom,h : Integer;
    A             : Real;
Begin
If (x2=x1) or (y2=y1) then A = 0     { pro primku vodorovnou s X nebo s Y }
   else A = abs(y2-y1)/abs(x2-x1);
If ((A<1) and (A>0)) or (y2=y1) then
   Begin
   {******** A<1 **********}
   If x1>x2 then Begin
                 pom = x1; x1 = x2; x2 = pom;
                 pom = y1; y1 = y2; y2 = pom;
                 End;
   c1 = 2*abs(y2-y1);               {abs proto, aby fungovalo pro y2<y1}
   c2 = 2*abs(y2-y1)-2*(x2-x1);
   If y2>y1 then Begin             {"kladny smer"}
                 h = c1-(x2-x1);
                 pom = 1;
                 end
      else Begin                   {"zaporny smer"}
           h = c1+(x2-x1);
           pom = -1;
           End;
   For i = x1 to x2 do
             Begin
             If h>0 then
                Begin  {podminka musi byt,jinak se vykresluje usecka posunuta}
                If (pom<>-1) or (i<>x1) then y1 = y1+pom; {pricita se 1/-1}
                h = h+c2;
                End
                else h = h+c1;
             Rastr[y1,i] = Col;
             End;
   End
   else Begin
        {********** A>=1 ***********}
        If y1>y2 then Begin
                      pom = x1; x1 = x2; x2 = pom;
                      pom = y1; y1 = y2; y2 = pom;
                      End;
        c1 = 2*abs(x2-x1)-2*(y2-y1);
        c2 = 2*abs(x2-x1);
        If x1<x2 then Begin
                      pom = 1;
                      h = c2-(y2-y1);
                      End
           else Begin
                pom = -1;
                h = c2+(y2-y1);
                End;
        For i = y1 to y2 do Begin
                          If h>0 then
                             Begin
                             If ((pom<>-1) and (i<>y1)) or ((A<>1) and (pom=1)) then x1 = x1+pom;
                             h = h+c1;
                             End
                           else h = h+c2;
                           Rastr[i,x1] = Col;
                           End;
        End;
End;
*/


//Writeln('Souradnice okna jsou: ',$Xi,':',$Yi,' ',$Xa,':',$Ya);
$A.X = 10;
$A.Y = 170;
$B.X = 180;
$B.Y = 30;
Graf_Mod($13);
Cara_Bres($Xi,$Yi,$Xa,$Yi,7);
Cara_Bres($Xi,$Yi,$Xi,$Ya,7);
Cara_Bres($Xa,$Ya,$Xa,$Yi,7);
Cara_Bres($Xa,$Ya,$Xi,$Ya,7);
Cara_Bres(A.x,A.y,B.x,B.y,15);
$cb = Kod(B);
Zpet:
$ca = Kod(A);
If not((ca=0) and (cb=0)) {
   Begin
   If not((ca and cb) <> 0) then
              Begin
              If (ca=0) then Begin
                            X = A;
                            A = B;
                            B = X;
                            cx = ca;
                            ca = cb;
                            cb = cx;
                            End;
              Najdi(P,A,B);
              Case ca of
                   1,3,9 : A = P[1];
                     2,6 : A = P[2];
                    4,12 : A = P[3];
                       8 : A = P[4];
                 End;
              Goto Zpet;
              End
   End
   else Cara_Bres(A.x,A.y,B.x,B.y,4);
Readkey;
Graf_Mod(3);
}.

//vysledek
ImagePNG ($pic); //zobrazime obrazek
imagedestroy($pic); //uvolnime pamet

?>