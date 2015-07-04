<?php
//业务流程控制器
class FeedBackAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl,new CommentModel()); 

	}
	
	public function Action(){
		$this->Add_Comment();
		$this->Get_ALLComment();
		$this->Get_title_info();
		$this->sus_opp();
		$this->Hot_Content();
	}
	
	//新增数据
	private function Add_Comment(){
// 		echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"].'?'.$_SERVER["QUERY_STRING"];
// 		echo '<br/>';
// 		echo PREV_URL;
		global $templates;
		if (isset($_POST['send'])){
			$url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"].'?'.$_SERVER["QUERY_STRING"];
			if ($url == PREV_URL){
				if (!Validate::Check_Equals($_SESSION['code'], $_POST['code'])) Tool::alertBack('验证码不正确，请重新输入');
				if (Validate::Check_Null($_POST['content'])) Tool::alertBack('内容不能为空');
			}else {
				if (!Validate::Check_Equals($_SESSION['code'], $_POST['code'])) Tool::alertClose('验证码不正确，请重新输入');
				if (Validate::Check_Null($_POST['content'])) Tool::alertClose('内容不能为空');
			}

			if (isset($_COOKIE['user'])){
				$this->model->username = $_COOKIE['user'];
			}else {
				$this->model->username = '游客';
			}
			$this->model->cid = $_GET['cid'];
			$this->model->manner = $_POST['manner'];
			$this->model->content = $_POST['content'];
			$templates->assgin('cid', $this->model->cid);
			
			if ($this->model->Add_Comment()){
				//添加评论成功后，开始更新content中的评论数
				$content = new ContentModel();
				$content->cid = $_GET['cid'];
				$content->Detail_Comment();
				Tool::alertLocation('评论成功', 'feedback.php?cid='.$this->model->cid);
			}else {
				Tool::alertLocation('评论失败', 'feedback.php?cid='.$this->model->cid);
				}
    		}	
			
		}

	//获取所有的评论,注入模板
	private function Get_ALLComment(){
		global $templates;
		$this->model->cid = $_GET['cid'];
		parent::Page($this->model->Get_Commentnum());
		$object =  $this->model->Get_All();
		foreach ($object as $value){
			if (empty($value->face)){
				$value->face ='face/00.gif';
			}
		}
		$templates->assgin('all_comment', $object);
		$templates->assgin('cid', $this->model->cid);
	}
	
	//在评论页获取到这个文档的标题和简介
	private function Get_title_info(){
		global $templates;
		$this->model->cid = $_GET['cid'];
		$object =$this->model->Get_Title_Info();
		$templates->assgin('feed_object', $object);
		$templates->assgin('feed_title', $object->title);
		$templates->assgin('feed_info', $object->info);
	}
	//支持和反对
	private function sus_opp(){
		$this->model->cid = $_GET['cid'];
		$this->model->id = $_GET['id'];
		//支持
		if ($_GET['action']=='sustain'){
			$this->model->sustain()?Tool::alertLocation('谢谢您的评价', 'feedback.php?cid='.$this->model->cid ):Tool::alertBack('对不起，请重试');
		}
		//反对
		if ($_GET['action']=='oppose'){
			$this->model->oppose()?Tool::alertLocation('谢谢您的评价', 'feedback.php?cid='.$this->model->cid ):Tool::alertBack('对不起，请重试');
		}
	}
	//火热文档
	private function  Hot_Content(){
		global $templates;
		$content = new ContentModel();
		$object = $content->Hot_Content();
		foreach ($object as $value){
			$value->date = substr($value->date, 5,5);
			$value->title = Tool::Sub_Str($value->title, 15);
		}
		$templates->assgin('hot_content', $object);
	}
	
}


?>