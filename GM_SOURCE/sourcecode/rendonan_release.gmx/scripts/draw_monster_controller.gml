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
