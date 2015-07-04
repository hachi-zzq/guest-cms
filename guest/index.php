<?php 
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: ${date}
*/
	@session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/index.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
//	require 'includes/common.php';
//	require 'includes/header.inc.php';
	require  dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	
	//读取xml，用于显示新进用户
	$xml_file = 'newvip.xml';
	if (file_exists($xml_file)){
		$xml = file_get_contents($xml_file);
		preg_match_all('/<vip>(.*)<\/vip>/s',$xml,$dom);
		//print_r($dom);$dom 是一个二维数组
		foreach ($dom[1] as $value){
			//dom【1】是一个一维数组，将每次dom[1]的值都赋值到$value中
			preg_match_all('/<id>(.*)<\/id>/s',$value,$id);
			//print_r($id);
			preg_match_all('/<username>(.*)<\/username>/s',$value,$username);
			preg_match_all('/<sex>(.*)<\/sex>/s',$value,$sex);
			preg_match_all('/<face>(.*)<\/face>/s',$value,$face);
			preg_match_all('/<email>(.*)<\/email>/s',$value,$email);
			preg_match_all('/<url>(.*)<\/url>/s',$value,$url);
			$html_id = htmlspecialchars($id[1][0]);
			$html_username = htmlspecialchars($username[1][0]);
			$html_sex = htmlspecialchars($sex[1][0]);
			$html_face = htmlspecialchars($face[1][0]);
			$html_email = htmlspecialchars($email[1][0]);
			$html_url = htmlspecialchars($url[1][0]);
		}
	}else {
		echo 'xml文件不存在';
	}
	
	require  dirname(__FILE__).'/includes/header.inc.php';
?>

<div id="user">
<h2>新进用户</h2>
	<dl>
		<dd class="title"><?php echo $html_username;?></dd>
		<dt><img src="<?php echo $html_face;?>" /></dt>
		<dd class="connect"><a href="javascript:;" name="message" title="<?php echo $html_id;?>">联系ta</a></dd>
		<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $html_id;?>">加为好友</a></dd>
		<dd class="guest">留 言</dd>
		<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $html_id;?>">送 花</a></dd>
		<dd class="email">邮件：<?php echo  $html_email;?></dd>
		<dd class="url">主页：<?php echo $html_url;?></dd>
	</dl>
</div>

<div id="list">
<h2>帖子列表</h2>
<a class="post" href="post.php"></a>
<ul class="article">
	<?php 
	//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	$pagesize = $global_clean['article_page'];//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$num = mysql_num_rows(mysql_query("select * from article where re_id=0"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
	
	//开始循环出帖子，参考blog.php代码	
	$result = mysql_query("select id,username,title,type,content,read_count,comment_count from article where re_id = 0  order by date ASC limit $pagestart,$pagesize ");
	while (!!$row = mysql_fetch_array($result)){
	$title = $row['title'];
	$html_title = title($title,20);
	?>
	<li class="icon<?php echo $row['type'];?>"><a href="article.php?id=<?php echo $row['id'];?>"><?php echo $html_title;?></a><em>阅读数(<?php echo $row['comment_count'];?>) </em><em>评论数(<?php echo $row['read_count'];?>)</em></li>
<?php }?>
</ul>

	<div id="page_text">
		<ul>
			<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
			<li>共有<?php echo $num;?>个帖子 |</li>
			<?php 
			if ($page == 1){
				echo '<li><a href="index.php?page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="index.php?page='.$ceil.'""> 尾页 |</a></li>';
			}else {
					if ($page == $ceil){
						echo '<li><a href="index.php?page=1">首页 |</a></li>';
						echo '<li><a href="index.php?page='.($page-1).'">上一页 |</a></li>';
				}else {
						echo '<li><a href="index.php?page=1">首页 |</a></li>';
						echo '<li><a href="index.php?page='.($page-1).'">上一页 |</a></li>';
						echo '<li><a href="index.php?page='.($page+1).'">下一页 |</a></li>';
						echo  '<li><a href="index.php?page='.$ceil.'""> 尾页 |</a></li>';
				}
				
			}
			
			?>
		</ul>
	</div>
</div>

<div id="pics">
<h2>最新图片</h2>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
