<?php
global $templates;
$_nav = new NavAction($templates);
$_nav->Show_Nav();													//列出所有的主导航，因为每个页面都要使用，所以放在common中好调用

if (isset($_COOKIE['user'])){
	$templates->assgin('header',$_COOKIE['user'].' 欢迎您 <a href="register.php?action=logout">退出</a>');
}else{
	$templates->assgin('header','<a href="register.php?action=reg">注册</a><a href="register.php?action=login">登入</a>');
}
?>