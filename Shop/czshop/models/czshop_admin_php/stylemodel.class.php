<?php
	class StyleModel extends Dpdo {
		function selectform($name="id", $val="0"){
			$data=$this->field('id,sname,sdetail')->order('id')->select();
			
			$str="<select name='".$name."' onchange='ssf(this)'>";
			
			$str.='<option value="0">--款式--</option>';
				
			foreach($data as $opt){

				$selected=($opt['id']==$val) ? "selected" : '';

				$str .= '<option '.$selected.' value="'.$opt['id'].'">';

				$str .= '&nbsp;&nbsp;-'.$opt["sname"].'-';
				$str .= '</option>';
			}

			$str .= '</select>';

			return $str;
		}
	}

