<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>新闻管理</a> >> <font class=\"Cf60\">查看新闻</font>");
	}
</script>
<div class="border main">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <thead>
            <tr>
				<th>选择</th>
				<th>编号</th>
                <th>标题</th>
                <th>添加时间</th>
                <th>作者</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <{section name='ls' loop=$data }>
            <tr <{if $data[ls].status eq 1}>class="plan_start"<{elseif $data[ls].status eq 2}>class="finish"<{/if}>>
				<td><input type='checkbox' name='select[]' value='<{$data[ls].id}>' /></td>
				<td><{$data[ls].id}></td>
                <td><a href="<{$root}>/index.php/news/info/nid/<{$data[ls].id}>" target='_black'><{$data[ls].title|truncate:20:'...'}></a></td>
                <td><{$data[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
                <td><a href="<{$root}>/space.php/index/index/id/<{$data[ls].uid}>" target='_black'><{$data[ls].author}></a></td>
				<td>【<a href='<{$url}>/mod/id/<{$data[ls].id}>'>修改</a>】【<a href='<{$url}>/del/id/<{$data[ls].id}>'>删除</a>】</td>
            </tr>
            <{/section}>
        </tbody>

        <tfoot>
			<tr>
				<td colspan=3 align=left>
					<a onclick="check_all()" href='javascript:void(0);'>全选</a>
					<a onclick="check_versa()" href='javascript:void(0);'>反选</a>
					<a onclick="check_cancel()" href='javascript:void(0);'>全不选</a>
					<a onclick="delete_checked()"href="javascript:void(0);">删除选中</a>
				</td>
				<td colspan=5>
					<{$fpage}>
				</td>
			</tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">partition();mouse();</script>
<{include file='public/footer.tpl'}>
