<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/manager_vip_list.css" />
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
	<div id="member_message">
	<h2>会员列表</h2>
<?php 
	//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	$pagesize = 15;//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$row = mysql_query("select id,username,email,reg_time from user order by reg_time DESC limit $pagestart,$pagesize ");
	$num = mysql_num_rows(mysql_query("select id from user "));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
?>
<table>
	<tr><th>ID号</th><th>会员名</th><th>email</th><th>注册时间</th><th>操作</th></tr>
<?php 
	while (!!$un = mysql_fetch_array($row)){
?>
		<tr><td><?php echo $un['id'];?></td><td><?php echo $un['username'];?></td><td><?php echo $un['email'];?></td><td><?php echo $un['reg_time'];?></td><td>[<a href="#">修</a>][<a href="#">删</a>]</td></tr>
		
<?php 
	}
?>
	</table>
<div id="page_text">
<ul>
	<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
	<li>共有<?php echo $num;?>位会员 |</li>
	<?php 
	if ($page == $ceil){
		echo '<li><a href="manager_vip_list?page=1">首页 |</a></li>';
		//echo '<li><a href="member_message.php?page='.$ceil.'""> 尾页 |</a></li>';
	}else {
			if ($page == 1){
				echo '<li><a href="manager_vip_list?page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="manager_vip_list?page='.$ceil.'">尾页 |</a></li>';
		}else {
				echo '<li><a href="manager_vip_list?page=1">首页 |</a></li>';
				echo '<li><a href="manager_vip_list?page='.($page-1).'">上一页 |</a></li>';
				echo '<li><a href="manager_vip_list?page='.($page+1).'">下一页 |</a></li>';
				echo  '<li><a href="manager_vip_list?page='.$ceil.'""> 尾页 |</a></li>';
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
