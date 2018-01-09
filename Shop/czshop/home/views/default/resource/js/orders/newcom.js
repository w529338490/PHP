// JavaScript Document

//收藏本站
  function addFavorite()
{
var url="http://www.yougou.com/";
var title="优购网-买好鞋，上优购";
ua = navigator.userAgent.toLowerCase();
if(document.all)
{
	try
	{
		window.external.AddFavorite(url,title);
	}
	catch(e)
	{
		alert("加入收藏失败，\n请您使用菜单栏或Ctrl+D收藏本站。");
	}
}
else if(window.sidebar)
{
	window.sidebar.addPanel(title,url,"")
}
else
{
	alert("加入收藏失败，\n请您使用菜单栏或Ctrl+D收藏本站。");
}
}


//设为首页
function setHomepage(){
if (document.all){
document.body.style.behavior='url(#default#homepage)';
document.body.setHomePage('http://www.yougou.com');
}else if(window.sidebar){
if(window.netscape){
try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
}catch (e){
alert( "亲爱的用户你好：\n你使用的不是IE浏览器，此操作被浏览器阻挡了，你可以选择手动设置为首页！\n给你带来的不便，本站深表歉意。" );
}
}
}
}

function qq() {
	window.open('http://b.qq.com/webc.htm?new=0&sid=800023329&eid=2188z8p8p8p8K8P8P8K80&o=www.yougou.com&q=7', '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');
	}

function gotolink(url){
	location.href=url;
	}

$(function(){
	$("#nav_menu li").not("#tuangou").css("cursor","pointer");
	$("#nav_menu li").not("#tuangou").click(function(){
	location.href=$(this).find("a").attr("href");
	})

	//头部菜单滑过效果
	$("#nav_menu li").not(".curr").hover(function(){
 	$(this).addClass("curr");},function() {
	$(this).removeClass("curr");}
	);


$("#mbrandlist ul li").hover(function(){
 	$(this).addClass("on");},function() {
	$(this).removeClass("on");}
	);

	$("#flagshipbrand").hover(function(){
 	$("#mbrandlist").show();},function() {
	$("#mbrandlist").hide();}
);
//lazyload

try{
$(".proList img").lazyload({
	effect:"fadeIn",
	placeholder:"/template/common/images/nloading.gif",
	threshold:200    // 200px 触发
});
    
/*$(".n_footinfo img").lazyload({
	effect:"fadeIn",
	placeholder:"/template/common/images/reload.gif",
	threshold:280    //
});*/
}catch(e){}
var tuangouurl=$("#tuangou a").attr("href")+"?"+ Math.round(Math.random()*9999+1);
$("#tuangou a").attr("href",tuangouurl)
var tuangouurl=$("#tuangou a").attr("href")+"?"+ Math.round(Math.random()*9999+1);
$("#tuangou a").attr("href",tuangouurl)
}) //onload



//ajax登录************************************************************************************************************

$(function(){
	try{
		var url = location.href;
		if(url.indexOf("?")==-1){
			$("#indexf").attr("class","mN_h1 mN_hh1 cur_menu");
		}else{
			var dirflagId=getQueryParameter('dirflag');
			$("#"+dirflagId).attr("class","mN_h1 mN_hh1 cur_menu");
		}
	}catch(e){}
});

function getQueryParameter(qs){
    var s = location.href;
    s = s.replace("?","?&").split("&");
    var re = "";
    for(i=1;i<s.length;i++)
        if(s[i].indexOf(qs+"=")==0)
            re = s[i].replace(qs+"=","");
    return re;
}
var $$head = function(id){return document.getElementById(id);}
//导航栏
var htmlType='div';//元素类型
var htmlIdName1='mainNav';//ID名
var htmlIdName2='subNav';
function menuFix(IdName,htmlType){
	if (!document.getElementById("mainNav")) return false;
	if (!document.getElementById("subNav")) return false;
	var sfEls = $$head(IdName).getElementsByTagName(htmlType);
	for (var i=0; i<sfEls.length; i++){
		sfEls[i].onmouseover=function(){this.className+=" N_hover"; }
		sfEls[i].onmouseout=function(){this.className=this.className.replace(new RegExp("( ?|^)N_hover\\b"), "");
		}
	}
}
menuFix(htmlIdName1,htmlType); menuFix(htmlIdName2,htmlType);
//initFunc();
//帮助中心
var hpbx=$$head("helpBox")
function showFq(){hpbx.className+=" hB_hover";}
function hiddenFq(){hpbx.className=hpbx.className.replace(new RegExp("( ?|^)hB_hover\\b"), "");}
//我的优购


//ajax登录end************************************************************************************************************

