<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/photo_detail.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	if (isset($_GET['id'])){
		if (!!$row = mysql_fetch_array(mysql_query("select * from photo where id='{$_GET['id']}'"))){
			mysql_query("update photo set read_count = read_count + 1");
			$photo_detail = array();
			$photo_detail['id'] = $row['id'];
			$photo_detail['dir_id'] = $row['dir_id'];
			$photo_detail['url'] = $row['url'];
			$photo_detail['name'] = $row['name'];
			$photo_detail['content'] = $row['content'];
			$photo_detail['username'] = $row['username'];
			$photo_detail['read_count'] = $row['read_count'];
			$photo_detail['comment_count'] = $row['comment_count'];
			$photo_detail['date'] = $row['date'];
		}
		//获取上一张图片的id，思路：找到比这张id大的id中最小的
		$pre_photo_id = mysql_fetch_array(mysql_query("select min(id) as min_id from photo where id>'{$photo_detail['id']}' and dir_id='{$photo_detail['dir_id']}'"));
//		if (empty($pre_photo_id['min_id'])){
//			location('已经是最后一张','photo_show.php?id='.$photo_detail['dir_id']);
//		}
		if (empty($pre_photo_id['min_id'])){
			$pre = '<span>已经到头</span>';
		}else {
			$pre  ='<a href="?id='.$pre_photo_id['min_id'].'">下一张</a>';
		}
		//获取下一下图片的id
		$next_photo_id = mysql_fetch_array(mysql_query("select max(id) as max_id from photo where id<'{$photo_detail['id']}' and dir_id='{$photo_detail['dir_id']}'"));
//		if (empty($next_photo_id['max_id'])){
//			location('已经是最后一张','photo_show.php?id='.$photo_detail['dir_id']);
//		}
		if (empty($next_photo_id['max_id'])){
			$next  = '<span>已经是最后一张</span>';
		}else{
			$next ='<a href="?id='.$next_photo_id['max_id'].'">下一张</a>';
		}
	}else {
		alert('非法操作');
	}
	//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="photo_detail">
<h2>图片详情</h2>
<dl class="detail">
<dd class="name"><?php echo $photo_detail['name']?></dd>
<dt><?php echo $pre;?><img src="<?php echo $photo_detail['url']?>" /><?php echo $next;?></dt>
<dd>浏览量(<strong><?php echo $photo_detail['read_count'];?></strong>) 评论量(<strong><?php echo $photo_detail['comment_count'];?></strong>) 发表于：<?php echo $photo_detail['date']?> 上传者：<?php echo $photo_detail['username']?></dd>
<dd>简介：<?php echo $photo_detail['content']?></dd>
</dl>
<p>[<a href="photo_show.php?id=<?php echo $photo_detail['dir_id']?>">返回列表</a>]</p>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
