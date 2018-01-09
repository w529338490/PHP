<?php
/**
	图片管理模块
	作者：卫聪
	图片的：增删改查
*/
	class ImageAction extends Common {
		function add(){//添加页面
			$this->assign('select',D('album_form')->table_select());
			$this->display();
		}
		function edit(){//编辑页面
			$img=D('image');
			$album_total=D('album')->total();
			$num=5;
			$selected=$_POST['id']?$_POST['id']:$_GET['pid'];
			$name=$_POST['search_username']?$_POST['search_username']:$_GET['name'];
			if($selected){//如果用户有选择俺分类查看
				if(!empty($name)){//如果用户在选择分类查看的同时并没有输入搜索名字
					$where='free_image.title like "%'.$name.'%" and free_image.pid=free_album.id and free_album.id='.$selected.'';
					$to='free_image.title like "%'.$name.'%" and free_image.pid='.$selected.'';
					$pid='pid/'.$selected.'/name/'.$name.'';
				}else{//如果用户在选择分类查看后又在该分类下输入了搜索条件
					$where='free_album.id='.$selected.' and free_image.pid=free_album.id';
					$to='free_image.pid='.$selected;
					$pid='pid/'.$selected.'';	
				}
			}else{//如果用户没有选择分类条件查看
				if(!empty($name)){
				$where='free_image.title like "%'.$name.'%" and free_image.pid=free_album.id';
				$to='free_image.title like "%'.$name.'%" ';
				$pid='name/'.$name.'';		
				}else{
				$where='free_image.pid=free_album.id';	
				}
			}
			$page=new Page($img->total($to),$num,$pid);
			$date=$img->query('select free_image.pid,free_image.up_author,free_image.postid,free_image.id,free_image.name,free_image.title,free_album.id as aid,free_album.album_title from free_image,free_album where '.$where.' order by free_image.id desc limit '.$page->limit.'','select');
			$total=$img->total();
			for($i=0;$i<count($date);$i++){
				$size[]=getimagesize('http://localhost'.$GLOBALS['public'].'uploads/'.$date[$i]['name']);
				$date2[]=array_merge($date[$i],$size[$i]);
				$date2[$i]['mime']=substr($date2[$i]['mime'],6);
			}
			$this->assign('select2',D('album_form')->table_select2($selected));
			$this->assign('fpage',$page->fpage(4,5,6,0,3));
			$this->assign('album_total',$album_total);
			$this->assign('total',$total);
			$this->assign('image',$date2);
			$this->assign('select',D('album_form')->table_select());	
			$img=D('image')->query('select free_image.postid,free_image.id,free_article.aid,free_article.article_title from free_image,free_article where free_image.postid=free_article.aid ','select');
			$this->assign('fadd',$img);
			$this->display();
		}
		function insert(){//添加方法
			$img=D('image');
			$up=D('img_upload')->up('pic');
			//添加删除操作
			$Oper=new OperDate();
			////////////////////////////////////////////////////////////////////////////////////////////
			if($_POST['id']==0){
				$this->error('请选择相册',2,'add');
			}
			for($j=0;$j<count($_POST['title']);$j++){
				if(empty($_POST['title'][$j]) || $_POST['title'][$j]=='标题....'){
					$this->error('请输入第&nbsp;<font color="red">'.($j+1).'</font>&nbsp;幅图片的标题',2,'add');
				}
			}
				if(!$up['status']){
					for($i=0;$i<count($up['info']);$i++){
						$str.=$i.':'.$up['info'][$i].'<br>';
					}
					$this->error($str,2,'add');
				}else{
					for($i=0;$i<count($up['info']);$i++){
						$str.=$up['info'][$i].'上传成功<br>';
						$name.=$up['info'][$i];
						$title.=$_POST['title'][$i];
						$rows=$img->query('insert into free_image(pid,title,mktime,name,up_author) values('.$_POST['id'].',"'.$title.'","'.time().'","'.$name.'","'.$_SESSION['user_username'].'")');
						//添加上传图片记录
						$Oper->isOpers("add_image","上传了图片：{$name}");
						//////////////////////////////////////////////////
						if(!empty($name)){
							$name=null;
							$title=null;
						}
					}
					if($rows){
						$this->success($str,1,'edit');
					}else{
						$this->error('数据写入错误',2,'add');
					}
				}
			}
		function del(){
			$image=D('image');
			//添加删除操作，批量还原
			$Oper=new OperDate();
			////////////////////////////////////////////////////////////////////////////////////////////
			if($_GET['id']){//如果是单条数据删除
				$name=$image->field('name')->find($_GET['id']);
				$name=$name['name'];
				//添加单独删除图片操作
				$Oper->isOper("single_del_image",'image',$_GET['id'],'title','id','删除了图片：');
				//////////////////////////////////////////////////////////////////////////////////
				$row=$image->where($_GET['id'])->delete();
			}else{//如果是多条数据删除
				//添加单独删除图片操作
				$Oper->isOper("single_del_image",'image',$_POST['num'],'title','id','批量删除了图片：');
				$name=$image->field('name')->select($_POST['num']);
				$row=$image->where($_POST['num'])->delete();
			}
			if($row){//如果有影响行数
				if(is_array($name)){//如果是多条数据删除那么$name就是一个数组
					for($i=0;$i<count($name);$i++){
						unlink('public/uploads/'.$name[$i]['name']);//循环删除原图
						unlink('public/uploads/th_'.$name[$i]['name']);//循环删除缩略原图
						unlink('public/uploads/ath_'.$name[$i]['name']);//循环删除附加文章上的缩略原图
						if(file_exists('public/uploads/th2_'.$name[$i]['name'])){//如果预览图片存在就删除
							unlink('public/uploads/th2_'.$name[$i]['name']);			
						}
					}
				}else{//如果不是数组
						unlink('public/uploads/'.$name);
						unlink('public/uploads/th_'.$name);
						if(file_exists('public/uploads/th2_'.$name)){
							unlink('public/uploads/th2_'.$name);
						}
				}
				$this->success('删除成功',2,'edit');
			}else{
				$this->error('删除失败',1,'edit');
			}
		}
		function mod(){//修改页面
			$image=D('image')->field('pid,title,name,mktime')->find($_GET['id']);
			$image['mktime']=date('Y年-m月-d日',$image['mktime']);
			$th2image=new Image();
			$newimage=$th2image->thumb($image['name'],300,169,'th2_');//用户点击修改页面的时候才会生成预览缩略图
			$size=getimagesize('http://localhost'.$GLOBALS['public'].'uploads/'.$image['name']);
			$image=array_merge($image,$size);
			$this->assign('select',D('album_form')->table_select($image['pid']));
			$this->assign('pid',$_GET['id']);
			$this->assign('info',$image);
			$this->display();
		}
		function update(){//更新方法
		$row=D('image')->where(array('id'=>$_GET['pid']))->update(array('pid'=>$_POST['id'],'title'=>$_POST['title'],'description'=>$_POST['description']));
			if($row){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOper("edit_image",'image',$_POST['id'],'title','pid','图片信息被修改：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('修改成功',1,'edit');
			}else{
				$this->error('修改失败',1,'mod');
			}
		}
		function fadd(){//附加方法
			$article=D('img_to_article')->show();//附加图片时弹出小窗口的分类下拉菜单
			$this->assign('cname',$article);//附加图片时弹出小窗口的分类下拉菜单
			$date=D('img_to_article')->date_show();//同上--日期
			$this->assign('time',$date);//同上--日期
			$this->assign('id',$_GET['id']);
			$this->display();
		}
		function exe_fadd(){//执行附加
			if(empty($_POST['cname'])){//如果用户没有选择文章则返回
				$this->error('请选需要附加的文章',2,'edit');
			}
			if(empty($_POST['pos'])){//如果用户没有选择图片摆放位置则返回
				$this->error('请选择附加图片摆放的位置',2,'edit');
			}
			$img=D('image')->field('name')->where(array('id'=>$_POST['id']))->find();
			if($img){
				$exe_img=new Image();
				if(empty($_POST['width']) || empty($_POST['height'])){//如果用户并没有指定图片的缩略宽高
					$size=getimagesize('http://localhost'.$GLOBALS['public'].'uploads/'.$img['name']);//取出图片的宽高
					$arr=explode(' ',$size[3]);
					$width=trim(stristr($arr[0],'"'),'"');
					$height=trim(stristr($arr[1],'"'),'"');	
					$new_imagename=$exe_img->thumb($img['name'],$width,$height,"ath_");
				}else{//如果用户自定义了图片的宽高
					$new_imagename=$exe_img->thumb($img['name'],$_POST['width'],$_POST['height'],"ath_");
				}	
				$Oper=new OperDate();				
				if($new_imagename){
					$path=''.$GLOBALS['public'].'uploads/'.$new_imagename;//生成缩略图的路径
					$article=D('article')->field('article_content,article_title')->where(array('aid'=>$_POST['aid']))->select();//从数据库中找出需要附加的文章
					if($_POST['pos']=='left_up'){//如果用户选择的是上边
					$new_content='<img src='.$path.'>'.$article[0]['article_content'].'';
					$row=D('article')->update(array('aid'=>$_POST['aid'],'article_content'=>$new_content),array("article_content"));
					//添加删除操作，批量还原
					$Oper->isOper("attachment_image",'article',$_POST['aid'],'article_title','aid','将图片附加在文章：');
					///////////////////////////////////////////////////////////////////////////////////////////////////////
					}
					if($_POST['pos']=='right_down'){//如果用户选择的是下面
					$new_content=$article[0]['article_content'].'<img src='.$path.' >';
					$row=D('article')->update(array('aid'=>$_POST['aid'],'article_content'=>$new_content),array("article_content"));
					//添加删除操作，批量还原
					$Oper->isOper("attachment_image",'article',$_POST['aid'],'article_title','aid','将图片附加在文章：');
					///////////////////////////////////////////////////////////////////////////////////////////////////////
					}				
					if($row){
						$img_row=D('image')->update(array('id'=>$_POST['id'],'postid'=>$_POST['aid']));
						if($img_row){
							//$this->success('附加成功',2,'edit');
						}
					}
				}
			}
		}
		function del_fadd(){//移除附加
			$image=D('image')->field('name,postid')->where(array('id'=>$_GET['id']))->select();
			$content=D('article')->field('article_content')->where(array('aid'=>$image[0]['postid']))->select();
			$imagename='ath_'.$image[0]['name'];
			$path='public/uploads/'.$imagename;
			$content=$content[0]['article_content'];//从数据库中取出文章的内容
			//<img src="/freeblog/public/uploads/ath_20111205191431_939.jpg" /></
			$newcontent=preg_replace('/(.)+(img)+(.)(src)+(=)?(.)+/',null,$content);//然后用正则匹配<img>标签
			if(unlink($path)){//如果删除附加图片成功
					$img_row=D('image')->update(array('id'=>$_GET['id'],'postid'=>0));
				if($img_row){
		$row=D('article')->update(array('aid'=>$image[0]['postid'],'article_content'=>$newcontent),array("article_content"));
					if($row){
						$this->success('移除成功',2,'');		
					}
				}
			}
		}
		function ajax(){
			$GLOBALS['debug']=0;
			$name=$_GET['cname']?$_GET['cname']:null;
			$time=$_GET['time']?$_GET['time']:null;
			if(empty($name)){//如果用户没有选择文章名字
				if($time){//如果用户选择的是时间
					if($time=='none2'){//如果选择时间为查看全部
						$where='';
					}else{
						if($time!='none2'){//如果不是查看全部就根据用户选择的时间查找数据
								$where=array('article_time'=>"%".$time."%");
						}else{
							if($name!='none2'){//如果用户在选择了时间后又再次选择了文章的分类
								$where=array('article_category'=>''.$name.'','article_time'=>"%".$time."%");
							}else{
								$where=array('article_time'=>"%".$time."%");
							}
						}
					}
				}else{
					$where='';
				}
			}else{//如果用户选择的是时间
				if($name=='none' || $time=='none2'){//如果文章分类和时间其中有一个为查看全部的时候
					if($name=='none' && $time!='none2'){	//如果文章分类为查看全部的时候
						$where=array('article_time'=>"%".$time."%");
					}else{
						$where='';
					}
					if($name!='none' && $time=='none2'){ //如果时间为查看全部的时候
						$where=array('article_category'=>''.$name.'');
					}
				}else{//如果文章分类和时间同时都被选择的时候
					if($time){
						$where=array('article_category'=>''.$name.'','article_time'=>"%".$time."%");
					}else{
						$where=array('article_category'=>''.$name.'');
					}
				}
			}
			$article=D('article')->field('aid,article_title')->where($where)->limit($page->limit)->order('article_time desc')->select();//根据上面的where条件查找数据库内容
			for($i=0;$i<count($article);$i++){
				$str.='<span style="float:left;margin-left:10px;"><input type="radio" name="aid" value="'.$article[$i]['aid'].'">&nbsp;&nbsp'.$article[$i]['article_title'].'</span><br/><br/>';	
			}
			echo $str;//并返回
		}
		
	}