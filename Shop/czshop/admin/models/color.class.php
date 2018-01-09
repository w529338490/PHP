<?php
	class color{
		function selectform($name="id", $val="0"){
			$data=$this->field('id,cname')->order('id')->select();
			
			$str="<select name='".$name."'>";
			
			$str.="<option value='0'>--颜色--</option>";
				
			foreach($data as $opt){

				$selected=($opt['id']==$val) ? "selected" : '';

				$str .= "<option ".$selected." value='".$opt['id']."'>";

				$str .= ' -'.$opt["cname"].'-';
				$str .= '</option>';
			}

			$str .= '</select>';

			return $str;
		}
	}

