<?php
	//定义模板类

	class Templates{
		private $vars = array();																				//存放注入的变量
		private $config = array();																			//存放系统变量
		public function __construct(){																	//首先定义构造方法，检查各个目录是否存在		
			if (!is_dir(ROOT_PATH.'cache') ||!is_dir(ROOT_PATH.'templates') ||!is_dir(ROOT_PATH.'templates_c')){
				exit('目录不完整');
			}
			
			$sxe = simplexml_load_file(ROOT_PATH.'config/config.xml');							//读取系统变量的xml
			$tag = $sxe->xpath('/root/tag');
			$config = array();
			foreach ($tag as $value){
				$this->config["$value->name"] = $value->value;						
			}
		}
			
	public function assgin($var,$value){														//创建一个注入方法
			if (isset($var) && !empty($var)){
				$this->vars[$var] = $value;														//这样就生成了一个诸如 vars['name'] = '樱桃小丸子'
			}
	}
	
	public function display($file){																		//定义方法，用于载入模板文件,生成编译文件	
		$tpl = $this;

		$tplfile = TPL_DIR.$file;																			//设置模板文件的路径
		if (!file_exists($tplfile)){
			exit('模板文件不存在');
		}
		//在生成编译文件之前，首先要解析它，将它用Parser类进行解析
		$parfile = TPL_C_DIR.md5($tplfile).$file.'.php';														//设置编译文件的文件名
		$cacheFile = CACHE_DIR.md5($file).$file.'.html';													//设置缓存文件的文件名
		if (!empty($_SERVER["QUERY_STRING"])) {
			$cacheFile .= $_SERVER["QUERY_STRING"];
		}
		//如果是第二次访问，那么跳过编译步骤，直接访问缓存文件
		if (IS_CACHE){
			if (file_exists($cacheFile) && file_exists($parfile)){
				if (filemtime($parfile)>=filemtime($tplfile) && filemtime($cacheFile) >= filemtime($parfile)){
					require $cacheFile;
					return ;																														//停止执行
				}
			}
		}
		
		$parser = new Parser($tplfile);//
		if (!file_exists($parfile) || filemtime($parfile) < filemtime($tplfile)){
			$parser->compile($parfile);																							//生成编译文件
		}
		require $parfile;																									//载入编译文件，这是解析后的编译文件
		if (IS_CACHE){																											//如果开启缓存的话
			file_put_contents($cacheFile, ob_get_contents());									//将缓存写入缓存文件
			ob_end_clean();																										//清除缓存（清除了编译文件加载的内容）
			require $cacheFile;
		}																
	}
		//定义一个方法，专门给模块使用，让模块不生成缓存
		//创建create方法，用于header和footer这种模块模板解析使用，而不需要生成缓存文件
	public function create($_file) {
		//设置模板的路径
		$_tplFile = TPL_DIR.$_file;
		//判断模板是否存在
		if (!file_exists($_tplFile)) {
			exit('ERROR：模板文件不存在！');
		}
		//编译文件
		$_parFile = TPL_C_DIR.md5($_file).$_file.'.php';
		//当编译文件不存在，或者模板文件修改过，则生成编译文件
		if (!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
			//引入模板解析类
			require_once ROOT_PATH.'/includes/Parser.class.php';
			$_parser = new Parser($_tplFile);   //模板文件
			$_parser->compile($_parFile);  //编译文件
		}
		//载入编译文件
		include $_parFile;
	}

}
?>