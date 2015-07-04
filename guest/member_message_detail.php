<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/member_message_detail.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	check_login();//判断是否已经登入
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//删除短信模块
	if ($_GET['action'] == delete && isset($_GET['id'])){
		mysql_query("delete  from message where id='{$_GET['id']}' and touser='{$_COOKIE['username']}'") or die(mysql_error());
		if (mysql_affected_rows() == 1){
			location('删除成功','member_message.php');
		}else {
			alert('删除失败');
		}
		exit();
	}
	
	require  dirname(__FILE__).'/includes/header.inc.php';
	//接收短信详情模块
	if (isset($_GET['id'])){
		$row = mysql_fetch_array(mysql_query("select 
																							id,
																							fromuser,
																							content,
																							date 
																					from 
																							message 
																					where 
																							touser='{$_COOKIE['username']}'and id='{$_GET['id']}'"));

		if ($row){
			//判断是否已读
			if ($row['state'] == 0){
				mysql_query("update 
															message 
											set 
															state='1' 
											where 
															touser='{$_COOKIE['username']}'and id='{$_GET['id']}'");
			}
		}else {
			alert('此短信不存在');
		}
	}else alert('出错');
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
	<div id="member_message_detail">
		<h2>短信详情</h2>
		<dl>
		<dd>发件人：<p><?php echo $row['fromuser'];?></p></dd>
		<dd>内容：<h3><?php echo $row['content'];?></h3></dd>
		<dd>发送时间：<p><?php echo $row['date'];?></p></dd>
		<dd><input type="button" value="返回列表" id="return" /><input type="button"  value="删除短信" id="delete" name="<?php echo $row['id'];?>"/></dd>
		</dl>
	</div>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>