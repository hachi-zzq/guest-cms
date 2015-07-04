<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class NavModel extends Model{
	private $id;
	private $name;
	private $info;
	private $parid;
	private $sort;
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

	public function Get_Nav_Num(){
		$this->id = $_GET['id'];
		$this->name = $_GET['par_name'];
		$sql = "select count(id) as nav_count from nav where parid=0";
		$result = parent::Get_Num($sql);
		return $result->fetch_object()->nav_count;
	}
	public function Get_childNav_Num(){
		$this->id = $_GET['id'];
		$sql = "select count(id) as nav_count from nav where parid='$this->id'";
		$result = parent::Get_Num($sql);
		return $result->fetch_object()->nav_count;
	}
	
	public function Update_Nav(){
		$this->name = $_POST['nav_name'];
		$this->info = $_POST['nav_info'];
		$this->id = $_GET['id'];
		$sql = "update
								nav
							set
								name='$this->name',
								info='$this->info'
								where
								id='{$this->id}';";
		$affected_rows =	parent::add_up_de($sql);
		if ($affected_rows == 1){
		Tool::alertLocation('恭喜你，修改成功', 'nav.php?action=show');
		}else {
			Tool::alertBack('很遗憾，修改失败');
		}
		}

	//查询全部数据
	public function selectNav(){
		//获取数据
		$sql = "select 
							*
					 from
								nav
					where 
								parid=0
					order by
								sort
					ASC
					$this->limit";
		return parent::all($sql);
	}
	//根据子导航parid获取父导航
	public function Get_Parnav(){
		$sql = "select * from nav where id=(
					select parid from nav where id='$this->id'
				)";
		return parent::one($sql);
		
	}
	
	
	//根据父导航获取单个子导航
	public function selectchildNav(){
		$sql = "select
								*
						from
									nav
									where
									parid='$this->id'
						order by
									id
						DESC
		$this->limit";
		return parent::all($sql);
	}
	
	//获取单个子导航 不含有limit
	public function selectchildNav_nolimit(){
		$sql = "select
								*
								from
								nav
								where
								parid='$this->id'
								order by
								id
								DESC
								";
		return parent::all($sql);
	}
	
	public function Get_One_Nav(){
		global $templates;
		$this->id = $_GET['id'];
		$this->name = $_POST['nav_name'];
		$sql = "select * from nav where id='$this->id' or name='$this->name' limit 1;";
		return  parent::one($sql);
	}
	
	public function Get_One_childNav(){
		global $templates;
		$this->name = $_POST['nav_name'];
		$sql = "select * from nav where  name='$this->name' limit 1;";
		return  parent::one($sql);
	}
	
	public function Add_Nav(){
			$this->sort = $this->Next_Nav_Id();
			$this->name = Tool::Html_Gpc(Tool::Html_Special($_POST['nav_name']));
			$this->info = Tool::Html_Special($_POST['nav_info']);
			$this->parid = $_POST['parid'];
			$sql = "insert into 
											nav 
											(name,
											info,
											parid,
											sort) 
								values (
											'$this->name',
											'$this->info',
											'$this->parid',
											'$this->sort')";
			$affected_rows =  parent::add_up_de($sql);
			if ($affected_rows == 1){
			Tool::alertLocation('恭喜你，导航新增成功', 'nav.php?action=show');
				}else {
			Tool::alertBack('很遗憾，导航新增失败');
				}
	}
	
	public function Next_Nav_Id(){
		return parent::Next_Id(nav);
	}
	
	
	public function Delete_Nav(){
		$this->id = $_GET['id'];
		$sql_delete = "delete from nav where id='$this->id' limit 1";
		$affected_rows = parent::add_up_de($sql_delete);
		if ($affected_rows==1){
			Tool::alertLocation('删除成功', 'nav.php?action=show');
		}else {
			Tool::alertBack('删除失败');
		}
	
	}
	//对nav排序
	public function Sort($sql){
		parent::Muti_Sql($sql);
	}
	
	//展示nav,主导航
	public function Show_Nav(){
		$sql = "select * from nav where parid=0 order by sort ASC";
		return  parent::all($sql);
	}
	
	//根据content的id获取nav的id和parid
	public function Get_id_from_content(){
		$sql = "select 
							nav.id,
							nav.parid,
							nav.name
					from
							nav,content
					where
							content.nav=nav.id 
					and 
							content.id='$this->id'";
		return parent::one($sql);
		
		
	}
	//显示所有的自导航的id
	public function Get_All_Childid(){
		$sql = "select id from nav where parid <> 0";
		return parent::all($sql);
	}
	
	
}
?>