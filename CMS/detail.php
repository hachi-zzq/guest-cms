<?php
	require 'init.inc.php';
	global $templates;
	$nav = new NavAction('detail.tpl');
	$nav->Show_Nav();
	$detail = new DetailAction('detail.tpl'); 
	$detail->Action();
	$templates->display('detail.tpl');
?>