<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$app}>/search'>空间管理</a> >> <font class=\"Cf60\">查看相册</font>");
	}
</script>
<div class="border main">
	<div style="" class="notice_album success PL60">删除成功！</div>
	<form action="<{$url}>/condition" method="post">
    <table width="99%" border="0" align="center"  cellpadding="5 	" cellspacing="1">
		<input type="hidden" name="operate" value="<{$smarty.get.operate}>" />
        <thead>
            <tr>
				<th>用户名</th>
				<th>相册名称</th>
				<th>相册封面</th>
				<th>更新时间</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
			<{section name="ls" loop=$data}>
				<tr>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$data[ls].uid}>" target="_blank"><{$data[ls].username}></a></td>
					<td><a href="<{$root}>/space.php/album/index/uid/<{$data[ls].uid}>" target="_blank"><{$data[ls].name}></a></td>
					<td><a href="<{$root}>/space.php/album/index/uid/<{$data[ls].uid}>" target="_blank">
						<img width="60" src="<{$public}>/uploads/album/th_<{$data[ls].cover_path}>"/></a>
					</td>
					<td><{$data[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
					<td>
						【<a href='<{$root}>/space.php/album/index/uid/<{$data[ls].uid}>' target="_blank">查看</a>】【<a href='javascript:void(0);' onclick='ajax_del(this,"<{$url}>/del_album/id/<{$data[ls].id}>")'>删除</a>】
					</td>
				</tr>
			<{sectionelse}>
				<tr>
					<td colspan="5">没有符合条件的相册！</td>
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
