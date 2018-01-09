<{include file="public/header.tpl"}>
	<link rel='stylesheet' type='text/css' href="<{$res}>/css/register.css" />
	<script src='<{$res}>/js/common.js'></script>
	<script src='<{$public}>/js/common.js'></script>
	<script>
	function getcode(obj){
		obj.src=obj.src+"?id="+Math.random();
	}
	$(function(){
		function check_user_name_ajax(){
			var flag=false;
			$.ajax({
				async:false,
				type:'post',
				url:'<{$app}>/register/check_user',
				data:'name='+$("#username").val(),
				success:function(data){
					if(data==0){
						flag=true;
					}
				}
			})
			return flag;
		}
		
		function check_code_ajax(){
			var flag=false;
			$.ajax({
				async:false,
				type:'post',
				url:'<{$app}>/register/check_code',
				data:'code='+$("#code").val(),
				success:function(data){
					if(data==0){
						flag=true;
					}
				}
			})
			return flag;
		}	
		
		function check_email_ajax(){
			var flag=false;
			$.ajax({
				async:false,
				type:'post',
				url:'<{$app}>/register/check_email',
				data:'email='+$("#email").val(),
				success:function(data){
					if(data==0){
						flag=true;
					}
				}
			})
			return flag;
		}
		
		function check_user_name(){
			flag=false;
			username=$('#username');
			if(username.val()==''){
				username.next('span').text('用户名不能为空').css('color','red');
			}else if(getlength(username.val(),'utf8')<3 || getlength(username.val(),'utf8')>15){
				username.next('span').text('用户名由3 到 15个字符组成').css('color','red');
			}else if(/['"\s()-]/.test(username.val())){
				username.next('span').text('用户名不能含有特殊字符').css('color','red');
			}else if(parseInt(username.val())){
				username.next('span').text('用户名不能已数字起头').css('color','red');
			}else if(!check_user_name_ajax()){
				username.next('span').text('此用户已被抢注').css('color','red');
			}else{
				username.next('span').text('ok').css('color','green');
				flag=true;
			}
			return flag;
		}
		
		function check_pass(){
			flag=false;
			pass=$("#password");
			if(pass.val()==''){
				pass.next('span').text('密码不能为空').css('color','red');
			}else{
				pass.next('span').text('ok').css('color','green');
				flag=true;
			}
			return flag;
		}
		
		function check_repass(){
			flag=false;
			repass=$("#repassword");
			if(repass.val()==''){
				repass.next('span').text('请填写确认密码').css('color','red');
			}else if(repass.val()!=$("#password").val()){
				repass.next('span').text('两次输入的密码不正确').css('color','red');
			}else{
				repass.next('span').text('ok').css('color','green');
				flag=true;
			}
			return flag;		
		}
		
		function check_email(){
			flag=false;
			email=$('#email');
			if(email.val()==''){
				email.next('span').text('邮箱不能为空').css('color','red');
			}else if(!/^\w+@\w+(\.\w+)+$/.test(email.val())){
				email.next('span').text('邮箱格式不正确').css('color','red');
			}else if(!check_email_ajax()){
				email.next('span').text('此Email已被占有').css('color','red');
			}else{
				email.next('span').text('ok').css('color','green');
				flag=true;
			}
			return flag;		
		}
		
		function check_code(){
			flag=false;
			code=$("#code");
			if(code.val()==''){
				code.next('span').text('验证码不能为空').css('color','red');
			}else if(!check_code_ajax()){
				code.next('span').text('验证码错误').css("color",'red');
			}else{
				code.next('span').text('ok').css("color",'green');
				flag=true;
			}
			return flag;
		}
		
		$("#username").focus(function(){
			$(this).next('span').text("用户名由3 到 15个字符组成").css('color','#444444');
		}).blur(function(){
			check_user_name();
		})
		$("#password").focus(function(){
			$(this).next('span').text("请填写密码").css('color','#444444');
		}).blur(function(){
			check_pass();
		})
		
		$("#repassword").focus(function(){
			$(this).next('span').text("请再次输入密码").css('color','#444444');
		}).blur(function(){
			check_repass();
		})
		
		$("#email").focus(function(){
			$(this).next('span').text('请输入密码').css('color','#444444');
		}).blur(function(){
			check_email();
		})
		
		$("#code").focus(function(){
			$(this).next('span').text('');
		}).blur(function(){
			check_code();
		})
		
		$('#reg_btn').click(function(){
			if(check_user_name() && check_pass() && check_repass() && check_email() && check_code()){
				return true;
			}
			return false;
		})
	})	
	</script>
	<div id="main">
		<div id='reg_title'>
			<b>立即注册</b>
			<span><a href='#'>已有账号?现在登录</a></span>
		</div>
		<div id='reg_form'>
			<form action="<{$app}>/register/register" method='post'>
				<table cellspacing='0' border='0' align='center' width='100%'>
					<tr>
						<th><b>*</b>用户名:</th>
						<td>
							<input type='text' name='name' id='username' />
							<span>用户名由3 到 15个字符组成</span>
						</td>
					</tr>
					<tr>
						<th><b>*</b>密码:<:<h>
						<td>
							<input type='password' name='pass' id='password' />
							<span>请填写密码</span>
						</td>
					</tr>
					<tr>
						<th><b>*</b>确认密码:</th>
						<td>
							<input type='password' name='repassword' id='repassword' />
							<span>请再次输入密码</span>
						</td>
					</tr>
					<tr>
						<th><b>*</b>Email:</th>
						<td>
							<input type='text' name='email' id='email' />
							<span>请输入正确的邮箱地址</span>
						</td>
					</tr>
					<tr>
						<th>真实姓名:</th>
						<td><input type='text' name='true_name' /><span></span></td>
					</tr>
					<tr>
						<th>性别:</th>
						<td>
							<select name='sex'>
								<option value='0' selected>保密</option>
								<option value='1'>男</option>
								<option value='2'>女</option>
							</select>
							<span></span>
						</td>
					</tr>
					<tr>
						<th align='right' valign='top'><b>*</b>验证码:</th>
						<td>
							<input type='text' name='code' id='code' onkeyup="this.value=this.value.toUpperCase()"/><span></span><br />
							输入下图中的字符<br />
							<img src='<{$app}>/register/code' onclick="getcode(this)" /> <span>看不清?点击图片换一个</span>
						</td>
					</tr>				
					<tr>
						<th>&nbsp;</th>
						<td><input type='submit' id='reg_btn' value='注 册' /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<{include file="public/footer.tpl"}>