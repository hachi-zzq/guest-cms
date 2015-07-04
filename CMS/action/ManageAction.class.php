<?php
//业务流程控制器
class ManageAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new ManageModel());

	}
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				Validate::Check_Login();
				$templates->assgin('title', '管理员列表');
				$templates->assgin('show', true);
				parent::Page($this->model->Get_Manage_Num());
				$all_Manage = $this->model->selectManage();
				$templates->assgin('ALLManage', $all_Manage);
				break;
			case 'update':
				Validate::Check_Login();
				if (isset($_GET['id'])){
					$templates->assgin('title', '修改管理员');
					$templates->assgin('update', true);
					$templates->assgin('prev_url', PREV_URL);														//注入一个变量，用户得到上次的url
					$object = $this->model->selectOneManage();
					$templates->assgin('username', $object->username);
					$templates->assgin('id', $object->id);
					$templates->assgin('level', $object->level);
					$templates->assgin('All_level', $this->model->getAllLevel());					//得到所有的等级
					if ($_POST['send']=='修改管理员'){																	//先验证数据
						if (Validate::Check_Null($_POST['admin_user'])) Tool::alertBack('用户名不能为空');
						if (Validate::Check_Length($_POST['admin_user'], 2, 'min')) Tool::alertBack('用户名不能少于2位');
						if (Validate::Check_Length($_POST['admin_user'], 20, 'max')) Tool::alertBack('用户名不能多于20位');
						if (!empty($_POST['admin_pass'])){														//密码不为空的时候开始验证
							if (Validate::Check_Length($_POST['admin_pass'], 6, 'min')) Tool::alertBack('密码不能少于6位');
							if (Validate::Check_Length($_POST['admin_pass'], 20, 'max')) Tool::alertBack('密码不能多于20位');
						}
						 $this->model->updateManage();
						
					}
				}
				break;
			case 'add':
				Validate::Check_Login();
				$templates->assgin('title', '新增管理员');
				$templates->assgin('add', true);
				$templates->assgin('All_level', $this->model->getAllLevel());
				if ($_POST['send']=='新增管理员'){																	//先验证数据
					if (Validate::Check_Null($_POST['admin_user'])) Tool::alertBack('用户名不能为空');
					if (Validate::Check_Length($_POST['admin_user'], 2, 'min')) Tool::alertBack('用户名不能少于2位');
					if (Validate::Check_Length($_POST['admin_user'], 20, 'max')) Tool::alertBack('用户名不能多于20位');
					if (Validate::Check_Length($_POST['admin_pass'], 6, 'min')) Tool::alertBack('密码不能少于6位');
					if (Validate::Check_Length($_POST['admin_pass'], 20, 'max')) Tool::alertBack('密码不能多于20位');
					if (!Validate::Check_Equals($_POST['admin_pass'], $_POST['admin_repass'])) Tool::alertBack('密码不一致');
					if ($this->model->selectOneManage()) Tool::alertBack('用户名已经存在');
					$this->model->addManage();
				}
				break;
			case 'delete':
				Validate::Check_Login();
				$templates->assgin('title', '删除管理员');
				$templates->assgin('delete',true);
				if ($_GET['action'] == 'delete'){
					$this->model->deleteManage();
				}
				break;

			default:
				Tool::alertBack('非法操作');
				break;
		}

	}
	
	
	
}


?>