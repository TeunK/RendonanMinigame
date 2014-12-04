//DOC:  monster_death(hp,xpgain,moneygain);
//DESC: checks if health drops below 0, if so, adds xpgain and moneygain to the controller stats
//NOTE: Depends on obj_Controller. Dependency is safe as obj_Controller is persistent and must always exist.

//Initialize variables
hp          = argument0;
xpgain      = argument1;
moneygain   = argument2;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[monster_death] ";

test_is_real(   hp,         testmodule+"hp: ",          true);
test_is_real(   xpgain,     testmodule+"xpgain: ",      true);
test_is_real(   moneygain,  testmodule+"moneygain: ",   true);
/*******************************/

//main function
if (hp <= 0)
{
    //test if player leveled up, if so: create notification for this
    if (calc_playerLevel(obj_Controller.xp) != calc_playerLevel(obj_Controller.xp+xpgain))
    {
        for (i=0; i<5; i+=1)
        {
            notify(obj_Player.x,obj_Player.y,c_yellow,c_black,"LEVEL UP!",0.6+random(0.6),6+random(6),-10-random(10));
        }
    }
    
    instance_destroy();
    obj_Controller.xp += xpgain;
    obj_Controller.coins += moneygain;
    
    notify(x,y,c_red,c_black,"Enemy Monster Died",1,-12,-15);
    notify(x,y,c_yellow,c_black,"XP "+string(xpgain),1.5,-8,-12);
    notify(x,y,c_yellow,c_black,"$ "+string(moneygain),1.6,-8,-10);
}
