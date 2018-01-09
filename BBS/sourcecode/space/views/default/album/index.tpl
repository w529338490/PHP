<{include file="public/header.tpl"}>
<div id="photo_detail" style="display:none"></div>
<script type="text/javascript">
	function photo_list(aid){
		Ajax().get("<{$url}>/photo_list/uid/<{$smarty.get.uid}>/aid/"+aid,function(data){		
			document.getElementById("photo_list").innerHTML=data;
			show("photo_list","block");
		});
	}
	function photo_hide(){
		show("photo_list","none");
	}
	function photo_de(pid){
		Ajax().get("<{$app}>/album/photo_detail/uid/<{$smarty.get.uid}>/pid/"+pid,function(data){
			document.getElementById("photo_detail").innerHTML=data;
			show("photo_detail","block",0,1);
			show("posend","block",0,1);
			show("photo_close","block",0,1);
			show("bottom","block",1,0);
		});
	}
	function setCover(aid,pid){
		Ajax().get("<{$url}>/setCover/uid/<{$smarty.get.uid}>/aid/"+aid+"/pid/"+pid,function(data){
			document.getElementById("img_"+aid).innerHTML="<img src='<{$public}>/uploads/album/th_"+data+"' width='120px' height='80px;'>";
		});
	}
</script>

	<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column" style="backgrund-color:white">
					<div class="column_title">相册
						<{nocache}>
							<{if $smarty.session.user_info.id == $smarty.get.uid}>
								<span style="right:90px"><img src="<{$res}>/images/wall.gif" /><a href="<{$url}>/add_album/uid/<{$smarty.get.uid}>/">添加相册</a></span>
								<span><img src="<{$res}>/images/addbuddy.gif" /><a href="<{$url}>/add_photo/uid/<{$smarty.get.uid}>">上传照片</a></span>
							<{/if}>
						<{/nocache}>
					</div>
					<div class="column_content">
					<{nocache}>
						<{if $data}>
							<ul class="album">
								<{section loop=$data name="ls"}>
									<{if $data[ls].authority==1}>
										<li>
											<div class="img_b" style="height:80px;" onmouseover="show('editalbum_<{$data[ls].id}>','block');show('editalbum_<{$data[ls].id}>_span','block')" 
											onmouseout="show('editalbum_<{$data[ls].id}>','none');show('editalbum_<{$data[ls].id}>_span','none')">
												<a href="javascript:photo_list(<{$data[ls].id}>);">
													<div id="img_<{$data[ls].id}>"><img src="<{$public}>/uploads/album/th_<{$data[ls].cover_path}>" width="120px" height="80px;"></div>
												</a>
												<{if $smarty.session.user_info.id == $smarty.get.uid}>
													<div id="editalbum_<{$data[ls].id}>_span" class="edit_span">
														<a href="<{$url}>/edit_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>编辑</b></font></a>
														<span style="color:#999999;">|</span>
														<a href="<{$url}>/add_photo/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>上传</b></font></a>
														<{if $data[ls].photo_total == 0}>
															<span style="color:#999999;">|</span>
															<a href="javascript:void(0);" onclick="if(confirm('您确认要删除此相册吗?')){window.location='<{$url}>/delete_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>'}"><font color="green"><b>删除</b></font></a>
														<{/if}>
													</div>
												<{else}>
													<div id="editalbum_<{$data[ls].id}>_span" class="edit_span">
														<a href="javascript:photo_list(<{$data[ls].id}>);"><font color="green"><b>点击查看相册</b></font></a>
													</div>
												<{/if}>
												<div class="edit" id="editalbum_<{$data[ls].id}>"></div>
											</div>
											<p><a href="<{$app}>/album/photo_list/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><{$data[ls].name}></a>(<{$data[ls].photo_total}>)</p>
											<span class="vtime"><{$data[ls].ptime|chinadate:"Y-m-d"}></span>
										</li>
									<{elseif $data[ls].authority==2}>	
										<{if $smarty.session.user_info.id}>
											<li>
											<div class="img_b" style="height:80px;" onmouseover="show('editalbum_<{$data[ls].id}>','block');show('editalbum_<{$data[ls].id}>_span','block')" 
											onmouseout="show('editalbum_<{$data[ls].id}>','none');show('editalbum_<{$data[ls].id}>_span','none')">
												<a href="javascript:photo_list(<{$data[ls].id}>);">
													<div id="img_<{$data[ls].id}>"><img src="<{$public}>/uploads/album/th_<{$data[ls].cover_path}>" width="120px" height="80px;"></div>
												</a>
											<{if $smarty.session.user_info.id == $smarty.get.uid}>
												<div id="editalbum_<{$data[ls].id}>_span" class="edit_span">
													<a href="<{$url}>/edit_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>编辑</b></font></a>
													<span style="color:#999999;">|</span>
													<a href="<{$url}>/add_photo/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>上传</b></font></a>
													<{if $data[ls].photo_total == 0}>
														<span style="color:#999999;">|</span>
														<a href="javascript:void(0);" onclick="if(confirm('您确认要删除此相册吗?')){window.location='<{$url}>/delete_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>'}"><font color="green"><b>删除</b></font></a>
													<{/if}>
												</div>
											<{else}>
												<div id="edit_<{$data[ls].id}>_span" class="edit_span">
													<a href="javascript:photo_list(<{$data[ls].id}>);"><font color="green"><b>点击查看相册</b></font></a>
												</div>
											<{/if}>
												<div class="edit" id="editalbum_<{$data[ls].id}>"></div>
											</div>
											<p><a href="<{$app}>/album/photo_list/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><{$data[ls].name}></a>(<{$data[ls].photo_total}>)</p>
											<span class="vtime"><{$data[ls].ptime|chinadate:"Y-m-d"}></span>
										</li>
										<{/if}>
									<{elseif $data[ls].authority==0}>
										<{if $smarty.session.user_info.id==$smarty.get.uid}>
											<li>
											<div class="img_b" style="height:80px;" onmouseover="show('editalbum_<{$data[ls].id}>','block');show('editalbum_<{$data[ls].id}>_span','block')" 
											onmouseout="show('editalbum_<{$data[ls].id}>','none');show('editalbum_<{$data[ls].id}>_span','none')">
												<a href="javascript:photo_list(<{$data[ls].id}>);">
													<div id="img_<{$data[ls].id}>"><img src="<{$public}>/uploads/album/th_<{$data[ls].cover_path}>" width="120px" height="80px;"></div>
												</a>
											<{if $smarty.session.user_info.id == $smarty.get.uid}>
												<div id="editalbum_<{$data[ls].id}>_span" class="edit_span">
													<a href="<{$url}>/edit_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>编辑</b></font></a>
													<span style="color:#999999;">|</span>
													<a href="<{$url}>/add_photo/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>"><font color="green"><b>上传</b></font></a>
													<{if $data[ls].photo_total == 0}>
														<span style="color:#999999;">|</span>
														<a href="javascript:void(0);" onclick="if(confirm('您确认要删除此相册吗?')){window.location='<{$url}>/delete_album/uid/<{$smarty.get.uid}>/aid/<{$data[ls].id}>'}"><font color="green"><b>删除</b></font></a>
													<{/if}>
												</div>
											<{else}>
												<div id="edit_<{$data[ls].id}>_span" class="edit_span">
													<a href="javascript:photo_list(<{$data[ls].id}>);"><font color="green"><b>点击查看相册</b></font></a>
												</div>
											<{/if}>
												<div class="edit" id="editalbum_<{$data[ls].id}>"></div>
											</div>
											<p><a href="javascript:photo_list(<{$data[ls].id}>);"><{$data[ls].name|truncate:8:"..."}></a>(<{$data[ls].photo_total}>)</p>
											<span class="vtime"><{$data[ls].ptime|chinadate:"Y-m-d"}></span>
										</li>
										<{/if}>
									<{/if}>
								<{/section}>
							</ul>
						<{else}>
							暂无相册!
						<{/if}>
					<{/nocache}>
						<div class="nav"></div>
					</div>
					<div id="photo_list" style="display:none"></div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>