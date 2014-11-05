//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = button string

var x0, y0, x1, y1, str;
x0 = argument0;
y0 = argument1;
x1 = argument2;
y1 = argument3;
str = argument4;

if (mouse_enter(x0,y0,x1,y1))
{
    draw_set_alpha(0.2);
}
else
{
    draw_set_alpha(0.6);
}

draw_set_color(c_white);
draw_rectangle(x0,y0,x1,y1,0);

draw_set_alpha(1);
draw_set_color(c_black);
draw_set_halign(fa_center);
draw_set_valign(fa_middle);
draw_text(x0+((x1-x0)/2), y0+((y1-y0)/2), str);
draw_set_valign(fa_top);


draw_set_halign(fa_left);

draw_set_alpha(1);
draw_set_color(c_black);

if (mouse_enter(x0,y0,x1,y1,mouse_x, mouse_y) && mouse_check_button_pressed(mb_left))
{
    return true;
}
