<?php
/*
Define constant PATH with the path to a directory to store the key_file
remove last trailing '/'
*/
define('PATH', '/my_path');


define('KEY_FILE', 'key_file.php');//Name of your choice for the file that store the key
define('SED', '["z","w","L","1","W","7","s","n","r","v","S","Y","J","6","X","H","Z","G","E","N","Q","U","A","x","M","\/","l","3","g","V","D","9","0","b","u","F","p","h","f","8","d","k","C","t","c","a","R","T","I","P","m","o","y","B","O","+","j","5","q","4","K","2","i","e"]');
define('MIN_PADDING',7);
define('MAX_PADDING',61);
/*
If you change any of this, you will have to run the setUp.php
script again. 
WARNING: Any information encrypted using a previous key
will be lost... forever! 
*/
define('LT', 200); // The many, the better... but do not over do it
define('SHIFT',3); // keep it between 3 and 10


if(PATH=='/my_path'){
	exit("Please define the constant PATH in the config.php file and run setUp.php script again.\n");
}

?>