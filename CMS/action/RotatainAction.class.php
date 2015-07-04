<?php
//业务流程控制器
class RotatainAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		parent::__construct($tpl, new RotatainModel());										//初始化父类，定义了ManageModel 的对象$model
	} 
	
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				$this->Show_Rotatain();
				break;
			case 'update_on':
			$this->Update_On();
				break;
				case 'update_off':
					$this->Update_Off();
					break;
			case 'add':
			$this->Add_Rotatain();
				break;
			case 'del':
			$this->Del_Rotatain();
				break;
				default:
			Tool::alertBack('非法操作');
		}

	}
	
	//显示轮播器
	private function Show_Rotatain(){
		global $templates;
		$templates->assgin('title', '轮播器列表');
		$templates->assgin('show',true);
		$rotatain = new RotatainModel();
		$all_rotatain = $rotatain->All_Rotatain();
		foreach ($all_rotatain as $value){
			if ($value->title == null){
				$value->title = '未设置标题';
			}
			if ($value->link == null){
				$value->link = '未设置链接';
			}
			if ($value->info == null){
				$value->info = '暂无此信息';
			}
			if ($value->state == 0){
				$value->state = '<span style="color:red;">未启用</span>|<a href="rotatain.php?action=update_on&id='.$value->id.'">点击启用</a>';
			}elseif ($value->state == 1){
				$value->state = '<span style="color:green;">已启用</span>|<a href="rotatain.php?action=update_off&id='.$value->id.'">点击取消</a>';
			}
		}
		$templates->assgin('all_rotatain', $all_rotatain);
	}

	//启用轮播器
	private function Update_On(){
		if (isset($_GET['action'])){
			$this->model->id = $_GET['id'];
			if ($this->model->Rotatain_On()) Tool::alertLocation(null, PREV_URL);
		}
	}	

	//关闭轮播器
	private function Update_Off(){
		if (isset($_GET['action'])){
			$this->model->id = $_GET['id'];
			if ($this->model->Rotatain_Off()) Tool::alertLocation(null, PREV_URL);
		}
	}
	//增加轮播器
	private function Add_Rotatain(){
		global $templates;
		$templates->assgin('title', '新增轮播器');
		$templates->assgin('add', true);
		if(isset($_GET['add_rotatain'])){
			$rotatain = new  RotatainModel();
			$rotatain->title = $_POST['title'];
			$rotatain->pic = $_POST['thumbnail'];
			$rotatain->link = $_POST['link'];
			$rotatain->info = $_POST['info'];
			if ($rotatain->Add_Rotatain()) Tool::alertLocation('新增轮播器成功', PREV_URL);
		}
	}
	
	//删除轮播器
	private function Del_Rotatain(){
		$rotatain = new RotatainModel();
		$rotatain->id = $_GET['id'];
		if ($rotatain->Del_Rotatain()) Tool::alertLocation('删除成功', PREV_URL);
	}
	
	
	
}


?>