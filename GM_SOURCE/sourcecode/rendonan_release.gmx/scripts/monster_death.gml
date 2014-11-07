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
    instance_destroy();
    obj_Controller.xp += xpgain;
    obj_Controller.coins += moneygain;
}
