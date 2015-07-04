<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/manager.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 

	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	check_admin_login();
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="member">
	<div id="member_sidebar">
		<h2>管理导航</h2>
		<dl>
			<dt>系统管理</dt>
			<dd><a href="manager.php">后台首页</a></dd>
			<dd><a href="manager_set.php">系统设置</a></dd>
		</dl>
	<dl>
		<dt>会员管理</dt>
		<dd><a href="manager_vip_list.php">会员列表</a></dd>
		<dd><a href="manager_job.php">管理员列表</a></dd>
	</dl>
	</div>
<div id="member_main">
	<h2>后台管理中心</h2>
		<dl>
			<dd>·服务器主机名称：<?php echo $_SERVER['SERVER_NAME']; ?></dd>
			<dd>·服务器版本：<?php echo $_ENV['OS'] ?></dd>
			<dd>·通信协议名称/版本：<?php echo $_SERVER['SERVER_PROTOCOL']; ?></dd>
			<dd>·服务器IP：<?php echo $_SERVER["SERVER_ADDR"]; ?></dd>
			<dd>·客户端IP：<?php echo $_SERVER["REMOTE_ADDR"]; ?></dd>
			<dd>·服务器端口：<?php echo $_SERVER['SERVER_PORT']; ?></dd>
			<dd>·客户端端口：<?php echo $_SERVER["REMOTE_PORT"]; ?></dd>
			<dd>·管理员邮箱：<?php echo $_SERVER['SERVER_ADMIN'] ?></dd>
			<dd>·Host头部的内容：<?php echo $_SERVER['HTTP_HOST']; ?></dd>
			<dd>·服务器主目录：<?php echo $_SERVER["DOCUMENT_ROOT"]; ?></dd>
			<dd>·服务器系统盘：<?php echo $_ENV["SystemRoot"]; ?></dd>
			<dd>·脚本执行的绝对路径：<?php echo $_SERVER['SCRIPT_FILENAME']; ?></dd>
			<dd>·Apache及PHP版本：<?php echo $_SERVER["SERVER_SOFTWARE"]; ?></dd>
		</dl>
	</div>
</div>

<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>