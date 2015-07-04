<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class UserModel extends Model{
	private $id;
	private $username;
	private $password;
	private $re_password;
	private $question;
	private $answer;
	private $email;
	private $face;
	private $time;
	private $state;
	private $limit;
	
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

	public function Add_User(){
		$sql = "insert into 
									user (
										username,
										password,
										question,
										answer,
										email,
										face,
										reg_date
														)
						 values(
										'$this->username',
										'$this->password',
										'$this->question',
										'$this->answer',
										'$this->email',
										'$this->face',
										now())
										";
		return parent::add_up_de($sql);
	}
	
	//验证登入
	public function Login(){
		$sql = "select username,face from user where username='$this->username' and password='$this->password'";
		return parent::one($sql);
	}
	
	//验证用户名是否已经存在
	public function Check_Existusername(){
		$sql = "select id from user where username='$this->username'";
		return parent::one($sql);
	}
	
	//登入或者注册时候，更新时间戳
	public function Set_Last_Time(){
		$sql = "update user set time='$this->time' where username='$this->username'";
		return parent::add_up_de($sql);
	}
	
	//首页显示最近登入的会员
	public function Get_Last_User(){
		$sql = "select username,face from user order by time DESC limit 0,6";
		return parent::all($sql);
	}
	
	//查询全部数据
	public function Get_ALL_User(){
		//获取数据
		$sql = "select
								*
					 from
								user
					order by
								time
					DESC
					$this->limit";
		return parent::all($sql);
	}
	
	//删除数据
	public function Delete_User(){
		$sql_delete = "delete from user where id='$this->id' limit 1";
		return parent::add_up_de($sql_delete);
	}
	
	//查询单条数据
	public function Get_One_User(){
		$sql = "select * from user where id='$this->id' limit 1 ;";
		return  parent::one($sql);
	}
	//总记录数
	public function Get_User_Num(){
		$sql = "select count(id) as count from user";
		$result = parent::Get_Num($sql);
		return $result->fetch_object()->count;
	}
	
	//更新管理员
	public function Update_User(){
		if ($this->password == null){
			$sql = "update
										user
						set
								face='$this->face',
								question='$this->question',
								answer='$this->answer',
								email='$this->email',
								state='$this->state'
							where id='$this->id'";	
		}else{
			$sql = "update
										user
						set
								password=sha1('$this->password'),
								face='$this->face',
								question='$this->question',
								answer='$this->answer',
								email='$this->email',
								state='$this->state'
								where id='$this->id'";	
		}
		return parent::add_up_de($sql);
	}
	
	
	
	
	
	
	
}
?>