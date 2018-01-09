<?php
/**
	小工具
	作者：卫聪
*/
	class tool{
		function index(){//首页
			$this->display();
		}
		function left(){//ajax请求的方法
			$GLOBALS['debug']=0;
			$left=$_GET['lid']?rtrim($_GET['lid'],','):null;//接受ajax的左边栏的get传参
			$right=$_GET['rid']?rtrim($_GET['rid'],','):null;//接受ajax的右边栏的get传参
			$l=explode(',',$left);
			$r=explode(',',$right);
			if(!empty($left)){//ajax接受左边栏
				for($i=0;$i<D('tool')->total();$i++){
				$tool=D('tool')->where(array('lid'=>$i))->update(array('left_bar'=>$l[$i]));
				}
				echo 1;
			}else{
				
			}
			if(!empty($right)){//ajax接受右边栏
				for($i=0;$i<D('tool')->total();$i++){
				$tool2=D('tool')->where(array('rid'=>$i))->update(array('right_bar'=>$r[$i]));
				}
				echo 1;
			}else{
			
			}
		}
	}