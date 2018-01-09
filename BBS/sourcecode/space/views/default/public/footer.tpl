		<div class="nav"></div>
		<div id="footer">
			<div class="fl">Powered By <span>SourceCode</span>&nbsp;(源代码团队)<br/>版权&copy; 2011-2012</div>
			<div class="rl"><a href='<{$root}>/index.php'>网站论坛</a> | <a href='<{$root}>/space.php/index/index/'>个人空间</a> | <a href='<{$root}>/admin.php'>管理中心</a><br/><span>EstablishTime&nbsp;:&nbsp;2011-12-15</span></div>
			<div style="height:40px;clear:both"></div>
		</div>
		<div id="bottom" class="bottom" style="height:100%;"></div>
	</body>
</html>
<{include file="public/info.tpl"}>
<{nocache}>
	<{if $smarty.get.uid=='' && $smarty.session.user_info.id==''}>
		<script type="text/javascript">
			show('login_send','block');
			show('bottom','block',true);
		</script>
	<{elseif $smarty.get.uid=='' && $smarty.session.user_info.id!=''}>
		<script>
			window.location.href="<{$app}>/index/index/uid/<{$smarty.session.user_info.id}>";
		</script>
	<{/if}>
<{/nocache}>