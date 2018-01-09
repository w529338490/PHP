<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> 网站配置 >> <font class=\"Cf60\">空间设置</font>");
	}
</script>
	<div class="border main">
		<form action="<{$url}>/mod" method="post" enctype="multipart/form-data"/>
		<table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
			<input type="hidden" name="type" value=3 />
			<tr>
				<th colspan=4>空间显示设置</th>
			</tr>
			<tr>
				<td>说说</td>
				<td><input type="text" name="S_SPEAKPZ" value="<{$data.S_SPEAKPZ}>"/> 条/页</td>
				<td>首页日志</td>
				<td><input type="text" name="S_LOG_INDEX" value="<{$data.S_LOG_INDEX}>" /> 个</td>
			</tr>
			<tr>
				<td>首页留言</td>
				<td><input type="text" name="S_MESS_INDEX" value="<{$data.S_MESS_INDEX}>"/> 条</td>
				<td>首页好友</td>
				<td><input type="text" name="S_FRIEND_INDEX" value="<{$data.S_FRIEND_INDEX}>" /> 条</td>
			</tr>
			<tr>
				<td>首页访客</td>
				<td><input type="text" name="S_GUEST_INDEX" value="<{$data.S_GUEST_INDEX}>"/> 个</td>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr>
				<th>积分设置</th>
				<th colspan=3>每个/条奖励的积分数</th>
			</tr>
			<tr>
				<td>发表说说</td>
				<td><input type="text" name="S_SPEAK_REWARD" value="<{$data.S_SPEAK_REWARD}>" />
				<td>发布日志</td>
				<td><input type="text" name="S_LOG_REWARD" value="<{$data.S_LOG_REWARD}>" />
			</tr>
			<tr>
				<td>日志回复</td>
				<td><input type="text" name="S_LOGC_REWARD" value="<{$data.S_LOGC_REWARD}>" />
				<td>创建相册</td>
				<td><input type="text" name="S_PHOALBUM_REWARD" value="<{$data.S_PHOALBUM_REWARD}>" />
			</tr>
			<tr>
				<td>留言</td>
				<td><input type="text" name="S_MESS_REWARD" value="<{$data.S_MESS_REWARD}>" />
				<td>修改头像</td>
				<td><input type="text" name="S_MODFACE_REWARD" value="<{$data.S_MODFACE_REWARD}>" />
			</tr>
			<tr>
				<td colspan=4 align=center>
					<input type="submit" name="submit" value="修改" />
					<input type="reset" name="reset" value="重置" />
				</td>
			</tr>
		</table>
		</form>
	</div>
<{include file='public/footer.tpl'}>
