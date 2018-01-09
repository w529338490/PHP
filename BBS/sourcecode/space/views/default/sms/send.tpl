<div id="pmsend" class="send">
	<div class="column" style="width:400px;">
		<div class="column_title">发送短信息</div>
		<div class="column_content">
			<form action="<{$app}>/sms/dosend/uid/<{nocache}><{if $smarty.session.user_info.id}><{$smarty.session.user_info.id}><{else}><{$smarty.get.uid}><{/if}><{/nocache}>" method="post">
				<table>
					<tr>
						<td style="color:#444" height="50px" width="150px" align="center">发送给:</td>
						<td align="left">
							<input type="text" id="in_name" name="name" size="25" readonly />
							<input type="hidden" name="dst_id" id="dst_id" />
							<input type="hidden" name="src_id" value="<{nocache}><{$smarty.session.user_info.id}><{/nocache}>" />
						</td>
					</tr>
					<tr>
						<td style="color:#444" height="50px" width="150px">信息内容:</td>
						<td align="left"><textarea cols="30" rows="5" name="content"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td align="left" height="60px"><input type="submit" value="确认发送" class="pn"></td>
					</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="close"><a href="javascript:void(0);" onclick="show('pmsend','none');show('bottom','none')"></a></div>
	</div>
<script type="text/javascript">
	function getValue(){
		document.getElementById("in_name").value=document.getElementById("send_name").childNodes[0].nodeValue;
		document.getElementById("dst_id").value=document.getElementById("send_uid").childNodes[0].nodeValue;
	}
</script>