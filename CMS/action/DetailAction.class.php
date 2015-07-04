<?php
//业务流程控制器
class DetailAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl);

	}
	
	public function Action(){
		$this->Get_List_Nav();
		$this->Get_Content();
		$this->Comment_Num();
		$this->Get_New_Three();
		$this->Show_Month();
		$this->sus_opp();
	}
	
	//设置list页面显示的主导航
	private  function Get_List_Nav(){
		if (isset($_GET['id'])){
			global $templates;
			$model = new NavModel();
			$model->id = $_GET['id'];
			$object = $model->Get_id_from_content();
			$templates->assgin('nav_name', $object->name);
		}else {
			Tool::alertBack('此导航不存在');
		}
	}
	
	//显示单个content
	private function Get_Content(){
		global $templates;
		$content  = new ContentModel();
		if(isset($_GET['id'])){
			$content->id = $_GET['id'];
			if (!$content->Detail_Count()) Tool::alertBack('警告：阅读量累计失败');
			$object = $content->Get_One_Content();
			$templates->assgin('title_id',$object->id);
			$templates->assgin('title_content',$object->title);
			$templates->assgin('count',$object->read_count);
			$templates->assgin('date',$object->date);
			$templates->assgin('source',$object->source);
			$templates->assgin('author',$object->author);
			$templates->assgin('info',$object->info);
			$templates->assgin('content',$object->content);

		}
	}
	//列出已有多少人评论
	private function Comment_Num(){
		global $templates;
		$comment = new CommentModel();
		$comment->cid = $_GET['id'];
		$templates->assgin('comment_num',$comment->Get_Commentnum());							//列出所有的评论数
	}
	
	//列出最新的三条评论
	private function Get_New_Three(){
		global $templates;
		$comment = new CommentModel();
		$comment->cid = $_GET['id'];
		$object = $comment->Get_New_Three();
		foreach ($object as $value){
			if (empty($value->face)){
				$value->face ='face/00.gif';
			}
		}
		$templates->assgin('New_Three',$object);
	}
	//支持和反对
	private function sus_opp(){
		$comment = new CommentModel();
		$comment->cid = $_GET['cid'];
		//支持
		if ($_GET['action']=='sustain'){
			$comment->sustain()?Tool::alertLocation('谢谢您的评价', 'feedback.php?cid='.$comment->cid ):Tool::alertBack('对不起，请重试');
		}
		//反对
		if ($_GET['action']=='oppose'){
			$comment->oppose()?Tool::alertLocation('谢谢您的评价', 'feedback.php?cid='.$comment->cid ):Tool::alertBack('对不起，请重试');
		}
	}
	
	//本月本类热点，推荐，图文
	private function Show_Month(){
		global $templates;
		$content = new ContentModel();
		$content->id = $_GET['id'];
		$parid = $content->Get_Par_Id();
		$content->nav = $parid->nav;
		//列出本月推荐
		$object_rec = $content->Month_Rec();
		if ($object_rec){
			foreach ($object_rec as $value){
				$value->title = Tool::Sub_Str($value->title, 15);
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
		}
		$templates->assgin('Month_Rec', $object_rec);								//注入模板，显示本月推荐
		
		//列出本月热点
		$object_hot = $content->Month_Hot();
		if ($object_hot){
			foreach ($object_hot as $value){
				$value->title = Tool::Sub_Str($value->title, 15);
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
		}
		$templates->assgin('Month_Hot', $object_hot);								//注入模板，显示本月热点
		
		//列出本月图文（含有图片的wenzha）
		$object_pic = $content->Month_Pic();
		if ($object_pic){
			foreach ($object_pic as $value){
				$value->title = Tool::Sub_Str($value->title, 15);
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
		}
		$templates->assgin('Month_pic', $object_pic);								//注入模板，显示本月热点
	}
	
}


?>