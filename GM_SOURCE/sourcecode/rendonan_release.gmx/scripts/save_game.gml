//DOC:  save_game(url)
//DESC: sends user variables to url, where the user's data will be stored in the database

//arg0 = url to which the data will be sent

//Initialize variables
var url;
url = argument0

/*******************************/
/*Type-checking input arguments*/
//DOC:  test_is_real(variable, desc, passive)
//DOC:  test_is_string(variable, desc, passive)
var testmodule;
testmodule = "[save_game] ";

test_is_string(   url,         testmodule+"url: ",          true);
/*******************************/

//prepare player stats to be sent to server
var str = "";
str += "name="      +string(username);
str += "&xp="       +string(xp);
str += "&coins="    +string(coins);
str += "&maxhp="    +string(maxhp);
str += "&currenthp="+string(currenthp);
str += "&strength=" +string(strength);
str += "&agility="  +string(agility);

//execute http POST-request
http = http_post_string(url,string(str));
