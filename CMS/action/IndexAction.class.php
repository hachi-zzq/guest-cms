<?php 
class IndexAction extends Action{

	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl);											//初始化父类
	}

	public function Action(){
		$this->Login_Or_No();
		$this->Get_Last_User();
		$this->Get_Rec();
		$this->Get_Hot();
		$this->Get_Comment();
		$this->Get_Pic_Doc();
		$this->Get_Top_Ten();
		$this->Get_Top_One();
		$this->Get_Top_twofive();
		$this->Get_All_Rotatain();
		$this->Get_Four();
	}
	
	
	//判断是否已经登入，用于首页的登入
	private function Login_Or_No(){
		global $templates;
		if (isset($_COOKIE['user'])){
			$templates->assgin('user', $_COOKIE['user']);
			$templates->assgin('face', $_COOKIE['face']);
		}else {
			$templates->assgin('login', true);
		}
	}
	
	//列出最近登入的六个会员
	private function Get_Last_User(){
		global $templates;
		$user = new UserModel();
		$row = $user->Get_Last_User();
		$templates->assgin('Last_User', $row);
	}
	
	//列出特别推荐
	private function Get_Rec(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Rec();
			foreach ($object as $value){
				$value->title = Tool::Sub_Str($value->title, 15);					//对title进行截取
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
		$templates->assgin('index_rec', $object);
	}
	
	//列出特别热点
	private function Get_Hot(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Hot();
			foreach ($object as $value){
				$value->title = Tool::Sub_Str($value->title, 15);					//对title进行截取
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
		$templates->assgin('index_hot', $object);
	}
	
	//列出本月评论
	private function Get_Comment(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Comment();
		foreach ($object as $value){
			$value->title = Tool::Sub_Str($value->title, 15);					//对title进行截取
			$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
		}
		$templates->assgin('index_comment', $object);
	}
	
	//列出图文资讯，四条
	private function Get_Pic_Doc(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Pic_Doc();
		$templates->assgin('index_pic_doc', $object);
	}
	
	//列出最新头条十条
	private function Get_Top_Ten(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Top_Ten();
		foreach ($object as $value){
			$value->title = Tool::Sub_Str($value->title, 25);					//对title进行截取
			$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
		}
		$templates->assgin('index_top_ten', $object);
	}
	
	//列出头条一条
	private function Get_Top_One(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Top_One();
		$object->title = Tool::Sub_Str($object->title, 15);
		$object->info = Tool::Sub_Str($object->info, 80);
		$templates->assgin('index_top_title', $object->title);
		$templates->assgin('index_top_id', $object->id);
		$templates->assgin('index_top_info', $object->info);
	}
	
	//列出头2-5条
	private function Get_Top_Twofive(){
		global $templates;
		$content =  new ContentModel();
		$object = $content->Index_Top_Twofive();
		foreach ($object as $value){
			$value->title = Tool::Sub_Str($value->title, 13);					//对title进行截取
		}
		$templates->assgin('index_top_onefive', $object);
	}
	
	//列出所有的轮播器
	private function Get_All_Rotatain(){
		$rotatain =  new RotatainModel();
		$object = $rotatain->All_Index_Rotatain();
		foreach ($object as $value){
			$str .= "<item item_url='".$value->pic."'  link='".$value->link."'  itemtitle=''></item>\n";
		}
		$xml = '<?xml version="1.0" encoding="utf-8"?>'."\n".'<bcaster autoPlayTime=\'3\'>'."\n".''.$str.'</bcaster>';
		$fp = fopen('bcastr.xml', 'w');
		fwrite($fp, $xml);
	}
	
	//列出四个类别
	private function Get_Four(){
		global $templates;
		$content = new ContentModel();
		$object = $content->Index_Four();
		$i = 1;
		foreach ($object as $value){
			if ($i % 2 ==0){
				$value->class ='list right bottom';
			}else{
				$value->class ='list bottom';
			}
			$content->nav = $value->id;
			$object_list = $content->Index_Four_list();
			$value->list = $object_list;
			foreach ($object_list as $value){
				$value->title = Tool::Sub_Str($value->title, 20);					//对title进行截取
				$value->date = date('m-d',strtotime($value->date));	//将时间格式转换一下
			}
			$i++;
		}

		$templates->assgin('index_four', $object);
	}
	
	
	
	
	
	
	
	
}
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         