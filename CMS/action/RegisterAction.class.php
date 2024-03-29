<?php 
class RegisterAction extends Action{

	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new UserModel());											//初始化父类
	}

	public function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'reg':
			$templates->assgin('all_face', range(1, 24));
			$templates->assgin('reg', true);
			if ($_POST['send'] == '注册会员'){
				$this->Add();
			}
			break;
			
			case 'login':
				$templates->assgin('login', true);
				if ($_POST['send'] == '登入'){
					$this->Login();
				}
				break;
			case 'logout':
				$this->Logout();
				break;
			default:
				Tool::alertBack('非法操作');
			break;
		}
	}
	
	private function Add(){
		global $templates;
		Tool::Check_Code();
		$this->Check_Other();
		$this->model->username = $_POST['username'];
		$this->model->password = sha1($_POST['password']);
		$this->model->question = $_POST['question'];
		$this->model->answer = $_POST['answer'];
		$this->model->face = $_POST['face'];
		$this->model->email = $_POST['email'];
		if ($this->model->Check_Existusername()) Tool::alertBack('用户名已经存在');
		if ($this->model->Add_User()) {
			$cookie = new Cookie('user',$_POST['username']);
			$cookie->Set_Cookie();
			$cookie = new Cookie('face',$_POST['face']);
			$cookie->Set_Cookie();
			$this->model->time = time();
			$this->model->username = $_POST['username'];
			$this->model->Set_Last_Time();
			Tool::alertLocation('注册成功', 'index.php');
		}else {
			Tool::alertBack('注册失败');
		}
	}
	
	private function Login(){
		Tool::Check_Code();
		$this->model->username = $_POST['username'];
		$this->model->password = sha1($_POST['password']);
		if (!!$row = $this->model->Login()){
			$cookie = new Cookie('user',$_POST['username']);
			$cookie->Set_Cookie();
			$cookie = new Cookie('face',$row->face);
			$cookie->Set_Cookie();
			$this->model->time = time();
			$this->model->username = $_POST['username'];
			$this->model->Set_Last_Time();
			Tool::alertLocation('登入成功', 'index.php');
		}else {
			Tool::alertBack('很遗憾，用户名或者密码不正确');
		}
	}

	private function Logout(){
		$cookie = new Cookie('user');
		$cookie->Destory_Cooie();
		Tool::alertLocation(NULL, 'register.php?action=login');
	}
	
	//判断其他的是否合法,用户名，密码。。。。。
	private function Check_Other(){
		if (Validate::Check_Length($_POST['username'], 2, 'min')) Tool::alertBack('用户名不能少于2位');
		if (Validate::Check_Length($_POST['username'], 20, 'max')) Tool::alertBack('用户名不能多于20位');
		if (Validate::Check_Length($_POST['password'], 6, 'min')) Tool::alertBack('密码不能少于6位');
		if (Validate::Check_Length($_POST['password'], 20, 'max')) Tool::alertBack('密码不能多于20位');	
		if (!Validate::Check_Equals($_POST['password'], $_POST['re_password'])) Tool::alertBack('密码不一致');
		if (!empty($_POST['question'])){
			if (Validate::Check_Null($_POST['answer'])) Tool::alertBack('密保答案不能为空');
		}
	}
	
}
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         