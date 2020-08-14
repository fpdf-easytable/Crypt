<?php
 /**********************************************************************
 * Crypt class                                                         *
 *                                                                     *
 * Version: 1.0                                                        *
 * Date:    14-8-2020                                                  *
 * Author:  Dan Machado                                                *
 *                                                                     *
 **********************************************************************/

include "config.php";

class Crypt
{
	private
	$POOL,
	$keyring,
	$shift_ky,
	$fuser;

	private
	function match_pattern($str){
		$a=true;
		$n=strlen($str);
		for($i=0; $i<$n; $i++){
			if(preg_match('/[a-zA-Z0-9\/\+\=]/', substr($str,$i,1))==0){
				$a=false;
				break;   
			}   
		}
		if($n==0){
			$a=false;
		}
		return $a;
	}
	private
	function explode_string($str){
		$result=array();
		for($i=0; $i<strlen($str); $i++){
			$result[$str[$i]]=$i;
		}
		return $result;
	}
	static function random_str(){
		$pool=json_decode(SED);
		$str='';
		$l=count($pool);
		$i=0;
		while($l){
			$i=mt_rand(0,$l-1);
			$str.=$pool[$i];
			unset($pool[$i]);
			$pool=array_values($pool);
			$l=count($pool);
		}
		return $str;   
	}

	public
		function __construct(){
			include PATH . '/' . KEY_FILE;
			$this->POOL=$POOL;
			$this->keyring=$keyring;
			$this->shift_ky=$shift_ky;
			$this->fuser=$fuser;
		}

	function encrypt($str){
		//$str.='rfgvbfg';	
		$result='';
		$lg=count($this->POOL);
		$shift='';
		$x=0;
		$y=0;
		for($i=0; $i<count($this->shift_ky); $i++){
 			$x=mt_rand(0, 63);
			$shift.=$this->shift_ky[$i][$x];
			$y+=$x; 
		}
		$result=$shift;
		$min_padding=MIN_PADDING;
		$max_padding=MAX_PADDING;
		if(strlen($str)<10){
			$min_padding=17;
		}
		$x=$this->fuser;
		$key=$x[mt_rand(0,63)];
		$result.=$key;		
		$key=array_flip($this->keyring[$key]);
		$str=base64_encode(self::random_str(mt_rand($min_padding,$max_padding)) . ' '. $str);		 
		$l=strlen($str);
		for($i=0; $i<$l; $i++){
			if($str[$i]!='='){
				$result.=$this->POOL[($i+$y) % $lg][$key[$str[$i]]];
			}
			else{ 
				$result.='=';	
			}
		}
		return $result;
	}
	
	function decrypt($str){
		$result='';
		if($this->match_pattern($str)){
			$lg=count($this->POOL);
	 		$shift=substr($str, 0, 3); 
			$str=substr($str, 3); 
			$y=0;
			for($i=0; $i<3; $i++){
				$y+=$this->explode_string($this->shift_ky[$i])[$shift[$i]];
			}
	 	 
			$x=$str[0];
			$str=substr($str,1);
			$key=$this->keyring[$x];
			$l=strlen($str);
			for($i=0; $i<$l; $i++){
				if($str[$i]!='='){
					$tmp=$this->explode_string($this->POOL[($i+$y) % $lg]);
					$result.=$key[$tmp[$str[$i]]];
				}
				else{ 
					$result.='=';	
				}
			}

			$result=base64_decode($result);
			$x=strpos($result, ' ');
			if($x!==false){
				$result=substr($result,$x+1);
			}
		}
		return $result;
	}
	
}




?>