<{nocache}>
	<{if $sdata}>
		<{section loop=$sdata name="sls"}>
		<div class="log_show">
			<div class="log_content" style="height:40px;padding:5px;"><{$sdata[sls].content|html_decode}></div>
				<{if $sdata[sls].c_content}>
					<{ section loop=$sdata[sls].c_content name="scls" }>
						<div class="re_speak">
							<span class="author" style="margin-bottom:-10px;cursor:pointer" onclick="javascript:var win=window.open('','_blank');win.location.href='<{$app}>/index/index/uid/<{$sdata[sls].c_content[scls].uid}>';"><{$sdata[sls].c_content[scls].cuname}></span></a>回复说:<br/>
							<div class="line_nav"></div>
							<span class="re_speak_content"><{$sdata[sls].c_content[scls].content}></span>
							<span class="ptime">(<{$sdata[sls].c_content[scls].ptime|chinadate:"m-d H:i:s"}>&nbsp;&nbsp;<span style="color:#c2c2c2">IP:<{$sdata[sls].c_content[scls].ip|ip}></span>)</span><br/>
							<{if $smarty.session.home_login==1 && $smarty.session.user_info.id==$smarty.get.uid }>
								<div class="opr" style="text-align:right;height:20px;cursor:pointer" onclick="del_speak_c(<{$sdata[sls].c_content[scls].id}>);">删除</div>
							<{/if}>
						</div>
					<{/section}>
				<{/if}>
				<div id="did_<{$sdata[sls].id}>" style="margin-left:15px;margin-top:10px;display:none">
					<span style="color:#6495ED">我说 : </span>
					<input id="in_<{$sdata[sls].id}>" type="text" size="70" style="height:20px;border:1px solid #cccccc" />&nbsp;&nbsp;&nbsp;
					<span style="color:#6495ED;cursor:pointer" onclick="insert_speak_c(<{$sdata[sls].id}>,<{$smarty.get.uid}>)">&nbsp;&nbsp;回复&nbsp;</span>
					|&nbsp;<span style="cursor:pointer" onclick="show('did_<{$sdata[sls].id}>','none')">&nbsp;取消&nbsp;&nbsp;</span>
				</div>
			<div style="margin-top:30px;">
				<div style="float:left;">
				<{if $smarty.session.home_login==1}>
					<span style="cursor:pointer" onclick="show('did_<{$sdata[sls].id}>','block',0,0)">回复</span>
				<{/if}>
				<{if $smarty.session.home_login==1 && $smarty.session.user_info.id==$smarty.get.uid }>
					<span>|</span>
					<span class="opr" style="cursor:pointer" onclick="del_speak(<{$sdata[sls].id}>);">删除</span>
				<{/if}>
					&nbsp;<span style="color:#c2c2c2">IP:<{$sdata[sls].ip|ip}></span>
				</div>
				<div style="float:right"><{$sdata[sls].ptime|chinadate:"m-d H:i:s"}></div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="line_nav"></div>
		<{/section}>
		<{$fpage}>
	<{else}>
	暂无说说!
	<{/if}>
<{/nocache}>