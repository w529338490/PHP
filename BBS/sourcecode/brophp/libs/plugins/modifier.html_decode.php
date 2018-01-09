<?php
/**
 * Smarty modifier
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_decode} modifier plugin
 *
 * Type:     modifier<br>
 * Name:     html_decode<br>
 * Purpose:  将html实体转换回来
 * @author 李捷 <lijie@li-jie.me>
 * @param str string 传入的字符串
 * @param Smarty
 * @return string
 */
	function smarty_modifier_html_decode($params){
			return htmlspecialchars_decode($params);
	}
?>