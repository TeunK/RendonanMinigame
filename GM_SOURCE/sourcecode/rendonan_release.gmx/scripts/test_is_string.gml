//DOC:  test_is_string(variable, desc, passive)
//DESC: checks whether stated variable is of type string when active_testing is turned on. passive = 1 means it will ONLY return failed test-result regardless of active-testing

//Initialize variables
var variable, desc, passive;
variable    = argument0;
desc        = argument1;
passive     = argument2;

//if in game test_mode
if (obj_Controller.test_mode == obj_Controller.t_test)
{
    var message;
    message = desc;
    
    //test if variable matches the type-requirement
    if is_string(variable)
    {
        message += " Success!";
           
        //if active_testing is on, output success message
        if (obj_Controller.active_testing && !passive)
        {
            show_message(message);
        }
    }
    //if it doesn't match the requirement
    else
    {
        //regardless if active_testing is on/off, output fail message
        message += " Test failed!";
        show_message(message);
    }
}
