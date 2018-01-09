<?php
/*
模板管理
*/
class TemplateManage{
	//检查模板文件时使用
	private $checkNum=0;
	//分配试图
	function allTemplate(){
		//遍历所有的自安装主题
		//定位到根目录下的databack
		$templateDir=$_SERVER['DOCUMENT_ROOT']."/freeBlog/home/views";
		//打开目录
		$od=opendir($templateDir);
		//P($od);
		readdir($od);
		readdir($od);
		//目录下的所有主题名及详情
		$i=0;
		while($file=readdir($od)){
			//略过系统默认主题
			if($file!="default"&&$file!="default2"){
				$template[$i]['name']=$file;//主题名
				//file_get_contents
				//如果不存在readme文件默认为无简介
				if(file_exists($templateDir."/{$file}/readme.txt")){
					$template[$i]['note']=file_get_contents($templateDir."/{$file}/readme.txt");
				}else{
					$template[$i]['note']='该模板暂时还没有简介';
				}
				$template[$i]['images']="{$GLOBALS['root']}home/views/{$file}/resource/them2.png";
				//echo "{$GLOBALS['root']}home/views/{$file}/resource/them.png";
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/{$GLOBALS['root']}home/views/{$file}/resource/them.png")){
					$template[$i]['image']="{$GLOBALS['root']}home/views/{$file}/resource/them.png";
				}else{
					$template[$i]['image']="{$GLOBALS['public']}/images/default.png";
				}
				$i++;
			}
		}
		closedir($od);
		//P($i);
		$templateNum=$i;
		//自定义模板数量
		$this->assign('templateNum',$i);
		$this->assign('templateAll',$i+1);
		//将自定义主题详细内容分配给模板
		$this->assign('template',$template);	
		$this->display();
	}
	
	//更改模板
	function changeTems(){
		$GLOBALS['debug']=0;
		//读取配置文件
		$fileRoot=fopen($_SERVER['DOCUMENT_ROOT'].'/freeBlog/index.php','r+');
			$i=0;
			while(!feof($fileRoot)){
				if($i!=2){
					$string.=fgets($fileRoot);					
				}else{
					fgets($fileRoot);
					$string.="\tdefine('TPLSTYLE','{$_POST['temName']}');          //默认模板存放的目录 \n";
				}
				$i++;
			}
			//判断打开文件是否成功
			if($fileRoot){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers("templ_start",'更改模板：'.$_POST['temName']);
				////////////////////////////////////////////////////////////////////////////////////////////
				echo '更改模板'.$_POST['temName'].'成功';
			}else{
				echo '更改失败，请稍候再试!';
			}
		file_put_contents('index.php',$string);
	}
	
	//上传模板文件
	function uploadsTemplate(){
		//P($_FILES);
		//上传文件
		$up=new FileUpload();
		$up->set("path","template")
			 ->set("allowType",array("zip"))
			 ->set("israndname",false);
		//如果上传文件失败返回错误信息
		if(!$up->upload('temUpload')){
			echo $up->getErrorMsg();
		}else{
 			$zip = new ZipArchive();
 				//检查是否打开zip成功
				$openZip=$zip->open("template/{$up->getFileName()}");
				
				//p($openZip->getArchiveComment());
  				if($openZip === TRUE){
					//解压到模板目录
					if($zip->extractTo("home/views")){
						//得到模板名称
						$temNames=explode('.',$up->getFileName());
						array_pop($temNames);
						foreach($temNames as $value){
							$tems.=$value.'.';
						}
						$tems=rtrim($tems,'.');
						//检查上传模板
						$this->checkTem("home/views/{$tems}");
						//如果解压出来的文件不是目录
						if(!is_dir("home/views/{$tems}")){
							//如果不是目录直接删除文件
							unlink("home/views/{$tems}");
							$this->error("上传的模板文件{$up->getFileName()}不符合标准，请换一套模板!",3,'templateManage/allTemplate');
							return false;
						}
						//如果检查上传的模板中没有相对应的文件执行删除给出错误提示
						if($this->checkNum != 4){
							$this->delTemplate("home/views/{$tems}");
							//可删除标识符
							$flag=true;
						}
 						//关闭ZIP资源
						$zip->close();
						//解压完成后删除ZIP文件
						$filePath=$_SERVER['DOCUMENT_ROOT']."/freeBlog/template/";
						unlink($filePath."{$up->getFileName()}");
						if($flag){
							$this->error("上传的模板文件{$up->getFileName()}不符合标准，请换一套模板!",3,'templateManage/allTemplate');
						}else{
							//添加删除操作
							$Oper=new OperDate();
							$Oper->isOpers("templ_upload",'上传模板'.$up->getFileName());
							////////////////////////////////////////////////////////////////////////////////////////////
							$this->success("安装{$up->getFileName()}模板成功",3,'templateManage/allTemplate');
						}
					}
				}else{
					$this->error("上传的模板文件{$up->getFileName()}打开失败，请重新再试!",3,'templateManage/allTemplate');
				}
		}
	}
	//点击删除模板时执行
	function templateNam(){
		$filePath=$_SERVER['DOCUMENT_ROOT']."/freeBlog/home/views/{$_GET['tempName']}";
		$this->delTemplate($filePath);
		//添加删除操作
		$Oper=new OperDate();
		$Oper->isOpers("templ_del",'删除模板'.$_GET['tempName']);
		////////////////////////////////////////////////////////////////////////////////////////////
		$this->success("删除模板成功",3,'templateManage/allTemplate');
	}
	//检查用户上传的模板
	function checkTem($filePaths){
		//打开目录
		$op=opendir($filePaths);
		readdir($op);
		readdir($op);
		while($readdir=readdir($op)){
			$paths=$filePaths."/{$readdir}";
			if(is_dir($paths)){
				if($readdir=='index'){
					$this->checkTem($paths);
				}elseif($readdir=="public"){
					$this->checkTem($paths);
				}
			}else{
				$checkAll=array('content.html','index.html','lists.html','success.html');
				if(in_array($readdir,$checkAll)){
					$this->checkNum++;
				}
			}
		}
		closedir($op);
	}	
	//删除模板文件
	function delTemplate($filePaths){
		//打开目录
		$op=opendir($filePaths);
		readdir($op);
		readdir($op);
		
		while($readdir=readdir($op)){
			$file_path=$filePaths.'/'.$readdir;
			if(is_dir($file_path)){
 				$this->delTemplate($file_path);
				rmdir($file_path);
			}else{
				 unlink($file_path);
			}
		}
		closedir($op);
		rmdir($filePaths);
	}
}
?>