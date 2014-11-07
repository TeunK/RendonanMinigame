//DOC:  test_timer(x, y, atkTimer, atkLimit);
//DESC: displays true values

//Initialize variables
xx          = argument0;
yy          = argument1;
atkTimer    = argument2;
atkLimit    = argument3;

draw_restore();

if (obj_Controller.test_mode == 1)
{
    draw_text_bg(xx,yy,"Attack due: "+string(atkTimer)+"/"+string(atkLimit));
}
