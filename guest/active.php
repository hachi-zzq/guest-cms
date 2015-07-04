<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-28
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/active.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	require  dirname(__FILE__).'/includes/header.inc.php';
	if (!isset($_GET['active'])){
		//防止直接调用“active页面”
		location('非法操作','index.php');
	}
	if (isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok'){
		$active = mysql_escape($_GET['active']);//首先进行转义
		mysql_query("UPDATE user SET active=NULL WHERE active='$active' LIMIT 1");//将active字段设置为空
		if (mysql_affected_rows() == 1){
			location('激活成功','index.php');
		}else {
			location('激活失败','register.php');
		}
	}
?>
<div id="active">
<h2>激活页面</h2>
<p>点击一下链接进行激活</p>
<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
