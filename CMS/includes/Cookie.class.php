<?php
//cookie类
class Cookie{
	private $name;
	private $value;
	private $time;
	
	
	public function __construct($name=NULL,$value=NULL,$time=NULL){
		$this->name = $name;
		$this->value = $value;
		$this->time = $time;
	}
	
	//生成cookie
	public function Set_Cookie(){
		setcookie($this->name,$this->value,$this->time);
	}
	
	//销毁cookie
	public function Destory_Cooie(){
		setcookie($this->name,$this->value,-1);
	}
	
}


?>