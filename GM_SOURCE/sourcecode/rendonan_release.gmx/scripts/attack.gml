//DOC:  attack(source_id, target_id, str, atktimer, atklimit, auto, force)
//DESC: instance source_id attacks target_id, subtracts targets health based on str when the attack is executed (see variable description below)
//NOTE: variables atkTimer, atkEvent must exist in source_id instance, currenthp must exist in target_id

//Initialize variables
var source_id, target_id, str, atkTimer, atkLimit, auto, force;
source_id   = argument0; //who executes the attack
target_id   = argument1; //who is attacked
str         = argument2; //strength, how much dmg will be done
atkTimer    = argument3; //current timer position, attack-delayer
atkLimit    = argument4; //atktimer queue after which the attack is executed
auto        = argument5; //defines if auto-attack is enabled
force       = argument6; //force attack, this being 1 forces the attack to execute

//dmg = amount of damage that will be done. May be changed into a formula based on str (and possible future stats such as defence, agility etc.)
dmg = str;

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
            source_id.atkTimer  =   0;
            source_id.atkEvent  =   20; //timer-variable, defines duration of displaying the hit-msg, counts down to 0
            target_id.currenthp -=  dmg
        }
    }
}

//return amount of damage done
return dmg;
