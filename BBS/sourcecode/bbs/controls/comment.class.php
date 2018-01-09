<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 主题评论控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:52  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Comment{
		/*
			发表主题评论
		*/
		public function insert(){
			$_POST['ptime']=time();//评论时间
			$_POST['ip']=sprintf('%u',ip2long($_SERVER['REMOTE_ADDR']));//ip
			//如果在允许的发表评论的间隔时间之外,那么就进行下步操作,否则返回0
			if(time()-$_SESSION['user_info']['last_comm_time']>=PUBLISH_INTERVAL_COMMENT){
				//如果发表成功,返回json格式的数据到客户端,否则返回0
				if(D('comment')->post_comment($_POST)){
					$user=D('user');//用户模型
					$uid=$_SESSION['user_info']['id'];
					$user->add_grade($uid,B_COMMENT);	//加评论分
					$_SESSION['user_info']['last_comm_time']=time();//把这次评论时间写入session
					$js=array();
					$js['log_num']=$user->log_num($uid);//日志数量
					$js['subj_num']=$user->subj_num($uid);//主题数量
					$js['comm_num']=$user->comm_num($uid);//主题评论数量
					$js['level']=$user->get_level($uid);//用户等级
					$js['time']=date('Y-m-d H:i:s');//时间
					$js['add_grade']=B_COMMENT;//评论加了多少分
					echo json_encode($js);//返回给客户端
				}else{
					echo 0;	
				}			
			}else{
				echo 0;
			}
		}
	}
