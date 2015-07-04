<?php
//文件上传类
class FileUpload{
	private $file;
	private $error;
	private $type;
	private $name;
	private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
	private $path;																												//上传文件根目录
	private $child_path;																										//用于设置子文件夹名字
	private $new_name;																									//新的文件名
	private $tmp_name;																									//临时文件
	
	
	public function __construct($file){
		$this->file = $file;
		$this->error = $_FILES[$file]['error'];
		$this->type = $_FILES[$file]['type'];
		$this->name = $_FILES[$file]['name'];
		$this->tmp_name =$_FILES[$file]['tmp_name'];
		$this->path = ROOT_PATH.UP_DIR;
		$this->child_path = $this->path.date('Ymd',time()).'/';
		$this->Check_Type();
		$this->Check_Error();
		$this->Check_Path();
		$this->Set_Newname();
		$this->Move_File();
	}
	
	
	//检查上传是否出错
	private function Check_Error(){
		if (!empty($this->error)){
			switch ($this->error) {
				case 1:
				Tool::alertBack('警告：文件大小超出php.ini约定值');
				break;
				case 2:
				Tool::alertBack('警告：文件的大小超过了表单约束值');
				break;
				case 3:
					Tool::alertBack('警告：文件只有部分别被上次');
					break;
				case 4:
					Tool::alertBack('警告：没有任何文件被上传');
					break;
				default:
					Tool::alertBack('警告：未知错误');
				break;
			}
		}
	}
	
	//检查上传文件类型是否合法
	private function Check_Type(){
		if (!in_array($this->type, $this->typeArr)){
			Tool::alertBack('文件格式不合法');
		}
	}
	
	//检查目录是否合法
	private function Check_Path(){
		if (!is_dir($this->path)){
			mkdir($this->path);
		}
		if(!is_dir($this->child_path)){
			mkdir($this->child_path);
		}
	}
	
	//设置新的文件名
	private function Set_Newname(){
		$name_array = explode('.', $this->name);
		$extension = $name_array[count($name_array)-1];													//获得文件的扩展名
		return $this->new_name = date('YmdHim'). mt_rand(100, 1000).'.'.$extension;																		
	}
	
	//移动文件到相应目录
	private function Move_File(){
		if (is_uploaded_file($this->tmp_name)){
			if (!move_uploaded_file($this->tmp_name, $this->child_path.$this->new_name)){
				Tool::alertBack('警告：文件移动失败');
			}
		}else {
			Tool::alertBack('警告：临时文件不存在');
		}
	}
	
	//对外公开，反正这个文件的路径,(绝对路径)
	public function Get_Path(){
		return $this->child_path.$this->new_name;
	}
	
	//对外公开，返回这个文件的(相对路径)
	public function Get_Link_Path(){
		return dirname(dirname($_SERVER['SCRIPT_NAME'])).'/'.UP_DIR.date('Ymd',time()).'/'.$this->new_name;
	}
}


?>