<?php
//查看指定评论是否已经回复
function smarty_modifier_isExit($id,$array){
	if($array[$id]){
		return true;
	}else{
		return false;
	}
}
?>