//DOC:  enter_area(x0,y0,x1,y1,x_pos,y_pos
//DESC: Returns true if the point (x_pos,y_pos) is inside the rectangle defined by points (x0,y0), (x1,y1)

//Initialize variables
var x0, y0, x1, y1, x_pos, y_pos;
x0      = argument0;
y0      = argument1;
x1      = argument2;
y1      = argument3;
x_pos   = argument4;
y_pos   = argument5;

/*******************************/
var testmodule;
testmodule = "[enter_area] ";
test_is_real(   x0,        testmodule+"x0: ",       true);
test_is_real(   y0,        testmodule+"y0: ",       true);
test_is_real(   x1,        testmodule+"x1: ",       true);
test_is_real(   y1,        testmodule+"y1: ",       true);
test_is_real(   x_pos,     testmodule+"x_pos: ",    true);
test_is_real(   y_pos,     testmodule+"y_pos: ",    true);
/*******************************/

//Test positions and return the boolean accordingly
if  (
        //(x_pos,y_pos) WITHIN RECTANGLE DEFINED BY INPUT POINTS
        x_pos > x0 &&
        y_pos > y0 &&
        x_pos < x1 &&
        y_pos < y1
    )
{ return true; } else { return false; }
