<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script type="text/javascript">
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>公告管理</a> >> <font class=\"Cf60\">查看公告</font>");
	}
</script>
<div class="border main">
	<form action="<{$url}>/del" method="post" name="my_form">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <thead>
            <tr style='bakcground:red;'>
				<th>选择</th>
				<th>编号</th>
                <th>标题</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>用户</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
			
				<{section name='ls' loop=$data }>
				<tr <{if $data[ls].status eq 1}>class="plan_start"<{elseif $data[ls].status eq 2}>class="finish"<{/if}>>
					<td><input type='checkbox' name='select[]' value='<{$data[ls].id}>' /></td>
					<td><{$data[ls].id}></td>
					<td><a href="<{$root}>/index.php/notice/info/ncid/<{$data[ls].id}>" target='_blank'><{$data[ls].title|truncate:20:'...'}></a></td>
					<td><a href="<{$root}>/index.php/notice/info/ncid/<{$data[ls].id}>" target='_blank'><{$data[ls].start_time|chinadate:"Y-m-d H:i:s"}></a></td>
					<td><a href="<{$root}>/index.php/notice/info/ncid/<{$data[ls].id}>" target='_blank'><{$data[ls].stop_time|chinadate:"Y-m-d H:i:s"}></a></td>
					<td><a href="<{$root}>/space.php/index/index/id/<{$data[ls].uid}>" target='_blank'><{$data[ls].author}></td>
					<td>【<a href='<{$url}>/mod/id/<{$data[ls].id}>'>修改</a>】【<a href='<{$url}>/del/id/<{$data[ls].id}>'>删除</a>】</td>
				</tr>
				<{sectionelse}>
					<tr>
						<td colspan=7 class="Cf60">暂无公告！</td>
					</tr>
				<{/section}>
			
        </tbody>

        <tfoot>
			<tr>
				<td colspan=3 align=left>
					<a onclick="check_all()" href='javascript:void(0);'>全选</a>
					<a onclick="check_versa()" href='javascript:void(0);'>反选</a>
					<a onclick="check_cancel()" href='javascript:void(0);'>全不选</a>
					<input type="submit" class="button_a" onfocus="blur()" value="删除选中" />
				</td>
				<td colspan=6>
					<div class="f_l"><div  class="piece plan_start f_l"></div>未开始的</div>
					<div class="f_l"><div  class="piece finish f_l"></div>已结束的</div>
				</td>
			</tr>
        </tfoot>
    </table>
	</form>
</div>
<script type="text/javascript">mouse()</script>
<{include file='public/footer.tpl'}>
