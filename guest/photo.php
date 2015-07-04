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
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/photo.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//开始获取数据
	$result = mysql_query("select * from add_dir order by date ASC");
	if (isset($_GET['id']) && $_GET['action'] == 'delate'){
		//首先删除数据库信息
		mysql_query("delete from add_dir where id={$_GET['id']}");
		if (mysql_affected_rows() == 1){
			location('相册删除成功',"?");
		}else {
			alert('相册删除失败');
		}
	}
	
	//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';

?>
<div id="photo">
	<h2>相册</h2>
	
<?php
//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	$pagesize = 15;//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$num = mysql_num_rows(mysql_query("select id from add_dir"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
	
	$html = array();
	while (!!$row = mysql_fetch_array($result)) {
	$html['id'] = $row['id'];
	$html['name'] = $row['name'];
	$html['type'] = $row['type'];
	$html['content'] = $row['content'];
	$html['face'] = $row['face'];
	if ($html['type'] == 0){
		$html_type = '公开';
	}elseif ($html['type'] == 1){
		$html_type = '隐私';
	}
	

?>
	<dl>
	<dt><a href="photo_show.php?id=<?php echo $html['id'];?>"><img src="<?php echo $html['face']?>"/></a></dt>
	<dd><a href="photo_show.php?id=<?php echo $html['id'];?>"><?php echo $html['name'];?></a><span style="color:red;">(<?php echo $html_type;?>)</span></dd>
	<?php if (isset($_SESSION['admin'])) {?>
	<dd>[<a href="dir_modify.php?id=<?php echo $html['id'];?>">修改</a>][<a href="?id=<?php echo $html['id'];?>&action=delate">删除</a>]</dd>
	<?php }?>
	</dl>
	<?php }?>
	<?php if (isset($_SESSION['admin'])) {?>
	<p><a href="add_dir.php">添加相册</a></p>
	<?php }?>
	<div id="page_text">
		<ul>
			<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
			<li>共有<?php echo $num;?>个相册 |</li>
			<?php 
			if ($page == 1){
				if ($ceil == 1){
					echo '<li><a href="photo.php?page=1">首页 |</a></li>';
				}else {
				echo '<li><a href="photo.php?page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="photo.php?page='.$ceil.'""> 尾页 |</a></li>';
				}
			}else {
					if ($page == $ceil){
						echo '<li><a href="photo.php?page=1">首页 |</a></li>';
						echo '<li><a href="photo.php?page='.($page-1).'">上一页 |</a></li>';
				}else {
						echo '<li><a href="photo.php?page=1">首页 |</a></li>';
						echo '<li><a href="photo.php?page='.($page-1).'">上一页 |</a></li>';
						echo '<li><a href="photo.php?page='.($page+1).'">下一页 |</a></li>';
						echo  '<li><a href="photo.php?page='.$ceil.'""> 尾页 |</a></li>';
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
