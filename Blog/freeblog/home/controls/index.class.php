<?php
/**
	前台变量
	作者：卫聪
*/
	class Index {

		function index(){
			$GLOBALS['debug']=0;
			$webSiteAction=D('foreground');
			$resultAction=$webSiteAction->where(array('fid'=>'1'))->field('webState')->find();
			//P($resultAction);
			if(!$resultAction['webState']){
				echo "<div align='center'><img src='{$GLOBALS['public']}/images/web_down.jpg' alt='网站关闭'/></div>";
				return false;
			}
			$tool=D('tool')->select();
			$rightnum=array();
			$leftnum=array();
			for($i=0;$i<D('tool')->total();$i++){
				if(!empty($tool[$i]['left_bar'])){//左边自动D
					$str=$tool[$i]['left_bar'];	
					$leftnum[$i]=D('vars')->$str();
				}
				if(!empty($tool[$i]['right_bar'])){//右边自动D
					$str2=$tool[$i]['right_bar'];	
					$rightnum[$i]=D('vars')->$str2();
				}
			}	
			for($r=0;$r<count($rightnum);$r++){//右边自动分配
				$this->assign('right_'.$r.'',$rightnum[$r]);
			}
			for($j=0;$j<count($leftnum);$j++){//左边自动分配
				$this->assign('left_'.$j.'',$leftnum[$j]);
			}
			$article_page=D('article');
			$num=5;//首页文章显示数量
			$page=new Page($article_page->total(),$num);
			$article=D('article')->field('aid,article_title,article_author,article_time,article_content')->limit($page->limit)->where(array('article_authority'=>'3'))->order('article_time desc')->select();
			for($i=0;$i<count($article);$i++){
			$review_num[$i]=D('article')->query('select count(free_review.rid) as num from free_review where free_review.aid='.$article[$i]['aid'].'','select');
			}
			for($i=0;$i<count($article);$i++){
			$article[$i]['review_num']=$review_num[$i][0]['num'];
			$article[$i]['article_time']=date('Y-m-d H:i:s',$article[$i]['article_time']);
			}
			//p($article);
			$this->assign('fpage',$page->fpage(2,4,5,6,0,3));
			$this->assign('article',$article);//文章
			$this->assign('menu',$menu=D('vars')->menu());//菜单
			$this->assign('title',$title=$title=D('foreground')->find());//前台网站标题
			$this->display();
			
		}
		function lists(){
			$GLOBALS['debug']=0;
			$tool=D('tool')->select();
			$rightnum=array();
			$leftnum=array();
			for($i=0;$i<D('tool')->total();$i++){
				if(!empty($tool[$i]['left_bar'])){//左边自动D
					$str=$tool[$i]['left_bar'];	
					$leftnum[$i]=D('vars')->$str();
				}
				if(!empty($tool[$i]['right_bar'])){//右边自动D
					$str2=$tool[$i]['right_bar'];	
					$rightnum[$i]=D('vars')->$str2();
				}
			}	
			
			for($r=0;$r<count($rightnum);$r++){//右边自动分配
				$this->assign('right_'.$r.'',$rightnum[$r]);
			}
			for($j=0;$j<count($leftnum);$j++){//左边自动分配
				$this->assign('left_'.$j.'',$leftnum[$j]);
			}
			
			if(!empty($_GET['cname'])){
				$where=array('article_category'=>$_GET['cname'],'article_authority'=>'3');
			}
			if(!empty($_GET['time'])){
				$where=array('article_time'=>"%".$_GET['time']."%",'article_authority'=>'3');
			}
		
			$article=D('article')->field('aid,article_author,article_category,article_title')->where($where)->select();
			for($i=0;$i<count($article);$i++){
			$review_num[$i]=D('review')->query('select count(free_review.rid) as num from free_review where free_review.aid='.$article[$i]['aid'].'','select');
			//$review_num[$i]=D('review')->where(array('aid'=>$article[$i]['aid'],'review_action'=>'1'))->field('count(free_review.rid)')->select();
			}
			for($i=0;$i<count($article);$i++){
			$article[$i]['review_num']=$review_num[$i][0]['num'];
			}
			$this->assign('alist',$article);
			$this->assign('menu',$menu=D('vars')->menu());//菜单
			$this->assign('title',$title=$title=D('foreground')->find());//前台网站标题
			$this->display();
		}
		function content(){
			$GLOBALS['debug']=0;
			$tool=D('tool')->select();
			$rightnum=array();
			$leftnum=array();
			for($i=0;$i<D('tool')->total();$i++){
				if(!empty($tool[$i]['left_bar'])){//左边自动D
					$str=$tool[$i]['left_bar'];	
					$leftnum[$i]=D('vars')->$str();
				}
				if(!empty($tool[$i]['right_bar'])){//右边自动D
					$str2=$tool[$i]['right_bar'];	
					$rightnum[$i]=D('vars')->$str2();
				}
			}	
			for($r=0;$r<count($rightnum);$r++){//右边自动分配
				$this->assign('right_'.$r.'',$rightnum[$r]);
			}
			for($j=0;$j<count($leftnum);$j++){//左边自动分配
				$this->assign('left_'.$j.'',$leftnum[$j]);
			}
			$this->assign('menu',$menu=D('vars')->menu());//菜单
			$aid=$_GET['aid'];
			$article_list=D('vars')->article_content($aid);
			$this->assign('aid',$aid);
			//查询出评论数
			$review_num=D('review')->where(array('aid'=>$article_list[0]['aid'],'review_action'=>'1'))->field('count(free_review.rid)')->find();
			//查询出已经通过的评论详细情
			$reviewAll=D('review')->where(array('aid'=>$article_list[0]['aid']))->select();
			$bianli=D('view')->bianli($reviewAll);//自定义MODEL php-->bianli
			//P($bianli);
			//P($reviewAll);
			//将回复及详情分配给模板
			$this->assign('reviewAll',$bianli);
			$article_list[0]['review_num']=$review_num['count(free_review.rid)'];
			$article_list[0]['article_content']=str_replace(array("\\"),array(""),$article_list[0]['article_content']);
			$this->assign('alist',$article_list);
			$this->assign('title',$title=$title=D('foreground')->find());//前台网站标题
			$this->display();
		}
		
		//添加数据到数据库
		function sendData(){
			$GLOBALS['debug']=0;
 			$output=D('view')->output($_GET);//自定义MODEL	js-->output
			echo $output;
		}
	}