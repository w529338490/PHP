<?php
//返回数组中的指定回复ID的回复
	function smarty_function_reReview($pargs){
 		$string='';
		foreach($pargs['reviewArray'] as $keys=>$values){
 			if($keys == $pargs['reID']){
				foreach($values as $value){
						$string.="<font color='blue'><hr /><br /><br />{$value['name']}在".date('Y年-m月-d日 H:i:s',$value['time'])."回复说：</font>";
						$string.="<br /><br /><br />{$value['content']}<br /></br /><a>删除该条回复</a>";
				} 
			}
		}
		return $string; 
	}