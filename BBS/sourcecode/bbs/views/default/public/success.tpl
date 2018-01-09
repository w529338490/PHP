<{include file='public/header.tpl'}>
	<style>
		.column{
			width:100%;
			margin:0 auto;
			text-align:center;
			border:1px solid #ccc;
			margin-bottom:10px;
			padding-bottom:5px;
		}
		.column_title{
			font-size:16px;
			font-weight:700;
			height:22px;
			background:#EDF3F6;
			border-bottom:1px solid #ccc;
			padding:5px;
		}
	</style>
	<div id="main">
	<div class="column" style="width:950px">
		<div class="column_title">
			<{if $mark}>
				<span style="color:green"><{$mess}></span>
			<{else}>
				<span style="color:red"><{$mess}></span>
			<{/if}>
		</div>
			<div class="column_content">
				<{if $mark}>
					<p style="font: italic bold 2cm cursive,serif; color:green">
					<img src="<{$public}>/images/success.png" width="300px"> 
					</p>
				<{else}>
					<p style="font: italic bold 2cm cursive,serif; color:red">
					<img src="<{$public}>/images/error.png">
					</p>

				<{/if}>		
					<p>
						在( <span id="sec" style="color:blue;font-weight:bold"><{$timeout}></span> )秒后自动跳转，或直接点击 <a href="javascript:<{$location}>">这里</a> 跳转<br>
					</p>
			</div>
	</div>
	</div>
		 <script type="text/javascript">
		 		var seco=document.getElementById("sec");
				var time=<{$timeout}>;
				var tt=setInterval(function(){
						time--;
						seco.innerHTML=time;	
						if(time<=0){
							stop();
							<{$location}>
							return;
						}
					}, 1000);
				function stop(){
					clearInterval(tt);
				}
		</script>
<{include file='public/footer.tpl'}>
