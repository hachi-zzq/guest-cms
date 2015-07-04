<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/member_modify.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require  dirname(__FILE__).'/includes/global.fun.php';
	check_login();
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	require  dirname(__FILE__).'/includes/header.inc.php';
	require  dirname(__FILE__).'/includes/register.fun.php';
	//开始修改数据
	if ($_GET['action'] == 'modify'){
		@session_start();
		if (!empty($global_clean['code'] )) {//如果关闭了验证码验证
			if (!($_POST['code'] == $_SESSION['code'])){
				location('验证码错误，请重新输入！','member_modify.php');
			}
		}
		$clean = array();
		$clean['password'] = modify_check_password($_POST['password']);
		$clean['sex'] = check_sex($_POST['sex']);
		$clean['face'] = check_face($_POST['face']);
		$clean['email'] = check_email($_POST['email']);
	 	$clean['qq'] = check_qq($_POST['qq']);
	 	$clean['url'] = check_url($_POST['url']);
		mysql_query($string = "update user set password='{$clean['password']}',
														sex='{$clean['sex']}',
														face='{$clean['face']}',
														email='{$clean['email']}',
														qq='{$clean['qq']}',
														url='{$clean['url']}'
													where username='{$_COOKIE['username']}'
														")or die(mysql_error());
		if (mysql_affected_rows()==1){
			mysql_close();
			location('恭喜你，修改成功','member.php');
		}else {
			mysql_close();
			location('很遗憾，修改失败','member_modify.php');
		}
	}
	
	
	if (isset($_COOKIE['username'])){
	$row = mysql_fetch_array(mysql_query("select username,sex,face,email,url,qq,level,reg_time from user where username='{$_COOKIE['username']}'"));
		$member = array();
		$member['username'] = htmlspecialchars($row['username']);
		$member['sex'] = htmlspecialchars($row['sex']);
		$member['face'] = htmlspecialchars($row['face']);
		$member['email'] = htmlspecialchars($row['email']);
		$member['url'] = htmlspecialchars($row['url']);
		$member['qq'] = htmlspecialchars($row['qq']);
	}else {
		alert('非法操作');
	}
	if ($member['sex'] == '男'){
		$html_sex = '男<input class="radio" type="radio" name="sex" value="男" checked="checked"/>女<input class="radio" type="radio" name="sex" value="女" />';
	}else {
		$html_sex = '男<input class="radio" type="radio" name="sex" value="男" />女<input class="radio" type="radio" name="sex" value="女" checked="checked"/>';
	}
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
<div id="member_modify">
	<h2>资料修改</h2>
		<form action="member_modify.php?action=modify" method="post" >
		<dl>
			<dd>用 户 名：<?php echo $member['username'];?></dd>
			<dd>密　　码：<input type="password" class="text" name="password" value="" /></dd>
			<dd>性　　别：<?php echo $html_sex;?></dd>
			<dd>头　　像：<select name="face">
											<?php 
												foreach (range(1,9) as $i){
													echo '<option value="face/m0'.$i.'.gif" />face/m0'.$i.'.gif';
												}
											?>
											<?php 
												foreach (range(10,64) as $i){
													echo '<option value="face/m'.$i.'.gif">face/m'.$i.'.gif';
												}
											?>
										</select></dd>
			<dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $member['email'];?>"/></dd>
			<dd>主　　页：<input type="text" class="text" name="url" value="<?php echo $member['url'];?>"/></dd>
			<dd>Q 　 　Q：<input type="text" class="text" name="qq" value="<?php echo $member['qq'];?>"/></dd>
			<?php if (!empty($global_clean['code'] )) {?>
			<dd>验 证 码：<input type="text" name="code" class="yzm"  /><img src="code.php" id="code" onclick="javascript:this.src='code.php?tm='+Math.random()"/>（点击验证码实现刷新）</dd>
			<?php }?>
			<dd><input type="submit" class="submit" value="修改资料 " /></dd>
		</dl>
		</form>
	</div>
</div>

<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>