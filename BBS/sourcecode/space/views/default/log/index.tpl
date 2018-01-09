<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
						<div class="column_title">日志<span><img src="<{$res}>/images/addbuddy.gif" /><a href="<{$url}>/add/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>">发表新日志</a></span></div>
						<div class="column_content">
						<div id="log_list"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
						<script type="text/javascript">
							function delete_log(lid){
								if(confirm('您确认要删除此篇日志吗?')){
									Ajax().get("<{$url}>/delete_log/lid/"+lid+"/uid/"+<{$smarty.get.uid}>,function(data){
										select_log(<{$smarty.get.uid}>);
										show('grade','block',0,1);
										show('bottom','block',1,0);
										document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
										timec(0,'n');
									});
								}
							}
							function select_log(uid){
								Ajax().get("<{$url}>/loglist/uid/"+uid,function(data){
									document.getElementById("log_list").innerHTML=data;
								});
							}
							function setPage(url){
								var newurl=url+"/uid/<{$smarty.get.uid}>/sj/"+Math.random();
								Ajax().get(newurl, function(data){
										document.getElementById("log_list").innerHTML=data;
								});
							}
							<{nocache}>
								select_log(<{$smarty.get.uid}>);
							<{/nocache}>
						</script>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>