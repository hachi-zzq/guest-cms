<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-14
*/
	ob_start();
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/photo_show.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/photo_show.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	if ($_GET['action'] == 'delete'){
		$row = mysql_fetch_array(mysql_query("select dir_id,url from photo where id='{$_GET['photo_id']}'"));
		//首先删除数据库数据
		mysql_query("delete from photo where id='{$_GET['photo_id']}'");
		//再删除硬盘中数据
		unlink($row['url']);
		if (mysql_affected_rows() == 1){
			location('图片删除成功',"photo_show.php?id=".$row['dir_id']);
		}else {
			alert('图片删除失败');
		}
		exit();
	}
	
	if (isset($_GET['id'])){
		if (!!$row = mysql_fetch_array(mysql_query("select * from add_dir where id='{$_GET['id']}'"))){
			$html = array();
			$html['id'] = $row['id'];
			$html['name'] = $row['name'];
			$html['type'] = $row['type'];
		}else {
			alert('不存在此目录');
		}
	if ($_GET['action'] == 'password'){
		$password = sha1($_POST['password']);
		if (!!$row = mysql_fetch_array(mysql_query("select id from add_dir where password='$password' and id='{$html['id']}'"))){
			setcookie('dir_password',$html['name']);
			location(null,'photo_show.php?id='.$html['id']);
		}else {
			alert('密码错误');
		}
	}
	

	}else {
		exit('非法操作');
	}
		//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
	if ($html['type'] == 1 && (!isset($_COOKIE['dir_password']))){
		//echo "<script>centerWindow('friend.php?id='+this.title,'friend',250,400);</script>";
		echo ('<form method="post"  action="?id='.$_GET['id'].'&action=password">请输入密码：<input type="password" name="password" /><input type="submit" value="确认"></form>');
		require dirname(__FILE__).'/includes/footer.inc.php';
		exit();
	}
	$percent = 0.4;
	
?>
<div id="photo_show">
	<h2>相册图片</h2>
<?php 
	//分页模板
	$page = $_GET['page'];
		if (!isset($page)){
			$page = 1;
	}
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	$pagesize = $global_clean['photo_page'];//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$result = mysql_query("select * from photo where dir_id = '{$_GET['id']}' order by date DESC limit $pagestart,$pagesize");
	$num = mysql_num_rows(mysql_query("select id from photo where dir_id = '{$_GET['id']}'"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
	while (!!$row = mysql_fetch_array($result)) {
	global $html_photo;
	$html_photo = array();
	$html_photo['id'] = $row['id'];
	$html_photo['username'] = $row['username'];
	$html_photo['name'] = $row['name'];
	$html_photo['dir_id'] = $row['dir_id'];
	$html_photo['url'] = $row['url'];
				
?>
	<dl>
		<dt><a href="photo_detail.php?id=<?php echo $html_photo['id']?>"><img src="thumb.php?filename=<?php echo $html_photo['url']?>&percent=<?php echo $percent?>" /></a>.</dt>
		<dd><?php echo $html_photo['name']?></dd>
		<dd>阅(<strong>0</strong>) 评(<strong>0</strong>) 上传者：<?php echo $html_photo['username']?></dd>
		<?php if (isset($_COOKIE['admin']) ||  $_COOKIE['username'] == $html_photo['username']) { ?>
		<dd>[<a href="?photo_id=<?php echo $html_photo['id'];?>&action=delete">删除</a>]</dd>
		<?php }?>
	</dl>
<?php }?>
	<?php if (isset($_COOKIE['username'])) {?>
	<p><a href="add_img.php?id=<?php echo $html['id']?>">添加图片</a></p>
	<?php }?>
	<div id="page_text">
		<ul>
			<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
			<li>共有<?php echo $num;?>张照片 |</li>
			<?php 
			if ($page == 1){
				echo '<li><a href="photo_show.php?page='.($page+1).'&id='.$html['id'].'">下一页 |</a></li>';
				echo '<li><a href="photo_show.php?page='.$ceil.'&id='.$html['id'].'""> 尾页 |</a></li>';
			}else {
					if ($page == $ceil){
						echo '<li><a href="photo_show.php?page=1&id='.$html['id'].'">首页 |</a></li>';
						echo '<li><a href="photo_show.php?page='.($page-1).'&id='.$html['id'].'">上一页 |</a></li>';
				}else {
						echo '<li><a href="photo_show.php?page=1&id='.$html['id'].'">首页 |</a></li>';
						echo '<li><a href="photo_show.php?page='.($page-1).'&id='.$html['id'].'">上一页 |</a></li>';
						echo '<li><a href="photo_show.php?page='.($page+1).'&id='.$html['id'].'">下一页 |</a></li>';
						echo  '<li><a href="photo_show.php?page='.$ceil.'&id='.$html['id'].'""> 尾页 |</a></li>';
				}
				
			}
			
			?>
		</ul>
	</div>
</div>

<?php
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
