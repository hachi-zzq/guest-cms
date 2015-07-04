<?php
	require '../init.inc.php';
	$file = new FileUpload('pic');
	//$path  = $file->Get_Link_Path();
	if (isset($_POST['type'])){
		switch ($_POST['type']){
			case 'content':
				$hight = 100;
				$width = 150;
				break;
			case 'rotatain':
				$hight = 	193;
				$width = 268;
		}
	}
	$img = new Image($file->Get_Path());
	$img->Thumb($width,$hight);
	$img->Out();
	Tool::alertOpenerClose('上传成功',  $file->Get_Link_Path());
?>