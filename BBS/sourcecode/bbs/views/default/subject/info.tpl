<{include file="public/header.tpl"}>
<{nocache}>
<script src="<{$public}>/ke/kindeditor.js"></script>
<script src="<{$res}>/js/common.js"></script>
<script src="<{$public}>/js/common.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[id="ke_content"]', {
				resizeType : 1,
				width:"100%",
				hright:"250px",
				allowPreviewEmoticons : false,
				allowImageUpload : false,
				items : [
					'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link']
			});
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/subject_info.css">
<script>
	$(function(){
		//未登录 显示登陆窗口
		$(".reply_btn").click(function(){
			check_login();
		})
		
		//加好友 
		$(".add_friend").click(function(){
			if("<{$smarty.session.home_login}>"!='1'){
				$(".reply_btn").click();
				return;
			}
			$(".f_window_back").show();
			$(".f_window_box_back").show();
			window.scrollTo(0,0);				
		})
		
		//发送短消息
		$(".send_mess").click(function(){
			if("<{$smarty.session.home_login}>"!='1'){
				$(".reply_btn").click();
				return;
			}
			$(".sms_window_back").show();
			$(".sms_window_box_back").show();
			window.scrollTo(0,0);				
		})	
		//打招呼	
		$(function(){
			$("a.say_hello").click(function(){
				if(check_login()){
					window.scrollTo(0,0);
					$('.hello_window_back').show();
					$('.hello_window_box_back').show();
					var dst_uid=$(this).parent('.OTA').siblings(".dashed_line").children('span').text();
					$("#hello_btn").click(function(){
						var content=$(':radio:checked').val();
						$.ajax({
							type:'post',
							url:'<{$app}>/user/hello',
							data:'dst_id='+dst_uid+'&content='+content,
							success:function(data){
								if(data=='1'){
									alert('已向对方打招呼');
								}
							}
						})					
					})
				}			
			})				
		})		
		//回帖按钮监听(看内容是否符合要求)
		$("#fast_btn").click(function(){
			if("<{$subj_info.state}>"=="2"){
				alert('呜呜~~楼主不要你回复');
				return;
			}
			var content=$(".ke-edit-iframe").contents().find("body").html();
			if(content==''){
				$("#reply_mess").html("请输入内容").css("color",'red');
			}else if(getlength(content,'utf8')<15){
				$("#reply_mess").html("回复的内容不能少于15个字符哈").css("color",'red');
			}else{
				$.ajax({
					async:false,
					type:"post",
					url:"<{$app}>/comment/insert",
					data:"uid=<{$smarty.session.user_info.id}>&sid=<{$smarty.get.sid}>&content="+content,
					success:function(data){
						if(data!=0){
						eval("var info="+data+";");
						var html="";
						html+="<div class='post_content'>";
							html+="<div class='user_info'>";
								html+="<p class='dashed_line'>";
									html+="<a href='<{$root}>/space.php/index/index/uid/<{$smarty.session.user_info.id}>'>";
										html+="<{$smarty.session.user_info.name}>";
									html+="</a>";
								html+="</p>";
								html+="<a href='<{$root}>/space.php/index/index/uid/<{$smarty.session.user_info.id}>'>";
									html+="<img src='<{$public}>/uploads/user/m_<{$smarty.session.user_info.face_path}>' />";
								html+="</a>";
								html+="<ul>";
									html+="<li><b>等级:</b>"+info.level+"</li>";
									html+="<li><b>日志:</b>"+info.log_num+"</li>";
									html+="<li><b>主题:</b>"+info.subj_num+"</li>";
									html+="<li><b>帖子:</b>"+info.comm_num+"</li>";
								html+="</ul>";
								html+="<div class='OTA'>";
									html+="<a href='<{$root}>/space.php/index/index/uid/<{$smarty.session.user_info.id}>' class='home'>串个门</a>";
									html+="<a href='#' class='add_friend'>加好友</a><br />";
									html+="<a href='#' class='say_hello'>打招呼</a>";
									html+="<a href='#' class='send_mess'>发消息</a>";
								html+="</div>";
							html+="</div>";
							html+="<div class='user_content'>";
								html+="<p class='dashed_line'>发表于 "+info.time+"</p>";
								html+="<div class='msg_content'>";
									html+=content;
								html+="</div>";
								html+="<div class='qianming'>";
									html+="<div class='clear'></div>";
									html+="<p class='dashed_line'></p>";
									html+="<p class='user_q'>";
										html+="<{$smarty.session.user_info.sign}>";
									html+="</p>";
								html+="</div>";
							html+="</div>";
							html+="<div class='clear'></div>";
						html+="</div>";
						$("#info_box").append(html); 
						alert('发表评论成功!加 '+info.add_grade+' 分');
						$("#counter").text(parseInt($("#counter").text())+1);
						}else{
							alert('您回复的次数过于频繁,请稍后再试');
						}
					}
				})
			}
		})
		
		//内容输入监听(清空原来的提示)
		$("#baidu_editor_0").contents().find("body").keydown(function(){
			$("#reply_mess").html('');
		})
		
		//观点
		$("#yes,#no").click(function(){
			if(check_login()){
				$.ajax({
					type:'GET',
					url:'<{$app}>/subject/viewpoint/sid/<{$smarty.get.sid}>/type/'+$(this).attr('type'),
					type1:$(this).attr('type'),
					success:function(data){
						if(data==1){
							if(this.type1==1){
								$("#yes b").text(parseInt($("#yes b").text())+1);
							}else{
								$("#no b").text(parseInt($("#no b").text())+1);
							}
							alert('表达观点成功!');
						}else{
							alert('不能对自己的主题发表观点!');
						}
					}
				})			
			}
		})
		//发送短信(赋值)
		$('a.send_mess').click(function(){
			var friend_name=$(this).parent('.OTA').siblings(".dashed_line").children('a').text();
			var friend_uid=$(this).parent('.OTA').siblings(".dashed_line").children('span').text();
			$(".sms_window_content table input[name=f_name]").val(friend_name);
			$(".sms_window_content table input[name=f_uid]").val(friend_uid);
		})
		//添加好友请求(赋值)
		$('a.add_friend').click(function(){
			var friend_name=$(this).parent('.OTA').siblings(".dashed_line").children('a').text();
			var friend_uid=$(this).parent('.OTA').siblings(".dashed_line").children('span').text();
			$(".f_window_content table input[name=f_name]").val(friend_name);
			$(".f_window_content table input[name=f_uid]").val(friend_uid);
		})
		//主题操作
		$("#admin_tool a[type]").click(function(){
			var ptype=$(this).attr('type');
			if(ptype=='0'){
				if(!confirm('确认关闭主题吗?')){
					return;
				}
			}
			if(ptype=='5'){
				if(!confirm('确认删除此主题吗?这将会删除此主题的所有回复')){
					return;
				}
			}			
			$.ajax({
				type:'post',
				url:'<{$app}>/subject/subject_opera',
				data:'sid=<{$smarty.get.sid}>&type='+ptype,
				success:function(data){
					if(data=='1'){
						alert('操作成功!');
					}else{
						alert('操作失败!');
					}
				}
			})
		})
	})
