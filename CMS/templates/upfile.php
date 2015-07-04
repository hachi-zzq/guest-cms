<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传缩略图</title>
</head>
<body>
<form action="../config/upload.php" method="post" enctype="multipart/form-data" >
<input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
<input type="hidden" name="MAX_FILE_SIZE " value="500" />
<input type="file" name="pic" />
<input type="submit" name="send" value="上传缩略图" />
</form>
</body>
</html>