<?php
	class Notice {
		function index(){
			$this->caching=0;
			$notice=D("notice");	
			$this->assign("notices", $notice->field("id,tid,sid,ncont")->order("id desc")->select());
			$t = D("type");
			$this->assign("ts",$t->selectform('tid'));
			$s = D("style");
			$this->assign("ss",$s->selectform('sid'));
			$this->display();
		}
		function add() {
		$this->caching=0;
			$t = D("type");
			$this->assign("ts",$t->selectform('tid'));
			$s = D("style");
			$this->assign("ss",$s->selectform('sid'));
			$this->display();
		}
		function insert(){
		$this->caching=0;
			$notice=D("notice");
			$sql=$notice->insert($_POST);
			$this->success("添加成功",2,"Notice/index");
			$this->display();
		}		
		function mod(){
		$this->caching=0;
			$notice=D("notice");
			$data=$notice->find($_GET["id"]);
			$t = D("type");
			$this->assign("ts",$t->selectform('tid'));
			$s = D("style");
			$this->assign("ss",$s->selectform('sid'));
			$this->assign("post", $data);
			$this->display();
		}
		function update(){
		$this->caching=0;
			$notice=D("notice");
			$id=$_POST["id"];
			$affected=$notice->where($id)->update($_POST);
			if($affected){
				$this->success("修改成功",1,"Notice/index");
			}else{
				$this->redirect("index");
			}
			$this->display();
		}
		function del(){
		$this->caching=0;
			$notice=D("notice");		
			$result=$notice->delete($_GET["id"]);
			if($result) {
				$this->redirect("index");
			}else{
				$this->error("公告删除失败！", 3, "index");
			}		
		}
	}