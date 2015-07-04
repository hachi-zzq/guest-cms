<?php
//业务流程控制器
class ContentAction extends Action{
	
	public function __construct($tpl){																		//构造方法 初始化
		global $templates;
		parent::__construct($tpl, new ContentModel());										//初始化父类，定义了ManageModel 的对象$model
	}
	
	public  function Action(){
		global $templates;
		switch ($_GET['action']) {
			case 'show':
				$templates->assgin('title', '文档列表');
				$templates->assgin('show', true);
				$nav = new NavModel();
				$id = $nav->Get_All_Childid();
				foreach ($id as $value){
					$arr[] = $value->id;
				}
				$nav_id = implode(',', $arr);		
				$content = new ContentModel();
				$content->nav = $nav_id;
				$templates->assgin('Show_Content', $content->Get_Content());			//显示所有的content
				$this->Nav();																												//显示所有的导航，select标签
				
				if (isset($_GET['nav']) && $_GET['send'] =='刷选'){										//开始刷选
					if ($_GET['nav'] != 0){																							//不为零
						$content->nav = $_GET['nav'];
					}else {
						$content->nav = $nav_id;																					//为零的话，默认全部
					}
					$templates->assgin('Show_Content', $content->Get_Content());			//显示所有的content
				}
				
				break;
			case 'update':
				if ($_POST['send'] == '修改文档'){
					$this->model->id = $_POST['id'];
					$this->Get_Post();
					$this->model->Update_Content() ? Tool::alertLocation('文档修改成功', 'content.php?action=show') : Tool::alertBack('文档修改失败');
					
				}
				$templates->assgin('title', '修改文档');
				$templates->assgin('update', true);
				if (isset($_GET['id'])){
					$content = new ContentModel();
					$content->id = $_GET['id'];
					$object = $content->Get_One_Content();
					if (!$object) Tool::alertBack('文档不存在');
					$templates->assgin('titlec', $object->title);
					$this->attr($object->attr);
					$this->Nav($object->nav);
					$this->readlimit($object->read_limit);
					$this->color($object->color);
					$this->sort($object->sort);
					$this->commend($object->commend);
					$templates->assgin('id', $object->id);
					$templates->assgin('tag', $object->tag);
					$templates->assgin('keyword', $object->keyword);
					$templates->assgin('thumbnail', $object->thumbnail);
					$templates->assgin('source', $object->source);
					$templates->assgin('author', $object->author);
					$templates->assgin('info', $object->info);
					$templates->assgin('content', $object->content);
					$templates->assgin('read_count', $object->read_count);
					$templates->assgin('gold', $object->gold);
					$templates->assgin('color', $object->color);
				}else {
					Tool::alertBack('非法操作');
				}
				
				break;
			case 'add':
				if (isset($_POST['send'])){
					$this->Get_Post();
					$affect = $this->model->Add_Content();
					if ($affect == 1){
						Tool::alertLocation('添加文档成功', '?action=show');
					}else {
						Tool::alertBack('警告：文档添加失败');
					}
				}
				$templates->assgin('title', '新增文档');
				$templates->assgin('add', true);
				$this->Nav();
				break;
			case 'delete':
				if (isset($_GET['id'])){
					$this->model->id = $_GET['id'];
					$this->model->Delete_Content() ? Tool::alertLocation('文档删除成功', 'content.php?action=show') :Tool::alertBack('文档删除失败');
				}
				
				break;
			default:
				echo '非法操作';
				break;
		}

	}
	
	private function Nav($n = 0){
		global $templates;
		$nav = new NavModel();
		$object = $nav->Show_Nav();												//查询出所有的主导航
		foreach ($object as $value){													//循环出所有的主导航以及自导航，使用分组
			$html .='<optgroup label="'.$value->name.'">';
			$nav->id = $value->id;
			$object_child = $nav->selectchildNav_nolimit();
			foreach ($object_child as $value_chlid){
				if (($value_chlid->id) == $n){
					$html .='<option selected="selected" value="'.$value_chlid->id.'">'.$value_chlid->name.'</option>\r\n';
				}else { 
					$html .='<option value="'.$value_chlid->id.'">'.$value_chlid->name.'</option>';
				}
			}
			$html .='</optgroup>';
		}
		
		$templates->assgin('nav', $html);
	}
	
