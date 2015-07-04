<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-8
*/
	if (!defined('IN_TG')){
		exit('非法调用！');
	}
//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PSW','php');
define('DB_NAME','guest');
$conn = mysql_connect(DB_HOST,DB_USER,DB_PSW) or die('数据库连接失败');
mysql_query("set names utf8") or die('设置字符集出错');
mysql_select_db(DB_NAME);

?>