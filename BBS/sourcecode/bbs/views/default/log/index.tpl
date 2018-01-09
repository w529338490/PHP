<{include file="public/header.tpl"}>
<link rel="stylesheet" type="text/css" href="<{$res}>/css/log_index.css" />
	<div id="main">	
		<{section loop=$log_list name='log'}>
			<div class="log">
				<h1>
					<a href="<{$root}>/space.php/log/content/uid/<{$log_list[log].uid}>/lid/<{$log_list[log].id}>"><{$log_list[log].title|truncate:75:'...'|html_decode}></a>
				</h1>
				<p><b><{$log_list[log].comm_num}></b>个回复 - <b><{$log_list[log].click_num}></b>次查看</p>
				<p><{$log_list[log].content|html_decode|truncate:200:'......'}></p>
				<p>
					<{$log_list[log].ptime|chinadate:'Y-m-d H:i:s'}>
					-
					<a href="<{$root}>/space.php/index/index/uid/<{$log_list[log].uid}>"><{$log_list[log].author}></a>
				</p>
			</div>			
		<{/section}>
		<p><{$fpage}></p>
	</div>
<{include file="public/footer.tpl"}>