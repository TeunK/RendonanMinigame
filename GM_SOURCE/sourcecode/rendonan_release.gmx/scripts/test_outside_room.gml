//DOC:  test_outside_room()
//Note: tests function outside_room(x,y)

var correct, testcount;
correct     = 0;
testcount   = 0;

//TRUE statements
if (outside_room(-60,100)) {correct +=1;} testcount+=1;
if (outside_room(room_width+1,100)) {correct +=1;} testcount+=1;
if (outside_room(room_width/2,-10)) {correct +=1;} testcount+=1;
if (outside_room(1000,room_height+1)) {correct +=1;} testcount+=1;

//FALSE statements
if (!outside_room(room_width/2,room_height/2)) {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_outside_room");
