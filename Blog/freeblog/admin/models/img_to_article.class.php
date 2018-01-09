<?php
/**
	图片分配到文章
	作者：卫聪

*/
	class img_to_article{
		function show(){
			  $category=D('category')->field('category_name')->select(); 
				
				for($i=0;$i<count($category);$i++){
					$select.='<option value="'.$category[$i]['category_name'].'">'.$category[$i]['category_name'].'</option>';
				}
				return $select;
		}
		function date_show(){
			$time=D('article')->query('select article_time from free_article','select');
			for($i=0;$i<count($time);$i++){
				$ti[$time[$i]['article_time']]=date('y年m月d日',$time[$i]['article_time']);
			}
			$ti=array_unique($ti);
			
			foreach($ti as $key=>$value){
				$key=substr($key,0,6);
				//p($key.'---'.$value);
				$str.='<option value="'.$key.'">'.$value.'</option>';
			}
			
			return $str;
		}
	
	
	
	}