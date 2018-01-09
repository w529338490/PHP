<?php
class Common extends Action {
		/**
		 *用于后台根据用户权限限制用户登录
		 *allow_1,allow_2,allow_3分别对应3个权限，当值为1时则获得权限，0则相反
		 */
		function init(){
			if(!(isset($_SESSION['islogin']) && $_SESSION['islogin']===1)){
				$this->redirect("login/index");
			}
			$arr=array("product", "type","style","color"); //对模块进行权限设置
			$arr1=array("orders");
			if(in_array($_GET["m"], $arr)){
				if($_SESSION["allow_3"]!="1")
					$this->error("你不能对{$_GET["m"]}模块操作!");
			}
			if(in_array($_GET["m"], $arr1)){
				if($_SESSION["allow_2"]!="1")
					$this->error("你不能对{$_GET["m"]}模块操作!");
			}
		}		
	}
