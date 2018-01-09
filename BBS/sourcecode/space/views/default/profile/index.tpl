<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">个人资料</div>
					<div class="column_content">
					<{nocache}>
						<div class="pro_ti"><b><{$user_info.name}></b>&nbsp;(UID:<{$user_info.id}>)</div>
						<ul class="profile">
							<li><em>空间访问量</em><strong style="color:#ff6600"><{$total.guest_num}></strong></li>
							<li><em>用户邮箱</em><{$user_info.email}></li>
							<li><em>最新说说</em><{if $new_speak}><{$new_speak|html_decode|html_deltags|truncate:30:"..."}><{else}>我最近很忙,没有写什么...<{/if}></li>
							<li><em>个人签名</em><{$user_info.sign}></li>
							<li><em>统计信息</em><a href="<{$app}>/friend">好友数 <{$total.friend_num}></a> | <a href="<{$app}>/speak">说说数 <{$total.speak_num}></a> | <a href="<{$app}>/log">日志数 <{$total.log_num}></a> | <a href="<{$app}>/album">相册数 <{$total.album_num}></a> | <a href="<{$app}>/album">积分数 <{$user_info.grade_num}></a></li>
						</ul>
						<div class="line_nav"></div>
						<ul class="profile">
							<li><em>真实姓名</em><{$user_info.true_name}></li>
							<li><em>性别</em><{$user_info.sex}></li>
							<li><em>生日</em><{$user_info.birthday|chinadate:"Y年m月d日"}></li>
							<li><em>出生地</em><{$user_info.birth_add.province}> <{$user_info.birth_add.city}></li>
							<li><em>居住地</em><{$user_info.live_add.province}> <{$user_info.live_add.city}></li>
							<li><em>交友目的</em><{$user_info.pal_aim|html_decode|html_deltags|truncate:30:"..."}></li>
							<li><em>兴趣爱好</em><{$user_info.hobby|html_decode|html_deltags|truncate:30:"..."}></li>
						</ul>
						<div class="line_nav"></div>
						<div class="pro_ti"><b>活跃概况</b></div>
						<ul class="profile">
							<li><em>用户身份</em><{$user_level}></li>
							<li><em>注册时间</em><{$user_info.reg_time|chinadate:"Y年m月d日 H:i:s"}></li>
							<li><em>最后登录时间</em><{$user_info.last_time|chinadate:"Y年m月d日 H:i:s"}></li>
							<li><em>最后登录IP</em><{$user_info.last_ip|ip}></li>
						</ul>
					<{/nocache}>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>