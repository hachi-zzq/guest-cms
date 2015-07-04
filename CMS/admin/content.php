<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;
	$content = new ContentAction('content.tpl');
	$content->Action();																										//开始执行action方法
	$templates->display($content->tpl);																	//载入解析后的模板文件，生成页面
?>