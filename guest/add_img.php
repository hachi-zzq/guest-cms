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
<link rel="stylesheet" type="text/css" href="style/1/add_img.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/add_img.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require  dirname(__FILE__).'/includes/add_dir_fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//普通会员也可以添加图片
	check_login();
	if ($_GET['action'] == 'add_img'){
		
		$clean = array();
		$clean['name'] = check_name($_POST['name']);
		$clean['url'] = check_photo_url($_POST['url']);
		$clean['content'] = $_POST['content'];
		 $clean['dir_id'] = $_POST['dir_id'];
		 //开始写入数据库
		 mysql_query("insert into photo (
		 															name,
		 															username,
		 															url,
		 															content,
		 															dir_id,
		 															date
		 																)
		 							values					(
		 															'{$clean['name']}',
		 															'{$_COOKIE['username']}',
		 															'{$clean['url']}',
		 															'{$clean['content']}',
		 															'{$clean['dir_id']}',
		 															now()
		 																)");
		if (mysql_affected_rows() == 1){
			location('图片添加成功','photo_show.php?id='.$clean['dir_id']);
		}else {
			alert('图片添加失败');
		}
		 
		exit();
	}
	//获取数据
	if (isset($_GET['id'])){
		if (!!$row = mysql_fetch_array(mysql_query("select * from add_dir where id='{$_GET['id']}'"))){
			$html = array();
			$html['dir'] = $row['dir'];
			$html['id'] = $row['id'];
		}else {
			alert('不存在此目录');
		}
	}else {
		exit('非法操作');
	}

		//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';

?>
<div id="add_dir">
	<h2>添加图片</h2>
	<form method="post" action="?action=add_img">
	<input type="hidden" name="dir_id" value="<?php echo $html['id'];?>"/>
	<dl>
		<dd>图片名称：<input type="text" name="name" class="text" /></dd>
		<dd>图片地址：<input type="text" name="url"  readonly="readonly" id = "url" class="text" /><a href="javascript:;" id="uploads" title = "<?php echo $html['dir']?>"style="padding-left:10px; text-decoration:underline;">上传</a></dd>
		<dd>图片描述：<textarea name="content"></textarea></dd>
		<dd><input type="submit" class="submit" value="添加图片" /></dd>
	</dl>
	</form>

</div>
	
	
<?php
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
