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
	管理首页 &gt;&gt; 等级管理 &gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
</div>
<ol>
	<li><a href="level.php?action=show" class="selected">等级列表</a></li>
	<li><a href="level.php?action=add">新增等级</a></li>
	<?php if ($this->vars['update']) {?>
	<li><a href="level.php?action=update">修改等级</a></li>
	<?php } ?>
</ol>
<?php if ($this->vars['show']) {?> 
<table cellspacing="0">
	<tr><th>id</th><th>等级名称</th><th>等级描述</th><th>操作</th></tr>
	<?php foreach($this->vars['ALL_Level'] as $key=>$value) { ?>
	<tr><td><?php echo $value->id; ?></td><td><?php echo $value->level_position; ?></td><td><?php echo $value->level_info; ?></td><td><a href="level.php?action=update&id=<?php echo $value->id; ?>">修改</a> | <a href="level.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('你真的要删除这个管理员？')?true:false">删除</a></td></tr>
	<?php } ?>
</table>
<p class="add_manage">[ <a href="level.php?action=add" >新增等级</a> ]</p>
<?php } ?>

<?php if ($this->vars['add']) {?>
<form method="post">
	<table cellspacing="0" class="left">
		<tr><td>等级名称：<input type="text" name="level_position" class="text" /></td></tr>
		<tr><td>等级描述：<textarea name="level_info"></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="新增等级" class="submit" /> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
	</table>
</form>
<?php } ?>

<?php if ($this->vars['update']) {?>
<form method="post">
	<table cellspacing="0" class="left">
		<tr><td>等级名称：<input type="text" name="level_position" class="text" value="<?php echo $this->vars['level_position'];?>" /></td></tr>
		<tr><td>等级描述：<textarea name="level_info"><?php echo $this->vars['level_info'];?></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="修改等级" class="submit" /> [ <a href="level.php?action=show">返回列表</a> ]</td></tr>
	</table>
</form>
<?php } ?>

</body>
</html>