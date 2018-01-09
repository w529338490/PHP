<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 站内信模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-31 23:29  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Sms{
		
		/*
			得到用户的站内信列表内容
			@param1 int 用户的id号
			@return array
		*/
		public function sms_list($uid,&$fpage){
			$total=D("sms")->where(array("dst_id"=>$uid))->total();
			//查询短信总数
			$page=new ajaxPage($total, S_SMSPZ);
			//实例化公共类ajaxPage
			$data = D("sms")->field("id,dst_id,src_id,content,ptime,dst_ope,src_ope,is_read,ip,sms_sort")->order("is_read asc,ptime desc")->limit($page->limit)->select(array("dst_id"=>$uid));
			foreach($data as &$d){
				$user_info = D("user")->user_info($d['src_id']);
				//调用user模型的user_info方法
				$d['src_avar']=$user_info['face_path'];
				//将用户头像插入到数组中
				$d['src_name']=$user_info['name'];
				//将用户名插入到数组中
				if($d['sms_sort']==2){
				//如果短信类型为2,查询出好友状态
					$status1 = D("friend")->field("status")->where(array("fid"=>$uid,"uid"=>$d['src_id']))->find();
					$d['I_is_friend']=$status1['status'];//将好友状态赋给$d['I_is_friend']
					$status2 = D("friend")->field("status")->where(array("uid"=>$uid,"fid"=>$d['src_id']))->find();
					$d['Y_is_friend']=$status2['status'];//将好友状态赋给$d['Y_is_friend']
				}
			}
			$fpage=$page->fpage();
			////调用ajax分页对象的fpage方法
			return $data;
			//返回短信列表
		}
		
		/*
			得到用户站内信详情
			@param1 int smsid
			@return array
		*/
		public function sms_detail($smsid){
			$data = D("sms")->field("id,dst_id,src_id,content,ptime,dst_ope,src_ope,is_read,ip,sms_sort")->find($smsid);
				$user_info = D("user")->user_info($data['src_id']);
				//将用户名插入到数组中
				$data['src_avar']=$user_info['face_path'];
				//将用户头像插入到数组中
				$data['src_name']=$user_info['name'];
				//将用户名插入到数组中
			return $data;
			//返回短信详情
		}
		
		/*
			用户发信方法
			@param1 int dst_id	收信人ID
			@param2 int src_id	发信人ID
			@param3 string content	信息内容
			@return boolean
		*/
		public function sms_send($dst_id,$src_id,$content){
			$_POST['ptime']=time();
			//获取当前时间的时间戳
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取当前客户端的IP
			$_POST['dst_id']=$dst_id;
			//接收人ID
			$_POST['src_id']=$src_id;
			//发送人ID
			$_POST['content']=$content;
			//发送内容
			if(D("sms")->insert()){
			//执行添加,成功返回真
				return true;
			}else{
			//失败返回假
				return false;
			}
		}
	}