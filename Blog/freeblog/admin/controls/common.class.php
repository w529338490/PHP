<?php
	class Common extends Action {
		function init(){
			if(!(isset($_SESSION['islogin']) && $_SESSION['islogin']==true)){
				$this->redirect("login/index");
			} 	
			$this->assign('session',$_SESSION);
		}	
	}