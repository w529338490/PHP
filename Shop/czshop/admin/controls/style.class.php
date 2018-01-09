<?php
class style{
	/**
	 * 商品款式的界面
	 */
	function index(){
		$this->display();
	}
	/**
	 * 商品款式列表的界面
	 */
	function slist(){
		debug();
		$s = D("style");
		$page = new AjaxPage($s->total(),12);
		$page->set("head","种款式")
		     ->set("next",">>|")
		     ->set("prev","|<<")
		     ->set("first","|<")
		     ->set("last",">|");
		$this->assign("fpage",$page->fpage(3,4,5,6,0));
		$data = $s->field('id,sname,sdetail')->order('id asc')->limit($page->limit)->select();
		$this->assign("data",$data);
		$this->display();
	}
	/**
	 * 添加商品款式
	 */
	function insert(){
		debug();
		$s = D("style");
		$insert = $s->insert();
		echo $insert;
	}
	/**
	 * 修改商品款式
	 */
	function update(){
		debug();
		$s = D("style");
		echo $s->update();
	}
	/**
	 * 删除款式的界面
	 */
	function del(){
		//debug();
		
		$s = D("style");
		echo $s->delete($_GET['id']);
		
	}
	/**
	 * 输出款式详情
	 */
	function find(){
		debug();
		$s = D("style");
		$data = $s->field('sdetail')->find($_GET['id']);
		$sd = explode(',',$data['sdetail']);
		echo json_encode($sd);	
	}
}
