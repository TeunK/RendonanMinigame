//DOC:  test_result(correct,testcount,test_unit)
//DESC: returns true if correct==testcount, additionally, displays message of the amount of passed/total tests to see how often it fails

//arg0 = correct
//arg1 = testcount
//arg2 = test_unit

//Initialize variables
var correct, testcount, test_unit;
correct = argument0;
testcount = argument1;
test_unit = argument2;

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[test_result] ";

test_is_real(   correct,    testmodule+"correct: ",    true);
test_is_real(   testcount,  testmodule+"testcount: ",  true);
test_is_string( test_unit,  testmodule+"test_unit: ",  true);
/*******************************/

//Calculate result
if (correct == testcount) {return true;} 
else 
{
    show_message("Script: "+string(test_unit)+" FAILED.#Passed: "+string(correct)+" / "+string(testcount)+" tests.");
    return false;
}
