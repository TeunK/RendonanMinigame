//DOC:  monster_respawn()
//DESC: Respawns monster instance based on timer, which counts when no monster instance exists

if (!instance_exists(obj_Monster))
{
    monsterSpawnTimer +=1;
    test_timer(760,200,monsterSpawnTimer,monsterSpawnLimit,"Respawn in... ");
    
    if (monsterSpawnTimer >= monsterSpawnLimit)
    {
        instance_create(760,200,obj_Monster);
        monsterSpawnTimer=0;
    }
}
