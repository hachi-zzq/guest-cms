<?php
//实体类，用于存放所有模块的数据层操作，增查删改
class CommentModel extends Model{
	private $id;
	private $cid;
	private $username;
	private $content;
	private $state;
	private $manner;
	private $limit;
	
	
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
	
	//新增评论
	public function Add_Comment(){
			$sql = "insert into 
											comment 
											(username,
											content,
											manner,
											cid,
											date) 
								values (
											'$this->username',
											'$this->content',
											'$this->manner',
											'$this->cid',
											NOW())";
			
			return parent::add_up_de($sql);
	}
	//获取所有的评论（后台）
	public function Get_ALL_List(){
		$sql = "select 
								c.id,
								c.cid,
								c.content,
								c.username,
								c.state,
				 				ct.title
						from 
										comment c,
										content ct
					where
								c.cid = ct.id
						order by 
										c.date 
						DESC
								 $this->limit";
			return parent::all($sql);
	}
	
	
	//后台审核评论，通过（后台）
	public function Agree(){
		$sql = "update comment set state=1 where id='$this->id' limit 1;";
		return parent::add_up_de($sql);
	}
	//所有评论总量（后台）
	public function All_Comment_Num(){
		$sql = "select count(id) as comment_num from comment ";
		$result = parent::Get_Num($sql);
		$object = $result->fetch_object();
		return  $object->comment_num;
	}
	//删除评论（后台）
	public function Del_Comment(){
		$sql = "delete from comment where id='$this->id'";
		return parent::add_up_de($sql);
	}
	//批量审核（后台）
	public function More_Agree(){
		$sql ="update comment set state='$this->state' where id='$this->id';";
	}
	//获取所有的评论（前台）
	public function Get_All(){
		$sql = "select 
									c.username as c_username,
									c.content,
									c.date,
									c.state,
									c.manner,
									c.id,
									c.sustain,
									c.oppose,
									u.username as u_username,
									u.face as face
							from 
									comment as c
						left join
									user as u 
							on
									u.username=c.username
							where 
									c.cid='$this->cid'
							and
									c.state = '1' 
							order by 
									date 
							DESC 
							$this->limit";
		return parent::all($sql);
	}
	
	//获取记录数，用于分页
	public function Get_Commentnum(){
		$sql = "select count(id) as count from comment where cid='$this->cid'";
		$result = parent::Get_Num($sql);
		return $result->fetch_object()->count;
	}
	
	//获取这个文档的标题和简介
	public function Get_Title_Info(){
		$sql = "select 
								con.title,
								con.info
						from
								content as con
						left join
								comment as com
						on
								com.cid = con.id 
						where
								com.cid ='$this->cid'
						limit 1";
		return parent::one($sql);
	}
	
	//支持
	public function sustain(){
		$sql = "update comment set sustain = sustain+1 where id ='$this->id'";
		return parent::add_up_de($sql);
	}
	
	//反对
	public function oppose(){
		$sql = "update comment set oppose = oppose-1 where id ='$this->id'";
		return parent::add_up_de($sql);
	}
	
	//获取最新的三条评论
	public function Get_New_Three(){
		$sql = "select 
									c.username as c_username,
									c.content,
									c.date,
									c.state,
									c.manner,
									c.id,
									c.cid,
									c.sustain,
									c.oppose,
									u.username as u_username,
									u.face as face
							from 
									comment as c
						left join
									user as u 
							on
									u.username=c.username
							where 
									c.cid='$this->cid' 
							order by 
									date 
							DESC 
							limit 0,3";
		return parent::all($sql);
	}
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}


?>