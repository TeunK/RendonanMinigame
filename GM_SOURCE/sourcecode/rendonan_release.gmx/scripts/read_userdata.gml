//DOC:  read_userdata(userdata)
//DESC: userdata is an array containing userdata. read_userdata assigns these values to their according variable

//arg0 = userdata
userdata = argument0;

if (array_length_1d(userdata) == 7)
{
    username        = string(userdata[0]);
    xp              = real(userdata[1]);
    coins           = real(userdata[2]);
    maxhp           = real(userdata[3]);
    currenthp       = real(userdata[4]);
    strength        = real(userdata[5]);
    agility         = real(userdata[6]);
}
