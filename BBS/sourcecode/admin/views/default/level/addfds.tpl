<div id="add_level" class="send">
	<div class="column" style="width:400px;">
		<div class="column_title">发送短信息</div>
		<div class="column_content">
			<form action="<{$app}>/sms/dosend/uid/<{if $smarty.session.user_info.id}><{$smarty.session.user_info.id}><{else}><{$smarty.get.uid}><{/if}>" method="post">
				<table>
					<tr>
						<td style="color:#444" height="50px" width="150px" align="center">发送给:</td>
						<td align="left">
							<input type="text" id="in_name" name="name" size="25" readonly />
							<input type="hidden" name="dst_id" id="dst_id" />
							<input type="hidden" name="src_id" value="<{$smarty.session.user_info.id}>" />
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
		<div id="close"><a href="javascript:void(0);" onclick="$('#add_level').hide();$('#bottom').hide();"></a></div>
	</div>
<div id="bg" class="bottom" style="height:100%;"></div>

<style>
.send{
	position:absolute;
	top:50%;
	left:50%;
	display:none;
	background-color:#ddd;
	z-index:2;
	margin-left:-200px;
	margin-top:-125px;
	padding:5px;
}
.bottom{
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	display:none;
	background-color:#000;
	z-index:1;
	opacity:0.5;
	-moz-opacity:0.5;
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);
}
#close a{
	position:absolute;
	top:10px;
	right:10px;
	width:20px;
	height:20px;
	background:#F8F8F8 url("../images/cls.gif") repeat-x 0 0;
}
#close a:hover{
	position:absolute;
	top:10px;
	right:10px;
	width:20px;
	height:20px;
	background:#F8F8F8 url("../images/cls.gif") repeat-x 0 -20px;
}
</style>	