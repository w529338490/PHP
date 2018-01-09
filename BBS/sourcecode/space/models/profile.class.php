<?php
	/*+-----------------------------------------------------------------------------------------+
	  | �û���������ģ��
	  +-----------------------------------------------------------------------------------------+
	  | ��Ȩ���� lamp�ֵ���Դ����С��						
	  +-----------------------------------------------------------------------------------------+
	  | ����: ��� (lijie@li-jie.me)							
	  | ����޸�ʱ��: 2011-12-27 22:12  										
	  +-----------------------------------------------------------------------------------------+
	*/
	
	Class Profile{	
		
		/*
			�õ�ʡ�������б�����
			@return array
		*/
		
		public function province_add(){
			$plist=D("province")->field("id,name")->select();
			$pname=array();
			foreach($plist as $p){
				$pname[$p['id']]=$p['name'];
			}
			return $pname;
			//����ʡ���б�
		}
		
		/*
			�õ����������б�����
			@param1 int ʡ��ID
			@return array
		*/		
		
		public function city_add($province_id){
			$clist=D("city")->field("id,name")->select(array("pid"=>$province_id));
			$cname=array();
			foreach($clist as $c){
				$cname[$c['id']]=$c['name'];
			}
			return $cname;
			//���س����б�
		}
		

		/*
			�õ��û���ʡ�ݳ��е�ַID
			@param1 int �û�ID
			@return array
		*/	
		
		public function get_add($uid){
			$add=D("user")->field("birth_add,live_add")->find($uid);
			$birth_add=$add['birth_add'];
			$live_add=$add['live_add'];
			$birth_add_arr=explode(",",$birth_add=$add['birth_add']);
			//��","����û��ĳ�������Ϣ,�õ�һ������
			$birth_add_province_id=$birth_add_arr[0];
			//�±�Ϊ0��Ԫ��Ϊʡ��id
			$birth_add_city_id=$birth_add_arr[1];
			//�±�Ϊ1��Ԫ��Ϊ����id
			$live_add_arr=explode(",",$live_add=$add['live_add']);
			//��","����û��ľ�ס����Ϣ,�õ�һ������
			$live_add_province_id=$live_add_arr[0];
			//�±�Ϊ0��Ԫ��Ϊʡ��id
			$live_add_city_id=$live_add_arr[1];
			//�±�Ϊ1��Ԫ��Ϊ����id
			return array("birth_province_id"=>$birth_add_province_id,
								"birth_city_id"=>$birth_add_city_id,
								"live_province_id"=>$live_add_province_id,
								"live_city_id"=>$live_add_city_id
								);//�����ĸ�ֵ����
		}
	}