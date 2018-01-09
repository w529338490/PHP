<?php
	class Type {
		function selectform($name="pid", $val="0"){
			$data=$this->field('id,name,concat(path,"-", id) as abspath')->order('abspath')->select();
			
			$str='<select name="'.$name.'">';
			
			$str.='<option value="0">--根分类--</option>';
				
			foreach($data as $opt){

				$selected=($opt['id']==$val) ? "selected" : '';

				$str.='<option '.$selected.' value="'.$opt['id'].'">';
			
				$count=count(explode("-", $opt["abspath"]))-2;

				$space=str_repeat("|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$count);

				$str.=$space.'|-'.$opt["name"];
				$str.='</option>';
			}

			$str.='</select>';

			return $str;
		}
	}
	
