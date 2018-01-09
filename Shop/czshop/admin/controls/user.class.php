<?php
	class User {
		function index(){
			debug();
			$this->caching=0;
			$user = D("user");
			$this->assign("mess",('<a href="'.B_URL.'/index/search/allow_1/0" style="text-decoration:line-through;">画线用户</a>已禁用. <a href="'.B_URL.'/index">查看全部>></a>'));
			$arr=$_GET;	
			if(!empty($_SESSION['allow_4'])){
			$this->assign("allow_4",$_SESSION['allow_4']);
			}
			if(!empty($_SESSION['allow_3'])){
			$this->assign("allow_3",$_SESSION['allow_3']);
			}
			if(!empty($_SESSION['allow_2'])){
			$this->assign("allow_2",$_SESSION['allow_2']);
			}
			if(!empty($_SESSION['allow_1'])){
			$this->assign("allow_1",$_SESSION['allow_1']);
			}
			$where="";
			$pget="";
			$search = !empty($arr['search'])? $arr['search'] : "";			
			if($search!=""){	
				$where["username"]="%{$arr["search"]}%";
				$pget="/search/{$arr["search"]}";
				
				if($arr['search']=='allow_1'){$where=array("allow_1"=>0);$pget="search/allow_1";}
					if($arr['search']=='allow_4'){$where=array("allow_4"=>1);$pget="cearch/allow_4";}
			}
			$where['id !=']=1;
			$page = new Page($user->total($where),15,$pget);			
			$data = $user->field('id,username,upoint,allow_1,allow_2,allow_3,allow_4')->order('id desc')
			->limit($page->limit)
			->where($where)
			->select();			
			$page->set("head","个用户");		
			$this->assign("data",$data);
			$this->assign("search", $search);
			$this->assign("fpage",$page->fpage(0,1,2,3,4,5,6,7));
			$this->display();
		}
		function mod(){
			debug();
			$this->caching=0;
			if(!empty($_SESSION['allow_4'])){
			$this->assign("allow_4",$_SESSION['allow_4']);
			}
			if(!empty($_SESSION['allow_3'])){
			$this->assign("allow_3",$_SESSION['allow_3']);
			}
			if(!empty($_SESSION['allow_2'])){
			$this->assign("allow_2",$_SESSION['allow_2']);
			}
			if(!empty($_SESSION['allow_1'])){
			$this->assign("allow_1",$_SESSION['allow_1']);
			}
			$data = D("user")->field('id,username,upoint,allow_1,allow_2,allow_3,allow_4')->find($_GET['id']);
			$this->assign("data",$data);
			$this->display();
		}
		function update(){
			$this->caching=0;		
			$user = D("user");
			$_POST["allow_1"] = !empty($_POST["allow_1"]) ? $_POST["allow_1"] : 1;
			$_POST["allow_2"] = !empty($_POST["allow_2"]) ? $_POST["allow_2"] : 0;
			$_POST["allow_3"] = !empty($_POST["allow_3"]) ? $_POST["allow_3"] : 0;
			$data = $user->where($_POST['id'])->update($_POST);
			if(!empty($_SESSION['allow_4'])){
			$this->assign("allow_4",$_SESSION['allow_4']);
			}
			if(!empty($_SESSION['allow_3'])){
			$this->assign("allow_3",$_SESSION['allow_3']);
			}
			if(!empty($_SESSION['allow_2'])){
			$this->assign("allow_2",$_SESSION['allow_2']);
			}
			if(!empty($_SESSION['allow_1'])){
			$this->assign("allow_1",$_SESSION['allow_1']);
			}
			if($data){
				$this->success("修改成功",1,"user/index");
			}else{
				$this->redirect("index");
			}
			$this->display();
		}
		function grop1(){
			$this->caching=0;
			$user = D("user");
			$data = $user->where($_POST['id'])->update("allow_1=0");
			if($data){
				$this->success("修改成功",1,"user/index");
			}else{
				$this->redirect("index");
			}
		}function grop2(){
			$this->caching=0;
			$user = D("user");
			$data = $user->where($_POST['id'])->update("allow_1=1");
			if($data){
				$this->success("修改成功",1,"user/index");
			}else{
				$this->redirect("index");
			}
		}
		function del(){
			$this->caching=0;
			$user = D("user");
			$result = $user->delete($_GET["id"]);
			if($result){
				$this->success("删除用户成功",1,"index");
			}else{
				$this->error("删除用户失败",1,"index");
			}
		}
	}