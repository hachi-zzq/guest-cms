<?php
//工具类
	 class Tool{
	 	
	 	//判断验证码是否正确
	 	static  function  Check_Code(){
	 		if (!Validate::Check_Equals($_SESSION['code'], strtolower($_POST['code']))) Tool::alertBack('验证码不正确请重新输入');
	 	}
		//弹窗返回
		static  function alertBack($info){
			echo "<script type='text/javascript'>alert('$info');history.back();</script>";
			exit();
		}
		
		//弹窗跳转
		static function alertLocation($info,$url){
			if (empty($info)){
				echo "<script type='text/javascript'>location.href='$url';</script>";
				exit();	
			}else {
				echo "<script type='text/javascript'>alert('$info');location.href='$url';</script>";
				exit();	
			}
		}
		
		//弹窗关闭
		static function alertClose($info){
			echo "<script type='text/javascript'>alert('$info');window.close();</script>";
			exit();
			}
			
	 	//弹窗赋值关闭(上传专用)
		static public function alertOpenerClose($_info,$_path) {
			echo "<script type='text/javascript'>alert('$_info');</script>";
			echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
			echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
			echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
			echo "<script type='text/javascript'>window.close();</script>";
			exit();
		}
	//过滤页面输出
	 static function Html_Special($date){
		if (is_array($date)){
			foreach ($date as $key=>$value){
				$string [Tool::Html_Special($key)] = Tool::Html_Special($value);
			}
			return $string;
		}elseif (is_object($date)){
			foreach ($date as $key=>$value){
				$string->$key = Tool::Html_Special($value);
			}
			return $string;
		}else {
			return htmlspecialchars($date);
		}
	}
		//数据库输入转义
		static function Html_Gpc($date){
			if (!get_magic_quotes_gpc()){
				$date = mysql_real_escape_string($date);
			}
			return $date;
		}
	
	//截取字符串
	static function Sub_Str($string,$length){
		if (mb_strlen($string,'utf-8') > $length){
			$string = mb_substr($string, 0,$length,'utf-8').'...';
		}
		return $string;
	}
		

	}


?>