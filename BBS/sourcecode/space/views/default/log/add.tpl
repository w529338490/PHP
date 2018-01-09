<{include file="public/header.tpl"}>
		<div class="nav"></div>
		<div id="content">
				<div class="column">
						<div class="column_title">发表日志</div>
						<div class="column_content">
							<form id="logadd" action="<{$url}>/insert/uid/<{nocache}><{$smarty.get.uid}><{/nocache}>" method="post">
								<table  align="left">
									<tr align="left">
										<td height="50px"><input type="text" id="ti" name="title" size="80" style="height:20px" />&nbsp;&nbsp;这里输入日志标题 (小于30个字符)</td>
									</tr>
									<tr align="left">
										<td height="400px" width="960px" valign="top">
										<textarea id="log_content" style="width:100%;height:400px" name="content"></textarea><font color="#aaaaaa">内容小于1000个字符</font>
										<{*<{textarea name="log_content" form="content" style="simple" default="这里填写日志内容" autoclear="true"  }>*}>
										<script>
											KindEditor.ready(function(K) {
												var editor;
												KindEditor.ready(function(K) {
													window.editor = K.create('textarea[id="log_content"]', {
														resizeType : 1,
														width:"100%",
														hright:"400px",
														allowPreviewEmoticons : false,
														allowImageUpload : false,
													});
												});
											});
											function logb(){
												var title=document.getElementById("ti");
												var textstr = editor.html();
												if(textstr!=""&&title.value!=""&&title.value.length<=30){
													document.getElementById("log_content").value=textstr;
													document.getElementById("logadd").submit();
												}else{
													alert("日志标题不能为空且标题内容不能大于30个字符!");
													return false;
												}
											}
										</script>
										</td>
									</tr>
								</table>
							</form>
							<div class="nav"></div>
							<div style="text-align:left;padding:3px;">
								<button class="pn" style="" onclick="logb()">保存发表</button>
							</div>
					</div>
				</div>
		</div>
<{include file="public/footer.tpl"}>