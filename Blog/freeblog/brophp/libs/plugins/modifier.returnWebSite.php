<?php
	function Smarty_modifier_returnWebSite($string){
		if(!empty($string)){
			return 1;
		}else{
			return 0;
		}
	}