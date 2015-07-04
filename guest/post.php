<?php
	session_start();
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-14
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/post.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	require dirname(__FILE__).'/includes/post.fun.php';
	check_login();
	//开始发帖
if ($_GET['action'] == 'post'){
		//验证验证码是否输入正确
		if (!empty($global_clean['code'] )) {
			if (!($_POST['code'] == $_SESSION['code'])){
				alert('验证码错误，请重新输入');
			}
		}
		//开始检测是否过度发帖
		if (time() - $_COOKIE['post_time'] < $global_clean['re_time']){
			alert('发帖过度频繁');
		}
	$clean = array();
	$clean['username'] = $_COOKIE['username'];
	$clean['type'] = $_POST['type'];
	$clean['title'] =check_post_title( $_POST['title'],2,40);
	$clean['content'] = check_post_contenr($_POST['content'],2);
	//开始写入数据库
	mysql_query("insert into article 
															(username,
															title,
															type,
															content,
															date
																)
																
									 values 
												('{$clean['username']}',
												'{$clean['title']}',
												'{$clean['type']}',
												'{$clean['content']}',
												now()
													)
									 ") or die('数据库插入出错'.mysql_error());
		//判断是否插入成功，用mysql_affected_row()进行判断
		if (mysql_affected_rows() == 1){
			//发帖成功，开始生成cookie，用于限时发帖
			setcookie('post_time',time());
			location('恭喜你，发帖成功',"index.php");
		}else {
			location('很遗憾，发帖失败！','post.php');
		}
		mysql_close();
	
}
	//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="post">
<h2>发表帖子</h2>
<form method="post" action="?action=post">
<dl>
<dt></dt>
	<dd>类　　型：
	<?php foreach (range(1,16) as $num){
		if ($num == 1){
			echo '<input type="radio" name="type" class="type" value="'.$num.'" checked="checked" />';
		}else {
			echo '<input type="radio" name="type" class="type" value="'.$num.'"/>';
		}
			echo '<img src="images/icon'.$num.'.gif" />';
			if ($num == 8){
				echo '<br />　　　　　 ';
			}
	}
	?>
	</dd>
	<dd>标　　题：　<input  type="text" class="text" name="title"/></dd>
	<dd id="qimg">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
	<dd>
	<?php require  dirname(__FILE__).'/includes/ubb.inc.php';?>
	<textarea name="content" title="帖子内容"  ></textarea></dd>
	<?php if (!empty($global_clean['code'] )) {?>
		<dd>验 证 码：<input type="text" name="code" class="yzm"  /><img src="code.php" id="code" />
	<?php }?>
	<input type="submit" class="submit" value="发表" /></dd>
	
</dl>
</form>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
