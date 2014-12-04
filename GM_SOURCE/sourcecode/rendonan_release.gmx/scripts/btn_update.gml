//DOC:  button_pressed(id)
//DESC: calculates the upgrade-cost and stat-add variables depending on the button in question
//NOTE: Depends on obj_Controller. Dependency is safe as obj_Controller is persistent and must always exist.

//arg0 = id

//Initialize variables
var btn_id;
btn_id = argument0;

/*******************************/
var testmodule;
testmodule = "[btn_update] ";
test_is_real(   btn_id,      testmodule+"btn_id: ",     true);
/*******************************/

//Define cost / adds
if (btn_id==obj_Controller.btnHP)
{
    cost = 0.1*obj_Controller.maxhp;
    adds = 10;
}
else if (btn_id==obj_Controller.btnStr)
{
    cost = 7+obj_Controller.strength*3;
    adds = 1+round(obj_Controller.strength/5);
}
else if (btn_id==obj_Controller.btnAgi)
{
    cost = 10+obj_Controller.agility*2;
    adds = 1+round(obj_Controller.agility/5);
}
