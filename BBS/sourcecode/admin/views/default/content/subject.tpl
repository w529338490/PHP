<{include file='public/header.tpl'}>
<div id="subject">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <thead>
            <tr>
                <th>标题</th>
                <th>版块</th>
                <th>作者</th>
                <th>回复</th>
                <th>点击数</th>
                <th>发表时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <{section name='ls' loop=$subject }>
            <tr>
                <td width=150><a href="<{$root}>/index/detail/detail/id/<{$subject[ls].id}>" target='_top'><{$subject[ls].title|truncate:20:'...'}></a></td>
                <td width=100><a href="<{$root}>/index/list/lists/id/<{$subject[ls].bid}>" target='_top'><{$subject[ls].board_name}></a></td>
                <td width=70><a href="<{$root}>/index/zone/index/id/<{$subject[ls].uid}>" target='_top'><{$subject[ls].user_name}></a></td>
                <td width=30><{$subject[ls].comment_total}></td>
                <td width=40><{$subject[ls].click_num}></td>
                <td width=160><{$subject[ls].ptime|my_date_format:"Y-m-d H:i:s"}></td>
            </tr>
            <{/section}>
        </tbody>

        <tfoot>

        </tfoot>
    </table>
</div>
<{include file='public/footer.tpl'}>
