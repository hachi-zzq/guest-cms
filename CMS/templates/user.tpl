<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/reg.css" />
<script type="text/javascript" src="../js/user.js" ></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 会员管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="user.php?action=show" class="selected">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	{if $update}
	<li><a href="user.php?action=update&id={$id}">修改会员</a></li>
	{/if}
</ol>
{if $show} 
<table cellspacing="0">
	<tr><th>id</th><th>用户名</th><th>电子邮箱</th><th>权限</th><th>操作</th></tr>
	{foreach $ALL_user(key,value)}
	<tr><td>{@value->id}</td><td>{@value->username}</td><td>{@value->email}</td><td>{@value->state}</td><td><a href="user.php?action=update&id={@value->id}">修改</a> | <a href="user.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个管理员？')?true:false">删除</a></td></tr>
	{/foreach}
</table>
<div id="page">{$page}</div>
<p class="add_manage">[ <a href="../register.php?action=reg" target="_parent" >新增会员</a> ]</p>
{/if}


{if $update}
<form method="post" action="?action=update" id="form">
<input type="hidden" name="id" value="{$id}" />
<dl class="update">
<dt></dt>
<dd>用 户 名：{$username}</dd>
<dd>密　　码：<input type="password"  class="text"name="password" /></dd>
<dd>选择头像：<select name="face" class="face">
									{$all_face}
							</select>
</dd>
<dd><img name="face_img" src="../{$face}" /></dd>
<dd>密保问题：<select name="question" class="text">
			{$all_question}
			</select>
</dd>
<dd>密保答案：<input type="text" class="text" name="answer" value="{$answer}" /></dd>
<dd>电子邮件：<input type="text" class="text" name="email" value="{$email}" /></dd>
<dd>权　　限：{$all_state}</dd>
<dd><input type="submit" class="submit" name="send" value="修改" /> [ <a href="{$prev_url}">返回列表</a> ]</dd>
</dl>
</form>
{/if}

</body>
</html>