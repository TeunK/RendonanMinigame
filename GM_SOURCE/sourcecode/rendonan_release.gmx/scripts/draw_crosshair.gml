//DOC:  draw_crosshair(x,y)
//DESC: draws crosshair at point (x,y), only works in test-mode
//NOTE: requires obj_Controller to exist.

if (instance_exists(obj_Controller))
{
    if (test_mode==1)
    {
        //Initialize variables
        xx      = argument0;
        yy      = argument1;
        
        /*******************************/
        var testmodule;
        testmodule = "[draw_crosshair] ";
        test_is_real(   xx,      testmodule+"xx: ",   true);
        test_is_real(   yy,      testmodule+"yy: ",   true);
        /*******************************/
        
        draw_set_color(c_white);
        draw_set_alpha(1);
        
        //draw lines
        draw_line(xx,0,xx,room_height); //vertical line
        draw_line(0,yy,room_width,yy); //horizontal line
        
        //draw x/y position
        draw_text_bg(xx+60,yy+20,string("(")+string(xx)+string(",")+string(yy)+string(")"));
    }
}

