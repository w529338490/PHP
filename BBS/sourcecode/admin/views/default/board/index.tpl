<{include file="public/header.tpl"}>
<{include file="board/assist.tpl"}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<div class="border main">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <tbody>
            <{section name="ls" loop=$data}>
				<tr class="odd">
					<td><{$data[ls].name}>　</td>
					<td width=20%>版主</td>
					<td width=30%>
						【<a href="javascript:void(0);" onclick="add_board(this,<{$data[ls].id}>)">添加版块</a>】
						【<a href="javascript:void(0);" onclick="mod_area(this,<{$data[ls].id}>,'<{$data[ls].name}>')">修改</a>】
						【<a href="<{$url}>/del/id/<{$data[ls].id}>" onclick="if(confirm('确认删除？')){return true;}else{return false;}">删除</a>】
					</td>
				</tr>
				<{section name="cls" loop=$data[ls].child_board }>
					<tr>
						<td>
							　　||--　<a href="<{$root}>/index.php/subject/index/bid/<{$data[ls].child_board[cls].id}>" target="_black"><{$data[ls].child_board[cls].name}></a>
						</td>
						<td width=20%>
							<a href="<{$root}>/space.php/index/index/uid/<{$data[ls].child_board[cls].master}>" target="_black">　　<{$data[ls].child_board[cls].master_name}></a>
						</td>
						<td width=30%>　　【<a href="javascript:void(0)" onclick="modify(this,'<{$data[ls].child_board[cls].id}>','<{$data[ls].child_board[cls].name}>','<{$data[ls].child_board[cls].master_name}>')">修改</a>】【<a href="<{$url}>/del/id/<{$data[ls].child_board[cls].id}>" onclick="if(confirm('确认删除？')){return true;}else{return false;}">删除版块</a>】</td>
					</tr>
				<{/section}>
			<{/section}>
        </tbody>
        <tfoot>
			<tr>
				<td colspan="3 " align=center>
					<a href="javascript:void(0);" onclick="add_area_html()">添加分区</a>
				</td>
			</tr>
        </tfoot>
    </table>
</div>
<{include file='public/footer.tpl'}>
