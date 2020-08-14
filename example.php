<?php

include 'Crypt.php';

$encrypt=new Crypt();

for($i=0; $i<1000; $i++){
	$str=$encrypt->encrypt("hello");
	echo $str . " : ";
	echo $encrypt->decrypt($str) . "\n";
}



?>