{ View 3D ver. 1.0}

program V3;

uses crt, g256, tt;

var p : hv3;
    n : integer;
    sxi,sxa,syi,sya         : integer;
    xmi,xma,ymi,yma,zmi,zma : real;

BEGIN

fi:=2*Pi/24; co:=cos(fi); si:=sin(fi); { 15 stupnov }
h:=0.05;                               { posun }
s:=0.9;                                { skalovanie }
n:=4;
p[1].x:=-1; p[1].y:=-1; p[1].z:=-1; p[1].w:=1;
p[2].x:= 1; p[2].y:=-1; p[2].z:=-1; p[2].w:=1;
p[3].x:= 0; p[3].y:= 1; p[3].z:=-1; p[3].w:=1;
p[4].x:= 0; p[4].y:= 0; p[4].z:= 1; p[4].w:=1;
xmi:=-1; xma:=1;
ymi:=-1; yma:=1;
zmi:=-1; zma:=1;

sxi:=50; syi:=50;
sxa:=150; sya:=150;

SetBTrMa(co,si,h,s);
InitTr(xmi,ymi,zmi,xma,yma,zma,tra);
InitPr(sxi,syi,sxa,sya,pr);
ch_gr_mod($13);

while(q<>'q') do
  begin
  M2xM(pr,tra,res);
  Plot_Nodes(res,n,p,15);
  q:=ReadKey;
  Plot_Nodes(res,n,p,0);
  if      (q='H') then MxM(sxp,tra,tra)
  else if (q='h') then MxM(sxm,tra,tra)
  else if (q='V') then MxM(syp,tra,tra)
  else if (q='v') then MxM(sym,tra,tra)
  else if (q='F') then MxM(szp,tra,tra)
  else if (q='f') then MxM(szm,tra,tra)
  else if (q='O') then MxM(zop,tra,tra)      { zOom  }
  else if (q='o') then MxM(zom,tra,tra)
  else if (q='x') then MxM(rxm,tra,tra)      { rotace }
  else if (q='X') then MxM(rxp,tra,tra)
  else if (q='y') then MxM(rym,tra,tra)
  else if (q='Y') then MxM(ryp,tra,tra)
  else if (q='z') then MxM(rzm,tra,tra)
  else if (q='Z') then MxM(rzp,tra,tra);
end;
ch_gr_mod(3);
END.
