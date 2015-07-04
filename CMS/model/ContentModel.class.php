<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class ContentModel extends Model{
	private $id;
	private $title;
	private $nav;
	private $attr;
	private $tag;
	private $keyword;
	private $thumbnail;
	private $source;
	private $author;
	private $info;
	private $content;
	private $comment;
	private $read_count;
	private $sort;
	private $gold;
	private $read_limit;
	private $color;
	private $date;
	private $input_keyword;
	private $limit ;
	
	

	
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
	//添加文档
	public function Add_Content(){
		$sql = "insert
									 into
						content
									(
									title,
									nav,
									tag,
									attr,
									keyword,
									thumbnail,
									source,
									author,
									info,
									content,
									comment,
									read_count,
									sort,
									gold,
									read_limit,
									color,
									date
									)
						values
									(
									'$this->title',
									'$this->nav',
									'$this->tag',
									'$this->attr',
									'$this->keyword',
									'$this->thumbnail',
									'$this->source',
									'$this->author',
									'$this->info',
									'$this->content',
									'$this->comment',
									'$this->read_count',
									'$this->sort',
									'$this->gold',
									'$this->read_limit',
									'$this->color',
									now()
									)";
	
		return   parent::add_up_de($sql);
	}
	//根据导航的id获取content
	public function Get_Content(){
	$sql = "select
							c.id as cid,
							c.title,
							c.info,
							c.date,
							c.read_count,
							c.thumbnail,
							c.source,
							c.attr,
							n.id,
							n.name
				from
							content as c,
							nav as n
				where
							c.nav in($this->nav) and c.nav=n.id
				order by
							date
					desc
				$this->limit";
	return  parent::all($sql);
	}

	//根据title获得content（搜索专用）
	public function Search_Title(){
		$sql = "select
							c.id as cid,
							c.title,
							c.info,
							c.date,
							c.read_count,
							c.thumbnail,
							c.source,
							c.attr,
							n.id,
							n.name
					from
							content as c,
							nav as n
					where
							c.nav=n.id
					and
							c.title like '%$this->input_keyword%'
					order by
							date
					desc
		$this->limit";
		return  parent::all($sql);
	}
	
	//根据title获得content的记录数（搜索分页专用）
	public function Search_Title_Num(){
		$sql = "select
							count(c.id) as c_count
					from
							content as c,
							nav as n
					where
							c.nav=n.id
					and
							c.title like '%$this->input_keyword%'";
		$result = parent::Get_Num($sql);
		return $result->fetch_object();
	}
	
	//根据关键字或得content（搜索专用）
	public function Search_Keyword(){
		$sql = "select
							c.id as cid,
							c.title,
							c.info,
							c.date,
							c.read_count,
							c.thumbnail,
							c.source,
							c.attr,
							n.id,
							n.name
					from
							content as c,
							nav as n
					where
							c.nav=n.id
					and
							c.keyword like '%$this->input_keyword%'
					order by
							date
							desc
		$this->limit";
		return  parent::all($sql);	
	}
	
	//根据Tag或得content（搜索专用）
	public function Search_Tag(){
		$sql = "select
							c.id as cid,
							c.title,
							c.info,
							c.date,
							c.read_count,
							c.thumbnail,
							c.source,
							c.attr,
							n.id,
							n.name
					from
							content as c,
							nav as n
					where
							c.nav=n.id
					and
							c.keyword like '%$this->input_keyword%'
					order by
							date
					desc
							$this->limit";
		return  parent::all($sql);
	}
	
	//根据文档id或得父类id
	public function Get_Par_Id(){
		$sql = "select nav from content where id='$this->id'";
		return parent::one($sql);
	}
	
	//本月本类推荐
	public function Month_Rec(){
		$sql = "select
				 				id,title,date 
				from 
								content
				where
								nav in($this->nav) 
				and
								attr like'%推荐%'
				and
								date_format(now(),'%c') =date_format(date,'%c') 
				limit 
								0,10;";
		return parent::all($sql);
	}
	
	//本月本类推荐
	public function Month_Hot(){
		$sql = "select
									id,title,date
						from
									content
						where
									nav in($this->nav)
						and
									date_format(now(),'%c') =date_format(date,'%c')
						order by
									comment
						DESC
						limit
									0,10;";
		return parent::all($sql);
	}
	
	//本月本类图文
	public function Month_Pic(){
		$sql = "select
									id,title,date
						from
									content
						where
									nav in($this->nav)
						and
									date_format(now(),'%c') =date_format(date,'%c')
						and 
									thumbnail!=''
						limit
									0,10;";
		return parent::all($sql);
	}
	//获取content的记录数
	public function Get_Contentlist(){
	$sql = "select
							 count(*) as c
				from
							content as c,
							nav as n
				where
							nav in($this->nav) and c.nav=n.id
				";
	$result = parent::Get_Num($sql);
			return $result->fetch_object();
	
	}
	
	//获取单个content
	public function Get_One_Content(){
		$sql = "select * from content where id='$this->id'";
		return parent::one($sql)  ;
	}
	
	//修改content
	
	public function Update_Content(){
		$sql = "update 
								content
						 set
									title='$this->title',
									nav='$this->nav',
									tag='$this->tag',
									attr='$this->attr',
									keyword='$this->keyword',
									thumbnail='$this->thumbnail',
									source='$this->source',
									author='$this->author',
									info='$this->info',
									content='$this->content',
									comment='$this->comment',
									read_count='$this->read_count',
									sort='$this->sort',
									gold='$this->gold',
									read_limit='$this->read_limit',
									color='$this->color'
							where
									id='$this->id'";
		return parent::add_up_de($sql);
	}
	
	
	//删除文档
	public function Delete_Content(){
		$sql = "delete from content where id='$this->id'";
		return parent::add_up_de($sql);
	}
	
	
	//detail累计量
	public function Detail_Count(){
		$sql = "update content set read_count=read_count+1 where id='$this->id'";
		return parent::add_up_de($sql);
	}
	
	//detail评论量
	public function Detail_Comment(){
		$sql = "update content set comment=(select count(id) from comment where cid='$this->cid') where id='$this->cid'";
		return parent::add_up_de($sql);
	}
	
	//热点文章
	public function Hot_Content(){
		$sql = "select title,date,id from content order by comment DESC limit 0,10";
		return parent::all($sql);
	}
	
	//首页最新推荐
	public function Index_Rec(){
		$sql =  "select title,date,id from content where attr like'%推荐%' order by date DESC limit 0,7";
		return parent::all($sql);
	}
	
	//首页本月热点
	public function Index_Hot(){
		$sql =  "select title,date,id from content  where date_format(now(),'%c') = date_format(date,'%c') order by read_count DESC limit 0,7";
		return parent::all($sql);
	}
	
	//首页本月评论
	public function Index_Comment(){
		$sql =  "select title,date,id from content  where date_format(now(),'%c') = date_format(date,'%c') order by comment DESC limit 0,7";
		return parent::all($sql);
	}
	
	//首页显示四条图文资讯
	public function Index_Pic_Doc(){
		$sql =  "select title,thumbnail,id from content  where thumbnail<>'' order by read_count DESC limit 0,4";
		return parent::all($sql);
	}
	
	//首页头条十条
	public function Index_Top_Ten(){
		$sql =  "select title,date,id from content  order by date DESC limit 0,10";
		return parent::all($sql);
	}
	
	//首页头条一条
	public function Index_Top_One(){
		$sql =  "select title,date,id,info from content  order by date DESC limit 0,1";
		return parent::one($sql);
	}
	
	//首页头2-5条
	public function Index_Top_Twofive(){
		$sql =  "select title,date,id,info from content  order by date DESC limit 1,4";
		return parent::all($sql);
	}
	//首页列出四个模块
	public function Index_Four(){
		$sql = "select id,name from nav where parid=0 order by sort ASC limit 0,4";
		return parent::all($sql);
	}
	//首页四个主类下的所有文档
	public function Index_Four_list(){
		$sql = "select id,title,date from content where nav in(select id from nav where parid='$this->nav') order by date DESC limit 0,11";
		return parent::all($sql);
	}
	
	
	
	
	
	
	
	
	
	
	
}


?>