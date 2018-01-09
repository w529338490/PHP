// Author:xuchunyan
// Copyright:宜天网

//分页
function QueryString(item){
	var sValue=location.search.match(new RegExp("[\?\&]"+item+"=([^\&]*)(\&?)","i"))
	return sValue?sValue[1]:sValue
}
var count = 600;
var perpage = 20;
var currentpage = QueryString("page");
if (currentpage==null){
	currentpage = 1;
}else{
	currentpage = parseInt(currentpage);
}
var pagecount = Math.floor(count/perpage);
var pagestr = "";
var breakpage = 4;
var currentposition = 4;
var breakspace = 2;
var maxspace = 4;
var prevnum = currentpage-currentposition;
var nextnum = currentpage+currentposition;
if(prevnum<1) prevnum = 1;
if(nextnum>pagecount) nextnum = pagecount;
pagestr += (currentpage==1)?'<span class="prev prev1"></span>':'<a class="prev" href="?page='+(currentpage-1)+'"></a>';
if(prevnum-breakspace>maxspace){
	for(i=1;i<=breakspace;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
	pagestr += '<span class="break">...</span>';
	for(i=pagecount-breakpage+1;i<prevnum;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
}else{
	for(i=1;i<prevnum;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
}
for(i=prevnum;i<=nextnum;i++){
	pagestr += (currentpage==i)?'<span class="thispage">'+i+'</span>':'<a href="?page='+i+'">'+i+'</a>';
}
if(pagecount-breakspace-nextnum+1>maxspace){
	for(i=nextnum+1;i<=breakpage;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
	pagestr += '<span class="break">...</span>';
	for(i=pagecount-breakspace+1;i<=pagecount;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
}else{
	for(i=nextnum+1;i<=pagecount;i++)
		pagestr += '<a href="?page='+i+'">'+i+'</a>';
}
pagestr += (currentpage==pagecount)?'<span class="next">下一页</span>':'<a class="next" href="?page='+(currentpage+1)+'">下一页</a>';
try{
document.getElementById("page").innerHTML = pagestr;
}catch(e){}