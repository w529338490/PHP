/**
 * 用户修改个人资料模块
 */

var userNameExist = true;

function v_userName(){
	var usernameVal = $("#username_").val();
	var tip = document.getElementById("username_tip");
	
	var reg_u = /^\w{4,20}$/;
	
	if(usernameVal.length <= 0 || usernameVal == ""||(!reg_u.test(usernameVal))){
		tip.innerHTML = "用户名由4-20位字符，可由中文、英文、数字及”_”、”-“组成";
		tip.className = "onshow";
		userNameExist = true;
		return;
	}
	if(!loadUsername(usernameVal)){
		tip.innerHTML = "用户名可用";
		tip.className = "oncorrect";
		userNameExist = false;
	}else{
		tip.innerHTML = "用户名已占用";
		tip.className = "onerror";
		userNameExist = true;
	}
}
//加载省市现 三级联动
$(document).ready(function(){
	if(readonlyState==0){
		$("#username_").blur(v_userName);
	}
	
	 var provinceOptions = $("#provinceId").options;
	 birthday.init();
	 if(date == null){
		 return;
	 }
	 var year_options = $("#year").attr("options");
	 var month_options = $("#month").attr("options");
	 var date_options = $("#date").attr("options");
	 var data_year    = date.getFullYear();
	 var data_month   = date.getMonth()+1;
	 var data_date    = date.getDate();
	 //alert(data_year+"--"+data_month+"--"+data_date);
//	alert(date.getFullYear());
	 
	 //alert(parseInt(year_options[1].value)==data_year);
	 //判断年份
	 for(var i = 0 ; i < year_options.length ; i++){
	 	
	 	if( year_options[i].value == (data_year<10?"0"+data_year:""+data_year)){
	 		year_options[i].selected=true;
	 		break;
	 	} 
	 }
	 
	 birthday.yearChangeEvent();
	 //判断月份
	 for(var i = 0 ; i <month_options.length ; i++){
	 	if(month_options[i].value == (data_month<10?"0"+data_month:""+data_month)){
	 		month_options[i].selected=true;
	 		break;
	 	}
	 }
	 birthday.monthChangeEvent();
	 //判断天
	 for(var i = 0 ; i <date_options.length ; i++){
	 	if(date_options[i].value == (data_date<10?"0"+data_date:""+data_date)){
	 		date_options[i].selected=true;
	 		break;
	 	}
	 }
	 
	
	 
	 //$("#email_").blur(v_email);
	 
	
});

/*
function v_email(){
	 var e_val = $("#email_").val();
	 var tip = document.getElementById("email_tip");
	 if(reg.email.test(e_val)){
			$.ajax( {
				type : "POST",
				async : false,
				url : basePath+"/yitianmall/usercener/memberLoginaccount/validateEmail.sc?email="+e_val,
				success : function(data) {
					if("exist"==data){
						 tip.className = "onerror";
						 tip.innerHTML = "检查邮箱已占用，请输入其他邮箱!";
						 emailValidate = false;
					}else{
						 tip.className = "oncorrect";
						 tip.innerHTML = "";
						 emailValidate =true;
					}
				}
			});
			
		
	 }else{
		 tip.className = "onerror";
		 tip.innerHTML = "邮箱格式错误!格式如:zhangsan@163.com";
		 emailValidate = false;
	 }
}*/
  

function loadUsername(u){
	var metaData = false;
	$.ajax( {
		type : "POST",
		async : false,
		url : basePath+"/yitianmall/usercener/memberLoginaccount/validateUsername.sc?username="+u,
		success : function(data) {
			if("exist"==data){
				metaData = true;
			}else{
				metaData = false;
			}
		}
	});
	
	return metaData;
}

var reg = new Reg();
var config={
	form:"form1",
	submit:function()
	{
		if(readonlyState==0)
		{
			v_userName();
		}
		else
		{
			userNameExist = false;
		}
		
		var n = $("#memberName_").val();
		var cIndex = $("#cityId").val();
		var pIndex = $("#district").val();

	

		if(cIndex==-1|| cIndex=='' || pIndex==-1 || pIndex=='')
		{
			alert("请选择省份，城市!");
			return false;
		}
		
		if(n.length>0&&!userNameExist)
		{
			return true;
		}else{
			return false;
		}
	},
		fields:[
		{
			name:'memberName',
			allownull:false,
			regExp:/^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]{1,10}$/,
			defaultMsg:'请输入姓名',
			focusMsg:'',
			errorMsg:'10位以内姓名,可由汉字、数字、英文组成',
			rightMsg:'',
			msgTip:'memberName_tip'
		},{
			name:'idCardNum',
			allownull:true,
			regExp:/^\d{15}|\d{18}$/,
			defaultMsg:'请输入15或18位身份号码',
			focusMsg:'',
			errorMsg:'身份证号码输入不正确',
			rightMsg:'',
			msgTip:'idCardNum_tip'
		},{
			name:'telephoneNum',
			allownull:true,
			regExp:/(\d{2,5}-\d{7,8})/,
			defaultMsg:'请输入正确的电话,格式:区号-电话号码',
			focusMsg:'',
			errorMsg:'请输入正确的电话,格式:0755-3389111',
			rightMsg:'',
			msgTip:'telephoneNum_tip'
		},{
			name:'mobilePhoneNum',
			allownull:true,
			regExp:/^(13|15|18)[0-9]{9}$/,
			defaultMsg:'请输入11位手机号码',
			focusMsg:'',
			errorMsg:'手机号码为11位',
			rightMsg:'',
			msgTip:'mobilePhoneNum_tip'
		},{
			name:'msnNum',
			allownull:true,
			regExp:/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
			defaultMsg:'请输入常用的MSN号码',
			focusMsg:'',
			errorMsg:'请输入正确的Msn号码',
			rightMsg:'',
			msgTip:'msnNum_tip'
		},{
			name:'qqNum',
			allownull:true,
			regExp:/^[1-9]*[1-9][0-9]*$/,
			defaultMsg:'请输入常用的QQ号码',
			focusMsg:'',
			errorMsg:'请输入正确的QQ号码',
			rightMsg:'',
			msgTip:'qqNum_tip'
		},{
			name:'zipcode',
			allownull:true,
			regExp:/^[1-9]\d{5}(?!\d)$/,
			defaultMsg:'请输入邮编',
			focusMsg:'',
			errorMsg:'请输入正确邮编',
			rightMsg:'',
			msgTip:'zipcode_tip'
		}
	]
};
Tool.onReady(function(){
		var f = new Fw(config);
		f.register();
	});