<?php
	require 'init.inc.php';
	global $templates;
	$search = new SearchAction('search.tpl');
	$search->Action();
	$templates->display('search.tpl');
?>