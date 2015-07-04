<?php
//业务流程控制器
class ListAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl);

	}
	
	public function Action(){
		$this->Get_List_Nav();
		$this->Get_Contentlist();
	}
	
	//设置list页面显示的主导航
	private  function Get_List_Nav(){
		if (isset($_GET['id'])){
			global $templates;
			$model = new NavModel();
			 $object = $model->Get_One_Nav();
			$child_object =  $model->selectchildNav_nolimit();
			 $templates->assgin('nav_name', $object->name);
			 $templates->assgin('nav_id', $object->id);
			 $templates->assgin('child_nav', $child_object);
			 $par_object = $model->Get_Parnav();
			 $templates->assgin('par_name', $par_object->name);
			 $templates->assgin('par_id', $par_object->id);
		}else {
			Tool::alertBack('此导航不存在');
		}
	}
	
	//显示文档
	private function Get_Contentlist(){
		global $templates;
		$content = new ContentModel();
		$nav = new NavModel();
		$nav->id = $_GET['id'];
		$object_child = $nav->selectchildNav_nolimit();			//根据父导航ld找到子导航
		foreach ($object_child as $value_child){
			$id[] = $value_child->id;
		}
		if ($object_child){
			$in =  implode(',', $id);
			$content->nav = $in;															//sQL语句中IN关键字
		}else {
			$content->nav = $_GET['id'];
		}
		$countArr = $content->Get_Contentlist();
		$count = $countArr->c;																	//得到记录数
		$page = new Page($count, PAGE_SIZE);
		$content->limit = $page->limit ;													//注入limit值
		$templates->assgin('page', $page->Show_Page_Num());	//显示分页
		$object = $content->Get_Content();											//获取所有的content
		foreach ($object as $value){
			$value->title = Tool::Sub_Str($value->title, 15);					//对title进行截取
			$value->info = Tool::Sub_Str($value->info, 120);				//对info进行截取
			if (empty($value->thumbnail)){
				$value->thumbnail = 'images/none.jpg';
			}
		}
		$templates->assgin('AllContent', $object);								//注入模板，显示content
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