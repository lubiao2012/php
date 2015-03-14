<?php
require_once './string.func.php';

function verifyImage($type = 1,$length = 4,$sess_name = "verify",$pixel = 0,$line = 0) {
	
	$width=80 ;
	$height = 30;
	$image = imagecreatetruecolor($width, $height);    //画布
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 0, 0, 0);
	
	imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
	
	$chars = buildRandomString($type , $length);
	session_start();
	$_SESSION["$sess_name"]=$chars;
	
	$fontfiles = array (
			"MSYH.TTF",
			"MSYHBD.TTF",
			"SIMLI.TTF",
			"SIMSUN.TTC",
			"SIMYOU.TTF" 
	);
	
	for($i=0; $i<$length ; $i++){
		$size=mt_rand(14,18);
		$angle=mt_rand(-15,15);
		$x = 5+ $i*$size;
		$y = mt_rand(20,26);
		$color=imagecolorallocate($image, mt_rand(50,90), mt_rand(80,180), mt_rand(90,180));
		$fontfile='../fonts/'.$fontfiles[mt_rand( 0,count($fontfiles)-1 )];
		$text = substr($chars, $i, 1);
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);	
	}
	
	if($pixel){
		for($i = 0 ; $i < $pixel ; $i++){
			imagesetpixel($image, mt_rand(0, $width-1), mt_rand(0,$height-1), $black);
		}
	}
	if($line){
		$color=imagecolorallocate($image, mt_rand(50,90), mt_rand(80,180), mt_rand(90,180));
		for($i = 0 ; $i < $line ; $i++){
		    imageline($image,mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ),$color);
		}
	}
	
	header ( "content-type:image/gif" );
	imagegif ( $image );
	imagedestroy ( $image );
}

verifyImage(1,4,"verify","50",3);
