<?php
//业务流程控制器
class UserAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new UserModel());											//初始化父类，定义了ManageModel 的对象$model
	}
	
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				$templates->assgin('title', '会员列表');
				$templates->assgin('show', true);
				
				parent::Page($this->model->Get_User_Num());
				$all_user = $this->model->Get_ALL_User();
				foreach ($all_user as $value){
					if ($value->state == 1){
						$value->state = '仅可以登入';
					}
					if ($value->state == 0){
						$value->state = '封杀会员';
					}
					if ($value->state == 2){
						$value->state = '初级会员';
					}
					if ($value->state == 3){
						$value->state = '中级会员';
					}
					if ($value->state == 4){
						$value->state = '高级会员';
					}
					if ($value->state == 5){
						$value->state = 'VIP会员';
					}
				}
				$templates->assgin('ALL_user', $all_user);
				break;
			case 'update':
				if ($_POST['send']=='修改'){
					$this->model->id = $_POST['id'];
					$this->model->password = $_POST['password'];
					$this->model->face = $_POST['face'];
					$this->model->question = $_POST['question'];
					$this->model->answer = $_POST['answer'];
					$this->model->email = $_POST['email'];
					$this->model->state = $_POST['state'];
					if ($this->model->Update_User()){
						Tool::alertLocation('修改成功', '?action=show');
					}else{
						Tool::alertBack('修改失败');
					}
					
				}
				if (isset($_GET['id'])){
					$templates->assgin('id', $_GET['id']);
					$templates->assgin('prev_url', PREV_URL);
					$templates->assgin('title', '修改会员');
					$templates->assgin('update', true);
					$this->model->id = $_GET['id'];
					$object = $this->model->Get_One_User();
					$face = $this->face($object->face);
					$question = $this->question($object->question);
					$state = $this->state($object->state);
					$templates->assgin('all_state', $state);
					$templates->assgin('all_question', $question);
					$templates->assgin('all_face', $face);
					$templates->assgin('face', $object->face);
					$templates->assgin('answer', $object->answer);
					$templates->assgin('username', $object->username);
					$templates->assgin('email', $object->email);
					$templates->assgin('id', $object->id);
					$templates->assgin('level_info', $object->level_info);

				}
				break;
			case 'add':
				$templates->assgin('title', '新增会员');
				break;
			case 'delete':
				if ($_GET['action'] == 'delete'){
					$this->model->id = $_GET['id'];
					if ($this->model->Delete_User()) {
						Tool::alertLocation('会员删除成功', PREV_URL);
					} else{
						Tool::alertBack('会员删除失败');
					}
				}
				break;
			default:
				echo '非法操作';
				break;
		}

	}
	
	//获取头像
		private function face($face){
			foreach (range(1, 24) as $value){
				if ('face/'.$value.'.gif' == $face ){
					$html .='<option selected="selected" value="face/'.$value.'.gif" class="text">face/'.$value.'.gif</option>';
				}else {
					$html .='<option value="face/'.$value.'.gif" class="text">face/'.$value.'.gif</option>';
				}
			}
			return $html;
		}
	//获取密保问题
	private function question($question){
		$array = array('','您父亲的名字','您母亲的名字','您配偶的生日');
		foreach ($array as $value){
			if ($value == $question){
				$html .='<option selected="selected">'.$value.'</option>';
			}else{
				$html .='<option >'.$value.'</option>';
			}
		}
	return $html;
	}
	
	//获取state
	private function state($state){
		$array = array(0=>'封杀会员',1=>'仅可以登入',2=>'初级会员',3=>'中级会员',4=>'高级会员',5=>'VIP会员');
		foreach ($array as $key=>$value){
			if ($key == $state){
				$html .='<input type="radio" name="state" class="radio" checked="checked" value="'.$key.'" />'.$value;
			}else {
				$html .='<input type="radio" name="state" class="radio" value="'.$key.'" />'.$value;
			}
	}
	return $html;
}

}
?>