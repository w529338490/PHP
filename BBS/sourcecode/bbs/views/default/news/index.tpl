<{include file="public/header.tpl"}>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/news_list.css" />
<script src="<{$res}>/js/common.js"></script>
<div id="main">
	<div id="nav_chain_box">
		<h2>板块导航</h2>	
		<{section loop=$zone_board_list name='zb'}>
			<dl>
				<dt><{$zone_board_list[zb].name}></dt>
				<{section loop=$zone_board_list[zb].sub_board name='sb'}>
					<dd>
						<{if $smarty.get.bid == $zone_board_list[zb].sub_board[sb].id}>
							<a href="<{$app}>/subject/index/bid/<{$zone_board_list[zb].sub_board[sb].id}>" style="color:#F26C4F">
						<{else}>
							<a href="<{$app}>/subject/index/bid/<{$zone_board_list[zb].sub_board[sb].id}>">
						<{/if}>
							<{$zone_board_list[zb].sub_board[sb].name}>
							</a>
					</dd>
				<{/section}>
			</dl>
		<{/section}>
	</div>
	<div id="news">
		<table width="100%" border="0" cellspacing='0'>
			<tr>
				<th style="width:520px">标题</th>
				<th style="width:150px">时间</th>
				<th>发表者</th>
			</tr>
			<{section loop=$news name='new'}>
				<tr>
					<td>
						<a href="<{$app}>/news/info/nid/<{$news[new].id}>">
						<{$news[new].title|truncate:'80'}>
						</a>
					</td>
					<td><{$news[new].ptime|chinadate:'Y-m-d H:i:s'}></td>
					<td>
						<a href="<{$root}>/space.php/index/index/uid/<{$news[new].uid}>">
						<{$news[new].user_name}>
						</a>
					</td>
				</tr>
			<{/section}>
		</table>
		<p style="margin-top:5px"><{$fpage}></p>
	</div>
	<div class="clear"></div>
</div>
<{include file="public/footer.tpl"}>