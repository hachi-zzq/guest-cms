<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/member.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	check_login();
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	if (isset($_COOKIE['username'])){
	$row = mysql_fetch_array(mysql_query("select username,sex,face,email,url,qq,level,reg_time from user where username='{$_COOKIE['username']}'"));
		$member = array();
		$member['username'] = htmlspecialchars($row['username']);
		$member['sex'] = htmlspecialchars($row['sex']);
		$member['face'] = htmlspecialchars($row['face']);
		$member['email'] = htmlspecialchars($row['email']);
		$member['url'] = htmlspecialchars($row['url']);
		$member['qq'] = htmlspecialchars($row['qq']);
		if (htmlspecialchars($row['level']) == 0){
			$member['level'] = '普通用户';
		}elseif (htmlspecialchars($row['level']) == 1){
			$member['level'] = '管理员';
		}
		$member['reg_time'] = htmlspecialchars($row['reg_time']);
	}else {
		alert('非法操作');
	}
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="member">
	<div id="member_sidebar">
	<h2>中心导航</h2>
	<dl>
		<dt>账号管理</dt>
		<dd><a href="member.php">个人信息</a></dd>
		<dd><a href="member_modify.php">修改资料</a></dd>
	</dl>
		<dl>
		<dt>其他管理</dt>
		<dd><a href="member_message.php">短信查阅</a></dd>
		<dd><a href="member_friend.php">好友设置</a></dd>
		<dd><a href="member_flower.php">查询花朵</a></dd>
		<dd><a href="#">个人相册</a></dd>
	</dl>
	</div>
<div id="member_main">
	<h2>个人信息</h2>
		<dl>
			<dd>用 户 名：<?php echo $member['username'];?></dd>
			<dd>性　　别：<?php echo $member['sex'];?></dd>
			<dd>头　　像：<img src="<?php echo $member['face'];?>" /></dd>
			<dd>电子邮件：<?php echo $member['email'];?></dd>
			<dd>主　　页：<?php echo $member['url'];?></dd>
			<dd>Q 　 　Q：<?php echo $member['qq'];?></dd>
			<dd>注册时间：<?php echo $member['reg_time'];?></dd>
			<dd>身　　份：<?php echo $member['level']; ?></dd>
		</dl>
	</div>
</div>

<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>