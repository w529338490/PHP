<?php
class product{
	/**
	* 新添加商品管理界面
	* $t->selectform('typeid')是商品类型的下拉列表
	* $c->selectform('colorid')是商品颜色的下拉列表
	* $s->selectform('styleid')是商品款式的下拉列表
	*/
	function index(){
		$t = D("type");
		$this->assign("ts",$t->selectform('typeid'));
		$c = D("color");
		$this->assign("cs",$c->selectform('colorid'));
		$s = D("style");
		$this->assign("ss",$s->selectform('styleid'));
		$this->display();
	}
	/**
	 * 商品添加界面
	 */ 
	function add(){
		$t = D("type");
		$this->assign("ts",$t->selectform('typeid'));
		$c = D("color");
		$this->assign("cs",$c->selectform('colorid'));
		$s = D("style");
		$this->assign("ss",$s->selectform('styleid'));
		$this->display();
	}
	/**
	 * 在售商品管理界面
	 */
	function onsell(){
		$t = D("type");
		$this->assign("ts",$t->selectform('typeid'));
		$c = D("color");
		$this->assign("cs",$c->selectform('colorid'));
		$s = D("style");
		$this->assign("ss",$s->selectform('styleid'));
		$this->display();
	}
	/**
	 * 下架商品管理界面
	 */
	function outsell(){
		$t = D("type");
		$this->assign("ts",$t->selectform('typeid'));
		$c = D("color");
		$this->assign("cs",$c->selectform('colorid'));
		$s = D("style");
		$this->assign("ss",$s->selectform('styleid'));
		$this->display();
	}
	/**
	 * 显示商品的款式详情
	 */
	function find(){
		debug();
		$s = D("style");
		$row = $s->field('sdetail')->find($_GET['id']);
		$arr = explode(',',$row['sdetail']);
		echo json_encode($arr);
	}
	/**
	 * 新添加商品的列表界面
	 */
	function slist(){
		debug();
		$where['sell'] = 0;
		$order = 'p.id';
		$desc = 'asc';
		$where = array('name','price','discount');
		//拼装搜索条件
		foreach($_GET as $k=>$v){
			if(!empty($v) && in_array($k,$where)){
				$str .= "/".$k."/".$v;
				$search .= " && ".$k." like '%$v%'";
			}
		}
		//拼装排序条件
		if(!empty($_GET['order'])){
			$order = $_GET['order'];
			$str .= "/order/$order";
		}
		//拼装正序、倒序条件
		if(!empty($_GET['desc'])){
			$desc = $_GET['desc'];
			$str .= "/desc/$desc";
		}
		$p = D("product");
		$countdata = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 0 $search group by pd.pid order by p.id",'select');
		$page = new AjaxPage(count($countdata),2,"/sell/0".$str);
		$page->set("head","件商品")
		     ->set("next","下一页")
		     ->set("prev","上一页")
		     ->set("first","首页")
		     ->set("last","尾页");
		$this->assign("fpage",$page->fpage(3,4,6,0));
		$data = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 0 $search group by pd.pid order by $order $desc limit {$page->limit}",'select');
		$this->assign("data",$data);
		$this->display();
	}
	/**
	 * 下架商品的列表界面
	 */
	function oulist(){
		debug();
		$where['sell'] = 0;
		$order = 'p.id';
		$desc = 'asc';
		$where = array('name','price','discount');
		foreach($_GET as $k=>$v){
			if(!empty($v) && in_array($k,$where)){
				$str .= "/".$k."/".$v;
				$search .= " && ".$k." like '%$v%'";
			}
		}
		if(!empty($_GET['order'])){
			$order = $_GET['order'];
			$str .= "/order/$order";
		}
		if(!empty($_GET['desc'])){
			$desc = $_GET['desc'];
			$str .= "/desc/$desc";
		}
		$p = D("product");
		$countdata = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 2 $search group by pd.pid order by p.id",'select');
		$page = new AjaxPage(count($countdata),2,"/sell/2".$str);
		$page->set("head","件商品")
		     ->set("next","下一页")
		     ->set("prev","上一页")
		     ->set("first","首页")
		     ->set("last","尾页");
		$this->assign("fpage",$page->fpage(3,4,6,0));
		$data = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 2 $search group by pd.pid order by $order $desc limit {$page->limit}",'select');
		$this->assign("data",$data);
		$this->display();
	}
	/**
	 * 在售商品的列表界面
	 */
	function onlist(){
		debug();
		$where['sell'] = 0;
		$order = 'p.id';
		$desc = 'asc';
		$where = array('name','price','discount');
		foreach($_GET as $k=>$v){
			if(!empty($v) && in_array($k,$where)){
				$str .= "/".$k."/".$v;
				$search .= " && ".$k." like '%$v%'";
			}
		}
		if(!empty($_GET['order'])){
			$order = $_GET['order'];
			$str .= "/order/$order";
		}
		if(!empty($_GET['desc'])){
			$desc = $_GET['desc'];
			$str .= "/desc/$desc";
		}
		$p = D("product");
		$countdata = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 1 $search group by pd.pid order by p.id",'select');
		$page = new AjaxPage(count($countdata),2,"/sell/1".$str);
		$page->set("head","件商品")
		     ->set("next","下一页")
		     ->set("prev","上一页")
		     ->set("first","首页")
		     ->set("last","尾页");
		$this->assign("fpage",$page->fpage(3,4,6,0));
		$data = $p->query("select p.id,name,price,discount,ptime,pstate,mpic,ptime,sum(number) as sum from 
			d36_product p,d36_pdetail pd where pd.pid=p.id && pstate = 1 $search group by pd.pid order by $order $desc limit {$page->limit}",'select');
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
		   ->set("thumb",array("width"=>"1000","height"=>"1000"));
		   //->set("watermark",array("water"=>"php.gif","position"=>5));、、
		if($up->upload('tpic')){
			$info[0] = $up->getFileName();
			 foreach($info[0] as $v){
				$img = new Image();
				$img->thumb($v,'60','60','mini_');
				$img1 = new Image();
				$img1->thumb($v,'480','480','_');
			}
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
	 * 无刷新图片上传并执行添加商品操作
	 */
	function ajup(){
		debug();
		$info = $this->upload();
		if($info[1]){	
			echo "<script>";
			echo "parent.insert('".json_encode($info[0])."')";
			echo "</script>";
			
		}else{
			echo "<script>";
			echo "parent.uperror('".strip_tags($info[0][0])."')";
			echo "</script>";
		}
		
	}
	/**
	 * 修改商品详情的界面信息
	 */
	function pdmod(){
		debug();
		$pd = D('pdetail');
		$data = $pd->where(array('pid'=>$_POST['id']))->select();
		echo json_encode($data);
		 
	}
	/**
	 * 修改商品详情
	 */
	function updatepd(){
		debug();
		$size = explode(',',$_POST['size']);
		$color = explode(',',$_POST['cid']);
		$number = explode(',',$_POST['number']);
		$pd = D('pdetail');
		$ids = $pd->field('id,pid')->where(array('pid'=>$_POST['pid']))->select();
		for($i=0;$i<count($size);$i++){
			$_POST['size'] = $size[$i];
			$_POST['cid'] = $color[$i];
			$_POST['number'] = $number[$i];
			if($i<$pd->where(array('pid'=>$_POST['pid']))->total()){
				$pd->where(array('id'=>$ids[$i]))->update($_POST);
			}else{
				$pd->insert($_POST);
			}
		}
		echo true;
	}
	/**
	 * 批量修改折扣
	 */
	function disc(){
		debug();
		if(empty($_POST['discount'])){
			echo false;
			return;
		}
		$p = D('product');
		$ids = explode(',',$_POST['id']);
		foreach($ids as $v){
			$_POST['id'] = $v;
			$p->update();
		}
		echo true;
	}
	/**
	 * 添加图片信息
	 */
	function insertimg(){
		debug();
		$pic = D('pic');
		$arr = explode(',',$_POST['picname']);
		//p($_POST);
		foreach($arr as $v){
			$_POST['picname'] = $v;
			if(!$pic->insert()){
				echo false;
				return;
			}
		}
		echo true;
	}
	/**
	 * 添加商品详情信息
	 */
	function insertpd(){
		debug();
		//p($_POST);
		$pd = D('pdetail');
		$carr = explode(',',$_POST['cid']);
		$sarr = explode(',',$_POST['size']);
		$narr = explode(',',$_POST['number']);
		for($i=0;$i<count($carr);$i++){
			$_POST['cid'] = $carr[$i];
			$_POST['size'] = $sarr[$i];
			$_POST['number'] = $narr[$i];
			if(!$pd->insert()){
				echo false;
				return;
			}
		}
		echo true;
	}
	/**
	 * 添加商品信息
	 */
	function insert(){
		debug();
		$_POST['ptime'] = time();
		$p = D("product");
		echo $p->insert();
	}
	/**
	 * 无刷新图片上传并执行修改操作
	 */
	function ajud(){
		debug();
		$info = $this->upload();
		if($info[1]){
			echo "<script>";
			echo "parent.update('".json_encode($info[0])."')";
			echo "</script>";
			
		}elseif(strip_tags($info[0][0])=='上传文件时出错 : 没有文件被上传'){ //在修改时可以不修改图片
			echo "<script>";
			echo "parent.update()";
			echo "</script>";
		}else{
			echo "<script>";
			echo "parent.uperror('".strip_tags($info[0][0])."')";
			echo "</script>";
		}
		
	}
	/**
	 * 修改商品状态：在售、下架
	 */
	function changestate(){
		$p = D('product');
		$_POST['ptime'] = time();
		echo $p->update();
	}
	/**
	 * 修改商品信息的界面
	 */
	function mod(){
		debug();
		$p = D('product');
		$data = $p->field('id,typeid,styleid,intro')->where($_GET['id'])->r_select(
			array('pic','pid,picname','pid')
		);
		$intro = str_replace('：',',',$data[0]['intro']);
		$intro = explode(',',$intro);
		for($i=1;$i<count($intro);$i+=2){
			$arr[] = $intro[$i];
		}
		$data[0]['intro'] = $arr;
		//p($data);
		echo json_encode($data);
	}
	/**
	 * 修改商品信息
	 */
	function update(){
		debug();
		if($_POST['picname']){
			$pic = D('pic');
			$i=0;
			$imgs = explode(',',$_POST['picname']);
			foreach($imgs as $v){
				if($i<$pic->where(array('pid'=>$_POST['id']))->total()){
					$data = $pic->field('picname,pid')->where(array('pid'=>$_POST['id']))->limit($i,1)->select();
					$pic->where(array('picname'=>"{$data[0]['picname']}"))->update(array('picname'=>$v));
					unlink("./public/uploads/".$data[0]['picname']);
					unlink("./public/uploads/_".$data[0]['picname']);
					unlink("./public/uploads/mini_".$data[0]['picname']);
					
				}else{
					$pic->insert(array('pid'=>$_POST['id'],'picname'=>"$v"));
				}
				$i++;
				
			}
		}
		$p = D("product");
		echo $p->update();
	}
	/**
	 * 删除商品信息
	 */
	function del(){
		debug();
		$p = D('product');
		$pd = D('pdetail');
		$pic = D('pic');
		$ids = explode(',',$_GET['id']);
		foreach($ids as $v){
			$_GET['id'] = $v;
			$data = $pic->field('picname')->where(array('pid'=>$_GET['id']))->select();
			if(!$p->where($_GET['id'])->r_delete(array('pdetail','pid'),array('pic','pid'))){
				echo false;
				return;
			};
			//删除该商品对应的图片
			foreach($data as $vv){ 
				echo $vv['picname'];
				unlink("./public/uploads/{$vv['picname']}");
				unlink("./public/uploads/mini_{$vv['picname']}");
				unlink("./public/uploads/_{$vv['picname']}");
			}
			
		}
		echo true;
	}
	/**
	 * 批量修改商品状态
	 */
	function sellall(){
		debug();
		$p = D('product');
		$id = explode(',',$_POST['id']);
		foreach($id as $v){
			$_POST['ptime'] = time();
			$_POST['id'] = $v;
			$p->update();
		}
		echo true;
	}
}

