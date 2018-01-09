<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">记录</div>
					<div class="column_content">
						<{nocache}>
							<{if $smarty.session.home_login==1 && $smarty.session.user_info.id==$smarty.get.uid }>
								<div class="message_area">
									<textarea cols="50" rows="6" class="message_index" id="speak"></textarea><br/>
									<script type="text/javascript">
										KindEditor.ready(function(K) {
											KindEditor.ready(function(K) {
												window.editor = K.create('textarea[id="speak"]', {
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
									<{*<{textarea name="speak" style="emotion" maxw="20" default="请输入说说信息" autoclear="true" form="speak" minh="100"}>*}>
									<button class="bn" onclick="insert_speak(<{$smarty.session.user_info.id}>,<{$smarty.get.uid}>)">发布</button>
								</div>
								<div class="line_nav"></div>
							<{/if}>
						<{/nocache}>
						<div id="speak_c"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>
<script type="text/javascript">
	function insert_speak(){
		var textstr = editor.html();
		if(textstr!="" && textstr.length<=140){
			<{nocache}>
			Ajax().post("<{$url}>/insert/"+Math.random(),{uid:<{$smarty.get.uid}>,content:textstr},function(data){
					select_speak(<{$smarty.get.uid}>);
					editor.html("");
					show('grade','block',0,1);
					show('bottom','block',1,0);
					document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>发表成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
					timec(4,'y');
			});
			<{/nocache}>
		}else{
			alert("记录不能为空或者大于140个字符!");
		}
	}
	function del_speak(sid){
		if(confirm("删除说说会删除此条说说下的所有回复,您确定要删除吗?")){
			Ajax().get("<{$url}>/sdel/sid/"+sid+"/sj/"+Math.random(),function(data){
				show('grade','block',0,1);
				show('bottom','block',1,0);
				document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
				timec(0,'n');
				select_speak(<{$smarty.get.uid}>);
			});
		}
	}
	function insert_speak_c(sid,uid){
		var c_content = document.getElementById("in_"+sid).value;
		Ajax().post("<{$url}>/insert_c/"+Math.random(),{sid:sid,uid:uid,content:c_content},function(data){
				select_speak(<{$smarty.get.uid}>);
				show('grade','block',0,1);
				show('bottom','block',1,0);
				document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>发表成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
				timec(4,'y');
		});
	}
	function del_speak_c(cid){
		if(confirm("删除此条回复将无法恢复,您确定要删除吗?")){
			Ajax().get("<{$url}>/del/cid/"+cid+"/sj/"+Math.random(),function(data){
					show('grade','block',0,1);
					show('bottom','block',1,0);
					document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
					timec(0,'n');
					<{nocache}>
						select_speak(<{$smarty.get.uid}>);
					<{/nocache}>
			});
		}
	}
	function select_speak(u_id){
		Ajax().get("<{$url}>/speak/uid/"+u_id+"/sj/"+Math.random(),function(data){
				document.getElementById("speak_c").innerHTML=data;
		});
	}
	function setPage(url){
		var newurl=url+"/uid/<{$smarty.get.uid}>/sj/"+Math.random();
		Ajax().get(newurl, function(data){
				document.getElementById("speak_c").innerHTML=data;
		});
	}
	<{nocache}>
		select_speak(<{$smarty.get.uid}>);
	<{/nocache}>
</script>