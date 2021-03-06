<?php
	//全局可以使用的通用函数声明在这个文件中.

	function un_escape($str){
 		$ret = '';
 		$len = strlen($str);
 		for ($i = 0; $i < $len; $i++){
 			if ($str[$i] == '%' && $str[$i+1] == 'u'){
 				$val = hexdec(substr($str, $i+2, 4));
				if ($val < 0x7f) 
					$ret .= chr($val);
				else if($val < 0x800) 
					$ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
				else 
					$ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
				
				$i += 5;
			
			}
			
			else if ($str[$i] == '%'){
				
				$ret .= urldecode(substr($str, $i, 3));
				
				$i += 2;
			
			}
			
			else $ret .= $str[$i];
		
		}
		
		return $ret;
	
	}

	//删除目录下所有文件和子目录
	function deldir($directory){
		if(is_dir($directory)) {      
			if($dir_handle=@opendir($directory)) {	
				while(false!==($filename=readdir($dir_handle))) {  
					$file=$directory."/".$filename;
					if($filename!="." && $filename!="..") {   
						if(is_dir($file)) {
							deldir($file);
						} else {
							unlink($file);
						}           
					}
				}
				closedir($dir_handle);                      
				                     
			}
			rmdir($directory);     
		}
	}
