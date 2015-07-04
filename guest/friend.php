<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/friend.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/message.fun.php';
		//首先判断是否已经登入
	if (!isset($_COOKIE['username'])){
		close('请先登入');
	}
	date_default_timezone_set('PRC');
	//开始发送短息
if ($_GET['action'] == 'add'){
//@用于屏蔽警告
//		if (!($_POST['code'] == $_SESSION['code'])){
//			alert('验证码错误，请重新输入');
//		}
	$clean = array();//定义一个数组，用来存放接收到得数据
	$clean['touser'] =$_POST['touser'];
	$clean['fromuser'] =$_COOKIE['username'];
	$clean['content'] =check_content($_POST['content']);
	//首先判断好友是否存在
	if (!$row = mysql_fetch_array( mysql_query("select id from user where username='{$clean['touser']}'"))){
		close('好友不存在');
		exit();
	};

	
	//判断是否添加自己为好友，不允许添加自己为好友
	if ($clean['touser'] == $_COOKIE['username']){
		close('不允许添加自己为好友');
		exit();
	}
//	
//	//再判断是否已经是好友
	if (!!$result = mysql_fetch_array( mysql_query("select
																							 * 
																					from 
																								friend 
																					where
																									( touser='{$clean['touser']}' and fromuser='{$clean['fromuser']}')
																					or
																									( touser='{$clean['fromuser']}' and fromuser='{$clean['touser']}')
																					 "))){
		
		close('你们已经是好友');
		exit();
	};


	//	开始写入数据
	mysql_query("insert into friend 
															(touser,
															fromuser,
															content,
															date
																)
																
									 values 
												('{$clean['touser']}',
												'{$_COOKIE['username']}',
												'{$clean['content']}',
													now())
									 ") or die('数据库插入出错'.mysql_error());
		//判断是否插入成功，用mysql_affected_row()进行判断
		if (mysql_affected_rows() == 1){
			close('恭喜你，添加成功，请等待对方同意');
		}else {
			location('很遗憾请求发送失败，请重新发送','');
		}
		session_destroy();
		mysql_close();
	
	exit();//必须退出，因为此时的id已经不存在，继续往下执行会会错
}
	//开始接收数据
	if (isset($_GET['id'])){
		//如果接收到id，那么开始获取收件人！
		$row =mysql_fetch_array( mysql_query("select username from user where id='{$_GET['id']}'"))or die(mysql_error());
		if (isset($row)){
			$clean_username = mysql_escape($row['username']);
		}else {
			close('用户名不存在');
		}
	}else{
		close('非法操作');
	}
?>
<div id="head">
	<h3>添加好友</h3>
</div>
<div id="message">
	<form action="friend.php?action=add" method="post">
	<input  type="hidden" name="touser" value="<?php echo $clean_username;?>"/>
	<dl>
		<dd><input type="text"  readonly="readonly" class="text" value="To：<?php echo $clean_username;?>" /><br /></dd>
		<dd><textarea name="content" class="textarea" > <?php echo $clean_username;?> 我很想和你交朋友！</textarea><br /></dd>
		<dd>验 证 码：<input type="text" name="code" class="code"  /><img src="code.php" id="code" /><input type="submit" class="submit" value="发送短信" /></dd>
	</dl>
	</form>
</div>
</body>
</html>
