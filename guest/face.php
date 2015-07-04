<?php 
/**
* TestGuestVersion1.0
* ================================================
* Copy 2010-2012yc60
* Web: http://www.yc60.com
* ================================================
* Author: Lee
* Date: ${date}
*/
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style/1/face.css" />
</head>
<body>
<script type="text/javascript" src="js/opener.js">

</script>
<div id="face">
	<h3>头像选择</h3>
	<dl>
		<?php for ($i=1;$i<=9;$i++){?>
		<dd><img src="face/m0<?php echo $i;?>.gif" alt="face/m0<?php echo $i;?>.gif" title="头像<?php echo $i;?>"  /></dd>
		<?php }?>
		
		<?php for ($i=10;$i<=64;$i++){?>
		<dd><img src="face/m<?php echo $i;?>.gif" alt="face/m<?php echo $i;?>.gif" title="头像<?php echo $i;?>"/></dd>
		<?php }?>
		
	</dl>
	
</div>
</body>
</html>
