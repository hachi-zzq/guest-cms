<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/list.css" />
</head>
<body>
<?php $tpl->create('header.tpl')?>
<div id="list">
	<h2>当前位置 &gt; 搜索<?php if ($this->vars['par_name']) {?><a href="list.php?id=<?php echo $this->vars['par_id'];?>"><?php echo $this->vars['par_name'];?></a> &gt;<?php } ?> <a href="list.php?id=<?php echo $this->vars['nav_id'];?>" target="_blank"><?php echo $this->vars['nav_name'];?></a></h2>
	<?php if ($this->vars['search']) {?>
	<?php foreach($this->vars['search'] as $key=>$value) { ?>
	<dl>
		<dt><a href="detail.php?id=<?php echo $value->cid; ?> " target="_blank"><img src="<?php echo $value->thumbnail; ?>" alt="" /></a></dt>
		<dd>[<strong><?php echo $value->name; ?></strong>] <a href="detail.php?id=<?php echo $value->cid; ?> " target="_blank"><?php echo $value->title; ?></a></dd>
		<dd>日期：<?php echo $value->date; ?> 点击率：<?php echo $value->read_count; ?> 好评：0</dd>
		<dd>核心提示：<?php echo $value->info; ?></dd>
	</dl>
	<?php } ?>
	<?php } else { ?>
	<span>没有任何内容</span>
	<?php } ?>
	<div id="page"><?php echo $this->vars['page'];?></div>
</div>
<div id="sidebar">
	<div class="nav">
		<h2>子栏目列表</h2>
		<?php if ($this->vars['child_nav']) {?>
		<?php foreach($this->vars['child_nav'] as $key=>$value) { ?>
		<strong><a href="list.php?id=<?php echo $value->id; ?>"><?php echo $value->name; ?></a></strong>
		<?php } ?>
		<?php } else { ?>
		<span>该导航下没有子导航</span>
		<?php } ?>
		
	</div>

	<div class="right">
		<h2>本月本类推荐</h2>
		<ul>
		<?php if ($this->vars['Month_Rec']) {?>
		<?php foreach($this->vars['Month_Rec'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
		<?php } ?>
		<?php } else { ?>
		<li>暂时没有文档</li>
		<?php } ?>
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
		<?php if ($this->vars['Month_Hot']) {?>
		<?php foreach($this->vars['Month_Hot'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" ><?php echo $value->title; ?></a></li>
		<?php } ?>
		<?php } else { ?>
		<li>暂时没有文档</li>
		<?php } ?>
		</ul>
	</div>

</div>
<?php $tpl->create('footer.tpl')?>
</body>
</html>