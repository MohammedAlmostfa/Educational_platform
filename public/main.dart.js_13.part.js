((a,b)=>{a[b]=a[b]||{}})(self,"$__dart_deferred_initializers__")
$__dart_deferred_initializers__.current=function(a,b,c,$){var J,A,C,D,F,B={fB:function fB(d,e,f,g){var _=this
_.c=d
_.d=e
_.e=f
_.a=g},
b2h(d,e,f){var x,w,v,u,t
if(f<=C.b.gap(e))return C.b.gap(d)
if(f>=C.b.gaY(e))return C.b.gaY(d)
x=C.b.ayB(e,new B.aQl(f))
w=d[x]
v=x+1
u=d[v]
t=e[x]
t=A.L(w,u,(f-t)/(e[v]-t))
t.toString
return t},
bim(d,e,f,g,h){var x,w,v=A.a_I(null,null,y.b)
v.a1(0,e)
v.a1(0,g)
x=A.a2(v,v.$ti.c)
x.$flags=1
w=x
x=A.Y(w).i("ag<1,z>")
x=A.a2(new A.ag(w,new B.aPQ(d,e,f,g,h),x),x.i("at.E"))
x.$flags=1
return new B.aEY(x,w)},
aYX(d,e,f){var x,w,v,u,t
if(d==e)return d
if(d==null)return e.b6(f)
if(e==null)return d.b6(1-f)
x=B.bim(d.a,d.IY(),e.a,e.IY(),f)
w=A.rB(d.d,e.d,f)
w.toString
v=A.rB(d.e,e.e,f)
v.toString
u=f<0.5
t=u?d.f:e.f
u=u?d.c:e.c
return new B.lS(w,v,t,x.a,x.b,u)},
aEY:function aEY(d,e){this.a=d
this.b=e},
aQl:function aQl(d){this.a=d},
aPQ:function aPQ(d,e,f,g,h){var _=this
_.a=d
_.b=e
_.c=f
_.d=g
_.e=h},
amh:function amh(){},
lS:function lS(d,e,f,g,h,i){var _=this
_.d=d
_.e=e
_.f=f
_.a=g
_.b=h
_.c=i},
ap8:function ap8(d){this.a=d},
GF:function GF(d,e,f,g){var _=this
_.B=d
_.q$=e
_.dy=f
_.b=_.fy=null
_.c=0
_.y=_.d=null
_.z=!0
_.Q=null
_.as=!1
_.at=null
_.ay=$
_.ch=g
_.CW=!1
_.cx=$
_.cy=!0
_.db=!1
_.dx=$},
rF:function rF(d,e,f){this.e=d
this.c=e
this.a=f},
hC(d,e,f){return new B.a_7(f,e,d,null)},
a_7:function a_7(d,e,f,g){var _=this
_.e=d
_.f=e
_.x=f
_.a=g},
az_:function az_(d,e,f){this.a=d
this.b=e
this.c=f},
az0:function az0(d){this.a=d},
Bn:function Bn(d,e,f,g,h){var _=this
_.e=d
_.f=e
_.r=f
_.c=g
_.a=h},
a9r:function a9r(d,e){var _=this
_.c=_.b=_.a=_.CW=_.ay=_.p1=null
_.d=$
_.e=d
_.r=_.f=null
_.w=e
_.z=_.y=null
_.Q=!1
_.as=!0
_.at=!1},
Mp:function Mp(d,e,f,g,h,i,j){var _=this
_.n=d
_.O=e
_.V=f
_.af=g
_.q$=h
_.dy=i
_.b=_.fy=null
_.c=0
_.y=_.d=null
_.z=!0
_.Q=null
_.as=!1
_.at=null
_.ay=$
_.ch=j
_.CW=!1
_.cx=$
_.cy=!0
_.db=!1
_.dx=$},
aLA:function aLA(d,e){this.a=d
this.b=e},
aLz:function aLz(d){this.a=d},
On:function On(){},
ac2:function ac2(){},
ac3:function ac3(){},
rO(d,e){var x=new A.bf(d,e,C.I,-1)
return new A.dA(x,x,x,x)}},E
J=c[1]
A=c[0]
C=c[2]
D=c[15]
F=c[16]
B=a.updateHolder(c[13],B)
E=c[20]
B.fB.prototype={
J(d){var x=null,w=A.b([A.Gl(0,A.po(this.d,C.dN,x,x))],y.e)
w.push(A.Gl(0,A.bZ(x,x,C.n,C.m.dv(0.36),x,x,x,x,x,x,x,x,x)))
w.push(A.ii(x,C.A,this.c,x))
return A.fc(C.bD,w,C.G,C.be,x)},
gN(){return this.c}}
B.aEY.prototype={}
B.amh.prototype={
IY(){var x,w,v,u=this.b
if(u!=null)return u
u=this.a.length
x=1/(u-1)
w=J.aoh(u,y.b)
for(v=0;v<u;++v)w[v]=v*x
return w}}
B.lS.prototype={
a_D(d,e){var x=this,w=x.d.ah(e).a45(d),v=x.e.ah(e).a45(d),u=x.IY()
return A.aT5(w,v,x.a,u,x.f,null)},
b6(d){var x=this,w=x.a,v=A.Y(w).i("ag<1,z>")
w=A.a2(new A.ag(w,new B.ap8(d),v),v.i("at.E"))
return new B.lS(x.d,x.e,x.f,w,x.b,null)},
e4(d,e){var x=B.aYX(d,this,e)
return x},
e5(d,e){var x=B.aYX(this,d,e)
return x},
k(d,e){var x=this
if(e==null)return!1
if(x===e)return!0
if(J.W(e)!==A.A(x))return!1
return e instanceof B.lS&&e.d.k(0,x.d)&&e.e.k(0,x.e)&&e.f===x.f&&A.cR(e.a,x.a)&&A.cR(e.b,x.b)},
gt(d){var x=this,w=A.bV(x.a),v=x.b
v=v==null?null:A.bV(v)
return A.R(x.d,x.e,x.f,x.c,w,v,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a)},
j(d){var x=this,w=A.b(["begin: "+x.d.j(0),"end: "+x.e.j(0),"colors: "+A.f(x.a)],y.h),v=x.b
if(v!=null)w.push("stops: "+A.f(v))
w.push("tileMode: "+x.f.j(0))
return"LinearGradient("+C.b.bE(w,", ")+")"}}
B.GF.prototype={
sL5(d){if(this.B===d)return
this.B=d
this.a4()},
bs(d){var x
if(isFinite(d))return d*this.B
x=this.q$
x=x==null?null:x.ad(C.at,d,x.gbM())
return x==null?0:x},
br(d){var x
if(isFinite(d))return d*this.B
x=this.q$
x=x==null?null:x.ad(C.a9,d,x.gbA())
return x==null?0:x},
bl(d){var x
if(isFinite(d))return d/this.B
x=this.q$
x=x==null?null:x.ad(C.ad,d,x.gbw())
return x==null?0:x},
bk(d){var x
if(isFinite(d))return d/this.B
x=this.q$
x=x==null?null:x.ad(C.aH,d,x.gbU())
return x==null?0:x},
ac5(d){var x,w,v,u,t=d.a,s=d.b
if(t>=s&&d.c>=d.d)return new A.H(A.F(0,t,s),A.F(0,d.c,d.d))
x=this.B
if(isFinite(s)){w=s/x
v=s}else{w=d.d
v=w*x}if(v>s)w=s/x
else s=v
u=d.d
if(w>u){s=u*x
w=u}if(s<t)w=t/x
else t=s
u=d.c
if(w<u){t=u*x
w=u}return d.bB(new A.H(t,w))},
ct(d){return this.ac5(d)},
ea(d,e){return this.QS(A.iF(this.ad(C.P,d,this.gcz())),e)},
bC(){var x,w=this
w.fy=w.ad(C.P,y.a.a(A.m.prototype.gR.call(w)),w.gcz())
x=w.q$
if(x!=null)x.ha(A.iF(w.gp()))}}
B.rF.prototype={
aO(d){var x=new B.GF(this.e,null,new A.aH(),A.a5())
x.aN()
x.sN(null)
return x},
aW(d,e){e.sL5(this.e)}}
B.a_7.prototype={
J(d){var x,w,v,u,t,s=this,r=null,q={},p=D.b2Q(d,C.aI,!1),o=s.x
q.a=o
x=s.e
if(x!=null)q.a=new A.aU(x,o,r)
w=s.f==null&&D.aZQ(d,C.aI)
v=w?A.yP(d):s.f
u=D.aTQ(p,C.G,v,C.ae,!1,C.aw,r,r,r,r,r,new B.az_(q,s,p))
t=A.kK(d).zo(d)
if(t===F.Ia)u=new A.de(new B.az0(d),u,r,y.m)
return w&&v!=null?D.aZP(u):u},
gN(){return this.x}}
B.Bn.prototype={
aO(d){var x=new B.Mp(this.e,this.f,this.r,A.a5(),null,new A.aH(),A.a5())
x.aN()
x.sN(null)
return x},
aW(d,e){var x
e.sdJ(this.e)
e.sd4(this.f)
x=this.r
if(x!==e.V){e.V=x
e.aQ()
e.bo()}},
cl(){return new B.a9r(this,C.a8)}}
B.a9r.prototype={}
B.Mp.prototype={
sdJ(d){if(d===this.n)return
this.n=d
this.a4()},
sd4(d){var x=this,w=x.O
if(d===w)return
if(x.y!=null)w.M(x.gB8())
x.O=d
if(x.y!=null)d.a5(x.gB8())
x.a4()},
ak1(){this.aQ()
this.bo()},
f4(d){if(!(d.b instanceof A.cU))d.b=new A.cU()},
av(d){this.aat(d)
this.O.a5(this.gB8())},
am(){this.O.M(this.gB8())
this.aau()},
gfq(){return!0},
gapN(){switch(A.bk(this.n).a){case 0:var x=this.gp().a
break
case 1:x=this.gp().b
break
default:x=null}return x},
gBm(){var x=this,w=x.q$
if(w==null)return 0
switch(A.bk(x.n).a){case 0:w=w.gp().a-x.gp().a
break
case 1:w=w.gp().b-x.gp().b
break
default:w=null}return Math.max(0,A.ro(w))},
TF(d){var x
switch(A.bk(this.n).a){case 0:x=new A.a3(0,1/0,d.c,d.d)
break
case 1:x=new A.a3(d.a,d.b,0,1/0)
break
default:x=null}return x},
bs(d){var x=this.q$
x=x==null?null:x.ad(C.at,d,x.gbM())
return x==null?0:x},
br(d){var x=this.q$
x=x==null?null:x.ad(C.a9,d,x.gbA())
return x==null?0:x},
bl(d){var x=this.q$
x=x==null?null:x.ad(C.ad,d,x.gbw())
return x==null?0:x},
bk(d){var x=this.q$
x=x==null?null:x.ad(C.aH,d,x.gbU())
return x==null?0:x},
ct(d){var x=this.q$
if(x==null)return new A.H(A.F(0,d.a,d.b),A.F(0,d.c,d.d))
return d.bB(x.ad(C.P,this.TF(d),x.gcz()))},
bC(){var x,w,v=this,u=y.a.a(A.m.prototype.gR.call(v)),t=v.q$
if(t==null)v.fy=new A.H(A.F(0,u.a,u.b),A.F(0,u.c,u.d))
else{t.cn(v.TF(u),!0)
v.fy=u.bB(v.q$.gp())}t=v.O.at
if(t!=null)if(t>v.gBm()){t=v.O
x=v.gBm()
w=v.O.at
w.toString
t.LQ(x-w)}else{t=v.O
x=t.at
x.toString
if(x<0)t.LQ(0-x)}v.O.wI(v.gapN())
v.O.tp(0,v.gBm())},
wc(d){var x,w=this
switch(w.n.a){case 0:x=new A.i(0,d-w.q$.gp().b+w.gp().b)
break
case 3:x=new A.i(d-w.q$.gp().a+w.gp().a,0)
break
case 1:x=new A.i(-d,0)
break
case 2:x=new A.i(0,-d)
break
default:x=null}return x},
X0(d){var x,w,v=this
switch(v.V.a){case 0:return!1
case 1:case 2:case 3:x=d.a
if(!(x<0)){w=d.b
x=w<0||x+v.q$.gp().a>v.gp().a||w+v.q$.gp().b>v.gp().b}else x=!0
return x}},
b_(d,e){var x,w,v,u,t,s=this
if(s.q$!=null){x=s.O.at
x.toString
w=s.wc(x)
x=new B.aLA(s,w)
v=s.af
if(s.X0(w)){u=s.cx
u===$&&A.a()
t=s.gp()
v.saE(d.ma(u,e,new A.G(0,0,0+t.a,0+t.b),x,s.V,v.a))}else{v.saE(null)
x.$2(d,e)}}},
l(){this.af.saE(null)
this.fg()},
dm(d,e){var x,w=this.O.at
w.toString
x=this.wc(w)
e.ec(x.a,x.b,0,1)},
oh(d){var x=this,w=x.O.at
w.toString
w=x.X0(x.wc(w))
if(w){w=x.gp()
return new A.G(0,0,0+w.a,0+w.b)}return null},
d1(d,e){var x,w=this
if(w.q$!=null){x=w.O.at
x.toString
return d.ka(new B.aLz(w),w.wc(x),e)}return!1},
rg(d,e,f,g){var x,w,v,u,t,s,r,q,p,o=this
A.bk(o.n)
if(g==null)g=d.gkA()
if(!(d instanceof A.y)){x=o.O.at
x.toString
return new D.m5(x,g)}w=A.e9(d.bf(o.q$),g)
v=o.q$.gp()
switch(o.n.a){case 0:x=w.d
x=new A.je(o.gp().b,v.b-x,x-w.b)
break
case 3:x=w.c
x=new A.je(o.gp().a,v.a-x,x-w.a)
break
case 1:x=w.a
x=new A.je(o.gp().a,x,w.c-x)
break
case 2:x=w.b
x=new A.je(o.gp().b,x,w.d-x)
break
default:x=null}u=x.a
t=null
s=null
r=x.b
q=x.c
s=q
t=r
p=t-(u-s)*e
return new D.m5(p,w.dw(o.wc(p)))},
Gf(d,e,f){return this.rg(d,e,null,f)},
dz(d,e,f,g){var x=this
if(!x.O.r.gpN())return x.pl(d,e,f,g)
x.pl(d,null,f,D.b_b(d,e,f,x.O,g,x))},
mv(){return this.dz(C.aW,null,C.w,null)},
kJ(d){return this.dz(C.aW,null,C.w,d)},
ly(d,e,f){return this.dz(d,null,e,f)},
kK(d,e){return this.dz(C.aW,d,C.w,e)},
M3(d){var x,w,v=this,u=v.gBm(),t=v.O.at
t.toString
x=u-t
switch(v.n.a){case 0:v.gp()
v.gp()
u=v.gp()
t=v.gp()
w=v.O.at
w.toString
return new A.G(0,0-x,0+u.a,0+t.b+w)
case 1:v.gp()
u=v.O.at
u.toString
v.gp()
return new A.G(0-u,0,0+v.gp().a+x,0+v.gp().b)
case 2:v.gp()
v.gp()
u=v.O.at
u.toString
return new A.G(0,0-u,0+v.gp().a,0+v.gp().b+x)
case 3:v.gp()
v.gp()
u=v.gp()
t=v.O.at
t.toString
return new A.G(0-x,0,0+u.a+t,0+v.gp().b)}},
$iz0:1}
B.On.prototype={
av(d){var x
this.dP(d)
x=this.q$
if(x!=null)x.av(d)},
am(){this.dG()
var x=this.q$
if(x!=null)x.am()}}
B.ac2.prototype={}
B.ac3.prototype={}
var z=a.updateTypes(["I(I)","Bn(x,iq)","~()","~({curve:e1,descendant:m?,duration:aN,rect:G?})"])
B.aQl.prototype={
$1(d){return d<=this.a},
$S:561}
B.aPQ.prototype={
$1(d){var x=this,w=A.L(B.b2h(x.a,x.b,d),B.b2h(x.c,x.d,d),x.e)
w.toString
return w},
$S:562}
B.ap8.prototype={
$1(d){var x=A.L(null,d,this.a)
x.toString
return x},
$S:75}
B.az_.prototype={
$2(d,e){return new B.Bn(this.c,e,C.G,this.a.a,null)},
$S:z+1}
B.az0.prototype={
$1(d){var x,w=A.akN(this.a)
if(d.d!=null&&!w.gj2()&&w.gc6()){x=$.aj.aq$.d.c
if(x!=null)x.hg()}return!1},
$S:216}
B.aLA.prototype={
$2(d,e){var x=this.a.q$
x.toString
d.d6(x,e.a2(0,this.b))},
$S:16}
B.aLz.prototype={
$2(d,e){return this.a.q$.cw(d,e)},
$S:10};(function aliases(){var x=B.On.prototype
x.aat=x.av
x.aau=x.am})();(function installTearOffs(){var x=a._instance_1u,w=a._instance_0u,v=a.installInstanceTearOff
var u
x(u=B.GF.prototype,"gbM","bs",0)
x(u,"gbA","br",0)
x(u,"gbw","bl",0)
x(u,"gbU","bk",0)
w(u=B.Mp.prototype,"gB8","ak1",2)
x(u,"gbM","bs",0)
x(u,"gbA","br",0)
x(u,"gbw","bl",0)
x(u,"gbU","bk",0)
v(u,"gnC",0,0,null,["$4$curve$descendant$duration$rect","$0","$1$rect","$3$curve$duration$rect","$2$descendant$rect"],["dz","mv","kJ","ly","kK"],3,0,0)})();(function inheritance(){var x=a.mixinHard,w=a.mixin,v=a.inheritMany,u=a.inherit
v(A.a7,[B.fB,B.a_7])
v(A.E,[B.aEY,B.amh])
v(A.f1,[B.aQl,B.aPQ,B.ap8,B.az0])
u(B.lS,B.amh)
u(B.GF,A.qb)
v(A.aY,[B.rF,B.Bn])
v(A.iK,[B.az_,B.aLA,B.aLz])
u(B.ac2,A.zs)
u(B.ac3,B.ac2)
u(B.a9r,B.ac3)
u(B.On,A.y)
u(B.Mp,B.On)
x(B.On,A.av)
w(B.ac2,A.G2)
w(B.ac3,D.a0w)})()
A.l8(b.typeUniverse,JSON.parse('{"fB":{"a7":[],"e":[]},"GF":{"y":[],"av":["y"],"m":[],"aa":[]},"rF":{"aY":[],"ah":[],"e":[]},"Bn":{"aY":[],"ah":[],"e":[]},"a_7":{"a7":[],"e":[]},"a9r":{"b0":[],"az":[],"x":[]},"Mp":{"y":[],"av":["y"],"z0":[],"m":[],"aa":[]}}'))
var y={a:A.T("a3"),h:A.T("w<k>"),e:A.T("w<e>"),m:A.T("de<hB>"),b:A.T("I")};(function constants(){E.kH=new A.cF(10,null,null,null)
E.J3=new A.cF(20,null,null,null)
E.d7=new A.cF(null,8,null,null)})()};
(a=>{a["x4BZqKhxUJJSZE19nxV7I9zJcso="]=a.current})($__dart_deferred_initializers__);