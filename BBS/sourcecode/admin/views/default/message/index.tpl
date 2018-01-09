<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$app}>/search'>空间管理</a> >> <font class=\"Cf60\">查看留言</font>");
	}
</script>
<div class="border main">
	<form action="<{$url}>/condition" method="post">
    <table width="99%" border="0" align="center"  cellpadding="5" cellspacing="1">
        <thead>
            <tr>
				<th width=5%>编号</th>
				<th width=8%>用户名</th>
				<th>内容</th>
				<th width=20%>留言时间</th>
				<th width=10%>留言人</th>
				<th width=15%>操作</th>
            </tr>
        </thead>
        <tbody>
			<{section name="ls" loop=$data}>
				<tr>
					<td><{$data[ls].id}></td>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$data[ls].uid}>" target="_blank"><{$data[ls].username}><{$data[ls].name}></a></td>
					<td width="400"><a href="<{$root}>/space.php/message/index/uid/<{$data[ls].mess_id}>" target="_blank"><{$data[ls].content|html_decode}></a></td>
					<td><{$data[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$data[ls].mess_id}>" target="_blank"><{$data[ls].messname}></a></td>
					<td>
						【<a href='<{$root}>/space.php/message/index/uid/<{$data[ls].uid}>' target="_blank">查看</a>】【<a href='javascript:void(0);' onclick='ajax_del(this,"<{$url}>/del/id/<{$data[ls].id}>")'>删除</a>】
					</td>
				</tr>
			<{sectionelse}>
				<tr>
					<td colspan="6" style="color:red;">该用户还没有任何留言！</td>
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
