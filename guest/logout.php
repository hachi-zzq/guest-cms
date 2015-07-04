<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-23
*/	session_start();
	session_destroy();
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/login.fun.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	//首先判断是否是登入状态
	check_login();
	setcookie('username','');

	location('','index.php');


?>