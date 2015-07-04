<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;
	$rotatain = new RotatainAction('rotatain.tpl');
	$rotatain->Action();					 																					//开始执行action方法
	$templates->display('rotatain.tpl');																	//载入解析后的模板文件，生成页面
?> 