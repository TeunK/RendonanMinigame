//background box
draw_set_alpha(0.8);
draw_set_color(c_black);
draw_roundrect(300,room_height-140,room_width-10,room_height-30,0);
draw_set_alpha(0.4);
draw_set_color(c_orange);
draw_roundrect(300,room_height-140,room_width-10,room_height-30,1);


test_timer(150,room_height-30,atkTimer, atkLimit, "Attack Due: ");

//ATTACK BUTTON
if (!autoatk)
{
    if (button_pressed(310,room_height-130,400,room_height-110,"Attack!"))
    {
        if (instance_exists(obj_Player) && instance_exists(obj_Monster))
        {
            attack(obj_Player, obj_Monster, strength, atkTimer, atkLimit, autoatk, 1);
        }
    }
}

//ATTACK COOLDOWN HEALTHBAR
draw_healthbar(420,room_height-130,room_width-40,room_height-110,calc_percent(atkTimer, atkLimit),c_red,c_red,c_lime,0,0,1);

//TOGGLE AUTO-ATTACK-MODE
if (button_pressed(310,room_height-100,400,room_height-80,autostr))
{
    autoatk = !autoatk;
    
    if (!autoatk)
    {
        autostr = "Manual Atk";    
    }
    else
    {
        autostr = "Auto Atk";
    }
}

//HEALTH POTION
if (button_pressed_ext(310,room_height-70,400,room_height-50,"Potion","+HP10: $20"))
{
    if (coins >= 20)
    {
        coins -= 20;
        currenthp += 10;
    }
}

//BUTTONS TO CHANGE ENCOUNTER MONSTER LEVEL
draw_monster_controller(880,room_height-70);

/*******************************
 -- Healthbar / Experiencebar --
*******************************/

draw_set_alpha(1);
draw_healthbar(room_width-20,room_height-15,10,room_height-10,calc_percent(currenthp,maxhp),c_red,c_red,c_lime,1,0,1);


