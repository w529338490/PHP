<?php
/**
 * Smarty modifier
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {chinadate} modifier plugin
 *
 * Type:     modifier<br>
 * Name:     chinadate<br>
 * Purpose:  时间格式化
 * @author 李捷 <lijie@li-jie.me>
 * @param time string 时间戳
 * @param 格式化 string 需要格式化后的样式
 * @param Smarty
 * @return string
 */
	function smarty_modifier_chinadate($time,$str="Y年m月d日"){
			return date($str,$time);
	}
?>