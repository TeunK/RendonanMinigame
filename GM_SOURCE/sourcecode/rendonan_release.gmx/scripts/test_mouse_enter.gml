//REMINDER
//arg0 = x0
//arg1 = y0
//arg2 = x1
//arg3 = y1
//arg4 = mouse_x (mx)
//arg5 = mouse_y (my)

var correct;
correct = 0;

//TRUE statements
if (mouse_enter(0,0,10,10,5,5)) {correct +=1;}
if (mouse_enter(50,50,60,60,55,55)) {correct +=1;}

//FALSE statements
if (!mouse_enter(0,0,10,10,15,15)) {correct +=1;}
if (!mouse_enter(50,50,60,60,65,65)) {correct +=1;}

//Calculate result
if (correct == 4) {return true;} else {return false;}
