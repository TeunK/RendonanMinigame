//DOC:  calc_incAtkTimer(agility, auto)
//DESC: calculates by how much the attack timer has to increase, based on atility and auto-attack mode

//Initialize variables
var agi, mode_auto;
agi         = argument0;
mode_auto   = argument1;

/*******************************/
var testmodule;
testmodule = "[calc_incAtkTimer] ";
test_is_real(agi,       testmodule+"agi: ",         true);
test_is_real(mode_auto, testmodule+"mode_auto: ",   true);
/*******************************/

if (!mode_auto) 
{
    return (0.6+agi/50);
}
else
{
    return (0.3+agi/80);
}

