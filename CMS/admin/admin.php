<?php
	require '../init.inc.php';
	Validate::Check_Login();
	global $templates;

	$templates->display('admin.tpl');
?>