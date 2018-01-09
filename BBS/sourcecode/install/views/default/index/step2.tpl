	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SourceCode安装向导</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<script src="<{$public}>/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="<{$res}>/css/step2.css" />
	<script>
		//检测数据库密码
		function check_pass(){
			var status=false;
			$(function(){
				$.ajax({
					async:false,
					type:'post',
					url:"<{$app}>/index/check_db_pass",
					data:"host="+$("input[name=host]").val()+"&user="+$("input[name=user]").val()+"&pass="+$("input[name=pass]").val(),
					success:function(data){
						if(data==0){
							$('#pass_mess').text('用户名或密码错误!').attr('class','red');
							$('input[name=pass]');
						}else{
							$('#pass_mess').text('正确').attr('class','green');
							status=true;
						}
					}
				})
			})
			return status;
		}
		//检测用户名
		function check_user(){
			var status=false;
			$(function(){
				var admin_name=$('input[name=admin_name]');
				if(admin_name.val()==''){
					$('#admin_name_mess').text('管理员用户名不能为空!').attr('class','red');
				}else{
					$('#admin_name_mess').text('正确!').attr('class','green');
					status=true;
				}			
			})
			return status;
		}
		
		//检测管理员密码
		function check_admin_pass(){
			var status=false;
			$(function(){
				var admin_pass=$('input[name=admin_pass]');
				if(admin_pass.val()==''){
					$("#admin_pass_mess").attr('class','red');
				}else{
					$("#admin_pass_mess").text('正确').attr('class','green');
					status=true;
				}
			})
			return status;
		}
		
		//检测重复密码
		function check_admin_repass(){
			var status=false;
			$(function(){
				var admin_repass=$('input[name=admin_repass]');
				if(admin_repass.val()!=$('input[name=admin_pass]').val() || admin_repass.val()==''){
					$("#admin_repass_mess").text('两次输入的密码不匹配!').attr('class','red');
				}else{
					$("#admin_repass_mess").text('正确').attr('class','green');
					status=true;
				}
			})
			return status;
		}
		
		//检查驱动
		function check_drive(){
			var status=false;
			$(function(){
				if($("#drive").text()!='请开启pdo驱动或mysqli驱动'){
					status=true;
				}
			})
			return status;
		}
		
		//检查邮箱
		function check_email(){
			var status=false;
			$(function(){
				var email=$('input[name=email]');
				if(email.val()==''){
					$("#email_mess").text('邮箱不能为空!').attr('class','red');
				}else if(!/^\w+@\w+(\.\w+)+$/.test(email.val())){
					$("#email_mess").text('邮箱格式不正确!').attr('class','red');
				}else{
					$("#email_mess").text('正确!').attr('class','green');
					status=true;
				}
			})
			return status;
		}
		
		//安装
		function install1(){
			var status=false;
			if(check_pass() & check_user() & check_admin_pass() & check_admin_repass() & check_drive() & check_email()){
				status=true;
			}
			return status;
		}
	</script>
</head>
<body>
	<div id="header">
		<h1>数据库安装</h1>
	</div>
	<div id="main">
		<h3>填写数据库信息</h3>
		<form action="<{$app}>/index/install" method="post" id="form" onsubmit="return install1()">
		<table border='1' cellspacing="0" width="100%" id="env">
			<tr>
				<td style="width:150px;">数据库服务器:</td>
				<td style="width:250px;"><input type="text" name='host' value="localhost" /></td>
				<td>数据库服务器地址, 一般为 localhost</td>
			</tr>
			<tr>
				<td>数据库名:</td>
				<td><input type="text" name='dbname' value='sourcecode' /></td>
				<td>&nbsp;</td>
			</tr>			
			<tr>
				<td>数据库用户名:</td>
				<td><input type="text" name='user' value="root" /></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>数据库密码:</td>
				<td><input type="password"  name='pass' onblur="check_pass()" /></td>
				<td id="pass_mess">&nbsp;</td>
			</tr>			
			<tr>
				<td>数据表前缀:</td>
				<td><input type="text" name="prefix" value="sc_" /></td>
				<td>同一数据库运行多个论坛时，请修改前缀</td>
			</tr>	
			<tr>
				<td>数据库驱动:</td>
				<td id="drive">
					<{if $pdo=='1' && $mysqli=='1'}>
						<input type="radio" name="drive" value='pdo' checked style="width:20px" />pdo
						<input type="radio" name="drive" value='mysqli' style="width:20px" />mysqli
					<{elseif $mysqli=='1'}>
						<input type="radio" name="drive" value='mysqli' style="width:20px" checked />mysqli
					<{elseif $pdo=='1'}>
						<input type="radio" name="drive" value='pdo' checked style="width:20px" />pdo
					<{else}>
						<span class="red">请开启pdo驱动或mysqli驱动</span>
					<{/if}>
				</td>
				<td>&nbsp;</td>
			</tr>			
		</table>
		<h3>填写管理员信息</h3>
		<table border='1' cellspacing="0" width="100%" id="env">
			<tr>
				<td style="width:150px;">管理员账号:</td>
				<td style="width:250px"><input type='text' name="admin_name" value="admin" onblur="check_user()"/></td>
				<td id="admin_name_mess">&nbsp;</td>
			</tr>
			<tr>
				<td>管理员密码:</td>
				<td><input type='password' name="admin_pass" onblur="check_admin_pass()" /></td>
				<td id="admin_pass_mess">管理员密码不能为空</td>
			</tr>			
			<tr>
				<td>重复密码:</td>
				<td><input type='password' name="admin_repass" onblur="check_admin_repass()" /></td>
				<td id="admin_repass_mess">&nbsp;</td>
			</tr>
			<tr>
				<td>管理员邮箱:</td>
				<td><input type="text" name="email" value="admin@lampbrother.net" onblur="check_email()" /></td>
				<td id="email_mess">&nbsp;</td>
			</tr>
		</table>
		<input type="submit" id="install" value="安装" onclick="install1()" style="padding:5px 10px;margin-top:10px;"/>
		</form>
	</div>
	
</body>
</html>
