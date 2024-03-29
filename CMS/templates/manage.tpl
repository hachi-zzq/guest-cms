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
	管理首页 &gt;&gt; 管理员管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>
<ol>
	<li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
	<li><a href="manage.php?action=add">新增管理员</a></li>
	{if $update}
	<li><a href="manage.php?action=update">修改管理员</a></li>
	{/if}
</ol> 
{if $show} 
<table cellspacing="0">
	<tr><th>id</th><th>用户名</th><th>等级</th><th>登入次数</th><th>上次登入ip</th><th>最后登入时间</th><th>操作</th></tr>
	{foreach $ALLManage(key,value)}
	<tr><td>{@value->id}</td><td>{@value->username}</td><td>{@value->level_position}</td><td>{@value->login_count}</td><td>{@value->last_ip}</td><td>{@value->last_time}</td><td><a href="manage.php?action=update&id={@value->id}">修改</a> | <a href="manage.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个管理员？')?true:false">删除</a></td></tr>
	{/foreach}
</table>
<p class="add_manage">[ <a href="manage.php?action=add" >新增管理员</a> ]</p>
<div id="page">{$page}</div>
{/if}

{if $add}
<form method="post" id="add_fm">
	<table cellspacing="0" class="left">
		<tr><td>用 户 名：<input type="text" name="admin_user"class="text" /></td></tr>
		<tr><td>密　　码：<input type="password" name="admin_pass" class="text" /></td></tr>
		<tr><td>密码确认：<input type="password" name="admin_repass" class="text" /></td></tr>
		<tr><td>等　　级：<select name="level">
		{foreach $All_level(key,value)}
		<option value="{@value->id}">{@value->level_position}</option>
		{/foreach}
								 		</select>
		</td></tr>
		<tr><td><input type="submit" name="send" value="新增管理员" class="submit" /> [ <a href="manage.php?action=show">返回列表</a> ]</td></tr>
	</table>
</form>
{/if}

{if $update}
<form method="post" id="update_fm">
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="level" id="level" value="{$level}" />
<input type="hidden" name="prev_url" value="{$prev_url}">
	<table cellspacing="0" class="left">
		<tr><td>用户名：<input type="text" name="admin_user" readonly="readonly" value="{$username}" class="text" /></td></tr>
		<tr><td>密　码：<input type="password" name="admin_pass" class="text" /></td></tr>
		<tr><td>等　级：<select name="level">
				{foreach $All_level(key,value)}
		<option value="{@value->id}">{@value->level_position}</option>
				{/foreach}			
										 </select>
		</td></tr>
		<tr><td><input type="submit" name="send" value="修改管理员" class="submit" /> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
	</table>
</form>
{/if}

</body>
</html>