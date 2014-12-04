//DOC:  player_update()
//DESC: updates the specified stats by fetching them from the obj_Controller object
//NOTE: Depends on obj_Controller. Dependency is safe as obj_Controller is persistent and must always exist.

username    = obj_Controller.username;
level       = obj_Controller.level;
xp          = obj_Controller.xp;
str         = obj_Controller.strength;
agi         = obj_Controller.agility;
currenthp   = obj_Controller.currenthp;
maxhp       = obj_Controller.maxhp;
