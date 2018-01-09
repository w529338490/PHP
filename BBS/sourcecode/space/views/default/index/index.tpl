<{include file="public/header.tpl"}>
<script type="text/javascript">
	function send_index_message(mid,uid){
		var textstr = editor.html();
		Ajax().post("<{$url}>/insert_message/"+Math.random(),{uid:uid,mess_id:mid,content:textstr},function(data){
				select_index_message(uid);
				editor.html("");
				show('grade','block',false,true);
				show('bottom','block',true,false);
				document.getElementById("info").innerHTML="<img src='<{$res}>/images/grade.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>发表成功,积分增加 <font color='red'>"+data+"</font> 分</span>";
				timec(4,'y');
		});
	}
	function select_index_message(uid){
		Ajax().get("<{$url}>/message/uid/"+uid+"/sj/"+Math.random(), function(data){
				document.getElementById("message_c").innerHTML=data;
		});
	}
</script>
<div class="nav"></div>
<div id="content">
		<div id="left">
			<div class="column">
				<div class="column_title">头像</div>
				<div class="column_content">
					<div class="m_avar">
						<img src="<{$public}>/uploads/user/m_<{nocache}><{$user.face_path}><{/nocache}>" width="120px" height="120px" />
					</div>
					<span><{nocache}><{$user.name}><{/nocache}></span><br>
					<{nocache}>
						<{if $smarty.session.home_login == 1 && $smarty.session.user_info.id == $user_h.id}>
							<ul class="avar">
								<li><img src="<{$res}>/images/thread_magic.gif">&nbsp;<a href="<{$app}>/sms/index/uid/<{$smarty.get.uid}>">查看消息</a></li>
								<li><img src="<{$res}>/images/wall.gif">&nbsp;<a href="<{$app}>/message/index/uid/<{$smarty.get.uid}>">查看留言</a></li>
								<li><img src="<{$res}>/images/profile.gif">&nbsp;<a href="<{$app}>/profile/edit/uid/<{$smarty.get.uid}>">更新资料</a></li>
								<li><img src="<{$res}>/images/album.gif">&nbsp;<a href="<{$app}>/profile/edit_avar/uid/<{$smarty.get.uid}>">编辑头像</a></li>
							</ul>
						<{else}>
							<span id="send_uid_<{$smarty.get.uid}>" style="display:none"><{$smarty.get.uid}></span>
							<span id="send_name_<{$smarty.get.uid}>" style="display:none"><{$user.name}></span>
							<ul class="avar">
								<li><img src="<{$res}>/images/friend.gif">&nbsp;<a href="javascript:;" onclick="show('frsend','block');show('bottom','block',true);getfrValue()">加为好友</a></li>
								<li><img src="<{$res}>/images/wall.gif">&nbsp;<a href="<{$app}>/message/index/uid/<{$smarty.get.uid}>">给我留言</a></li>
								<li><img src="<{$res}>/images/poke.gif">&nbsp;<a href="javascript:show('hello','block');show('bottom','block',true);getname('<{$smarty.get.uid}>');">打个招呼</a></li>
								<li><img src="<{$res}>/images/pm.gif">&nbsp;<a href="javascript:;" onclick="show('pmsend','block');show('bottom','block',true);getValue();">发送消息</a></li>
							</ul>
							<span id="send_uid" style="display:none"><{$smarty.get.uid}></span>
							<span id="send_name" style="display:none"><{$user.name}></span>
							<span id="friend_uid" style="display:none"><{$smarty.get.uid}></span>
							<span id="friend_name" style="display:none"><{$user.name}></span>
						<{/if}>
					<{/nocache}>
				</div>
			</div>
			<div class="nav_s"></div>
			<div class="column">
				<div class="column_title">统计信息</div>
				<div class="column_content">
				<{nocache}>
					<span class="v_total">已有 <span> <{$total.guest_num}> </span> 人来访过</span>
					<ul class="total">
						<li>积分:<a href=""> <{$user.grade_num}></a></li>
						<li>好友:<a href=""> <{$total.friend_num}></a></li>
						<li>主题:<a href=""> <{$total.subj_num}></a></li>
						<li>日志:<a href=""> <{$total.log_num}></a></li>
						<li>相册:<a href=""> <{$total.album_num}></a></li>
					</ul>
				<{/nocache}>
					<div class="nav"></div>
				</div>
			</div>
			<div class="nav_s"></div>
			<div class="column">
				<div class="column_title">记录</div>
				<div class="column_content">
				<{nocache}>
					<{if $speak}>
						<{section loop=$speak name="sls" max="3"}>
							<div class="log_show"><span class="log_content"><{$speak[sls].content|html_decode}></span><span style="float:right"><a href="<{$app}>/speak/index/uid/<{$smarty.get.uid}>">回复</a></span>
							<div style="clear:both"></div>
							</div>
							<div class="line_nav" style="margin:0"></div>
						<{/section}>
					<{else}>
						<font color="#cccccc" size="2">暂无记录!</font>
					<{/if}>
				<{/nocache}>
				</div>
			</div>
		</div>
		<div id="middle">
			<div class="column">
				<div class="column_title">个人资料</div>
				<div class="column_content">
				<{nocache}>
					<ul class="profile">
							<li><em>真实姓名</em><span><{$user.true_name}></span></li>
							<li><em>性别</em><span><{$user.sex}></span></li>
							<li><em>生日</em><span><{$user.birthday|chinadate:"Y年m月d日"}></span></li>
							<li><em>出生地</em><span><{$user.birth_add.province}> <{$user.birth_add.city}></span></li>
							<li><em>居住地</em><span><{$user.live_add.province}> <{$user.live_add.city}></span></li>
							<li><em>交友目的</em><span><{$user.pal_aim}></span></li>
							<li><em>兴趣爱好</em><span><{$user.hobby}></span></li>
					</ul>
				<{/nocache}>
					<div class="line_nav"></div>
					<p align="right"><a href="<{$app}>/profile/index/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>">查看全部个人资料</a></p>
				</div>
			</div>
			<div class="nav_s"></div>
			<div class="column">
				<div class="column_title">日志</div>
				<div class="column_content">
				<{nocache}>
					<{if $log}>
						<{section loop=$log name=lls max=$s_log_index}>
							<dl>
								<dt class="log_title"><a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$log[lls].id}>"><{$log[lls].title}></a><span><{$log[lls].ptime|chinadate:"Y-m-d" }></span></dt>
								<dd class="log_content"><{$log[lls].content|html_decode|html_deltags|truncate:200:"..."}></dd>
								<dd class="log_show"><a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$log[lls].id}>" style="float:right">(<{$log[lls].click_num}>)次阅读</a><span style="float:right;margin:0 5px;">|</span><a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$log[lls].id}>" style="float:right">(<{$log[lls].ctotal}>)次评论</a>
								<div style="clear:both"></div>
								</dd>
							</dl>
							<div class="line_nav"></div>
						<{/section}>
						<p align="right"><a href="<{$app}>/log/index/uid/<{$smarty.get.uid}>">查看更多</a></p>
					<{else}>
							<font color="#cccccc" size="2">暂未发表!</font>
					<{/if}>
				<{/nocache}>
				</div>
			</div>
			<div class="nav_s"></div>
			<div class="column">
				<div class="column_title">留言板</div>
				<div class="column_content">
				<{nocache}>
					<{if $smarty.session.home_login eq 1}>
							<div class="message_area">
								<textarea id="message_index"></textarea>
								<{*<{textarea name="message_index" style="emotion" default="请在这里给我留言" autoclear="true" scrollbar="true" autoh="true" minh="100"}>*}>
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
								<button class="bn" onclick="send_index_message(<{$smarty.session.user_info.id}>,<{$smarty.get.uid}>)">留言</button>
							</div>
						<div class="line_nav"></div>
					<{/if}>
				<{/nocache}>
					<div id="message_c"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
				</div>
			</div>
		</div>
		<div id="right">
			<div class="column">
				<div class="column_title">好友</div>
				<div class="column_content">
					<ul class="friend">
					<{nocache}>
						<{if $fdata}>
							<{section loop=$fdata name="fls" max=$s_friend_index}>
								<li>
									<div class="img_b_s"><a href="<{$app}>/index/index/uid/<{$fdata[fls].fid}>"><img src="<{$public}>/uploads/user/s_<{$fdata[fls].face}>" width="48px" height="48px"></a></div>
									<p><a href="<{$app}>/index/index/uid/<{$fdata[fls].fid}>"><{$fdata[fls].fname}></a></p>
								</li>
							<{/section}>
						<{else}>
							<font color="#cccccc" size="2">暂无好友!</font>
						<{/if}>
					<{/nocache}>
					</ul>
					<div class="nav"></div>
				</div>
			</div>
			<div class="nav_s"></div>
			<div class="column">
				<div class="column_title">最近访客</div>
				<div class="column_content">
					<ul class="friend">
					<{nocache}>
						<{if $vdata}>
							<{section loop=$vdata name="vls"}>
								<li>
									<div class="img_b_s"><a href="<{$app}>/index/index/uid/<{$vdata[vls].guest_id}>"><img src="<{$public}>/uploads/user/s_<{$vdata[vls].face}>" width="48px" height="48px"></a></div>
									<p><a href="<{$app}>/index/index/uid/<{$vdata[vls].guest_id}>"><{$vdata[vls].vname}></a></p>
									<span class="vtime">
										<{$vdata[vls].vtime|chinadate:"H:i"}>
									</span>
								</li>
							<{/section}>
						<{else}>
							<font color="#cccccc" size="2">暂无访客!</font>
						<{/if}>
					<{/nocache}>
					</ul>
					<div class="nav"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	<{nocache}>
		select_index_message(<{$smarty.get.uid}>);
		add_visite(<{$smarty.get.uid}>);
	<{/nocache}>
</script>
<{include file="friend/send.tpl"}>
<{include file="sms/send.tpl"}>
<{include file="public/hello_box.tpl"}>
<{include file="public/footer.tpl"}>