<{include file="public/header.tpl"}>
<div class="nav"></div>
<div id="content">
	<div class="speak_left">
		<div class="column">
				<div class="column_title">站内信</div>
				<div class="column_content">
				<div id="sms"><img src='<{$public}>/images/ajax.gif' /> 加载中...</div>
				<script type="text/javascript">
					function accept_fr(send_uid){
						Ajax().post("<{$app}>/friend/accept",{send_uid:send_uid},function(data){
							if(data=='success'){
								show('accept','block',0,1);
								show('bottom','block',1,0);
								select_sms();
							}
						});
					}
					function accept_only(send_uid){
						Ajax().post("<{$app}>/friend/accept",{send_uid:send_uid},function(data){
							if(data=='success'){
								show('accept_only','block',0,1);
								show('bottom','block',1,0);
								select_sms();
							}
						});
					}
					function del_sms(sid){
						Ajax().get("<{$url}>/delsms/uid/<{$smarty.get.uid}>/smsid/"+sid,function(){
							select_sms();
							show('grade','block',0,1);
							show('bottom','block',1,0);
							document.getElementById("info").innerHTML="<img src='<{$res}>/images/recyclebin.gif' /> <span style='font-size:15px;font-weight:bold;font-family:微软雅黑,宋体;color:green;height:145px;margin-top:70px'>删除成功!</span>";
							timec(0,'n');
						});
					}
					function select_sms(){
						Ajax().get("<{$url}>/sms_list/uid/<{$smarty.get.uid}>",function(data){
							document.getElementById("sms").innerHTML=data;
								document.getElementById("frs_name").value=document.getElementById("friend_name").childNodes[0].nodeValue;
								document.getElementById("fid").value=document.getElementById("friend_uid").childNodes[0].nodeValue;
						});
					}
					function setPage(url){
						var newurl=url+"/uid/<{$smarty.get.uid}>/sj/"+Math.random();
						Ajax().get(newurl, function(data){
								document.getElementById("sms").innerHTML=data;
						});
					}
					<{nocache}>
						select_sms();
					<{/nocache}>
				</script>
			</div>
		</div>
	</div>
	<{include file="public/right.tpl"}>
</div>
<{include file='friend/accept.tpl'}>
<{include file='friend/accept_only.tpl'}>
<{include file='friend/send.tpl'}>
<{include file="public/footer.tpl"}>