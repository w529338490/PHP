<?php
/****************************************************************
作者：闫海静													*
功能：关于发表文章、修改文章的操作								*
日期：2011/12/27												*
*****************************************************************/
class ArticleOther{
	//写文章界面
	function createArticle(){
		//查询出文章的分类
		$category=D('category');
		//找出类别下没有子类的类来发文章
		$allCategory=$category->field('cid,category_name')->where(array('subAction'=>'N'))->select();
		//P($allCategory);
		$this->assign('allCategory',$allCategory);
		//给模板分配UBB编辑器，调用form.class.php中的静态方法
		$this->assign('ckeditor',Form::editor('article_content','basic','350','white',false));
		$this->assign('articleData',$this->pageTitle());
		//调用文章界面模板
		$this->display();
		}
		//发表文章
		function addArticle(){
		//将文章插入到数据库中
		$article=D('article');
		//发帖时间
		$_POST['article_time']=time();
		//计算发帖的年月用于查询
		$_POST['article_month']=date('Y年m月',time());
		//文章发布人/ID
		$_POST['uid']=$_SESSION['uid'];
		$_POST['article_author']=$_SESSION['user_username'];
		//P($_POST);
		$addResult=$article->insert($_POST,array("article_content"));
		 if($addResult){
			//如果插入文章成功就连接文章类别库更新其数据
			$category=D('category');
			//更改该类别下的数量+1
			$updateCat=$category->where(array('category_name'=>$_POST['article_category']))->update("category_total=category_total+1");
			//添加删除操作
			$Oper=new OperDate();
			$Oper->isOpers("issue_article","发表了文章{$_POST['article_title']}，将其分组到：{$_POST['article_category']}");
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$this->success('恭喜您发表成功,页面将跳转到文章列表',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
		}else{
			$this->error('呜呜呜,发表文章失败了。重新来过吧！',3,"{$_GLOBALS["app"]}/articleManage/createArticle");
		}
	}
	//查询出有效果文章数，文章总数，无效文章数
	function pageTitle(){
		$article=D('article');
		$vaildTotal=$article->field('count(aid)')->where(array('article_action'=>'1'))->select();
		$invaildTotal=$article->field('count(aid)')->where(array('article_action'=>'0'))->select();
		//返回数据
		$articleData['vaildTotal']=$vaildTotal[0]['count(aid)'];
		$articleData['invaildTotal']=$invaildTotal[0]['count(aid)'];
		$articleData['allTotal']=$invaildTotal[0]['count(aid)']+$vaildTotal[0]['count(aid)'];
		return $articleData;
	}
	//查询数据库中所有分类
	function searchCategory(){
		//查询所有分类
		$category=D('category');
		$allCategory=$category->field('cid,category_name')->where(array('subAction'=>'N'))->select();
		return $allCategory;
	}
	//修改文章视图
	function viewArticle(){
		$article=D('article');
		$viewResult=$article->where(array('aid'=>$_GET['aid']))->find();
		//P($viewResult);
		$viewResult['article_content']=str_replace(array("\\"),array(""),$viewResult['article_content']);
	//	$article_list[0]['article_content']=str_replace(array("\\"),array(""),$article_list[0]['article_content']);
		//分配UBB
		$this->assign('ckeditor',Form::editor('article_content','basic','350','white',false));
		//分配数据
		$this->assign('viewResult',$viewResult);
		//分配所有文章分类
		$this->assign('allCategory',$this->searchCategory());
		$this->display();
	}
	//修改文章
	function updateArticle(){
		$article=D('article');
		//添加删除操作
		$Oper=new OperDate();
		$Oper->isOper("article_edit",'article',$_POST['aid'],'article_title','aid','修改了文章：');
		////////////////////////////////////////////////////////////////////////////////////////////
		$updateArticle=$article->where(array('aid'=>$_POST['aid']))->update($_POST,array("article_content"));
		if($updateArticle){
			$this->success('恭喜您发表成功,页面将跳转到文章列表',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
		}else{
			$this->error('呜呜呜,发表文章失败了。重新来过吧！',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
		}
	}
}