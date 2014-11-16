//DOC:  draw_monster_controller(x,y)
//DESC: draws monster level-controller with level-string being centered at x,y

//arg0 = x
//arg1 = y

var centerx, centery;
centerx = argument0;
centery = argument1;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[draw_monster_controller] ";

test_is_real(   centerx,      testmodule+"centerx: ",   true);
test_is_real(   centery,      testmodule+"centery: ",   true);
/*******************************/


draw_set_color(c_black);
draw_set_alpha(0.6);
draw_roundrect(centerx-190,centery-25,centerx+70,centery+25,0);
draw_set_color(c_orange);
draw_set_alpha(1);
draw_roundrect(centerx-190,centery-25,centerx+70,centery+25,1);
draw_restore();
draw_text_bg(centerx-120,centery,"Monster Lv:");
//Draw +- buttons and level
if (button_pressed(centerx-60,centery-10,centerx-20,centery+10,"<<<"))
{
    if (monsterSpawnLevel > 1)
    {
        monsterSpawnLevel -=1;
    }
}
draw_text_bg(centerx,centery,string(monsterSpawnLevel));
if (button_pressed(centerx+20,centery-10,centerx+60,centery+10,">>>"))
{
    monsterSpawnLevel +=1;
}
