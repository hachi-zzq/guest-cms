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
<link rel="stylesheet" type="text/css" href="style/1/qimg.css" />
<script type="text/javascript" src="js/qimg.js">

</script>
</head>
<body>
<?php 
//开始接收
if (isset($_GET['num']) && isset($_GET['path'])){
	$num = $_GET['num'];
	$path = $_GET['path'];
}else {
	echo'非法操作';
	exit();
}
?>
<div id="qimg">
	<h3>Q图选择</h3>
	<dl>
		<?php for ($i=1;$i<=$num;$i++){?>
		<dd><img src="<?php echo $path.$i.'.gif'?>"  alt="<?php echo $path.$i.'.gif'?>"  /></dd>
		<?php }?>	
	</dl>
	
</div>
</body>
</html>
