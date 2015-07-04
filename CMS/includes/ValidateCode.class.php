<?php
//验证码类
class ValidateCode{
	private $charset='abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';				//随机因子
	private $code;
	private $code_len = 4;																																	//验证码长度
	private $width= 130;
	private $height=50;
	private $img;																																					//验证码资源句柄
	private $font;
	private $font_size = 20;
	private $font_color ;
	
	public function __construct(){
		$this->font = ROOT_PATH.'font/elephant.ttf';																				//设置字体
	}
	
	//生成四位随机数
	private   function Create_Code(){
		$len = strlen($this->charset);
		for ($i=0;$i<$this->code_len;$i++){
			$this->code .=$this->charset[mt_rand(0, $len-1)];
		}
		return $this->code;
	}
	
	//生成画布
	private function Create_bg(){
		$this->img = imagecreatetruecolor($this->width, $this->height);										//生成画布
		$color = imagecolorallocate($this->img, mt_rand(127, 255), mt_rand(127, 255), mt_rand(127, 255));																		//设置颜色
		imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);					//为画布填充背景颜色
	}
	//生成文字，长度各占1/4，高度居中，指定的字体，指定的大小，随机颜色，随机倾斜度等等
	private function Create_Font(){
		$this->font_color = imagecolorallocate($this->img, mt_rand(0, 126), mt_rand(0, 126), mt_rand(0, 126));
		for ($i=0;$i<$this->code_len;$i++){
			imagettftext($this->img, $this->font_size,mt_rand(-30, 30),$this->width/4*$i+mt_rand(0, 5), $this->height/1.5, $this->font_color, $this->font, $this->code[$i]);
		}
	}
	//生成线条
	private function Create_Line(){
		for ($i=0;$i<6;$i++) {
			$color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imageline($this->img,mt_rand(0,$this->width),
			mt_rand(0,$this->height),mt_rand(0,$this->width),
			mt_rand(0,$this->height),$color);
		}
	}
	//输出验证码图像
	public function Show_Img(){
		header('Content-type:image/png');
		$this->Create_Code();
		$this->Create_bg();
		$this->Create_Font();
		$this->Create_Line();
		imagepng($this->img);
		imagedestroy($this->img);
	}
	
	//输出验证码，用于生成session 和 验证，和上面的输出验证码图像不一样
	
	public function Get_Code(){
		return strtolower($this->code);															//转换为小写的字母
	}
}


?>