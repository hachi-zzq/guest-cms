<?php
//业务流程控制器的基类，将经常调用的放进去，然后子类继承
class Action{
	public  $tpl;
	protected $model;
	
	protected function __construct($tpl,$model = NULL){
		$this->tpl = $tpl;
		$this->model = $model;
	}
	
	protected function Page($num){
		global $templates;
		$page = new Page($num, PAGE_SIZE);
		$this->model->limit = $page->limit ;
		$templates->assgin('page', $page->Show_Page_Num());
	}
	
}


?>