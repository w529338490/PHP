<{include file="public/header.tpl"}>
<{include file="friend/friendsend.tpl"}>
<{include file="public/hello_box.tpl"}>
<div class="nav"></div>
<div id="content">
	<div class="speak_left">
		<div class="column">
			<div class="column_title">好友</div>
			<div class="column_content">
				<div class="con">当前共有<b><{nocache}><{$total}><{/nocache}></b>个好友</div>
				<div class="line_nav"></div>
				<div class="fr_ul">
					<{nocache}>
						<{if $fdata}>
							<{section loop=$fdata name="fls"}>
								<div class="fr_li">
									<div class="fr_avar">
									<a href="<{$app}>/index/index/uid/<{$fdata[fls].fid}>">
									<img src="<{$public}>/uploads/user/s_<{$fdata[fls].face}>" width="48px" height="48px">
									</a>
									</div>
									<span id="send_uid_<{$fdata[fls].fid}>" style="display:none"><{$fdata[fls].fid}></span>
									<span id="send_name_<{$fdata[fls].fid}>" style="display:none"><{$fdata[fls].fname}></span>
									<div class="pro">
										<div class="uname"><a href="<{$app}>/index/index/uid/<{$fdata[fls].fid}>"><{$fdata[fls].fname}></a></div>
										<div class="cre">积分数:<{$fdata[fls].fgnum}>分</div>
										<div class="opr" onmouseover="show('select_<{$fdata[fls].fid}>','block')"  onmouseout="show('select_<{$fdata[fls].fid}>','none')">互动 <img src="<{$public}>/images/arrwd.gif"></div>
										<div class="interact" id="select_<{$fdata[fls].fid}>" onmouseover="show('select_<{$fdata[fls].fid}>','block')"  onmouseout="show('select_<{$fdata[fls].fid}>','none')">
											<ul>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="<{$app}>/index/index/uid/<{$fdata[fls].fid}>">去串个门</a></li>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="<{$app}>/profile/index/uid/<{$fdata[fls].fid}>">查看资料</a></li>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="javascript:show('frlistsend','block',0,1);show('bottom','block',1,0);getValue1('<{$fdata[fls].fid}>');">发送短信</a></li>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="javascript:show('hello','block',0,1);show('bottom','block',1,0);getname('<{$fdata[fls].fid}>');">打个招呼</a></li>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="javascript:if(confirm('您确认要删除此好友吗?')){window.location.href='<{$url}>/del_friend/uid/<{$fdata[fls].fid}>'};">删除好友</a></li>
												<li onmouseover="changecolor(this);" onmouseout="returncolor(this)"><a href="javascript:if(confirm('您确认要将此好友加入黑名单吗?')){window.location.href='<{$url}>/add_black/uid/<{$fdata[fls].fid}>'};">加黑名单</a></li>
											</ul>
										</div>
									</div>
								</div>
							<{/section}>
						<{else}>
							暂无好友!
						<{/if}>
					<{/nocache}>
					<div class="nav"></div>
				</div>
			</div>
		</div>
		<div class="nav"></div><span style="width:100%;text-align:center"><{nocache}><{$fpage}><{/nocache}></span>
	</div>
	<{include file="public/right.tpl"}>
</div>
<{include file="public/footer.tpl"}>