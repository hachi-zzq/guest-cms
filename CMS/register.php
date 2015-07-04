<?php
	require 'init.inc.php';
	global $templates;
	$register = new RegisterAction('register.tpl');
	$register->Action();
	$templates->display('register.tpl'); 
?>