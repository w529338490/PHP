<?php
/*
@作者：闫海静
@功能描述：管理评论
@时间：20111204
*/
class ReviewManage{
	//显示所有文章的所有评论
	function viewReview(){
		//查询所有文章
		$article=D('article');
		//分页类
		$page=new Page($article->total(array('article_review'=>'1')),5);
		//查询出所有可以评论的文章列表
		$result=$article->field('aid,article_title,article_time')->limit($page->limit)->where(array('article_review'=>'1'))->select();
		//查询出所有评论该文章最后的标题，时间，评论邮箱，所有评论数
		$review=D('review');
		$i=0;
		foreach($result as $values){
			$reviewData[$i]['aid']=$values['aid'];
			$reviewData[$i]['article_title']=$values['article_title'];
			$reviewData[$i]['article_time']=$values['article_time'];
			//查询对应文章下的评论内容
			$reviewResult=$review->where(array('aid'=>$values['aid']))->order('rid desc')->field('review_name,review_email,review_time')->find();
			//文章下的评论总数
			$review_count=$review->where(array('aid'=>$values['aid']))->field('count(rid)')->find();
			$reviewData[$i]['review_name']=$reviewResult['review_name'];
			$reviewData[$i]['review_email']=$reviewResult['review_email'];
			$reviewData[$i]['review_time']=$reviewResult['review_time'];
			$reviewData[$i]['review_count']=$review_count['count(rid)'];
			//判断该文章是否有评论
 			if(empty($reviewData[$i]['review_name'])){
				$reviewData[$i]['flag']=false;
			}else{
				$reviewData[$i]['flag']=true;
			}
			$i++;
		}
		if(!empty($_GET['page'])){
			$this->assign('page',"/page/".$_GET['page']);
		}
		$this->assign('page',$_GET['page']);
		$this->assign('fpage',$page->fpage(4,5,6,0,3));
		$this->assign('reviewData',$reviewData);
		$this->display();
		//P($reviewData);
	}
	//查看文章显示其回复
	function viewArticle(){
		//要查看的文章ID
		$arcicleId=$_GET['aid'];
		$article=D('article');
		$review=D('review');
		$rereview=D('rereview');
		$page=new Page($review->total(array('aid'=>$arcicleId)),5,"aid/{$arcicleId}");
		//查找相对应的文章
		$articleData=$article->field('aid,article_title,article_content,article_author,article_time')
			  ->where(array('aid'=>$arcicleId))
			  ->find();
		$articleData['article_content']=str_replace(array('\\'),array("'"),$articleData['article_content']);
		//查找相对应文章的评论
		$articleReview=$review->field()
					  ->limit($page->limit)
					  ->where(array('aid'=>$arcicleId))
					  ->order('review_time desc')
					  ->select();
					  
		//查找相对应文章的回复评论
		$articlereReview=$rereview->where(array('aid'=>$arcicleId))->select();

		foreach($articlereReview as $values){
			//回复的用户名
			$articlereReviews[$values['rid']][$values['rrid']]['name']=$values['rrname'];
			//回复的时间
			$articlereReviews[$values['rid']][$values['rrid']]['time']=$values['rtime'];
			//回复的内容
			$articlereReviews[$values['rid']][$values['rrid']]['content']=$values['rr_content'];
		}
		/*******************************************************************/
		//找到一篇评论的回复数如果没有返回false
		foreach($articlereReview as $key=>$value){
			$countReview[]=$value['rid'];
		}
		$countReviews=array_count_values($countReview);
		//P($countReviews);
		/********************************************************************/
		//将数据分配给模板
		if(!empty($_GET['page'])){
			$this->assign('page',"/page/".$_GET['page']);
		}
		$this->assign('counts',$countReviews);
		$this->assign('articlereReviews',$articlereReviews);
		$this->assign('fpage',$page->fpage());
		$this->assign('articleData',$articleData);
		$this->assign('articleReview',$articleReview);
		//给模板分配UBB编辑器，调用form.class.php中的静态方法
		//$this->assign('ckeditor',Form::editor('article_content','','350','white',false));
		$this->display();
	}
	
