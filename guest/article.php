<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-6-14
*/
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/basic.css" />
<link rel="stylesheet" type="text/css" href="style/1/article.css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/article.js"></script>
</head>
<body>
<?php 
	ob_start();
	define('IN_TG',true);
	global $global_clean;//$global_clean是全局变量，comm.in.php中，用于system设置
	require dirname(__FILE__).'/includes/conn.inc.php';
	require  dirname(__FILE__).'/includes/global.fun.php';
	require dirname(__FILE__).'/includes/common.inc.php';
	//开始接收回帖数据
	if ($_GET['action'] == 'rearticle'){
			//验证验证码是否输入正确
		if (!empty($global_clean['code'] )) {
			if (!($_POST['code'] == $_SESSION['code'])){
				alert('验证码错误，请重新输入');
			}
		}
		$clean =array();
		$clean['re_id'] = mysql_escape($_POST['re_id']);
		$clean['type'] = mysql_escape($_POST['type']);
		$clean['title'] = mysql_escape($_POST['title']);
		$clean['content'] = mysql_escape($_POST['content']);
		
		mysql_query("insert into article (
																		re_id,
																		username,
																		type,
																		title,
																		content,
																		date
																		)
													 values (
													 					'{$clean['re_id']}',
													 					'{$_COOKIE['username']}',
													 					'{$clean['type']}',
													 					'{$clean['title']}',
													 					'{$clean['content']}',
													 					now()
													 					)")or die(mysql_error());
		if (mysql_affected_rows() == 1){
			mysql_query("update article set comment_count =comment_count + 1 where id='{$clean['re_id']}'");//将评论量加1
			location('恭喜你，回帖成功',"article.php?id={$clean['re_id']}");
		}else {
			alert('很遗憾，回帖失败');
		}
		
	}
	//开始接收主题帖数据
	if (isset($_GET['id'])){
		//首先判断有没有这个帖子，顺便取出这个帖子的信息
		$row = mysql_fetch_array(mysql_query("select 
																								id,
																								username,
																								title,
																								type,
																								content,
																								read_count,
																								comment_count,
																								 date
																						from 
																								article 
																						where id='{$_GET['id']}'
																						and re_id =0
																						"));

		if ($row){//如果这帖子存在，那么从数据库里面取出 发帖人信息
			$menber = mysql_fetch_array(mysql_query("select 
																									id,
																									username,
																									sex,
																									face,
																									url,
																									email
																							from 
																									user 
																							where username='{$row['username']}'
																							"));
			//把阅读量增一
			mysql_query("update article set read_count =read_count + 1 where id='{$_GET['id']}'");
			$clean  = array();
			$clean['article_id'] = mysql_escape($row['id']);
			$clean['uername'] = mysql_escape($row['username']);
			$clean['title'] = mysql_escape($row['title']);
			$clean['type'] = mysql_escape($row['type']);
			$clean['content'] = ubb(mysql_escape($row['content']));
			$clean['read_count'] = mysql_escape($row['read_count']);
			$clean['comment_count'] = mysql_escape($row['comment_count']);
			$clean['date'] = mysql_escape($row['date']);
			$clean['member_id'] = mysql_escape($menber['id']);
			$clean['sex'] = mysql_escape($menber['sex']);
			$clean['face'] = mysql_escape($menber['face']);
			$clean['url'] = mysql_escape($menber['url']);
			$clean['email'] = mysql_escape($menber['email']);
		}else {
			alert('此短信不存在');
		}
		
	}else {
		alert('非法操作');
		exit();
	}
	//引入header.php头文件
	require  dirname(__FILE__).'/includes/header.inc.php';
	
?>
<div id="article">
	<h2>帖子详情</h2>
	<div id="subject">
	
		<dl>
			<dd class="title"><?php echo $clean['uername'];?>(<?php echo$clean['sex'];?>)</dd>
			<dt><img src="<?php echo $clean['face'];?>" /></dt>
			<dd class="connect"><a href="javascript:;" name="message" title="<?php echo $clean['member_id'];?>">联系ta</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $clean['member_id'];?>">加为好友</a></dd>
			<dd class="guest">留 言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $clean['member_id'];?>">送 花</a></dd>
			<dd class="email">邮件：<?php echo $clean['email'];?></dd>
			<dd class="url">主页：<?php echo $clean['url'];?></dd>
		</dl>

		<div class="content">
			
			<div class="user">
			<span>1#</span><?php echo $clean['uername'];?> | 发表于：<?php echo $clean['date'];?>
			</div>
			
			<h3>主题：<?php echo $clean['title'];?> <img src="images/icon<?php echo $clean['type'];?>.gif" title="icon" /></h3>
			
			<div class="detail">
			<?php echo $clean['content'];?>
			</div>
			<span class="comment">评论（<?php echo $clean['comment_count'];?>）</span><span class="read">阅读（<?php echo $clean['read_count'];?>）</span>
		</div>

	</div>
	<div id="line">
	</div>
	
	
<?php 
	//分页模板
	$page = $_GET['page'];
	if (!isset($page)){
		$page = 1;
	}
	$pagesize = 5;//定义每页显示的数据条数
	$pagestart = ($page - 1) * $pagesize;
	$num = mysql_num_rows(mysql_query("select * from article where re_id ={$_GET['id']}"));//计算结果集中数据的条数
	$ceil = ceil($num/$pagesize);//计算出总页数
	//开始循环出回帖
	$re_result = mysql_query("select id,re_id,title,username,content,type,date from article where re_id ={$_GET['id']} order by date ASC limit $pagestart,5" ) or die(mysql_error());
	$re = array();
	$i = 2;
	while (!!$re_row = mysql_fetch_array($re_result)){
	$re_member = mysql_fetch_array(mysql_query("select 
																					id,
																					username,
																					sex,
																					face,
																					url,
																					email
																		from 
																					user 
																		where username='{$re_row['username']}'")) or die(mysql_error());

	$re['username'] = $re_member['username'];
	$re['sex'] = $re_member['sex'];
	$re['face'] = $re_member['face'];
	$re['url'] = $re_member['url'];
	$re['email'] = $re_member['email'];
	$re['id'] = $re_member['id'];
	$re['url'] = $re_member['url'];
	$re['date'] = $re_row['date'];
	$re['title'] = $re_row['title'];
	$re['content'] = $re_row['content'];
?>
<div class="re">
	
		<dl>
			<dd class="title"><?php echo $re['username'];?>(<?php echo $re['sex'] ;?>)</dd>
			<dt><img src="<?php echo $re['face'];?>" /></dt>
			<dd class="connect"><a href="javascript:;" name="message" title="<?php echo $re['id'];?>">联系ta</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $re['id'];?>">加为好友</a></dd>
			<dd class="guest">留 言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $re['id'];?>">送 花</a></dd>
			<dd class="email">邮件：<?php echo $re['email'];?></dd>
			<dd class="url">主页：<?php echo $re['url'];?></dd>
		</dl>

		<div class="content">
			
			<div class="user">
			<span><?php echo $i+(($page-1)*$pagesize);?>#</span><?php echo $re['username'];?> | 发表于：<?php echo $re['date'];?>
			</div>
			
			<h3>主题：<?php echo $re['title'];?> <img src="images/icon<?php echo $clean['type'];?>.gif" title="icon" />
			<?php if (isset($_COOKIE['username'])){?>
			<span>[<a href="#ree" name="reply_re" title="回复<?php echo $i+(($page-1)*$pagesize);?>楼的<?php echo $re['username'];?>">回复</a>]</span></h3>
			<?php }?>
			<div class="detail">
				<?php echo ubb($re['content']);?>
			</div>
		
		</div>
	</div>
	<div id="line">
	</div>
<?php 
	$i++;
	}
?>
	<div id="page_text">
		<ul>
			<li><?php echo $page;?>/<?php echo $ceil;?>页 |</li>
			<li>共有<?php echo $num;?>个评论 |</li>
			<?php 
			//此分页注意，不止有page，还有id，id为主题帖的id
			if ($page == 1){
				if ($ceil == 1){
					echo '<li><a href="article.php?id='.$clean['article_id'].'&page=1">首页 |</a></li>';
				}else{
				echo '<li><a href="article.php?id='.$clean['article_id'].'&page='.($page+1).'">下一页 |</a></li>';
				echo '<li><a href="article.php?id='.$clean['article_id'].'&page='.$ceil.'""> 尾页 |</a></li>';
				}
			}else {
					if ($page == $ceil){
						echo '<li><a href="article.php?id='.$clean['article_id'].'&page=1">首页 |</a></li>';
						echo '<li><a href="article.php?id='.$clean['article_id'].'&page='.($page-1).'">上一页 |</a></li>';
				}else {
						echo '<li><a href="article.php?id='.$clean['article_id'].'&page=1">首页 |</a></li>';
						echo '<li><a href="article.php?id='.$clean['article_id'].'&page='.($page-1).'">上一页 |</a></li>';
						echo '<li><a href="article.php?id='.$clean['article_id'].'&page='.($page+1).'">下一页 |</a></li>';
						echo  '<li><a href="article.php?id='.$clean['article_id'].'&page='.$ceil.'""> 尾页 |</a></li>';
				}
				
			}
			
			?>
		</ul>
	</div>

<!--	用于判断是否已经登入，如果没有登入，只能看到帖子界面，看不到回复的界面-->
	<?php if (isset($_COOKIE['username'])){?>
<!--	此处为一个锚点，用于跟帖回复-->
	<a name="ree"></a>
	<div id="rearticle">
	<form method="post" action="article.php?action=rearticle">
	<input type="hidden" name="type" value="<?php echo $clean['type'];?>" />
	<input type="hidden" name="re_id" value="<?php echo $clean['article_id'];?>" />
	<dl>
		<dd>标　　题：　<input  type="text" class="text" name="title" value="RE:<?php echo $clean['title'];?>"/></dd>
		<dd id="qimg">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
		<dd>
		<?php require  dirname(__FILE__).'/includes/ubb.inc.php';?>
		<textarea name="content" title="帖子内容"  ></textarea></dd>
		<?php if (!empty($global_clean['code'] )) {?>
		<dd>验 证 码：<input type="text" name="code" class="yzm"  /><img src="code.php" id="code" />
		<?php }?>
		<input type="submit" class="submit" value="回帖" /></dd>
	</dl>
	</form>
	</div>
	<?php }?>
</div>

<?php
	require dirname(__FILE__).'/includes/footer.inc.php';
?>
</body>
</html>
