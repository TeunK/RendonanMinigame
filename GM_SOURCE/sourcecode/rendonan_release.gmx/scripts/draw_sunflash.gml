//DOC:  draw_sunflash(x,y, sunflashTimer, sunflashLimit);
//DESC: draws sunflash super-skill at x,y position, using given timer for cooldown

//arg0 = x
//arg0 = y
//arg0 = sunflashTimer, counting
//arg0 = sunflashLimit, point when counting finishes


//Initialize variables
var xx,yy,timer,limit;
xx      = argument0;
yy      = argument1;
timer   = argument2;
limit   = argument3;

/*******************************/
var testmodule;
testmodule = "[draw_sunflash] ";
test_is_real(   xx,      testmodule+"xx: ",     true);
test_is_real(   yy,      testmodule+"yy: ",     true);
test_is_real(   timer,   testmodule+"timer: ",  true);
test_is_real(   limit,   testmodule+"limit: ",  true);
/*******************************/

//calculate percentage until timer reaches limit
var percent;
percent = (timer/limit)*100

//change variable names for clarity
var left, right, top, bottom;
left    = xx;
top     = yy;
right   = left+260
bottom  = yy+40

//Draw sunflash Icon
draw_sprite(spr_Sunburst,0,left,top);
draw_set_color(c_orange);

//make drawing opacity a function based on how far the charge is
draw_set_alpha(percent/100)
//rectangle border surrounding image
draw_roundrect(left,top,right,bottom,1);
draw_roundrect(left+2,top+2,right-2,bottom-2,1);

draw_restore();
draw_healthbar(left,bottom,right,bottom+10,percent,c_black,c_blue,c_red,0,1,1);

//fully charged
if (percent == 100)
{
    if (instance_exists(obj_Monster) && instance_exists(obj_Player))
    {
        if (button_pressed_ext(left+20,bottom-10,right-20,bottom+20,"CHARGE COMPLETE","Activate Sunflash"))
        {
            //sfx flash screen
            draw_set_alpha(0.9);
            draw_set_color(c_white);
            draw_rectangle(0,0,room_width,room_height,0);
            
            //reset timer
            obj_Controller.sunflashTimer = 0;
            
            //add special effect: sunflash particles
            sunflash = instance_create(obj_Monster.x,obj_Monster.y,obj_Sunflash);
        }
    }
}


