<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-26
*/
//首先创建一个十六进制的验证码
for($i=0;$i<4;$i++){
	$yzs .=	dechex(mt_rand(0,15));
}
//将$yms保存到全局变量sessio中，以便其他页面的调用
session_start();
$_SESSION['code'] = $yzs;
$width = '75px';
$height = '25px';

$img =imagecreatetruecolor($width,$height);

$white = imagecolorallocate($img,255,255,255);
imagefill($img,0,0,$white);
$black = imagecolorallocate($img,0,0,0);
imagerectangle($img,0,0,$width-1,$height-1,$black);
for ($i=0;$i<6;$i++){
	$rand_color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$rand_color);
}
$rand_color = imagecolorallocate($img,mt_rand(0,100),mt_rand(0,155),mt_rand(0,200));
imagestring($img,5,15,5,$yzs,$rand_color);
header('Content-Type:image/png');
imagepng($img);
imagedestroy($img);


?>