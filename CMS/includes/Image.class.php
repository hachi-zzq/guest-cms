<?php
class Image{
	private $file;													//图像地址,
	private $img;													//图片的资源句柄
	private $new_img;										//新图的资源句柄
	private $width;												//图像宽度
	private $height;										
	private $type;
	
	public function __construct($file){
		$this->file = $file;
		list($this->width,$this->height,$this->type) = getimagesize($this->file);
		$this->img = $this->Get_Img($this->file, $this->type);
	}
	//获取资源句柄，因为不知道图片的格式
	private function Get_Img($file,$type){
		switch ($type) {
			case 1:
				$img = imagecreatefromgif($file);
			break;
			case 2:
				$img = imagecreatefromjpeg($file);
			break;
			case 3:
				$img = imagecreatefrompng($file);
			default:
				Tool::alertBack('图片格式不支持');
			break;
		}
	return $img;	
	}
	//缩略图（固定长高缩放）
	public  function Thumb($new_width,$new_height){
		//创建一个容器
		$_n_w = $new_width;
		$_n_h = $new_height;
		
		//创建裁剪点
		$_cut_width = 0;
		$_cut_height = 0;
		
		if ($this->width < $this->height) {
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_height = ($new_width / $this->width) * $this->height;
		}
	
		
		if ($new_width < $_n_w) { //如果新高度小于新容器高度
			$r = $_n_w / $new_width; //按长度求出等比例因子
			$new_width *= $r; //扩展填充后的长度
			$new_height *= $r; //扩展填充后的高度
			$_cut_height = ($new_height - $_n_h )/ 2; //求出裁剪点的高度
		}
		
		if ($new_height < $_n_h) { //如果新高度小于容器高度
			$r = $_n_h / $new_height; //按高度求出等比例因子
			$new_width *= $r; //扩展填充后的长度
			$new_height *= $r; //扩展填充后的高度
			$_cut_width = ($new_width - $_n_w) / 2; //求出裁剪点的长度
		}
			
		
		$this->new_img = imagecreatetruecolor($_n_w,$_n_h);
		imagecopyresampled($this->new_img,$this->img,0,0,$_cut_width,$_cut_height,$new_width,$new_height,$this->width,$this->height);
	}
	
	//给图片加上水印
	public function Water(){
		$water = imagecreatefrompng('../2.png');
		list($water_width,$water_heigth) = getimagesize('../2.png');
		imagecopy($this->new_img, $water, 10, 10, 0, 0, $water_width, $water_heigth);
	}
	
	
	//cke专用图像处理
	public function Ck_Up($new_width = 0,$new_height = 0) {
		if (empty($new_width) && empty($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
	
		if (!is_numeric($new_width) || !is_numeric($new_height)) {
			$new_width = $this->width;
			$new_height = $this->height;
		}
	
		if ($this->width > $new_width) { //通过指定长度，获取等比例的高度
			$new_height = ($new_width / $this->width) * $this->height;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}
	
		if ($this->height > $new_height) { //通过指定高度，获取等比例长度
			$new_width = ($new_height / $this->height) * $this->width;
		} else {
			$new_width = $this->width;
			$new_height = $this->height;
		}
	
		$this->new_img = imagecreatetruecolor($new_width,$new_height);
		imagecopyresampled($this->new_img,$this->img,0,0,0,0,$new_width,$new_height,$this->width,$this->height);
	}
	
	//用于输出图像
	public  function Out(){
		imagepng($this->new_img,$this->file);
		imagedestroy($this->new_img);
		imagedestroy($this->img);
	}
	
	
}


?>