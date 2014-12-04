//DOC:  outside_room(x,y);
//DESC: Tests whether point (x,y) falls outside room boundaries. returns true if it is the case

//Initialize variables
var xx, yy;
xx = argument0;
yy = argument1;

/*******************************/
var testmodule;
testmodule = "[outside_room] ";
test_is_real(xx,        testmodule+"xx: ",       true);
test_is_real(  yy,        testmodule+"yy: ",       true);
/*******************************/


if (xx < 0 || xx > room_width || yy < 0 || yy > room_height)
{
    return true;
}
else
{
    return false;
}
