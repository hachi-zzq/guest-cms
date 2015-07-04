<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-21
*/
	if (!defined('IN_TG')){
		exit('非法调用！');
	}

	$time =explode(' ', microtime());
	$start_time= $time[0]+$time[1];
	$GLOBALS['START_TIME'] = $start_time;
?>

<div id="header">
<h1><a href="index.php">瓢城web俱乐部</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<?php 
			if (isset($_COOKIE['username'])){
				echo '	<li><a href="member.php">'.$_COOKIE['username'].'•个人中心</a>'.$GLOBALS['count'].'</li>';
				echo '	<li ><a href="blog.php">博友</a></li>';
				echo '	<li ><a href="photo.php">相册</a></li>';
				echo '		<li>风格</li>';
				echo "\n";
				if (isset($_SESSION['admin'])){
					echo '<li ><a href="manager.php" class="manager">管理</a></li>';
				}
				echo	'<li> <a href="logout.php">退出</a></li>';
			}else {
				echo '	<li><a href="register.php">注册</a></li>';
				echo '	<li><a href="login.php">登录</a></li>';
				echo '	<li ><a href="photo.php">相册</a></li>';
				echo '	<li>风格</li>';
				echo "\n";
			}
		
		?>





	</ul>
</div>