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
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/reg.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	//首先判断是否是登入状态
	if (isset($_COOKIE['username'])){
		alert('您已经登入，请先退出');
	}
	if ($_POST['hidden'] == register){
		if (!empty($global_clean['code'] )) {//如果关闭了验证码验证
			if (!($_POST['code'] == $_SESSION['code'])){
				location('验证码错误，请重新输入！','member_modify.php');
			}
		}
	include 'includes/register.fun.php';//引入验证函数库
	$clean = array();
	//运行验证username的函数check_username();
//	echo $_POST['uniqid'].'<br />'.$_SESSION['uniqid'].'<br />';
//  $clean['uniqid'] = check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
	$clean['active'] = sha1(uniqid(rand(),true));
	$clean['username'] = check_username($_POST['username']);
	$clean['password'] = check_password($_POST['password'],$_POST['yespassword']);
	$clean['question'] = check_question($_POST['question']);
	$clean['answer'] = check_answer($_POST['question'],$_POST['answer']);
	$clean['sex'] = check_sex($_POST['sex']);
	$clean['face'] = check_face($_POST['face']);
	$clean['email'] = check_email($_POST['email']);
 	$clean['qq'] = check_qq($_POST['qq']);
 	$clean['url'] = check_url($_POST['url']);
 	//插入之前要判断是否存在相同的用户名
	 	$query = mysql_query("select username from user where username='{$clean['username']}'");
		if (is_array(mysql_fetch_array($query,MYSQL_ASSOC))){
			echo "<script type='javascript'>alert('用户名已经存在，请重新注册！');history.back();</script>";
			exit();
		}
		mysql_query("insert into user 
														(active,
														username,
														password,
														question,
														answer,
														sex,
														face,
														email,
														qq,
														url,
														reg_time,
														last_time,
														last_ip
															)
															
								 values 
											('{$clean['active']}',
											'{$clean['username']}',
											'{$clean['password']}',
											'{$clean['question']}',
											'{$clean['answer']}',
											'{$clean['sex']}',
											'{$clean['face']}',
											'{$clean['email']}',
											'{$clean['qq']}',
											'{$clean['url']}',
											now(),
											now(),
											'{$_SERVER["REMOTE_ADDR"]}'
												)
								 ") or die('数据库插入出错'.mysql_error());
		//判断是否插入成功，用mysql_affected_row()进行判断
		if (mysql_affected_rows() == 1){
			//生成xml，用于新进用户
			$clean['id'] = mysql_insert_id();
			set_xml('newvip.xml',$clean);
			location('恭喜你，注册成功',"active.php?active={$clean['active']}");
		}else {
			location('很遗憾，注册失败！','register.php');
		}
		mysql_close();
		}

	require dirname(__FILE__).'/includes/common.inc.php';
	require  dirname(__FILE__).'/includes/header.inc.php';
	$_SESSION['uniqid'] = $uniqid = sha1(uniqid(rand(),true));

?>
<div id="register">
	<h2>注册页面</h2>
	<?php if (!empty($global_clean['register'] )) {?>
	<dl>
		<dd>	<form method="post" action="register.php">
			<input type="hidden" name="uniqid" value="<?php echo $uniqid ?>" />
			<input type="hidden" name="hidden" value="register" />
		<dl>
			<dt>请认真填写一下内容</dt>
			<dd>用 户 名：<input type="text" name="username" class="text" />(*必填，至少两位)</dd>
			<dd>密　　码：<input type="password" name="password" class="text" />(*必填，至少六位)</dd>
			<dd>确认密码：<input type="password" name="yespassword" class="text" />(*必填，同上)</dd>
			<dd>密码提示：<input type="text" name="question" class="text" />(*必填，至少两位)</dd>
			<dd>密码回答：<input type="text" name="answer" class="text" />(*必填，至少两位)</dd>
			<dd>性　　别：<input type="radio" name="sex" value="男" checked="checked" />男 <input type="radio" name="sex" value="女" />女</dd>
			<dd class="face"><input type="hidden" id="input_face" name="face" value="face/m01.gif" /><img src="face/m01.gif" alt="头像选择" id="faceimg" /></dd>
			<dd>电子邮件：<input type="text" name="email" class="text" /></dd>
			<dd>　Q Q 　：<input type="text" name="qq" class="text" /></dd>
			<dd>主页地址：<input type="text" name="url" class="text" value="http://" /></dd>
			<?php if (!empty($global_clean['code'] )) {?>
			<dd>验 证 码：<input type="text" name="code" class="yzm"  /><img src="code.php" id="code" />（点击验证码实现刷新）</dd>
			<?php }?>
			<dd><input type="submit" class="submit" value="注册" /></dd>
		</dl>
	</form></dd>
	</dl>
	<?php }else { echo '<h4  style="text-align:center; margin:20px;">本站未开放注册</h4>';}?>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>