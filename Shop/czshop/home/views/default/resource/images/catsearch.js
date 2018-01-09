function myrenderpager(currentpage, pagecount, buttonClickCallback,baseUrl){
	var pagestr = ""; //组装的填充HTML字符串
	var breakpage = 4; 
	var currentposition = 4; 
	var breakspace = 2; 
	var maxspace = 4; 
	var prevnum = currentpage-currentposition;
	var nextnum = currentpage+currentposition;
	if(prevnum<1) prevnum = 1;
	if(nextnum>pagecount) nextnum = pagecount;
	pagestr += (currentpage==1)?'<span class="prev1"></span>':'<a class="prev" href="'+encodeString(baseUrl)+(currentpage-1)+'" >上一页</a>';
	if(prevnum-breakspace>=maxspace){
		for(i=1;i<=breakspace;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
		pagestr += '<span class="break">...</span>';
		for(i=pagecount-breakpage+1;i<prevnum;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
	}else{
		for(i=1;i<prevnum;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
	}
	for(i=prevnum;i<=nextnum;i++){
		pagestr += (currentpage==i)?'<span class="thispage">'+i+'</span>':'<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
	}
	if(pagecount-breakspace-nextnum+1>=maxspace){
		for(i=nextnum+1;i<=breakpage;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
		pagestr += '<span class="break">...</span>';
		for(i=pagecount-breakspace+1;i<=pagecount;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
	}else{
		for(i=nextnum+1;i<=pagecount;i++)
			pagestr += '<a href="'+encodeString(baseUrl)+i+'">'+i+'</a>';
	}
	pagestr += (currentpage==pagecount)?'<span class="next1"></span>':'<a class="next" href="'+encodeString(baseUrl)+(currentpage+1)+'">下一页</a>';
	document.getElementById("page").innerHTML = pagestr;
}

function encodeString(str){
	str = encodeURI(str);
	str = encodeURI(str);
	str = encodeURI(str);
	str = encodeURI(str);
	return str;
}

function writeUrl(htmlId,htmlClass,str){
	str = encodeString(str);
	var aHtml = '<a href="'+str+'"';
	if(htmlClass){
		aHtml = aHtml + ' class="'+htmlClass+'"';
	}
	if(htmlId){
		aHtml = aHtml + ' id = "'+htmlId+'"';
	}
	aHtml = aHtml + '>';
	document.write(aHtml);
}

function freeMarkPaseInt(str){
	str = str.replace(/[,]/g,"");
	try{
		return parseInt(str);
	}catch(e){
		return 0;
	}
}
