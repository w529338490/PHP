<{include file='public/header.tpl'}>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> 网站配置 >> <font class=\"Cf60\">论坛设置</font>");
	}
</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
	<div class="border main">
		<form action="<{$url}>/mod" method="post" enctype="multipart/form-data"/>
		<table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
			<input type="hidden" name="type" value=2 />
			<thead>
				<tr>
					<th colspan="4">BBS设置</th>
				</tr>
			</thead>
			
			<tr>
				<td>主题</td>
				<td><input type="text" name="B_SUBJECTPZ" value="<{$data.B_SUBJECTPZ}>"/> 条/页</td>
				<td>帖子</td>
				<td><input type="text" name="B_COMMENTPZ" value="<{$data.B_COMMENTPZ}>" /> 条/页</td>
			</tr>
			<tr>
				<td>回复</td>
				<td><input type="text" name="B_HOT_NUM" value="<{$data.B_HOT_NUM}>"/> 算火热</td>
				<td>发表主题间隔</td>
				<td><input type="text" name="PUBLISH_INTERVAL_SUBJECT" value="<{$data.PUBLISH_INTERVAL_SUBJECT}>" /> 秒</td>
			</tr>
			<tr>
				<td>发表帖子间隔</td>
				<td><input type="text" name="PUBLISH_INTERVAL_COMMENT" value="<{$data.PUBLISH_INTERVAL_COMMENT}>"/> 秒</td>
				<td>新闻</td>
				<td><input type="text" name="B_NEWS_LIST_NUM" value="<{$data.B_NEWS_LIST_NUM}>" /> 条/页</td>
			</tr>
			<tr>
				<td>公告</td>
				<td><input type="text" name="B_NOTICE_LIST_NUM" value="<{$data.B_NOTICE_LIST_NUM}>"/> 条/页</td>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<th>积分设置</th>
				<th colspan=3>每个/条奖励的积分数</th>
			</tr>
			<tr>
				<td>发表主题</td>
				<td><input type="text" name="B_SUBJECT_REWARD" value="<{$data.B_SUBJECT_REWARD}>" />
				<td>发表帖子</td>
				<td><input type="text" name="B_COMMENT" value="<{$data.B_COMMENT}>" />
			</tr>
			<tr>
				<td>置顶主题</td>
				<td><input type="text" name="B_SUBJECT_TOP" value="<{$data.B_SUBJECT_TOP}>" />
				<td>精华主题</td>
				<td><input type="text" name="B_SUBJECT_ESS" value="<{$data.B_SUBJECT_ESS}>" />
			</tr>
			<tr>
				<td>推荐主题</td>
				<td><input type="text" name="B_SUBJECT_RECOM" value="<{$data.B_SUBJECT_RECOM}>" /></td>
				<td>会员登录</td>
				<td><input type="text" name="LOGINREWARD" value="<{$data.LOGINREWARD}>" /></td>
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
