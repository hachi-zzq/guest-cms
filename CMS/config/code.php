<?php
	require '../init.inc.php';
	$code  = new ValidateCode();
	$code->Show_Img();
	$_SESSION['code'] = $code->Get_Code();
?>