<?php
class Product{
	/**
	 * 商品详情页面
	 * 根据传入的商品ID获取商品的信息
	 */
	function index(){
		$id=$_GET['id'];
		$goods=D('product');
		//记录浏览过的商品
		if(empty($_COOKIE['goodss'])){
			setcookie("goodss",$id,time()+30*24*3600,"/");
		 }else{
			$a=$_COOKIE['goodss'];
			$arr=explode("#",$a);
			if(!in_array("$id",$arr)){
			$arr[]=$id;
			$c=implode("#",$arr);
			setcookie("goodss",$c,time()+30*24*3600,"/");}
		 }
		 
		  //p($_COOKIE['goods']);
		 //从cookie里读取浏览记录
			$hisgoods=$_COOKIE['goodss'];
			$arr2=array();
			$arr2=explode("#",$a);
			array_reverse($arr2);
			$arr1=array_chunk($arr2, 5);
			$hisdata=$goods->where($arr1[0])->limit(0,5)->select();
			
			$hisstr="";
			foreach($hisdata as $kk=>$ogood){
				$hisstr.="<li><span class='img'><img style='display: inline;' src='/czshop/public/uploads/_".$ogood['mpic']." '></span>";
				$hisstr.="<span><a style='outline: medium none;' href='<{\$app}>/product/id/'".$ogood['id']."target='_blank'>";
				 $hisstr.=$ogood['name']."</a></span><span class='price_sc'>市场价：<s>￥".$ogood['price']."</s></span><span class='price_sc'>优购价:<b class='Yellow Size14'>￥";
				$hisstr.= $ogood['price']/10*$ogood['discount']."</b> <font class='price_sc'>(".$ogood['discount']."折)</font><span></span></span></li>";		
			}
			//p($hisdata);
			$this->assign("hisstr",$hisstr);
		//浏览记录结束
		
		
		$type=D('type');
		$this->assign('meau',$type->selectguan());
		//馆信息
		$pidname=$type->find($goodsinfo[0]['pid']);
		$this->assign("pidname",$pidname);
		//商品信息
		$goodsinfo=$goods->where($id)->r_select(array("type","tname,pid","id","typeid"));
		$this->assign("goodsinfo",$goodsinfo);
		//p($goodsinfo);
		//p($pidname);
		//商品图片组
		$pic=D('pic');
		$picdata=$pic->where(array("pid"=>$id))->limit(0,5)->select();
		//p($picdata);
		$this->assign("picdata",$picdata);
		//颜色数组
		$pdetail=D('pdetail');
	    $colordata=$pdetail->where(array("pid"=>$id,"number >"=>0))->group('cid')->r_select(array("color","cname,cvalue","id","cid"));
		//p($colordata);
		//p($_SESSION['shopingcar']);
		$this->assign("colordata",$colordata);
		//收藏人数
		$collect=D('collect');
		$colldata=$collect->field('count(uid) as count')->where(array("pid"=>$id))->select();
		//P($colldata);
		$this->assign("colldat",$colldat);
		//商品描述
		$intro=$goodsinfo[0]['intro'];
		//p($intro);
		$introdata=array();
		$introdata=explode(",",$intro);
		//p($introdata);
		$introstr="";
		foreach($introdata as $key=>$row){
			if($key%2==0){
				$introstr.="<td class='td1' style='text-align:center;'><span>".$row."</span></td>";
			}else{
				$introstr.="<td class='td1' style='text-align:center;'><span>".$row."</span></td></tr><tr>";
			}
		}
		//p($introstr);
		$this->assign("introstr",$introstr);
		$this->display();
	}
	/**
	 * 通过查询语句查询出本商品还有货的尺码
	 */
	function size(){
		debug();
		$id=$_GET['id'];
		$pdetail=D('pdetail');
		$size=$pdetail->field('size')->where(array("cid"=>$id,"number >"=>0))->select();
		echo json_encode($size);
		//p($size);
	}
	/**
	 * 通过查询语句查询出本商品还有货的尺码的鞋子库存还有多少
	 */
	function max(){
		debug();
		$id=$_GET['cid'];
		$size=$_GET['size'];
		$pdetail=D('pdetail');
		$max=$pdetail->field('number')->where(array("cid"=>$id,"size"=>$size))->find();
		//p($max);
		echo json_encode($max);
	}
	/**
	 * 点击立即购买即将要购买的商品信息存入session
	 */
	function buy(){
		$_SESSION['one'][0]=$_POST;
		$this->redirect("orders/index");
	}
	/**
	 * 点击加入购物车按钮将商品信息存入session中
	 */
	function add(){
		foreach($_SESSION['shopingcar'] as $k=>$row){
			if($row['id']==$_POST['id'] && $row['size']==$_POST['size'] && $row['cid']==$_POST['cid']){
				$row['num']+=$_POST['num'];
				$_SESSION['shopingcar'][$k]['num']=$row['num'];
				$this->success("加入成功!");
				return;
			}
		}
		$_SESSION['shopingcar'][]=$_POST;
		$this->success("加入成功!");
		//p($_POST);
	}
	/**
	 * 点击收藏按钮收藏该商品
	 */
	function store(){
		debug();
		$_POST['uid']=$_SESSION['id'];
		$collect=D('collect');
		$aaa=$collect->where(array("uid"=>$_POST['uid'],"pid"=>$_POST['pid']))->find();
		if($_SESSION['login']==1){
			if(!empty($aaa)){
				echo 1;
			}else{
			$data=$collect->insert();
				if($data){
					echo 2;
				}else{
					echo 3;
				}
			}
		}else{
			echo 4;
		}
	}
	/**
	 * 加入购物车时
	 */
	function cardel(){
				debug();
				$id=$_GET['id'];
				foreach($_SESSION['shopingcar'] as $key =>$row){	
					if($row['id']==$id){	
					unset($_SESSION['shopingcar'][$key]);
					echo 5;
					}
				}
			
			}
}