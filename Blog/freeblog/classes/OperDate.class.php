<?php
/****************************************************************
作者：闫海静													*
功能：添加各个操作流程的操作记录到数据库						*
日期：2012/1/18													*
*****************************************************************/
	//记录要操作的内容
	class OperDate{
		private $oName;//操作人
		private $oTime;//操作时间
		private $userManage=array('shield_name','single_del_user','multi_del_user','edit_userinfo','add_user');
		private $userGroupManage=array('add_user_group','del_user_group','edit_user_group');
		private $articleManage=array('issue_article','article_edit','recyle_article','single_del_userinfo','multi_del_article','clear_recyle_article','restore_article','multi_restore_article');
		private $articleGroupManage=array('add_atricle_group','del_article_group','edit_article_group');
		private $imageManage=array('add_image','single_del_image','multi_del_image','attachment_image','edit_image');
		private $imageAlbumManage=array('add_photo_album','del_photo_album','edit_photo_album');
		private $webManage=array('edit_title','edit_subtitle','edit_admin_email','save_upload_file','save_opers','edit_oper_set','webstat');
		private $dataManage=array('import_data_file','clear_data_file','excel_save','txt_save');
		private $operManage=array('del_oper','save_oper','view_oper');
		private $templManage=array('templ_start','templ_upload','templ_del');
		//判断操作模块
		function noteModel($notetype){
			if(in_array($notetype,$this->userManage)){
				$noteModel='用户管理';
			}elseif(in_array($notetype,$this->userGroupManage)){
				$noteModel='用户组管理';
			}elseif(in_array($notetype,$this->articleManage)){
				$noteModel='文章管理';
			}elseif(in_array($notetype,$this->articleGroupManage)){
				$noteModel='文章组管理';
			}elseif(in_array($notetype,$this->imageManage)){
				$noteModel='图片管理';
			}elseif(in_array($notetype,$this->imageAlbumManage)){
				$noteModel='相册管理';
			}elseif(in_array($notetype,$this->webManage)){
				$noteModel='网站管理';
			}elseif(in_array($notetype,$this->dataManage)){
				$noteModel='数据管理';
			}elseif(in_array($notetype,$this->operManage)){
				$noteModel='记录管理';
			}elseif(in_array($notetype,$this->templManage)){
				$noteModel='模板管理';
			}elseif(in_array($notetype,$this->flinkManage)){
				$noteModel='友情链接管理';
			}else{
				$noteModel='未知模块';
			}
			return $noteModel;
		}
		//查找影响的具体
		/*
		$operDb,操作的数据库资源
		$operNum,操作的关键字
		$name,查找的关键字
		$name1,条件关键字
		*/
 		function Opers($operDb,$operNum,$name,$name1){
			$db=D($operDb);
			//var_dump($db);
			if(is_array($operNum)){
				$wh='';
				foreach($operNum as $value){
					$wh.="'{$value}',";
				}
				$wh=rtrim($wh,',');
				$result=$db->query("select {$name} from free_{$operDb} where {$name1} in ({$wh})","select");
				$string='';
				foreach($result as $value){
					foreach($value as $v){
						$string.=$v.',';
					}
				}
				$strs=rtrim($string,',');
			}else{
				//P($result);
				//P("select {$name} from free_{$operDb} where {$name1}='{$operNum}'");
				$result=$db->query("select {$name} from free_{$operDb} where {$name1}='{$operNum}'",'find');
				$strs=$result[$name];
			}
			return $strs;
			
		}
		//组合成操作动作
		//string1,操作主语
		//string2,操作对象
		function operString($string1,$string2){
				$strs=$string1.$string2;
			return $strs;
		}
		//进行插入数据库
		function isOper($opertype,$operDb,$operNum,$name,$name1,$string){
			if($_SESSION['isOpenNotes']){
				$db=D('oper');
				$dbs=D('opernote');
				$result=$db->field("{$opertype}")->where(array('id'=>'1'))->find();
				//操作函数
				if($result[$opertype]){
					//查询出数据库中是否允许记录该操作。
					$_POST['operType']=$this->noteModel($opertype);//获得操作的模块
					$_POST['operTime']=$this->oTime=time();//操作的时间
					$_POST['oname']=$_SESSION['user_username'];//操作人
					$_POST['operDeta']=$this->operString($string,$this->Opers($operDb,$operNum,$name,$name1));
					//P($this->Opers($operDb,$operNum,$name,$name1));
					$dbs->insert($_POST);
				}
			}
		}
		//进行插入数据库
		function isOpers($opertype,$string){
			$db=D('oper');
			$dbs=D('opernote');
			$result=$db->field("{$opertype}")->where(array('id'=>'1'))->find();
			if($_SESSION['isOpenNotes']){
				if($result[$opertype]){
					$_POST['operType']=$this->noteModel($opertype);//获得操作的模块
					$_POST['operTime']=$this->oTime=time();//操作的时间
					$_POST['oname']=$_SESSION['user_username'];//操作人
					$_POST['operDeta']=$string;
					$dbs->insert($_POST);
				}
			}
		}
	}
?>