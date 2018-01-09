	function setPage(url){
		//弹出一个窗体
		var win=document.getElementById("glist");

		if(typeof(cache[url])=="undefined") {
			Ajax().get(url, function(data){
				win.innerHTML=data;
				cache[url]=data;
			});
		}else{
			win.innerHTML=cache[url];
		}	
	}
