<?php
	require 'init.inc.php';
	global $templates;
	$index = new IndexAction('index.tpl');
	$index->Action();
	$templates->display('index.tpl');
?>