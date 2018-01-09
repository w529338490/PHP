<?php
	class TypeModel extends Dpdo {
		function selectform($name="pid", $val="0"){
			$data=$this->field('id,tname,concat(path, id,"-") as abspath')->order('abspath','id')->select();
			
			$str='<select name="'.$name.'">';
			
			$str.='<option value="0">--根分类--</option>';
				
			foreach($data as $opt){

				$selected=($opt['id']==$val) ? "selected" : '';

				$str.='<option '.$selected.' value="'.$opt['id'].'">';
			
				$count=count(explode("-", $opt["abspath"]))-4;

				$space=str_repeat("|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$count);

				$str.=$space.'|-'.$opt["tname"];
				$str.='</option>';
			}

			$str.='</select>';

			return $str;
		}
	}
	
