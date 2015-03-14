<?php
function buildRandomString($type=1 , $length=4) {
	if($type == 1){
		$str = join("",range(0,9));
	}elseif($type == 2){
		$str=join("",array_merge( range(0,9) , range('a','z')) );
	}elseif($type ==3){
		$str=join("",array_merge(range(0,9) , range('a','z') , range('A','Z') ));
	}
	if($length>strlen($str));
	$chars=str_shuffle($str);
	return substr($chars,0,$length);
}
