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
	内容首页 &gt;&gt; 添加网站导航 &gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
</div>
<ol>
	<li><a href="nav.php?action=show" class="selected">导航列表</a></li>
	<li><a href="nav.php?action=add">新增导航</a></li>
	<?php if ($this->vars['update']) {?>
	<li><a href="nav.php?action=update">修改导航</a></li>
	<?php } ?>
	<?php if ($this->vars['updatechild']) {?>
	<li><a href="nav.php?action=update">修改子导航</a></li>
	<?php } ?>
</ol>
<?php if ($this->vars['show']) {?> 
<table cellspacing="0">
	<form method="post" action="?action=sort">
	<tr><th>id</th><th>导航名</th><th>导航信息</th><th>查看|添加子导航</th><th>操作</th><th>排序</th></tr>
	<?php foreach($this->vars['ALLNav'] as $key=>$value) { ?>
	<tr><td><?php echo $value->id; ?></td><td><?php echo $value->name; ?></td><td><?php echo $value->info; ?></td><td><a href="nav.php?action=showchild&id=<?php echo $value->id; ?>&par_name=<?php echo $value->name; ?>">查看</a>|<a href="nav.php?action=addchild&id=<?php echo $value->id; ?>&par_name=<?php echo $value->name; ?>">添加自导航</a></td><td><a href="nav.php?action=update&id=<?php echo $value->id; ?>">修改</a> | <a href="nav.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('你真的要删除？')?true:false">删除</a></td><td><input type="text"  class="sort" name="sort[<?php echo $value->id; ?>]" value="<?php echo $value->sort; ?>" /></td></tr>
	<?php } ?>
	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="排序" /></td></tr>
	</form>
	</table>
<p class="add_manage">[ <a href="nav.php?action=add" >新增导航</a> ]</p>
<div id="page"><?php echo $this->vars['page'];?></div>
<?php } ?>

<?php if ($this->vars['addchild']) {?>
<form method="post">
<input type="hidden" name="parid" value="<?php echo $this->vars['parid'];?>">
	<table cellspacing="0" class="left">
		<tr><td>父导航名称：<strong><?php echo $this->vars['par_name'];?></strong></td></tr>
		<tr><td>子导航名称：<input type="text" name="nav_name" class="text" /></td></tr>
		<tr><td>导航描述：<textarea name="nav_info"></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="新增子导航" class="submit" /> [ <a href="<?php echo $this->vars['PREV_URL'];?>">返回列表</a> ]</td></tr>
	</table>
</form>
<?php } ?>

<?php if ($this->vars['showchild']) {?> 
<table cellspacing="0">
	<tr><th>父导航名</th><th>子导航名</th><th>子导航信息</th><th>操作</th></tr>
	<?php foreach($this->vars['all_childNav'] as $key=>$value) { ?>
	<tr><td><?php echo $this->vars['par_name'];?></td><td><?php echo $value->name; ?></td><td><?php echo $value->info; ?></td><td><a href="nav.php?action=update&id=<?php echo $value->id; ?>">修改</a> | <a href="nav.php?action=delete&id=<?php echo $value->id; ?>" onclick="return confirm('你真的要删除？')?true:false">删除</a></td></tr>
	<?php } ?>
</table>
<p class="add_manage">[ <a href="nav.php?action=add" >新增导航</a> ][ <a href="nav.php?action=show">返回列表</a> ]</p>
<div id="page"><?php echo $this->vars['page'];?></div>
<?php } ?>

<?php if ($this->vars['add']) {?>
<form method="post">
	<table cellspacing="0" class="left">
		<tr><td>导航名称：<input type="text" name="nav_name" class="text" /></td></tr>
		<tr><td>导航描述：<textarea name="nav_info"></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="新增导航" class="submit" /> [ <a href="<?php echo $this->vars['PREV_URL'];?>">返回列表</a> ]</td></tr>
	</table>
</form>
<?php } ?>

<?php if ($this->vars['update']) {?>
<form method="post">
	<table cellspacing="0" class="left">
		<tr><td>导航名称：<input type="text" name="nav_name" class="text" value="<?php echo $this->vars['nav_name'];?>" /></td></tr>
		<tr><td>导航描述：<textarea name="nav_info"><?php echo $this->vars['nav_info'];?></textarea></td></tr>
		<tr><td><input type="submit" name="send" value="修改导航" class="submit" /> [ <a href="<?php echo $this->vars['PREV_URL'];?>">返回列表</a> ]</td></tr>
	</table>
</form>
<?php } ?>

</body>
</html>