<?php
/*
	作者:范培
	时间:2011-12-10 22:32
	简介:显示 年月日的格式
	参数1: prefix          前缀            string    可选 默认Date_
	参数2: start_year      开始年份        int       可选 默认当前年份
	参数3: end_year        结束年份        int       可选 默认当前年份
	参数4: display_months  是否显示月份    boolean   可选 默认true
	参数5: display_days    是否显示天数    boolean   可选 默认true
	参数6: reverse_years   是否逆序年份    boolean   可选 默认false
*/
	function smarty_function_my_select_date($args,&$smarty){
		//得到所有参数名
		$keys=array_keys($args);
		
		//判断是否有前缀
		if(!in_array('prefix',$keys)){
			$prefix='Date_';
		}else{
			$prefix=$args['prefix'];
		}
				
		//开始年份
		if(!in_array('start_year',$keys)){
			$start_year=date('Y');
		}else{
			if(is_numeric($args['start_year']) && $args['start_year']>0){
				$start_year=$args['start_year'];
			}else{
				$start_year=date('Y');
			}
		}
		
		//结束年份
		if(!in_array('end_year',$keys)){
			$end_year=date('Y');
		}else{
			if(is_numeric($args['end_year']) && $args['end_year']>date('Y')){
				$end_year=(int)$args['end_year'];
			}else{
				$end_year=date('Y');
			}
		}
		//是否显示月份
		if($args['display_months']===true || !in_array('display_months',$keys)){
			$display_months=true;
		}elseif($args['display_months']===false){
			$display_months=false;
		}
		
		//是否显示天
		if($args['display_days']===true || !in_array('display_days',$keys)){
			$display_days=true;
		}elseif($args['display_days']===false){
			$display_days=false;
		}

		//是否逆序显示年份
		if($args['reverse_years']===false || !in_array('reverse_years',$keys)){
			$reverse_years=false;
		}else{
			$reverse_years=true;
		}
		
		//年后面显示的字
		if(in_array('year_after_text',$keys)){
			$year_after_text=$args['year_after_text'];
		}
		
		//月份后面显示的字
		if(in_array('month_after_text',$keys)){
			$month_after_text=$args['month_after_text'];
		}
		
		//日后面显示的字
		if(in_array('day_after_text',$keys)){
			$day_after_text=$args['day_after_text'];
		}
		
		//年
		$year="<select name='{$prefix}Year'>";
		if($reverse_years){
			for($i=$end_year;$i>=$start_year;$i--){
				if($i<10){
					$i='000'.$i;
				}elseif($i<100){
					$i='00'.$i;
				}elseif($i<1000){
					$i='0'.$i;
				}
				$year.="<option value='{$i}'>{$i}</option>";
			}				
		}else{
			for($i=$start_year;$i<$end_year;$i++){
				if($i<10){
					$i='000'.$i;
				}elseif($i<100){
					$i='00'.$i;
				}elseif($i<1000){
					$i='0'.$i;
				}
				$year.="<option value='{$i}'>{$i}</option>";
			}		
		}
		$year.="</select>{$year_after_text}";
		
		//月
		$month="";
		if($display_months){
			$month="<select name='{$prefix}Month'>";
			for($i=1;$i<=12;$i++){
				if($i<10){
					$i='0'.$i;
				}
				$month.="<option value='{$i}'>{$i}</option>";
			}
			$month.="</select>{$month_after_text}";
		}
		
		//日
		$day="";
		if($display_days){
			$day="<select name='{$prefix}Day'>";
			for($i=1;$i<=31;$i++){
				if($i<10){
					$i='0'.$i;
				}
				$day.="<option value='{$i}'>{$i}</option>";
			}
			$day.="</select>{$day_after_text}";
		}
		
		return $year.$month.$day;
	}
?>