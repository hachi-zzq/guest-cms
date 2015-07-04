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
	require dirname(__FILE__).'/includes/common.inc.php';
	require  dirname(__FILE__).'/includes/add_dir_fun.php';
	//必须是管理员才能建立相册目录
	check_admin_login();
	//开始修改
	if ($_GET['action'] == 'dir_modify'){
		$clean = array();
		$clean['name'] =check_name( $_POST['name']);
		$clean['type'] = $_POST['type'];
		if ($_POST['type'] == 0){
			$clean['password'] = null;
		}else if ($_POST['type'] == 1){
			if ($_POST['password'] != null)
			$clean['password'] = sha1(check_password($_POST['password']));
		}
		$clean['content'] = $_POST['content'];
		if ($_POST['type'] ==0){
			mysql_query($string = "update add_dir set name='{$clean['name']}',
															type ='{$clean['type']}',
															content='{$clean['content']}',
															password =null
															where id='{$_POST['id']}'
															")or die(mysql_error());
		}elseif ($_POST['type'] ==1){
			if ($_POST['password'] == null){
				mysql_query($string = "update add_dir set name='{$clean['name']}',
																type ='{$clean['type']}',
																content='{$clean['content']}'
																where id='{$_POST['id']}'
																")or die(mysql_error());	
			}else{
				mysql_query($string = "update add_dir set name='{$clean['name']}',
																type ='{$clean['type']}',
																password = '{$clean['password']}',
																content='{$clean['content']}'
																where id='{$_POST['id']}'
																")or die(mysql_error());
			}
		}
		if (mysql_affected_rows()==1){
			mysql_close();
			location('恭喜你，修改成功','photo.php');
		}else {
			mysql_close();
			alert('很遗憾，修改失败');
		}
		exit();
	}
	//开始接收数据
	if (!!$row = mysql_fetch_array(mysql_query("select * from add_dir where id='{$_GET['id']}'"))){
			$html =  array();
			$html['id'] = $row['id'];
			$html['name'] = $row['name'];
			$html['type'] =$row['type'];
			$html['content'] = $row['content'];
			$html['face'] = $row['face'];
			if ($html['type'] ==0){
				$html_type = '<input type="radio" name="type" value="0" checked="checked" /> 公开 <input type="radio" name="type" value="1" /> 私密';
			}elseif ($html['type'] ==1){
				$html_type = '<input type="radio" name="type" value="0" /> 公开 <input type="radio" name="type" value="1" checked="checked" /> 私密';
			}
		}else {
			alert('目录不存在');
		}

		//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="add_dir">
	<h2>修改相册</h2>
	<form method="post" action="?action=dir_modify">
	<dl>
		<dd>相册名称：<input type="text" name="name" class="text"  value="<?php echo $html['name'];?>"/></dd>
		<dd>相册类型：<?php echo $html_type;?></dd>
		<dd id="pass">相册密码：<input type="password" name="password" class="text" /></dd>
		<dd>相册描述：<textarea name="content"></textarea></dd>
		<dd>相册封面：<input type="text" name="face" class="text" value="<?php echo $html['face'];?>" /></dd>
		<dd><input type="submit" class="submit" value="修改目录" /></dd>
		<dd><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/></dd>
	</dl>
	</form>

</div>
	
	
<?php
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
