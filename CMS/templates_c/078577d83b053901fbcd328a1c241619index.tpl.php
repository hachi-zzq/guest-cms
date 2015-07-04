<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/index.css" />
<script type="text/javascript" src="js/reg.js"></script>
</head>
<body>
<?php $tpl->create('header.tpl')?>
<div id="user">
<?php if ($this->vars['login']) {?>
	<h2>会员信息</h2>
	<form method="post" action="register.php?action=login" id="form">
		<label>用户名：<input type="text" name="username" class="text" /></label>
		<label>密　码：<input type="password" name="password" class="text" /></label>
		<label>验证码：<input type="text" name="code" class="text code" /></label>
		<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" />
		<p><input type="submit" name="send" value="登入" class="submit" /> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></p>
	</form>
	<?php } else { ?>
			<h2>会员信息</h2>
		<div class="a">您好，<strong><?php echo $this->vars['user'];?></strong> 欢迎光临</div>
		<div class="b">
			<img src="<?php echo $this->vars['face'];?>" />
			<a href="###">个人中心</a>
			<a href="###">我的评论</a>
			<a href="register.php?action=logout">退出登录</a>
		</div>
	<?php } ?>
	<h3>最近登录会员 <span>────────────</span></h3>
	<?php foreach($this->vars['Last_User'] as $key=>$value) { ?>
	<dl>
		<dt><img src="<?php echo $value->face; ?>" alt="头像" /></dt>
		<dd><?php echo $value->username; ?></dd>
	</dl>
	<?php } ?>
</div>
<div id="news">
	<h3><a href="detail.php?id=<?php echo $this->vars['index_top_id'];?>" target="_blank"><?php echo $this->vars['index_top_title'];?></a></h3>
	<p><?php echo $this->vars['index_top_info'];?><a href="detail.php?id=<?php echo $this->vars['index_top_id'];?>" target="_blank">[查看全文]</a></p>
	<p class="link">
		<?php foreach($this->vars['index_top_onefive'] as $key=>$value) { ?>
		<a href="detail.php?id=<?php echo $this->vars['index_top_id'];?>" target="_blank"><?php echo $value->title; ?></a> | 
		<?php } ?>
	</p>
	<ul>
	<?php foreach($this->vars['index_top_ten'] as $key=>$value) { ?>
		<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
	<?php } ?>
	</ul>
</div>
<div id="pic">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="scriptmain" name="scriptmain" codebase="http://download.macromedia.com/pub/shockwave/cabs/
	flash/swflash.cab#version=6,0,29,0" width="268" height="193">
	      <param name="movie" value="images/lbxml.swf">
	      <param name="quality" value="high">
	      <param name="scale" value="noscale">
	      <param name="LOOP" value="false">
	      <param name="menu" value="false">
	      <param name="wmode" value="transparent">
	      <embed src="images/lbxml.swf" width="268" height="193" loop="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" salign="T" name="scriptmain" menu="false" wmode="transparent">
	</object>
</div>
<div id="rec">
	<h2>特别推荐</h2>
	<ul>
	<?php foreach($this->vars['index_rec'] as $key=>$value) { ?>
		<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
	<?php } ?>
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><img src="images/adver2.png" alt="广告图" /></div>
	<div class="hot">
		<h2>本月热点</h2>
		<ul>
	<?php if ($this->vars['index_hot']) {?>
	<?php foreach($this->vars['index_hot'] as $key=>$value) { ?>
		<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
	<?php } ?>
	<?php } else { ?>
		<span>本目录没有符合的文档</span>
	<?php } ?>
		</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
		<ul>
		<?php if ($this->vars['index_comment']) {?>
	<?php foreach($this->vars['index_comment'] as $key=>$value) { ?>
		<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
	<?php } ?>
	<?php } else { ?>
		<span>本目录没有符合的文档</span>
	<?php } ?>
		</ul>
	</div>
	<div class="vote">
		<h2>调查投票</h2>
		<h3>请问您是怎么知道本站的：</h3>
		<form>
			<label><input type="radio" name="vote" checked="checked" /> 门户网站的搜索引擎</label>
			<label><input type="radio" name="vote" /> Google或百度搜索</label>
			<label><input type="radio" name="vote" /> 别的网站上的链接</label>
			<label><input type="radio" name="vote" /> 朋友介绍或者电视广告</label>
			<p><input type="submit" value="投票" name="send" /> <input type="button" value="查看" /></p>
		</form>
	</div>
</div>
<div id="picnews">
	<h2>图文资讯</h2>
	<?php foreach($this->vars['index_pic_doc'] as $key=>$value) { ?>
	<dl>
		<dt><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank""><img src="<?php echo $value->thumbnail; ?>" alt="标题" /></a></dt>
		<dd><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank""><?php echo $value->title; ?></a></dd>
	</dl>
	<?php } ?>
</div>
<div id="newslist">
<?php foreach($this->vars['index_four'] as $key=>$value) { ?>
	<div class="<?php echo $value->class; ?>">
		<h2><a href="list.php?id=<?php echo $value->id; ?>" target="_blank">更多</a><?php echo $value->name; ?></h2>
		<ul>

		<?php foreach($value->list as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
		<?php } ?>
		</ul>
	</div>
<?php } ?>
</div>
<?php $tpl->create('footer.tpl')?>
</body>
</html>