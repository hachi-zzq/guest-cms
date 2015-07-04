<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-14
*/
if (!defined('IN_TG')){
		exit('非法调用！');
	}

function checkcode($post,$session){
		if (!($post == $session)){
			echo "<script>alert('验证码错误，请重新输入');history.back();</script>";
			exit();
		}
}	
	
function check_username($string_username){
	$string_username = trim($string_username);
	if (mb_strlen($string_username,'utf-8')<2 || mb_strlen($string_username,'utf-8')>10){
		//判断输入的用户名长度是否合格
		echo "<script>alert('用户名长度不得小于两位或者大于十位，请重新输入');history.back();</script>";
		exit();
	}if (preg_match('/[<>\'\"]/',$string_username)){
		//判断是否含有敏感字符，敏感字符包括<>' " 大空格 小空格
		echo "<script>alert('用户名中包含敏感字符，请重新输入');history.back();</script>";
		exit();
	}
	return mysql_escape($string_username);
}

function check_password($string_password){
	if (strlen($string_password) < 6){
		echo "<script>alert('密码长度不能小于六位，请重新输入');history.back();</script>";
		exit();
	}
		return sha1($string_password);
}

function check_time($string){
	$time = array('0','1','2','3');
	if (!in_array($string,$time)){
		exit('出错');
	}
	return mysql_escape($string);
}


function _setcookies($username,$time) {
	switch ($time) {
		case '0':  //浏览器进程
			setcookie('username',$username);
			break;
		case '1':  //一天
			setcookie('username',$username,time()+86400);
			break;
		case '2':  //一周
			setcookie('username',$username,time()+604800);
			break;
		case '3':  //一月
			setcookie('username',$username,time()+2592000);
			break;
	}
}



?>