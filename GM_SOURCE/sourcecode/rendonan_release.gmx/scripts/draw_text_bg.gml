//DOC:  draw_text_bg(xx,yy,message)
//DESC: draws message, but on top of a dark roundrectangular background

//Initialize variables
xx      = argument0;
yy      = argument1;
message = argument2;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[draw_text_bg] ";

test_is_real(   xx,      testmodule+"xx: ",   true);
test_is_real(   yy,      testmodule+"yy: ",   true);
test_is_string( message, testmodule+"message: ", true);
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

draw_set_color(c_black);
draw_set_alpha(1);
draw_roundrect(x_left, y_top, x_right, y_bottom,1);
draw_set_alpha(0.6);
draw_roundrect(x_left, y_top, x_right, y_bottom,0);

draw_set_alpha(1);
draw_set_color(c_orange);
draw_text(xx,yy,message);

draw_restore();
