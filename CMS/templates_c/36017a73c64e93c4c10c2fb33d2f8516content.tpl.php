<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_content.js" ></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">

<div class="map">
	内容管理 &gt;&gt; 查看文档列表 &gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
</div>

<ol>
	<li><a href="content.php?action=show" class="selected">文档列表</a></li>
	<li><a href="content.php?action=add">新增文档</a></li>
	<?php if ($this->vars['update']) {?>
	<li><a href="content.php?action=update&id=<?php echo $this->vars['id'];?>">修改文档</a></li>
	<?php } ?>
</ol>

<?php if ($this->vars['show']) {?> 
<table cellspacing="0">
	<tr><th>id</th><th>标题</th><th>属性</th><th>来源</th><th>浏览次数</th><th>文档发布时间</th><th>操作</th></tr>
	<?php foreach($this->vars['Show_Content'] as $key=>$value) { ?>
	<tr><td><?php echo $value->id; ?></td><td><a href="../list.php?id=<?php echo $value->id; ?>" title="<?php echo $value->title; ?>" target="_blank"><?php echo $value->title; ?></a></td><td><?php echo $value->attr; ?></td><td><?php echo $value->source; ?></td><td><?php echo $value->read_count; ?></td><td><?php echo $value->date; ?></td><td><a href="content.php?action=update&id=<?php echo $value->cid; ?>">修改</a> | <a href="content.php?action=delete&id=<?php echo $value->cid; ?>" onclick="return confirm('你真的要删除吗？')?true:false">删除</a></td></tr>
	<?php } ?>
</table>
<div id="page"><?php echo $this->vars['page'];?>
<form method="get" action="?">
<input type="hidden" name="action" value="show" />
<select name="nav">
	<option value="0">默认全部</option><?php echo $this->vars['nav'];?>
</select>
<input type="submit" name="send" value="刷选" />
</form>

</div>
<?php } ?>

