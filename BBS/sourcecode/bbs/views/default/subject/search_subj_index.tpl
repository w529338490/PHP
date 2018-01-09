<{include file="public/header.tpl"}>
	<style>
		#main{
			border:1px solid #CDCDCD;	
			padding-top:5px;
			margin-bottom:10px;
		}
		.subj{
			width:950px;
			margin:0 auto;
			border-bottom:1px dashed #DDE3E7;
			margin-bottom:10px;
			padding-bottom:5px;
		}
		.subj h1{
			font-size:16px;
		}
	</style>
	<div id="main">	
		<{section loop=$subj_list name='sbj'}>
		<div class="subj">
			<h1><a href="<{$app}>/subject/info/sid/<{$subj_list[sbj].id}>"><{$subj_list[sbj].title|truncate:75:'...'|html_decode}></a></h1>
			<p><b><{$subj_list[sbj].comm_num}></b>个回复 - <b><{$subj_list[sbj].click_num}></b>次查看</p>
			<p><{$subj_list[sbj].content|html_decode|truncate:200:'......'}></p>
			<p>
				<{$subj_list[sbj].ptime|chinadate:'Y-m-d H:i:s'}>
				- 
				<a href="<{$root}>/space.php/index/index/uid/<{$subj_list[sbj].uid}>"><{$subj_list[sbj].author}></a> 
				- 
				<a href="<{$app}>/subject/index/bid/<{$subj_list[sbj].bid}>"><{$subj_list[sbj].board_name}></a></p>
		</div>
		<{/section}>
		<p><{$fpage}></p>
	</div>
	
<{include file="public/footer.tpl"}>