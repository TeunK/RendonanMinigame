//DOC:  test_timer(x, y, timer, limit, desc);
//DESC: displays true values of timer and limit

//Initialize variables
var xx, yy, timer, limit, desc;
xx          = argument0;
yy          = argument1;
timer       = argument2;
limit       = argument3;
desc        = argument4;

/*******************************/
var testmodule;
testmodule = "[test_timer] ";
test_is_real(   xx,         testmodule+"xx: ",    true);
test_is_real(   yy,         testmodule+"yy: ",    true);
test_is_real(   timer,      testmodule+"timer: ", true);
test_is_real(   limit,      testmodule+"limit: ", true);
test_is_string( desc,       testmodule+"desc: ",  true);
/*******************************/

draw_restore();

if (obj_Controller.test_mode == 1)
{
    draw_text_bg(xx,yy,string(desc)+string(timer)+"/"+string(limit));
}
