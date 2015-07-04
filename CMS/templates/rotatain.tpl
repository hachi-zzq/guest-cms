<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_content.js" ></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">

<div class="map">
	内容管理 &gt;&gt;  <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="rotatain.php?action=show" class="selected">轮播器列表</a></li>
	<li><a href="rotatain.php?action=add">新增轮播器</a></li>
	{if $update}
	<li><a href="rotatain.php?action=update&id={$id}">修改轮播器</a></li>
	{/if}
</ol>

{if $show} 
{if $all_rotatain}
<table cellspacing="0" class="left">
	<tr><th>id</th><th>标题</th><th>图片</th><th>链接</th><th>信息</th><th>状态</th><th>操作</th></tr>
	{foreach $all_rotatain(key,value)}
	<tr><td>{@value->id}</td><td>{@value->title}</td><td>{@value->pic}　[<a href="http://<?php echo $_SERVER["HTTP_HOST"];?>{@value->pic}" target="_blank">显示图片</a>]</td><td>{@value->link}</td><td>{@value->info}</td><td>{@value->state}</td><td><a href="rotatain.php?action=del&id={@value->id}">[删除]</a></td></tr>
	{/foreach}
</table>
{else}
<p>暂无轮播器</p>
{/if}
{/if}

{if $add}
<form action="rotatain.php?action=add&add_rotatain=ok" method="post" name="content">
<table cellspacing="0" class="left">
	<tr><th>新增轮播器</th></tr>
	<tr><td><label>标　　题：<input type="text" name="title" class="text" /></label></td></tr>
	<tr><td><label class="link">图片地址：<input type="text" name="thumbnail" class="text" readonly="readonly"/><input type="button" class="uploads" value="上传"  onclick="javascript:Open_Window('../templates/upfile.php?type=rotatain','rotatain','150','400');"/><img name="pic" style="display: none;" /></label></td></tr>
	<tr><td><label>链接地址：<input type="text" name="link" class="text" /></label></td></tr>
	<tr><td>轮播器信息：<textarea name="info"></textarea></td></tr>
	<tr><td><input type="submit" name="send" value="新增轮播器" class="submit" /></td></tr>
</table>
</form>

{/if}

{if $update} 

{/if}
</body>
</html>