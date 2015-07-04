<div id="top">
	{$header}
	<a href="###">这里可以放置文字广告1</a>
</div>
<div id="header">
	<h1><a href="###">瓢城Web俱乐部</a></h1>
	<div class="adver"><a href="###"><img src="images/adver.png" alt="广告图" /></a></div>
</div>
<div id="nav">
	<ul>
		<li><a href="index.php">首页</a></li>
	{foreach $AllNav(key,value)}
		<li><a href="list.php?id={@value->id}">{@value->name}</a></li>
	{/foreach}
	</ul>
</div>
<div id="search">
	<form action="search.php" method="get" target="_blank">
		<select name="type">
			<option selected="selected" value=1>按标题</option>
			<option value=2>按关键字</option>
			<option value=3>按Tag标签</option>
		</select>
		<input type="text" name="input_keyword" class="text" />
		<input type="submit" class="submit" value="搜索" />
	</form>
	<strong>TAG标签：</strong>
	<ul>
		<li><a href="###">基金(3)</a></li>
		<li><a href="###">美女(1)</a></li>
		<li><a href="###">白兰地(3)</a></li>
		<li><a href="###">音乐(1)</a></li>
		<li><a href="###">体育(1)</a></li>
		<li><a href="###">直播(1)</a></li>
		<li><a href="###">会晤(1)</a></li>
		<li><a href="###">韩日(1)</a></li>
		<li><a href="###">警方(1)</a></li>
		<li><a href="###">广州(1)</a></li>
	</ul>
</div>