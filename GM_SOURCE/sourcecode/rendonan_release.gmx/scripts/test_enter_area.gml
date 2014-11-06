//DOC:  mouse_enter(x0,y0,x1,y1,x_pos,y_pos
//DESC: Returns true if the point (x_pos,y_pos) is inside the rectangle defined by points (x0,y0), (x1,y1)

//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = x_pos
//arg5 = y_pos

var correct, testcount;
correct     = 0;
testcount   = 0;

//TRUE statements
if (enter_area(0,0,10,10,5,5)) {correct +=1;} testcount+=1;
if (enter_area(50,50,60,60,55,55)) {correct +=1;} testcount+=1;

//FALSE statements
if (!enter_area(0,0,10,10,15,15)) {correct +=1;} testcount+=1;
if (!enter_area(50,50,60,60,65,65)) {correct +=1;} testcount+=1;

//Calculate result
return test_result(correct,testcount,"test_enter_area");

