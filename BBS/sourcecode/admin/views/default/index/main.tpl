<{include file='public/header.tpl'}>
<script>
	if($(".info").html()==""){
		$(".info")
		.html("<a href='<{$app}>/index/main'>首页</a> >> <font class=\"Cf60\">简要统计</font>");
	}
</script>
<div class="border main">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1">
    <tr>
      <th colspan=8 >简要统计</th>
    </tr>
    <tr>
		<td>
			<p class="f_l">主题数：</p>
			<p class="f_r">
				<font><{$nums.subject[0]}></font> / <{$nums.subject[1]}>
			</p>
		</td>
		<td>
			<p class="f_l">帖子数：</p>
			<p class="f_r">
				<font><{$nums.comment[0]}></font> / <{$nums.comment[1]}>
			</p>
		
		</td>
		<td>
			<p class="f_l">用户数：</p>
			<p class="f_r">
				<font><{$nums.user[0]}></font> / <{$nums.user[1]}>
			</p>
		</td>  
		<td>
			<p class="f_l">相册数：</p>
			<p class="f_r">
				<font><{$nums.album[0]}></font> / <{$nums.album[1]}>
			</p>
		</td>
    </tr>

    <tr>
		<td>
			<p class="f_l">说说数：</p>
			<p class="f_r">
				<font><{$nums.speak[0]}></font> / <{$nums.speak[1]}>
			</p>
		</td>
		<td>
			<p class="f_l">留言数：</p>
			<p class="f_r">
				<font><{$nums.message[0]}></font> / <{$nums.message[1]}>
			</p>
		</td>
		<td>
			<p class="f_l">站内短信数：</p>
			<p class="f_r">
				<font><{$nums.sms[0]}></font> / <{$nums.sms[1]}>
			</p>
		</td>
		<td>
			<p class="f_l">公告数：</p>
			<p class="f_r">
				<font><{$nums.notice[0]}></font> / <{$nums.notice[1]}>
			</p>
		</td>

    </tr>
    <tr>
      <th colspan=8 >服务器信息</th>
    </tr>
    <tr>
      <td >服务器操作系统：</td>
      <td><{$server_info.sys}></td>
      <td>Web服务器：</td>
      <td><{$server_info.apache}></td>
    </tr>
    <tr>
      <td>PHP版本：</td>
      <td><{$server_info.php}></td>
      <td>MySQL版本：</td>
      <td><{$server_info.mysql_version}></td>
    </tr>
    <tr>
      <td >GD库版本：</td>
      <td><{$server_info.gd_version}></td>
      <td>文件上传最大值：</td>
      <td><{$server_info.upload_file_maxsize}></td>
    </tr>
    <tr>
      <td>网站字符编码：</td>
      <td>UTF-8</td>
      <td>时区设置：</td>
      <td>PRC</td>
    </tr>
  </table>
</div>
<{include file='public/footer.tpl'}>
