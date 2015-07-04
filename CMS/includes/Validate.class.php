<?php
//验证类
class Validate{
	//验证是否为空
	static function Check_Null($date){
		if (is_string($date)){
			$date = trim($date);
		}
		if (empty($date)){
			return true;
		}
	}
	
	//验证长度
	static function Check_Length($date,$length,$flag){
		$date = trim($date);
		if ($flag == 'min'){
			if (mb_strlen($date,'utf-8') < $length){
				return true;
			}
		}elseif ($flag == 'max'){
			if (mb_strlen($date,'utf-8') > $length){
				return true;
			}
		}elseif ($flag == 'equals'){
			if (mb_strlen($date) == $length){
				return true;
			}
		}else {
			Tool::alertBack('警告：操作有错');
		}
	}
	
	//验证是否相等
	static function Check_Equals($date,$another){
		$date = trim($date);
		$another = trim($another);
		if ($date == $another){
			return true;
		}
	}
	//登入验证，验证是否已经登入
	static  function Check_Login(){
		if (session_start()){
			if (!isset($_SESSION['admin'])){
				Tool::alertLocation(null, 'admin_login.php');
			}
		}
	}

	//验证是否是数字
	static function Check_Num($date){
		if (is_numeric($date)){
			return true;
		}else {
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>