<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 个人资料管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-30 02:12  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Profile{
	
		/*
			显示个人资料首页
		*/
		public function index(){
			$new_speak=D("speak")->field("content")->order("ptime desc")->limit(1)->select($_GET['uid']);
			//查询说说内容
			$data = D("user")->user_detail($_GET['uid']);
			//调用user模型的user_detail模型
			$this->assign("user_info",D("user")->user_detail($_GET['uid']));
			//将用户详细信息分配到模板
			$this->assign("total",D("user")->user_total($_GET['uid']));
			//将用户统计数据分配到模板
			$this->assign("new_speak",$new_speak[0]['content']);
			//将用户最新说说分配到模板
			$this->assign("user_level",D("user","bbs")->get_level($_GET['uid']));
			//将用户等级分配到模板
			$this->display();
			//显示模板
		}
		
		/*
			显示个人资料修改页面
		*/
		public function edit(){
			$user_info=D("user")->field("name,sex,true_name,email,birthday,hobby,marriage,pal_aim,sign")->find($_SESSION['user_info']['id']);
			//查询当前用户的详细信息
			$sex=array(0=>"保密",1=>"男",2=>"女");
			//定义一个性别数组
			$marry=array(0=>"保密",1=>"未婚",2=>"已婚");
			//定义一个婚姻状态数组
			$add=D("profile")->get_add($_SESSION['user_info']['id']);
			//调用profile模型的get_add方法
			$this->assign("birth_province_id",$add['birth_province_id']);
			//将出生省市ID分配到模板
			$this->assign("birth_city_id",$add['birth_city_id']);
			//将出生城市ID分配到模板
			$this->assign("live_province_id",$add['live_province_id']);
			//将居住省市分配到模板
			$this->assign("live_city_id",$add['live_city_id']);
			//将居住城市分配到模板
			$this->assign("province",D("profile")->province_add());
			//调用profile模型的province_add方法,将返回数据分配到模板
			$this->assign("birth_city_all",D("profile")->city_add($add['birth_province_id']));
			//调用profile模型的city_add方法,将返回数据分配到模板
			$this->assign("live_city_all",D("profile")->city_add($add['live_province_id']));
			//调用profile模型的city_add方法,将返回数据分配到模板
			$this->assign("sex_all",$sex);
			//分配性别列表到模板
			$this->assign("sex",$user_info['sex']);
			//将用户性别分配给模板
			$this->assign("marry_all",$marry);
			//将婚姻状态列表分配到模板
			$this->assign("marry",$user_info['marriage']);
			//将用户婚姻状态分配给模板
			$this->assign("user_info",$user_info);
			//将用户信息分配到模板
			$this->display();
			//显示模板
		}
		
		//执行修改个人资料操作
		public function doedit(){
			$_POST['birth_add']=$_POST['birth_province'].",".$_POST['birth_city'];
			//拼装用户出生地址
			$_POST['live_add']=$_POST['live_province'].",".$_POST['live_city'];
			//拼装用户居住地址
			if($_POST['birthday']!="请在这里输入您的生日!"){
				$_POST['birthday']=strtotime($_POST['birthday']);
				//将生日转换成时间戳
			}
			if(D("user")->where($_POST['id'])->update()){
			//执行更新用户信息
				D("user")->flush_session($_SESSION['user_info']['id']);
				//刷新session
				$this->success("修改成功",1,"profile/edit_pass/uid/{$SESSION['user_info']['id']}");
			}else{
				$this->error("您没有修改",1);
			}
		}
		
		/*
			显示省份对应的城市,并在前台用Ajax显示,实现省市联动的效果
		*/
		public function address(){
			debug();//防止debug信息干扰Ajax加载数据
			$this->assign("city",D("profile")->city_add($_POST['bpid']));
			//调用profile模型的city_add方法
			$this->display();
			//显示模板
		}
		
		/*
			修改头像页面
		*/
		public function edit_avar(){
			$user=D("user")->user_info($_SESSION['user_info']['id']);
			//调用user模型的user_info方法
			$this->assign("avar",$user['face_path']);
			//分配用户头像数据到模板
			$this->display();
			//显示模板
		}
		
		/*
			修改头像方法,更新头像,删除旧头像并加分
		*/
		public function doedit_avar(){
			$b_avar = $this->upload();
			//调用上传方法
			if($b_avar!=''){
			//若上传成功,则查询用户头像文件名称
				$avar = D("user")->field("face_path")->find($_SESSION['user_info']['id']);
				if($_SESSION['user_info']['face_path']!='default.gif'){
					unlink("./public/uploads/user/s_".$avar['face_path']);
					//删除大头像文件
					unlink("./public/uploads/user/m_".$avar['face_path']);
					//删除小头像文件
				}
			}
			$img=new Image("./public/uploads/user");        //创建图片对象
			$s_avar=$img->thumb($b_avar, 48, 48, "s_"); //缩放图片
			$m_avar=$img->thumb($b_avar, 120, 120, "m_"); //缩放图片
			unlink("./public/uploads/user/".$b_avar);	//删除图片文件
			if(D("user")->update(array("id"=>$_SESSION['user_info']['id'],"face_path"=>$b_avar))){
			//如果更新成功,则增加积分
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_MODFACE_REWARD);
				D("user")->flush_session($_SESSION['user_info']['id']);
				//刷新session
				$this->success("上传成功 ! 积分增加 ".S_MODFACE_REWARD." 分!",1);
			}else{
				$this->error("上传失败!",1);
			}
		}
		
		/*
			修改密码页面
		*/
		public function edit_pass(){
			$this->display();//显示模板
		}
		
		/*
			执行修改密码方法
		*/
		public function doedit_pass(){
			$pass=md5($_POST['pass']);
			//将输入的密码md5加密
			$affectnums = D("user")->update(array("id"=>$_SESSION['user_info']['id'],"pass"=>$pass));
			//更新用户密码
			if($affectnums>0){
				$this->success("修改成功!",1);
			}else{
				$this->error("修改失败!",1);
			}
		}
		
		/*
			验证原始密码方法
		*/
		public function checkpass(){
			debug();//防止debug信息干扰Ajax加载数据
			$_POST['pass']=md5($_POST['pass']);//将输入的密码md5加密
			if(D("user")->where(array("id"=>$_SESSION['user_info']['id'],"pass"=>$_POST['pass']))->find()){
			//如果密码正确则输出"true"
				echo "true";
			}else{
				echo "false";
			}
		}
		
		/*
			上传文件方法
		*/
		Private function upload(){
			$up = new FileUpload(); //可以通过参数指定上传位置，可通过set()方法
			$up->set("path", "./public/uploads/user")  //设置上传位置
				  ->set("maxSize", 1000000)             //设置上传大小，单位字节  
				  ->set("allowType", array("gif","jpg","png","jpeg")) //设置允许上传的类型
					//设置启用上传后随机文件名，true启用（默认）， false使用原文件名
				  ->set("israndname", true)
					//设置上传图片的缩放大小，还可以通过prefix指定新名前缀
				  ->set("thumb", array("width"=>"120", "height"=>"120"));
				if($up->upload("avar")) {  //avar为上传表单的名称
					return $up->getFileName();  //返回上传后的文件名
				}else{ 
				//如果上传失败提示出错原因
					$this->error($up->getErrorMsg(), 0);
				}
		}
	}