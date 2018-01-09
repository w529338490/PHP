<?php
	/*
		作者：闫海静
		作用：取出分类中的|-------标记
		时间：2011/12/2
	*/
	function smarty_function_split_catTag($pars){
		$string=explode("|-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$pars['string']);
		$string=array_pop($string);
		return $string;
	}
?>