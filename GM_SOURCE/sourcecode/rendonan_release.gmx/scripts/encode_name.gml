//DOC:  encode_name(name, level)
//DESC: takes in a name and level, and returns a combination of the two in a neat fashion

//arg0 = name
//arg1 = level

//Initialize variables
var name, lvl;
name      = argument0;
lvl       = argument1;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[encode_name] ";

test_is_string(name,        testmodule+"name: ",       true);
test_is_real(  lvl,          testmodule+"lvl: ",       true);
/*******************************/

var newname;
newname = string("LV.")+string(lvl)+string(" ")+string(name);

return newname;
