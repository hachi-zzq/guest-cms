<?php
	require '../init.inc.php';
	global $templates;
	$manage = new ManageAction('manage.tpl');
	$manage->Action();
	$templates->display($manage->tpl);
?>