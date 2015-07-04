<?php
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	//调用缩略图函数,接收photo_show.php 传过来的参数
	//_thumb('photo/1352443011/1352690529.jpeg',0.5);
	if (isset($_GET['filename']) && isset($_GET['percent'])) {
		_thumb($_GET['filename'],$_GET['percent']);
	}
?>