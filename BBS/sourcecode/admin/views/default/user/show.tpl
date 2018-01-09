<{include file='public/header.tpl'}>
<script>var $url='<{$url}>';var face_dir="<{$public}>/uploads/user/s_";</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script type="text/javascript">
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>用户管理</a> >> <font class=\"Cf60\">查看用户</font>");
	}
</script>
<style>
	input[type='text'],input[type='password']{
		border:none;
		width:97%;
		background:none;
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
		<thead>
			<tr>
				<th colspan=4>选择用户：
					<{section name="ls" loop=$list }>
						<a <{if $smarty.get.uid }> <{if $smarty.get.uid eq $list[ls].id}> class="m_click" <{/if}><{else}> <{if $smarty.section.ls.first}> class="m_click" <{/if}><{/if}> href="javascript:void(0)" onclick="ajax_user(<{$list[ls].id}>);$(this).siblings().removeClass('m_click').end().addClass('m_click');" onfocus="blur()"><{$list[ls].name}></a>
						<{sectionelse}>
						<font class="Cf60">没有符合条件的用户！</font><a href="<{$url}>/index">返回重新搜索</a>
					<{/section}>
				</th>
			</tr>
		</thead>
		<{if $list ne "" }>
		<form action="<{$url}>/mod" method="post">
		<input type="hidden" name="deliver_condition" value="<{$deliver_condition}>" />
        <tbody>
            <tr>
				<th width=15%>编号</th>
				<td><input type="text" name="id" readonly /></td>
				<th width=15%>用户名</th>
				<td><input type="text" name="name" readonly value='fdsa' /></td>
			</tr>
			<tr>
				<th>真实姓名</th>
				<td><input class="m_over" type="text" name="true_name"  /></td>
				<th>姓别</th>
				<td>
					<input type="radio" name="sex" value="0" />女
					<input type="radio" name="sex" value="1" />男
				</td>
			</tr>
			<tr>
				<th>Email</th>
				<td><input type="text" name="email" value="" /></td>
				<th>权限</th>
				<td>
					<input type="radio" name="stand" value="3" disabled />普通用户
					<input type="radio" name="stand" value="2" disabled />版主
					<input type="radio" name="stand" value="1" disabled />管理员
				</td>
			</tr>
			<tr>
				<th>生日</th>
				<td><input type="text" name="birthday" value='0000-00-00' /></td>
				<th>出生地</th>
				<td>
					<select name="birth_province" onchange="change_city(this);">
						<{section name="bls" loop=$province}>
							<option value="<{$province[bls].id}>"><{$province[bls].name}></option>
						<{/section}>
					</select>
					<select name="brith_city">
					
					</select>
				</td>
			</tr>
			<tr>
				<th>居住地</th>
				<td>
					<select name="live_province" onchange="change_city(this);">
						<{section name="lls" loop=$province}>
							<option value="<{$province[lls].id}>"><{$province[lls].name}></option>
						<{/section}>
					</select>
					<select name="live_city">
					
					</select>
				</td>
				<th>爱好</th>
				<td><input type="text" name="hobby" value="" /></td>
			</tr>
			<tr>
				<th>是否已婚</th>
				<td>
					<input type="radio" name="marriage" value="0" />保密
					<input type="radio" name="marriage" value="1" />未婚
					<input type="radio" name="marriage" value="2" />已婚
				</td>
				<th>最后登录时间</th>
				<td><input type="text" readonly name="last_time" value="" /></td>
			</tr>
			<tr>
				<th>最后登录IP</th>
				<td><input type="text" name="last_ip" readonly value="" /></td>
				<th>积分</th>
				<td><input type="text" name="grade_num" value="" /></td>
			</tr>
			<tr>
				<th>头像</th>
				<td><img name="face_path" /></td>
				<th>个性签名</th>
				<td><input type="text" name="sign" value="" /></td>
			</tr>
			<tr>
				<th>状态</th>
				<td>
					<input type="radio" name="state" value="0"/>禁用
					<input type="radio" name="state" value="1" />正常
				</td>
				<th>密码</th>
				<td><input type="password" maxlength=16 name="pass" value="******" /></td>
			</tr>
		
        </tbody>
        <tfoot>
			<tr>
				<td colspan='4' align="center">
					<input type="submit" value="修改" />
				</td>
			</tr>
        </tfoot>
		</form>
		<{/if}>
    </table>
</div>
<script type="text/javascript">partition();mouse();<{if $smarty.get.uid }>ajax_user("<{$smarty.get.uid}>");<{else}>ajax_user("<{$list[0].id}>");<{/if}></script>
<script>
	$("tbody td").mouseover(function(){
		$(":text").removeClass('m_over');
		$(":password").removeClass('m_over');
		$(this).children(":text").addClass('m_over').focus();
		$(this).children(":password").addClass('m_over').focus();
	}).click(function(){
		
		$(this).children(":text").select();
	});
	$("tbody td :password").click(function(){
		if($(this).val()=='******'){
			$(this).val('');
		}
	}).mouseout(function(){
		if($(this).val()==''){
			$(this).val('******');
		}
	});
</script>
<{include file='public/footer.tpl'}>
