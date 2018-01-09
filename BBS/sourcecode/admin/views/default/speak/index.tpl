<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$app}>/search'>空间管理</a> >> <font class=\"Cf60\">查看说说</font>");
	}
</script>
<div class="border main">
	<form action="<{$url}>/condition" method="post">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
		<input type="hidden" name="operate" value="<{$smarty.get.operate}>" />
        <thead>
            <tr>
				<th>编号</th>
				<th>用户名</th>
				<th>内容</th>
				<th>发表时间</th>
				<th>IP地址</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
			<{section name="ls" loop=$data}>
				<tr>
					<td width=5%><{$data[ls].id}></td>
					<td width=8%><a href="<{$root}>/space.php/album/index/uid/<{$data[ls].uid}>" target="_blank"><{$data[ls].username}><{$data[ls].name}></a></td>
					<td><{$data[ls].content|html_decode}></td>
					<td width=20%><{$data[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
					<td width=10%><{$data[ls].ip|ip}></td>
					<td width=15%>
						【<a href='<{$root}>/space.php/speak/index/uid/<{$data[ls].uid}>' target="_blank">查看</a>】【<a href='javascript:void(0);' onclick='ajax_del(this,"<{$url}>/del/id/<{$data[ls].id}>")'>删除</a>】
					</td>
				</tr>
			<{sectionelse}>
				<tr>
					<td colspan="6">没有符合条件的说说！</td>
				</tr>
			<{/section}>
        </tbody>
        <tfoot>
			
        </tfoot>
    </table>
	</form>
</div>
<script type="text/javascript">partition();mouse();</script>
<{include file='public/footer.tpl'}>
