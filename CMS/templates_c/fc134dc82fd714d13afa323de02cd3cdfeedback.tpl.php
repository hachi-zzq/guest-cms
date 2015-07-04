<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/feedback.css" />
</head>
<body>
<?php $tpl->create('header.tpl')?>
<div id="feedback">
<h2>评论列表</h2>
<?php if ($this->vars['feed_object']) {?>
	<h3><?php echo $this->vars['feed_title'];?></h3>
	<p><?php echo $this->vars['feed_info'];?></p>
<?php } ?>
<?php if ($this->vars['all_comment']) {?>
<?php foreach($this->vars['all_comment'] as $key=>$value) { ?>
<dl>
	<dt><img src="<?php echo $value->face; ?>"/></dt>
	<dd><em><?php echo $value->date; ?> 发表</em><span>[<?php echo $value->c_username; ?>]</span></dd>
	<dd class="info"><?php echo $value->content; ?></dd>
	<dd class="bottom"><a href="?cid=<?php echo $this->vars['cid'];?>&action=sustain&id=<?php echo $value->id; ?>">[<?php echo $value->sustain; ?>]支持</a> <a href="?cid=<?php echo $this->vars['cid'];?>&action=oppose&id=<?php echo $value->id; ?>">[<?php echo $value->oppose; ?>]反对</a></dd>
</dl>
<?php } ?>
<?php } else { ?>
<span style="margin:20px auto auto 300px;">暂无相关评论</span>
<?php } ?>
<div id="page"><?php echo $this->vars['page'];?></div>
</div>

<div id="sidebar">
<h2>热点文章</h2>
		<ul>
		<?php foreach($this->vars['hot_content'] as $key=>$value) { ?>
			<li><em><?php echo $value->date; ?></em><a href="detail.php?id=<?php echo $value->id; ?>" target="_blank"> <?php echo $value->title; ?></a></li>
		<?php } ?>
		</ul>
</div>
	<div class="d5">
	<p><h2><em>最新评论</em><a href="feedback.php?cid=<?php echo $this->vars['cid'];?>"></a></h2></p>
	<form method="post" action="feedback.php?cid=<?php echo $this->vars['cid'];?>"  id="comment">
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
<?php $tpl->create('footer.tpl')?>
</body>
</html>