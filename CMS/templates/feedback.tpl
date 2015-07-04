<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/feedback.css" />
</head>
<body>
{include file="header.tpl"}
<div id="feedback">
<h2>评论列表</h2>
{if $feed_object}
	<h3>{$feed_title}</h3>
	<p>{$feed_info}</p>
{/if}
{if $all_comment}
{foreach $all_comment(key,value)}
<dl>
	<dt><img src="{@value->face}"/></dt>
	<dd><em>{@value->date} 发表</em><span>[{@value->c_username}]</span></dd>
	<dd class="info">{@value->content}</dd>
	<dd class="bottom"><a href="?cid={$cid}&action=sustain&id={@value->id}">[{@value->sustain}]支持</a> <a href="?cid={$cid}&action=oppose&id={@value->id}">[{@value->oppose}]反对</a></dd>
</dl>
{/foreach}
{else}
<span style="margin:20px auto auto 300px;">暂无相关评论</span>
{/if}
<div id="page">{$page}</div>
</div>

<div id="sidebar">
<h2>热点文章</h2>
		<ul>
		{foreach $hot_content(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank"> {@value->title}</a></li>
		{/foreach}
		</ul>
</div>
	<div class="d5">
	<p><h2><em>最新评论</em><a href="feedback.php?cid={$cid}"></a></h2></p>
	<form method="post" action="feedback.php?cid={$cid}"  id="comment">
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
{include file="footer.tpl"}
</body>
</html>