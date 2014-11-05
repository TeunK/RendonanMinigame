//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
var x0, y0, x1, y1;
x0 = argument0;
y0 = argument1;
x1 = argument2;
y1 = argument3;

if  (
        //MOUSE WITHIN RECTANGLE DEFINED BY INPUT POINTS
        mouse_x > x0 &&
        mouse_y > y0 &&
        mouse_x < x1 &&
        mouse_y < y1
    )
{
    return true;
}
else
{
    return false;
}
