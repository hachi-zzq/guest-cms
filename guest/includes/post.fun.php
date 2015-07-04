<?php
	function check_post_title($string,$min,$max){
		$string = trim($string);
		if (mb_strlen($string,'utf-8')<$min || mb_strlen($string,'utf-8')>$max){
			//判断输入的用户名长度是否合格
			alert('帖子标题长度不得小于'.$min.'位或者大于'.$max.'位，请重新输入');
			exit();
		}return mysql_escape($string);
	}
		
	function check_post_contenr($string,$min){
		$string = trim($string);
		if (mb_strlen($string,'utf-8')<$min){
			//判断输入的用户名长度是否合格
			alert('发帖内容长度不得小于'.$min.'位');
			exit();
		}return mysql_escape($string);
	}
?>