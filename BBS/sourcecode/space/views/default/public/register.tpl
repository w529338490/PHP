<div id="reg_send" class="send" style="margin-left:-240px;margin-top:-200px">
	<div class="column" style="width:480px;">
		<div class="column_title" style="color:#006699">用户注册</div>
			<div class="column_content">
			<form action="<{$app}>/pub/register" method="post" name="regform" onsubmit="return acheck();">
				<div style="margin:5px auto;">
					<span style="float:left;width:25%;text-align:right">用户名:&nbsp;</span>
					<span style="float:left;width:45%;text-align:left">
						<font color="red">* </font><input type="text" name="name" style="border:1px solid #cccccc;width:180px" onblur="checkuser(this.value)">
					</span>
					<span id="checkuser" style="float:right;width:30%;text-align:left"></span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin:5px auto;">
					<span style="float:left;width:25%;text-align:right">密　码:&nbsp;</span>
					<span style="float:left;width:45%;text-align:left"> 
						<font color="red">* </font><input type="password" id="npass" name="pass" style="border:1px solid #cccccc;width:180px" onblur="checkpass(this.value)" />
					</span>
					<span id="checkpass" style="float:right;width:30%;text-align:left"></span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin:5px auto;">
					<span style="float:left;width:25%;text-align:right">确认密码:&nbsp;</span>
					<span style="float:left;width:45%;text-align:left"> 
						<font color="red">* </font><input id="vepass" type="password" name="vpass" style="border:1px solid #cccccc;width:180px" onblur="checkvepass()" />
					</span>
					<span id="checkvpass" style="float:right;width:30%;text-align:left"></span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin:5px auto;">
					<span style="float:left;width:25%;text-align:right">电子邮箱:&nbsp;</span>
					<span style="float:left;width:45%;text-align:left"> 
						<font color="red">* </font><input type="text" name="email" style="border:1px solid #cccccc;width:180px" onblur="checkemail(this.value)">
					</span>
					<span id="checkemail" style="float:right;width:30%;text-align:left"></span>
				</div>
				<div class="nav"></div>
				<div class="line_nav" style="width:90%;margin:0 auto"></div>
				<div class="nav"></div>
				<div style="margin-top:30px;">
					<input type="submit" class="pn" value="注册" />&nbsp;&nbsp;&nbsp;&nbsp;
					<button class="pn" onclick="show('reg_send','none');show('bottom','none')">取消</button>
				</div>
				</form>
				<div class="nav"></div>
			</div>
		</div>
		<div class="close"><a href="javascript:void(0);" onclick="show('reg_send','none');show('bottom','none')"></a></div>
	</div>