((a,b)=>{a[b]=a[b]||{}})(self,"$__dart_deferred_initializers__")
$__dart_deferred_initializers__.current=function(a,b,c,$){var J,A,C,D,F,B={fB:function fB(d,e,f,g){var _=this
_.c=d
_.d=e
_.e=f
_.a=g},
b2m(d,e,f){var x,w,v,u,t
if(f<=C.b.gap(e))return C.b.gap(d)
if(f>=C.b.gaY(e))return C.b.gaY(d)
x=C.b.ayB(e,new B.aQq(f))
w=d[x]
v=x+1
u=d[v]
t=e[x]
t=A.L(w,u,(f-t)/(e[v]-t))
t.toString
return t},
bir(d,e,f,g,h){var x,w,v=A.a_K(null,null,y.b)
v.a1(0,e)
v.a1(0,g)
x=A.a2(v,v.$ti.c)
x.$flags=1
w=x
x=A.Y(w).i("ag<1,z>")
x=A.a2(new A.ag(w,new B.aPV(d,e,f,g,h),x),x.i("at.E"))
x.$flags=1
return new B.aF2(x,w)},
aZ2(d,e,f){var x,w,v,u,t
if(d==e)return d
if(d==null)return e.b6(f)
if(e==null)return d.b6(1-f)
x=B.bir(d.a,d.IX(),e.a,e.IX(),f)
w=A.rE(d.d,e.d,f)
w.toString
v=A.rE(d.e,e.e,f)
v.toString
u=f<0.5
t=u?d.f:e.f
u=u?d.c:e.c
return new B.lR(w,v,t,x.a,x.b,u)},
aF2:function aF2(d,e){this.a=d
this.b=e},
aQq:function aQq(d){this.a=d},
aPV:function aPV(d,e,f,g,h){var _=this
_.a=d
_.b=e
_.c=f
_.d=g
_.e=h},
amj:function amj(){},
lR:function lR(d,e,f,g,h,i){var _=this
_.d=d
_.e=e
_.f=f
_.a=g
_.b=h
_.c=i},
apa:function apa(d){this.a=d},
GI:function GI(d,e,f,g){var _=this
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
rI:function rI(d,e,f){this.e=d
this.c=e
this.a=f},
hC(d,e,f){return new B.a_9(f,e,d,null)},
a_9:function a_9(d,e,f,g){var _=this
_.e=d
_.f=e
_.x=f
_.a=g},
az4:function az4(d,e,f){this.a=d
this.b=e
this.c=f},
az5:function az5(d){this.a=d},
Bq:function Bq(d,e,f,g,h){var _=this
_.e=d
_.f=e
_.r=f
_.c=g
_.a=h},
a9t:function a9t(d,e){var _=this
_.c=_.b=_.a=_.CW=_.ay=_.p1=null
_.d=$
_.e=d
_.r=_.f=null
_.w=e
_.z=_.y=null
_.Q=!1
_.as=!0
_.at=!1},
Ms:function Ms(d,e,f,g,h,i,j){var _=this
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
aLF:function aLF(d,e){this.a=d
this.b=e},
aLE:function aLE(d){this.a=d},
Oq:function Oq(){},
ac4:function ac4(){},
ac5:function ac5(){},
rR(d,e){var x=new A.bf(d,e,C.I,-1)
return new A.dD(x,x,x,x)}},E
J=c[1]
A=c[0]
C=c[2]
D=c[15]
F=c[16]
B=a.updateHolder(c[13],B)
E=c[20]
B.fB.prototype={
J(d){var x=null,w=A.b([A.Gp(0,A.pn(this.d,C.dN,x,x))],y.e)
w.push(A.Gp(0,A.bZ(x,x,C.n,C.m.dw(0.36),x,x,x,x,x,x,x,x,x)))
w.push(A.ii(x,C.A,this.c,x))
return A.fc(C.bD,w,C.G,C.be,x)},
gN(){return this.c}}
B.aF2.prototype={}
B.amj.prototype={
IX(){var x,w,v,u=this.b
if(u!=null)return u
u=this.a.length
x=1/(u-1)
w=J.aoj(u,y.b)
for(v=0;v<u;++v)w[v]=v*x
return w}}
B.lR.prototype={
a_C(d,e){var x=this,w=x.d.ah(e).a44(d),v=x.e.ah(e).a44(d),u=x.IX()
return A.aTa(w,v,x.a,u,x.f,null)},
b6(d){var x=this,w=x.a,v=A.Y(w).i("ag<1,z>")
w=A.a2(new A.ag(w,new B.apa(d),v),v.i("at.E"))
return new B.lR(x.d,x.e,x.f,w,x.b,null)},
e4(d,e){var x=B.aZ2(d,this,e)
return x},
e5(d,e){var x=B.aZ2(this,d,e)
return x},
k(d,e){var x=this
if(e==null)return!1
if(x===e)return!0
if(J.W(e)!==A.A(x))return!1
return e instanceof B.lR&&e.d.k(0,x.d)&&e.e.k(0,x.e)&&e.f===x.f&&A.cR(e.a,x.a)&&A.cR(e.b,x.b)},
gt(d){var x=this,w=A.bW(x.a),v=x.b
v=v==null?null:A.bW(v)
return A.R(x.d,x.e,x.f,x.c,w,v,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a,C.a)},
j(d){var x=this,w=A.b(["begin: "+x.d.j(0),"end: "+x.e.j(0),"colors: "+A.f(x.a)],y.h),v=x.b
if(v!=null)w.push("stops: "+A.f(v))
w.push("tileMode: "+x.f.j(0))
return"LinearGradient("+C.b.bF(w,", ")+")"}}
B.GI.prototype={
sL4(d){if(this.B===d)return
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
ac4(d){var x,w,v,u,t=d.a,s=d.b
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
ct(d){return this.ac4(d)},
ea(d,e){return this.QR(A.iG(this.ad(C.P,d,this.gcz())),e)},
bC(){var x,w=this
w.fy=w.ad(C.P,y.a.a(A.m.prototype.gR.call(w)),w.gcz())
x=w.q$
if(x!=null)x.h9(A.iG(w.gp()))}}
B.rI.prototype={
aO(d){var x=new B.GI(this.e,null,new A.aH(),A.a5())
x.aN()
x.sN(null)
return x},
aW(d,e){e.sL4(this.e)}}
B.a_9.prototype={
J(d){var x,w,v,u,t,s=this,r=null,q={},p=D.b2V(d,C.aI,!1),o=s.x
q.a=o
x=s.e
if(x!=null)q.a=new A.aU(x,o,r)
w=s.f==null&&D.aZV(d,C.aI)
v=w?A.yR(d):s.f
u=D.aTW(p,C.G,v,C.ae,!1,C.aw,r,r,r,r,r,new B.az4(q,s,p))
t=A.kJ(d).zn(d)
if(t===F.Ia)u=new A.de(new B.az5(d),u,r,y.m)
return w&&v!=null?D.aZU(u):u},
gN(){return this.x}}
B.Bq.prototype={
aO(d){var x=new B.Ms(this.e,this.f,this.r,A.a5(),null,new A.aH(),A.a5())
x.aN()
x.sN(null)
return x},
aW(d,e){var x
e.sdK(this.e)
e.sd4(this.f)
x=this.r
if(x!==e.V){e.V=x
e.aQ()
e.bo()}},
cl(){return new B.a9t(this,C.a8)}}
B.a9t.prototype={}
B.Ms.prototype={
sdK(d){if(d===this.n)return
this.n=d
this.a4()},
sd4(d){var x=this,w=x.O
if(d===w)return
if(x.y!=null)w.M(x.gB7())
x.O=d
if(x.y!=null)d.a5(x.gB7())
x.a4()},
ak0(){this.aQ()
this.bo()},
f4(d){if(!(d.b instanceof A.cU))d.b=new A.cU()},
av(d){this.aas(d)
this.O.a5(this.gB7())},
am(){this.O.M(this.gB7())
this.aat()},
gfp(){return!0},
gapM(){switch(A.bk(this.n).a){case 0:var x=this.gp().a
break
case 1:x=this.gp().b
break
default:x=null}return x},
gBl(){var x=this,w=x.q$
if(w==null)return 0
switch(A.bk(x.n).a){case 0:w=w.gp().a-x.gp().a
break
case 1:w=w.gp().b-x.gp().b
break
default:w=null}return Math.max(0,A.rr(w))},
TE(d){var x
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
return d.bB(x.ad(C.P,this.TE(d),x.gcz()))},
bC(){var x,w,v=this,u=y.a.a(A.m.prototype.gR.call(v)),t=v.q$
if(t==null)v.fy=new A.H(A.F(0,u.a,u.b),A.F(0,u.c,u.d))
else{t.cn(v.TE(u),!0)
v.fy=u.bB(v.q$.gp())}t=v.O.at
if(t!=null)if(t>v.gBl()){t=v.O
x=v.gBl()
w=v.O.at
w.toString
t.LP(x-w)}else{t=v.O
x=t.at
x.toString
if(x<0)t.LP(0-x)}v.O.wH(v.gapM())
v.O.tn(0,v.gBl())},
wb(d){var x,w=this
switch(w.n.a){case 0:x=new A.i(0,d-w.q$.gp().b+w.gp().b)
break
case 3:x=new A.i(d-w.q$.gp().a+w.gp().a,0)
break
case 1:x=new A.i(-d,0)
break
case 2:x=new A.i(0,-d)
break
default:x=null}return x},
X_(d){var x,w,v=this
switch(v.V.a){case 0:return!1
case 1:case 2:case 3:x=d.a
if(!(x<0)){w=d.b
x=w<0||x+v.q$.gp().a>v.gp().a||w+v.q$.gp().b>v.gp().b}else x=!0
return x}},
b_(d,e){var x,w,v,u,t,s=this
if(s.q$!=null){x=s.O.at
x.toString
w=s.wb(x)
x=new B.aLF(s,w)
v=s.af
if(s.X_(w)){u=s.cx
u===$&&A.a()
t=s.gp()
v.saE(d.m9(u,e,new A.G(0,0,0+t.a,0+t.b),x,s.V,v.a))}else{v.saE(null)
x.$2(d,e)}}},
l(){this.af.saE(null)
this.ff()},
dn(d,e){var x,w=this.O.at
w.toString
x=this.wb(w)
e.ec(x.a,x.b,0,1)},
oh(d){var x=this,w=x.O.at
w.toString
w=x.X_(x.wb(w))
if(w){w=x.gp()
return new A.G(0,0,0+w.a,0+w.b)}return null},
d1(d,e){var x,w=this
if(w.q$!=null){x=w.O.at
x.toString
return d.k9(new B.aLE(w),w.wb(x),e)}return!1},
rf(d,e,f,g){var x,w,v,u,t,s,r,q,p,o=this
A.bk(o.n)
if(g==null)g=d.gkA()
if(!(d instanceof A.y)){x=o.O.at
x.toString
return new D.m4(x,g)}w=A.ea(d.bf(o.q$),g)
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
return new D.m4(p,w.dz(o.wb(p)))},
Ge(d,e,f){return this.rf(d,e,null,f)},
dA(d,e,f,g){var x=this
if(!x.O.r.gpN())return x.pl(d,e,f,g)
x.pl(d,null,f,D.b_g(d,e,f,x.O,g,x))},
mu(){return this.dA(C.aW,null,C.w,null)},
kJ(d){return this.dA(C.aW,null,C.w,d)},
lx(d,e,f){return this.dA(d,null,e,f)},
kK(d,e){return this.dA(C.aW,d,C.w,e)},
M2(d){var x,w,v=this,u=v.gBl(),t=v.O.at
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
$iz2:1}
B.Oq.prototype={
av(d){var x
this.dQ(d)
x=this.q$
if(x!=null)x.av(d)},
am(){this.dH()
var x=this.q$
if(x!=null)x.am()}}
B.ac4.prototype={}
B.ac5.prototype={}
var z=a.updateTypes(["I(I)","Bq(w,ir)","~()","~({curve:e2,descendant:m?,duration:aN,rect:G?})"])
B.aQq.prototype={
$1(d){return d<=this.a},
$S:563}
B.aPV.prototype={
$1(d){var x=this,w=A.L(B.b2m(x.a,x.b,d),B.b2m(x.c,x.d,d),x.e)
w.toString
return w},
$S:564}
B.apa.prototype={
$1(d){var x=A.L(null,d,this.a)
x.toString
return x},
$S:69}
B.az4.prototype={
$2(d,e){return new B.Bq(this.c,e,C.G,this.a.a,null)},
$S:z+1}
B.az5.prototype={
$1(d){var x,w=A.akP(this.a)
if(d.d!=null&&!w.gj2()&&w.gc7()){x=$.aj.aq$.d.c
if(x!=null)x.hf()}return!1},
$S:187}
B.aLF.prototype={
$2(d,e){var x=this.a.q$
x.toString
d.d6(x,e.a2(0,this.b))},
$S:17}
B.aLE.prototype={
$2(d,e){return this.a.q$.cw(d,e)},
$S:10};(function aliases(){var x=B.Oq.prototype
x.aas=x.av
x.aat=x.am})();(function installTearOffs(){var x=a._instance_1u,w=a._instance_0u,v=a.installInstanceTearOff
var u
x(u=B.GI.prototype,"gbM","bs",0)
x(u,"gbA","br",0)
x(u,"gbw","bl",0)
x(u,"gbU","bk",0)
w(u=B.Ms.prototype,"gB7","ak0",2)
x(u,"gbM","bs",0)
x(u,"gbA","br",0)
x(u,"gbw","bl",0)
x(u,"gbU","bk",0)
v(u,"gnC",0,0,null,["$4$curve$descendant$duration$rect","$0","$1$rect","$3$curve$duration$rect","$2$descendant$rect"],["dA","mu","kJ","lx","kK"],3,0,0)})();(function inheritance(){var x=a.mixinHard,w=a.mixin,v=a.inheritMany,u=a.inherit
v(A.a7,[B.fB,B.a_9])
v(A.E,[B.aF2,B.amj])
v(A.f1,[B.aQq,B.aPV,B.apa,B.az5])
u(B.lR,B.amj)
u(B.GI,A.qc)
v(A.aY,[B.rI,B.Bq])
v(A.iL,[B.az4,B.aLF,B.aLE])
u(B.ac4,A.zu)
u(B.ac5,B.ac4)
u(B.a9t,B.ac5)
u(B.Oq,A.y)
u(B.Ms,B.Oq)
x(B.Oq,A.av)
w(B.ac4,A.G6)
w(B.ac5,D.a0y)})()
A.l7(b.typeUniverse,JSON.parse('{"fB":{"a7":[],"e":[]},"GI":{"y":[],"av":["y"],"m":[],"aa":[]},"rI":{"aY":[],"ah":[],"e":[]},"Bq":{"aY":[],"ah":[],"e":[]},"a_9":{"a7":[],"e":[]},"a9t":{"b0":[],"az":[],"w":[]},"Ms":{"y":[],"av":["y"],"z2":[],"m":[],"aa":[]}}'))
var y={a:A.T("a3"),h:A.T("x<k>"),e:A.T("x<e>"),m:A.T("de<hB>"),b:A.T("I")};(function constants(){E.kH=new A.cF(10,null,null,null)
E.J3=new A.cF(20,null,null,null)
E.d7=new A.cF(null,8,null,null)})()};
(a=>{a["XYX4AA9j+mR2j2LMLqgUKEmxt1Q="]=a.current})($__dart_deferred_initializers__);
//# sourceMappingURL=main.dart.js_13.part.js.map
