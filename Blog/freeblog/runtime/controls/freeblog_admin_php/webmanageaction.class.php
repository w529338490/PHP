<?php
/*网站管理
*/
	class WebManageAction extends Common {
		//显示默认数据
		function foreGroundManage(){
 			$result=D('foreground');
			$res=$result->where(array('fid'=>1))->find();
			//P($res);
			//更改网站状态时的按钮输出
			$button=array(1=>0,1,2,3,4,5,6,7,8,9);
			if(shuffle($button)){
				//组合成新数组
				for($i=1;$i<=count($button);$i++){
					$buttons[$i]=$button[$i-1];
				}		
 				$inputButton.="<form>";			
				foreach($buttons as $key=>$value){
 					$inputButton.="<span style='width:30px;height:30px;text-align:center;' class='button' onclick='checkPwds({$value})'>{$value}</span>";
					if($key % 3 ==0){
						$inputButton.='<br />';
					}
				}
				$inputButton.='<input type="hidden" value="" id="pwdName" name="pwdNum"/>';
				$inputButton.="<span style='width:76px;height:30px;text-align:center;margin-top:-42px;' class='button' onclick='vifyPwd()'>确认输入</span>";
			}
			$this->assign('buttons',$inputButton);
			$this->assign('data',$res);
			$this->display();
		}
		//更改前台标题等内容
		function udpateForeGround(){
 			switch(key($_POST)){
				case 'foreGround_title' :
					$string='修改网站标题';
					$operType='edit_title';
				break;
				case 'foreGround_subtitle':
					$string='修改网站副标题';
					$operType='edit_subtitle';
				break;
				case 'foreGround_email':
					$string='管理员Email修改';
					$operType='edit_admin_email';
				break;
			}
			$result=D('foreground');
			$res=$result->where(array('fid'=>1))->update($_POST);
			if($res){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers($operType,$string);
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('修改成功',3,'webManage/foreGroundManage');
			}else{
				$this->error('修改失败',4,'webManage/foreGroundManage');
			}
		}
		//更改默认是否开启数据备份文件
		function saveDataBack(){
			$GLOBALS['debug']=0;
			$updateDb=D('foreground');
			//更改数据库内容
 			$resultSaveDb=$updateDb->where(array('fid'=>'1'))->update($_POST);
			//回显结果
			if($resultSaveDb){
				//判断是修改成为备份文件还是不保存文件
				if($_POST['saveUploadData']=='1'){
					$alertMsg='保存';
				}else{
					//删除备份数据时的备份文件
					$saveDbDir=$_SERVER['DOCUMENT_ROOT']."/freeBlog/dataBack/";
					$op=opendir($saveDbDir);
					readdir($op);
					readdir($op);
					while($filename=readdir($op)){
						unlink($saveDbDir.$filename);
					}
					$alertMsg='不保存';
				}
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers("save_upload_file","文件备份状态修改为：".$alertMsg);
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('修改成功,将从此刻开始'.$alertMsg.'数据备份文件',3,'webManage/foreGroundManage');
			}else{
				$this->error('修改失败',4,'webManage/foreGroundManage');
			}
		}
		
		//修改用户是否保存操作记录
		function saveOper(){
			$OperDb=D('foreground');
			//P($_POST);
			$resultOper=$OperDb->where(array('fid'=>'1'))->update($_POST);
			if($resultOper){
				//判断是修改成为备份文件还是不保存文件
				if($_POST['saveOpers']=='1'){
					$alertMsg='记录';
				}else{
					$alertMsg='不记录';
				}
				$this->success('修改成功,将从此刻开始'.$alertMsg.'数据备份文件',3,'webManage/foreGroundManage');
			}else{
				$this->error('修改失败',4,'webManage/foreGroundManage');
			}
		}
		
		//关闭、开启网站
		function changeWebState(){
			$GLOBALS['debug']=0;
			$ChangeState=D('foreground');
			$resultState=$ChangeState->where(array('fid'=>'1'))->find();
			//判断键盘密码传过来的值是否和数据库中的密码相同
			if($_POST['pwdNum'] == $resultState['offpassword']){
				if($resultState['webstate']==1){
					$alertMsg='关闭';
					$_POST['webstate']=0;
				}else{
					$alertMsg='开启';
					$_POST['webstate']=1;
				}
				$_POST['offpassword']=$_POST['pwdNum'];
				unset($_POST['pwdNum']);
				$updateState=$ChangeState->where(array('fid'=>'1'))->update($_POST);
				if($updateState){
					//如果是1返回时开启网站，0是关闭状态
					//添加删除操作
					$Oper=new OperDate();
					$Oper->isOpers("save_upload_file","网站状态修改为：".$alertMsg);
					////////////////////////////////////////////////////////////////////////////////////////////
					echo $_POST['webstate'];
				}else{
					//执行过程中出错直接返回操作失败
					$this->error('操作失败',4,'webManage/foreGroundManage');
				} 
			}else{
					//返回2表示密码不匹配
					echo 2;
					//echo '安全密码不匹配,请返回重试';
			}
		}
		
		//更改网站安全密码
		function chOfPwd(){
			//P($_POST);
			//检验旧密码是否和输入的密码相同
			$chPwd=D('foreground');
			$oldPwd=$chPwd->where(array('fid'=>'1'))->field('offPassword')->find();
			//判断旧密码是否相同
			if($_POST['foreGround_OldOfPwd']==$oldPwd['offPassword']){
				//判断输入的密码是否是数字类
				if(is_numeric($_POST['foreGround_NewOfPwdB'])){
					//判断两次新密码是否相同
					if($_POST['foreGround_NewOfPwdA'] == $_POST['foreGround_NewOfPwdB']){
						$updateChPwd=$chPwd->where(array('fid'=>'1'))->update(array('offPassword'=>$_POST['foreGround_NewOfPwdA']));
						//查看是否修改成功
						if($updateChPwd){
							$this->success('修改成功，如需操作请使用新密码',4,'webManage/foreGroundManage');
						}else{
							$this->error('修改密码失败',4,'webManage/foreGroundManage');
						}
					}else{
						$this->error('两次新密码输入不同',4,'webManage/foreGroundManage');
					}
				}else{
					$this->error('安全密码必须是数字',4,'webManage/foreGroundManage');
				}
			}else{
				$this->error('旧安全密码匹配失败',4,'webManage/foreGroundManage');
			}
		}
		//验证输入的原密码是否相同
		function vifyPwd(){
			$GLOBALS['debug']=0;
			$Pwd=D('foreground');
			//查看旧密码
			$changePwd=$Pwd->where(array('fid'=>'1'))->field('offPassword')->find();
			if($changePwd['offPassword'] == $_POST['oldPwds']){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
?>