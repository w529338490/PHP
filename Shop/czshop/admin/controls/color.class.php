<?php
class color{
	/**
	 * 颜色管理模块的界面
	 * Form::color是颜色选择器
	 */
	function index(){
		$this->assign("color", Form::color("cvalue", "000000"));
		$this->display();
	}
	/**
	 * 商品颜色的列表
	 * $page = new AjaxPage 创建列表分页
	 * $page->set 对列表的分页进行设置
	 */
	function slist(){
		debug();
		$c = D("color");
		$page = new AjaxPage($c->total(),12);
		$page->set("head","种颜色")
		     ->set("next",">>|")
		     ->set("prev","|<<")
		     ->set("first","|<")
		     ->set("last",">|");
		$this->assign("fpage",$page->fpage(3,4,5,6,0));
		$data = $c->field('id,cname,cvalue')->order('id asc')->limit($page->limit)->select();
		$this->assign("data",$data);
		$this->display();
	}
	/**
	 * 商品颜色添加
	 * 通过AJAX技术获得数据并添加
	 */ 
	function insert(){
		debug();
		$c = D("color");
		$insert = $c->insert();
		echo $insert;
	}
	/**
	 * 商品颜色更新
	 * 通过AJAX技术获得数据并更新
	 */ 
	function update(){
		debug();
		$c = D("color");
		echo $c->update();
	}
	/**
	 * 商品颜色删除
	 * 通过AJAX技术获得数据并删除
	 */
	function del(){
		//debug();
		
		$c = D("color");
		echo $c->delete($_GET['id']);
		
	}
}
