<?php
class type{
	/**
	 * 类别管理的界面
	 */
	function index(){
		$this->display();
	}
	/**
	 * 输出类别的下拉框
	 */
	function sel(){
		debug();
		$t = D("type");
		echo $t->selectform('pid',$_POST['m']);
	}
	/**
	 * 类别的列表界面
	 */
	function slist(){
		debug();
		$t = D("type");
		$page = new AjaxPage($t->total(),6);
		$page->set("head","种类别")
		     ->set("next",">>|")
		     ->set("prev","|<<")
		     ->set("first","|<")
		     ->set("last",">|");
		$this->assign("fpage",$page->fpage(3,4,5,6,0));
		$data = $t->field('id,tname,tpic,pid,path')->order('id asc')->limit($page->limit)->select();
		$this->assign("data",$data);
		$this->display();
	}
	/**
	 * 图片上传
	 */
	private function upload(){
		$up = new FileUpload();

		$up->set("maxsize",1000000)
		   ->set("allowtype",array("gif","png","jpg"))
		   ->set("thumb",array("width"=>300,"height"=>"300"));
		   //->set("watermark",array("water"=>"php.gif","position"=>5));
		if($up->upload('tpic')){
			$info[0] = $up->getFileName();
			//$img = new Image('./images');
			//$img->thumb($info[0],'100','100','th_');
			//$img->watermark($info[0],'php.gif',5,'wa_');
			$info[1] = true;
		}else{
			$info[0] = $up->getErrorMsg();
			$info[1] = false;
		}
		return $info;

	}
	/**
	 * 无刷新图片上传并执行添加操作
	 */
	function ajup(){
		debug();
		$info = $this->upload();
		if($info[1]){
			echo "<script>";
			echo "parent.insert('{$info[0]}')";
			echo "</script>";
			
		}else{
			echo "<script>";
			echo "parent.uperror('".strip_tags($info[0])."')";
			echo "</script>";
		}
		
	}
	/**
	 * 添加类别信息
	 */
	function insert(){
		//debug();
		$t = D("type");
		if($_POST['pid']==0){
			$_POST['path'] = '-0-';
		}else{
			$src = $t->field('path')->find($_POST["pid"]);
			$_POST['path'] = $src['path'].$_POST['pid'].'-';
		}
		$insert = $t->insert();
		if(!$insert){
			unlink("./public/uploads/{$_POST['tpic']}");
		}
		echo $insert;
	}
	/**
	 * 无刷新图片上传并执行修改操作
	 */
	function ajud(){
		debug();
		$info = $this->upload();
		if($info[1]){
			echo "<script>";
			echo "parent.update('{$info[0]}')";
			echo "</script>";
			
		}elseif(strip_tags($info[0])=='上传文件时出错 : 没有文件被上传'){	//修改时，可以不修改图片
			echo "<script>";
			echo "parent.update()";
			echo "</script>";
		}else{
			echo "<script>";
			echo "parent.uperror('".strip_tags($info[0])."')";
			echo "</script>";
		}
		
	}
	/**
	 * 修改类别信息
	 */
	function update(){
		debug();
		if($_POST['srcimg']){
			$srcimg = $_POST['srcimg'];
			$srcimg = pathinfo($srcimg,PATHINFO_BASENAME);
			unlink("./public/uploads/$srcimg");
		}
		$t = D("type");
		echo $t->update();
	}
	/**
	 * 删除类别信息
	 */
	function del(){
		debug();
		$t = D("type");
		$data = $t->where("path like '%-{$_GET['id']}-%' or id = {$_GET['id']}")->select();
		foreach($data as $v){
			unlink("./public/uploads/{$v['tpic']}");
		}
		echo $t->where("path like '%-{$_GET['id']}-%' or id = {$_GET['id']}")->delete();

	}
}