	//删除文章评论
	function delReview(){
		$rView=D('review');
		$rrView=D('rereview');
		$article=D('article');
		//$articleTit=$article->where(array('aid'=>$_GET['aid'])->field('article_title')->find();
		$articleTit=$article->where(array('aid'=>$_GET['aid']))->field('article_title')->find();
		$reviewTit=$rView->where(array('aid'=>$_GET['aid'],'rid'=>$_GET['rid']))->field('review_email')->find();
		$delResult=$rView->where(array('aid'=>$_GET['aid'],'rid'=>$_GET['rid']))->delete();
		if($delResult){
			//添加操作评论记录
			$Oper=new OperDate('delete',$_SESSION['user_username'],"删除了文章{$articleTit['article_title']}下{$reviewTit['review_email']}发表的评论");
			$Oper->isOper();
			$delrResult=$rrView->where(array('aid'=>$_GET['aid'],'rid'=>$_GET['rid']))->delete();
			$this->redirect("{$_GLOBALS["app"]}/reviewmanage/viewarticle/aid/{$_GET['aid']}/page/{$_GET['page']}");
		}else{
			$this->error('删除评论失败',3,"{$_GLOBALS["app"]}/reviewmanage/viewarticle/aid/{$_GET['aid']}/page/{$_GET['page']}");
		}
	}
	//删除文章评论所有回复
	function delrReview(){
		$rrView=D('rereview');
		$delrResult=$rrView->where(array('aid'=>$_GET['aid']))->delete();
		if($delrResult){
			//echo $_GET['aid'];
			$D=D('article');
			$resultA=$D->where(array('aid'=>$_GET['aid']))->field('article_title')->find();
			//添加操作评论记录
			$Oper=new OperDate('delete',$_SESSION['user_username'],"删除了文章{$resultA['article_title']}下的所有回复");
			$Oper->isOper();
			$this->redirect("{$_GLOBALS["url"]}/reviewmanage/viewarticle/aid/{$_GET['aid']}/page/{$_GET['page']}");
		}else{
			$this->error('删除回复失败',3,"{$_GLOBALS["app"]}/reviewmanage/viewarticle/aid/{$_GET['aid']}/page/{$_GET['page']}");
		}
	}
	
	//查看文章的评论是否有回复
	
	//回复文章评论
	function reReviews(){
		$reReview=D('rereview');
		//回复时间
		
		$_POST['rtime']=time();
		$_POST['rrname']=$_SEESION['user_username'];
		$inResult=$reReview->insert($_POST);
		if($inResult){
			//P($_POST);
			$article=D('article');
			$review=D('review');
			$articleTit=$article->where(array('aid'=>$_POST['aid']))->field('article_title')->find();
			$reviewTit=$review->where(array('rid'=>$_POST['rid']))->field('review_email')->find();
			$Oper=new OperDate('add',$_SESSION['user_username'],"回复了{$articleTit['article_title']}下{$reviewTit['review_email']}的文章评论");
			$Oper->isOper();
			$this->redirect("{$_GLOBALS["app"]}/reviewmanage/viewarticle/aid/{$_POST['aid']}/page/{$_GET['page']}");
		}else{
			$this->error('回复评论失败',3,"{$_GLOBALS["app"]}/reviewmanage/viewarticle/aid/{$_POST['aid']}/page/{$_GET['page']}");
		}
	}
	  
  	//更改评论状态
	function appReview(){
		$review=D('review');
		$resultApp=$review->where(array('aid'=>$_GET['aid'],'rid'=>$_GET['rid']))->update("review_action=0");
		//P($resultApp);
		if($resultApp){
			$this->redirect("{$_GLOBALS["app"]}/reviewmanage/viewReview");
		}else{
			$this->error('批准失败',3,"{$_GLOBALS["app"]}/reviewmanage/viewReview");
		}
	}


}