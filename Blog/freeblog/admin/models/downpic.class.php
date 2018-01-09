<?php
/**
	下载远程图片
	作者：卫聪
*/
	class downpic{
		function down($url,$linkid,$th=null,$width=null,$height=null){//linkid传进来的实际上是time()
			$date=file_get_contents($url);
			$logoinfo=explode('/',$url);
			$logoinfo=array_pop(explode('.',array_pop($logoinfo)));
			$file='public/uploads/logo/';
			$linkid=$linkid.'.'.$logoinfo;
			$path=$file.$linkid;
			if(!file_exists($file)){
				mkdir($file);
			}
			if(file_put_contents($path,$date)){
					if(file_exists($path)){
						if($th){
						$image=new Image();
						$th=$image->thumb('logo/'.$linkid,$width,$height,'');
						$th=array_pop(explode('/',$th));
							return $th;
						}else{
							return $linkid;
						}
					}else{
						return false;
					}
			}else{
				return false;
			}
		}
	
	}