<?php

require_once('lineBresenham.php'); //at nemusime znovu vytvaret usecku, pouzijeme z minulych cv

//dalsi potrebne funkce
function najdi($bod,$zac,$kon) {
	if($konx == $zacx) {
		$konst = 0;
		$k2 = 0;
	} else {
		$konst = ($kony - $zacy)/($konx - $zacx);
	}
	
	$bod[1]
}
Procedure Najdi(Var Bod : TBody; Zac,Kon:TBod);
Var Konst,K2 : Real;
Begin
If Kon.x=Zac.x then Begin
                    Konst:=0;
                    K2:=0;
                    End
else Begin
     Konst:=(Kon.y-Zac.y)/(Kon.x-Zac.x);
     K2:=1/Konst;
     End;
Bod[1].x:=Xi; Bod[1].y:=Round(Konst*(Xi-Zac.x)+Zac.Y);
Bod[2].x:=Round(K2*(Yi-Zac.y)+Zac.X); Bod[2].y:=Yi;
Bod[3].x:=Xa; Bod[3].y:=Round(Konst*(Xa-Zac.x)+Zac.Y);
Bod[4].x:=Round(K2*(Ya-Zac.Y)+Zac.X); Bod[4].y:=Ya;
End;





//orezove okno

echo 'Souradnice orezoveho okna:';
echo $xi.' x '.$yi.' - '.$xa.' x '.$ya;


//vykresleni okna
nakresliUsecku($xi,$yi,$xa,$yi);
nakresliUsecku($xi,$yi,$xi,$ya);
nakresliUsecku($xa,$ya,$xa,$yi);
nakresliUsecku($xa,$ya,$xi,$ya);

//vykresleni usecky
nakresliUsecku($ax,$ay,$bx,$by);


if(($ca != 0) AND ($cb == 0)) {
	if (($ca == 0 ) AND ($cb == 0)) {
		if($ca == 0) {
			$x = $a;
			$a = $b;
			$b = $x;
			$cx = $ca;
			$ca = $cb;
			$cb = $cx;
			
			najdi($p,$b,$a);
			
			switch ($ca) {
				case 1: $a = $p[1];
					break;
				case 2: $a = $p[2];
					break;
				case 3: $a = $p[1];
					break;
				case 4: $a = $p[3];
					break;
				case 6: $a = $p[2];
					break;
				case 8: $a = $p[4];
					break;
				case 9: $a = $p[1];
					break;
			}
			
			zpet();
		}
	} else {
		nakresliUsecku($ax,$ay,$bx,$by);
	}
	
	readkey();
	graf_mod(3);
}

Writeln('Souradnice okna jsou: ',Xi,':',Yi,' ',Xa,':',Ya);
Write('A.X = ');
Readln(A.X);
Write('A.Y = ');
Readln(A.Y);
Write('B.X = ');
Readln(B.X);
Write('B.Y = ');
Readln(B.Y);
Graf_Mod($13);
Cara_Bres(Xi,Yi,Xa,Yi,7);
Cara_Bres(Xi,Yi,Xi,Ya,7);
Cara_Bres(Xa,Ya,Xa,Yi,7);
Cara_Bres(Xa,Ya,Xi,Ya,7);
Cara_Bres(A.x,A.y,B.x,B.y,15);
cb:=Kod(B);
Zpet:
ca:=Kod(A);
If not((ca=0) and (cb=0)) then
   Begin
   If not((ca and cb) <> 0) then
              Begin
              If (ca=0) then Begin
                            X:=A;
                            A:=B;
                            B:=X;
                            cx:=ca;
                            ca:=cb;
                            cb:=cx;
                            End;
              Najdi(P,A,B);
              Case ca of
                   1,3,9 : A:=P[1];
                     2,6 : A:=P[2];
                    4,12 : A:=P[3];
                       8 : A:=P[4];
                 End;
              Goto Zpet;
              End
   End
   else Cara_Bres(A.x,A.y,B.x,B.y,4);
Readkey;
Graf_Mod(3);
END.













//ORIGINAL z packalu
PROGRAM COHEN_SUTHERLAND;
Uses Crt,Dos;
Label Zpet;
Const Xi = 100;
      Yi = 100;
      Xa = 200;
      Ya = 150;
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
Reg.Ah:=0;
Reg.Al:=mode;
Intr($10,Reg);
End;

Function Kod(Bod:Tbod):Byte;
Var Pom : Byte;
Begin
Pom:=0;
If Bod.x<xi then Pom:=Pom+1
   else if Bod.x>xa then Pom:=Pom+4;
If Bod.y<yi then Pom:=Pom+2
   else if Bod.y>ya then Pom:=Pom+8;
