<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/list.css" />
</head>
<body>
{include file="header.tpl"}
<div id="list">
	<h2>当前位置 &gt; 搜索{if $par_name}<a href="list.php?id={$par_id}">{$par_name}</a> &gt;{/if} <a href="list.php?id={$nav_id}" target="_blank">{$nav_name}</a></h2>
	{if $search}
	{foreach $search(key,value)}
	<dl>
		<dt><a href="detail.php?id={@value->cid} " target="_blank"><img src="{@value->thumbnail}" alt="" /></a></dt>
		<dd>[<strong>{@value->name}</strong>] <a href="detail.php?id={@value->cid} " target="_blank">{@value->title}</a></dd>
		<dd>日期：{@value->date} 点击率：{@value->read_count} 好评：0</dd>
		<dd>核心提示：{@value->info}</dd>
	</dl>
	{/foreach}
	{else}
	<span>没有任何内容</span>
	{/if}
	<div id="page">{$page}</div>
</div>
<div id="sidebar">
	<div class="nav">
		<h2>子栏目列表</h2>
		{if $child_nav}
		{foreach $child_nav(key,value)}
		<strong><a href="list.php?id={@value->id}">{@value->name}</a></strong>
		{/foreach}
		{else}
		<span>该导航下没有子导航</span>
		{/if}
		
	</div>

	<div class="right">
		<h2>本月本类推荐</h2>
		<ul>
		{if $Month_Rec}
		{foreach $Month_Rec(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
		{else}
		<li>暂时没有文档</li>
		{/if}
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
		{if $Month_Hot}
		{foreach $Month_Hot(key,value)}
			<li><em>{@value->date}</em><a href="detail.php?id={@value->id}" >{@value->title}</a></li>
		{/foreach}
		{else}
		<li>暂时没有文档</li>
		{/if}
		</ul>
	</div>

</div>
{include file="footer.tpl"}
</body>
</html>