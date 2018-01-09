<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">添加新相册
						<span><a href="<{$url}>/index/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>">返回相册列表</a></span>
					</div>
					<div class="column_content">
						<form action="<{$url}>/insert_album/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>" method="post">
							<table width="100%">
								<tr>
									<td style="color:#444" height="50px" width="150px" align="center">相册名称</td>
									<td align="left">
										<input type="text" name="name" size="20" />
									</td>
								</tr>
								<tr>
									<td style="color:#444" height="50px" width="150px">隐私设置</td>
									<td align="left">
										<select name="authority">
											<option value="1">完全公开</option>
											<option value="0">仅自己可见</option>
											<option value="2">仅注册会员可见</option>
										</select>
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="left" height="50px"><input type="submit" value="添加相册" class="pn"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>