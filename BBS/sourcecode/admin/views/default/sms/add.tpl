<{include file='public/header.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<div id="notice">
	<form action="<{$url}>/addition" method="post">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <thead>
            <tr>
				<th colspan="2">发送站内信</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
				<td>收件人：</td>
				<td><input type='text' name='dst_ids' maxlength =100 size=40 value="<{$smarty.get.id}>"/> ID号多个用 "," 号隔开 全部可以用 "*" 代替</td>
            </tr>
			<tr>
				<td colspan=2>
					<textarea name="content" rows="3" cols="100"></textarea>
				</td>
            </tr>
			<tr>
				<td colspan=2 align="center">
					<input type="submit" name="submit" value="添加" />
					<input type="reset" name="reset" value="清空" />
				</td>
			</tr>
        </tbody>
    </table>
	</form>
</div>
<{include file='public/footer.tpl'}>
