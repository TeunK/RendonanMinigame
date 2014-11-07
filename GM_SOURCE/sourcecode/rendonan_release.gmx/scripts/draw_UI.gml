//DOC:  draw_UI(username, xp, coins, currenthp, maxhp, strength, agility)
//DESC: draws UI with given stats

//content
var margin_left, margin_top, spacing;
var username, xp, coins, currenthp, maxhp, strength, agility;

//Initialize Variables
margin_left = 60;
margin_top  = 20;
spacing     = 15;

username    = argument0;
xp          = round(argument1);
coins       = round(argument2);
currenthp   = round(argument3);
maxhp       = round(argument4);
strength    = round(argument5);
agility     = round(argument6);

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[draw_UI] ";

test_is_string( username,    testmodule+"username: ",    true);
test_is_real(   xp,          testmodule+"xp: ",          true);
test_is_real(   coins,       testmodule+"coins: ",       true);
test_is_real(   currenthp,   testmodule+"currenthp: ",   true);
test_is_real(   maxhp,       testmodule+"maxhp: ",       true);
test_is_real(   strength,    testmodule+"strength: ",    true);
test_is_real(   agility,     testmodule+"agility: ",     true);
/*******************************/


//draw background box
draw_set_alpha(0.5);
draw_set_color(c_black);
draw_rectangle(margin_left-50,margin_top-10,margin_left+340,margin_top+180,0);

//draw content
draw_set_alpha(1);
draw_set_color(c_white);
draw_text(margin_left,y+margin_top+0*spacing, "Username: "+username);
draw_text(margin_left,y+margin_top+1*spacing, "");
draw_text(margin_left,y+margin_top+2*spacing, "Experience: "+xp);
draw_text(margin_left,y+margin_top+3*spacing, "Coins: "+coins);
draw_text(margin_left,y+margin_top+4*spacing, "");
draw_text(margin_left,y+margin_top+5*spacing, "Health: "+currenthp+"/"+maxhp);
draw_text(margin_left,y+margin_top+6*spacing, "Strength: "+strength);
draw_text(margin_left,y+margin_top+7*spacing, "Agility: "+agility);
