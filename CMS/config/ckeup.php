<?php
require '../init.inc.php';
if (isset($_GET['type'])) {
	//查看了源代码，他的名称是：upload
	$_fileupload = new FileUpload('upload',$_POST['MAX_FILE_SIZE']);
	$_ckefn = $_GET['CKEditorFuncNum'];
	$_path = $_fileupload->Get_Link_Path();
	$img = new Image($_fileupload->Get_Path());
	$img->Ck_Up(650, 600);
	$img->Out();
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($_ckefn,\"$_path\",'图片上传成功！');</script>";
	exit();
} else {
	Tool::alertBack('警告：由于非法操作导致上传失败！');
}


?>