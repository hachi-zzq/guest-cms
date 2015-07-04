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
<link rel="stylesheet" type="text/css" href="style/1/add_dir.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/add_dir.js"></script>
</head>
<body>
<?php 
	define('IN_TG',true);
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require  dirname(__FILE__).'/includes/add_dir_fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//必须是管理员才能建立相册目录
	check_admin_login();
	//开始接收数据
	if ($_GET['action'] == 'add_dir'){
		//首先检查photo这个根目录是否存在
		if (!is_dir('photo')){//如果不存在这个目录，首先建立这个目录
			mkdir('photo');		
		}

		$clean = array();
		$clean['name'] = check_name($_POST['name']);
		$clean['type'] = $_POST['type'];
		if ($clean['type'] == 0){
			$clean['password'] = null;
		}else if ($clean['type'] == 1){
			$clean['password'] = sha1(check_password($_POST['password']));
		}
		$clean['content'] = $_POST['content'];
		$clean['face'] = $_POST['face'];
		$clean['dir'] = 'photo/'.time();
		$clean = mysql_escape($clean);
		mysql_query("insert into add_dir 
											(name,
											type,
											password,
											content,
											dir,
											face,
											date
											)
												
					 values 
								('{$clean['name']}',
								'{$clean['type']}',
								'{$clean['password']}',
								'{$clean['content']}',
								'{$clean['dir']}',
								'{$clean['face'] }',
								now()
								)
								 ");						
		if (mysql_affected_rows() == 1){
			//建立子目录，以当前时间戳命名
			mkdir('photo/'.time());
			location('目录添加成功',"photo.php");
		}else {
			alert('目录添加失败');
		}
		mysql_close();										
		
	}
		//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';

?>
<div id="add_dir">
	<h2>添加相册</h2>
	<form method="post" action="?action=add_dir">
	<dl>
		<dd>相册名称：<input type="text" name="name" class="text" /></dd>
		<dd>相册类型：<input type="radio" name="type" value="0" checked="checked" /> 公开 <input type="radio" name="type" value="1" /> 私密</dd>
		<dd id="pass">相册密码：<input type="password" name="password" class="text" /></dd>
		<dd>相册封面：<input type="text" name="face" class="text"  id="photo_face"/><a href="javascript:;" id="up" title="上传封面">上传</a></dd>
		<dd>相册描述：<textarea name="content"></textarea></dd>
		<dd><input type="submit" class="submit" value="添加目录" /></dd>
	</dl>
	</form>

</div>
	
	
<?php
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
