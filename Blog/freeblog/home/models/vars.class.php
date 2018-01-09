 <?php
/**
	首页变量分配
	作者：卫聪
*/
	class vars{
		function menu(){//首页菜单（按文章类别）
			$menu=D('category')->field('cid,category_name')->where(array('subAction'=>'N'))->select();
			for($i=0;$i<count($menu);$i++){
				$str.='<li><a href="'.$GLOBALS['url'].'lists/cname/'.$menu[$i]['category_name'].'">'.$menu[$i]['category_name'].'</a></li>';
			}
			return $str;
		}
		/*****block*******/
		function u_populer_list(){//活跃用户
			$user=D('user')->field('uid,user_username')->where('user_onlinestatus >10')->order('user_onlinestatus desc')->select();
			$str.='<ul><h1>活跃用户</h1>';
			for($i=0;$i<count($user);$i++){
				$str.='<li><a href="#">'.$user[$i]['user_username'].'</a></li>';
			}
			$str.='</ul>';
			return $str;
		}
		function a_time_list(){//文章按月份归档列表
			$time=D('article')->query('select article_time from free_article','select');
			for($i=0;$i<count($time);$i++){
				$ti[$time[$i]['article_time']]=date('y年m月',$time[$i]['article_time']);
			}
			$num=array_count_values($ti);
			$ti=array_unique($ti);
			$str.='<ul>';
			$str.='<h1>文章归档</h1>';
			foreach($ti as $key=>$value){
				$key=substr($key,0,4);				
				foreach($num as $key2=>$value2){
					if($key2==$value){
				$str.='<li><a href="'.$GLOBALS['url'].'lists/time/'.$key.'">'.$value.'</a>&nbsp;该月共<font color="#f5cf12">'.$value2.'</font>篇文章</li>';
					}else{
						continue;
					}
				}
			}
			$str.='</ul>';
			return $str;
		}
		function a_search_list(){//文章搜索 //友情链接
			$str='<ul>';
			$str.='<h1>友情链接</h1>';
			$link=D('flink')->order('oder asc')->select();
			for($i=0;$i<count($link);$i++){
				$str.='<li><a href="'.$link[$i]['link_url'].'" target="'.$link[$i]['link_target'].'" title="'.$link[$i]['link_description'].'">'.$link[$i]['link_name'].'</a></li>';
			}
			$str.='</ul>';
			return $str;
		}
		function a_newarticle_list(){//最新文章
			$article=D('article')->field('aid,article_title')->limit('0,5')->order('article_time desc')->select();
			$str='<ul>';
			$str.='<h1>最新文章</h1>';
			for($i=0;$i<count($article);$i++){
				$str.='<li><a href="'.$GLOBALS['url'].'content/aid/'.$article[$i]['aid'].'">'.$article[$i]['article_title'].'</a></li>';
			}
			$str.='</ul>';
			return $str;
		}
		function a_comment_list(){//近期评论
			$view=D('review')->order('review_time desc')->limit('0,5')->select();
			//p($view);
			$str='<ul ><h1>近期评论</h1>';
			for($i=0;$i<count($view);$i++){
				$str.='<li ><a href="'.$GLOBALS['url'].'content/aid/'.$view[$i]['aid'].'">'.$view[$i]['review_content'].'</a></li>';
			}
			$str.='</ul>';
			return $str;
		}
		function a_category_list(){//分类列表
			$menu=D('category')->field('cid,category_name')->where(array('subAction'=>'N'))->select();
			$str='<ul>';
			$str.='<h1>分类列表</h1>';
			for($i=0;$i<count($menu);$i++){
				$str.='<li><a href="'.$GLOBALS['url'].'lists/cname/'.$menu[$i]['category_name'].'">'.$menu[$i]['category_name'].'</a></li>';
			}
			$str.='</ul>';
			return $str;
		}
		/*****block****end***/
		function a_last_list($cname){//列表页文章列表
				$article=D('article')->field('aid,article_title,article_content,article_author,article_category')->where('article_category="'.$cname.'"')->order('article_time desc')->select();
				return $article;
		}
		function article_content($aid){//内容页文章内容
				$article=D('article')->field('aid,article_title,article_content,article_time,article_author,article_category')->where('aid="'.$aid.'"')->select();
				for($i=0;$i<count($article);$i++){
				$review_num[$i]=D('article')->query('select count(free_review.rid) as num from free_review where free_review.aid='.$article[$i]['aid'].'','select');
				}
				for($i=0;$i<count($article);$i++){
				$article[$i]['review_num']=$review_num[$i][0]['num'];
				$article[$i]['article_time']=date('Y-m-d H:i:s',$article[$i]['article_time']);
				}
				return $article;
		}
		
	}