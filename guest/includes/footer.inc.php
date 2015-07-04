<?php
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: 2012-5-21
*/

	if (!defined('IN_TG')){
		exit('非法调用！');
	}
	@mysql_close();
?>
<div id="footer">
	<p>本程序耗时<?php echo round(fun_time()-$GLOBALS['START_TIME'],4)?>秒</p>
	<p>版权所有 翻版必究</p>
	<p>本程序由<span>瓢城Web俱乐部</span>提供 源代码可以任意修改或发布 (c) yc60.com</p>
</div>