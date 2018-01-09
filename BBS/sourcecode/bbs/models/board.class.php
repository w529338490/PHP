<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 板块模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:47   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Board extends Pub{
		/*
			传入板块的id号得到版块名
			@param1 int 板块id
			@return string
		*/
		public function board_name($id){
			$board=$this->field('name')->where(array('id'=>$id))->find();
			//如果是数组,说明就有数据,那么就返回版块名,否则就返回'未知板块'
			if($board){
				return $board['name'];
			}else{
				return '未知板块';
			}
		}
		
		/*
			返回指定分区的子版块
			@param1 int (分区的id号)
			@return array(二维数组)
		*/
		public function zone_sub_board($zid){
			$user=D('user');		//用户模型
			$subject=D('subject');	//主题模型
			$comm=D('comment');		//主题评论模型
			//得到分区的id,名称
			$zone=$this->field('id as zid,name')->where(array('id'=>$zid,'display'=>'1'))->order('order_num asc')->find();
			//得到子版块的id,名称,版主id,图像路径
			$sub_board=$this->field('id,name,master,img_path')
							 ->where(array('parent_id'=>$zid,'display'=>'1'))
							 ->order('order_num asc')
							 ->select();
			//为子版块附加上版主名,今日主题数,总共主题数,总共评论数,最后发表主题的主题id、主题名、时间、用户id、用户名
			foreach($sub_board as &$sb){
				$user_name=$user->user_name($sb['master']);
				$sb['master_name']=$user_name;	//版主名
				$sb['sub_board_today_subj_num']=$subject->sub_board_today_subj_num($sb['id']);//今日主题数量
				$sb['sub_board_total_sbj_num']=$subject->board_subj_num($sb['id']);	//总共主题数量
				$sb['sub_board_total_comm_num']=$comm->comm_total_num($sb['id']);	//总共评论数量
				$last_subj=D('subject')->last_subj($sb['id']);	//得到最后主题的详细信息
				$sb['last_sbj_id']=$last_subj['id'];	//最后发表的主题id
				$sb['last_sbj_title']=$last_subj['title'];//最后发表的主题名称
				$sb['last_sbj_time']=$last_subj['ptime'];//最后发表的主题时间
				$sb['last_sbj_user_id']=$last_subj['uid'];//最后发表人的uid
				$sb['last_sbj_user_name']=$last_subj['user_name'];//最后发表人的用户名
			}
			$zone_and_board=array($zone,$sub_board);//索引0是分区 1是该分区的子版块
			return $zone_and_board;
		}

		/*
			返回分区与子板块列表/加工后多了版主名,该板块的主题数量,以及回复数量(首页的板块列表)
			@return array();
		*/
		public function board_list(){
			$user=D('user');	//用户模型
			$subj=D('subject');	//主题模型
			$comm=D('comment');	//主题评论模型
			//分区的信息(id,名称),按排序号升序
			$zone_and_board=$this->field('id as zid,name')
								 ->where(array('parent_id'=>$zid,'display'=>'1'))
								 ->order('order_num asc')
								 ->select();
			foreach($zone_and_board as &$z){
				//为得到分区下的子版块(id,名称,版主id,图像路径),按排序号升序
				$board_list=$this->field('id,name,master,img_path')
								 ->where(array('parent_id'=>$z['zid'],'display'=>'1'))
								 ->order('order_num asc')
							     ->select();
				//为子版块附加版主名,总共主题数量,总共评论数量
				foreach($board_list as &$sb){
					$user_name=$user->user_name($sb['master']);
					$sb['master_name']=$user_name;	//版主名
					$sb['subj_num']=$subj->board_subj_num($sb['id']);	//总共主题数量
					$sb['comm_num']=$comm->board_comm_num($sb['id']);	//总共评论数量
				}
				$z['sub_board']=$board_list;//分区的下标为'sub_board'的值是子版块的详细信息
			}
			return $zone_and_board;//这个数组包括分区和子版块,是个二维数组
		}	
		
		/*
			返回分区与子板块列表(主题列表页的左边的导航)
			@return array();			
		*/
		public function zone_board_list(){
			//关联查询,有分区的id与名称,该分区的子版块有id,名称
			$total_list=$this->field('id,name')
							 ->where(array('parent_id'=>0,'display'=>'1'))
							 ->r_select(array('board','id,name','parent_id',array('sub_board','display = "1"')));	
			return $total_list;
		}	
	}