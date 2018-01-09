<{include file="public/header.tpl"}>
<{nocache}>
	<script type="text/javascript">
		Ajax().get("<{$url}>/read/uid/<{$smarty.session.user_info.id}>/smsid/<{$smarty.get.smsid}>");
	</script>
<{/nocache}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
						<div class="column_title">详细内容</div>
						<div class="column_content">
							<div class="message_content">
								<div class="avar_left">
								<a href="<{$app}>/index/index/uid/<{nocache}><{$sms_detail.src_id}><{/nocache}>">
									<img src="<{$public}>/uploads/user/s_<{nocache}><{$sms_detail.src_avar}><{/nocache}>" width="48px" height="48px"></div>
								</a>
								<div class="content_right" style="width:550px;">
									<div class="title">
									<a href="<{$app}>/index/index/uid/<{nocache}><{$sms_detail.src_id}><{/nocache}>"><{nocache}><{$sms_detail.src_name}><{/nocache}></a>
									<span><{nocache}><{$sms_detail.ptime|chinadate:"Y-m-d H:i:s"}><{/nocache}></span>
									</div>
									<div class="content"><{nocache}><{$sms_detail.content|html_decode}><{/nocache}></div>
								</div>
							</div>
						<div class="line_nav"></div>
						<{nocache}>
							<{if $sms_detail.sms_sort!=2}>
							<p align="right"><a href="javascript:void(0);" onclick="show('pmsend','block',0,1);show('bottom','block',1,0);getValue();">回复</a>
							<a href="javascript:void(0);" onclick="javascript:if(confirm('您确认要删除吗?')){window.location='<{$url}>/delsms/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>/smsid/<{nocache}><{$sms_detail.id}><{/nocache}>'};">删除</a>
							<a href="javascript:void(0);" onclick="window.history.back();">返回</a></p>
							<{else}>
								<p align="right"><a href="javascript:void(0);" onclick="window.history.back();">返回</a>
								</p>
							<{/if}>
						<{/nocache}>
						<span id="send_uid" style="display:none"><{nocache}><{$sms_detail.src_id}><{/nocache}></span>
						<span id="send_name" style="display:none"><{nocache}><{$sms_detail.src_name}><{/nocache}></span>
						<{include file="sms/send.tpl"}>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>