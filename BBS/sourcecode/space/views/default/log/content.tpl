<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
						<div class="column_title">日志</div>
						<div class="column_content">
							<dl>
								<dt class="log_title" style="font-size:20px"><{nocache}><{$data.title}><{/nocache}><div style="font-size:12px;color:#999;margin-left:5px;"><{nocache}><{$data.ptime|chinadate:"Y-m-d"}><{/nocache}></div></dt>
								<dd class="log_content"  style="border-top:1px solid #ccc;padding:15px"><{nocache}><{$data.content|html_decode}><{/nocache}></dd>
								<dd class="log_show">
								<div style="float:left;">
									<a href="<{$url}>/mod/uid/<{nocache}><{$smarty.get.uid}>/lid/<{$data.id}><{/nocache}>">编辑</a><span style="margin:0 5px;">|</span><a href="javascript:void(0);" onclick="javascript:if(confirm('您确认要删除此日志吗?')){window.location='<{$url}>/delete_log/uid/<{nocache}><{$smarty.get.uid}>/lid/<{$data.id}><{/nocache}>'}">删除</a><span style="margin:0 5px;">|</span>IP:<{nocache}><{$data.ip|ip}><{/nocache}>
									</div>
								<div style="float:right;">
									<a href="<{$app}>/log/content/uid/<{nocache}><{$smarty.get.uid}>/lid/<{$smarty.get.lid}><{/nocache}>">(<{nocache}><{$data.click_num}><{/nocache}>)次阅读</a><span style="margin:0 5px;">|</span><a href="<{$app}>/log/content/uid/<{nocache}><{$smarty.get.uid}>/lid/<{$smarty.get.lid}><{/nocache}>#pl">(<span id="total"><{nocache}><{$logc_total}><{/nocache}></span>)次评论</a>
								</div>
								<div style="clear:both"></div>
								</dd>
							</dl>
							<p id="pl" style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;text-align:left;font-weight:bold;padding:10px 0">评论一下</p>
							<div id="log_c" style="margin-bottom:10px;"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
							<{nocache}>
								<{if $smarty.session.home_login==1}>
								<div class="message_area">
									<textarea id="c_log" cols="50" rows="6" class="message_index"></textarea><br/>
									<{*<{textarea name="c_log" style="emotion" minh="100"}>*}>
									<script>
										KindEditor.ready(function(K) {
											KindEditor.ready(function(K) {
												window.editor = K.create('textarea[id="c_log"]', {
													resizeType : 1,
													width:"100%",
													hright:"250px",
													allowPreviewEmoticons : false,
													allowImageUpload : false,
													items : ['emoticons']
												});
											});
										});
									</script>
									<button class="bn" onclick="send(<{$smarty.session.user_info.id}>);">评论</button>
								</div>
								<{/if}>
							<{/nocache}>
					</div>
				</div>
			</div>
			<script type="text/javascript">
			<{nocache}>
				Ajax().get("<{$url}>/update_cnum/lid/"+<{$smarty.get.lid}>+"/sj/"+Math.random());
			<{/nocache}>
				function send(uid){
					var textstr = editor.html();
					if(textstr!="" && textstr.length<=140){
						<{nocache}>
							var sessionid = <{$smarty.session.user_info.id}>+0;
							Ajax().post("<{$url}>/insert_logc/"+Math.random(),{uid:sessionid,content:textstr,lid:<{$smarty.get.lid}>},function(data){
									select(<{$smarty.get.lid}>);
									editor.html("");
									document.getElementById("total").innerHTML=parseInt(document.getElementById("total").innerHTML)+1;
									show('grade','block',0,1);
									show('bottom','block',1,0);
									document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>评论成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
									timec(2,'y');
							});
						<{/nocache}>
					}else{
						alert("评论内容不能为空或者大于140个字符!");
					}
				}
				function delc(cid){
					if(confirm("您确认要删除此条评论吗?")){
						Ajax().get("<{$url}>/delc/cid/"+cid+"/sj/"+Math.random(), function(data){
								<{nocache}>select(<{$smarty.get.lid}>);<{/nocache}>
								document.getElementById("total").innerHTML=parseInt(document.getElementById("total").innerHTML)-1;
								show('grade','block',0,1);
								show('bottom','block',1,0);
								document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
								timec(0,'n');
						});
					}
				}
				function select(lid){
					Ajax().get("<{$url}>/logc/uid/"+<{$smarty.get.uid}>+"/lid/"+lid+"/sj/"+Math.random(), function(data){
							document.getElementById("log_c").innerHTML=data;
					});
				}
				<{nocache}>
					select(<{$smarty.get.lid}>);
				<{/nocache}>
			</script>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>