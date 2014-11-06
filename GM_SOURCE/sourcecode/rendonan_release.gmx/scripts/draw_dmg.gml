//DOC:  draw_dmg(src_id,tgt_id,src_name,damage)
//DESC: draws line from source point to target point, and displays the fact that source_name has hit the target by [damage] damage.
//NOTE: src must have atkEvent variable defined

//Initializing variables
src_id      = argument0;
tgt_id      = argument1;
src_name    = argument2;
dmg         = argument3;

//extract x/y positions from source and target instances
src_x       = src_id.x;
src_y       = src_id.y;
tgt_x       = tgt_id.x;
tgt_y       = tgt_id.y;

//draw line and hit message
draw_set_color(c_orange)
draw_line(src_x,src_y,tgt_x,tgt_y)
draw_text(tgt_x,tgt_y,string(src_name)+string(" strikes!#DMG: ")+string(dmg));

//subtract atkEvent timer (-1 every (1/30) seconds)
src_id.atkEvent -=1;
