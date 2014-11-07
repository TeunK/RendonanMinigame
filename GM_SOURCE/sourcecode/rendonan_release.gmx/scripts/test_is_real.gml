//DOC:  test_is_real(variable, desc)
//DESC: checks whether stated variable is of type real (number) when active_testing is turned on

//Initialize variables
var variable, desc;
variable    = argument0;
desc        = argument1;

if (obj_Controller.test_mode == 1)
{
    if (obj_Controller.active_testing)
    {
        var message;
        message = desc;
        
        if is_real(variable)
        {
            message += " Success!";
        }
        else
        {
            message += " Test failed!";
        }
        show_message(message);
    }
}
