//DOC:  test_explode_string()
//DESC: tests function explode_string(string, split_character)

//arg0 = input string
//arg1 = character upon which the string is sliced

var correct, testcount;
correct     = 0;
testcount   = 0;

//Statements
var test0;
test0 = explode_string("00100100100","1");
if (test0[0] == "00") {correct +=1;} testcount+=1;
if (test0[1] == "00") {correct +=1;} testcount+=1;
if (test0[2] == "00") {correct +=1;} testcount+=1;
if (test0[3] == "00") {correct +=1;} testcount+=1;
if (array_length_1d(test0) == 4) {correct +=1;} testcount+=1;

var test1;
test1 = explode_string("hello this is a test"," ");
if (test1[0] == "hello")    {correct +=1;} testcount+=1;
if (test1[1] == "this")     {correct +=1;} testcount+=1;
if (test1[2] == "is")       {correct +=1;} testcount+=1;
if (test1[3] == "a")        {correct +=1;} testcount+=1;
if (test1[4] == "test")     {correct +=1;} testcount+=1;
if (array_length_1d(test1) == 5) {correct +=1;} testcount+=1;

var test2;
test2 = explode_string("username;100;9000;1590;150;", ";");
if (test2[0] == "username")     {correct +=1;} testcount+=1;
if (test2[1] == "100")          {correct +=1;} testcount+=1;
if (test2[2] == "9000")         {correct +=1;} testcount+=1;
if (test2[3] == "1590")         {correct +=1;} testcount+=1;
if (test2[4] == "150")          {correct +=1;} testcount+=1;
if (array_length_1d(test2) == 6) {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_explode_string");
