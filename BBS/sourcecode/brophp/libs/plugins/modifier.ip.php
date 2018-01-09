<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty ip modifier plugin
 *
 * Type:     modifier<br>
 * Name:     ip<br>
 * Purpose:  转换IP
 * @author   李捷 <lijie@li-jie.me>
 * @param int
 * @return string
 */
function smarty_modifier_ip($ip){
	return long2ip($ip);
}

/* vim: set expandtab: */

?>
