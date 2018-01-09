<?php
/****************************************************************
作者：闫海静													*
功能：导出exec文件所需要的类，并根据关键字进行标识				*
日期：2012/1/17													*
*****************************************************************/
	class Tables{
		//private $tabView;//模式
		private $tbName;//表名
		private $arrField;//查询到的二维数组
		//组合转换后的数组
		function combinationArr($tbName,$arrField){
			switch($tbName){
				case "free_album":
					$mysql=D('album');
					//P($mysql);
					foreach($arrField as $key=>$value){
						foreach($value as $k=>$v){
							//如果字段是album_path分割路径
							if($k=="album_path"){
								$fields=explode('-',$v);
								$wh=array_pop($fields);
								$result=$mysql->field('album_title')->where(array('id'=>"{$wh}"))->find();
								//查找上级目录
								if($result['album_title']=='0'||empty($result['album_title'])){
									$arrField[$key][$k]='根相册';
								}else{
									$arrField[$key][$k]=$result['album_title'];
								}
							}
							if($k=='album_description'){
								if(empty($v)){
									$arrField[$key][$k]="无简介";
								}
							}
						}
					}
					return $arrField;
				break;
				case "free_article":
					foreach($arrField as $key=>$value){
						foreach($value as $k=>$v){
							if($k=='article_authority'){
								if($v=='1'){
									$arrField[$key][$k]='仅自己';
								}elseif($v=='3'){
									$arrField[$key][$k]='完全公开';
								}
							}elseif($k=='article_review'){
								if(!$v){
									$arrField[$key][$k]="不允许评论";
								}else{
									$arrField[$key][$k]="允许评论";
								}
							}elseif($k=='article_action'){
								if(!$v){
									$arrField[$key][$k]="待回收";
								}else{
									$arrField[$key][$k]="正常";
								}
							}elseif($k=='article_time'){
								$arrField[$key][$k]=$this->disposeTime($v);
							}
						}
					}
				break;
				case "free_category":
					$mysql=D('category');
					foreach($arrField as $key=>$value){
						foreach($value as $k=>$v){
							//查看类别简介是否为空
							if($k=='category_content'){
								//检查是否有简介
								if(empty($v)){
									$arrField[$key][$k]='无简介';
								}
							}
							//检查上级上级类别
							if($k=="path"){
								$fields=explode('-',$v);
								$wh=array_pop($fields);
								$result=$mysql->field('category_name')->where(array('cid'=>"{$wh}"))->find();
								//var_dump($result);
								//P($result);
								//查找上级目录
								if(!$result){
									$arrField[$key][$k]='根分类';
								}else{
									
									$arrField[$key][$k]=$result['category_name'];
								}
							}
							//检查文章数量
							if($k=='category_total'){
								if(empty($v)||$v=='0'){
									$arrField[$key][$k]='无文章';
								}
							}
							//处理时间戳
							if($k=='category_time'){
								$arrField[$key][$k]=$this->disposeTime($v);
							}
						}
					}
					break;
				case "free_flink":
					foreach($arrField as $key=>$value){
						foreach($value as $k=>$v){
							//处理时间戳
							if($k=='link_time'){
								$arrField[$key][$k]=$this->disposeTime($v);
							}
							//检查是否显示
							if($k=='disable'){
								if($v=='1'){
									$arrField[$key][$k]="显示";
								}else{
									$arrField[$key][$k]="不显示";
								}
							}
							//检查是否有联系人
							if($k=='link_body'){
								if(empty($v)){
									$arrField[$key][$k]="无联系人";
								}
							}
							//检查是否有联系人邮箱
							if($k=='link_body_email'){
								if(empty($v)){
									$arrField[$key][$k]="无联系邮箱";
								}
							}
						}
					}
					break;
				case "free_foreground":
					foreach($arrField as $key=>$value){					
						foreach($value as $k=>$v){
							if($k=='foreGround_title'){
								if(empty($v)){
									$arrField[$key][$k]="无标题";
								}
							}
							if($k=='foreGround_subtitle'){
								if(empty($v)){
									$arrField[$key][$k]="无副标题";
								}
							}
							if($k=='foreGround_email'){
								if(empty($v)){
									$arrField[$key][$k]="无联系邮箱";
								}
							}
							if($k=='saveUploadData'){
								if(!$v){
									$arrField[$key][$k]="不保存备份文件";
								}else{
									$arrField[$key][$k]="保存备份文件";
								}
							}
							if($k=='operateNotes'){
								if(!$v){
									$arrField[$key][$k]="不保存操作记录";
								}else{
									$arrField[$key][$k]="保存操作记录";
								}
							}
							if($k=='webState'){
								if(!$v){
									$arrField[$key][$k]="网站关闭中";
								}else{
									$arrField[$key][$k]="网站运行正常";
								}
							}
						}
					}
					break;
				case "free_image":
					break;
				case "free_opernote":
				case "free_rereview":
				case "free_review":
				case "free_tool":
				case "free_user":
				case "free_user_group":
			}
			return $arrField;
		}
		
		function disposeTime($time){
			return date("Y-m-d H:i:s",$time);
		}
		
		function viewTable($tbName,$key,$value){
			switch($tbName){
				case "free_album":	
					if($key=="album_path"&&$value=="根相册"){
						$bgcolor='blue';
					}elseif($key=='album_description'&&$value=='无简介'){
						$bgcolor='red';
					}
					break;
				case "free_article":
					if($key=="article_authority"&&$value=='仅自己'){
						$bgcolor='red';
					}elseif($key=='article_review'&&$value=='不允许评论'){
						$bgcolor='blue';
					}elseif($key=='article_category'&&$value=='未分类'){
						$bgcolor='yellow';
					}elseif($key=='article_action'&&$value=='待回收'){
						$bgcolor='green';
					}
					break;
				case "free_category":
					if($key=='path'&&$value=='根分类'){
						$bgcolor='blue';
					}
					if($key=='category_content'&&$value=='无简介'){
						$bgcolor='red';
					}
					if($key=='category_total'&&$value=='无文章'){
						$bgcolor='green';
					}
					break;
				case "free_flink":
					if($key=='disable'&&$value=='不显示'){
						$bgcolor='red';
					}
					if($key=='link_body'&&$value=='无联系人'){
						$bgcolor='blue';
					}
					if($key='link_body_email'&&$value=='无联系邮箱'){
						$bgcolor='green';
					}
					break;
				case "free_foreground":
							if($key=='foreGround_title'){
								if(empty($value)){
									$bgcolor='DeepPink';
								}
							}
							if($key=='foreGround_subtitle'){
								if(empty($value)){
									$bgcolor='pink';
								}
							}
							if($key=='foreGround_email'){
								if(empty($value)){
									$bgcolor='yellow';
								}
							}
							if($key=='saveUploadData'){
								if($value=="不保存备份文件"){
									$bgcolor='blue';
								}
							}
							if($key=='operateNotes'){
								if($value=='不保存操作记录'){
									$bgcolor='green';
								}
							}
							if($key=='webState'){
								if($value=='网站关闭中'){
									$bgcolor='red';
								}
							}
					break;					
				case "free_image":
					$bgcolor='white';
				case "free_opernote":
				case "free_rereview":
				case "free_review":
				case "free_tool":
				case "free_user":
				case "free_user_group":
			}
			return $bgcolor;
		}
	}
?>