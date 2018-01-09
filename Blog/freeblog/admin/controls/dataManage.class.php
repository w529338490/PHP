<?php
/****************************************************************
作者：闫海静													*
功能：主要用来进行处理数据的管理，包括操作记录的设置。			*
日期：2012/1/18													*
*****************************************************************/
	class DataManage{
		function viewDB(){
			$allTables=D('freeblog');
			$result=$allTables->query('show tables','select');
			//获得用户是否存放数据表数据
			$fDb=D("foreground");
			$resultSaveData=$fDb->where(array('saveUploadData'=>'1'))->field('saveUploadData')->find();
			$resultSaveData=$resultSaveData['saveUploadData'];
			//循环查询出该微博的所有表
			$tableType=array('free_album'=>'关于FreeBlog的图片数据',
								'free_article'=>'关于FreeBlog发表文章的数据',
								'free_category'=>'关于FreeBlog发表文章的分类数据',
								'free_foreground'=>'关于FreeBlog后台管理的数据',
								'free_image'=>'关于FreeBlog的图片数据',
								'free_rereview'=>'关于FreeBlog发表文章评论的回复数据',
								'free_review'=>'关于FreeBlog发表文章的评论数据',
								'free_user'=>'关于FreeBlog用户的数据',
								'free_user_group'=>'关于FreeBlog用户分组数据',
								'free_opernote'=>'关于FreeBlog用户记录操作的记录',
								'free_tool'=>'关于FreeBlog用户小工具设置的数据',
								'free_flink'=>'关于FreeBlog的友情链接的设置',
								'free_oper'=>'关于FreeBlog的操作记录的详细设置'
							);
			$i=0;
			foreach($result as $value){
				//便利数据表名
				$tableDeta[$i]['TABLE_NAME']=$value['Tables_in_freeblog'];
				$tableDeta[$i]['TABLE_COMMENT']=$tableType[$value['Tables_in_freeblog']];
				$i++;
			}
				
			//统计上传的备份文件总数
			$saveDbDir=$_SERVER['DOCUMENT_ROOT']."/freeBlog/dataBack";
			$od=opendir($saveDbDir);
			readdir($od);
			readdir($od);
			$i=0;
			while($file=readdir($od)){
				$i++;
			}
			$this->assign('resultSaveData',$resultSaveData);
			$this->assign('uploadNum',$i);
			$this->assign('tableDeta',$tableDeta);
			$this->display();
		}

		//将数据保存为txt格式以备用户进行恢复数据
		function saveTxt(){
			$GLOBALS['debug']=0;
			$dbName=substr($_GET['TABLE_NAME'],5);
			$D=D($dbName);
			$time=time();
			//输出头信息为txt进行下载
			header("Content-type:text/plain");
			header("Content-Disposition:attachment;filename={$_GET['TABLE_NAME']}{$time}.txt");
			//添加删除操作
			$Oper=new OperDate();
			$Oper->isOpers("txt_save",'保存了'.$_GET['TABLE_NAME'].'的Txt备份文件');
			////////////////////////////////////////////////////////////////////////////////////////////			
			$resultDesc=$D->select();
			//将数据库中的数据写入到一个txt文件
			echo $dbName."\r\n";
			foreach($resultDesc as $values){
				//echo "^|";
				foreach($values as $value){
					echo "{$value}|&|";
				}
				echo "$|";
				echo "\r\n";
			}
		}
		
		function importData(){
			//上传文件
			$up=new FileUpload();
			$up->set("path","dataBack")
				 ->set("allowType",array("txt"))
				 ->set("israndname",false);
			
			if($up->upload('importData')){
				//数据库名
				$dbData=array('album','article','category','foreground','image','rereview','review','user','user_group');			
				$fileName=$up->getFileName();
				$openPath="dataBack/{$fileName}";
				$fp=fopen($openPath,'r');
				//确认要载入数据的是哪个数据库
				$dbName=trim(fgets($fp));//数据库表名
 				foreach($dbData as $value){
					if(trim($value) == $dbName){
						$dbName=trim($value);
						break;
					}
				}
				//关闭文件
				fclose($fp);
				//获得该数据库的字段
				//连接要导入的数据表
				$db=D($dbName);
				//表全名
				$fullDbName="free_".$dbName;
				$result=$db->query("desc {$fullDbName}",'select');
				$fieldss='';
				foreach($result as $values){
					//导入表格的所有字段
					$fields[]=$values['Field'];
					$fieldss.=$values['Field'].',';
				}
				//准备插入数据库中的字段
				$fieldss="(".rtrim($fieldss,',').")";
				//读取所有数据
				$Dbdatas=file_get_contents($openPath);
				//除去文件名
				$DbDatas=substr($Dbdatas,strlen($dbName));
				$lineDates=explode('$|',$DbDatas);
				//得到每行数据
				foreach($lineDates as $values){
					//再次分割成每条数据
					$str='';
					$dates=explode('|&|',$values);
					for($i=0;$i<=count($fields)-1;$i++){
						//将数据按照字段组合成post数组准备插入到数据库中
						$str.="'".trim($dates[$i])."',";
					}
					$str=rtrim($str,',');
					$strs[]=$str;
				}
				array_pop($strs);
				$wh='';
				foreach($strs as $value){
					$wh.="(".trim($value)."),";
				}
				$wh=rtrim($wh,',');
				$insertValue=$db->query("insert into {$fullDbName} {$fieldss} values {$wh}","insert");
				//连接数据库查询是否要保留备份文件
				$foreground=D('foreground');
				$saveBack=$foreground->field('saveUploadData')->find();
				//如果用户设置saveUploadData为0的话删除文件
				if(!$saveBack['saveUploadData']){
					$saveDbDir=$_SERVER['DOCUMENT_ROOT']."/freeBlog/dataBack/";
					$delFileName=$saveDbDir.$fileName;
					unlink($delFileName);
				}
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers("import_data_file","导入了{$fullDbName}的备份文件");
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('导入成功',3,'dataManage/viewDB');
			}else{
				$this->error('导入失败',3,'dataManage/viewDB');
			}
		}
		//删除上传的数据备份文件
		function delDbFile(){
			$GLOBALS['debug']=0;
			//如果为真直接删除
			if($_POST['sureDel']){
				//定位到根目录下的databack
				$saveDbDir=$_SERVER['DOCUMENT_ROOT']."/freeBlog/dataBack";
				$od=opendir($saveDbDir);
				//var_dump($od);
				readdir($od);
				readdir($od);
				while($file=readdir($od)){
					$fPath=$saveDbDir.'/'.$file;
					if(!unlink($fPath)){
						$errMsg.=$file;
					}
					
				}
				//如果有没有删除的提示信息
 				if(!empty($errMsg)){
					echo $errMsg.'删除失败!';
				}else{
					//添加删除操作
					$Oper=new OperDate();
					$Oper->isOpers("clear_data_file",'删除了所有服务器中的数据备份文件');
					////////////////////////////////////////////////////////////////////////////////////////////
					echo '删除备份文件成功!';
				}
			}
		}
		//显示所有数据
		function ViewDbOper(){
			$D=D('opernote');
			$page=new Page($D->total(),5);
			$resultDbOper=$D->limit($page->limit)->order('operTime desc')->select();
			$this->assign('resultDbOper',$resultDbOper);
			$this->assign('fpage',$page->fpage(4,5,6,0,3));//第一个选项卡分页
			$this->display();
		}
		
		//删除所有数据
		function delDbOper(){
			$GLOBALS['debug']=0;
			$D=D('opernote');
			$resultDel=$D->where(array('operTime <='=>time()))->delete();
			if($resultDel){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers("clear_data_file",'清空了所有保存记录');
				////////////////////////////////////////////////////////////////////////////////////////////
				echo '1';
			}else{
				echo '0';
			}				
		}
		//设置操作记录的记录
		function operSet(){
			$operAuthior=D('oper');
			//数据库中只有一条记录用来调控权限
			$result=$operAuthior->where(array('id'=>'1'))->find();
			$this->assign('operAuthors',$result);
			$this->display();
		}
		//将修改的内容修改到数据库
		function editNote(){
 			$db=D('oper');
			//获得更改的操作类型
			$operType=$_GET['operType'];
			//根据类型进行表更新
			switch($operType){
				case 'userManage':
					//定义该表单中的所有复选框的名，如果post数组中没有该名说明没有选择
					$editType='用户管理';
					$_POST=$this->compareArr(array('shield_name','single_del_user','multi_del_user','edit_userinfo','add_user'),$_POST);
				break;
				case 'userGroupManage':
					$editType='用户组管理';
					$_POST=$this->compareArr(array('add_user_group','del_user_group','edit_user_group'),$_POST);
				break;
				case 'articleManage':
					$editType='文章管理';
					$_POST=$this->compareArr(array('issue_article','article_edit','recyle_article','single_del_userinfo','multi_del_article','clear_recyle_article','restore_article','multi_restore_article'),$_POST);
				break;
				case 'articleGroupManage':
					$editType='文章组管理';
					$_POST=$this->compareArr(array('add_atricle_group','del_article_group','edit_article_group'),$_POST);
				break;
				case 'imageManage':
					$editType='图片管理';
					$_POST=$this->compareArr(array('add_image','single_del_image','multi_del_image','attachment_image','edit_image'),$_POST);
				break;
				case 'imageAlbumManage':
					$editType='相册管理';
					$_POST=$this->compareArr(array('add_photo_album','del_photo_album','edit_photo_album'),$_POST);
				break;
				case 'webManage':
					$editType='网站管理';
					$_POST=$this->compareArr(array('edit_title','edit_subtitle','edit_admin_email','save_upload_file','save_opers','edit_oper_set','webstat'),$_POST);
				break;
				case 'dataManage':
					$editType='数据管理';
					$_POST=$this->compareArr(array('import_data_file','clear_data_file','excel_save','txt_save'),$_POST);
				break;
				case 'operManage':
					$editType='操作管理';
					$_POST=$this->compareArr(array('del_oper','save_oper','view_oper'),$_POST);
				break;
				case 'templManage':
					$editType='模板管理';
					$_POST=$this->compareArr(array('templ_start','templ_upload','templ_del'),$_POST);
				break;
				case 'flinkManage':
					$editType='友情链接管理';
					$_POST=$this->compareArr(array('add_flink','sort_flink','single_del_flink','multi_del_flink','edit_flink'),$_POST);
					//P($_POST);
				break;
			}
			//修改设置
			$result=$db->where(array('id'=>'1'))->update($_POST);
			//查看设置结果
			if($result){
				$this->success("{$editType}模块记录设置,修改成功",3,'dataManage/operSet');
			}else{
				$this->error("{$editType}模块记录设置,修改失败",3,'dataManage/operSet');
			}
		}
		//editNote方法调用的方法
		//$arr自定义数组,$arr1post传递过来的数组
		function compareArr($arr,$arr1){
			$allKeys=array_keys($arr1);
			$diffKey=array_diff($arr,$allKeys);
			foreach($diffKey as $value){
				$arr1[$value]='0';
			}
			return $arr1;
		}
		//导出数据操作记录
		function saveOper(){
			//添加删除操作
			$Oper=new OperDate();
			$Oper->isOpers("save_oper",'保存了所有操作记录');
			////////////////////////////////////////////////////////////////////////////////////////////
			header("Content-type:application/vnd.ms-excel");
			header("Content-Disposition:filename=Oper".time().".xls");
			$db=D('opernote');
			$result=$db->select();
			$GLOBALS['debug']=0;
 			echo "<table>";
				//echo "<th>操作人</th><th>操作类型</th><th>操作详情</th><th>操作时间</th>";
				foreach($result as $value){
					echo "<tr>";
						foreach($value as $v){
								echo "<td>{$v}</td>";
						}
					echo "</tr>";
				}
			echo "</table>";
		}
	}
?>