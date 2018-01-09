<{include file='public/header.tpl'}>
	<div class="nav"></div>
	<div class="column" style="width:950px">
		<div class="column_title"><{$mess}></div>
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
		<div class="nav"></div>
		<div id="footer">
			<div class="fl">Powered By <span>SourceCode</span>&nbsp;(源代码团队)<br/>版权&copy; 2011-2012</div>
			<div class="rl"><a href='<{$root}>/index.php'>网站论坛</a> | <a href='<{$root}>/space.php/index/index/'>个人空间</a> | <a href='<{$root}>/admin.php'>管理中心</a><br/><span>EstablishTime&nbsp;:&nbsp;2011-12-15</span></div>
			<div style="height:40px;clear:both"></div>
		</div>
	</body>
</html>