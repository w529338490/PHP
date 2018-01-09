<{include file='public/header.tpl'}>
<{include file='public/ck.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>新闻管理</a> >> <font class=\"Cf60\">修改新闻</font>");
	}
	function check_null(){
		var status = true;
		var title=$("input[name='title']");
		var content=$("textarea[name='content']");
		var info="";
		if($(title).val()==""){
			info="新闻标题不能为空！";
			status = false;
		}
		if(!status){
			$(".info")
					.removeClass('notice')
					.removeClass('success')
					.addClass('error')
					.html(info);
		}
		return status;
	}
</script>
<div class="border main">
	<form action="<{$url}>/modify" method="post" onsubmit="return check_null()">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <tbody>
            <input type="hidden" name="id" value="<{$data.id}>" />
			<input type="hidden" name="ptime" value="<{$data.ptime}>" />
            <tr>
				<td width=20%>标题</td>
				<td><input type='text' name='title' value="<{$data.title}>" /></td>
            </tr>
			<tr>
				<td colspan=2><textarea name='content'><{$data.content}></textarea>
				</td>
            </tr>
			<tr>
				<td colspan=2 align="center">
					<input type="submit" name="submit" value="修改" />
					<input type="reset" name="reset" value="重置" />
				</td>
			</tr>
        </tbody>
    </table>
	</form>
</div>
<{include file='public/footer.tpl'}>
