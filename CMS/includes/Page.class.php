<?php
//分页类
class Page{
	private $num;																													//总记录数
	private $pagesize;																										//每一页显示的记录
	private $limit;																												//用于显示数据 例如：limit 0,10.....
	private $page;																												//当前页码
	private $pagenum;																										//总页码
	private $url;
	private $bothnum;																										//数字分页两边显示的页数
	
	public function __construct($num,$pagesize){
		$this->num = $num;
		$this->pagesize = $pagesize;
		$this->url = $this->Set_Url();
		$this->pagenum =  ceil($this->num / $this->pagesize);
		$this->page = $this->Set_Page();
		$this->limit = "LIMIT ".($this->page - 1)*$this->pagesize.",$this->pagesize";
		$this->bothnum  =  2;
	}
	
	//拦截器,可是使外在的类访问设置本类中私有属性
	//__get()方法用来获取私有属性
	private function __get($value)	{
		if(isset($this->$value)){
			return($this->$value);
		}else{
			return(NULL);
		}
	}
	
	//__set()方法用来设置私有属性
	private function __set($key, $value)	{
		$this->$key = $value;
	}
	
	//用来限制页码数$_GET['page'] ,比如不能为空，字母，不能大于总页数
	private function Set_Page(){
		if (empty($_GET['page']) || $_GET['page'] < 0 ){
			return 1;
		}else if($_GET['page'] > $this->pagenum){
			return $this->pagenum;
		}else {
			return $_GET['page'];
		}
	}
	//数字分页
	private function Page_List(){
// 		for ($i=1;$i<=$this->pagenum;$i++){
// 			if ($i == $this->page){
// 				$pagelist .='<span class="me">'.$i.'</span>';
// 				continue;
// 			}
// 			$pagelist .= ' <a href="'.$this->url.'&page='.$i.'">'.$i.'</a>  ';
// 		}
		$pagelist .= ' <a href="'.$this->url.'">1</a> ...';																			//第一页
		for ($i=$this->page-$this->bothnum;$i<$this->page;$i++){													//当前页往前两页，2，3，4.。。。
  			if ( $this->page-$this->bothnum<=0) continue;
			$pagelist .= '<a href="'.$this->url.'&page='.$i.'">'.$i.'</a>  ';
		}
		$pagelist .= '<span class="me">'.$this->page.'</span>';															//当前页
		for ($i = $this->page+1;$i<=$this->page+$this->bothnum;$i++){											//当前页往后两页，4，5，6。。。
			if ($i>$this->pagenum-$this->bothnum+1) break;
			$pagelist .= ' <a href="'.$this->url.'&page='.$i.'">'.$i.'</a>  ';
		}
		$pagelist .= ' ....<a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a> ';
		return $pagelist;
	}
	//首页
	private function First_Page(){
		return ' <a href="'.$this->url.'">首页</a> ';
	}
	
	//上一页
	private function Pre_Page(){
		return ' <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a> ';
	}
	
	//下一页
	private function Next_Page(){
		return ' <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a> ';
	}

	//尾页
	private function End_Page(){
		return ' <a href="'.$this->url.'&page='.$this->pagenum.'">尾页</a> ';
	}
	//动态的显示url,因为有的页面不只是manage.php ,action=.....
	private function Set_Url(){
		$_uri = $_SERVER['REQUEST_URI'];
		$_par = parse_url($_uri);
		if (isset($_par['query'])) {
			parse_str($_par['query'],$_query);
			unset($_query['page']);
			$_uri = $_par['path'].'?'.http_build_query($_query);
		}
		return $_uri;                                                     											//打印出来的url是：/CMS/admin/manage.php?action=show 
	}
	
	
	//用来显示页码
	public function Show_Page_List(){
		return $this->Page_List();
	}
	
	public function Show_Page_Num(){
		return $this->page.'/'.$this->pagenum.'页'.$this->First_Page().$this->Pre_Page().$this->Next_Page().$this->End_Page();
	}
}


?>