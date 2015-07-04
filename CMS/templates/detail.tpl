<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/detail.css" />
<script type="text/javascript" src="js/detail.js"></script>
</head>
<body>
{include file="header.tpl"}
<div id="list">
	<h2>当前位置 &gt; {if $par_name}{$par_name} </a>&gt;{/if} {$nav_name}</h2>
<div id="detail">
	<h3>{$title_content}</h3>
	<div class="d1">时间：{$date} 来源：{$source} 作者：{$author} 点击量：{$count}</div>
	<div class="d2">{$info}</div>
	<div class="d3">{$content}</div>
	<div class="d5">
{foreach $New_Three(key,value)}
<dl>
	<dt><img src="{@value->face}"/></dt>
	<dd><span>[{@value->c_username}]</span><em>{@value->date} 发表</em></dd>
	<dd class="info">{@value->content}</dd>
	<dd class="bottom"><a href="feedback.php?cid={@value->cid}&action=sustain&id={@value->id}">[{@value->sustain}]支持</a> <a href="feedback.php?cid={$cid}&action=oppose&id={@value->id}">[{@value->oppose}]反对</a></dd>
</dl>
{/foreach}
	<p><h2><em>最新评论</em><a href="feedback.php?cid={$title_id}" target="_blank"><span>已有{$comment_num}人评论</span></a></h2></p>
	<form method="post" action="feedback.php?cid={$title_id}" target="_blank" id="comment">
		<p>你对本文的态度：<input type="radio" name="manner" value="1" checked="checked" /> 支持
									<input type="radio" name="manner" value="0" /> 中立
									<input type="radio" name="manner" value="-1" /> 反对
		</p>
		<p class="red">请互联网规则，不要发表关于政治、反动、色情之类的评论。</p>
		<p><textarea name="content" ></textarea></p>
		<p style="position:relative;top:-5px;">
			 验证码：<input type="text" class="text" name="code" />
			 <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /> 
			 <input type="submit" class="submit" name="send" value="提交评论" />
		</p>
	</form>
</div>
</div>

	<div id="page">{$page}</div>
</div>
<div id="sidebar">
	<div class="right">
		<h2>本类推荐</h2>
		<ul>
		{if $Month_Rec}
		{foreach $Month_Rec(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{else}
		<span>暂无符合要求的文档</span>
		{/if}
		</ul>
	</div>
	<div class="right">
		<h2>本类热点</h2>
		<ul>
		{if $Month_Hot}
		{foreach $Month_Hot(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{else}
		<span>暂无符合要求的文档</span>
		{/if}
		</ul>
	</div>
	<div class="right">
		<h2>本类图文</h2>
		<ul>
		{if $Month_pic}
		{foreach $Month_pic(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{else}
		<span>暂无符合要求的文档</span>
		{/if}
		</ul>
	</div>
</div>
{include file="footer.tpl"}
</body>
</html>