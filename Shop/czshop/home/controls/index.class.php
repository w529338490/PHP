<?php
	class Index {
		/**
		 * 商城首页界面
	 	 */
		function index(){
			//header 头部
			$type=D('type');
			$style = D('style');
			$p = D('product');
			$this->assign('meau',$type->selectguan());
			
			//品牌图片区
			$data=$type->field('tname,id,tpic,pid')->where(array("pid !="=>0))->select();
			$this->assign('data',$data);
			//公告区
			$notice=D('notice');
			$notic=$notice->field('tid,sid,ncont')->limit(0,6)->order("id desc")->select();
			$this->assign('notic',$notic);
			//运动馆
			$tids1 = $type->field('id')->where(array("pid"=>1))->select();
			foreach($tids1 as $v1){
				$arr1[] = $v1['id'];
			}
			$sids1 = $p->field('styleid')->where(array('typeid'=>$arr1,'pstate'=>1))->select();
			$arr1 = array();
			foreach($sids1 as $v1){
				if(!in_array($v1['styleid'],$arr1)){
					$arr1[] = $v1['styleid'];
				}
			}
			$cat1 = $style->field('id,sname')->where(array('id'=>$arr1))->select();
			$this->assign('cat1',$cat1);
			//女鞋馆
			$tids2 = $type->field('id')->where(array("pid"=>3))->select();
			foreach($tids2 as $v2){
				$arr2[] = $v2['id'];
			}
			$sids2 = $p->field('styleid')->where(array('typeid'=>$arr2,'pstate'=>1))->select();
			$arr2 = array();
			foreach($sids2 as $v2){
				if(!in_array($v2['styleid'],$arr2)){
					$arr2[] = $v2['styleid'];
				}
			}
			$cat2 = $style->field('id,sname')->where(array('id'=>$arr2))->select();
			$this->assign('cat2',$cat2);
			//男鞋馆
			$tids3 = $type->field('id')->where(array("pid"=>2))->select();
			foreach($tids3 as $v3){
				$arr3[] = $v3['id'];
			}
			$sids3 = $p->field('styleid')->where(array('typeid'=>$arr3,'pstate'=>1))->select();
			$arr3 = array();
			foreach($sids3 as $v3){
				if(!in_array($v3['styleid'],$arr3)){
					$arr3[] = $v3['styleid'];
				}
			}
			$cat3 = $style->field('id,sname')->where(array('id'=>$arr3))->select();
			$this->assign('cat3',$cat3);
			//户外休闲
			
			$tids4 = $type->field('id')->where(array("pid"=>5))->select();
			foreach($tids4 as $v4){
				$arr4[] = $v4['id'];
			}
			$sids4 = $p->field('styleid')->where(array('typeid'=>$arr4,'pstate'=>1))->select();
			$arr4 = array();
			foreach($sids4 as $v4){
				if(!in_array($v4['styleid'],$arr4)){
					$arr4[] = $v4['styleid'];
				}
			}
			$cat4 = $style->field('id,sname')->where(array('id'=>$arr4))->select();
			$this->assign('cat4',$cat4);
			//童鞋馆
			$tids5 = $type->field('id')->where(array("pid"=>4))->select();
			foreach($tids5 as $v5){
				$arr5[] = $v5['id'];
			}
			$sids5 = $p->field('styleid')->where(array('typeid'=>$arr5,'pstate'=>1))->select();
			$arr5 = array();
			foreach($sids5 as $v5){
				if(!in_array($v5['styleid'],$arr5)){
					$arr5[] = $v5['styleid'];
				}
			}
			$cat5 = $style->field('id,sname')->where(array('id'=>$arr5))->select();
			$this->assign('cat5',$cat5);
			//皮包馆
			$tids6 = $type->field('id')->where(array("pid"=>6))->select();
			foreach($tids6 as $v6){
				$arr6[] = $v6['id'];
			}
			$sids6 = $p->field('styleid')->where(array('typeid'=>$arr6,'pstate'=>1))->select();
			$arr6 = array();
			foreach($sids6 as $v6){
				if(!in_array($v6['styleid'],$arr6)){
					$arr6[] = $v6['styleid'];
				}
			}
			$cat6 = $style->field('id,sname')->where(array('id'=>$arr6))->select();
			$this->assign('cat6',$cat6);
			
			$this->display();
		}		
	}
