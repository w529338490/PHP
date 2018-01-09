//
$(document).ready(function(){
	$("div#lf_bar dl dt").click(function(){
		if($(this).attr('stauts') == 'open'){
			$(this).removeClass('a1').next().slideUp(500);
			$(this).attr('stauts', 'close');
			}else{
				$(this).attr('stauts', 'open');
				$(this).addClass('a1').next().slideToggle(500);
		}
	});
});
//
function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"uchover":"";
		con.style.display=i==cursel?"block":"none";
	}
}
//购物车
function openDiv(x,s,m){
	var o_btn=document.getElementById(x);
	var m=document.getElementById(m);
	var s=document.getElementById(s);
	s.style.display="none";
	m.style.display="block";
}
function closeDiv(x,s,m){
	var o_btn=document.getElementById(x);
	var m=document.getElementById(m);
	var s=document.getElementById(s);
	s.style.display="block";
	m.style.display="none";
}

$(document).ready(function(){
	var current=0;
	var dom=$('#ucBar');
	dom.children("h5").click(function(){
		current=dom.children("h5").index($(this));
		dom.children("ul").eq(current).toggleClass('none');
		dom.children("h5").eq(current).toggleClass('sicon');
	})
})

function highlightPage(){
  		if (!document.getElementById("ucBar")) return false;
  		var myid = document.getElementById("ucBar");
  		var links = myid.getElementsByTagName("a");
  		for (var i=0; i<links.length; i++){
    		var linkurl = links[i].getAttribute("href");
    		var currenturl = window.location.href;
    		if (currenturl.indexOf(linkurl) != -1){
      			links[i].className = "select";
    			}
  			}
		}
window.onload=highlightPage;


//模态对话框初始化
(function(){
try
{
var d = art.dialog.defaults;
d.lock=true;
d.skin = ['aero'];// 预缓存皮肤，数组第一个为默认皮肤
d.plus = true;
d.height=30;
d.effect =false;	// 是否开启特效
d.showTemp = 0;
}catch(err){}
})();