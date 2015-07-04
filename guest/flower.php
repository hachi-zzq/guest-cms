<?php 
	@session_start()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/flower.css" />
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
if ($_GET['action'] == 'flower'){

		if (!($_POST['code'] == $_SESSION['code'])){
			alert('验证码错误，请重新输入');
		}
	$clean = array();//定义一个数组，用来存放接收到得数据
	$clean['touser'] =$_POST['touser'];
	$clean['fromuser'] =$_COOKIE['username'];
	$clean['count'] = $_POST['flower'];
	$clean['content'] =check_content($_POST['content']);
	//	开始写入数据
	mysql_query("insert into flower 
															(touser,
															fromuser,
															count,
															content,
															date
																)
																
									 values 
												('{$clean['touser']}',
												'{$_COOKIE['username']}',
												'{$clean['count'] }',
												'{$clean['content']}',
													now())
									 ") or die('数据库插入出错'.mysql_error());
		//判断是否插入成功，用mysql_affected_row()进行判断
		if (mysql_affected_rows() == 1){
			close('恭喜你，发送成功');
		}else {
			location('很遗憾发送失败，请重新发送','');
		}
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
	<h3>送花</h3>
</div>
<div id="message">
	<form action="?action=flower" method="post">
	<input  type="hidden" name="touser" value="<?php echo $clean_username;?>"/>
	<dl>
		<dd><input type="text"  readonly="readonly" class="text" value="To：<?php echo $clean_username;?>" />
		<select  name="flower">
		<?php foreach (range(1,100) as $num) {
			echo '<option  value="'.$num.'">x'.$num.'</option>';
		}?>
			
		</select>
		<br />
		</dd>
		<dd><textarea name="content" class="textarea">很喜欢你，给你送花啦</textarea><br /></dd>
		<dd>验 证 码：<input type="text" name="code" class="code"  /><img src="code.php" id="code" /><input type="submit" class="submit" value="发送短信" /></dd>
	</dl>
	</form>
</div>
</body>
</html>
