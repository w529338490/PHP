<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 用户控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 18:21  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class User{
		/*
			用户列表
		*/
		public function index(){
			$where=array();//数组式的where条件
			$url_where='';//url式的where条件
			if(!empty($_GET['keyword'])){
				$where=array('name'=>"%".$_GET['keyword']."%");
				$url_where="/keyword/{$_GET['keyword']}/search_type/{$_GET['search_type']}";
			}
			$page=New Page(D('user')->where($where)->total(),USERLISTNUM,$url_where);//分页
			$page->set('head','个用户');
			$user=D('user');//用户模型
			//得到用户的id,用户名,积分,头像路径
			$user_list=$user->field('id,name,grade_num,face_path')
							->where($where)
							->limit($page->limit)
							->order('id asc')
							->select();
			//附加用户等级
			foreach($user_list as &$ul){
				$ul['level']=$user->get_level($ul['id']);
			}
			$this->assign('fpage',$page->fpage(0,4,5,6));//分配分页条
			$this->assign('title','用户列表'.'-'.TITLE);//分配标题
			$this->assign('user_list',$user_list);//分配用户列表
			$this->assign('nav_chain',D('pub')->user_nav());//分配导航链
			$this->display();
		}
		/*
			打招呼
		*/
		public function hello(){
			//打招呼动作
			$content_array= array(1=>"微笑",2=>"踩一下",3=>"握个手",4=>"加油",5=>"抛媚眼",6=>"拥抱",
							      7=>"飞吻",8=>"挠痒痒",9=>"给一拳",10=>"电一下",11=>"依偎",
							      12=>"拍拍肩膀",13=>"咬一口"
							);			
			$_POST['ip']=sprintf('%u',ip2long($_SERVER['REMOTE_ADDR']));//客户端ip地址
			$_POST['sms_sort']='3';//信息类型是打招呼(详情请参考数据字典)
			$_POST['src_id']=$_SESSION['user_info']['id'];//打招呼的用户id
			$_POST['src_ope']='del';//打招呼的用户的动作是删除
			$_POST['content']='<font color="green">'.$_SESSION['user_info']['name'].'</font>'.' 对您 '.'<font color="green">'.$content_array[$_POST['content']].'</font>';
			$_POST['ptime']=time();//打招呼时间
			//如果插入数据成功,那么就输出1,否则输出0
			if(D('sms')->insert($_POST)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
?>