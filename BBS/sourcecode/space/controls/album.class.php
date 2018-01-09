<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 相册管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-26 15:52  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Album{
		/*
			显示相册列表
		*/
		public function index(){
			$this->assign("data",D("album")->album_list($_GET['uid']));//根据用户ID分配相册列表数组给模板的data变量
			$this->display();//显示模板
		}
		
		/*
			显示相册内照片列表
		*/
		public function photo_list(){
			debug();//防止debug信息干扰Ajax加载数据
			$pdata = D("photo")->select(array("pa_id"=>$_GET['aid']));//查询相册里的照片数据
			$total=D("album")->photo_total($_GET['aid']);//调用album模型的photo_total方法,返回相册照片总数
			$name = D("album")->field("name")->find($_GET['aid']);//查询相册名称
			$this->assign("aname",$name['name']);//将相册名称数据分配给模板
			$this->assign("pdata",$pdata);//将照片列表数据分配给模板
			$this->assign("total",$total);//将照片总数数据分配给模板
			$this->display();//显示模板
		}
		
		/*
			删除照片方法
		*/
		public function photo_del(){
			if(D("photo")->delete($_GET['pid'])){//根据照片ID删除照片
				$this->success("删除成功!",2);
			}else{
				$this->error("您没有删除成功!",1);
			}
		}
		
		/*
			显示单张照片详情
		*/
		public function photo_detail(){
			$name = D("album")->field("name")->find($_GET['aid']);//查询相册名称
			$this->assign("aname",$name['name']);//将查询出的数据分配给模板
			$pdata = D("photo")->field("img_path")->find($_GET['pid']);//根据照片ID查询照片文件名称
			$this->assign("pdata",$pdata['img_path']);//将查询出的数据分配给模板
			$this->display();//显示模板
		}
		
		/*
			在相册中上传照片页面
		*/
		public function add_photo(){
			$alist = D("album")->filed("id,name")->select(array("uid"=>$_GET['uid']));//根据用户ID查询相册ID和名称
			$pa=array();//定义一个空数组
			foreach($alist as $a){//遍历查询出的相册数据
				$pa[$a['id']]=$a['name'];//将数据分配给创建的空数组
			}
			if($_GET['aid']){//若已选择相册,下拉列表显示当前相册
				$this->assign("pa_id",$_GET['aid']);//将当前已选相册ID分配给模板
				$this->assign("pa",$pa);//将上述遍历出的所有相册数据分配给模板
			}else{
				$this->assign("pa",$pa);//如果未选择相册则显示所有
			}
			$this->display();//显示模板
		}
		
		/*
			在相册中上传照片方法,配置缩略图大小
		*/
		public function insert_photo(){
			$pdata = $this->upload();//调用upload方法
			$img=new Image("./public/uploads/album");        //创建图片对象
			$_POST['ptime']=time();//分配当前时间到上传时间字段
			foreach($pdata as $p){//遍历上传的图片文件名
				$_POST['img_path']=$p;//分配文件名到数据库字段
				$imgname=$img->thumb($p, 120, 120, "th_"); //缩放图片
				D("photo")->insert();//执行添加
			}
			$this->success("上传成功",3,"album/index/uid/{$_GET['uid']}");
		}
		
		/*
			添加相册页面
		*/
		public function add_album(){
			$this->display();//显示模板
		}
		
		/*
			添加相册方法,并增加相应的积分
		*/
		public function insert_album(){
			$_POST['ptime']=time();//分配当前时间到上传时间字段
			$_POST['uid']=$_GET['uid'];//分配用户ID到数据库字段
			if(D("album")->insert()){//如果执行添加成功,则增加相应积分
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_PHOALBUM_REWARD);
				$this->success("添加成功! 积分增加 ".S_PHOALBUM_REWARD." 分",1,"album/index/uid/{$_GET['uid']}");
			}else{
				$this->error("添加失败!",1);
			}
		}
		
		/*
			设置相册封面图片
		*/
		public function setCover(){
			debug();//防止debug信息干扰Ajax加载数据
			$pdata = D("album")->cover_pic($_GET['pid']);//调用album模型的cover_pic方法
			if(D("album")->where(array("id"=>$_GET['aid']))->update(array("cover_path"=>$pdata['img_path']))){
				echo $pdata['img_path'];//如果更新相册封面成功,则输出封面图片文件名称
			}else{
				echo "th_nophoto.gif";//否则输出默认封面图片
			}
		}
		
		/*
			更改相册信息页面
		*/
		public function edit_album(){
			$au = D("album")->field("authority")->find($_GET['aid']);//查询出相册的权限
			$this->assign("data",D("album")->fileld("name")->find($_GET['aid']));//查询出相册名称分配给模板
			$this->assign("authority_id",$au['authority']);//分配相册的当前权限到模板
			$this->assign("authority",array(0=>"仅自己可见",1=>"完全公开",2=>"仅注册会员可见"));//分配所有权限到模板
			$this->display();
		}
		
		/*
			更改相册信息方法
		*/
		public function update_album(){
			if(D("album")->where(array("id"=>$_GET['aid']))->update()){//执行更新相册信息
				$this->success("修改成功",1,"album/index/uid/{$_GET['uid']}");
			}else{
				$this->error("修改失败",1);
			}
		}
		
		/*
			删除相册方法
		*/
		public function delete_album(){
			if(D("album")->where(array("id"=>$_GET['aid']))->delete()){//执行删除相册
				$this->success("删除成功",1,"album/index/uid/{$_GET['uid']}");
			}else{
				$this->error("删除失败",1);
			}
		}
		
		/*
			上传文件方法
		*/
		Private function upload(){//只允许内部调用,因此封装为私有方法
			$up = new FileUpload(); //可以通过参数指定上传位置，可通过set()方法
			$up->set("path", "./public/uploads/album")  //设置上传位置
				  ->set("maxSize", 1000000)             //设置上传大小，单位字节  
				  ->set("allowType", array("gif","jpg","png","jpeg")) //设置允许上传的类型
					//设置启用上传后随机文件名，true启用（默认）， false使用原文件名
				  ->set("israndname", true)
					//设置上传图片的缩放大小，还可以通过prefix指定新名前缀
				  ->set("thumb", array("width"=>"500", "height"=>"500"));
				if($up->upload("pic")) {  //pic为上传表单的名称
					return $up->getFileName();  //返回上传后的文件名
				}else{ 
				//如果上传失败提示出错原因
					$this->error($up->getErrorMsg(), 0, "album/index/uid/{$_GET['uid']}");
				}
		}
	}