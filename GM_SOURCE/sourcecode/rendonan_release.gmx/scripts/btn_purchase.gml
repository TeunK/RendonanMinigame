//DOC:  btn_purchase(id,adds)
//DESC: Adds the adds-amount to the controller's stat
//NOTE: Depends on obj_Controller. Dependency is safe as obj_Controller is persistent and must always exist.

//arg0 = id
//arg1 = adds

//Initialize variables
var btn_id, adds;
btn_id  = argument0;
adds    = argument1;

/*******************************/
var testmodule;
testmodule = "[btn_purchase] ";
test_is_real(   btn_id,    testmodule+"btn_id: ",   true);
test_is_real(   adds,      testmodule+"adds: ",     true);
/*******************************/

//check which to which stat the specified button belongs, then update this stat
if (btn_id==obj_Controller.btnHP)
{
    obj_Controller.maxhp+=adds;
}
else if (btn_id==obj_Controller.btnStr)
{
    obj_Controller.strength+=adds;
}
else if (btn_id==obj_Controller.btnAgi)
{
    obj_Controller.agility+=adds;
}
