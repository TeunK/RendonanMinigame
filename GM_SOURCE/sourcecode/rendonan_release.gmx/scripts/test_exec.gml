//DOC:  test_exec()
//DESC: executes all tests

var correct, testcount;
correct     = 0;
testcount   = 0;

if (test_enter_area()) {correct +=1;} testcount+=1;
if (test_calc_percent()) {correct +=1;} testcount+=1;
if (test_explode_string()) {correct +=1;} testcount+=1;
if (test_implode_array()) {correct +=1;} testcount+=1;
if (test_outside_room()) {correct +=1;} testcount+=1;
if (test_build_url()) {correct +=1;} testcount+=1;

//Calculate result
if (test_result(correct,testcount,"GLOBAL TEST EXECUTION"))
{
    show_message("CONGRATULATIONS!#All unit tests ran and executed correctly.");
    return 1;
}
else
{
    show_message(string("ERROR:#")+string(correct)+string(" out of ")+string(testcount)+string(" unit tests failed."));
    return 0;
}
