//DOC:  draw_text_bg_ext(xx,yy,message,fontcolor,bgcolor,alpha)
//DESC: draws message similar to draw_text_bg, but with extended options to set font and background box color

//Initialize variables
xx      = argument0;
yy      = argument1;
message = argument2;
fontcol = argument3;
bgcol   = argument4;
alpha   = argument5;

/*******************************/
var testmodule;
testmodule = "[draw_text_bg_ext] ";
test_is_real(   xx,      testmodule+"xx: ",     true);
test_is_real(   yy,      testmodule+"yy: ",     true);
test_is_string( message, testmodule+"message: ",true);
test_is_real(   fontcol, testmodule+"fontcol: ",true);
test_is_real(   bgcol,   testmodule+"bgcol: ",  true);
test_is_real(   alpha,   testmodule+"alpha: ",  true);
/*******************************/

//markup variables
var margin, x_left, y_top, x_right, y_bottom;
margin      = 10;
x_left      = xx - margin - 0.5*string_width(message);
y_top       = yy - margin - 0.5*string_height(message);
x_right     = xx + margin + 0.5*string_width(message);
y_bottom    = yy + margin + 0.5*string_height(message);


draw_set_halign(fa_center);
draw_set_valign(fa_middle);

draw_set_color(bgcol);
draw_set_alpha(alpha);
draw_rectangle(x_left, y_top, x_right, y_bottom,1);
draw_set_alpha(alpha-0.1);
draw_rectangle(x_left, y_top, x_right, y_bottom,0);

draw_set_alpha(alpha);
draw_set_color(fontcol);
draw_text(xx,yy,message);

draw_restore();
