var bool_user=bool_pass=bool_vpass=bool_email=false;
function checkuser(name){
	if(name==''){
		document.getElementById("checkuser").innerHTML="<font color='red'>用户名不能为空!</font>";
		bool_user=false;
		return;
	}
	Ajax().post(app+"/pub/check_user",{name:name},function(data){
		if(data=="1"){
			document.getElementById("checkuser").innerHTML="<font color='red'>您输入的用户名已注册!</font>";
			bool_user=false;
		}else{
			document.getElementById("checkuser").innerHTML="<font color='green'>输入正确!</font>";
			bool_user=true;
		}
	})
}

function checkemail(email){
	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if(!myreg.test(email)){
		document.getElementById("checkemail").innerHTML="<font color='red'>您输入的邮箱格式不正确!</font>";
		bool_email=false;
		return;
	}
	Ajax().post(app+"/pub/check_email",{email:email},function(data){
		if(data=="1"){
			document.getElementById("checkemail").innerHTML="<font color='red'>您输入的邮箱已注册!</font>";
			bool_email=false;
		}else{
			document.getElementById("checkemail").innerHTML="<font color='green'>输入正确!</font>";
			bool_email=true;
		}
	})
}

function checkpass(pass){
	if(pass.length<6){
		document.getElementById("checkpass").innerHTML="<font color='red'>密码不能少于六位!</font>";
		bool_pass=false;
	}else{
		document.getElementById("checkpass").innerHTML="<font color='green'>输入正确!</font>";
		bool_pass=true;
	}
}

function checkvepass(){
	var vepass=document.getElementById("vepass");
	var npass=document.getElementById("npass");
	if(vepass.value!=npass.value){
		document.getElementById("checkvpass").innerHTML="<font color='red'>两次密码输入不一致!</font>";
		bool_vpass=false;
	}else{
		document.getElementById("checkvpass").innerHTML="<font color='green'>输入正确!</font>";
		bool_vpass=true;
	}
}
function acheck(){
	if(bool_user&&bool_pass&&bool_vpass&&bool_email){
		return true;
	}else{
		return false;
	}
}

function show(name,dis,flag,t){
	document.getElementById(name).style.display=dis;
	if(flag){
		document.getElementById(name).style.height=document.body.scrollHeight+90+"px";
	}else{
		if(t){
			document.getElementById(name).style.top=(parseInt(document.documentElement.clientHeight,10)/2)+(parseInt(document.body.scrollTop,10) || parseInt(document.documentElement.scrollTop+1,10))-20+"px";
		}
	}
}
function add_visite(id){
	Ajax().get(url+"/visite/uid/"+id+"/sj/"+Math.random());
}
function changecolor(obj){
	obj.style.color="#008B00";
	obj.style.cursor="pointer";
	obj.style.backgroundColor="#E0EEEE";
}

function returncolor(obj){
	obj.style.color="#006699";
	obj.style.backgroundColor="#F8F8F8";
}
var bool_login=bool_code=false;
function checkuserexist(type,name,pass){
	Ajax().post(app+"/pub/check_user_exist",{type:type,name:name,pass:pass},function(data){
		if(data=="0"){
			document.getElementById("checkuserexist").innerHTML="<font color='red'>您输入的用户名或密码错误!</font>";
			bool_login=false;
		}else{
			document.getElementById("checkuserexist").innerHTML="<font color='green'>用户名密码输入正确!</font>";
			bool_login=true;
		}
	});
}
function checkcode(val){
	Ajax().post(app+"/pub/checkcode",{code:val},function(data){
		if(data=="1"){
			document.getElementById("checkuserexist").innerHTML="<font color='green'>验证码输入正确!</font>";
			bool_code=true;
		}else{
			document.getElementById("checkuserexist").innerHTML="<font color='red'>验证码错误!</font>";
			document.getElementById("codepic").onclick();
			bool_code=false;
		}
	});
}
function checklogin(){
	if(bool_login&&bool_code){
		return true;
	}else{
		return false;
	}
}

var browserEvent = function (obj, url, title) {  
    var e = window.event || arguments.callee.caller.arguments[0];  
    var B = {  
        IE : /MSIE/.test(window.navigator.userAgent) && !window.opera  
        , FF : /Firefox/.test(window.navigator.userAgent)  
        , OP : !!window.opera  
    };  
    obj.onmousedown = null;  
    if (B.IE) {  
        obj.attachEvent("onmouseup", function () {  
            try {  
                window.external.AddFavorite(url, title);  
                window.event.returnValue = false;  
            } catch (exp) {}  
        });  
    } else {  
        if (B.FF || obj.nodeName.toLowerCase() == "a") {  
            obj.setAttribute("rel", "sidebar"), obj.title = title, obj.href = url;  
        } else if (B.OP) {  
            var a = document.createElement("a");  
            a.rel = "sidebar", a.title = title, a.href = url;  
            obj.parentNode.insertBefore(a, obj);  
            a.appendChild(obj);  
            a = null;  
        }  
    }  
}

function copyToClipBoard(){
       var clipBoardContent="";
       clipBoardContent+="http://blog.sina.com.cn/changwei0112";
       //如果你想获取当前页面的URL
       //clipBoardContent+=document.location.href;
       if(window.clipboardData){
              window.clipboardData.clearData();
              window.clipboardData.setData("Text", clipBoardContent);
       }else if(navigator.userAgent.indexOf("Opera") != -1){
              window.location = clipBoardContent;
       }else if (window.netscape){
              try{
                     netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
              }catch (e){
                     alert("您的当前浏览器设置已关闭此功能！请按以下步骤开启此功能！\n新开一个浏览器，在浏览器地址栏输入'about:config'并回车。\n然后找到'signed.applets.codebase_principal_support'项，双击后设置为'true'。\n声明：本功能不会危极您计算机或数据的安全！");
              }
              var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
              if (!clip) return;
              var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
              if (!trans) return;
              trans.addDataFlavor('text/unicode');
              var str = new Object();
              var len = new Object();
              var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
              var copytext = clipBoardContent;
              str.data = copytext;
              trans.setTransferData("text/unicode",str,copytext.length*2);
              var clipid = Components.interfaces.nsIClipboard;
              if (!clip) return false;
              clip.setData(trans,null,clipid.kGlobalClipboard);
       }
       alert("地址已成功复制！请粘贴(ctrl+v)分享给好友\nhttp://blog.sina.com.cn/changwei0112");
       return true;
}