//DOC:  button_pressed(x0,y0,x1,y1,string)
//DESC: Draws button in rectangular area defined by points (x0,y0), (x1,y1) along with the button inner text: str

//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = button string

//Initialize variables
var x0, y0, x1, y1, str;
x0  = argument0;
y0  = argument1;
x1  = argument2;
y1  = argument3;
str = argument4;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[button_pressed] ";

test_is_real(   x0,      testmodule+"x0: ",   true);
test_is_real(   y0,      testmodule+"y0: ",   true);
test_is_real(   x1,      testmodule+"x1: ",   true);
test_is_real(   y1,      testmodule+"y1: ",   true);
test_is_string( str,     testmodule+"str: ",  true);
/*******************************/

//modify button's opacity if cursor enters button area
if (enter_area(x0,y0,x1,y1,mouse_x,mouse_y)) { draw_set_alpha(0.2); } else { draw_set_alpha(0.6); }

//raw white rectangle at button position with given opacity
draw_set_color(c_white);
draw_rectangle(x0,y0,x1,y1,0);

//return opacity back to 1 and draw inner text in the center (in black)
draw_set_alpha(1);
draw_set_color(c_black);
draw_set_halign(fa_center);
draw_set_valign(fa_middle);
draw_text(x0+((x1-x0)/2), y0+((y1-y0)/2), str);

//restore draw values
draw_restore();

//test if button is pressed, return true if so
if (enter_area(x0,y0,x1,y1,mouse_x, mouse_y) && mouse_check_button_pressed(mb_left))
{
    return true;
}
