<div id="grade" class="send">
	<div class="column" style="width:400px">
		<div class="column_title" style="color:#006699">提示信息</div>
			<div class="column_content" style="overflow:hidden">
				<div id="info" style="width:380px;height:40px;padding-top:20px" ></div>
				<div id="infosec"></div>
			</div>
		<div class="close"><a href="javascript:void(0);" onclick="show('grade','none');show('bottom','none')"></a></div>
	</div>
	</div>
	<script type="text/javascript">
		function timec(t,dis){
			var seco=document.getElementById("infosec");
			seco.innerHTML="";
			var time=t;
			var tt=setInterval(function(){
				time--;
				if(dis=='y'){
					seco.innerHTML="<span style='font-family:微软雅黑;color:#777777'><font color='red'>"+time+"</font> 秒后自动关闭</span>";	
				}else{
					seco.innerHTML="";
				}
				if(time<=0){
					stop();
					show('grade','none');
					show('bottom','none');
					return;
				}
			}, 1000);
			function stop(){
				clearInterval(tt);
			}
		}
	</script>