//DOC:  test_build_url
//Note: tests function build_url(host,port,path,file)

var correct, testcount;
correct     = 0;
testcount   = 0;

//TRUE statements
if (build_url("http://somewebdomain",":8080","/path","/page") == "http://somewebdomain:8080/path/page") {correct +=1;} testcount+=1;

//FALSE statements
if (build_url("a","b","c","d") != "efgh") {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_calc_percent");
