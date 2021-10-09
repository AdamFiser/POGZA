Unit tt;
interface
USES G256;

type  i24 = array[1..2,1..4] of integer;
type  r24 = array[1..2,1..4] of real;
type  r44 = array[1..4,1..4] of real;
type  hp3 = record x,y,z,w: real; end;
type  hv3 = array[1..10] of hp3;

var fi,co,si,h,s                  : real;
    rxp,rxm,ryp,rym,rzp,rzm,
    sxp,sxm,syp,sym,szp,szm,
    zop,zom,tra                   : r44;
    pr                            : i24;
    res                           : r24;
    q                             : char;


function  Max       (a,b,c:real):real;
procedure SetBTrMa  (c,s,h,r:real);
procedure MxM       (a,b:r44; var c:r44);
procedure M2xM      (a:i24; b:r44; var c:r24);
procedure InitTr    (xmi,ymi,zmi,xma,yma,zma : real; var tra:r44);
procedure InitPr    (sxi,syi,sxa,sya : integer; var pr:i24);
procedure Plot_Nodes(res:r24;n:integer;p:hv3;col:integer);
implementation

function Max(a,b,c:real):real;
begin
if (a<b) then a:=b;
if (a>c) then max:=a else max:=c;
end;


procedure SetBTrMa(c,s,h,r:real);
var i,j:integer;

begin
for i:=1 to 4 do
for j:=1 to 4 do
  begin
  rxp[i,j]:=0; rxm[i,j]:=0;
  ryp[i,j]:=0; rym[i,j]:=0;
  rzp[i,j]:=0; rzm[i,j]:=0;
  sxp[i,j]:=0; sxm[i,j]:=0;
  syp[i,j]:=0; sym[i,j]:=0;
  szp[i,j]:=0; szm[i,j]:=0;
  zop[i,j]:=0; zom[i,j]:=0;
  end;

for j:=1 to 4 do
  begin
  rxp[j,j]:=1; rxm[j,j]:=1;
  ryp[j,j]:=1; rym[j,j]:=1;
  rzp[j,j]:=1; rzm[j,j]:=1;
  sxp[j,j]:=1; sxm[j,j]:=1;
  syp[j,j]:=1; sym[j,j]:=1;
  szp[j,j]:=1; szm[j,j]:=1;
  zop[j,j]:=1./r; zom[j,j]:=r;
  end;

zop[4,4]:= 1; zom[4,4]:= 1;

rxp[2,2]:= c; rxp[3,3]:= c;
rxp[2,3]:=-s; rxp[3,2]:= s;
rxm[2,2]:= c; rxm[3,3]:= c;
rxm[2,3]:= s; rxm[3,2]:=-s;

ryp[1,1]:= c; ryp[3,3]:= c;
ryp[1,3]:= s; ryp[3,1]:=-s;
rym[1,1]:= c; rym[3,3]:= c;
rym[1,3]:=-s; rym[3,1]:= s;

rzp[1,1]:= c; rzp[2,2]:= c;
rzp[1,2]:=-s; rzp[2,1]:= s;
rzm[1,1]:= c; rzm[2,2]:= c;
rzm[1,2]:= s; rzm[2,1]:=-s;

sxp[1,4]:= h; sxm[1,4]:= -h;
syp[2,4]:= h; sym[2,4]:= -h;
szp[3,4]:= h; szm[3,4]:= -h;
end;


procedure MxM(a,b:r44; var c:r44);
var i,j,k :integer;
    s     :real;
begin
for i:=1 to 4 do
for j:=1 to 4 do
  begin
  s:=0;
  for k:=1 to 4 do s:=s+a[i,k]*b[k,j];
  c[i,j]:=s
  end
end;


procedure M2xM(a:i24; b:r44; var c:r24);
var i,j,k :integer;
    s     :real;
begin
for i:=1 to 2 do
for j:=1 to 4 do
  begin
  s:=0;
  for k:=1 to 4 do s:=s+a[i,k]*b[k,j];
  c[i,j]:=s
  end
end;




procedure InitTr(xmi,ymi,zmi,xma,yma,zma : real; var tra:r44);

var i,j  : integer;
    xx   : real;

begin
xx:=max(xma-xmi,yma-ymi,zma-zmi);
xx:=1/xx;

for i:=1 to 4 do
for j:=1 to 4 do tra[i,j]:=0;

tra[1,1]:=2*xx; tra[1,4]:=-xx*(xmi+xma);
tra[2,2]:=2*xx; tra[2,4]:=-xx*(ymi+yma);
tra[3,3]:=2*xx; tra[3,4]:=-xx*(zmi+zma);
tra[4,4]:=1;
end;


procedure InitPr(sxi,syi,sxa,sya : integer; var pr:i24);
var w,wx,wy,ux,uy:integer;
begin
ux:=(sxi+sxa) shr 1; uy:=(syi+sya) shr 1;
wx:=sxa-sxi; wy:=sya-syi;
if wx<wy then w:=wx else w:=wy;
w:=w shr 1;
pr[1,1]:=w; pr[1,4]:=ux;
pr[2,2]:=w; pr[2,4]:=uy;
pr[1,2]:=0; pr[1,3]:=0; pr[2,1]:=0; pr[2,3]:=0;
end;


procedure Plot_Nodes(res:r24;n:integer;p:hv3;col:integer);
var i,ix,iy:integer;
begin
for i:=1 to n do
  begin
  ix:=round(res[1,1]*p[i].x + res[1,2]*p[i].y + res[1,3]*p[i].z +res[1,4]);
  iy:=round(res[2,1]*p[i].x + res[2,2]*p[i].y + res[2,3]*p[i].z +res[2,4]);
  Put_256_Pixel(ix,iy,col);
  { writeln(ix:4,iy:4,col:3) { }
  end
end;
end.
