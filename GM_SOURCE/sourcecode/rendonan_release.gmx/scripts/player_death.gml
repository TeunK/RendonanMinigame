//DOC:  player_death()
//DESC: Checks for player death. If hp drops below 0, the user's stats will be sent to the server and a new game will start

if (currenthp <= 0)
{
    save_game(score_url);
    
    room_goto(room_Connect);
}
