<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class LevelModel extends Model{
	private $id;
	Private $level_position;
	private $level_info;

	
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
	
	//查询单条数据
	public function Get_One_Level(){
		global $templates;
		$this->id = $_GET['id'];
		$this->level_position=$_POST['level_position'];
		$sql = "select id,level_position,level_info from manage_level where id='$this->id'  or level_position='$this->level_position' limit 1 ;";
		return  parent::one($sql);

	}
	//查询全部数据
	public function Get_ALL_Level(){
		//获取数据
		$sql = "select 
								id,
								level_position,
								level_info
					 from
								manage_level
					order by
								id
					DESC";
		return parent::all($sql);
	}
	//新增数据
	public function Add_Level(){
		if ($_POST['send'] == '新增等级'){
			$this->level_position = $_POST['level_position'];
			$this->level_info = $_POST['level_info'];
			$sql = "insert into
							manage_level (
											level_position,
											level_info)
							values
											('$this->level_position',
											'$this->level_info'
											);";
		$affected_rows =  parent::add_up_de($sql);
				if ($affected_rows == 1){
					Tool::alertLocation('恭喜你，新增等级成功', 'level.php?action=show');
					
				}else {
					Tool::alertBack('很遗憾，新增失败');
				}
		}
		
	}
	//更新数据
	public function Update_Level(){
			$this->level_position = $_POST['level_position'];
			$this->level_info = $_POST['level_info'];
			$this->id = $_GET['id'];
			$sql = "update
										manage_level
								set
										level_position='$this->level_position',
										level_info='$this->level_info'
							where
										id='{$this->id}';";
		$affected_rows =	parent::add_up_de($sql);
		if ($affected_rows == 1){
			Tool::alertLocation('恭喜你，修改成功', 'level.php?action=show');
		}else {
			Tool::alertBack('很遗憾，修改失败');
		}
	}
	//删除数据
	public function Delete_Level(){
		$this->id = $_GET['id'];
		$sql_delete = "delete from manage_level where id='$this->id' limit 1";
		$affected_rows = parent::add_up_de($sql_delete);
		if ($affected_rows==1){
			Tool::alertLocation('删除成功', 'level.php?action=show');
		}else {
			Tool::alertBack('删除失败');
		}
		
	}
	//验证数据库中的某个数据是否存在
	public  function Date_Exist(){
		$this->id = $_GET['id'];
		$sql = "select * from manage,manage_level where manage.level='{$this->id}'";
		$mysqli = DB::getDB();
		$result = $mysqli->query($sql);
		if ($result->fetch_object()){
			return true;
		}else {
			return false;
		}
		DB::unDB($result, $mysqli);
	}

	
}


?>