//DOC:  mouse_enter(x0,y0,x1,y1,x_pos,y_pos
//DESC: Returns true if the point (x_pos,y_pos) is inside the rectangle defined by points (x0,y0), (x1,y1)

//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = x_pos
//arg5 = y_pos

//Initialize variables
var x0, y0, x1, y1, x_pos, y_pos;
x0      = argument0;
y0      = argument1;
x1      = argument2;
y1      = argument3;
x_pos   = argument4;
y_pos   = argument5;

//Test positions and return the boolean accordingly
if  (
        //(x_pos,y_pos) WITHIN RECTANGLE DEFINED BY INPUT POINTS
        x_pos > x0 &&
        y_pos > y0 &&
        x_pos < x1 &&
        y_pos < y1
    )
{ return true; } else { return false; }