</script>
<div id="main">
	<{if $subj_info.uid <= 0}>
		<p style="border:1px dashed #F26C4F;padding:10px;margin-bottom:10px">未知主题</p>
	<{else}>
		<div class="post">
			<a href="<{$app}>/subject/post_subj_page"><img src="<{$res}>/images/pn_post.png" /></a>
			<{if $smarty.session.home_login != 1}>
				<a href="javascript:void(0)" class="reply_btn"><img src="<{$res}>/images/pn_reply.png" /></a>
			<{/if}>	
			<div class="clear"></div>
		</div>
		<div id="admin_tool">
			<{if $smarty.session.user_info.stand == '1' || $smarty.session.user_info.stand == '2'}>
					<a href="javascript:void(0)" type='2'>加精</a> 
					<a href="javascript:void(0)" type='1'>置顶</a> 
					<a href="javascript:void(0)" type='3'>推荐</a> 
					<a href="javascript:void(0)" type='0'>关闭</a> 
					<a href="javascript:void(0)" type='4'>普通</a> 
					<{if $smarty.session.user_info.stand == '1'}>
						<a href="javascript:void(0)" type='5'>删除</a> 
					<{/if}>
			<{/if}>
			<{if $subj_info.uid == $smarty.session.user_info.id ||  $smarty.session.user_info.stand == '1' || $smarty.session.user_info.stand == '2'}>
				<a href="<{$app}>/subject/editor/sid/<{$smarty.get.sid}>">编辑</a> 
			<{/if}>
		</div>
		<div id='info_box'>
			<div id='post_top'>
				<div class='user_info'>查看: <b><{$subj_info.click_num}></b> | 回复: <b id="counter"><{$subj_info.subj_comm_num}></b> </div>
				<div class='user_content'>
					<h2>
					<a href='<{$app}>/subject/info/sid/<{$subj_info.id}>' title="<{$subj_info.title}>">
						<{$subj_info.title}>
					</a>
						<{if $subj_info.ptype == 1}>
							<img src="<{$res}>/images/pin_1.gif" />							
						<{elseif $subj_info.subj_comm_num >= $subj_info.subj_hot_num }>
							<img src="<{$res}>/images/hot_3.gif" />
						<{elseif $subj_info.ptype == 2}>
							<img src="<{$res}>/images/digest_1.gif" />
						<{elseif $subj_info.ptype == 3}>
							<img src="<{$res}>/images/006.small.gif" />
						<{elseif $subj_info.subj_comm_num == 0}>
							<img src="<{$res}>/images/folder_common.gif" />
						<{else}>
							<img src="<{$res}>/images/folder_new.gif" />
						<{/if}>				
					</h2>
				</div>
			</div>
			<!--用户的简介信息 主题内容 start-->
			<div class='post_content'>
				<div class='user_info'>
					<p class='dashed_line'>
						<a href='<{$root}>/space.php/index/index/uid/<{$subj_info.uid}>'><{$subj_info.user_name}></a>
						<span style="display:none"><{$subj_info.uid}></span>
					</p>
					<a href='<{$root}>/space.php/index/index/uid/<{$subj_info.uid}>'>
						<img src='<{$public}>/uploads/user/m_<{$subj_info.user_face_img}>' />
					</a>
					<ul>
						<li>
							<b>等级:</b><{$subj_info.user_level}>
						</li>
						<li>
							<b>日志:</b><{$subj_info.user_log_num}>
						</li>
						<li>
							<b>主题:</b><{$subj_info.user_subj_num}>
						</li>
						<li>
							<b>帖子:</b><{$subj_info.user_commo_num}>
						</li>
					</ul>
					<div class='OTA'>
						<a href='<{$root}>/space.php/index/index/uid/<{$subj_info.uid}>' class='home'>串个门</a>
						<a href='javascript:void(0)' class='add_friend'>加好友</a><br />
						<a href='javascript:void(0)' class='say_hello'>打招呼</a>
						<a href='javascript:void(0)' class='send_mess'>发消息</a>
					</div>
				</div>
				<div class='user_content'>
					<p class='dashed_line'>发表于 <{$subj_info.ptime|chinadate:'Y-m-d H:i:s'}></p>
					<div class='msg_content'>
						<{$subj_info.content|html_decode}>
					</div>
					<div class='qianming'>
						<span id="yes" type="1"><img src='<{$res}>/images/rec_add.gif' />支持 (<b><{$subj_info.yes_num}></b>) </span>
						<span id="no" type="-1"><img src='<{$res}>/images/rec_subtract.gif' />反对 (<b><{$subj_info.no_num}></b>) </span>
						<div class='clear'></div>
						<p class='dashed_line'></p>
						<p class='user_q'>
							<{$subj_info.user_sign}>
						</p>
					</div>
				</div>
				<div class='clear'></div>
			</div>	
			<!--用户的简介信息 主题内容 end-->		
			
			<{section loop=$all_comm name='cm'}>
				<!--用户的简介信息 留言内容 start-->
				<div class='post_content'>
					<div class='user_info'>
						<p class='dashed_line'>
							<a href='<{$root}>/space.php/index/index/uid/<{$all_comm[cm].uid}>'><{$all_comm[cm].user_name}></a>
							<span style="display:none"><{$subj_info.uid}></span>
						</p>
						<a href='<{$root}>/space.php/index/index/uid/<{$all_comm[cm].uid}>'>
							<img src='<{$public}>/uploads/user/m_<{$all_comm[cm].user_face_img}>' />
						</a>
						<ul>
							<li><b>等级:</b><{$all_comm[cm].user_level}></li>
							<li><b>日志:</b><{$all_comm[cm].user_log_num}></li>
							<li><b>主题:</b><{$all_comm[cm].user_subj_num}></li>
							<li><b>帖子:</b><{$all_comm[cm].user_comm_num}></li>
						</ul>
						<div class='OTA'>
							<a href='<{$root}>/space.php/index/index/uid/<{$all_comm[cm].uid}>' class='home'>串个门</a>
							<a href='javascript:void(0)' class='add_friend'>加好友</a><br />
							<a href='javascript:void(0)' class='say_hello'>打招呼</a>
							<a href='javascript:void(0)' class='send_mess'>发消息</a>
						</div>
					</div>
					<div class='user_content'>
						<p class='dashed_line'>发表于 <{$all_comm[cm].ptime|chinadate:'Y-m-d H:i:s'}></p>
						<div class='msg_content'>
							<{$all_comm[cm].content|html_decode}>
						</div>
						<div class='qianming'>
							<div class='clear'></div>
							<p class='dashed_line'></p>
							<p class='user_q'>
								<{$all_comm[cm].sign}>
							</p>
						</div>
					</div>
					<div class='clear'></div>
				</div>	
				<!--用户的简介信息 留言内容 end-->	
			<{/section}>
		</div>
		<div class="post_page">
			<{$fpage}>
		</div>		
		<div class="post" style="margin-bottom:10px">
			<a href="<{$app}>/subject/post_subj_page"><img src="<{$res}>/images/pn_post.png" /></a>
			<{if $smarty.session.home_login != 1}>
				<a href="javascript:void(0)" class="reply_btn"><img src="<{$res}>/images/pn_reply.png" /></a>
			<{/if}>			
			<div class="clear"></div>
		</div>
		<{if $smarty.session.home_login == 1}>
			<!--发帖框-->
			<div id="reply_box">
				<table width="100%" border="0" cellspacing="0">
					<tr>
						<td id="face_img_td" valign="top">
							<img src="<{$public}>/uploads/user/m_<{$smarty.session.user_info.face_path}>">
						</td>
						<td style="padding:5px;" id="reply_box_content">
							<textarea id="ke_content">
								<{if $subj_info.state == 2}>
									此贴被楼主设置为禁止回复
								<{/if}>
							</textarea>
							<input type="button" id="fast_btn" value="回复" />
							<span id="reply_mess"></span>
						</td>
					</tr>
				</table>
			</div>		
		<{/if}>
	<{/if}>
</div>
<{include file="public/friend_window.tpl"}>
<{include file="public/sms_window.tpl"}>
<{include file="public/hello_box.tpl"}>
<{/nocache}>
<{include file="public/footer.tpl"}>