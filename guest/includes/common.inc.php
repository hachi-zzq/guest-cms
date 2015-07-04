<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-21
*/
	if (!defined('IN_TG')){
		exit('非法调用！');
	}
	
	if (PHP_VERSION<'5.2.6'){
		exit('版本太低');
	}
//短信提醒
	@$row = mysql_fetch_array(mysql_query("select count(id) as count from message where state=0 and touser='{$_COOKIE['username']}'"));
	if ($row['count'] == 0){
		$GLOBALS['count'] = '<strong class="noread"><a href="member_message.php" >'.$row['count'].'</a></strong>';
	}else {
		$GLOBALS['count']  = '<strong class="read"><a href="member_message.php" >('.$row['count'].')</a></strong>';
	}
	
	//初始化系统设置
	if (!!$row = mysql_fetch_array(mysql_query("select * from system where id=1"),MYSQL_ASSOC)){
		 global $global_clean;
		 $clean = array();
		$global_clean['web_name'] = $row['web_name'];
		$global_clean['article_page'] = $row['article_page'];
		$global_clean['photo_page'] = $row['photo_page'];
		$global_clean['blog_page'] = $row['blog_page'];
		$global_clean['post_time'] = $row['post_time'];
		$global_clean['re_time'] = $row['re_time'];
		$global_clean['code'] = $row['code'];
		$global_clean['register'] = $row['register'];
	}
?>

<title><?php echo $global_clean['web_name'];?></title>