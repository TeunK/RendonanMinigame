//DOC:  draw_dmg(src_id,tgt_id,src_name,damage)
//DESC: draws line from source point to target point, and displays the fact that source_name has hit the target by [damage] damage.
//NOTE: src must have atkEvent variable defined

//Initializing variables
src_id      = argument0;
tgt_id      = argument1;
src_name    = argument2;
dmg         = argument3;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[draw_dmg] ";

test_is_real(   src_id,         testmodule+"src_id: ",      true);
test_is_real(   tgt_id,         testmodule+"tgt_id: ",      true);
test_is_string( src_name,       testmodule+"src_name: ",    true);
test_is_real(   dmg,            testmodule+"dmg: ",         true);
/*******************************/

//extract x/y positions from source and target instances
src_x       = src_id.x;
src_y       = src_id.y;
tgt_x       = tgt_id.x+40;
tgt_y       = tgt_id.y;

//markup variables
message     = string(src_name)+string(" strikes!#DMG: ")+string(dmg);
margin      = 10;

//draw line and hit message
if (src_id.atkEvent > 40)
{
    draw_set_color(c_red);
    draw_line(src_x,src_y,tgt_x,tgt_y);
    draw_set_color(c_orange);
    draw_line(src_x,src_y-1,tgt_x,tgt_y-1);
    draw_line(src_x,src_y+1,tgt_x,tgt_y+1);
}

draw_set_color(c_black);
draw_set_alpha(1);
draw_roundrect(tgt_x-margin, tgt_y-margin, tgt_x+margin+string_width(message), tgt_y+margin+string_height(message),1);
draw_set_alpha(0.6);
draw_roundrect(tgt_x-margin, tgt_y-margin, tgt_x+margin+string_width(message), tgt_y+margin+string_height(message),0);

draw_set_alpha(1);
draw_set_color(c_orange);
draw_text(tgt_x,tgt_y,message);

//subtract atkEvent timer (-1 every (1/30) seconds)
src_id.atkEvent -=1;

draw_restore();
