<?php
//index索引文件，直接跳转到admin.php
require '../init.inc.php';
Validate::Check_Login();
header('Location:admin.php');

?>