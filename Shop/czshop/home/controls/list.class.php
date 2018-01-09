<?php
class list{
	/**
	 * 商品列表页面，有搜索功能
	 */
	function index(){
		//删除选项
		if($_GET['unset']){
			unset($_GET[$_GET['unset']]);
			if($_GET['unset']=='sname') unset($_GET['styleid']);
			if($_GET['unset']=='tname') unset($_GET['typeid']);
			if($_GET['unset']=='pname') unset($_GET['price']);
			if($_GET['unset']=='cname') unset($_GET['cid']);
		}
		//拼装分页条件，搜索条件	
		$t = D("type");
		$this->assign('meau',$t->selectguan());
		$pid = $t->field('id')->where(array('pid'=>$_GET['pid']))->select();
		foreach($pid as $vv){
			$strpid .= $vv['id'].",";
		}
		$strpid = "(".rtrim($strpid,',').")";
		$where1 = array('cid','size');
		$where2 = array('typeid','price','styleid');
		$where3 = array('tname','pname','sname','cname','size');
		$where = array('typeid','price','styleid','cid','size','pid','tname','pname','sname','cname');
		$search = array("pstate"=>1);
		foreach($_GET as $k=>$v){
			if(!empty($v) && in_array($k,$where)){
				$str .= "/".$k."/".$v;
			}
			//if(!empty($v) && in_array($k,$where3)){
			//	$show .= "<label><a href='".B_URL."/index/pid/{$_GET['pid']}/unset/$k' class='Sh-code'><font>$v</font></a></label>";
			//}
			if(!empty($v) && in_array($k,$where1)){
				$search1[$k] = $v;
			}
			if(!empty($v) && in_array($k,$where2)){
				if($k=='price'){
					if($v==1) $search2 .= " && price*discount/10 < 200";
					if($v==2) $search2 .= " && price*discount/10 >= 200 && price*discount/10 < 300";
					if($v==3) $search2 .= " && price*discount/10 >= 300 && price*discount/10 < 500";
					if($v==4) $search2 .= " && price*discount/10 >= 500 && price*discount/10 < 600";
					if($v==5) $search2 .= " && price*discount/10 >= 600 && price*discount/10 < 700";
					if($v==6) $search2 .= " && price*discount/10 >= 700";
				}else $search2 .= " && $k = $v";
			}
		}
		foreach($_GET as $k1=>$v1){
			if(!empty($v1) && in_array($k1,$where3)){
				$show .= "<label><a href='".B_URL."/index$str/unset/$k1' class='Sh-code'><font>$v1 |</font><img src='".B_RES."/images/icon_delete.gif' alt=''></a></label>";
				
			}
		}
		if(!empty($search1)){
			$pd = D("pdetail");
			$pdetail = $pd->field("id,pid,size,number,cid")->where($search1)->select();
			foreach($pdetail as $vv){
				if(!in_array($vv['pid'],$arrpd)){
					$arrpd[] = $vv['pid'];
				}
			}
			$strpd = "&& id in (".implode(',',$arrpd).")";
		}
		//实现搜索，分页
		$p = D("product");
		$page = new Page($p->where("pstate=1 && typeid in $strpid $strpd $search2")->total(),10,$str);
		$page->set("head","个商品")
		     ->set("next",">>|")
		     ->set("prev","|<<")
		     ->set("first","|<")
		     ->set("last",">|");
		$data = $p->field('id,name,price,typeid,styleid,ptime,mpic,discount')
			  ->where("pstate=1 && typeid in $strpid $strpd $search2")
			  ->order('id asc')
			  ->limit($page->limit)
			  ->select();
		//p($data);
		$this->assign("data",$data);
		$this->assign("fpage",$page->fpage(3,4,5,6,0));
		$c = D("color");
		$color = $c->select();
		$this->assign('color',$color);
		$cat = $t->where(array('pid'=>$_GET['pid']))->select();
		$this->assign('cat',$cat);
		$s = D("style");
		//$style = $s->field('id,sname')->select();
		foreach($cat as $v){
			$arr[] = $v['id'];
		}
		$sids = $p->field('styleid')->where(array('typeid'=>$arr,'pstate'=>1))->select();
		$arr = array();
		foreach($sids as $v){
			if(!in_array($v['styleid'],$arr)){
				$arr[] = $v['styleid'];
			}
		}
		$style = $s->field('id,sname')->where(array('id'=>$arr))->select();

		$this->assign("style",$style);
		$this->assign("str",trim($str,'/'));
		$this->assign("guan",$_GET['pid']);
		$this->assign("show",$show);
		$this->display();
	}
}
