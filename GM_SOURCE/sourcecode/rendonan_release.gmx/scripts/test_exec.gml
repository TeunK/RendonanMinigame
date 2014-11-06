//DOC:  test_exec()

//executes all tests
var correct, testcount;
correct     = 0;
testcount   = 0;


//test_enter_area
if (test_enter_area()) {correct +=1;} testcount+=1;

//test_calc_percent
if (test_calc_percent()) {correct +=1;} testcount+=1;

//Calculate result
if (test_result(correct,testcount,"GLOBAL TEST EXECUTION"))
{
    show_message("CONGRATULATIONS!#All tests ran and executed correctly.");
}

//end test
game_end();
