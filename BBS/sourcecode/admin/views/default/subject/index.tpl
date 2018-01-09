<{include file='public/header.tpl'}>
<script>var address='<{$url}>';</script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>主题管理</a> >> <font class=\"Cf60\">查看主题</font>");
	}
</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>

<div class="border main">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <thead>
			<tr>
				<form action="<{$url}>/search" method="post">
				<th colspan=8>搜索：
					<input type="text" value="请输入搜索关键字" class="default_click" size=13 name="title" />
					时间：
					<select name="ptime">
						<option value=0>不限</option>
						<option value=1>今天</option>
						<option value=2>本周</option>
						<option value=3>本月</option>
					</select>
					分区/版块：
					<select onchange="select_board(this.value)">
						<option value="0">请选择</option>
						<{section name="b" loop=$board}>
							<option value="<{$board[b].id}>"><{$board[b].name}></option>
						<{/section}>
					</select>
					<select name='bid' id='board'>
						<option value="0">请选择</option>
					</select>
					作者：
					<input type="text" name="name" size=8/>
					<input type="submit" name="search" value="搜索" />
				</th>
				</form>
			</tr>
            <tr>
				<th>&nbsp;</th>
                <th>标题</th>
                <th>版块</th>
                <th>作者</th>
                <th>回复/查看</th>
                <th>发表时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <{section name='ls' loop=$subject }>
            <tr>
				<td><input type="checkbox" name="select[]" value="<{$subject[ls].id}>" /></td>
                <td>
					<a href="<{$root}>/index.php/subject/info/sid/<{$subject[ls].id}>" target="_black" >
						<{$subject[ls].title|truncate:15:'...'}>
					</a>
				</td>
                <td>
					<a href="<{$root}>/index.php/subject/index/bid/<{$subject[ls].bid}>" target='_black'>
						<{$subject[ls].board_name|truncate:15:'...'}>
					</a>
				</td>
                <td>
					<a href="<{$root}>/space.php/index/index/uid/<{$subject[ls].uid}>" target='_black'>
						<{$subject[ls].user_name|truncate:8}>
					</a>
				</td>
                <td><font><{$subject[ls].comment_total}></font> / <{$subject[ls].click_num}></td>
                <td><{$subject[ls].ptime|chinadate:"Y-m-d H:i:s"}></td>
				<td>【<a href='<{$root}>/index.php/subject/editor/sid/<{$subject[ls].id}>' target="_black">修改</a>】【<a href="javascript:void(0);" onclick="confirm_info('<{$url}>/del/id/<{$subject[ls].id}>','确认删除该主题和所有回复？')">删除</a>】</td>
            </tr>
            <{/section}>
        </tbody>
        <tfoot>
			<tr>
				<td colspan=4 align=left>
					<a onclick="check_all()" href='javascript:void(0);'>全选</a>
					<a href='javascript:void(0);' onclick="check_versa()">反选</a>
					<a href='javascript:void(0);' onclick="check_cancel()">全不选</a>
					<a href="javascript:void(0);" onclick="delete_checked('<{$url}>')">删除选中</a>
					
					<{if $smarty.get.ptype eq "0"}>
						<a href="javascript:void(0);" onclick="hidden_cancel('<{$url}>')">取消选中屏敞</a>
					<{else if}>
						<a href="javascript:void(0);" onclick="hidden_checked('<{$url}>')">屏敞选中</a>
						<a href="<{$url}>/search/ptype/0">查看屏敞主题</a>
					<{/if}>
					
				</td>
				<td colspan=5 align=right><{$fpage}></td>
			</tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">default_click();partition();mouse();</script>
<{include file='public/footer.tpl'}>
