<?php
	class Common extends Action {
		function init(){
			if(file_exists('install/lock')){
				header('location:'.$GLOBALS["root"].'index.php');
			}
		}		
	}