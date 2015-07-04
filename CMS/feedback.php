<?php
	require 'init.inc.php';
	global $templates;
	$feedback = new FeedBackAction('feedback.tpl'); 
	$feedback->Action();
	$templates->display('feedback.tpl'); 
?>