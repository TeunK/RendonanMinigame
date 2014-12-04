//DOC:  notify(x,y,bgcol,fontcol,text,gravity,hspeed,vspeed);
//DESC: Create notify instance with given x,y coordinates, bg/text colors, text, gravity, horizontal and vertical speed

//Initialize variables
var xx, yy, bgcol, fontcol, text, grav, hspd, vspd;
xx      = argument0;
yy      = argument1;
bgcol   = argument2;
fontcol = argument3;
text    = argument4;
grav    = argument5;
hspd    = argument6;
vspd    = argument7;

/*******************************/
var testmodule;
testmodule = "[notify] ";
test_is_real(xx,        testmodule+"xx: ",      true);
test_is_real(yy,        testmodule+"yy: ",      true);
test_is_real(bgcol,     testmodule+"bgcol: ",   true);
test_is_real(fontcol,   testmodule+"fontcol: ", true);
test_is_string(text,    testmodule+"xx: ",      true);
test_is_real(grav,      testmodule+"grav: ",    true);
test_is_real(hspd,      testmodule+"hspd: ",    true);
test_is_real(vspd,      testmodule+"vspd: ",    true);
/*******************************/

//CREATE NOTIFICATION INSTANCE
notification = instance_create(xx,yy,obj_Notifier);
notification.x = xx;
notification.y = yy;
notification.bgcolor = bgcol;
notification.textcolor = fontcol;
notification.text = text;
notification.gravity = grav;
notification.hspeed=hspd;
notification.vspeed=vspd;
