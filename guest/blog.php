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
<link rel="stylesheet" type="text/css" href="style/1/blog.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	check_login();
		//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';

?>
<div id="blog">
	<h2>博友</h2>
	<?php 
	//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	$pagesize = $global_clean['blog_page'];//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$row = mysql_query("select id,sex,username,face from user limit $pagestart,$pagesize");
	$num = mysql_num_rows(mysql_query("select id from user"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
	while (!!$un = mysql_fetch_array($row)){
	?>
	<dl>
		<dd class="title"><?php echo $un['username'];?><br />(<?php echo $un['sex'];?>)</dd>
		<dt><img src="<?php echo $un['face'];?>" /></dt>
		<dd class="connect"><a href="javascript:;" name="message" title="<?php echo $un['id'];?>">联系ta</a></dd>
		<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $un['id'];?>">加为好友</a></dd>
		<dd class="guest">留 言</dd>
		<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $un['id'];?>">送 花</a></dd>
	</dl>
	<?php }?><!--
	<div id="page">
	<ul>
		<?php for ($i = 1;$i<=$ceil;$i++){?>
		<li><a href="blog.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
	<?php }?>
	</ul>
	</div>
--><!--	文本分页模块-->
	<div id="page_text">
		<ul>
			<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
			<li>共有<?php echo $num;?>个博友 |</li>
			<?php 
			if ($page == 1){
				echo '<li><a href="blog.php?page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="blog.php?page='.$ceil.'""> 尾页 |</a></li>';
			}else {
					if ($page == $ceil){
						echo '<li><a href="blog.php?page=1">首页 |</a></li>';
						echo '<li><a href="blog.php?page='.($page-1).'">上一页 |</a></li>';
				}else {
						echo '<li><a href="blog.php?page=1">首页 |</a></li>';
						echo '<li><a href="blog.php?page='.($page-1).'">上一页 |</a></li>';
						echo '<li><a href="blog.php?page='.($page+1).'">下一页 |</a></li>';
						echo  '<li><a href="blog.php?page='.$ceil.'""> 尾页 |</a></li>';
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
