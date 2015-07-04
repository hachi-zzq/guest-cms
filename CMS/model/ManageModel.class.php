<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class ManageModel extends Model{
	private $username;
	Private $pass;
	private $level;
	private   $id;
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
	//管理员登入次数统计
	public function Login_Count(){
		$this->username = $_POST['admin_user'];
		$sql = "update manage set login_count=login_count+1,last_ip='{$_SERVER["REMOTE_ADDR"]}' where username='$this->username'";
		parent::add_up_de($sql);
	}
	//查询所有管理员记录数目
	public function Get_Manage_Num(){
		$sql = "select count(id) as mange_count from manage";
		$result = parent::Get_Num($sql);
		return $result->fetch_object()->mange_count;
	}
	
	//查询单条数据
	public function selectOneManage(){
		global $templates;
		$this->id = $_GET['id'];
		$this->username = $_POST['admin_user'];
		$sql = "select id,username,level from manage where id='$this->id' or username='$this->username' limit 1;";
		return  parent::one($sql);
	}
	//查询全部数据
	public function selectManage(){
		//获取数据
		$sql = "select 
							manage.id,
							manage.username, 
							manage.level, 
							manage.login_count,
							manage.last_ip,
							manage.last_time,
							manage_level.level_position
					 from
								 manage,
								manage_level
					where
								manage.level = manage_level.id
					order by
								manage.id
					ASC
					$this->limit";
		return parent::all($sql);
	}
	//新增数据
	public function addManage(){
		if ($_POST['send'] == '新增管理员'){
			$this->username = Tool::Html_Gpc(Tool::Html_Special($_POST['admin_user']));
			$this->pass = Tool::Html_Special($_POST['admin_pass']);
			$this->level = $_POST['level'];
			$sql = "insert into
											manage (
											username,
											password,
											level,
											last_time,
											reg_time)
							values
											('$this->username',
											'sha1($this->pass)',
											$this->level,
											now(),
											now());";
		$affected_rows =  parent::add_up_de($sql);
				if ($affected_rows == 1){
					Tool::alertLocation('恭喜你，管理员新增成功', 'manage.php?action=show');
					
				}
		}
		
	}
	//更新数据
	public function updateManage(){
		$this->username = Tool::Html_Special($_POST['admin_user']);
		$this->pass = sha1($_POST['admin_pass']);
		$this->level = $_POST['level'];
		$this->id = $_GET['id'];
		if (empty($this->pass)){																					//如果密码为空，那么不修改密码
			$sql = "update
										manage
								set
										username='$this->username',
										level='$this->level'
							where
										id='{$_POST['id']}';";
		}else{																														//密码不为空
					$sql = "update
												manage 
										set
												 username='$this->username',
												password='$this->pass',
												level='$this->level'
									 where 
												id='{$_POST['id']}';";
		}

		$affected_rows =	parent::add_up_de($sql);
		if ($affected_rows == 1){
			Tool::alertLocation('恭喜你，修改成功', $_POST['prev_url']);
		}else {
			Tool::alertBack('很遗憾，修改失败');
		}
	}
	//删除数据
	public function deleteManage(){
		$this->id = $_GET['id'];
		$sql_delete = "delete from manage where id='$this->id' limit 1";
		$affected_rows = parent::add_up_de($sql_delete);
		if ($affected_rows==1){
			Tool::alertLocation('删除管理员成功', 'manage.php?action=show');
		}else {
			Tool::alertBack('删除管理员失败');
		}
		
	}
	
	//获取所有的等级
	public function getAllLevel(){
		$sql = "select id,level_position from manage_level;";
		return  parent::all($sql);
	}
	
	//获取管理员登入信息
	public function Manage_Login(){
		$this->username = $_POST['admin_user'];
		$this->pass = sha1($_POST['admin_pass']);
			$sql = "SELECT 
										m.username,
										l.level_position
								FROM 
										manage m,
										manage_level l
								WHERE 
										m.username='$this->username' 
									AND 
										m.password='$this->pass'
									AND
										m.level=l.id
									LIMIT 1";
		return parent::one($sql);
		
	}
}


?>