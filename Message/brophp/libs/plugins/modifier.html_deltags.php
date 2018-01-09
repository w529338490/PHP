<?php
/**
 * Smarty modifier
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_deltags} modifier plugin
 *
 * Type:     modifier<br>
 * Name:     html_deltags<br>
 * Purpose:  删除html标签
 * @author 李捷 <lijie@li-jie.me>
 * @param str string 传入的字符串
 * @param Smarty
 * @return string
 */
	function smarty_modifier_html_deltags($params){
			return strip_tags($params);
	}
?>