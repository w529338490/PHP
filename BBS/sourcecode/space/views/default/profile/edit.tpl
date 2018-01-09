<{include file="public/header.tpl"}>
<script type="text/javascript">
	function city_select(obj,name){
		var province_id=obj.value;
		Ajax().post("<{$url}>/address",{bpid:province_id},function(data){
			obj.nextSibling.nextSibling.innerHTML='<select name='+name+'>'+data+'</select>';
		});
	}
</script>
<div class="nav"></div>
<div id="content">
	<div class="speak_left">
		<div class="column">
			<div class="column_title">更新个人资料<span><img src="<{$res}>/images/wall.gif" /><a href="<{$url}>/edit_pass/uid/<{nocache}><{$smarty.session.user_info.id}><{/nocache}>">修改密码</a></span></div>
			<div class="column_content">
				<form action="<{$url}>/doedit/" method="post" name="editform" onsubmit="javascript:return false;" >
					<table width="100%">
						<tr>
							<td style="color:#444" height="50px" width="150px" align="center">用户名</td>
							<td align="left">
								<input type="text" name="username" size="20" readonly style="border:0;color:#666" value="<{nocache}><{$user_info.name}><{/nocache}>" />
								<input type="hidden" name="id" value="<{nocache}><{$smarty.session.user_info.id}><{/nocache}>" />
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px" align="center">真实姓名</td>
							<td align="left">
								<input id="tname" type="text" name="true_name" size="20" style="border:1px solid #bbbbbb" value="<{nocache}><{$user_info.true_name}><{/nocache}>" />
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px" align="center">电子邮箱</td>
							<td align="left">
								<input id="tname" type="text" name="email" size="20" style="border:1px solid #bbbbbb" value="<{nocache}><{$user_info.email}><{/nocache}>" />
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px">出生日期</td>
							<td align="left">
								<{nocache}><{select_date is_time=true id="birth_time" name="birthday" value=$user_info.birthday|chinadate:"Y-m-d" }><{/nocache}>
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px">出生城市</td>
							<td align="left">
							<select name="birth_province" onchange="city_select(this,'birth_city')" style="border:1px solid #bbbbbb">
								<{nocache}><{html_options options=$province selected=$birth_province_id}><{/nocache}>
							</select>
							<span>
								<select name="birth_city" style="border:1px solid #bbbbbb">
									<{nocache}><{html_options options=$birth_city_all selected=$birth_city_id}><{/nocache}>
								</select>
							</span>
							</td>
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px">居住城市</td>
							<td align="left">
							<select name="live_province" onchange="city_select(this,'live_city')" style="border:1px solid #bbbbbb">
								<{nocache}><{html_options options=$province selected=$live_province_id}><{/nocache}>
							</select>
							<span>
								<select name="live_city" style="border:1px solid #bbbbbb">
									<{nocache}><{html_options options=$live_city_all selected=$live_city_id}><{/nocache}>
								</select>
							</span>
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px">性别</td>
							<td align="left">
							<select name="sex" style="border:1px solid #bbbbbb">
								<{nocache}><{html_options options=$sex_all selected=$sex}><{/nocache}>
							</select>
								</td>
						</tr>
						<tr>
							<td style="color:#444" height="50px" width="150px">婚姻状况</td>
							<td align="left">
							<select name="marriage" style="border:1px solid #bbbbbb">
								<{nocache}><{html_options options=$marry_all selected=$marry}><{/nocache}>
							</select>
								</td>
						</tr>
						<tr>
							<td style="color:#444" height="80px" width="150px">用户签名</td>
							<td align="left">
								<textarea cols="45" rows="3" name="sign" style="border:1px solid #bbbbbb"><{nocache}><{$user_info.sign}><{/nocache}></textarea>
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="80px" width="150px">兴趣爱好</td>
							<td align="left">
								<textarea cols="45" rows="3" name="hobby" style="border:1px solid #bbbbbb"><{nocache}><{$user_info.hobby}><{/nocache}></textarea>
							</td>
						</tr>
						<tr>
							<td style="color:#444" height="80px" width="150px">交友目的</td>
							<td align="left">
								<textarea cols="45" rows="3" name="pal_aim" style="border:1px solid #bbbbbb"><{nocache}><{$user_info.pal_aim}><{/nocache}></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td align="left" height="50px"><button class="pn" onclick="editform.submit()">确认修改</button>
							<button class="pn" onclick="window.location.href='<{$url}>/edit_pass/uid/<{nocache}><{$smarty.session.user_info.id}><{/nocache}>'">下一步</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<{include file="public/right.tpl"}>
</div>
<{include file="public/footer.tpl"}>