<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">更新个人资料</div>
					<div class="column_content">
						<form action="<{$url}>/doedit_avar" method="post" enctype="multipart/form-data" name="editavarform" onsubmit="javascript:return false;">
							<table width="100%">
								<tr>
									<td style="color:#444" height="50px" width="150px" align="center">选择图片</td>
									<td align="left" width="300px">
										<input type="file" name="avar" />
									</td>
									<{if 1 eq 1}>
									<td align="left"><div style="border:1px solid #ccc;width:103px;height:103px;padding:3px 0 0 3px;"><img src="<{$public}>/uploads/user/m_<{nocache}><{$avar}><{/nocache}>" width="100" height="100" /></div></td>
									<{/if}>
								</tr>
									<td></td>
									<td align="left" height="50px"><button class="pn" onclick="editavarform.submit()">确认修改</button>
									<button class="pn" onclick="window.history.back()">返回</button></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>