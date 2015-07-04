<?php
	require 'init.inc.php';
	global $templates;
	$nav = new NavAction('index.tpl');
	$nav->Show_Nav();
	$list = new ListAction('index.tpl');
	$list->Action();
	$templates->display('list.tpl');
?>