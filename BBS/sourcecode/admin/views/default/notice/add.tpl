<{include file='public/header.tpl'}>
<{include file='public/ck.tpl'}>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$url}>/index'>公告管理</a> >> <font class=\"Cf60\">添加公告</font>");
	}
	function check_null(){
		var status = true;
		var title=$("input[name='title']");
		var content=$("textarea[name='content']");
		var info="";
		if($(title).val()=="" || $(title).val()==title[0].defaultValue){
			info="标题不能为空！";
			status = false;
		}else if($(content).val().length<10){
			info="公告内容不得少于10个字符！";
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
	<form name="notice" action="<{$url}>/addition" method="post" onsubmit="return check_null()">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
        <tbody>
            
            <tr>
				<td width=20%>标题</td>
				<td><input type='text' name='title' class="default_click" value="请输入标题" /></td>
            </tr>
			<tr>
				<td>开始时间</td>
				<td><{select_date name="start_time" id="start_time" value="$time" size=21 is_time=0}></td>
            </tr>
			<tr>
				<td>结束时间</td>
				<td><{select_date name="stop_time" id="stop_time" value="$time" size=21 is_time=0}></td>
            </tr>
			<tr>
				<td colspan=2>
					<textarea name="content"></textarea>
				</td>
            </tr>
			<tr>
				<td colspan=2 align="center">
					<input type="submit" name="submit" class="button_a border" value="添加" />
					<input type="reset" name="reset" class="button_a border" value="清空" />
				</td>
			</tr>
        </tbody>
    </table>
	</form>
</div>
<script>default_click();</script>
<{include file='public/footer.tpl'}>
