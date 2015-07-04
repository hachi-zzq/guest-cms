<?php
class LoginAction extends Action{

	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new ManageModel());

	}

	public function Action(){
		switch ($_GET['action']) {
			case 'login':
			if (isset($_POST['send'])){
			if (!Validate::Check_Length($_POST['code'], 4, 'equals')) Tool::alertBack('验证码必须为四位');
			if (!Validate::Check_Equals($_POST['code'], strtolower($_SESSION['code']))) Tool::alertBack('验证码不正确');
			$object = $this->model->Manage_Login();
			if (!Validate::Check_Null($object)) {
				$_SESSION['admin']['username'] = $object->username;												//生成session
				$_SESSION['admin']['level_position'] = $object->level_position;
				$this->model->Login_Count();
				Tool::alertLocation(null, 'admin.php');
			}else {
				Tool::alertBack('用户名或者密码错误，请重新输入');
			}
		}
			break;
			case 'logout':
				if (session_start()){
					session_destroy();
				}
				Tool::alertLocation(null, 'admin_login.php');	
			break;
		}
	}
	
}
?>