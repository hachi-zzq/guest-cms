<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-9-17
*/
function check_content($string){
	$string = htmlspecialchars(mysql_escape(trim($string)));
	if (mb_strlen($string,'utf-8')<10 || mb_strlen($string,'utf-8')>200){
		//判断输入的用户名长度是否合格
		alert('信心内容不得少于10个字符，请重新输入');
	}
	return $string;
}


?>