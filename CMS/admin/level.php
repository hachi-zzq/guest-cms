<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;
	$level = new LevelAction('level.tpl');
	$level->Action();																										//开始执行action方法
	$templates->display($level->tpl);																	//载入解析后的模板文件，生成页面
?>