<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
			<div class="speak_left">
				<div class="column">
					<div class="column_title">修改相册</div>
					<div class="column_content">
						<form action="<{nocache}><{$url}>/update_album/aid/<{$data.id}>/uid/<{$smarty.get.uid}><{/nocache}>" method="post">
							<table width="100%">
								<tr>
									<td style="color:#444" height="50px" width="150px" align="center">相册名称</td>
									<td align="left">
										<input type="text" name="name" size="20" value="<{nocache}><{$data.name}><{/nocache}>" />
									</td>
								</tr>
								<tr>
									<td style="color:#444" height="50px" width="150px">隐私设置</td>
									<td align="left">
										<select name="authority">
										<{nocache}>
											<{html_options options=$authority selected=$authority_id}>
										<{/nocache}>
										</select>
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="left" height="50px"><input type="submit" value="修改相册" class="pn"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<{include file="public/right.tpl"}>
		</div>
<{include file="public/footer.tpl"}>