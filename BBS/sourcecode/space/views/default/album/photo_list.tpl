<{nocache}>
	<div class="nav"></div>
	<div class="column">
		<div class="column_title">相册:&nbsp;&nbsp;<{$aname}>
			<span><a href="javascript:photo_hide();">关闭</a></span>
		</div>
		<div class="column_content">
			<div class="con">共有&nbsp;<b><{$total}></b>&nbsp;张照片</div>
			<div class="line_nav"></div>
			<ul class="album">
				<{if $pdata}>
					<{section loop=$pdata name="pls"}>
						<li>
							<{if $smarty.session.user_info.id == $smarty.get.uid}>
								<div class="img_b" style="margin-top:20px" onmouseover="show('edit_<{$pdata[pls].id}>','block')" onmouseout="show('edit_<{$pdata[pls].id}>','none')">
								<a href="javascript:photo_de(<{$pdata[pls].id}>);"><img src="<{$public}>/uploads/album/th_<{$pdata[pls].img_path}>" width="120px" height="120px"></a>
								<span class="edit" id="edit_<{$pdata[pls].id}>">
									<a href="javascript:void(0);"onclick="javascript:setCover(<{$smarty.get.aid}>,<{$pdata[pls].id}>);"><font color="green"><b>设为封面</b></font></a>
									<span style="color:#999999;margin:0 5px">|</span>
									<a href="javascript:void(0);" onclick="if(confirm('您确认要删除此张照片吗?')){window.location='<{$url}>/photo_del/uid/<{$smarty.get.uid}>/aid/<{$smarty.get.aid}>/pid/<{$pdata[pls].id}>'};"><font color="green"><b>删除</b></font></a>
								</span>
								</div>
							<{else}>
								<div class="img_b" style="margin-top:20px" onmouseover="show('edit_<{$pdata[pls].id}>','block');" onmouseout="show('edit_<{$pdata[pls].id}>','none')">
								<a href="javascript:photo_de(<{$pdata[pls].id}>);"><img src="<{$public}>/uploads/album/th_<{$pdata[pls].img_path}>" width="120px" height="120px"></a>
								<span class="edit" id="edit_<{$pdata[pls].id}>">
									<a href="javascript:photo_de(<{$pdata[pls].id}>);"><font color="green"><b>查看大图</b></font></a>
								</span>
								</div>
							<{/if}>
						</li>
					<{/section}>
				<{else}>
					此相册暂无照片!
				<{/if}>
				</ul>
				<div class="nav"></div>
		</div>
	</div>
<{/nocache}>