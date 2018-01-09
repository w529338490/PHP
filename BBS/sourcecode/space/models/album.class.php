<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 相册模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-29 13:01  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Album{	
		/*
			得到相册列表
			@param1 int 用户id
			@return array
		*/
		public function album_list($uid){
			$data = D("album")->field("id,uid,name,cover_path,ptime,authority")->select(array("uid"=>$uid));
			//查询相册的详细信息
			foreach($data as &$d){
				$photo_total = $this->photo_total($d['id']);
				//将相册照片总数添加到数组中
				$d['photo_total']=$photo_total;
			}
			return $data;
			//返回相册列表详情
		}
	
		/*
			得到相册封面图片
			@param1 int 相册封面图片id
			@return array
		*/
		public function cover_pic($pid){
			return D("photo")->field("img_path")->where(array("id"=>$pid))->find();
			//返回查询出的照片的文件名称
		}
		
		
		/*
			得到相册照片总数
			@param1 int 相册id
			@return int
		*/
		public function photo_total($aid){
			return D("photo")->where(array("pa_id"=>$aid))->total();
			//返回照片的总数
		}
	}	
