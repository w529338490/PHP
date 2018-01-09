<{nocache}>
	<{if $cdata}>
	<{section loop=$cdata name="sls"}>
		<div class="message_content" style="padding-top:5px;">
			<div class="avar_left"><img src="<{$public}>/uploads/user/s_<{$cdata[sls].face_path}>" width="48px" height="48px"></div>
			<div class="content_right" style="width:550px;">
				<div class="title"><a href=""><{$cdata[sls].name}></a><span><{$cdata[sls].ptime|chinadate:"Y-m-d H:i:s"}></span></div>
				<div class="content"><{$cdata[sls].content|html_decode}></div>
			</div>
			<{if $smarty.session.home_login==1 && $smarty.session.user_info.id==$smarty.get.uid }>
				<span class="opr" style="cursor:pointer;color:#999999" onclick="delc(<{$cdata[sls].id}>);">删除</span>
			<{/if}>
		</div>
		<div class="line_nav"></div>
	<{/section}>
	<{else}>
		暂无评论
	<{/if}>
<{/nocache}>
<div class="nav"></div>