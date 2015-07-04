<?php
session_start();
//系统初始化文件，用来配置系统
ob_start();
//首先设置编码
header('Content-Type:text/html;charset=utf-8');
define(ROOT_PATH, dirname(__FILE__).'/');										//定义脚本根目录
require ROOT_PATH.'config/profile.inc.php';										//引入模板配置信息
require 'cache.inc.php';																					//引入缓存机制文件
date_default_timezone_set('PRC');														//设置中国时区
function __autoload($_className) {														//自动加载类
	if (substr($_className, -6) == 'Action') {											//如果需要加载**Action.class类
		require ROOT_PATH.'/Action/'.$_className.'.class.php';
	} elseif (substr($_className, -5) == 'Model') {
		require ROOT_PATH.'/Model/'.$_className.'.class.php';			//如果需要加载**Model.class类
	} else {
		require ROOT_PATH.'/includes/'.$_className.'.class.php';			//都不是的话，那么加载cincludes目录下
	}
}
global $templates;
$templates = new Templates();
require ROOT_PATH.'common.inc.php';
?>