<?php if ($this->vars['add']) {?>
<form name="content" id="content" method="post" action="?action=add">
<table cellspacing="0" class="content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" name="title" class="text" /> <span class="red">[必填]</span> ( * 标题2-50字符之间)</td></tr>
	<tr><td>栏　　目：<select name="nav"><option value="" style="margin: 0;">请选择一个栏目类别</option> <?php echo $this->vars['nav'];?></select> <span class="red">[必选]</span></td></tr>
	<tr><td>定义属性：<input type="checkbox" name="attr[]" value="头条" />头条
								<input type="checkbox" name="attr[]" value="推荐" />推荐
								<input type="checkbox" name="attr[]" value="加粗" />加粗
								<input type="checkbox" name="attr[]" value="跳转" />跳转
	</td></tr>
	<tr><td>标　　签：<input type="text" name="tag" class="text" /> ( * 每个标签用','隔开，总长30位之内)</td> </tr>
	<tr><td>关 键 字：<input type="text" name="keyword" class="text" /> ( * 每个标签用','隔开，总长30位之内)</td> </tr>
	<tr><td>缩 略 图：<input type="text" name="thumbnail" readonly="readonly" class="text" /><input type="button" class="uploads" value="上传" onclick="javascript:Open_Window('../templates/upfile.php?type=content','rotatain','150','400');"/><img name="pic" style="display: none;" /></td></tr>
	
	<tr><td>文章来源：<input type="text" name="source" class="text" /> ( * 文章来源20位之内)</td></tr>
	<tr><td>作　　者：<input type="text" name="author" class="text" /> ( * 作者10位之内)</td></tr>
	<tr><td><span class="middle">内容摘要：</span><textarea name="info"></textarea><span class="middle"> ( * 内容摘要200之内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"></textarea></td></tr>
	<tr><td>评论选项：<input type="radio" name="commend" value="1" checked="checked" />允许评论 
								<input type="radio" name="commend" value="0" />禁止评论 
					　　　　浏览次数：<input type="text" name="read_count" value="100" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
									<option value="0">默认排序</option>
									<option value="1">置顶一天</option>
									<option value="2">置顶一周</option>
									<option value="3">置顶一月</option>
									<option value="4">置顶一年</option>
								</select>
					 　 　　消费金币：<input type="text" name="gold" value="0" class="text small" />
	</td></tr>
	<tr><td>阅读权限：<select name="read_limit">
									<option value="0">开放浏览</option>
									<option value="1">初级会员</option>
									<option value="2">中级会员</option>
									<option value="3">高级会员</option>
									<option value="4">VIP会员</option>
								</select>
				标题颜色：<select name="color">
									<option>默认颜色</option>
									<option style="color:red;" value="red">红色</option>
									<option style="color:blue;" value="blue">蓝色</option>
									<option style="color:orange;" value="orange">橙色</option>
								</select>
	</td></tr>
	<tr><td><input type="submit"  name="send" value="发布文档" /> <input type="reset" value="重置" /></td></tr>
	<tr><td></td></tr>
</table>
</form>
<?php } ?>

<?php if ($this->vars['update']) {?> 
<form name="content" id="content" method="post" action="?action=update">
<input type="hidden" name="id" value="<?php echo $this->vars['id'];?>">
<table cellspacing="0" class="content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" name="title" value="<?php echo $this->vars['titlec'];?>"class="text" /> <span class="red">[必填]</span> ( * 标题2-50字符之间)</td></tr>
	<tr><td>栏　　目：<select name="nav"><option value="" style="margin: 0;">请选择一个栏目类别</option> <?php echo $this->vars['nav'];?></select> <span class="red">[必选]</span></td></tr>
	<tr><td>定义属性：<?php echo $this->vars['attr'];?>
	</td></tr>
	<tr><td>标　　签：<input type="text" name="tag" value="<?php echo $this->vars['tag'];?>"class="text" /> ( * 每个标签用','隔开，总长30位之内)</td> </tr>
	<tr><td>关 键 字：<input type="text" name="keyword" value="<?php echo $this->vars['keyword'];?>"class="text" /> ( * 每个标签用','隔开，总长30位之内)</td> </tr>
	<tr><td>缩 略 图：<input type="text" name="thumbnail" value="<?php echo $this->vars['thumbnail'];?>"readonly="readonly" class="text" /><input type="button" class="uploads" value="上传" id="uploads"/><img name="pic" style="display: none;" /></td></tr>
	<tr><td><img src="<?php echo $this->vars['thumbnail'];?>" /></td></tr>
	<tr><td>文章来源：<input type="text" name="source" value="<?php echo $this->vars['source'];?>"class="text" /> ( * 文章来源20位之内)</td></tr>
	<tr><td>作　　者：<input type="text" name="author" value="<?php echo $this->vars['author'];?>"class="text" /> ( * 作者10位之内)</td></tr>
	<tr><td><span class="middle">内容摘要：</span><textarea name="info"><?php echo $this->vars['info'];?></textarea><span class="middle"> ( * 内容摘要200之内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"><?php echo $this->vars['content'];?></textarea></td></tr>
	<tr><td>评论选项：<?php echo $this->vars['commend'];?>
					　　　　浏览次数：<input type="text" name="read_count"value="<?php echo $this->vars['read_count'];?>" value="100" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
									<?php echo $this->vars['sort'];?>
								</select>
					 　 　　消费金币：<input type="text" name="gold" value="<?php echo $this->vars['gold'];?>" class="text small" />
	</td></tr>
	<tr><td>阅读权限：<select name="read_limit">
									<?php echo $this->vars['read_limit'];?>
								</select>
				标题颜色：<select name="color">
									<?php echo $this->vars['colorc'];?>
								</select>
	</td></tr>
	<tr><td><input type="submit"  name="send" value="修改文档" /> <input type="reset" value="重置" /></td></tr>
	<tr><td></td></tr>
</table>
</form>

<?php } ?>
</body>
</html>