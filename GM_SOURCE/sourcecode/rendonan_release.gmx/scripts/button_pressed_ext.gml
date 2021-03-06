//DOC:  button_pressed_ext(x0,y0,x1,y1,string1,string2)
//DESC: Draws button in rectangular area defined by points (x0,y0), (x1,y1) along with the button inner text: string1, changes to string2 when onhover
//NOTE: Exactly same as button_pressed, except content string changes to string2 when hovered

//Initialize variables
var x0, y0, x1, y1, str1, str2;
x0      = argument0;
y0      = argument1;
x1      = argument2;
y1      = argument3;
str1    = argument4;
str2    = argument5;

/*******************************/
var testmodule;
testmodule = "[button_pressed_ext] ";
test_is_real(   x0,      testmodule+"x0: ",   true);
test_is_real(   y0,      testmodule+"y0: ",   true);
test_is_real(   x1,      testmodule+"x1: ",   true);
test_is_real(   y1,      testmodule+"y1: ",   true);
test_is_string( str1,     testmodule+"str1: ",  true);
test_is_string( str2,     testmodule+"str2: ",  true);
/*******************************/

//enter variable is a boolean, true if mouse entered given rectangle, false otherwise
var enter;
enter = enter_area(x0,y0,x1,y1,mouse_x,mouse_y);

//modify button's opacity if cursor enters button area
if (enter) { draw_set_alpha(0.6); } else { draw_set_alpha(1); }

//raw white rectangle at button position with given opacity
draw_set_color(c_white);
draw_rectangle(x0,y0,x1,y1,0);
draw_set_color(c_gray);
draw_rectangle(x0,y0,x1,y1,1);

//return opacity back to 1 and draw inner text in the center (in black)
draw_set_alpha(1);
draw_set_color(c_black);
draw_set_halign(fa_center);
draw_set_valign(fa_middle);

//draw content string
if (!enter) 
{ 
    draw_text(x0+((x1-x0)/2), y0+((y1-y0)/2), str1); 
}
else
{ 
    draw_text(x0+((x1-x0)/2), y0+((y1-y0)/2), str2); 
}


//restore draw values
draw_restore();

//test if button is pressed, return true if so
if (enter_area(x0,y0,x1,y1,mouse_x, mouse_y) && mouse_check_button_pressed(mb_left))
{
    return true;
}
