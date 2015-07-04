<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/member_friend.css" />
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
	require  dirname(__FILE__).'/includes/header.inc.php';
	
	//好友同意操作
	if (isset($_GET['id']) && $_GET['action']==agree){
		mysql_query("update friend set state=1 where id={$_GET['id']}");
			
		if (mysql_affected_rows()==1){
			mysql_close();
			location('恭喜你，你已经和ta成为好友','member_friend.php');
		}else {
			mysql_close();
			location('很遗憾，操作失败','member_friend.php');
		}
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
	<div id="member_friend">
	<h2>好友管理</h2>
<?php 

	//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	$pagesize = 15;//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$row = mysql_query("select id,state,fromuser,touser,content,date from friend where touser='{$_COOKIE['username']}' or fromuser='{$_COOKIE['username']}' limit $pagestart,$pagesize");
	$num = mysql_num_rows(mysql_query("select id from friend where touser='{$_COOKIE['username']}' or fromuser='{$_COOKIE['username']}'"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
?>
<table>
	<tr><th>好友</th><th>请求内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
<?php 
	while (!!$un = mysql_fetch_array($row)){
	
		if ($un['fromuser'] == $_COOKIE['username']){
		//您请求别人
		$friend = $un['touser'];
		if ($un['state'] ==0){
			$state = '等待对方同意';
		}else {
			$state = '通过';
		}
	}elseif ($un['touser'] == $_COOKIE['username']){
		//别人请求你
		$friend = $un['fromuser'];
		if ($un['state'] ==0){
			$state = '<a href=?action=agree&id='.$un['id'].'><span style="color:red;">等待您同意</span></a>';
		}else {
			$state = '通过';
		}
	}
?>
		<tr><td><?php echo $friend;?></td><td title="<?php echo $un['content'];?>"><a href="member_message_detail.php?id=<?php echo $un['id'];?>"><?php echo title($un['content'],10);?></a></td><td><?php echo $un['date'];?></td><td><?php echo $state;?></td><td><input type="checkbox" /></td></tr>
		
<?php 
	}
?>
	</table>
<div id="page_text">
<ul>
	<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
	<li>共有<?php echo $num;?>个好友 |</li>
	<?php 
	if ($page == $ceil){
		echo '<li><a href="member_friend.php?page=1">首页 |</a></li>';
		//echo '<li><a href="member_message.php?page='.$ceil.'""> 尾页 |</a></li>';
	}else {
			if ($page == 1){
				echo '<li><a href="member_friend.php?page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="member_friend.php?page='.$ceil.'">尾页 |</a></li>';
		}else {
				echo '<li><a href="member_friend.php?page=1">首页 |</a></li>';
				echo '<li><a href="member_friend.php?page='.($page-1).'">上一页 |</a></li>';
				echo '<li><a href="member_friend.php?page='.($page+1).'">下一页 |</a></li>';
				echo  '<li><a href="member_friend.php?page='.$ceil.'""> 尾页 |</a></li>';
		}
		
	}
	
	?>
</ul>
</div>
	</div>

</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
