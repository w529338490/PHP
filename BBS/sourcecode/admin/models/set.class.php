<?php
	/*+------------------------------------------------+
	  | 网站配置控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	*/
	class Set{
		/* 提示用信息 */
		public $error;
		private $config_file="config.inc.php";
		
		/**
		  * 得到用户是否开启了 memcache
		  * @return 开启了memcache 返回1 没有开启返回 0;
		  */
		public function getMemStatus(){
			$content=$this->getConfig();
			$pattern='/\/\*\$memServers/';
			if(preg_match($pattern,$content)){  //如果有 /* 这个注释说明未开启，
				return 0;
			}
			return 1;
		}
		
		/**
		  * 得到所有的memcache 服务器
		  * @return 成功返回 服务器 失败返回 false
		  */
		public function getMemServers(){
			$content=$this->getConfig();
			$pattern='/memServers\s*?=\s*?array\((array\(.*?)\)\;/';
			if(preg_match($pattern,$content,$a)){
				$pattern='/(?:array\(\"([\w\.]+?|[\d\.]+?)\"\,11211\)\,?)*?/U';
				if(preg_match_all($pattern,$a[1],$b)){
					$list=array();
					foreach($b[1] as $val){
						if($val){
							$list[]=$val;
						}
					}
					return $list;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		/**
		  * 修改配置文文件
		  * @return 成功 true 失败 false
		  */
		public function modify(){
			
			$content=$this->getConfig();
			
			/* 如果用户要替换logo */
			if($_FILES['logo']){
				if(!$this->replace_logo()){
					$this->error='网站LOGO更换失败！';
					return false;
				}
			}
			
			/*  循环匹配替换 */
			foreach($_POST as $key=>$val){
				
				$pattern='/(\"'.$key.'\"\,)(.*?)(\)\;)/';
				if(preg_match($pattern,$content)){
			
					$replace_content="\$1\"".$val."\"\$3";
					$content=preg_replace($pattern,$replace_content,$content);
				}elseif($key=='CSTART'){
					
					if(!$this->set_cstart($val)){
						$this->error='缓存设置失败！';
						return false;
					}
				}elseif($key=='memcache_servers'){
					
					/* 如果是 memcache_servers 服务器就组合成数组 */
					$arr=explode(',',$val);
					foreach($arr as $v){
						if(!empty($v)){
							$str.='array("'.$v.'",11211),';
						}
					}
					$str=rtrim($str,',');
					
					$pattern='/(memServers\s*?=\s*?array\()(.*?)(\)\;)/';
					$replace_content="\$1".$str."\$3";
					$content=preg_replace($pattern,$replace_content,$content);
					/* 如果是memcache_status 就去掉注释或添加注释 */
				}elseif($key=='memcache_status'){
					if($val==1){
						//$pattern='/\/\*(\$memServers.*?(\)\;)\*\//';
						$pattern='/\/\*(\$memServers=array\(.*?\)\;)\*\//';
						$replace_content="\$1";
						$content=preg_replace($pattern,$replace_content,$content);
			 			
					}else{
						$pattern='/(?:\/\*)?(\$memServers.*\)\;)(?:\*\/)?/';
						$replace_content="/*\$1*/";
						$content=preg_replace($pattern,$replace_content,$content);
					}
				}
			}
			$headle=@fopen($this->config_file,'w');
			if(@fwrite($headle,$content)){
				return true;
			}else{
				$this->error='写入文件出错！';
				return false;
			}
			
		}
		
		
		
		/**
		  * 更换网站LOGO.
		  * @return boolean 成功 true 失败 false
		  */
		private function replace_logo(){
				$logo_path='./public/images/';
				$up=new FileUpload();
				$up->set('path',$logo_path)
					->set('israndname',false);
				if($up->upload('logo')){
					$handle_img=new Image($logo_path);
					$oldname=$logo_path.$handle_img->thumb($up->getFileName(),500,60);
					$newname=$logo_path.'logo.png';
					$info=getimagesize($oldname);
					 
					 switch($info[2]){
						case 1: //gif
							$logo_img=imagecreatefromgif($oldname);
							imagepng($logo_img,$newname);
							break;
						case 2: //jpg
							$logo_img=imagecreatefromjpeg($oldname);
							imagepng($logo_img,$newname);
							break;
						default:
							if(file_exists($newname)){
								unlink($newname);
							}
							if(!rename($oldname,$newname)){
								return false;
							}
					 }
					 return true;
				}else{
					return false;
				}
		}
		
		/**
		  * 得到所有网站配置需要匹配的数据
		  * @return array 将所有的数据形成数组返回
		  */
		public function getBase(){
			$data['TITLE']=TITLE;					//网站标题
			$data['KEYWORDS']=KEYWORDS;				//网站关键字
			$data['LISTSIZE']=LISTSIZE;				//列表页分页大小
			$data['COMMENTSIZE']=COMMENTSIZE;		//帖子页分页大小
			$data['DESC']=DESC;						//网站简介
			$data['LOGO']=LOGO;						//logo图片
			
			//打开配置文件
			$content=$this->getConfig('index.php');
			//配置里面的 CSTART
			$pattern='/(?:\"CSTART\"\,\"?(.*?)\"?)(\)\;)/';
			if(preg_match($pattern,$content,$tmp)){
				$data['CSTART']=(int)$tmp[1];
			}
			$data['CTIME']=CTIME;					//缓存时间
			$data['LOGINREWARD']=LOGINREWARD;		//登录奖励的积分数
			$data['DRIVER']=DRIVER;					//数据库驱动
			$data['DEBUG']=DEBUG;					//调试模式
			$data['memcache_status']=$this->getMemStatus();	//调用模型的 getMemstatus 方法得到用户是否开启了 memcache
			$data['memcache_servers']=implode(',',$this->getMemServers());	//得 memcache 服务器
			
			return $data;
		}
		
		/**
		  *	得到BBS配置
		  * @return array 将所有的数据形成数组返回
		  */
		public function getBbs(){
			
			$data['LOGINREWARD']=LOGINREWARD;
			$data['B_SUBJECTPZ']=B_SUBJECTPZ;
			$data['B_COMMENTPZ']=B_COMMENTPZ;
			$data['B_SUBJECT_REWARD']=B_SUBJECT_REWARD;
			$data['B_COMMENT']=B_COMMENT;
			$data['B_HOT_NUM']=B_HOT_NUM;
			$data['B_SUBJECT_REWARD']=B_SUBJECT_REWARD;
			$data['B_COMMENT']=B_COMMENT;
			$data['B_SUBJECT_TOP']=B_SUBJECT_TOP;
			$data['B_SUBJECT_ESS']=B_SUBJECT_ESS;
			$data['B_SUBJECT_RECOM']=B_SUBJECT_RECOM;
			$data['PUBLISH_INTERVAL_SUBJECT']=PUBLISH_INTERVAL_SUBJECT;
			$data['PUBLISH_INTERVAL_COMMENT']=PUBLISH_INTERVAL_COMMENT;
			$data['B_NEWS_LIST_NUM']=B_NEWS_LIST_NUM;
			$data['B_NOTICE_LIST_NUM']=B_NOTICE_LIST_NUM;
			
			return $data;
		}
		
		/**
		  *	得到空间配置
		  * @return array 将所有的数据形成数组返回
		  */
		public function getSpace(){
			
			$data['S_SPEAKPZ']=S_SPEAKPZ;
			$data['S_LOG_INDEX']=S_LOG_INDEX;
			$data['S_MESS_INDEX']=S_MESS_INDEX;
			$data['S_FRIEND_INDEX']=S_FRIEND_INDEX;
			$data['S_GUEST_INDEX']=S_GUEST_INDEX;
			$data['S_SPEAK_REWARD']=S_SPEAK_REWARD;
			$data['S_LOG_REWARD']=S_LOG_REWARD;
			$data['S_LOGC_REWARD']=S_LOGC_REWARD;
			$data['S_PHOALBUM_REWARD']=S_PHOALBUM_REWARD;
			$data['S_MESS_REWARD']=S_MESS_REWARD;
			$data['S_MODFACE_REWARD']=S_MODFACE_REWARD;
			
			return $data;
		}
		
		/**
		  * 清空缓存
		  * @return bool 成功：true 失败 false
		  */
		public function clear_cache(){
			$path='./runtime/cache';
			if($this->del_dir($path)){
				return true;	
			}
			return false;
		}
		
		/**
		  * 删除目录
		  * @return success TRUE error FALSE
		  */
		private function del_dir($dir){
			$dir=rtrim($dir,'/');
			$handle=opendir($dir);
			//过滤两个特殊目录
			readdir();
			readdir();
			
			//将路径与文件名组合
			while(false!==($file=readdir())){
				$sub_file=$dir.'/'.$file;
				if(is_file($sub_file)){
					unlink($sub_file);
				}elseif(is_dir($sub_file)){
					$this->del_dir($sub_file);
					rmdir($sub_file);
				}
			}
			return true;
		}
	
		/**
		  * 用于得到配置文件的内容.
		  * 并将特殊符号转义，然后返回
		  * @return string 配置文件的内容
		  */
		private function getConfig($file=''){
			if($file===''){
				$file=$this->config_file;
			}
			if(!$handle=@fopen($file,"r")){
				return false;
			}
			if(!$content=@fread($handle,filesize($file))){
				return false;
			}
			if(!fclose($handle)){
				return false;
			}
			return $content;	
		}
		
		/**
		  * 设置缓存是否开启
		  * @return boolean 成功 true 失败 false
		  */
		private function set_cstart($val){
			$pattern='/(\"CSTART\"\,)(.*?)(\)\;)/';
			$index_cstart=$this->getConfig('index.php');
			$space_cstart=$this->getConfig('space.php');
			$replace_content="\$1\"".$val."\"\$3";
			$index_cstart=preg_replace($pattern,$replace_content,$index_cstart);
			$headle=@fopen('index.php','w');
			if(!@fwrite($headle,$index_cstart)){
				$this->error='写入文件出错！';
				return false;
			}
			
			$space_cstart=preg_replace($pattern,$replace_content,$space_cstart);
			$headle=@fopen('space.php','w');
			if(!@fwrite($headle,$space_cstart)){
				$this->error='写入文件出错！';
				return false;
			}
			return true;
		}
		
		/**
		  * 数据库优化
		  */
		public function optimize(){
			$tab=D("album");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("board");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("comment");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("flink");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("friend");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("guest");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("hot_search");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("level");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("log");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("log_comm");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("message");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("news");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("notice");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("photo");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("sms");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("speak");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("speak_comm");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("subject");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
			$tab=D("user");
			$tab->query("OPTIMIZE TABLE {$tab->tabName}");
		
		}
	}