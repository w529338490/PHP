<?php
/***
	相册无限分类的下拉菜单html生成
	作者：卫聪
	功能：多个页面都会使用到无限分类相册的下拉菜单
***/
	class Album_formModel extends Dpdo {
		function table_select($id=null,$string='请选择相册'){//默认为空，如果指定id那下拉菜单中的option就会有selected属性
			$user=D('album');
			$path="concat(album_path,'-',id) as abspath";
			$field='id,album_path,album_title'.','.$path;
			$date=$user->field($field)->order('abspath')->select();
			$str='<select name="id" id="sel"  >';
			$nbsp='';
			if(!empty($string)){
			$str.='<option value="0">'.$string.'</option>';
			}
			for($i=0;$i<count($date);$i++){
				$num=count(explode('-',$date[$i]['album_path']));
				for($j=1;$j<$num;$j++){
					$nbsp.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-';
				}
				if($id){
					if($date[$i]['id']==$id){
						$str.='<option value="'.$date[$i]['id'].'" selected>|-'.$nbsp.$date[$i]['album_title'].'</option>';
					}else{
						$str.='<option value="'.$date[$i]['id'].'">|-'.$nbsp.$date[$i]['album_title'].'</option>';
					}
				}else{
					$str.='<option value="'.$date[$i]['id'].'">|-'.$nbsp.$date[$i]['album_title'].'</option>';
				}
					if(!empty($nbsp)){//当程序循环到这里的时候，就可以把空格给清空，以免下次循环造成空格叠加
						$nbsp=null;
					}
			}
			$str.='</select>';
			return $str;
		}	
		function table_list(){
			$user=D('album');
			$path="concat(album_path,'-',id) as abspath";
			$field='id,album_path,album_description,album_title'.','.$path;
			$date=$user->field($field)->order('abspath')->select();
			$nbsp='';
			for($i=0;$i<count($date);$i++){
				$str.='<tr>';
				$num=count(explode('-',$date[$i]['album_path']));
				for($j=1;$j<$num;$j++){
					$nbsp.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-';
				}
				//if($date[$i]['id']==1){
				//	$str.='<td>|-'.$nbsp.$date[$i]['album_title'].'</td><td>'.$date[$i]['album_description'].'</td><td><a href="update/id/'.$date[$i]['id'].'">修改</a>&nbsp</td>';
				//}else{
				$str.='<td>|-'.$nbsp.$date[$i]['album_title'].'</td><td>'.$date[$i]['album_description'].'</td><td><a href="update/id/'.$date[$i]['id'].'">修改</a>&nbsp|&nbsp<a href="del/id/'.$date[$i]['id'].'">删除</a></td>';
				//}
				if(!empty($nbsp)){//当程序循环到这里的时候，就可以把空格给清空，以免下次循环造成空格叠加
					$nbsp=null;
				}
				$str.='</tr>';
			}
			$str.='</select>';
			return $str;
		}
		function table_select2($id=null){//默认为空，如果指定id那下拉菜单中的option就会有selected属性
			$user=D('album');
			$path="concat(album_path,'-',id) as abspath";
			$field='id,album_path,album_title'.','.$path;
			$date=$user->field($field)->order('abspath')->select();
			$str='<select name="id">';
			$nbsp='';	
			$str.='<option value="0">按相册查看</option>';
			for($i=0;$i<count($date);$i++){
				$num=count(explode('-',$date[$i]['album_path']));
				for($j=1;$j<$num;$j++){
					$nbsp.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-';
				}
				if($id){
					if($date[$i]['id']==$id){
						$str.='<option value="'.$date[$i]['id'].'" selected>|-'.$nbsp.$date[$i]['album_title'].'</option>';
					}else{
						$str.='<option value="'.$date[$i]['id'].'">|-'.$nbsp.$date[$i]['album_title'].'</option>';
					}
				}else{
					$str.='<option value="'.$date[$i]['id'].'">|-'.$nbsp.$date[$i]['album_title'].'</option>';
				}
					if(!empty($nbsp)){//当程序循环到这里的时候，就可以把空格给清空，以免下次循环造成空格叠加
						$nbsp=null;
					}
			}
			$str.='</select>';
			return $str;
		}	
	}
