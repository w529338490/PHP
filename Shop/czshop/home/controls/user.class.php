<?php
	class User {
	/**
	 * 用户页面
	 */
		function index(){
			debug(0);
			$type=D('type');
			$this->assign('meau',$type->selectguan());
			$this->display();
		}
		//密码修改
		function editPwd(){	
			$this->caching=0;
			if(preg_match('/^[0-9A-Za-z]{6,20}$/',$_POST["userpwd"]) && $_POST["userpwd"]==$_POST["repwd"]){
				$user = D("user");
				$data =	$user->where(array("id"=>$_SESSION["id"],"password"=>md5($_POST["pwd"])))->find();
				if($data){
					$_POST["password"]=md5($_POST["userpwd"]);
					$_POST["id"]=$_SESSION["id"];
					$row = $user->where($_POST["id"])->update($_POST);
					$this->success("修改成功",2,"index");
				}else{
					$this->error("修改失败",2);
				}	
			}	
		}
		//密码修改页面
		function edit(){
			debug(0);
			$this->display();
		}
		//用户收藏
		function like(){
			debug(0);
			$collect = D("collect");
			$id = $_SESSION["id"];
			$user = $collect->where(array("uid"=>$id))->r_select(array("product","name,price,discount,mpic","id","pid"));
			//p($user);
			$this->assign("data",$user);
			$this->display();
		}
	 /**
	 * 删除收藏内的商品
	 */
		function del(){
			$user = D("collect");
			$result = $user->where(array("uid"=>$_SESSION['id'],"pid"=>$_GET['id']))->delete();
			if($result){
				$this->success("删除成功",1,"index");
			}else{
				$this->error("删除失败",1,"index");
			}
		}
		/**
		* 我的订单中代付款订单
		*/
		function orders(){
			$type=D('type');
			$this->assign('meau',$type->selectguan());
			$orders=D('orders');
			$id=$_SESSION['id'];
			$data=$orders->where(array("uid"=>$id,"ostate"=>0))->select();
			$this->assign("data",$data);
			$this->display();
		}
		/**
		* 查看订单详情
		*/
		function showorders(){
			$type=D('type');
			$this->assign('meau',$type->selectguan());
			$id=$_GET['id'];
			$orders=D('orders');
			$ord=$orders->find($id);
			$this->assign('ord',$ord);
			$odetail=D('odetail');
			$ode=$odetail->field('id,pname,psize,num,pprice,cid')->where(array("oid"=>$id))->r_select(array("color",'cname','id','cid'));
			$this->assign('ode',$ode);
			$this->display();
		}
		/**
		* 我的订单中已完成订单
		*/
		function okorders(){
			$type=D('type');
			$this->assign('meau',$type->selectguan());
			$orders=D('orders');
			$id=$_SESSION['id'];
			$data=$orders->where(array("uid"=>$id,"ostate"=>2))->select();
			$this->assign("data",$data);
			$this->display();
		}
		/**
		* 我的订单中已退货订单
		*/
		function tuihuo(){
			$type=D('type');
			$this->assign('meau',$type->selectguan());
			$a=time()-15*24*3600;
			$orders=D('orders');
			$id=$_SESSION['id'];
			$data=$orders->where(array("uid"=>$id,"ostate"=>2,"rtime >"=>$a))->select();
			$this->assign("data",$data);
			$this->display();
		}
		/**
		* 我的订单中申请取消未付款订单
		*/
		function delorder(){
			
			$id=$_GET['id'];
			$orders=D('orders');
			$delor=$orders->where(array("id"=>$id))->update("ostate=3");
			if($delor){
				$this->success("订单取消申请中",1,"user/orders");
			}
		}
		/**
		* 我的订单中已完成订单执行退货操作
		*/
		function dotuihuo(){
			$id=$_GET['id'];
			$orders=D('orders');
			$orders->where(array("id"=>$id))->update("ostate=4");
		}
	}