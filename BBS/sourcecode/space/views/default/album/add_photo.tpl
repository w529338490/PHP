<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">上传图片
						<span><a href="<{$url}>/index/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>">返回相册</a></span>
					</div>
					<div class="column_content">
						<form action="<{$url}>/insert_photo/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>" method="post" enctype="multipart/form-data" onsubmit="return false;" name="myform">
							<table width="100%">
								<tr>
									<td style="color:#444;font-weight:bold" height="50px" width="150px" align="center">选择相册</td>
									<td align="left">
										<select name="pa_id">
										<{nocache}>
											<{if $pa_id}>
												<{html_options options=$pa selected=$pa_id}>
											<{else}>
												<{html_options options=$pa}>
											<{/if}>
										<{/nocache}>
										</select>
										<a href="<{$url}>/add_album/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>">&nbsp;添加相册</a>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="color:#444;font-weight:bold" height="50px" width="150px">选择图片</td>
									<td align="left" id="upfile"><input type="file" name="pic[]" value="选择图片" /></td>
								</tr>
								<tr>
									<td></td>
									<td align="left" height="50px"><button class="pn" onclick="document.myform.submit()" >开始上传</button>&nbsp;&nbsp;&nbsp;<button class="pn" onclick="addnode();" >增加一个</button>&nbsp;&nbsp;&nbsp;<button class="pn" onclick="delpic();" id="del" style="display:none"> 减少一个</button></td>
								</tr>
							</table>
						</form>
						<script type="text/javascript">
							var up = document.getElementById("upfile");
							var del= document.getElementById("del");
							var i=0;
							function delpic(){
								i--;
								if(i==0)
								del.style.display="none";   
								up.removeChild(up.lastChild);
								up.removeChild(up.lastChild);
							}
							function addnode(){
								i++;
								if(i==1)
								del.style.display="inline";  
								var file = document.createElement("input");
								file.type="file";
								file.name="pic[]";
								var p=document.createElement("p");
								up.appendChild(p);
								up.appendChild(file);
							}
						</script>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>