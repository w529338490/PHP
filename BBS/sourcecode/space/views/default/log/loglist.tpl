<{nocache}>
	<{if $ldata}>
		<{section loop=$ldata name="lls"}>
		<dl>
			<dt class="log_title"><a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$ldata[lls].id}>"><{$ldata[lls].title}></a><span><{$ldata[lls].ptime|chinadate:"Y-m-d"}></span></dt>
			<dd class="log_content"><{$ldata[lls].content|html_decode|truncate:300:"..."|html_deltags}></dd>
			<dd class="log_show">
			<div style="float:left;">
			<a href="<{$url}>/mod/uid/<{$smarty.get.uid}>/lid/<{$ldata[lls].id}>">编辑</a><span style="margin:0 5px;">|</span><a href="javascript:;" onclick="delete_log(<{$ldata[lls].id}>)">删除</a>&nbsp;IP:<{$ldata[lls].ip|ip}>
			</div>
			<div style="float:right;">
				<a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$ldata[lls].id}>">(<{$ldata[lls].click_num}>)次阅读</a><span style="margin:0 5px;">|</span><a href="<{$app}>/log/content/uid/<{$smarty.get.uid}>/lid/<{$ldata[lls].id}>#pl">(<{$ldata[lls].ctotal}>)次评论</a>
			</div>
			<div style="clear:both"></div>
			</dd>
		</dl>
		<div class="line_nav"></div>
	<{/section}>
	<{$fpage}>
	<{else}>
	暂未发表日志!
	<{/if}>
<{/nocache}>