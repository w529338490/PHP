<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 用户个人资料模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-27 22:12  										
	  +-----------------------------------------------------------------------------------------+
	*/
	
	Class Profile{	
		
		/*
			得到省份下拉列表数组
			@return array
		*/
		
		public function province_add(){
			$plist=D("province")->field("id,name")->select();
			$pname=array();
			foreach($plist as $p){
				$pname[$p['id']]=$p['name'];
			}
			return $pname;
			//返回省份列表
		}
		
		/*
			得到城市下拉列表数组
			@param1 int 省份ID
			@return array
		*/		
		
		public function city_add($province_id){
			$clist=D("city")->field("id,name")->select(array("pid"=>$province_id));
			$cname=array();
			foreach($clist as $c){
				$cname[$c['id']]=$c['name'];
			}
			return $cname;
			//返回城市列表
		}
		

		/*
			得到用户的省份城市地址ID
			@param1 int 用户ID
			@return array
		*/	
		
		public function get_add($uid){
			$add=D("user")->field("birth_add,live_add")->find($uid);
			$birth_add=$add['birth_add'];
			$live_add=$add['live_add'];
			$birth_add_arr=explode(",",$birth_add=$add['birth_add']);
			//用","拆分用户的出生地信息,得到一个数组
			$birth_add_province_id=$birth_add_arr[0];
			//下标为0的元素为省份id
			$birth_add_city_id=$birth_add_arr[1];
			//下标为1的元素为城市id
			$live_add_arr=explode(",",$live_add=$add['live_add']);
			//用","拆分用户的居住地信息,得到一个数组
			$live_add_province_id=$live_add_arr[0];
			//下标为0的元素为省份id
			$live_add_city_id=$live_add_arr[1];
			//下标为1的元素为城市id
			return array("birth_province_id"=>$birth_add_province_id,
								"birth_city_id"=>$birth_add_city_id,
								"live_province_id"=>$live_add_province_id,
								"live_city_id"=>$live_add_city_id
								);//将这四个值返回
		}
	}