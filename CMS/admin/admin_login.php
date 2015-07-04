<?php
	require '../init.inc.php';
	global $templates;
	$login = new LoginAction('admin_login.tpl');
	$login->Action();
	$templates->display('admin_login.tpl');
?>