<div class="right" style="width:230px;float:right">
	<div class="column">
			<div class="column_title">头像</div>
			<div class="column_content">
				<div class="m_avar">
					<img src="<{$public}>/uploads/user/m_<{nocache}><{$user_h.face_path}><{/nocache}>" width="120px" height="120px" />
				</div>
				<span><{nocache}><{$user_h.name}><{/nocache}></span><br>
				<{nocache}>
					<{if $smarty.session.home_login == 1 && $smarty.session.user_info.id == $user_h.id}>
						<ul class="avar">
							<li><img src="<{$res}>/images/thread_magic.gif">&nbsp;<a href="<{$app}>/sms/index/uid/<{$user_h.id}>">查看消息</a></li>
							<li><img src="<{$res}>/images/wall.gif">&nbsp;<a href="<{$app}>/message/index/uid/<{$user_h.id}>">查看留言</a></li>
							<li><img src="<{$res}>/images/profile.gif">&nbsp;<a href="<{$app}>/profile/edit/uid/<{$user_h.id}>">更新资料</a></li>
							<li><img src="<{$res}>/images/album.gif">&nbsp;<a href="<{$app}>/profile/edit_avar/uid/<{$user_h.id}>">编辑头像</a></li>
						</ul>
					<{else}>
						<ul class="avar">
						<{if $smarty.session.user_info.id}>
							<li><img src="<{$res}>/images/friend.gif">&nbsp;<a href="javascript:;" onclick="show('frsend','block');show('bottom','block',true);getfrValue()">加为好友</a></li>
						<{else}>
							<li><img src="<{$res}>/images/friend.gif">&nbsp;<a href="javascript:;" onclick="show('login_send','block');show('bottom','block',true)">加为好友</a></li>
						<{/if}>
						<{if $smarty.session.user_info.id}>
							<li><img src="<{$res}>/images/wall.gif">&nbsp;<a href="<{$app}>/message/index/uid/<{$user_h.id}>">给我留言</a></li>
						<{else}>
							<li><img src="<{$res}>/images/wall.gif">&nbsp;<a href="javascript:show('login_send','block');show('bottom','block',true);">给我留言</a></li>
						<{/if}>
							<li><img src="<{$res}>/images/profile.gif">&nbsp;<a href="<{$app}>/profile/index/uid/<{$user_h.id}>">查看资料</a></li>
						<{if $smarty.session.user_info.id}>
							<li><img src="<{$res}>/images/pm.gif">&nbsp;<a href="javascript:;" onclick="show('pmsend','block');show('bottom','block',true);getValue()">发送消息</a></li>
						<{else}>
							<li><img src="<{$res}>/images/pm.gif">&nbsp;<a href="javascript:;" onclick="show('login_send','block');show('bottom','block',true)">发送消息</a></li>
						<{/if}>
						</ul>
					<{/if}>
				<{/nocache}>
			</div>
	</div>
</div>
<{nocache}>
	<span id="send_uid" style="display:none"><{$smarty.get.uid}></span>
	<span id="send_name" style="display:none"><{$user_h.name}></span>
	<span id="friend_uid" style="display:none"><{$smarty.get.uid}></span>
	<span id="friend_name" style="display:none"><{$user_h.name}></span>
<{/nocache}>
<{include file='friend/send.tpl'}>
<{include file='sms/send.tpl'}>