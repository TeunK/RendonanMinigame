//DOC:  test_calc_percent
//Note: tests function calc_percent(part,total)

//arg0 = partial
//arg1 = total


var correct, testcount;
correct     = 0;
testcount   = 0;

//TRUE statements
if (calc_percent(100,100) == 100) {correct +=1;} testcount+=1;
if (calc_percent(0,100) == 0) {correct +=1;} testcount+=1;
if (calc_percent(50,200) == 25) {correct +=1;} testcount+=1;
if (calc_percent(1000,2000) == 50) {correct +=1;} testcount+=1;

//FALSE statements
if (calc_percent(25,50) != 120) {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_calc_percent");
