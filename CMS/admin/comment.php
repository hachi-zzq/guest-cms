<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;
	$comment = new CommentAction('comment.tpl');
	$comment->Action();																										//开始执行action方法
	$templates->display('comment.tpl');																	//载入解析后的模板文件，生成页面
?>