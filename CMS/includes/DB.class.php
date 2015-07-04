<?php
class DB{
	
	static function getDB(){																				//使用静态方法，获取mysqli资源句柄（静态方法放映在每个对象中）
		//使用过程化方法，对数据库进行操作
		//链接数据库
		$mysqli =  new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		//判断是否链接成功
		if (mysqli_connect_errno()){																		//数据库链接错误号不为0
			exit('数据链接失败'.mysqli_connect_error());
		}
		
		$mysqli->set_charset('utf8');																		//设置字符编码
		return $mysqli;
	}
	
	static function unDB($result,$mysqli){
		if (is_object(&$result)){
			//释放结果集
			$result->free();
			//销毁结果集
			$result = null;
		}
		if (is_object(&$mysqli)){
			//关闭数据库链接
			$mysqli->close();
			//销毁数据库对象，
			$mysqli= null;
		}
	}
	
}


?>