<div id="frsend" class="send">
	<div class="column" style="width:400px;">
		<div class="column_title">发送添加好友请求</div>
		<div class="column_content">
			<form action="<{$app}>/friend/send" method="post">
				<table width="100%">
					<tr>
						<td style="color:#444" height="50px" width="150px" align="center">发送给:</td>
						<td align="left">
							<input type="hidden" name="fid" id="fid" />
							<input type="hidden" name="uid" value="<{nocache}><{$smarty.session.user_info.id}><{/nocache}>" />
							<input type="text" name="name" size="25" id="frs_name" readonly />
						</td>
					</tr>
					<tr>
						<td style="color:#444" height="50px" width="150px">请求验证:</td>
						<td align="left"><textarea cols="30" rows="5" name="content"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td align="left" height="50px"><input type="submit" value="确认发送" class="pn"></td>
					</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="close"><a href="javascript:void(0);" onclick="show('frsend','none');show('bottom','none')"></a></div>
	</div>
	<script type="text/javascript">
		function getfrValue(){
			document.getElementById("frs_name").value=document.getElementById("friend_name").childNodes[0].nodeValue;
			document.getElementById("fid").value=document.getElementById("friend_uid").childNodes[0].nodeValue;
		}
	</script>