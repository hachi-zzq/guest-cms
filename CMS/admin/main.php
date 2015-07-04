<?php
	require '../init.inc.php';
	global $templates;
	Validate::Check_Login();
	$templates->display('main.tpl');
?>