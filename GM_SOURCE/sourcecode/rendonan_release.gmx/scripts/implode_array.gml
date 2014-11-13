//DOC:  implode_array(array, split_character);
//DESC: takes array as input and returns each element concatenated with the ; character as string

//arg0 = input array
var array, splitter;
array       = argument0;
splitter    = argument1;

var i, fullstring;
fullstring = "";
for (i=0; i<array_length_1d(array); i+=1)
{   
    fullstring += string(array[i])+string(splitter);
}

return fullstring
