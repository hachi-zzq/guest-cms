<?php
	//定义解析类
	class Parser{
		public $tpl;																											   //用于存放接收的模板文件
				
		public function __construct($tpl){ 																	//定义一个构造方法，接受模板文件
			$this->tpl = file_get_contents($tpl);
		}
				
		private function parVar(){																					//创建一个方法，用于解析模板文件的变量		
 			$pattern =  '/\{\$([\w]+)\}/';
			if (preg_match($pattern,$this->tpl)){														//如果能查找到，开始替换
				$this->tpl =  preg_replace($pattern,"<?php echo \$this->vars['$1'];?>", $this->tpl);
			}
		}
		
		//解析if语句
	private function parIf() {
		$_pattenIf = '/\{if\s+\$([\w]+)\}/';
		$_pattenEndIf = '/\{\/if\}/';
		$_pattenElse = '/\{else\}/';
		if (preg_match($_pattenIf,$this->tpl)) {
			if (preg_match($_pattenEndIf,$this->tpl)) {
				$this->tpl = preg_replace($_pattenIf,"<?php if (\$this->vars['$1']) {?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenElse,$this->tpl)) {
					$this->tpl = preg_replace($_pattenElse,"<?php } else { ?>",$this->tpl);
				}
			} else {
				exit('ERROR：if语句没有关闭！');
			}
		}
	}
		
	//解析if语句
	private function parIff() {
		$_pattenIf = '/\{if\s+\@([\w\-\>]+)\}/';
		$_pattenEndIf = '/\{\/if\}/';
		$_pattenElse = '/\{else\}/';
		if (preg_match($_pattenIf,$this->tpl)) {
			if (preg_match($_pattenEndIf,$this->tpl)) {
				$this->tpl = preg_replace($_pattenIf,"<?php if (\$this->vars['$1']) {?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenElse,$this->tpl)) {
					$this->tpl = preg_replace($_pattenElse,"<?php } else { ?>",$this->tpl);
				}
			} else {
				exit('ERROR：if语句没有关闭！');
			}
		}
	}
			 private function parforeach(){																										//解析foreach语句
			 	//搜索foreach语句里的变量
			 	$_pattenVar = '/\{\@([\w]+)([\w->]*)\}/';
			 	//搜索foreach语句的结尾
			 	$_pattenEndForeach = '/\{\/foreach\}/';
			 	//搜索foreach语句的
			 	$_pattenFirstForeach = '/\{foreach\s+\$([\w]+)\(([\w]+)\,([\w]+)\)\}/';
			 	//搜索foreach开始语句	
			 	if (preg_match($_pattenFirstForeach,$this->tpl)) {
			 		//搜索foreach结束语句
			 		if (preg_match($_pattenEndForeach,$this->tpl)) {
			 			$this->tpl = preg_replace($_pattenVar,"<?php echo \$$1\$2; ?>",$this->tpl);
			 			$this->tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->tpl);
			 			$this->tpl = preg_replace($_pattenFirstForeach,"<?php foreach(\$this->vars['$1'] as \$$2=>\$$3) { ?>",$this->tpl);
			 		} else {
			 			exit('ERROR：没有发现foreach闭合语句！');
			 		}
			 	}
			 }
			 
			 
			 //解析foreach嵌套循环
			 private function parfor(){																										//解析foreach语句
			 	//搜索foreach语句里的变量
			 	$_pattenVar = '/\{\@([\w]+)([\w->]*)\}/';
			 	//搜索foreach语句的结尾
			 	$_pattenEndForeach = '/\{\/for\}/';
			 	//搜索foreach语句的
			 	$_pattenFirstForeach = '/\{for\s+\@([\w\-\>]+)\(([\w]+)\,([\w]+)\)\}/';
			 	//搜索foreach开始语句
			 	if (preg_match($_pattenFirstForeach,$this->tpl)) {
			 		//搜索foreach结束语句
			 		if (preg_match($_pattenEndForeach,$this->tpl)) {
			 			$this->tpl = preg_replace($_pattenVar,"<?php echo \$$1\$2; ?>",$this->tpl);
			 			$this->tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->tpl);
			 			$this->tpl = preg_replace($_pattenFirstForeach,"<?php foreach(\$$1 as \$$2=>\$$3) { ?>",$this->tpl);
			 		} else {
			 			exit('ERROR：没有发现foreach闭合语句！');
			 		}
			 	}
			 }
			 
		private function parInclude() {
		$_patten = '/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
		if (preg_match_all($_patten,$this->tpl,$_file)) {
			foreach ($_file[2] as $_value) {
				if (!file_exists('templates/'.$_value)) {
					exit('ERROR：包含文件出错！');
				}
				$this->tpl = preg_replace($_patten,"<?php \$tpl->create('$2')?>",$this->tpl);
			}
		}
	}
			 
			 private function parconfig(){
			 	$patern_config = '/<!-- \{([\w]+)\} -->/';
			 	if (preg_match($patern_config, $this->tpl)){
			 		$this->tpl = preg_replace($patern_config, "<?php echo \$this->config['$1'];?>", $this->tpl);
			 	}
			 	
			 }
			 
		private function parNoet(){																			//创建一个方法，解析注释
			$pattern_note = '/\{#\}(.*)\{#\}/';
			if (preg_match($pattern_note, $this->tpl)){											//解析if语句的结束
				$this->tpl = preg_replace($pattern_note, "<?php /*$1*/?>", $this->tpl);
			}
		}
		
		public function compile($parfile){																	//创建一个方法，生成编译文件						
			$this->parNoet();
			$this->parVar();
			$this->parIf();
			$this->parIff();
			$this->parforeach();
			$this->parfor();
			$this->parInclude();
			$this->parconfig();
			file_put_contents($parfile,$this->tpl);
			
			
		}
		

		
	}


?>