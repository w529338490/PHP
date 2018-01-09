<?php
	//全局可以使用的通用函数声明在这个文件中.
	function user_no_num($str){
		if(is_numeric(substr($str,0))){
			return false;
		}
		return true;
	}
	
	//环境检查
	function check_env(){
		$env=array();
		$sys_php_apache=$_SERVER['SERVER_SOFTWARE'];//系统和php版本和apache
		$sys_php_apache=explode(' ',$sys_php_apache);
		$env['sys']=trim($sys_php_apache[1],'()');//系统
		$env['php']=$sys_php_apache[2];//php版本
		$env['apache']=$sys_php_apache[0];//apache
		$env['upload_file_maxsize']=ini_get('upload_max_filesize');//最大文件上传
		$gd_info=gd_info();
		$env['gd_version']=$gd_info['GD Version'];//GD版本
		$env['disk_space']=tosize(disk_free_space($_SERVER['DOCUMENT_ROOT']));
		return $env;
	}
	
	//目录,文件检查
	function check_file(){
		$auth=array();
		$auth['public']=is_writable('./public')?'可写':'不可写';
		$auth['runtime']=is_writable('./runtime')?'可写':'不可写';
		$auth['conf']=is_writable('./config.inc.php')?'可写':'不可写';
		$auth['index']=is_writable('./index.php')?'可写':'不可写';
		$auth['space']=is_writable('./space.php')?'可写':'不可写';
		return $auth;
	}
	
	//函数检测
	function check_func(){
		$func=array();
		$func['mb_substr']=function_exists('mb_substr')?'支持':'不支持';
		return $func;
	}