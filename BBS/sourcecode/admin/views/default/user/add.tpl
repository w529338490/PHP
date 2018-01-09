<{include file='public/header.tpl'}>
<script>var $url='<{$url}>';var face_dir="<{$public}>/uploads/user/s_";</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script type="text/javascript">
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>用户管理</a> >> <font class=\"Cf60\">添加用户</font>");
	}
</script>
<style>
	input[type='text'],input[type='password']{
		padding:3px;
	}
	.m_over{
		background:#fff !important;
	}
	.m_click{
		color:#f60;
	}
</style>
<div class="border main">
    <table width="99%" border="0" align="center"  cellpadding="5" cellspacing="1">
		<form action="<{$url}>/addition" method="post">
        <tbody>
            <tr>
				<th width=150>用户名</th>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<th>真实姓名</th>
				<td><input type="text" name="true_name"  /></td>
			</tr>
			<tr>
				<th>姓别</th>
				<td>
					<input type="radio" name="sex" value="1" checked />男
					<input type="radio" name="sex" value="0"/>女
				</td>
			</tr>
			<tr>
				<th>Email</th>
				<td><input type="text" name="email" value="" /></td>
			</tr>
			<tr>
				<th>权限</th>
				<td>
					<input type="radio" name="stand" value="3" checked />普通用户
					<input type="radio" name="stand" value="2" />版主
					<input type="radio" name="stand" value="1" />管理员
				</td>
			</tr>
			<tr>
				<th>密码</th>
				<td><input type="password" maxlength=16 name="pass"/></td>
			</tr>
		
        </tbody>
        <tfoot>
			<tr>
				<td colspan='4' align="center">
					<input type="submit" name="submit" value="添加" />
					<input type="reset" name="reset" value="重填" />
				</td>
			</tr>
        </tfoot>
		</form>
    </table>
	</form>
</div>
<script type="text/javascript">partition();mouse();</script>
<{include file='public/footer.tpl'}>
