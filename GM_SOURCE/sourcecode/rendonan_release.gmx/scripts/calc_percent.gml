//DOC:  calc_percent(part,total)
//Note: returns percentage double between 0 and 100, based on the values partial and total

//Initialize variables
var partial, total;
partial = argument0;
total   = argument1;

/*******************************/
var testmodule;
testmodule = "[calc_percent] ";
test_is_real(   partial,      testmodule+"partial: ",     true);
test_is_real(   total,        testmodule+"total: ",       true);
/*******************************/

//return calculated percentage
return ((partial/total)*100);
