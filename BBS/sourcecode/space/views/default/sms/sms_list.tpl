<{nocache}>
<{if $sms_list}>
	<{section loop=$sms_list name="sls"}>
		<div class="message_content">
			<div class="avar_left">
				<{if $sms_list[sls].sms_sort == 4}>
					<img src="<{$public}>/images/run.png" width="48px" height="48px" />
				<{else}>
					<a href="<{$app}>/index/index/uid/<{$sms_list[sls].src_id}>">
					<img src="<{$public}>/uploads/user/s_<{$sms_list[sls].src_avar}>" width="48px" height="48px" />
					</a>
				<{/if}>
			</div>
			<div class="content_right" style="width:550px;">
				<div class="title">
					<{if $sms_list[sls].sms_sort == 4}>
						系统信息
					<{else}>
						<a href="<{$app}>/index/index/uid/<{$sms_list[sls].src_id}>"><{$sms_list[sls].src_name}></a>
					<{/if}>
					<span><{$sms_list[sls].ptime|chinadate:"Y-m-d H:i:s"}></span>
					<span>(IP:<{$sms_list[sls].ip|ip}>)</span>
				</div>
				<div class="pm_title">
					<a href="<{$url}>/detail/uid/<{$smarty.session.user_info.id}>/smsid/<{$sms_list[sls].id}>" <{if $sms_list[sls].is_read==1}> style="font-weight:normal"<{/if}> >
					<{$sms_list[sls].content|html_decode|truncate:"150":"..."}></a>
				</div>
				<{if $sms_list[sls].sms_sort == 2}>
					<div id="status" style="width:110%;color:#999999;text-align:right">
						<{if $sms_list[sls].I_is_friend ==0 && $sms_list[sls].Y_is_friend !=1}>
							<span style="cursor:pointer" onclick="accept_fr(<{$sms_list[sls].src_id}>);">接受请求并添加对方为好友</span>&nbsp;|&nbsp;
							<span style="cursor:pointer" onclick="if(confirm('您确认要拒绝吗?')){del_sms(<{$sms_list[sls].id}>);}">拒绝</span>
						<{elseif $sms_list[sls].I_is_friend ==0 && $sms_list[sls].Y_is_friend ==1}>	
							<span style="cursor:pointer" onclick="accept_only(<{$sms_list[sls].src_id}>);select_sms();">接受请求</span>&nbsp;|&nbsp;
							<span style="cursor:pointer" onclick="if(confirm('您确认要拒绝吗?')){del_sms(<{$sms_list[sls].id}>);}">拒绝</span>
						<{elseif $sms_list[sls].I_is_friend ==1 && $sms_list[sls].Y_is_friend !=1}>
							<span style="cursor:pointer" onclick="show('frsend','block',0,1);show('bottom','block',1,0);">添加对方为好友</span>&nbsp;|&nbsp;
							<span style="cursor:pointer" onclick="if(confirm('您确认要删除吗?')){del_sms(<{$sms_list[sls].id}>);}">删除</span>
						<{elseif $sms_list[sls].Y_is_friend ==1 && $sms_list[sls].Y_is_friend ==1}>
							<span style="cursor:pointer" onclick="javascript:window.location='<{$url}>/detail/uid/<{$smarty.session.user_info.id}>/smsid/<{$sms_list[sls].id}>/send_uid/<{$sms_list[sls].src_id}>';">查看</span>&nbsp;|&nbsp;
							<span style="cursor:pointer" onclick="if(confirm('您确认要删除吗?')){del_sms(<{$sms_list[sls].id}>);}">删除</span>
						<{/if}>
					</div>
				<{else}>
					<div style="width:110%;color:#999999;text-align:right">
						<span style="cursor:pointer" onclick="javascript:window.location='<{$url}>/detail/uid/<{$smarty.session.user_info.id}>/smsid/<{$sms_list[sls].id}>/send_uid/<{$sms_list[sls].src_id}>';">查看</span>&nbsp;|&nbsp;
						<span style="cursor:pointer" onclick="if(confirm('您确认要删除吗?')){del_sms(<{$sms_list[sls].id}>);}">删除</span>
					</div>
				<{/if}>
			</div>
		</div>
	<div class="line_nav"></div>
	<span id="send_uid" style="display:none"><{$sms_list[sls].src_id}></span>
	<span id="send_name" style="display:none"><{$sms_list[sls].src_name}></span>
	<span id="friend_uid" style="display:none"><{$sms_list[sls].src_id}></span>
	<span id="friend_name" style="display:none"><{$sms_list[sls].src_name}></span>
	<{/section}>
	<{$fpage}>
<{else}>
	暂无短信!
<{/if}>
<{/nocache}>