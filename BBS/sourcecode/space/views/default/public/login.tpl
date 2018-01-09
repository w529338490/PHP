<div id="login_send" class="send">
	<div class="column" style="width:400px;">
		<div class="column_title" style="color:#006699">用户登录<span id="checkuserexist" style="text-align:center;width:100%"></span></div>
			<div class="column_content">
				<div style="margin:5px auto;">
					<form action="<{$app}>/pub/dologin" method="post" name="loginform" onsubmit="return checklogin();">
						<span style="float:left;width:30%;text-align:right">
							<select style="border:1px solid #cccccc;" name="login_type" id="login_type">
								<option value="3">用户名</option>
								<option value="1">Email</option>
								<option value="2">UID</option>
							</select>
						</span>
					<span style="float:right;width:70%;text-align:left">
						<input type="text" id="login_name" name="name" style="border:1px solid #cccccc;width:180px;margin-left:10px;">
					</span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin:5px auto;">
					<span style="float:left;width:30%;text-align:right">密　码:</span>
					<span style="float:right;width:70%;text-align:left;"> 
						<input type="password" id="login_pass" name="pass" style="border:1px solid #cccccc;width:180px;margin-left:10px;" onblur="checkuserexist(login_type.value,login_name.value,login_pass.value);">
					</span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin:5px auto;">
					<span style="float:left;width:30%;text-align:right">验证码:</span>
					<span style="float:right;width:70%;text-align:left;"> 
						<input type="text" name="code" style="border:1px solid #cccccc;width:95px;margin-left:10px;" onblur="checkcode(this.value)" onkeyup="this.value=this.value.toUpperCase()">&nbsp;&nbsp;<img src="<{$app}>/pub/code/" id="codepic" onclick="this.src='<{$app}>/pub/code/'+Math.random()">
					</span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin-top:30px;">
					<input type="submit" class="pn" value="登录" />&nbsp;&nbsp;&nbsp;&nbsp;
					<button class="pn" onclick="show('login_send','none');show('bottom','none')">取消</button>
				</div>
				</form>
				<div class="nav"></div>
			</div>
		</div>
		<div class="close"><a href="javascript:void(0);" onclick="show('login_send','none');show('bottom','none')"></a></div>
	</div>