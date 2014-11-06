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

//Calculate result
if (correct == testcount) {return true;} 
else 
{
    show_message("Script: "+string(test_unit)+" FAILED.#Passed: "+string(correct)+" / "+string(testcount)+" tests.");
    return false;
}
