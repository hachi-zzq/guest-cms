<?php
//业务流程控制器
class SearchAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl,new ContentModel());

	}
	
	public function Action(){
		if (isset($_GET['type'])){
			switch ($_GET['type']){
				case 1:
					$this->Search_Title();
					break;
				case 2:
					$this->Search_Keyword();
					break;
				case 3:
					$this->Search_Tag();
				break;
				default:
					Tool::alertClose('非法操作');	
			}
		}
	}
	
	//title搜索
	private function Search_Title(){
		global $templates;
		if (empty($_GET['input_keyword'])) Tool::alertClose('关键字不能为空');
		$this->model->input_keyword = $_GET['input_keyword'];
		parent::Page($this->model->Search_Title_Num()->c_count);
		$object = $this->model->Search_Title();
		foreach ($object as $value){
			if (empty($value->thumbnail)){
				$value->thumbnail = 'images/none.jpg';
			}
		$value->title =  str_replace($_GET['input_keyword'], '<span style="color:red;">'.$_GET['input_keyword'].'</span>', $value->title);
		}
		$templates->assgin('search', $object);
	}
	
	//关键字搜索
	private function Search_Keyword(){
		global $templates;
		if (empty($_GET['input_keyword'])) Tool::alertClose('关键字不能为空');
		$this->model->input_keyword = $_GET['input_keyword'];
		$object = $this->model->Search_Keyword();
		foreach ($object as $value){
			if (empty($value->thumbnail)){
				$value->thumbnail = 'images/none.jpg';
			}
			$value->title =  str_replace($_GET['input_keyword'], '<span style="color:red;">'.$_GET['input_keyword'].'</span>', $value->title);
		}
		$templates->assgin('search', $object);
	}
	
	//Tag搜索
	private function Search_Tag(){
		global $templates;
		if (empty($_GET['input_keyword'])) Tool::alertClose('关键字不能为空');
		$this->model->input_keyword = $_GET['input_keyword'];
		$object = $this->model->Search_Tag();
		foreach ($object as $value){
			if (empty($value->thumbnail)){
				$value->thumbnail = 'images/none.jpg';
			}
			$value->title =  str_replace($_GET['input_keyword'], '<span style="color:red;">'.$_GET['input_keyword'].'</span>', $value->title);
		}
		$templates->assgin('search', $object);
	}
	
}


?>