//DOC:  save_game()
//DESC: sends user variables to save_url, where the user's data will be stored in the database

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
http = http_post_string(save_url,string(str));
