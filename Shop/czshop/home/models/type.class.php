<?php
class Type{
		function selectguan(){
			$data=$this->field('tname,id')->where(array("pid"=>0))->select();
			return $data;
		}
}