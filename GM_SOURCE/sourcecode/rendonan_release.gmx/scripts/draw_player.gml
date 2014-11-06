//draw player name
draw_set_halign(fa_center);
draw_text(x, y-6-0.5*sprite_get_height(sprite_index), username);
draw_set_halign(fa_left);

//draw player sprite
draw_sprite(sprite_index,image_index,x,y);

//draw player healthbar
draw_set_alpha(1);
hpPercent   = calc_percent(currenthp,maxhp);
draw_healthbar(x-0.5*sprite_get_width(sprite_index),y+10-0.5*sprite_get_height(sprite_index),x+0.5*sprite_get_width(sprite_index),y+20-0.5*sprite_get_height(sprite_index),hpPercent,c_red,c_red,c_lime,0,0,1);

//restore draw properties
draw_restore();
