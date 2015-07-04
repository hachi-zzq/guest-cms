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
	管理首页 &gt;&gt; 会员管理 &gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
</div>
<ol>
	<li><a href="user.php?action=show" class="selected">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	<?php if ($this->vars['update']) {?>
	<li><a href="user.php?action=update&id=<?php echo $this->vars['id'];?>">修改会员</a></li>
	<?php } ?>
</ol>
<?php if ($this->vars['show']) {?> 
<table cellspacing="0">
	<tr><th>id</th><th>用户名</th><th>电子邮箱</th><th>权限</th><th>操作</th></tr>
	<?php foreach($this->vars['ALL_user'] as $key=>$value) { ?>
	<tr><td><?php echo $value->id; ?></td><td><?php echo $value->username; ?></td><td><?php echo $value->email; ?></td><td><?php echo $value->state; ?></td><td><a href="user.php?action=update&id=<?php echo $value->id; ?>">修改</a> | <a href="user.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('你真的要删除这个管理员？')?true:false">删除</a></td></tr>
	<?php } ?>
</table>
<div id="page"><?php echo $this->vars['page'];?></div>
<p class="add_manage">[ <a href="../register.php?action=reg" target="_parent" >新增会员</a> ]</p>
<?php } ?>


<?php if ($this->vars['update']) {?>
<form method="post" action="?action=update" id="form">
<input type="hidden" name="id" value="<?php echo $this->vars['id'];?>" />
<dl class="update">
<dt></dt>
<dd>用 户 名：<?php echo $this->vars['username'];?></dd>
<dd>密　　码：<input type="password"  class="text"name="password" /></dd>
<dd>选择头像：<select name="face" class="face">
									<?php echo $this->vars['all_face'];?>
							</select>
</dd>
<dd><img name="face_img" src="../<?php echo $this->vars['face'];?>" /></dd>
<dd>密保问题：<select name="question" class="text">
			<?php echo $this->vars['all_question'];?>
			</select>
</dd>
<dd>密保答案：<input type="text" class="text" name="answer" value="<?php echo $this->vars['answer'];?>" /></dd>
<dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $this->vars['email'];?>" /></dd>
<dd>权　　限：<?php echo $this->vars['all_state'];?></dd>
<dd><input type="submit" class="submit" name="send" value="修改" /> [ <a href="<?php echo $this->vars['prev_url'];?>">返回列表</a> ]</dd>
</dl>
</form>
<?php } ?>

</body>
</html>