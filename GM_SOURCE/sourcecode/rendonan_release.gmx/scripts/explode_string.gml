//DOC:  explode_string(string, split_character)
//DESC: takes a string as input, and explodes it on split_character. ie. cuts string into slices at split_character and returns slices in form of an array

//Initialize variables
var str, splitter;
splitter    = argument1;
str         = argument0 + splitter;

/*******************************/
var testmodule;
testmodule = "[explode_string] ";

test_is_string(   splitter, testmodule+"splitter: ", true);
test_is_string(   str,      testmodule+"str: ",      true);
/*******************************/

var ind, len, pos, array;
ind         = 0;
len         = string_length(splitter);

//Split each substring upon splitter character and store them into array
repeat (string_count(splitter,str))
{
    pos = string_pos(splitter,str)-1;
    array[ind] = string_copy(str,1,pos); //(array,ind,string_copy(str,1,pos));
    str = string_delete(str,1,pos+len);
    ind += 1;
}
return array;