Kod:=Pom;
End;

Procedure Najdi(Var Bod : TBody; Zac,Kon:TBod);
Var Konst,K2 : Real;
Begin
If Kon.x=Zac.x then Begin
                    Konst:=0;
                    K2:=0;
                    End
else Begin
     Konst:=(Kon.y-Zac.y)/(Kon.x-Zac.x);
     K2:=1/Konst;
     End;
Bod[1].x:=Xi; Bod[1].y:=Round(Konst*(Xi-Zac.x)+Zac.Y);
Bod[2].x:=Round(K2*(Yi-Zac.y)+Zac.X); Bod[2].y:=Yi;
Bod[3].x:=Xa; Bod[3].y:=Round(Konst*(Xa-Zac.x)+Zac.Y);
Bod[4].x:=Round(K2*(Ya-Zac.Y)+Zac.X); Bod[4].y:=Ya;
End;

Procedure Cara_Bres(X1,Y1,X2,Y2,Col:Integer);
Var c1,c2,i,pom,h : Integer;
    A             : Real;
Begin
If (x2=x1) or (y2=y1) then A:=0     { pro primku vodorovnou s X nebo s Y }
   else A:=abs(y2-y1)/abs(x2-x1);
If ((A<1) and (A>0)) or (y2=y1) then
   Begin
   {******** A<1 **********}
   If x1>x2 then Begin
                 pom:=x1; x1:=x2; x2:=pom;
                 pom:=y1; y1:=y2; y2:=pom;
                 End;
   c1:=2*abs(y2-y1);               {abs proto, aby fungovalo pro y2<y1}
   c2:=2*abs(y2-y1)-2*(x2-x1);
   If y2>y1 then Begin             {"kladny smer"}
                 h:=c1-(x2-x1);
                 pom:=1;
                 end
      else Begin                   {"zaporny smer"}
           h:=c1+(x2-x1);
           pom:=-1;
           End;
   For i:=x1 to x2 do
             Begin
             If h>0 then
                Begin  {podminka musi byt,jinak se vykresluje usecka posunuta}
                If (pom<>-1) or (i<>x1) then y1:=y1+pom; {pricita se 1/-1}
                h:=h+c2;
                End
                else h:=h+c1;
             Rastr[y1,i]:=Col;
             End;
   End
   else Begin
        {********** A>=1 ***********}
        If y1>y2 then Begin
                      pom:=x1; x1:=x2; x2:=pom;
                      pom:=y1; y1:=y2; y2:=pom;
                      End;
        c1:=2*abs(x2-x1)-2*(y2-y1);
        c2:=2*abs(x2-x1);
        If x1<x2 then Begin
                      pom:=1;
                      h:=c2-(y2-y1);
                      End
           else Begin
                pom:=-1;
                h:=c2+(y2-y1);
                End;
        For i:=y1 to y2 do Begin
                          If h>0 then
                             Begin
                             If ((pom<>-1) and (i<>y1)) or ((A<>1) and (pom=1)) then x1:=x1+pom;
                             h:=h+c1;
                             End
                           else h:=h+c2;
                           Rastr[i,x1]:=Col;
                           End;
        End;
End;

BEGIN
ClrScr;
Writeln('Souradnice okna jsou: ',Xi,':',Yi,' ',Xa,':',Ya);
Write('A.X = ');
Readln(A.X);
Write('A.Y = ');
Readln(A.Y);
Write('B.X = ');
Readln(B.X);
Write('B.Y = ');
Readln(B.Y);
Graf_Mod($13);
Cara_Bres(Xi,Yi,Xa,Yi,7);
Cara_Bres(Xi,Yi,Xi,Ya,7);
Cara_Bres(Xa,Ya,Xa,Yi,7);
Cara_Bres(Xa,Ya,Xi,Ya,7);
Cara_Bres(A.x,A.y,B.x,B.y,15);
cb:=Kod(B);
Zpet:
ca:=Kod(A);
If not((ca=0) and (cb=0)) then
   Begin
   If not((ca and cb) <> 0) then
              Begin
              If (ca=0) then Begin
                            X:=A;
                            A:=B;
                            B:=X;
                            cx:=ca;
                            ca:=cb;
                            cb:=cx;
                            End;
              Najdi(P,A,B);
              Case ca of
                   1,3,9 : A:=P[1];
                     2,6 : A:=P[2];
                    4,12 : A:=P[3];
                       8 : A:=P[4];
                 End;
              Goto Zpet;
              End
   End
   else Cara_Bres(A.x,A.y,B.x,B.y,4);
Readkey;
Graf_Mod(3);
END.

?>