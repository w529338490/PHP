<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<div id="data">
	<form action="<{$url}>/condition" method="post">
    <table width="99%" border="0" align="center"  cellpadding="5 	" cellspacing="1">
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
					<td><{$data[ls].id}></td>
					<td><a href="<{$root}>/space.php/album/index/uid/<{$data[ls].uid}>" target="_blank"><{$data[ls].username}><{$data[ls].name}></a></td>
					<td width="400"><{$data[ls].content|html_decode}></td>
					<td><{$data[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
					<td><{$data[ls].ip|ip}></td>
					<td>
						【<a href='<{$root}>/space.php/speak/index/uid/<{$data[ls].uid}>' target="_blank">查看</a>】【<a href='javascript:void(0);' onclick='ajax_del(this,"<{$url}>/del_speak/id/<{$data[ls].id}>")'>删除</a>】
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
