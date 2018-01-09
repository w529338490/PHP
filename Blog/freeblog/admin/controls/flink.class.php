<?php
/**
	友情连接
	作者：卫聪
*/
	class flink{
		function index(){//首页显示
			$this->display();
		}
		function edit(){//编辑页面
			$num=5;//分页的limit
			$pg=D('flink');
			$page=new Page($pg->total(),$num);//分页
			$link=D('flink')->field('id,link_name,oder,link_description,link_url,link_body,link_body_email,disable')->limit($page->limit)->select();
			for($i=0;$i<count($link);$i++){	
				$dis_num+=count($link[$i]['disable']);
			}
			$this->assign('dis_num',$dis_num);//显示状态
			$this->assign('link_num',count($link));//全部链接的数量
			$this->assign('link',$link);
			$this->assign('fpage',$page->fpage(4,5,6,0,3));//分页显示
			$this->display();
		}
		function add(){//添加页面
			$this->display();
		}
		function insert(){//插入数据库
			if(!empty($_POST['link_image'])){
			if($_POST['pic_change']){//如果用户选择了自定义缩略图片
				$down=D('downpic')->down($_POST['link_image'],time(),$_POST['pic_change'],$_POST[width],$_POST['height']);//自定义model返回新的图片名字
			}else{//如果用户选择了原图
				$down=D('downpic')->down($_POST['link_image'],time());//自定义model返回新的图片名字
			}
			$_POST['link_image']=$down;
			$_POST['link_time']=time();
			$flink=D('flink')->insert();
				if($flink){
					$oder=D('flink');
					$num=$oder->total();
					$row=$oder->where(array('id'=>$flink))->update(array('oder'=>$num));//每次添加一条
					if($row){
					$this->success('添加成功',2,'edit');
					}else{
					$this->error('添加失败',2,'add');
					}
				}else{
					$this->error('添加失败',2,'add');
				}
			}
		}
		function del(){//删除方法
			if($_POST['num']){//批量数据删除
				$flink=D('flink')->delete($_POST['num']);
				if($flink){
					$this->success('删除成功',2,'edit');
				}else{
					$this->error('删除失败',2,'edit');
				}
			}
			if($_GET['id']){//单条删除
				$flink=D('flink')->where(array('id'=>$_GET['id']))->delete();
				if($flink){
					$this->success('删除成功',2,'edit');
				}else{
					$this->error('删除失败',2,'edit');
				}
			}
		}
		function update(){//更改页面
			$link=D('flink')->field('id,link_name,link_image,link_description,link_url,link_target,link_body,link_body_email,disable')->where(array('id'=>$_GET['id']))->order('id desc')->select();//根据$_get传参得到原数据的信息
			$this->assign('id',$_GET['id']);
			$this->assign('link',$link);
			$this->display();
		}
		function exe_update(){//执行更新方法
			if(!empty($_POST['width'])){//如果用户没有选择自定义尺寸
				$link=D('flink')->field('link_image')->where(array('id'=>$_POST['id']))->find();
				$img=new Image();
				$th=$img->thumb('logo/'.$link['link_image'],$_POST['width'],$_POST['height'],'');
				if($th){//如果缩放图片成功
					unset($_POST['link_image']);
					unset($_POST['width']);
					unset($_POST['height']);
					$link=D('flink')->update($_POST);
					if($link){//如果更新成功
						$this->success('修改成功',2,'flink/edit');
					}else{
						if($th){//如果没有更改任何数据仅仅只是更改了图片尺寸也算成功
							$this->success('修改成功',2,'flink/edit');
						}else{
							$this->error('修改失败',12,'flink/update/id/'.$_POST['id'].'');
						}	
					}
				}else{
					$this->error('修改失败',12,'flink/update/id/'.$_POST['id'].'');
				}
			}else{
				if(empty($_POST['link_image'])){//如果用户没有更改图片，而改其它相关信息
					unset($_POST['link_image']);
					unset($_POST['width']);
					unset($_POST['height']);
					$link=D('flink')->update($_POST);
					if($link){
						$this->success('修改成功',2,'flink/edit');
					}else{
						$this->error('修改失败',60,'flink/update/id/'.$_POST['id'].'');
					}
				}else{//如果用户既更改了图片也更改了其它相关信息
					unset($_POST['width']);
					unset($_POST['height']);
					$linkname=D('flink')->field('link_image')->where($_POST['id'])->find();
					$arr=explode('.',$linkname['link_image']);
					$down=D('downpic')->down($_POST['link_image'],$arr[0]);
					$_POST['link_image']=$down;
					$link=D('flink')->update($_POST);
					if($link){
						$this->success('修改成功',2,'flink/edit');
					}else{
						if($down){
							$this->success('修改成功',2,'flink/edit');
						}else{
							$this->error('修改失败',2,'flink/update/id/'.$_POST['id'].'');
						}
					}
				}
			}	
		}
		function order(){//排序用的AJAX;
				$GLOBALS['debug']=0;
				$arr=explode('|',$_GET['str']);
				$id=explode(',',rtrim($arr[1],','));
				$order=explode(',',rtrim($arr[0],','));
				for($i=0;$i<count($id);$i++){
					$link[]=D('flink')->where(array('id'=>$id[$i]))->update(array('oder'=>$order[$i]));
					if(!empty($link[$i])){
						$str.=$link[$i];
					}else{
						continue;
					}
				}
				if($str){
					echo 1;
				}else{
					echo 0;
				}
		}
	}