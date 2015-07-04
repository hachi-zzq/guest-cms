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
{include file="header.tpl"}
<div id="user">
{if $login}
	<h2>会员信息</h2>
	<form method="post" action="register.php?action=login" id="form">
		<label>用户名：<input type="text" name="username" class="text" /></label>
		<label>密　码：<input type="password" name="password" class="text" /></label>
		<label>验证码：<input type="text" name="code" class="text code" /></label>
		<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" />
		<p><input type="submit" name="send" value="登入" class="submit" /> <a href="register.php?action=reg">注册会员</a> <a href="###">忘记密码?</a></p>
	</form>
	{else}
			<h2>会员信息</h2>
		<div class="a">您好，<strong>{$user}</strong> 欢迎光临</div>
		<div class="b">
			<img src="{$face}" />
			<a href="###">个人中心</a>
			<a href="###">我的评论</a>
			<a href="register.php?action=logout">退出登录</a>
		</div>
	{/if}
	<h3>最近登录会员 <span>────────────</span></h3>
	{foreach $Last_User(key,value)}
	<dl>
		<dt><img src="{@value->face}" alt="头像" /></dt>
		<dd>{@value->username}</dd>
	</dl>
	{/foreach}
</div>
<div id="news">
	<h3><a href="detail.php?id={$index_top_id}" target="_blank">{$index_top_title}</a></h3>
	<p>{$index_top_info}<a href="detail.php?id={$index_top_id}" target="_blank">[查看全文]</a></p>
	<p class="link">
		{foreach $index_top_onefive(key,value)}
		<a href="detail.php?id={$index_top_id}" target="_blank">{@value->title}</a> | 
		{/foreach}
	</p>
	<ul>
	{foreach $index_top_ten(key,value)}
		<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
	{/foreach}
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
	{foreach $index_rec(key,value)}
		<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
	{/foreach}
	</ul>
</div>
<div id="sidebar-right">
	<div class="adver"><img src="images/adver2.png" alt="广告图" /></div>
	<div class="hot">
		<h2>本月热点</h2>
		<ul>
	{if $index_hot}
	{foreach $index_hot(key,value)}
		<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
	{/foreach}
	{else}
		<span>本目录没有符合的文档</span>
	{/if}
		</ul>
	</div>
	<div class="comm">
		<h2>本月评论</h2>
		<ul>
		{if $index_comment}
	{foreach $index_comment(key,value)}
		<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
	{/foreach}
	{else}
		<span>本目录没有符合的文档</span>
	{/if}
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
	{foreach $index_pic_doc(key,value)}
	<dl>
		<dt><a href="detail.php?id={@value->id}" target="_blank""><img src="{@value->thumbnail}" alt="标题" /></a></dt>
		<dd><a href="detail.php?id={@value->id}" target="_blank"">{@value->title}</a></dd>
	</dl>
	{/foreach}
</div>
<div id="newslist">
{foreach $index_four(key,value)}
	<div class="{@value->class}">
		<h2><a href="list.php?id={@value->id}" target="_blank">更多</a>{@value->name}</h2>
		<ul>

		{for @value->list(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/for}
		</ul>
	</div>
{/foreach}
</div>
{include file="footer.tpl"}
</body>
</html>