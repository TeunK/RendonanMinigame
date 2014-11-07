//DOC:  test_timer(x, y, atkTimer, atkLimit);
//DESC: displays true values

//Initialize variables
xx          = argument0;
yy          = argument1;
atkTimer    = argument2;
atkLimit    = argument3;

if (obj_Controller.test_mode == 1)
{
    draw_text(xx,yy,"Attack due: "+string(atkTimer)+"/"+string(atkLimit));
}
