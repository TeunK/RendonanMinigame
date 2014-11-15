//DOC:  implode_array(array, split_character);
//DESC: takes array as input and returns each element concatenated with the ; character as string

//arg0 = input array
var array, splitter;
array       = argument0;
splitter    = argument1;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[implode_array] ";

test_is_string(   splitter,        testmodule+"splitter: ",       true);
/*******************************/

var i, fullstring;
fullstring = "";
for (i=0; i<array_length_1d(array); i+=1)
{   
    fullstring += string(array[i])+string(splitter);
}

return fullstring
