<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 主题控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:55  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Subject{
		/*
			主题列表首页
		*/
		public function index(){
			$board=D('board');	//板块模型
			$subject=D('subject');	//主题模型
			//where条件
			$array_where=array('ptype !='=>'0');//数组式的where条件
			$url_where='';//url式的where条件
			//板块id
			if(!empty($_GET['bid'])){
				$array_where['bid']=$_GET['bid'];
				$url_where.="/bid/{$_GET['bid']}";
			}
			//时间排序
			if(!empty($_GET['ptime'])){
				$array_where['ptime >=']=time()-$_GET['ptime'];
				$url_where.="/ptime/{$_GET['ptime']}";			
			}
			//主题类型排序
			if(!empty($_GET['ptype'])){
				$array_where['ptype']=$_GET['ptype'];
				$url_where.="/ptype/{$_GET['ptype']}";
			}				
			//order排序
			$order='';
			if(!empty($_GET['order'])){
				switch($_GET['order']){
					case 'default':
						$order='';
						$order_url='/order/default';	//默认排序
						break;
					case 'click_down':
						$order='click_num desc';
						$order_url='/order/click_down';//点击量倒序
						break;
					case 'click_up':
						$order='click_num asc';
						$order_url='/order/click_up';//点击量正序		
						break;
					case 'no_down':
						$order='no_num desc';
						$order_url='/order/no_down';//反对量倒序
						break;
					case 'no_up':
						$order='no_num asc';
						$order_url='/order/no_up';//反对量正序
						break;
					case 'yes_down':
						$order='yes_num desc';
						$order_url='/order/yes_down';//支持量倒序
						break;
					case 'yes_up':
						$order='yes_num asc';//支持量正序
						$order_url='/order/yes_up';						
						break;
					case 'time_down':
						$order='ptime desc';//时间倒序
						$order_url='/order/time_down';		
						break;
					case 'time_up':
						$order='ptime asc';//时间正序
						$order_url='/order/time_up';						
					break;
				}						
			}
			/*
				分页加搜索
			*/
			$page=new Page($subject->where($array_where)->total(),B_SUBJECTPZ,$url_where.$order_url);
			$page->set('head','个主题');//更改分页显示的字
			$this->assign('fpage',$page->fpage(0,4,5,6));//分配分页条
			$subj_list=$subject->subj_list($_GET['bid'],$page->limit,$array_where,$order);//得到指定的条件的主题
			$this->assign('title',$board->board_name($_GET['bid']).'-源代码');//分配标题
			$this->assign('subj_list',$subj_list);//分配主题列表
			$this->assign('board_name',$board->board_name($_GET['bid']));//分配版块名
			$this->assign('board_subj_num',$subject->sub_board_today_subj_num($_GET['bid']));//分配板块主题数量
			$zone_board_list=$board->zone_board_list();//得到分区与板块
			$this->assign('zone_board_list',$zone_board_list);//分配分区与版块的列表(页面左边的下拉式的板块导航)
			$this->assign('nav_chain',$board->board_nav($_GET['bid']));//分配导航链
			$this->display();
		}
		
		/*
			主题详情页
		*/
		public function info(){
			$subject=D('subject');//主题模型
			$comment=D('comment');//主题回复模型
			$subj_info=$subject->subj_info($_GET['sid']);//主题详情
			$this->assign('title',$subj_info['title'].'-源代码');//分配标题
			$this->assign('subj_info',$subj_info);//分配主题详情
			$page=New Page($comment->where(array('sid'=>$_GET['sid']))->total(),B_COMMENTPZ,'/sid/'.$_GET['sid']);//分页
			$page->set('head','个回复');
			$this->assign('fpage',$page->fpage(0,4,5,6));//分配分页条
			$this->assign('all_comm',$comment->subj_all_comm($_GET['sid'],$page->limit));//分配指定条数的回复
			$subject->where(array('id'=>$_GET['sid']))->update("click_num=click_num+1");//更新点击量
			$this->assign('nav_chain',$subject->subj_nav($_GET['sid']));//分配导航链			
			$this->display(null,$_SERVER['REQUEST_URI']);
		}
		
		/*
			发表主题
		*/
		public function insert(){
			$_POST['ptime']=time();//发表时间
			$_POST['uid']=$_SESSION['user_info']['id'];//发表者的uid
			$_POST['ip']=sprintf('%u',ip2long($_SERVER['REMOTE_ADDR']));//ip
			//如果在两次发表主题间隔时间外,那么就可以发帖,否则提示用户
			if(time()-$_SESSION['user_info']['last_post_time']<PUBLISH_INTERVAL_SUBJECT){
				$this->error('抱歉,您两次发表间隔少于 '.PUBLISH_INTERVAL_SUBJECT.' 秒,请稍候再发表',2);
				exit;
			}
			//如果发表成功,将提示用户,并加分.否则提示错误
			if($sid=D('subject')->insert($_POST)){
				$mess='发表主题成功!加 <b> '.B_SUBJECT_REWARD.'</b> 个积分';
				$_SESSION['user_info']['last_post_time']=time();//将最后一次发表主题的时间写入session
				D('user')->add_grade($_POST['uid'],B_SUBJECT_REWARD);//加积分
				$this->success($mess,3,"subject/info/sid/$sid");//调出成功提示页面
			}else{
				$this->error('发表主题失败!',3);
			}
		}
		
		/*
			显示发表主题页面
		*/
		public function post_subj_page(){
			$board=D('board');//板块模型
			//得到板块的id与名称
			$boards=$board->field('id,name')
							  ->where(array('display'=>'1','parent_id !='=>'0'))
							  ->order('order_num asc')
							  ->select();
			$keys=array();	//所有板块的id
			$values=array();//所有板块的名称
			foreach($boards as $b){
				$keys[]=$b['id'];//板块id
				$values[]=$b['name'];//板块名称
			}
			$board_list=array_combine($keys,$values);//组合
			$this->assign('board_list',$board_list);//分配板块
			$this->assign('title','发表主题-'.TITLE);//分配标题
			$nav=$board->index_nav();
			$nav[]=array('url'=>B_APP.'/subject/post_subj_page','name'=>'发表主题');//得到导航链并组合
			$this->assign('nav_chain',$nav);//分配导航链
			$this->display();
		}
		
		/*
			搜索出来的主题首页
		*/
		public function search_subj_index(){
			$where=array('ptype !='=>'0');//数组式的where条件(不搜索被屏蔽的主题)
			$subject=D('subject');//主题模型
			$board=D('board');//板块模型
			$user=D('user');//用户模型
			$comment=D('comment');//主题评论模型
			$url_where='';//url式的where条件
			if(!empty($_GET['keyword'])){
				$where['title']='%'.$_GET['keyword'].'%';
				$where=array('content'=>"%{$_GET['keyword']}%");
				$url_where="/keyword/{$_GET['keyword']}/search_type/{$_GET['search_type']}";
			}
			$page=New Page($subject->where($where)->total(),B_SUBJECTPZ,$url_where);
			//得到主题的id,标题,内容,时间,板块id,点击量,用户id
			$subj_list=$subject->field('id,uid,title,content,ptime,bid,click_num')
							   ->where($where)
							   ->order('ptime desc')
							   ->limit($page->limit)
							   ->select();
			//附加发表者的用户名,板块名,评论量
			foreach($subj_list as &$sbj){
				$user_name=$user->user_name($sbj['uid']);
				$sbj['author']=$user_name;//用户名
				$sbj['board_name']=$board->board_name($sbj['bid']);//板块名
				$sbj['comm_num']=$comment->subj_comm_num($sbj['id']);//评论数量
			}
			$this->assign('title','主题列表-'.TITLE);//分配标题
			$this->assign('fpage',$page->fpage(0,3,4,5,6));//分配分页条
			$this->assign('nav_chain',D('pub')->subj_search_nav());//分配导航链
			$this->assign('subj_list',$subj_list);//分配主题列表
			$this->display();
		}
		
		/*
			对主题发表观点
		*/
		public function viewpoint(){
			$subject=D('subject');
			$uid=$subject->subj_of_uid($_GET['sid']);
			//不能对自己的主题发表观点
			if($uid==$_SESSION['user_info']['id']){
				echo 0;
				exit;
			}
			//如果评论成功,输出1,否则输出0
			if($subject->viewpoint($_GET['sid'],$_GET['type'])){
				echo 1;
			}else{
				echo 0;
			}
		}
		
		/*
			主题操作(1=置顶 2=精华 3=推荐 4=普通 0=关闭 5=彻底删除)
		*/
		public function subject_opera(){
			$subject=D('subject');//主题模型
			$add_grade=array('1'=>B_SUBJECT_TOP,'2'=>B_SUBJECT_ESS,'3'=>B_SUBJECT_RECOM);//加分制度
			//如果操作成功,输入1,否则输出0
			if($subject->subject_opera($_POST['sid'],$_POST['type'])){
				switch($_POST['type']){
					case '1':
					case '2':
					case '3':
						$uid=$subject->field('uid')->where(array('id'=>$_POST['sid']))->find();//得到发表这个主题的用户id
						D('user')->add_grade($uid['uid'],$add_grade[$_POST['type']]);//加分
					break;
				}
				echo 1;
			}else{
				echo 0;
			}
		}
		
		/*
			显示编辑已发表的主题的页面
		*/
		public function editor(){
			//板块列表
			$board=D('board');//版块模型
			$subject=D('subject');//主题模型
			//得到板块的id与名称
			$boards=$board->field('id,name')
							  ->where(array('display'=>'1','parent_id !='=>'0'))
							  ->order('order_num asc')
							  ->select();
			$keys=array();//板块id
			$values=array();//版块名
			foreach($boards as $b){
				$keys[]=$b['id'];
				$values[]=$b['name'];
			}
			$board_list=array_combine($keys,$values);//组合id与名称
			$this->assign('board_list',$board_list);//分配板块
			$bid=$subject->field('bid')->where(array('id'=>$_GET['sid']))->find();//主题所在板块id
			$this->assign('bid',$bid['bid']);//分配主题所在的板块id
			$title_and_content=$subject->field('title,content')->where(array('id'=>$_GET['sid']))->find();//主题标题与内容
			$this->assign('title_and_content',$title_and_content);//分配主题标题与内容
			$this->assign('title','编辑主题-'.TITLE);//分配标题
			$nav=$board->index_nav();//导航链
			$this->assign('nav_chain',$nav);//分配导航链
			$this->display();
		}
		
		/*
			更新主题
		*/
		public function update(){
			$subject=D('subject');
			if($subject->where(array('id'=>$_POST['sid']))->update($_POST)){
				$this->success('修改成功',1,'subject/info/sid/'.$_POST['sid']);
			}else{
				$this->error('修改失败',2);
			}
		}
	}