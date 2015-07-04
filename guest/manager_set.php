<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/manager_set.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<?php 
	define('IN_TG',true);
	require  dirname(__FILE__).'/includes/global.fun.php';
	check_admin_login();
	//引进数据库连接文件
	require dirname(__FILE__).'/includes/conn.inc.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//开始修改system表
	if ($_GET['action'] == 'set'){
		$_clean = array();
		$_clean['web_name'] = $_POST['webname'];
		$_clean['article'] = $_POST['article'];
		$_clean['blog'] = $_POST['blog'];
		$_clean['photo'] = $_POST['photo'];
		$_clean['skin'] = $_POST['skin'];
		$_clean['post'] = $_POST['post'];
		$_clean['re'] = $_POST['re'];
		$_clean['code'] = $_POST['code'];
		$_clean['register'] = $_POST['register'];
		$_clean['string'] = $_POST['string'];
		$_clean = mysql_escape($_clean);
		mysql_query("UPDATE system SET 
																web_name='{$_clean['web_name']}',
																article_page='{$_clean['article']}',
																blog_page='{$_clean['blog']}',
																photo_page='{$_clean['photo']}',
																skin='{$_clean['skin']}',
																post_time='{$_clean['post']}',
																re_time='{$_clean['re']}',
																code='{$_clean['code']}',
																register='{$_clean['register']}',
																no_string='{$_clean['string']}'
												WHERE
																id=1
													LIMIT 
																1
		")or die(mysql_error());
		if (mysql_affected_rows()==1){
			mysql_close();
			location('恭喜你，修改成功','manager_set.php');
		}else {
			mysql_close();
			location('很遗憾，修改失败','manager_set.php');
		}
	}
	//开始获取system表的数据,如果存在数据
	if (!!$row = mysql_fetch_array(mysql_query("select * from system where id=1"),MYSQL_ASSOC)){
		$_html = array();
		$_html['webname'] = $row['web_name'];
		$_html['article'] = $row['article_page'];
		$_html['blog'] = $row['blog_page'];
		$_html['photo'] = $row['photo_page'];
		$_html['skin'] = $row['skin'];
		$_html['string'] = $row['no_string'];
		$_html['post'] = $row['post_time'];
		$_html['re'] = $row['re_time'];
		$_html['code'] = $row['code'];	
		$_html['register'] = $row['register'];
		$_html = mysql_escape($_html);
		
		//文章
		if ($_html['article'] == 10) {
			$_html['article_html'] = '<select name="article"><option value="10" selected="selected">每页10篇</option><option value="12">每页12篇</option></select>';
		} elseif ($_html['article'] == 12) {
			$_html['article_html'] = '<select name="article"><option value="10">每页10篇</option><option value="12" selected="selected">每页12篇</option></select>';
		}
		
		//博友
		if ($_html['blog'] == 15) {
			$_html['blog_html'] = '<select name="blog"><option value="15" selected="selected">每页15人</option><option value="20">每页20人</option></select>';
		} elseif ($_html['blog'] == 20) {
			$_html['blog_html'] = '<select name="blog"><option value="15">每页15人</option><option value="20" selected="selected">每页20人</option></select>';
		}
		
		//相册
		if ($_html['photo'] == 6) {
			$_html['photo_html'] = '<select name="photo"><option value="6" selected="selected">每页6张</option><option value="9">每页9张</option></select>';
		} elseif ($_html['photo'] == 9) {
			$_html['photo_html'] = '<select name="photo"><option value="6">每页6张</option><option value="9" selected="selected">每页9张</option></select>';
		}
		
		//皮肤
		if ($_html['skin'] == 1) {
			$_html['skin_html'] = '<select name="skin"><option value="1" selected="selected">一号皮肤</option><option value="2">二号皮肤</option><option value="3">三号皮肤</option></select>';
		} elseif ($_html['skin'] == 2) {
			$_html['skin_html'] = '<select name="skin"><option value="1">一号皮肤</option><option value="2" selected="selected">二号皮肤</option><option value="3">三号皮肤</option></select>';
		} elseif ($_html['skin'] == 3) {
			$_html['skin_html'] = '<select name="skin"><option value="1">一号皮肤</option><option value="2">二号皮肤</option><option value="3" selected="selected">三号皮肤</option></select>';
		}
		
		//发帖
		if ($_html['post'] == 30) {
			$_html['post_html'] = '<input type="radio" name="post" value="30" checked="checked" /> 30秒 <input type="radio" name="post" value="60" /> 1分钟 <input type="radio" name="post" value="180" /> 3分钟';
		} elseif ($_html['post'] == 60) {
			$_html['post_html'] = '<input type="radio" name="post" value="30" /> 30秒 <input type="radio" name="post" value="60" checked="checked" /> 1分钟 <input type="radio" name="post" value="180" /> 3分钟';
		} elseif ($_html['post'] == 180) {
			$_html['post_html'] = '<input type="radio" name="post" value="30" /> 30秒 <input type="radio" name="post" value="60" /> 1分钟 <input type="radio" name="post" value="180" checked="checked" /> 3分钟';
		}
		
		//回帖
		if ($_html['re'] == 15) {
			$_html['re_html'] = '<input type="radio" name="re" value="15" checked="checked" /> 15秒 <input type="radio" name="re" value="30" /> 30秒 <input type="radio" name="re" value="45" /> 45秒';
		} elseif ($_html['re'] == 30) {
			$_html['re_html'] = '<input type="radio" name="re" value="15" /> 15秒 <input type="radio" name="re" value="30" checked="checked" /> 30秒 <input type="radio" name="re" value="45" /> 45秒';
		} elseif ($_html['re'] == 45) {
			$_html['re_html'] = '<input type="radio" name="re" value="15" /> 15秒 <input type="radio" name="re" value="30" /> 30秒 <input type="radio" name="re" value="45" checked="checked" /> 45秒';
		}
		
		//验证码
		if ($_html['code'] == 1) {
			$_html['code_html'] =  '<input type="radio" name="code" value="1" checked="checked" /> 启用 <input type="radio" name="code" value="0" /> 禁用';
		} else {
			$_html['code_html'] =  '<input type="radio" name="code" value="1" /> 启用 <input type="radio" name="code" value="0" checked="checked"  /> 禁用';
		}
		
		//放开注册
		if ($_html['register'] == 1) {
			$_html['register_html'] =  '<input type="radio" name="register" value="1" checked="checked" /> 启用 <input type="radio" name="register" value="0" /> 禁用';
		} else {
			$_html['register_html'] =  '<input type="radio" name="register" value="1" /> 启用 <input type="radio" name="register" value="0" checked="checked" /> 禁用';
		}
	}else {
		alert('系统表出错，请联系管理员');
	}
	require  dirname(__FILE__).'/includes/header.inc.php';
?>
<div id="member">
	<div id="member_sidebar">
		<h2>管理导航</h2>
		<dl>
			<dt>系统管理</dt>
			<dd><a href="manager.php">后台首页</a></dd>
			<dd><a href="manager_set.php">系统设置</a></dd>
		</dl>
	<dl>
		<dt>会员管理</dt>
		<dd><a href="manager_vip_list.php">会员列表</a></dd>
		<dd><a href="manager_job.php">管理员列表</a></dd>
	</dl>
	</div>
<div id="member_main">
	<h2>系统设置</h2>
	<form  method ="post" action="?action=set">
		<dl>
			<dd>·网 站 名 称：<input type="text" name="webname" class="text" value="<?php echo $_html['webname']?>" /></dd>
    		<dd>·文章每页列表数：<?php echo $_html['article_html'];?></dd>
    		<dd>·博客每页列表数：<?php echo $_html['blog_html'];?></dd>
    		<dd>·相册每页列表数：<?php echo $_html['photo_html'];?></dd>
    		<dd>·站点 默认 皮肤：<?php echo $_html['skin_html'];?></dd>
    		<dd>·非法 字符 过滤：<input type="text" name="string" class="text" value="<?php echo $_html['string'];?>" /> (*请用|线隔开)</dd>
			<dd>·每次 发帖 限制：<?php echo $_html['post_html'];?></dd>
			<dd>·每次 回帖 限制：<?php echo $_html['re_html'];?></dd>
			<dd>·是否 启用 验证：<?php echo $_html['code_html'];?></dd>
			<dd>·是否 开放 注册：<?php echo $_html['register_html'];?></dd>
			<dd><input type="submit" value="修改系统设置" class="submit" /></dd>
		</dl>
	</form>
	</div>
</div>
<?php 
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>