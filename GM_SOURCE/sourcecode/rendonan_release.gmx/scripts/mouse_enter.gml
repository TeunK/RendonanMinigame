//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = mouse_x (mx)
//arg5 = mouse_y (my)
var x0, y0, x1, y1, mx, my;
x0 = argument0;
y0 = argument1;
x1 = argument2;
y1 = argument3;
mx = argument4;
my = argument5;

if  (
        //MOUSE WITHIN RECTANGLE DEFINED BY INPUT POINTS
        mx > x0 &&
        my > y0 &&
        mx < x1 &&
        my < y1
    )
{
    return true;
}
else
{
    return false;
}
