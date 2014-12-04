//DOC:  calc_playerLevel(xp)
//DESC: calculates player level based on xp and returns it.

//Initialize variables
var xp;
xp = argument0;

/*******************************/
var testmodule;
testmodule = "[calc_playerLevel] ";
test_is_real(xp, testmodule+"xp: ", true);
/*******************************/

if (xp == 0)
{
    return 0;
}
else
{
    return floor(logn(2,(xp/5)));
}

