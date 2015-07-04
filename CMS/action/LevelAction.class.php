<?php
//业务流程控制器
class LevelAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new LevelModel());											//初始化父类，定义了ManageModel 的对象$model
	}
	
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				$templates->assgin('title', '等级列表');
				$templates->assgin('show', true);
				$all_level = $this->model->Get_ALL_Level();
				$templates->assgin('ALL_Level', $all_level);
				break;
			case 'update':
				if (isset($_GET['id'])){
					$templates->assgin('title', '修改等级');
					$templates->assgin('update', true);
					$object = $this->model->Get_One_Level();
					$templates->assgin('level_position', $object->level_position);
					$templates->assgin('id', $object->id);
					$templates->assgin('level_info', $object->level_info);
					if ($_POST['send']=='修改等级'){
						
						$this->model->Update_Level();
					}
				}
				break;
			case 'add':
				$templates->assgin('title', '新增等级');
				$templates->assgin('add', true);
				if ($_POST['send']=='新增等级'){
					if ($this->model->Get_One_Level()) Tool::alertBack('等级名称已经存在');
					$this->model->Add_Level();
				}
				break;
			case 'delete':
				$templates->assgin('title', '删除等级');
				$templates->assgin('delete',true);
				if ($_GET['action'] == 'delete'){
					//在删除等级之前，首先进行验证，如果这个等级有管理员在，则不允许删除这个等级
					if ($this->model->Date_Exist()) Tool::alertBack('这个等级有管理员存在，请先删除这个管理员');
					$this->model->Delete_Level();
				}
				break;
			default:
				echo '非法操作';
				break;
		}

	}
	

	
	
	
}


?>