	//attr的checkbox
	private function attr($attr){
		global $templates;
		$attrArr = array('头条','推荐','加粗','跳转');
		$array = explode(',', $attr);
		$attrNo = array_diff($attrArr, $array);
		foreach ($array as $value){
			$html .='<input type="checkbox" checked="checked" name="attr[]" value="'.$value.'" />'.$value;
		}
			foreach ($attrNo as $value){
			$html .='<input type="checkbox"  name="attr[]" value="'.$value.'" />'.$value;
			}
		$templates->assgin('attr', $html);
	}

	//commend
	private function commend($commend){
		global $templates;
		$array = array(1=>'允许评论',0=>'禁止评论');
		foreach ($array as $key=>$value){
			if ($key == $commend){
				$html .='<input type="radio" name="commend" value="'.$key.'" checked="checked" />'.$value;
			}else {
				$html .='<input type="radio" name="commend" value="'.$key.'" />'.$value;
			}
		}
		$templates->assgin('commend', $html);
	}
	//readlimit
	private function readlimit($_readlimit) {
		global $templates;
		$_readlimitArr = array(0=>'开放浏览',1=>'初级会员',2=>'中级会员',3=>'高级会员',4=>'VIP会员');
		foreach ($_readlimitArr as $_key=>$_value) {
			if ($_key == $_readlimit) $_selected='selected="selected"';
			$_html .= '<option '.$_selected.' value="'.$_key.'"'.$_key.';">'.$_value.'</option>';
			$_selected = '';
		}
		$templates->assgin('read_limit',$_html);
	}
	
	
	//color
	private function color($_color) {
		global $templates;
		$_colorArr = array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
		foreach ($_colorArr as $_key=>$_value) {
			if ($_key == $_color) $_selected='selected="selected"';
			$_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
			$_selected = '';
		}
		$templates->assgin('colorc',$_html);
	}
	
	
	//sort
	private function sort($_sort) {
		global $templates;
		$_sortArr = array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周',3=>'置顶一月',4=>'置顶一年');
		foreach ($_sortArr as $_key=>$_value) {
			if ($_key == $_sort) $_selected='selected="selected"';
			$_html .= '<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
			$_selected = '';
		}
		$templates->assgin('sort',$_html);
	}
	
	//获取post发送过来的值，用于add和update
	private function Get_Post(){
		//首先要验证数据
		if (Validate::Check_Null($_POST['title'])) Tool::alertBack('标题不能为空');
		if (Validate::Check_Length($_POST['title'], 5, 'min')) Tool::alertBack('标题长度不得小于五位');
		if (Validate::Check_Length($_POST['title'], 50, 'max')) Tool::alertBack('标题长度不得大于五十位');
		if (Validate::Check_Null($_POST['nav'])) Tool::alertBack('必须选择一个栏目');
		if (Validate::Check_Length($_POST['tag'], 20, 'max')) Tool::alertBack('标签不得超过二十位');
		if (Validate::Check_Length($_POST['keyword'], 20, 'max')) Tool::alertBack('关键字不得超过二十位');
		if (Validate::Check_Length($_POST['source'], 20, 'max')) Tool::alertBack('文章来源不得超过二十位');
		if (Validate::Check_Length($_POST['author'], 20, 'max')) Tool::alertBack('作者不得超过二十位');
		if (Validate::Check_Length($_POST['info'], 200, 'max')) Tool::alertBack('内容简介不得超过二百位');
		if (Validate::Check_Null($_POST['content'])) Tool::alertBack('正文不能为空');
		if (!Validate::Check_Num($_POST['read_count'])) Tool::alertBack('浏览数必须是数字');
		if (!Validate::Check_Num($_POST['gold'])) Tool::alertBack('消费金币必须是数字');
		$this->model->title = $_POST['title'];
		$this->model->nav = $_POST['nav'];
		if (isset($_POST['attr'])){
			$this->model->attr =  implode(',', $_POST['attr']);
		}
		$this->model->tag = $_POST['tag'];
		$this->model->keyword = $_POST['keyword'];
		$this->model->thumbnail = $_POST['thumbnail'];
		$this->model->source = $_POST['source'];
		$this->model->author = $_POST['author'];
		$this->model->info = $_POST['info'];
		$this->model->content = $_POST['content'];
		$this->model->commend = $_POST['commend'];
		$this->model->read_count = $_POST['read_count'];
		$this->model->sort = $_POST['sort'];
		$this->model->gold = $_POST['gold'];
		$this->model->read_limit = $_POST['read_limit'];
		$this->model->color = $_POST['color'];
	}
	
	
}


?>