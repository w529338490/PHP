<?php
	class Orders{
		/**
		* 填写订单信息页
		*/
		function index(){
			$data=!empty($_SESSION['one'])?$_SESSION['one']:$_SESSION['shopingcar'];
			$this->assign('data',$data);
			$this->display();
		}
		/**
		* 删除订单中的某条记录
		*/
		function del(){
			$id=$_GET['id'];
			if($_SESSION['one'][0]['id']==$id){
				$_SESSION['one']="";
				$this->redirect("index/index");    		
			}
			else{
				foreach($_SESSION['shopingcar'] as $key =>$row){
					if($row['id']==$id){	
					unset($_SESSION['shopingcar'][$key]);
						if(empty($_SESSION['shopingcar'])){
							$this->redirect("index/index");
						}else{
							$this->redirect("index");
						}
					}
				}
				
			}
		}
		/**
		* 填写订单信息页
		*/
		function addorder(){
			$str="";
			$arr=array();
			$str.=$_POST['receivingProvinceName'];
			$str.=$_POST['receivingCityName'];
			$str.=$_POST['receivingDistrictName'];
			$str.=$_POST['receivingAddress'];
			//处理接收到的数据插入订单表 获得订单表ID
			$arr['code']=$_POST['receivingZipCode'];
			$arr['uid']=$_SESSION['id'];
			$arr['linkman']=$_POST['receivingName'];
			$arr['total']=$_POST['pay'];
			$arr['telephone']=$_POST['receivingMobilePhone'];
			$arr['oaddress']=$str;
			$arr['rtime']=time();
			$orders=D('orders');
			$oid=$orders->insert($arr);
			//处理数据插入订单详情表 并且修改商品数量
			$odetail=D('odetail');
			$goods=D('pdetail');
			for($i=0;$i<count($_POST['pid']);$i++){
				$arr2=array();
				$arr2["oid"]=$oid;
				$arr2["pid"]=$_POST['pid'][$i];
				$arr2["psize"]=$_POST['psize'][$i];
				$arr2["cid"]=$_POST['cid'][$i];
				$arr2["pname"]=$_POST['name'][$i];
				$arr2["num"]=$_POST['num'][$i];
				$arr2["pprice"]=$_POST['price'][$i];
				$odetail->insert($arr2);
				$goods->where(array("pid"=>$_POST['pid'][$i],"cid"=>$_POST['cid'][$i],"size"=>$_POST['psize'][$i]))->update("num=num-{$_POST['num'][$i]}");
			}
			$this->redirect("payfor","oid/$oid/total/{$_POST['pay']}");
			
		}
		function payfor(){
			$this->display();
		}
		
	}