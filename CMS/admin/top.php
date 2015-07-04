<?php
	require '../init.inc.php';
	global $templates;
	$templates->assgin('admin_user', $_SESSION['admin']['username']);
	$templates->assgin('admin_level', $_SESSION['admin']['level_position']);
	
	$templates->display('top.tpl');

?>