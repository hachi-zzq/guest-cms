<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-21
*/
//本文档主要是存放函数

//	$time =explode(' ', microtime());
//	echo $time[0]+$time[1];
	function fun_time (){
		//用于获取当前时间的函数
	$time =explode(' ', microtime());
	return  $time[0]+$time[1];
	}

function check_login(){
	if (!isset($_COOKIE['username'])){
		location('请先登入','login.php');
	}
}

function check_admin_login(){
	if (!isset($_SESSION['admin'])){
		location('请以管理员身份登入','index.php');
	}
}
//创建一个是否自动转义的函数
function mysql_escape($string){
	if (get_magic_quotes_gpc()){
		return $string;
	}else {
		return mysql_real_escape_string($string);
	}
}


//js弹窗函数
function alert($string){
		echo "<script type='text/javascript'>alert('$string');history.back();</script>";
}

//跳转函数
function location($string,$url){
	if ($string == null){
		echo "<script type='text/javascript'>location.href='$url';</script>";
	}elseif ($url == null){
		echo "<script type='text/javascript'>alert('$string');</script>";
	}else {
		echo "<script type='text/javascript'>alert('$string');location.href='$url';</script>";
	}
}

/*
 * 关闭窗口函数
 */
function close($string){
	if ($string == null){
		echo "<script type='text/javascript'>window.close();</script>";
	}else {
		echo "<script type='text/javascript'>alert('$string');window.close();</script>";
	}
}

/**
 * _title()标题截取函数
 * @param $_string
 */

function title($_string,$max) {
	if (mb_strlen($_string,'utf-8') > $max) {
		$_string = mb_substr($_string,0,$max,'utf-8');
	}
	return $_string;
}

function set_xml($_xmlfile,$_clean) {
	$_fp = @fopen($_xmlfile,'w');
	if (!$_fp) {
		exit('系统错误，文件不存在！');
	}
	flock($_fp,LOCK_EX);
	
	$_string = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "<vip>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<id>{$_clean['id']}</id>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<username>{$_clean['username']}</username>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<sex>{$_clean['sex']}</sex>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<face>{$_clean['face']}</face>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<email>{$_clean['email']}</email>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "\t<url>{$_clean['url']}</url>\r\n";
	fwrite($_fp,$_string,strlen($_string));
	$_string = "</vip>";
	fwrite($_fp,$_string,strlen($_string));
	
	flock($_fp,LOCK_UN);
	fclose($_fp);
}

function ubb($string){
	$string = nl2br($string);
	$string = preg_replace('/\[size=(.*)\](.*)\[\/size\]/U','<font size="\1px">\2</font>',$string);
	$string = preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$string);
	$string = preg_replace('/\[i\](.*)\[\/i\]/U','<i>\1</i>',$string);
	$string = preg_replace('/\[u\](.*)\[\/u\]/U','<span style="text-decoration:underline">\1</span>',$string);
	$string = preg_replace('/\[s\](.*)\[\/s\]/U','<span style="text-decoration:line-through">\1</span>',$string);
	$string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>',$string);
	$string = preg_replace('/\[url\](.*)\[\/url\]/U','<a href="\1" target="_blank">\1</a>',$string);
	$string = preg_replace('/\[email\](.*)\[\/email\]/U','<a href="mailto:\1">\1</a>',$string);
	$string = preg_replace('/\[img\](.*)\[\/img\]/U','<img src="\1" alt="图片" />',$string);
	$string = preg_replace('/\[flash\](.*)\[\/flash\]/U','<embed style="width:480px;height:400px;" src="\1" />',$string);
	return $string;

}
//生成缩略图函数
function _thumb($_filename,$_percent) {
	//生成png标头文件
	header('Content-type: image/png');
	$_n = explode('.',$_filename);
	//获取文件信息，长和高
	list($_width, $_height) = getimagesize($_filename);
	//生成缩微的长和高
	$_new_width = $_width * $_percent;
	$_new_height = $_height * $_percent;
	//创建一个以0.3百分比新长度的画布
	$_new_image = imagecreatetruecolor($_new_width,$_new_height);
	//按照已有的图片创建一个画布
	switch ($_n[1]) {
		case 'jpeg' : $_image = imagecreatefromjpeg($_filename);
			break;
		case 'jpg' : $_image = imagecreatefromjpeg($_filename);
			break;
		case 'png' : $_image = imagecreatefrompng($_filename);
			break;
		case 'gif' : $_image = imagecreatefrompng($_filename);
			break;
	}
	//将原图采集后重新复制到新图上，就缩略了
	imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width,$_new_height, $_width, $_height);
	imagepng($_new_image);
	imagedestroy($_new_image);
	imagedestroy($_image);
}







?>