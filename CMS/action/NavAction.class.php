<?php
//业务流程控制器
class navAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new NavModel());

	}
	
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				Validate::Check_Login();
				$templates->assgin('title', '导航列表');
				$templates->assgin('show', true);
				parent::Page($this->model->Get_Nav_Num());
				$all_Nav = $this->model->selectNav();
				$templates->assgin('ALLNav', $all_Nav);
				break;
			case 'showchild':
				if (isset($_GET['id'])){
					$templates->assgin('title', '子导航列表');
					$templates->assgin('showchild', true);
					$templates->assgin('par_name', $_GET['par_name']);
					parent::Page($this->model->Get_childNav_Num());
					$all_childNav = $this->model->selectchildNav();
					$templates->assgin('all_childNav', $all_childNav);
				}
				break;
			case 'sort':
				if (isset($_POST['send'])){
					$sort = $_POST['sort'];
					foreach ($sort as $key=>$value){
						if (!is_numeric($key)) continue;
						$sql .= "update nav set sort='$value' where id='$key';";
					}
					$this->model->Sort($sql);
					Tool::alertLocation(null, PREV_URL);
				}
				
				break;
			case 'addchild':
				if (isset($_GET['id'])){
					$templates->assgin('PREV_URL',PREV_URL);
					$templates->assgin('title', '新增子导航');
					$templates->assgin('addchild', true);
					$templates->assgin('parid', $_GET['id']);
					$templates->assgin('par_name', $_GET['par_name']);
				}
				if ($_POST['send']=='新增子导航'){
					if ($this->model->Get_One_childNav()) Tool::alertBack('导航名称已经存在');
					$this->model->Add_Nav();
				}
				break;
			case 'update':
				if ($_POST['send']=='修改导航'){
					$this->model->Update_Nav();
				}
				if (isset($_GET['id'])){
					$templates->assgin('title', '修改导航');
					$templates->assgin('update', true);
					$object = $this->model->Get_One_Nav();
					$templates->assgin('PREV_URL',PREV_URL);
					$templates->assgin('nav_name', $object->name);
					$templates->assgin('id', $object->id);
					$templates->assgin('nav_info', $object->info); 
				}
				
				break;
			case  'add':
				if ($_POST['send']=='新增导航'){
					if ($this->model->Get_One_Nav()) Tool::alertBack('导航名称已经存在');
					$this->model->Add_Nav();
				}
				$templates->assgin('PREV_URL',PREV_URL);
				$templates->assgin('title', '新增导航');
				$templates->assgin('add', true);
				break;
			case 'delete':
				$templates->assgin('title', '删除导航');
				$templates->assgin('delete',true);
				if ($_GET['action'] == 'delete'){
					$this->model->Delete_Nav();
				}
			default:
				Tool::alertBack('非法操作');
				break;
		}

	}
	public function Show_Nav(){
		global $templates;
		$object_nav =  $this->model->Show_Nav();
		$templates->assgin('AllNav', $object_nav);
	}
	
	
	
}


?>