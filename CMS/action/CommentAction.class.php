<?php
//业务流程控制器
class CommentAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new CommentModel());											//初始化父类，定义了ManageModel 的对象$model
	}
	
	public  function Action(){
		switch ($_GET['action']) {
			case 'show':
				$this->Comment_Show();
				break;
			case 'agree':
				$this->Agree();
				break;
			case 'del':
				$this->Comment_Del();
				break;
			case 'more_agree':
				$this->More_Agree();
				break;
			default:
				Tool::alertBack('非法操作');
				break;
		}

	}
	
	private function Comment_Show(){
		global $templates;
		$templates->assgin('title', '评论列表');
		$templates->assgin('show', true);
		parent::Page($this->model->All_Comment_Num());
		$object = $this->model->Get_ALL_List();
		if (!empty($object)){
			foreach ($object as $value){
				$value->content_full = $value->content;
				$value->content = Tool::Sub_Str($value->content, 50);
				if ($value->state ==0){
					$value->state_num = $value->state;
					$value->state = '<span style="color:red;">[未审核]</span>|<a href="comment.php?id='.$value->id.'&action=agree"><span style="color:blue;">通过</span></a>';
				}else if ($value->state ==1){
					$value->state_num = $value->state;
					$value->state = '<span style="color:blue">[已审核]</span>';
				}
			}
		}
		$templates->assgin('all_comment_list', $object);
	}
	
	private function Agree(){
		if (isset($_GET['id'])){
			$this->model->id = $_GET['id'];
			if ($this->model->Agree()){
				Tool::alertLocation(null, PREV_URL);
			}
		}else {
			Tool::alertBack('非法操作');
		}
	}
	
	//批量审核
	private function More_Agree(){
		$arr = $_POST['state'];
		foreach ($arr as $key=>$value){
			$sql .= "update comment set state ='$value' where id='$key';";
		}
		$mysqli = DB::getDB();
		$mysqli->multi_query($sql);
		Tool::alertLocation(null, PREV_URL);
	}
	
	private function Comment_Del(){
		if (isset($_GET['id']) && $_GET['action']=='del'){
			$this->model->id = $_GET['id'];
			if ($this->model->Del_Comment()) Tool::alertLocation('删除成功', PREV_URL);
		}
		
		
	}
	
	
}


?>