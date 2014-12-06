//DOC:  build_url(host,port,path,file)
//Note: Concatenates host, port, path and file into one url string.

//Initialize variables
var host,port,path,file;
host = argument0;
port = argument1;
path = argument2;
file = argument3;

/*******************************/
var testmodule;
testmodule = "[build_url] ";
test_is_string( host, testmodule+"host: ", true);
test_is_string( port, testmodule+"port: ", true);
test_is_string( path, testmodule+"path: ", true);
test_is_string( file, testmodule+"file: ", true);
/*******************************/

var url;
url = host+port+path+file;

return url;
