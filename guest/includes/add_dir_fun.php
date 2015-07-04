<?php
function check_name($string){
	$string = trim($string);
	if (mb_strlen($string,'utf-8')<3 || mb_strlen($string,'utf-8')>20){
		//判断输入的用户名长度是否合格
		echo "<script>alert('长度不得小于四位或者大于二十位，请重新输入');history.back();</script>";
		exit();
	}if (preg_match('/[<>\'\" ]/',$string)){
		//判断是否含有敏感字符，敏感字符包括<>' " 大空格 小空格
		echo "<script>alert('包含敏感字符，请重新输入');history.back();</script>";
		exit();
	}
	return $string;
}
	
function  check_password($string){
	if (strlen($string) < 6){
		alert('密码不得少于六位');
	}
	return $string;
}

function check_photo_url($string){
	if (empty($string)){
		alert('图片地址不能为空');
	}
	return $string;
}
?>