<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 好友模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2012-1-2 13:01  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Friend{
		
		/*
			用户加好友方法
			@param1 int 请求方ID
			@param2 int 被请求方ID号
			@param3 string 验证信息
			@return boolean
		*/
		public function add_friend($src_id,$dst_id,$content){
			$_POST['ptime']=time();
			//获取当前时间的时间戳
			$_POST['src_id']=$src_id;
			//发送人ID
			$_POST['dst_id']=$dst_id;
			//接收人ID
			$_POST['content']="<b><font color='green'>{$_SESSION['user_info']['name']}</font></b>&nbsp;&nbsp;向您发送了一条好友请求:<p style='margin-top:10px'>{$content}</p>";
			//定义发送好友添加请求信息
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取当前客户端的IP
			$_POST['sms_sort']="2";
			//定义短信类型为2
			if(D("sms")->insert()){
			//执行添加,成功返回真
				return true;
			}else{
			//否则返回假
				return false;
			}
		}
		
		/*
			得到用户空间的好友列表
			@param1 int 用户id
			@param2 string 分页信息
			@return array
		*/
		public function friend_list($uid,&$fpage){
			$total = D("user")->user_total($uid);
			//调用user模型的user_total模型
			$page=new ajaxPage($total['friend_num'], S_FRIENDPZ);
			//实例化公共类ajaxPage
			$fdata = D("friend")->field("fid")->where(array("status"=>"1","uid"=>$uid))->limit($page->limit)->select();
			//查询所有好友的id号
			foreach($fdata as &$f){
				$user_info = D("user")->user_info($f['fid']);
				//调用user模型的user_info方法
				$gnum = D("user")->field("grade_num")->find($f['fid']);
				$f['fname']=$user_info['name'];
				//将用户名插入到数组中
				$f['face']=$user_info['face_path'];
				//将用户头像插入到数组中
				$f['fgnum']=$gnum['grade_num'];
				//将用户积分数插入到数组中
			}
			$fpage=$page->fpage();
			//调用ajax分页对象的fpage方法
			return $fdata;
			//返回好友列表详情
		}
	}