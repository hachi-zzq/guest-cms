<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-28
*/

if (!defined('IN_TG')){
		exit('非法调用！');
	}
function check_username($string_username){
	$string_username = trim($string_username);
	if (mb_strlen($string_username,'utf-8')<2 || mb_strlen($string_username,'utf-8')>10){
		//判断输入的用户名长度是否合格
		echo "<script>alert('用户名长度不得小于两位或者大于十位，请重新输入');history.back();</script>";
		exit();
	}if (preg_match('/[<>\'\" ]/',$string_username)){
		//判断是否含有敏感字符，敏感字符包括<>' " 大空格 小空格
		echo "<script>alert('用户名中包含敏感字符，请重新输入');history.back();</script>";
		exit();
	}
	return mysql_escape($string_username);
}

function check_password($string_password,$string_yespassword){
	if (strlen($string_password) < 6){
		echo "<script>alert('密码长度不能小于六位，请重新输入');history.back();</script>";
		exit();
	}
	
	if ($string_password !== $string_yespassword){
		echo "<script>alert('密码确认与密码不一致，请重新输入');history.back();</script>";
		exit();
	}
	return sha1($string_password);
}

function check_question($string_question){
	$string_question = trim($string_question);
	if (mb_strlen($string_question,'utf-8')<4 || mb_strlen($string_question,'utf-8')>20){
		echo "<script>alert('密码提示长度不能小于四位或者大于二十位，请重新输入');history.back();</script>";
		exit();
	}
//	if (preg_match('/[<>\'\" 　]/',$string_question)){
//			//判断是否含有敏感字符，敏感字符包括<>' " 大空格 小空格
//			echo "<script>alert('密码提示中包含敏感字符，请重新输入');history.back();</script>";
//			exit();
//		}
	return mysql_escape($string_question);
}

function check_answer($string_question,$string_answer){
	//注意：这个函数要传入两个参数 第一个就是上面的密码问题 ，第二个是密码回答
	$string_answer = trim($string_answer);
	if (mb_strlen($string_answer,'utf-8')<2 || mb_strlen($string_answer,'utf-8')>20){
		echo "<script>alert('密码回答长度不能小于两位或者大于二十位，请重新输入');history.back();</script>";
		exit();
	}
	if ($string_question == $string_answer){
		echo "<script>alert('密码回答不能与密码提示一致，请重新输入');history.back();</script>";
		exit();
	}
	return sha1(mysql_escape($string_answer));
}

function check_sex($string){
	return mysql_escape($string);
}

function check_face($string){
	return mysql_escape($string);
}

function check_email($string_email){
	//可选验证：如果是空的就不进行验证，直接通过，换句话说也就是如果不为空才进行验证，为空直接通过
	if (!empty($string_email)){
		if (!preg_match('/([\w]{3,10})@([0-9a-z]{2,5}).([a-z]{3,5})/',$string_email)){
			echo "<script>alert('邮箱格式错误，请重新输入');history.back();</script>";
			exit();
		}
	}
	return mysql_escape($string_email);
}

function check_qq($string_qq){
	if (!empty($string_qq)){
	//可选验证：如果是空的就不进行验证，直接通过，换句话说也就是如果不为空才进行验证，为空直接通过
		if (!preg_match('/^[1-9]{1}[0-9]{4,9}$/',$string_qq)){
			echo "<script>alert('QQ格式错误，请重新输入');history.back();</script>";
			exit();
		}
	}
	return $string_qq;
}

function check_url($string_url){
	//可选验证：如果是空的就不进行验证，直接通过，换句话说也就是如果不为空才进行验证，为空直接通过
	if (empty($string_url) || ($string_url == 'http://')){
		return null;
	}else {
		if (!preg_match('/^(http(s)?:\/\/)?([wW]{3}.)([\w]{1,10}.)([\w]{3,5})$/',$string_url)){
			echo "<script>alert('网址格式错误，请重新输入');history.back();</script>";
			exit();
		}
		return mysql_escape($string_url);
	}

}

function check_uniqid($first_string,$end_string){
	if ($first_string != $end_string){
		echo "<script>alert('唯一标识符异常');history.back();</script>";
		exit();
	}
	
	return $first_string;
}

function modify_check_password($string){
	if (empty($string)){
		return null;
	}else {
				if (strlen($string) < 6){
				echo "<script>alert('密码长度不能小于六位，请重新输入');history.back();</script>";
				exit();
	}return sha1($string);
}

}






?>