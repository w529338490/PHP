<{include file='public/header.tpl'}>
<script>var $url='<{$url}>';</script>
<script type="text/javascript" src="<{$res}>/js/common.js" ></script>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <a href='<{$app}>/search'>空间管理</a> >> <font class=\"Cf60\">站内信</font>");
	}
</script>
<div class="border main">
    <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
		<thead>
			<tr>
				<th>用户名（<a style="color:#c90" href="<{$app}>/search">返回重新搜索</a>）</th>
				<th>发送 | 接收</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<{section name="ls" loop=$users}>
				<tr>
					<td><a href="<{$root}>/space.php/index/index/uid/<{$users[ls].id}>" target="_black"><{$users[ls].name}></a></td>
					<td><b style="color:#f60"><{$users[ls].send}></b> | <{$users[ls].receive}></td>
					<td>
						<a href="<{$url}>/show/id/<{$users[ls].id}>">查看</a>
						<a href="<{$url}>/add/id/<{$users[ls].id}>">发送站内信</a>
					</td>
				</tr>
			<{/section}>
		</tbody>
</div>
<script type="text/javascript">partition();mouse();</script>
<!--script>
	$(function() {
		$("input").keypress(function(e) {
			if (e.which == 13){ // 判断所按是否回车键
				var inputs = $("form").find(":text,:password"); // 获取表单中的所有输入框
				var idx = inputs.index(this); // 获取当前焦点输入框所处的位置
				if (idx == inputs.length - 1){ // 判断是否是最后一个输入框
					if (confirm("确认添加?")) // 用户确认
					$("form").submit(); // 提交表单
				} else {
					inputs[idx + 1].focus(); // 设置焦点
					inputs[idx + 1].select(); // 选中文字
				}
				return false;// 取消默认的提交行为
			}	
		});
	});

</script-->
<{include file='public/footer.tpl'}>
