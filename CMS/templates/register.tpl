<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/reg.css" />
<script type="text/javascript" src="js/reg.js"></script>
</head>
<body>
{include file="header.tpl"}
{if $reg}
<div id="reg">
<h2>会员注册</h2>
<form method="post" action="?action=reg" id="form">
<dl>
<dt></dt>
<dd>用 户 名：<input type="text" class="text"name="username" /></dd>
<dd>密　　码：<input type="password"  class="text"name="password" /></dd>
<dd>密码确认：<input type="password" class="text" name="re_password" /></dd>
<dd>选择头像：<select name="face" class="face">
									{foreach $all_face(key,value)}
									<option value="face/{@value}.gif" class="text">face/{@value}.gif</option>
									{/foreach}
							</select>
</dd>
<dd><img name="face_img" src="face/1.gif" /></dd>
<dd>密保问题：<select name="question" class="text">
			<option ></option>
			<option >您父亲的名字？</option>
			<option >您母亲的名字？</option>
			</select>
</dd>
<dd>密保答案：<input type="text" class="text" name="answer" /></dd>
<dd>电子邮件：<input type="text" class="text" name="email" /></dd>
<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" /></dd>
<dd>验 证 码：<input type="text" class="text" name="code" /></dd>
<dd><input type="submit" class="submit" name="send" value="注册会员" /></dd>
</dl>
</form>
</div>
{/if}

{if $login}
<div id="login">
<h2>会员登入</h2>
<form method="post" action="?action=login" id="form">
<dl>
<dt></dt>
<dd>用 户 名：<input type="text" class="text"name="username" /></dd>
<dd>密　　码：<input type="password"  class="text"name="password" /></dd>
<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" /></dd>
<dd>验 证 码：<input type="text" class="text" name="code" /></dd>
<dd><input type="submit" class="submit" name="send" value="登入" /></dd>
</dl>
</form>
</div>
{/if}
{include file="footer.tpl"}
</body>
</html>