<{include file="public/header.tpl"}>
<script src="<{$res}>/js/common.js"></script>
<script src="<{$public}>/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/new_info.css">
<div id="main">
		<div id='info_box'>
			<div id='post_top'>
				<div class='user_content'>
					<h2>
						<a href='<{$app}>/notice/info/ncid/<{$info.id}>'>
							<{$info.title}>
						</a>		
					</h2>
				</div>
			</div>
			<!--用户的简介信息 主题内容 start-->
			<div class='post_content'>
				<div class='user_info'>
					<p class='dashed_line'>
						<a href='<{$root}>/space.php/index/index/uid/<{$info.uid}>'>
							<{$info.author}>
						</a>
					</p>
					<a href='<{$root}>/space.php/index/index/uid/<{$info.uid}>'>
						<img src='<{$public}>/uploads/user/m_<{$info.face_img}>' />
					</a>
					
					<ul>
						<li>
							<b>等级:</b><{$info.leve}>
						</li>
						<li>
							<b>日志:</b><{$info.log_num}>
						</li>
						<li>
							<b>主题:</b><{$info.subj_num}>
						</li>
						<li>
							<b>帖子:</b><{$info.comm_num}>
						</li>
					</ul>
					<div class='OTA'>
						<a href='#' class='home'>串个门</a>
						<a href='#' class='add_friend'>加好友</a><br />
						<a href='#' class='say_hello'>打招呼</a>
						<a href='#' class='send_mess'>发消息</a>
					</div>
				</div>
				<div class='user_content'>
					<p class='dashed_line'>发表于 <{$info.start_time|chinadate:'Y-m-d H:i:s'}></p>
					<div class='msg_content'>
						<{$info.content|html_decode}>
					</div>
					<div class='qianming'>
						<div class='clear'></div>
						<p class='dashed_line'></p>
						<p class='user_q'>
							<{$info.sign}>
						</p>
					</div>
				</div>
				<div class='clear'></div>
			</div>	
			<!--用户的简介信息 主题内容 end-->		
		</div>	
</div>
<{include file="public/footer.tpl"}>