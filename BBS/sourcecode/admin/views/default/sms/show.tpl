<{include file='public/header.tpl'}>
<script>var $url='<{$url}>';</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$app}>/search'>空间管理</a> >> <font class=\"Cf60\">站内信</font>");
	}
</script>
<div id="data">
	<div style="" class="notice_album success PL60"></div>
    <table width="99%" border="0" align="center"  cellpadding="5" cellspacing="1">
		<form action="<{$url}>/del" method="post" >
		<input type="hidden" name="uid" value="<{$smarty.get.id}>"/>
        <tbody>
			<tr><th colspan=6>发件箱</th></tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>编号</td>
				<td>收件人</td>
				<td>内容</td>
				<td>发送时间</td>
				<td>发送时IP</td>
			</tr>
			
			
			<{section name="ls" loop=$send}>
				<tr>
					<td><input type="checkbox" name="del[]" value="<{$send[ls].id}>" /></td>
					<td><{$send[ls].id}></td>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$send[ls].dst_id}>"><{$send[ls].dst_name}></a></td>
					<td width=300><{$send[ls].content}></td>
					<td><{$send[ls].ptime}></td>
					<td><{$send[ls].ip}></td>
				</tr>
			<{sectionelse}>
				<tr>
					<td colspan=6>没有发送任何邮件！</td>
				</tr>
			<{/section}>
			
			<tr><th colspan=6>收件箱</th></tr>
			<tr>
				<td>&nbsp;</td>
				<td>编号</td>
				<td>发件人</td>
				<td>内容</td>
				<td>接收时间</td>
				<td>发送者IP</td>
			</tr>
			
			<{section name="ls" loop=$receive}>
				<tr>
					<td><input type="checkbox" name="del[]" value="<{$receive[ls].id}>" /></td>
					<td><{$receive[ls].id}></td>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$receive[ls].dst_id}>"><{$receive[ls].src_name}></a></td>
					<td><{$receive[ls].content}></td>
					<td><{$receive[ls].ptime}></td>
					<td><{$receive[ls].ip}></td>
				</tr>
			<{sectionelse}>
				<tr>
					<td colspan=6>没有收到任何邮件！</td>
				</tr>
			<{/section}>
        </tbody>
        <tfoot>
			<tr>
				<td colspan='6' align="center">
					<a href="javascript:void(0)" onclick="check_all()">全选</a>
					<a href="javascript:void(0)" onclick="check_versa()">反选</a>
					<a href="javascript:void(0)" onclick="check_cancel()">全不选</a>
					<!--a href="javascript:void(0)" onclick="$('#my_form').submit()">删除选中</a-->
					<input type="submit" value="删除选中" />
				</td>
			</tr>
        </tfoot>
		</form>
    </table>
</div>
<script type="text/javascript">partition();mouse();</script>
<{include file='public/footer.tpl'}>
