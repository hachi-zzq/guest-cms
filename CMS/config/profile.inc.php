<?php
//数据库配置文件
define(DB_HOST, 'localhost');
define(DB_USER, 'root');
define(DB_PASS, 'php');
define(DB_NAME, 'cms');
define(PAGE_SIZE,'5');
define('GPC', get_magic_quotes_gpc());												//是否开启自动转义
define('PREV_URL', $_SERVER["HTTP_REFERER"]);							//记录上一次的url
define('MAX_SIZE', 2048);																			//定义上传的最大值
define('UP_DIR', 'uploads/');																//定义上传文件目录
//目录配置信息
define(TPL_DIR, ROOT_PATH.'/templates/');										//定义模板文件夹目录
define(TPL_C_DIR, ROOT_PATH.'/templates_c/');								//定义编译文件的目录
define(CACHE_DIR, ROOT_PATH.'/cache/');										//定义缓存目录
?>