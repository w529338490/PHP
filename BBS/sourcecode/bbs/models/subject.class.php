<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 主题模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:50   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Subject extends Pub{
		/*
			得到某主题的最后评论人id及用户名及回帖时间
			@param1 int 主题id
			@return array
		*/
		public function subj_last_comm($sid){
			//从主题评论表得到最后评论人的信息
			$last_comm=D('comment')->field('uid,ptime')->where(array('sid'=>$sid))->order('id desc')->find();
			//如果数组为空,就直接返回空数组
			if(!$last_comm){
				return array();
			}
			$user_name=D('user')->user_name($last_comm['uid']);	//得到用户名
			$last_comm['last_comm_name']=$user_name;	//最后评论人的用户名
			$last_comm['last_comm_id']=$last_comm['uid'];		//最后评论人的uid
			$last_comm['last_comm_time']=$last_comm['ptime'];	//最后评论时间
			return $last_comm;
		}
		
		/*
			得到指定板块的所有主题
			@param1 int 板块id
			@param2 string 限制条数
			@param3 array() where条件
			@param4 string 排序
			@return array
		*/		
		public function subj_list($bid,$limit,$where=array(),$order=''){
			$user=D('user');	//用户模型
			$comm=D('comment');	//主题评论模型
			//如果没有排序条件,默认为主题类型号升序
			if($order==''){
				$order="ptype asc";
			}
			//主题的id,标题,点击量,类型,时间,发表者的用户id
			$subj_list=$this->field('id,title,uid,ptime,ptype,click_num')
						   ->limit($limit)
						   ->where($where)
						   ->order($order)						   
						   ->select();
			//附加信息
			foreach($subj_list as &$subject){
				$last_comm_info=$this->subj_last_comm($subject['id']);//得到最后评论人的信息
				$user_name=$user->user_name($subject['uid']);
				$subject['author']=$user_name;//主题发表者的用户名
				$subject['comm_num']=$comm->subj_comm_num($subject['id']);//主题的评论量
				$subject['last_comm_name']=$last_comm_info['last_comm_name'];//最后评论人的用户名
				$subject['last_comm_id']=$last_comm_info['last_comm_id'];//最后评论人的用户id
				$subject['last_comm_time']=$last_comm_info['last_comm_time'];//最后评论时间
				if($subject['comm_num']>=B_HOT_NUM){	//火热主题衡量标准
					$subject['ptype']=6;//火热类型为6,模板进行判断
				}
			}
			//如果$order等于空,说明是默认排序,那么就是采用如下
			if($order==''){
				array_multisort($subj_list,SORT_ASC);
			}
			return $subj_list;
		}

		/*
			返回主题的详细信息(后加主题主人的头像,主人名,日志数量,主题数量,帖子数量,主题回复量)
			@param1 int 主题id
			@return array
		*/
		public function subj_info($sid){
			$user=D('user');
			$info=$this->field('id,uid,title,content,ptime,state,click_num,yes_num,no_num,ptype')
						  ->where(array('id'=>$sid,'ptype !='=>'0'))
						  ->find();
			$user_name=D('user')->user_name($info['uid']);
			$info['click_num']+=1;
			$info['user_name']=$user_name;											//主人名
			$info['user_face_img']=$user->user_face($info['uid']);			//主人头像
			$info['user_log_num']=$user->log_num($info['uid']);				//日志数量
			$info['user_subj_num']=$user->subj_num($info['uid']);				//主题数量
			$info['user_commo_num']=$user->comm_num($info['uid']);			//评论数量
			$info['user_level']=$user->get_level($info['uid']);				//用户等级
			$info['user_sign']=$user->get_sign($info['uid']);					//用户签名
			$info['subj_comm_num']=D('comment')->subj_comm_num($info['id']);//该主题的评论数量
			$info['subj_hot_num']=B_HOT_NUM;
			return $info;
		}
		
		
		/*
			最新前10条主题 *
			@return array(二维数组)
		*/
		public function top10(){
			$subject=$this->field('id,title,uid')->where(array('ptype !='=>'0'))->limit(10)->order('ptime desc')->select();
			foreach($subject as &$subj){
				$user_name=D('user')->user_name($subj['uid']);
				$subj['user_name']=$user_name;
			}
			return $subject;
		}	
		
		/*
			热门主题 *
			@return array(二维数组)
		*/
		public function hot_sbj(){
			$user=D('user');
			$hot_sbj=D("comment")->query("select count(comm.id) as num,sbj.title,sbj.uid,sbj.id 
										from sc_subject as sbj,
										sc_comment as comm 
										where sbj.id=comm.sid 
										group by sbj.id 
										order by num desc limit 10","select"
									  );
			foreach($hot_sbj as &$hot){
				$user_name=$user->user_name($hot['uid']);
				$hot['user_name']=$user_name;
			}
			return $hot_sbj;
		}		
		/*
			得到某板块的最新主题的id,标题,最后时间,最后发表主题的用户的id及用户名
			@param1 int 板块ID
			@return int			
		*/
		public function last_subj($bid){
			$user=D('user');
			$last_subj=$this->field('id,uid,title,ptime')
							->where(array('ptype !='=>'0','bid'=>$bid))
							->limit(1)
							->order('ptime desc')
							->find();
			$user_name=$user->user_name($last_subj['uid']);
			$last_subj['user_name']=$user_name;
			return $last_subj;
		}	
		/*
			支持/反对主题
			@param1 int 主题id
			@param2 int 类型 -1反对 1=支持
			@return boolean
		*/
		public function viewpoint($sid,$type='1'){
			if($type=='1'){
				$this->where(array('id'=>$sid))->update("yes_num=yes_num+1");
			}else{
				$this->where(array('id'=>$sid))->update("no_num=no_num+1");
			}
			return true;
		}

		/*
			根据主题的id得到所属者id
			@param1 int 主题id
			@return int 用户id
		*/
		public function subj_of_uid($sid){
			$uid=$this->field('uid')->where(array("id"=>$sid))->find();
			return $uid['uid'];
		}
		
		/*
			根据主题id得到板块id
			@param1 int 主题id
			@return int 板块id
		*/
		public function subj_of_board($sid){
			$board=$this->field('bid')->where(array('id'=>$sid))->find();
			return $board['bid'];
		}

		/*
			主题类型操作
			@param1 int 主题id
			@param2 int 类型 1=置顶 2=精华 3=推荐 4=普通 0=关闭 5=彻底删除 默认为4
			@return boolean
		*/
		public function subject_opera($sid,$type=4){
			//如果是管理员
			if($_SESSION['user_info']['stand']=='1'){
				//如果类型是5,那么删除这个主题以及这个主题的回复,否则仅仅是设置标志
				if($type=='5'){
					if($this->where(array('id'=>$sid))->r_delete(array('comment','sid'))){
						return true;
					}else{
						return false;
					}
				}else{
					if($this->where(array('id'=>$sid))->update(array('ptype'=>$type))){
						return true;
					}else{
						return false;
					}				
				}
				
			//如果是版主
			}elseif($_SESSION['user_info']['stand']=='2'){
				$sid_of_bid=$this->field('bid')->where(array('id'=>$sid))->find();
				$sid_of_bid=$sid_of_bid['bid'];	//此主题所属的板块id
				$board_master=D('board')->field('master')->where(array('id'=>$sid_of_bid))->find();//得到上面查出来的板块id的版主
				//如果上述查出来的版主id等于session里用户id,那么就说明是这个板块的版主
				if($_SESSION['user_info']['id']==$board_master['master']){
					if($this->where(array('id'=>$sid))->update(array('ptype'=>$type))){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}
		/*
			得到某天的主题数量
			@param1 int  如:昨天就写1 今日就写0
			@return int
		*/
		public function subj_day_num($day=""){
			return $this->where($this->get_where_time($day))->total();
		}
	
		/*
			得到指定天数的where 条件
			@param1 int 如:昨天就写1 今日就写0
			@return array
		*/
		public function get_where_time($day=""){
			$pre_time=mktime(0,0,0);														//获取当天凌晨00:00:00的时间戳
			$la_time=mktime(0,0,0)-$day*3600*24;											//获取$day天前凌晨00:00:00的时间戳
			if($day="" || $day<1){
				$arr=array('ptime >='=>$pre_time);											//如果参数$day不存在或者小于0,默认获取当天的发帖量
			}else{
				$arr=array('ptime >='=>$la_time,'ptime <'=>$pre_time);						//如果参数$day大于0,获取$day天内的发帖量
			}
			return $arr;
		}
		
		
		/*
			统计主题表一共有多少个主题
			@return int
		*/
		public function subj_total_num(){
			return $this->total();
		}
		
		
		/*
			统计指定板块一共有多少个主题
			@param1 int 板块id
			@return int
		*/
		public function board_subj_num($id){
			return $this->where(array('bid'=>$id,'ptype !='=>'0'))->total();
		}	

		/*
			得到某板块的今日主题数量
			@param1 int 板块ID
			@return int
		*/	
		public function sub_board_today_subj_num($bid){
			return $this->where(array('bid'=>$bid,'ptime >='=>mktime(0,0,0,date('m'),date('d'),date('Y'))))->total();
		}		
	}