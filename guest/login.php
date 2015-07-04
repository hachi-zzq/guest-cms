<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/login.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	require dirname(__FILE__).'/includes/login.fun.php';
	//首先判断是否是登入状态
	if (isset($_COOKIE['username'])){
		alert('您已经登入，请先退出');
	}
	//开始接收
	if ($_GET['action'] == 'login'){
		if (!empty($global_clean['code'] )) {//如果关闭了验证码验证
			if (!($_POST['code'] == $_SESSION['code'])){
				location('验证码错误，请重新输入！','member_modify.php');
			}
		}
		//进行用户名和密码的验证
		$name = check_username($_POST['username']);
		$password = check_password($_POST['password']);
		$time = check_time($_POST['time']);
		//将接受到得用户名和密码和数据库进行配对
		 $query = mysql_query("select username from user where username='$name' and password='$password'");
		 if (is_array(mysql_fetch_array($query))){
		 	if (is_array($array = mysql_fetch_array(mysql_query("select username,level from user where username='$name' and password='$password' and active=''")))){
		 		//登入成功，开始写入cookie,调用setcookies函数
		 		_setcookies($_POST['username'],$time);
		 		//判断是否是管理员登入
		 		if ($array['level'] ==1){//如果是管理员身份登入
		 			$_SESSION['admin'] = $array['username'];
		 		}
		 		//开始记录登入信息，包括登入地点，时间，次数
		 		  mysql_query("update 
		 													user
		 									 set 	
		 									 				last_time=now(),
		 													last_ip='{$_SERVER["REMOTE_ADDR"]}',
		 													login_count=login_count+1
		 									where
		 													username='{$_POST['username']}'"
												);
		 		location('登入成功','index.php');
		 	}else {
		 		location('用户名没有被激活，请重新登入','login.php');
		 	}
		 }else {
		 	location('用户名或密码错误，请重新登入','login.php');
		 }
	}
	//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="login">
<h2>登　入</h2>
<form method="post" action="login.php?action=login">
<dl>
<dt></dt>
	<dd>用 户 名：<input type="text" name="username" class="text" /></dd>
	<dd>密　　码：<input type="password" name="password" class="text" /></dd>
	<dd>保　　留：<input type="radio" name="time" value="0" checked="checked" class="time"/>不保留<input type="radio" name="time" value="1" class="time" />一天<input type="radio" name="time" value="2" class="time"  />一周<input type="radio" name="time" value="3" class="time" />一个月</dd>
	<?php if (!empty($global_clean['code'] )) {?>
	<dd>验 证 码： <input type="text" name="code" class="code"  /><img src="code.php" id="code" onclick="javascript:this.src='code.php?tm='+Math.random()"/>（点击验证码实现刷新）</dd>
	<?php }?>
	<dd><input type="submit" class="submit" value="登入" /><input type="submit" class="submit" value="注册" /></dd>
</dl>
</form>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
