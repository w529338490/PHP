<?php
/**
 * select Time
 * @author chengbinDu
 */


/**
  * @param array
  * @param Smarty
  * @return string
  * @uses smarty_function_escape_special_chars()
  */
function smarty_function_select_date($params, &$smarty){
    if($params['value'] == '0000-00-00 00:00:00') $params['value'] = '';
	$size=10;
	if($params['is_time']){
		$format="%Y-%m-%d";
	}else{
		$format='%Y-%m-%d 00:00:00';
	}
	$str='';
	$str .= '<script src="'.B_PUBLIC.'/js/date/js/jscal2.js"></script>
			<script src="'.B_PUBLIC.'/js/date/js/lang/cn.js"></script>
			<link rel="stylesheet" type="text/css" href="'.B_PUBLIC.'/js/date/css/jscal2.css" />
			<link rel="stylesheet" type="text/css" href="'.B_PUBLIC.'/js/date/css/border-radius.css" />
    		<link rel="stylesheet" type="text/css" href="'.B_PUBLIC.'/js/date/css/steel/steel.css" />';
	$str.='<input type="text" name="'.$params['name'].'" id="'.$params['id'].'" value="'.$params['value'].'" size="'.$size.'" class="date" readonly />&nbsp;';
	$str.='<script type="text/javascript">
		Calendar.setup({
		weekNumbers	: true,
		inputField	: "'.$params['id'].'",
		trigger		: "'.$params['id'].'",
		dateFormat	: "'.$format.'",
		minuteStep	: 1,
		onSelect	: function (){this.hide();}
		});
		</script>';
	return $str;
}
?>
