<?php
	class Orders{
		/**
		 * 后台订单管理界面
		 */
		function index(){
			$p=D("orders");
			$qw=!empty($_GET['ostate'])?$_GET['ostate']:$_POST['ostate'];
			$where=array(ostate=>$qw);
			$arr=!empty($_POST) ? $_POST : $_GET;
			$pp='/ostate/'.$qw;
			if(!empty($arr['id'])){
				$where['id']=$arr['id'];
				$pp.='/id/'.$arr['id'];
			}

			if(!empty($arr['linkman'])){
				$where['linkman']="%{$arr['linkman']}%";
				$pp.='/linkman/'.$arr['linkman'];
			}
			$page= new Page($p->total($where),2,$pp);
			
			$data=$p->field('id, rtime, linkman,oaddress,telephone,total,ostate')->order('id asc')->limit($page->limit)->select($where);
			if(!empty($data)){
				$this->assign("data", $data);
			}else{
				$this->assign("data", 1);
			}
			$this->assign('fpage',$page->fpage());
				$this->display();
		}
		/**
		 * 查看订单详情
		 * 可查看订单中任何信息
		 */
		function mod(){
			$oid=$_GET['id'];
			$orders=D('orders');
			$ord=$orders->find($oid);
			$user=D(user);
			$data=$user->field('username,upoint,allow_1')->find($ord['uid']);
			$this->assign('ord',$ord);
			$this->assign('data',$data);
			$odetail=D('odetail');
			$ode=$odetail->field('id,pname,psize,num,pprice,cid')->where(array("oid"=>$oid))->r_select(array("color",'cname','id','cid'));
			$this->assign('ode',$ode);
			$this->display();
		}
		/**
		 * 删除订单
		 * 可以单个删除也可以多选删除
		 */
		function del(){
			$id=!empty($_POST["oid"])? $_POST["oid"] : $_GET["id"];
			$odetail=D("odetail");
			$odetail->where(array("oid"=>$id))->delete();
			$p= D('orders');
			if($p->delete($id)){
				$this->success('订单删除成功！');
			}							
		}	
		/**
		 * 发货设置（因本网站未与物流联合所以只能手动发货）
		 * 发货后订单状态改变
		 */
		function sent(){
			$id=$_GET['id'];
			$p=D('orders');
			if($p->where($id)->update("ostate=2")){
				$this->success('修改成功');
			}
		
		}
		/**
		 * 修改订单详情及其配送信息（只有未完成的才可以）
		 * id为订单号
		 */
		function ordermod(){
			$oid=$_GET['id'];
			$orders=D('orders');
			$data=$orders->field('id,linkman,code,telephone,oaddress')->find($oid);
			$this->assign('userinfo',$data);
			$this->display();
		}
		/**
		 * 执行订单详情修改
		 * 订单修改执行过程
		 */
		function uporders(){
			$orders=D('orders');
			$affectRows=$orders->update();
			if($affectRows>0){
				$this->success('修改成功',1,"orders/mod/id/{$_POST['id']}");
			}else{
				$this->error('修改失败');
			}
		}
		/**
		 * 订单详情（即送货地址）
		 * 可查看其
		 */
		function odetail(){
			$oid=$_GET['id'];
			$q=D('orders');
			$data=$q->find($oid);
			$this->assign('data',$data);
			$p=D('odetail');
			$goods=$p->where(array("oid"=>$oid))->select();
			$this->assign('goods',$goods);
			$this->display();
		}
		/**
		 * 订单详情中商品删除
		 * 
		 */
		function goodsdel(){
			$id=$_GET["id"];
			$xj=$_GET["xj"];
			$oid=$_GET["oid"];
			p($_GET);
			$p=D('odetail');
			if($p->delete($id)){
				$q=D('orders');
				$q->where($oid)->update("total=total-{$_GET["xj"]}");
					$this->success('修改成功');
				}
			}
		/**
		 * 
		 * 查看订单详情（即订单中商品）
		 */
		function showgoods(){	
			$oid=$_GET['id'];
			$orders=D('odetail');
			$data=$orders->field('id,oid,pname,psize,num,pprice')->find($oid);
			$this->assign('data',$data);
			$this->display();
		}
		/**
		 * 订单中修改商品详细信息
		 * 
		 */
		function upgoods(){
			$oid=$_POST["oid"];
			$num=$_POST["num"];
			$pprice=$_POST["pprice"];
			$sum=$num*$pprice;
			$xj=$_POST["xj"];
			$odetail=D('odetail');
			$affectRows=$odetail->update();
			if($affectRows>0){
				$q=D('orders');
				$q->where($oid)->update("total=total-{$xj}+{$sum}");
				$this->success('修改成功',1,"orders/odetail/id/{$_POST['oid']}");
			}else{
				$this->error('修改失败');
			}
		}
		function js(){
			debug();
			$oid=$_GET["id"];
			$p=D('odetail');
			$data=$p->where(array("oid"=>$oid))->select();
			$this->assign("ode",$data);
			$this->display();
		}
		/**
		 * 执行退款
		 * 退款后订单状态修改
		 */
		function examine(){
			$id=$_GET['id'];
			$p=D('orders');
			if($p->where($id)->update("ostate=5")){
				$this->success('退款成功');
			}
		}
	}