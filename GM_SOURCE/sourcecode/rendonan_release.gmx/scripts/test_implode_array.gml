//DOC:  test_implode_array()
//DESC: tests function implode_array(array, split_character)

//arg0 = input array
//arg1 = character that fills up the gap

var correct, testcount;
correct     = 0;
testcount   = 0;

//Statements
var test0;
test0[0] = "ab";
test0[1] = "cd";
test0[2] = "ef";
test0 = implode_array(test0," ");
if (test0 == "ab cd ef ") {correct +=1;} testcount+=1;

var test1;
test1[0] = "name";
test1[1] = "1";
test1[2] = "355";
test1[3] = "100";
test1[4] = 100;
test1[5] = "900";
test1 = implode_array(test1,";");
if (test1 == "name;1;355;100;100;900;") {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_implode_array");
