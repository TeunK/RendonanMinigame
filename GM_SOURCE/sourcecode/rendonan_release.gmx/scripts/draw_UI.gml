//DOC:  draw_UI(username, xp, coins, currenthp, maxhp, strength, agility)
//DESC: draws UI with given stats

//content
var margin_left, margin_top, spacing;
var username, xp, coins, currenthp, maxhp, strength, agility;

margin      = 60;
margin_top  = 20;
spacing     = 15;

username    = argument0;
xp          = argument1;
coins       = argument2;
currenthp   = argument3;
maxhp       = argument4;
strength    = argument5;
agility     = argument6;

draw_set_alpha(1);
draw_set_color(c_white);
draw_text(margin,y+margin_top+0*spacing, "Username: "+username);
draw_text(margin,y+margin_top+1*spacing, "");
draw_text(margin,y+margin_top+2*spacing, "Experience: "+xp);
draw_text(margin,y+margin_top+3*spacing, "Coins: "+coins);
draw_text(margin,y+margin_top+4*spacing, "");
draw_text(margin,y+margin_top+5*spacing, "Health: "+currenthp+"/"+maxhp);
draw_text(margin,y+margin_top+6*spacing, "Strength: "+strength);
draw_text(margin,y+margin_top+7*spacing, "Agility: "+agility);
