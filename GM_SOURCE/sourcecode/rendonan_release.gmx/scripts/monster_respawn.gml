//DOC:  monster_respawn()
//DESC: Respawns monster instance based on timer, which counts when no monster instance exists

if (!instance_exists(obj_Monster))
{
    monsterSpawnTimer +=1;
    test_timer(760,200,monsterSpawnTimer,monsterSpawnLimit,"Respawn in... ");
    
    if (monsterSpawnTimer >= monsterSpawnLimit)
    {
        //create monster with given stats
        newmonster = instance_create(760,200,obj_Monster);
        newmonster.level        = monsterSpawnLevel;
        newmonster.str          = monsterSpawnLevel*2+random(2);
        newmonster.agi          = round((1+random(2))*monsterSpawnLevel);
        newmonster.maxhp        = round(8+power(monsterSpawnLevel,3));
        newmonster.currenthp    = newmonster.maxhp;
        
        monsterSpawnTimer=0;
    }
}
