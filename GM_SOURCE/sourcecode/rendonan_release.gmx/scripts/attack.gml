//DOC:  attack(source_id, target_id, str, atkTimer, atkLimit, auto, force)
//DESC: instance source_id attacks target_id, subtracts targets health based on str when the attack is executed (see variable description below)
//NOTE: variables atkTimer, atkEvent must exist in source_id instance, currenthp must exist in target_id

//Initialize variables
var source_id, target_id, str, atkTimer, atkLimit, auto, force;
source_id   = argument0.id; //who executes the attack
target_id   = argument1.id; //who is attacked
str         = argument2; //strength, how much dmg will be done
atkTimer    = argument3; //current timer position, attack-delayer
atkLimit    = argument4; //atktimer queue after which the attack is executed
auto        = argument5; //defines if auto-attack is enabled
force       = argument6; //force attack, this being 1 forces the attack to execute

/*******************************/
var testmodule;
testmodule = "[attack] ";

test_is_real(   source_id,      testmodule+"source_id: ",   true);
test_is_real(   target_id,      testmodule+"target_id: ",   true);
test_is_real(   str,            testmodule+"str: ",         true);
test_is_real(   atkTimer,       testmodule+"atkTimer: ",    true);
test_is_real(   atkLimit,       testmodule+"atkLimit: ",    true);
test_is_real(   auto,           testmodule+"auto: ",        true);
test_is_real(   force,          testmodule+"force: ",       true);
/*******************************/

//Bugfix -> when attacking the player, the controllers stats should be affected
var subsource, subtarget;
subsource   = source_id;
subtarget   = target_id; //will change subtarget's stats, if target_id = player, subtarget = controller
if (instance_exists(obj_Player) && instance_exists(obj_Controller))
{
    if (source_id == obj_Player.id)
    {
        subsource = obj_Controller.id;
    }
    if (target_id == obj_Player.id)
    {
        subtarget = obj_Controller.id;
    }
}


//dmg = amount of damage that will be done. May be changed into a formula based on str (and possible future stats such as defence, agility etc.)
dmg = round(0.2*str + random(str) + random(1));

//ensure both source and target instances exist before executing
if (instance_exists(source_id) && instance_exists(target_id))
{
    //if atktimer exceeds limit (cooldown completed, ready to attack)
    if (atkTimer >= atkLimit)
    {
        //either auto-trigger or force-trigger (press atk-button) the attack
        if (auto || force)
        {
            //reset atktimer, start atkEvent, subtract str from target_id
            subsource.atkTimer  =   0;
            
            source_id.atkEvent  =   60; //timer-variable, defines duration of displaying the hit-msg, counts down to 0
            
            test_is_real(dmg, "Testing dmg variable in attack script: ", false);
            subtarget.currenthp -=  dmg
            
            notify(target_id.x,target_id.y,c_red,c_black,"HP -"+string(dmg),1,-3+random(6),-10);
            draw_sprite_ext(target_id.sprite_index,target_id.image_index,target_id.x-4+random(8),target_id.y-4+random(8),1.05,1.05,-2+random(4),c_red,0.6);
            instance_create(target_id.x,target_id.y,obj_Slash);
        }
    }
}

//return amount of damage done
return dmg;
