<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/detail.css" />
<script type="text/javascript" src="js/detail.js"></script>
</head>
<body>
<?php $tpl->create('header.tpl')?>
<div id="list">
	<h2>当前位置 &gt; <?php if ($this->vars['par_name']) {?><?php echo $this->vars['par_name'];?> </a>&gt;<?php } ?> <?php echo $this->vars['nav_name'];?></h2>
<div id="detail">
	<h3><?php echo $this->vars['title_content'];?></h3>
	<div class="d1">时间：<?php echo $this->vars['date'];?> 来源：<?php echo $this->vars['source'];?> 作者：<?php echo $this->vars['author'];?> 点击量：<?php echo $this->vars['count'];?></div>
	<div class="d2"><?php echo $this->vars['info'];?></div>
	<div class="d3"><?php echo $this->vars['content'];?></div>
	<div class="d5">
<?php foreach($this->vars['New_Three'] as $key=>$value) { ?>
<dl>
	<dt><img src="<?php echo $value->face; ?>"/></dt>
	<dd><span>[<?php echo $value->c_username; ?>]</span><em><?php echo $value->date; ?> 发表</em></dd>
	<dd class="info"><?php echo $value->content; ?></dd>
	<dd class="bottom"><a href="feedback.php?cid=<?php echo $value->cid; ?>&action=sustain&id=<?php echo $value->id; ?>">[<?php echo $value->sustain; ?>]支持</a> <a href="feedback.php?cid=<?php echo $this->vars['cid'];?>&action=oppose&id=<?php echo $value->id; ?>">[<?php echo $value->oppose; ?>]反对</a></dd>
</dl>
<?php } ?>
	<p><h2><em>最新评论</em><a href="feedback.php?cid=<?php echo $this->vars['title_id'];?>" target="_blank"><span>已有<?php echo $this->vars['comment_num'];?>人评论</span></a></h2></p>
	<form method="post" action="feedback.php?cid=<?php echo $this->vars['title_id'];?>" target="_blank" id="comment">
		<p>你对本文的态度：<input type="radio" name="manner" value="1" checked="checked" /> 支持
									<input type="radio" name="manner" value="0" /> 中立
									<input type="radio" name="manner" value="-1" /> 反对
		</p>
		<p class="red">请互联网规则，不要发表关于政治、反动、色情之类的评论。</p>
		<p><textarea name="content" ></textarea></p>
		<p style="position:relative;top:-5px;">
			 验证码：<input type="text" class="text" name="code" />
			 <img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /> 
			 <input type="submit" class="submit" name="send" value="提交评论" />
		</p>
	</form>
</div>
</div>

	<div id="page"><?php echo $this->vars['page'];?></div>
</div>
<div id="sidebar">
	<div class="right">
		<h2>本类推荐</h2>
		<ul>
		<?php if ($this->vars['Month_Rec']) {?>
		<?php foreach($this->vars['Month_Rec'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
		<?php } ?>
		<?php } else { ?>
		<span>暂无符合要求的文档</span>
		<?php } ?>
		</ul>
	</div>
	<div class="right">
		<h2>本类热点</h2>
		<ul>
		<?php if ($this->vars['Month_Hot']) {?>
		<?php foreach($this->vars['Month_Hot'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
		<?php } ?>
		<?php } else { ?>
		<span>暂无符合要求的文档</span>
		<?php } ?>
		</ul>
	</div>
	<div class="right">
		<h2>本类图文</h2>
		<ul>
		<?php if ($this->vars['Month_pic']) {?>
		<?php foreach($this->vars['Month_pic'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"><?php echo $value->title; ?></a></li>
		<?php } ?>
		<?php } else { ?>
		<span>暂无符合要求的文档</span>
		<?php } ?>
		</ul>
	</div>
</div>
<?php $tpl->create('footer.tpl')?>
</body>
</html>