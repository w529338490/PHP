// Author:xuchunyan
// Copyright:宜天网

//定义加载函数
function addLoadEvent(func){
	var oldonload=window.onload;
	if(typeof window.onload!='function'){
		window.onload=func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		};
	}
}

var $$ = function(id){return document.getElementById(id);};

//导航栏
var htmlType='div';//元素类型
var htmlIdName1='mainNav';//ID名
var htmlIdName2='subNav';
function menuFix(IdName,htmlType){
if (!document.getElementById("mainNav")) return false;
if (!document.getElementById("subNav")) return false;
var sfEls = $$(IdName).getElementsByTagName(htmlType);
for (var i=0; i<sfEls.length; i++){
	sfEls[i].onmouseover=function(){this.className+=" N_hover"; };
	sfEls[i].onmouseout=function(){this.className=this.className.replace(new RegExp("( ?|^)N_hover\\b"), ""); }; }}
function initFunc(){ menuFix(htmlIdName1,htmlType); menuFix(htmlIdName2,htmlType); }
//addLoadEvent(initFunc);

//我的宜天
var hpbx=$$("helpBox");
function showFq(){hpbx.className+=" hB_hover";}
function hiddenFq(){hpbx.className=hpbx.className.replace(new RegExp("( ?|^)hB_hover\\b"), "");}

//滑动效果
function SubShowClass(ID,eventType,defaultID,openClassName,closeClassName){this.parentObj=SubShowClass.$$(ID);if(this.parentObj==null){throw new Error("SubShowClass(ID)参数错误:ID 对像存在!");};if(!SubShowClass.childs){SubShowClass.childs=[];}; this.ID=SubShowClass.childs.length;SubShowClass.childs.push(this);this.lock=false;this.label=[];this.defaultID=defaultID==null?0:defaultID;this.selectedIndex=this.defaultID;this.openClassName=openClassName==null?"selected":openClassName;this.closeClassName=closeClassName==null?"":closeClassName;this.mouseIn=false;var mouseInFunc=Function("SubShowClass.childs["+this.ID+"].mouseIn = true"),mouseOutFunc=Function("SubShowClass.childs["+this.ID+"].mouseIn = false");if(this.parentObj.attachEvent){this.parentObj.attachEvent("onmouseover",mouseInFunc);}else{this.parentObj.addEventListener("mouseover",mouseInFunc,false);};if(this.parentObj.attachEvent){this.parentObj.attachEvent("onmouseout",mouseOutFunc);}else{this.parentObj.addEventListener("mouseout",mouseOutFunc,false);};if(typeof(eventType)!="string"){eventType="onmousedown";};eventType=eventType.toLowerCase();switch(eventType){case "onmouseover":this.eventType="mouseover";break;case "onmouseout":this.eventType="mouseout";break;case "onclick":this.eventType="click";break;case "onmouseup":this.eventType="mouseup";break;default:this.eventType="mousedown";};this.addLabel=function(labelID,contID,parentBg,springEvent,blurEvent){if(SubShowClass.$$(labelID)==null){throw new Error("addLabel(labelID)参数错误:labelID 对像存在!");};var TempID=this.label.length;if(parentBg==""){parentBg=null;};this.label.push([labelID,contID,parentBg,springEvent,blurEvent]);var tempFunc=Function('SubShowClass.childs['+this.ID+'].select('+TempID+')');if(SubShowClass.$$(labelID).attachEvent){SubShowClass.$$(labelID).attachEvent("on"+this.eventType,tempFunc);}else{SubShowClass.$$(labelID).addEventListener(this.eventType,tempFunc,false);};if(TempID==this.defaultID){SubShowClass.$$(labelID).className=this.openClassName;if(SubShowClass.$$(contID)){SubShowClass.$$(contID).style.display="";};if(parentBg!=null){this.parentObj.style.background=parentBg;};if(springEvent!=null){eval(springEvent);}}else{SubShowClass.$$(labelID).className=this.closeClassName;if(SubShowClass.$$(contID)){SubShowClass.$$(contID).style.display="none";}};if(SubShowClass.$$(contID)){if(SubShowClass.$$(contID).attachEvent){SubShowClass.$$(contID).attachEvent("onmouseover",mouseInFunc);}else{SubShowClass.$$(contID).addEventListener("mouseover",mouseInFunc,false);};if(SubShowClass.$$(contID).attachEvent){SubShowClass.$$(contID).attachEvent("onmouseout",mouseOutFunc);}else{SubShowClass.$$(contID).addEventListener("mouseout",mouseOutFunc,false);}}};this.select=function(num,force){if(typeof(num)!="number"){throw new Error("select(num)参数错误:num 不是 number 类型!");};if(force!=true&&this.selectedIndex==num){return;};var i;for(i=0;i<this.label.length;i++){if(i==num){SubShowClass.$$(this.label[i][0]).className=this.openClassName;if(SubShowClass.$$(this.label[i][1])){SubShowClass.$$(this.label[i][1]).style.display="";};if(this.label[i][2]!=null){this.parentObj.style.background=this.label[i][2];};if(this.label[i][3]!=null){eval(this.label[i][3]);}}else if(this.selectedIndex==i||force==true){SubShowClass.$$(this.label[i][0]).className=this.closeClassName;if(SubShowClass.$$(this.label[i][1])){SubShowClass.$$(this.label[i][1]).style.display="none";};if(this.label[i][4]!=null){eval(this.label[i][4]);}}};this.selectedIndex=num;};this.autoPlay=false;var autoPlayTimeObj=null;this.spaceTime=5000;this.play=function(spTime){if(typeof(spTime)=="number"){this.spaceTime=spTime;};clearInterval(autoPlayTimeObj);autoPlayTimeObj=setInterval("SubShowClass.childs["+this.ID+"].nextLabel()",this.spaceTime);this.autoPlay=true;};this.nextLabel=function(){if(this.autoPlay==false||this.mouseIn==true){return;};var index=this.selectedIndex;index++;if(index>=this.label.length){index=0;};this.select(index);};this.stop=function(){clearInterval(autoPlayTimeObj);this.autoPlay=false;};};SubShowClass.$$=function(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")');}else{return eval('document.all.'+objName);}};

//走马观灯
function marquee(id,lh,speed,delay,index){
 var t;
 var p=false;
 var o=$$(id+"_"+index);
// o.innerHTML+=o.innerHTML;
 o.onmouseover=function(){p=true;};
 o.onmouseout=function(){p=false;};
 o.scrollTop = 0;
 function start(){
  t=setInterval(scrolling,speed);
  if(!p){ o.scrollTop += 1;}
 }
 function scrolling(){
  if(o.scrollTop%lh!=0){
   o.scrollTop += 1;
   if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0;
  }else{
   clearInterval(t);
   setTimeout(start,delay);
  }
 }
 setTimeout(start,delay);
}