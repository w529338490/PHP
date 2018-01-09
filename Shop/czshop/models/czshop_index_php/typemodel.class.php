<?php
class TypeModel extends Dpdo {
		function selectguan(){
			$data=$this->field('tname,id')->where(array("pid"=>0))->select();
			return $data;
		}
}