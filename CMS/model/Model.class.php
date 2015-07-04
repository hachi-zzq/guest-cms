<?php
//实体类基类
class Model{
	
	//增删修模型基类
	protected function add_up_de($sql){
		$mysqli = DB::getDB();
		if (!mysqli_connect_errno()){
			if (!$result = $mysqli->query($sql)){
				echo $mysqli->error;
			}else {
				return $mysqli->affected_rows;
			}
		}else {
			echo '数据库链接失败';
		}
		DB::unDB($result=null, $mysqli);
	}
	//执行多条sql语句
	protected function Muti_Sql($sql){
		$mysqli = DB::getDB();
		$mysqli->multi_query($sql);
		return TRUE;
	}
	//查询记录数
	protected function Get_Num($sql){
		$mysqli = DB::getDB();
		if (!mysqli_connect_errno()){
			if (!$result = $mysqli->query($sql)){
				echo $mysqli->error;
			}else {
				$result = $mysqli->query($sql);
				return $result;
			}
		}else {
			echo '数据库链接失败';
		}
		DB::unDB($result, $mysqli);
	}
	//查找单个数据模型
	protected function one($sql) {
		$mysqli = DB::getDB();
		if (!mysqli_connect_errno()){
			if (!$result = $mysqli->query($sql)){
				echo $mysqli->error;
			}else {
				$result = $mysqli->query($sql);
				$objects = $result->fetch_object();
				return $objects;
			}
		}else {
			echo '数据库链接失败';
		}
		DB::unDB($result, $mysqli);
	}
	
	//查找多个数据模型
	protected function all($sql) {
		$mysqli = DB::getDB();
		if (!mysqli_connect_errno()){
			if (!$result = $mysqli->query($sql)){
				echo $mysqli->error;
			}else {
				$result = $mysqli->query($sql);
			}
		}else {
			echo '数据库链接失败';
		}
		$html = array();
		while (!!$objects = $result->fetch_object()) {
			$html[] = $objects;
		}
		DB::unDB($result, $mysqli);
		return $html;
	}
	
	//获取插入的下个id
	protected  function Next_Id($table){
		$sql = "show table status like '$table'";
		$object = $this->one($sql);
		return $object->Auto_increment;
	}
}


?>