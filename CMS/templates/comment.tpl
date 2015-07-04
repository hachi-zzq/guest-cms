<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/manage.js" ></script>
</head>
<body id="main">

<div class="map">
	后台首页 &gt;&gt; 评论管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="comment.php?action=show" class="selected">评论列表</a></li>
</ol>
{if $show} 
<form action="comment.php?action=more_agree" method="post" id="more_agree">
<table cellspacing="0">
	<tr><th>id</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
	{foreach $all_comment_list(key,value)}
	<tr><td>{@value->id}</td><td title="{@value->content_full}">{@value->content}</td><td>{@value->username}</td><td><a href="../detail.php?id={@value->cid}" target="_blank">查看</a></td><td>{@value->state}</td><td><input type="text" class="sort" name="state[{@value->id}] id=" id="state" value="{@value->state_num}"/></td><td><a href="comment.php?action=del&id={@value->id}">删除</a></td></tr>
	{/foreach}
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" value="批量审批"></td><td></td><tr>
</table>
</form>
<div id="page">{$page}</div>
{/if}

</body>
</html>