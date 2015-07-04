<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;
	$user = new UserAction('user.tpl');
	$user->Action();																										//开始执行action方法
	$templates->display('user.tpl');																	//载入解析后的模板文件，生成页面
?>