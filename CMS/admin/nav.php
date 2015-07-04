<?php
	require '../init.inc.php';
	Validate::Check_Login();
	$nav = new NavAction('nav.tpl');
	$nav->Action();
	$templates->display($nav->tpl);
?>