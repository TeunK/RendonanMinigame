//DOC:  test_toggleActiveMode(key)
//DESC: toggles active-testing mode, when active: display popups with test results
//NOTE: requires caller to have active_testing and test_mode varibles defined, also must be called in draw-event

//Initialize variables
var key;
key = argument0;

if keyboard_check_pressed(key)
{
    //toggle active_testing upon key-ress
    active_testing = (active_testing+1) mod 2;
}

//draw active_testing mode
if (test_mode == obj_Controller.t_test)
{
    if (active_testing)
    {
        draw_set_color(c_lime);
    }
    else
    {
        draw_set_color(c_red);
    }
    //draw rectangle in top-right corner indicating if active_testing is on or off
    draw_rectangle(room_width-20,0,room_width,20,0);
    
    //draw description of this indicator and how to toggle
    draw_set_halign(fa_right);
    draw_set_valign(fa_middle);
    draw_set_color(c_black);
    draw_text(room_width-25,10,"active_testing: ");
    
    draw_restore();
}
