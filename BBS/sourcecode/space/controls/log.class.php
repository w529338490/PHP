<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 日志管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-24 20:48  										
	  +-----------------------------------------------------------------------------------------+
	*/

	class Log{
		/*
			显示日志首页,列表用Ajax加载
		*/
		public function index(){
			$this->display();//显示模板
		}
		
		/*
			显示日志内容页
		*/
		public function content(){
			$data = D("log")->field("id,title,ptime,content,ip,click_num")->find($_GET['lid']);//显示日志的详细信息
			$this->assign("data",$data);//分配日志详细数据到模板
			$this->assign("logc_total",D("log")->logc_total($_GET['lid']));//分配日志评论总数到模板
			$this->display();//显示模板
		}
		
		/*
			添加日志回复方法,输出积分奖励
		*/
		public function insert_logc(){
			debug();//防止debug信息干扰Ajax加载数据
			$_POST['ptime']=time();//获取当前时间
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));//获取回复IP
			D("log_comm")->insert();//执行添加评论
			D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_LOGC_REWARD);
			//调用bbs应用的user模型的add_grade方法
			echo S_LOGC_REWARD;
			//输出积分奖励
		}
		
		/*
			显示日志评论列表,在日志内容页用Ajax加载
		*/
		public function logc(){
			debug();//防止debug信息干扰Ajax加载数据
			$c_data = D("log");//调用log模型
			$this->assign("cdata",$c_data->logc_list($_GET['lid']));
			//分配日志评论列表到模板
			$this->display();//显示模板
		}
		
		/*
			删除日志评论
		*/
		public function delc(){
			debug();//防止debug信息干扰Ajax加载数据
			D("log_comm")->delete($_GET['cid']);//执行删除评论信息
		}
		
		/*
			发表日志页面
		*/
		public function add(){
			$this->display();//显示模板
		}
		
		/*
			发表日志插入到数据库
		*/
		public function insert(){
			$_POST['uid']=$_GET['uid'];
			$_POST['ptime']=time();
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			if(D("log")->insert()){//如果添加日志成功则增加相应积分
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_LOG_REWARD);
				$this->success("发表成功! 积分增加 ".S_LOG_REWARD." 分",2,"/log/index/uid/{$_GET['uid']}");
			}
		}
		
		/*
			删除日志方法
		*/
		public function delete_log(){
			if(D("log")->delete($_GET['lid'])){
			//如果删除日志成功,则删除该日志下所有评论信息
				D("log_comm")->delete(array("lid"=>$_GET['lid']));
			}
			$this->success("删除日志成功",1,"/log/index/uid/{$_GET['uid']}");
		}
		
		/*
			日志列表页面,在日志首页用Ajax加载
		*/
		public function loglist(){
			$ldata = D("log")->loglist($_GET['uid'],$fpage);
			//调用log模型的loglist方法
			$this->assign("ldata",$ldata);
			//分配返回的数据到模板
			$this->assign("fpage", $fpage);
			//分配分页信息到模板
			$this->display();
			//显示模板
		}
		
		/*
			修改编辑日志页面
		*/
		public function mod(){
			$ddata = D("log")->field("title,content")->find($_GET['lid']);
			//查询日志详情
			$this->assign("ddata",$ddata);
			//将数据分配到模板
			$this->display();
			//显示模板
		}
		
		/*
			更新日志内容到数据库
		*/
		public function update(){
			$_POST['ptime']=time();
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			if(D("log")->where($_GET['lid'])->update()){
			//如果更新日志成功,跳转到成功界面
				$this->success("修改成功!",1,"/log/content/uid/{$_GET['uid']}/lid/{$_GET['lid']}");
			}
		}
		
		/*
			更新日志阅读数量,同一IP多次点击不会增加
		*/
		public function update_cnum(){
			$log = D("log");
			$log_data = $log->field("ip")->where(array("id"=>$_GET['lid']))->find();
			//查询出发表IP
			if($log_data['ip']!=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']))){
			//如果发表ip与当前访问IP不一样,则访问数增加一次
				$log->where(array("id"=>$_GET['lid']))->update("click_num=click_num+1");
			}
		}
	}