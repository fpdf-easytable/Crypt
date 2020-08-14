<?php
include 'Crypt.php';

function writer($str, $file){	
	if(!file_exists($file)){
		$h=fopen($file, 'a');
		if($h){
			fwrite($h, $str);
			fclose($h);
		}
	}
}


$str='<?php
$POOL=array(';
for($i=0; $i<LT; $i++){
	$str.="'". Crypt::random_str()."',";
}
$str=trim($str, ',') . ');';
$str."\n\n";

$str.='$keyring=array(';
$pool=json_decode(SED);	
$i=0;
$str.='';
$l=count($pool);
while($l){
	$i=mt_rand(0,$l-1);
	$str.="'{$pool[$i]}'";
	unset($pool[$i]);
	$pool=array_values($pool);
	$l=count($pool);
	$str.='=>array(';
	$j=0;
	$pool2=json_decode(SED);
	$l2=count($pool2);
	while($l2){
		$j=mt_rand(0,$l2-1);
		$str.="'{$pool2[$j]}',";
		unset($pool2[$j]);
		$pool2=array_values($pool2);
		$l2=count($pool2);
	}
	$str=trim($str, ',') . '),';
}
$str=trim($str, ',') . ");\n";

$str.='$shift_ky=array(';
for($i=0; $i<SHIFT; $i++){
	$str.="'". Crypt::random_str()."',";
}
$str=trim($str, ',') . ');
';

$str.='$fuser=\''. Crypt::random_str().'\';
?>';



writer($str, PATH . '/' . KEY_FILE);

?>