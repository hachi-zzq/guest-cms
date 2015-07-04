<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class RotatainModel extends Model{
		private $id;
		private $pic;
		private $title;
		private $info;
		private $link;
		private $date;
	
	//拦截器,可是使外在的类访问设置本类中私有属性
	//__get()方法用来获取私有属性
	private function __get($value)	{
		if(isset($this->$value)){
			return($this->$value);
		}else{
			return(NULL);
		}
	}
	//__set()方法用来设置私有属性
	private function __set($key, $value)	{
		$this->$key = $value;
	}
	
	//查询所有的轮播器(后台)
	public function All_Rotatain(){
		$sql = "select id,title,info,pic,link,state from rotatain";
		return parent::all($sql);
	}
	
	//查询所有的轮播器(前台)
	public function All_Index_Rotatain(){
		$sql = "select id,title,info,pic,link,state from rotatain where state=1";
		return parent::all($sql);
	}
	
	//新增一个轮播器
	public function Add_Rotatain(){
		$sql = "insert into rotatain(pic,title,info,link,date)values('$this->pic','$this->title','$this->info','$this->link',now());";
		return parent::add_up_de($sql);
	}
	
	//启用轮播器
	public function Rotatain_On(){
		$sql = "update rotatain set state=1 where id='$this->id'";
		return parent::add_up_de($sql);
	}
	
	//停用轮播器
	public function Rotatain_Off(){
		$sql = "update rotatain set state=0 where id='$this->id'";
		return parent::add_up_de($sql);
	}
	
	//删除轮播器
	public function Del_Rotatain(){
		$sql = "delete from rotatain where id='$this->id'";
		return parent::add_up_de($sql);
	}
	
}


?>