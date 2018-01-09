<{include file="public/header.tpl"}>
<script type="text/javascript">
	function send_index_message(mid,uid){
		var textstr = editor.html();
		if(textstr!="" && textstr.length<=140){
			Ajax().post("<{$url}>/insert_message/"+Math.random(),{uid:uid,mess_id:mid,content:textstr},function(data){
					select_index_message(uid);
					editor.html("");
					show('grade','block',0,1);
					show('bottom','block',1,0);
					document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>发表成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
					timec(4,'y');
			});
		}else{
			alert("留言不能为空或者大于140个字符!");
		}	
	}
	function select_index_message(uid){
		Ajax().get("<{$url}>/message/uid/"+uid+"/sj/"+Math.random(), function(data){
				document.getElementById("message_c").innerHTML=data;
		});
	}
</script>
<div class="nav"></div>
<div id="content">
	<div class="speak_left">
		<div class="column">
				<div class="column_title">留言板</div>
				<div class="column_content">
				<{nocache}>
					<{if $smarty.session.home_login == 1}>
						<div class="message_area">
							<textarea cols="50" rows="6" class="message_index" id="message_index"></textarea><br/>
							<{*<{textarea name="message_index" style="emotion" default="请输入留言信息" autoclear="true" minh="100"}>*}>
							<script>
								KindEditor.ready(function(K) {
									KindEditor.ready(function(K) {
										window.editor = K.create('textarea[id="message_index"]', {
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
							<button class="bn" onclick="send(<{$smarty.session.user_info.id}>,<{$smarty.get.uid}>)">留言</button>
						</div>
						<div class="line_nav"></div>
					<{/if}>
				<{/nocache}>
				<script type="text/javascript">
					function send(mid,uid){
						var textstr = editor.html();
						Ajax().post("<{$url}>/insert_message/"+Math.random(),{uid:uid,mess_id:mid,content:textstr},function(data){
								select(uid);
								editor.html("");
								show('grade','block',0,1);
								show('bottom','block',1,0);
								document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>留言成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
								timec(2,'y');
						});
					}
					function delg(mid){
						if(confirm("确认删除此条留言吗?")){
							Ajax().get("<{$url}>/del_message/mid/"+mid+"/sj/"+Math.random(),function(data){
									select(<{$smarty.get.uid}>);
									show('grade','block',0,1);
									show('bottom','block',1,0);
									document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
									timec(0,'n');
							});
						}
					}
					function select(uid){
						Ajax().get("<{$url}>/message/uid/"+uid+"/sj/"+Math.random(), function(data){
								document.getElementById("message_c").innerHTML=data;
						});
					}
					function setPage(url){
						var newurl=url+"/uid/<{$smarty.get.uid}>/sj/"+Math.random();
						Ajax().get(newurl, function(data){
								document.getElementById("message_c").innerHTML=data;
						});
					}
					<{nocache}>
						select(<{$smarty.get.uid}>);
					<{/nocache}>
				</script>
				<div id="message_c"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
			</div>
		</div>
	</div>
	<{include file="public/right.tpl"}>
</div>
<{include file="public/footer.tpl"}>