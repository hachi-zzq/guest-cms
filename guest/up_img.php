<?php 
	@session_start()
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/up_img.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	//首先判断是否已经登入,不一定要管理员
	check_login();
	if ($_GET['action'] == 'up'){
		print_r($_FILES);
		//开始上传文件
		$file_type = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');//规定上传的文件类型
		//进行上传文件类型判断
		if (is_array($file_type)){
			if (!in_array($_FILES['userfile']['type'],$file_type)){
				close('文件格式不合法');
			}		
		}
		//格式合法后，判断上传错误
		if ($_FILES['userfile']['error'] > 0){
			switch ($_FILES['userfile']['error']) {
				case 1:
				close('文件大小超出约定值');
				break;
				case 2:
				close('文件大小超出约定值');
				break;
				case 3:
				close('文件部分被上传');
				break;
				case 4:
				close('未选中上传文件');
				break;
			}
		}
		//配置大小，用于控制上传文件不超出表单中约定的大小
		if ($_FILES['userfile']['size'] > 1000000){
			close('文件太小，请重新选择');
		}
		//格式正确，大小合法后，开始上传，但是首先得判断存在文件的文件夹是否存在
		define('URL',$_POST['dir']);
		if (!is_dir(URL)){
			mkdir(URL);
		}
		//文件夹存在后，就开始判断临时文件是否存在，存在就直接移动，不存在就终止程序
		$name = URL.'/'.time().'.'.substr($_FILES['userfile']['type'],6);//设置文件名
		
		if (!is_uploaded_file($_FILES['userfile']['tmp_name'])){
			close('临时文件不存在');
		}else {							//开始移动
			if (!move_uploaded_file($_FILES['userfile']['tmp_name'],$name)){
				close('文件移动失败');
			}else {
				move_uploaded_file($_FILES['userfile']['tmp_name'],$name);
				echo "<script>alert('上传成功！');window.opener.document.getElementById('url').value='$name';window.close();</script>";
			}
		}
	}
	
?>
<div id="up">
	<form enctype="multipart/form-data" action="?action=up"method="post">
		<input type="hidden"name="MAX_FILE_SIZE" value="1000000" />
		<input type="hidden" name="dir" value="<?php echo $_GET['url'];?>" />
		选择图片: <input type="file" name="userfile"/>
		<input type="submit" name="send" value="上传" />
	</form>
</div>

</body>
</html>
