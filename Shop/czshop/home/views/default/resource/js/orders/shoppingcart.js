window.top.loginPop = null;
var validator = null;
window.top.isLogin = false;
var myCouponList=null;
var isCheckEmail = null;
var isCheckPhone = null;
var isCheckPhoneByOrder = false;
var oldAreaNo = null;
jQuery.validator.addMethod("phone", function(value, element) {var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;return this.optional(element) || rePhone.test(value);}, "请您输入正确格式的手机号码");
jQuery.validator.addMethod("zipcode", function(value, element) {var zipcode = /^\d{6}$/;return this.optional(element) || zipcode.test(value);}, "邮政编码格式不对");
jQuery.validator.addMethod("containSpecial",function(value, element){var containSpecial = /[(\#)(\$)(\%)(\^)(\*)(\+)(\=)(\<)(\>)(\?)]+/;return this.optional(element) || !containSpecial.test(value);}, "请输入正确格式字符");
jQuery.validator.addMethod("mobileOrPhone", function(value, element) {var reMobile = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;var rePhone=/(\d{2,5}-\d{7,8})/;return this.optional(element) || reMobile.test(value) || rePhone.test(value);}, "请输入正确格式的手机或者固定电话号码，如：0755-12345678 或 13888888888");

var cartContainer = "shoppingCartContainer";
var orderSettlementContainer="orderSettlementContainer";
var cartActionBasePath = basePath + "/yitianmall/shoppingcart/cart/";

// 删除购物车货品
function removeProduct(prodNo,isTip){
	if(isTip){
		if(!confirm("您确定要将此商品删除吗？")){return;}
	}

	//如果没有商品，跳转到首页
	if(parseInt($('#productRecordNum').val())==1){
		window.location.href = cartActionBasePath + "d_removeProduct.sc?productNo="+ prodNo;
	}

	// 异步移除商品
	$(".add_product").unbind('mouseenter mouseleave').unbind('click');
	$(".remove_product").unbind('mouseenter mouseleave').unbind('click');
	YouGou.Ajax.do_request(cartContainer,cartActionBasePath + "d_removeProduct.sc","productNo=" + prodNo,function(){
		isNewFastActiveRefreshHandler();
		calculateCart();
		//YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc",null,null);
	});
}

// 增加或减少货品数量
function changeProductNum(type,index,simpleShoppingCart){
	var oldNum = parseInt($("#oldNum_"+index).val());
	var newNum = type == "+"?oldNum + 1:oldNum - 1;
	var productNo = $("#productNo_"+index).val();
	if(newNum == 0){
		removeProduct(productNo,true);
		return;
	}

	$(".add_product").unbind('mouseenter mouseleave').unbind('click');
	$(".remove_product").unbind('mouseenter mouseleave').unbind('click');

	$("#oldNum_"+index).val(newNum);
	var param = "productNum="+ newNum +"&productNo=" + productNo + composeQueryCondition();
	if(!simpleShoppingCart){
		YouGou.Ajax.do_request(cartContainer,cartActionBasePath+"u_updateCart.sc",param,function(){
			isNewFastActiveRefreshHandler(); //是否初体验活动
			YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc",
					param,null);//更新页面下部价格部分
		});
	}else{
		param=param+"&targetUrl=yitianmall/shoppingmgt_new/simpleShoppingCart";
		YouGou.Ajax.do_request(cartContainer,cartActionBasePath+"u_updateCart.sc",param,null);
	}
}

// 初体验活动变动句柄
function isNewFastActiveRefreshHandler(){
	if(!YouGou.Util.isNull(isNewFastActiveFlag)){
		if(!isNewFastActiveFlag){
			if(isNewFastActive){
				//alert("第一件不是199，但是规则是199，刷新");
				window.location.reload();
			}
		}else{
			if(!isNewFastActive){
				//alert("第一件是199，但是规则是不199，刷新");
				window.location.reload();
			}
		}
	}
}

// 展开优惠券输入框
function spreadCouponInputArea(){
	$("#iusecoupon_p").hide();
	$("#div_coupon_number").show();
}

//打开优惠券选择器
function openCouponSelector(isForce){
	var couponNumber = $.trim($("#couponNumber").val());
	if(couponNumber=='请输入或选择一张可用的优惠券'){
		$("#couponNumber").val('');
	}

	$("#couponNumber").removeClass("Gray");
	if(myCouponList==null){
		var url=basePath+"/yitianmall/shoppingcart/cart/queryUserAvailableCoupon.sc";
		$.getJSON(url,function(data){
			myCouponList=data;
			renderCouponSelector(myCouponList,isForce);
		});
	}else{
		renderCouponSelector(myCouponList,isForce);
	}
}

//渲染优惠券选择器
function renderCouponSelector(couponList,isForce){
	var couponListHtml = [];
	couponListHtml.push('<dl style="width:512px; background:#f6f6f6; position:relative">');
	couponListHtml.push('<dd style="width:25px">&nbsp;</dd><dd style="width:118px">优惠券编号</dd>');
	couponListHtml.push('<dd style="width:90px">优惠券面额</dd><dd style="width:90px">最低消费金额</dd>');
	couponListHtml.push('<dd style="width:179px">有效期</dd><div class="couponlist_close" id="couponlist_close"></div></dl>');
	if(couponList.length==0){
		couponListHtml.push('<div class="nocoupon">抱歉，您当前账户中没有可用的优惠券，如果有线下优惠券请输入。</div>');
	}else{
		couponListHtml.push('<div style=" width:503px;height:185px; overflow:auto; float:left">');
		couponListHtml.push('<table border="0" cellpadding="0" cellspacing="0" id="coupon_list_table">');
		couponListHtml.push('<tbody>');
		for(var i=0;i<couponList.length;i++){
			var couponVo=couponList[i];
			couponListHtml.push('<tr onclick="selectMarketingCoupon(\''+couponVo.couponNumber+'\')" id="tr_'+couponVo.couponNumber+'">');
			couponListHtml.push('<td width="25"><input type="radio" name="ncoupon_id" /></td>');
			couponListHtml.push('<td width="118">'+couponVo.couponNumber+'</td>');
			couponListHtml.push('<td width="90">&yen;'+couponVo.marketingCouponScheme.parValue+'</td>');
			couponListHtml.push('<td width="90">&yen;'+couponVo.marketingCouponScheme.lowestPay+'</td>');
			couponListHtml.push('<td width="180" class="Song">'+ couponVo.useStartTime.substring(0,10));
			couponListHtml.push(' 至 '+ couponVo.useEndTime.substring(0,10) +'</td></tr>');
		}
		couponListHtml.push('</tbody></table></div>');
	}

	// 渲染优惠券列表
	if(couponList.length>0 || isForce){
		$("#coupon_list").html(couponListHtml.join('')).show();
	}
}

// 选择优惠券
function selectMarketingCoupon(couponNumber){
	$('#couponNumber').val(couponNumber);
	$("#couponNumber").addClass("Gray");
	$('#couponNumberTips').html('');
	$("#coupon_list").hide();
}

//使用优惠券
function useMarketingCoupon(){
	$("#coupon_list").hide();
	var couponNumber = $.trim($("#couponNumber").val());
	if(couponNumber.length==0 || couponNumber=='请输入或选择一张可用的优惠券'){
		$("#couponNumberTips").text("请输入优惠券号码！");
		return false;
	}
	if(couponNumber.length < 12 || couponNumber.length > 13) {
		$("#couponNumberTips").text("优惠卷格式不对！");
		return false;
	}

	$.ajax( {
		type : "POST",
		url : basePath+"/yitianmall/shoppingcart/cart/bindMarketingCoupon.sc",
		data : {"couponNumberSign" :   hex_md5(couponNumber)},
		error: function(XmlHttpRequest, textStatus, errorThrown) {
			alert("暂时无法处理，请联系客服");
		},
		success : function(data) {
			var result=	eval("("+data+")");
			if(result.key=="0"){
				//重新刷新订单结算块
				var param = "a=1" + composeQueryCondition();
				YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc",param,null);
			}else{
				$("#couponNumberTips").html(result.value);
			}
		}
	});
}

//取消使用优惠券
function cancelUseMarketingCoupon(isLogin){
	if($('#canUseCouponBtn').val()=='true'){
		YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "unbindMarketingCoupon.sc",null,null);
	}else{
		$("#couponNumber").addClass("Gray").val(isLogin?'请输入或选择一张可用的优惠券':'');
		$('#couponNumberTips').html('');
		$("#div_coupon_number").hide();
		$("#iusecoupon_p").show();
	}
}

// 弹出式用户登录or注册
function userLoginOrRegister(){
	$("#userlogin,#userlogin2").click(function(){
		window.top.loginPop = art.dialog.open(basePath + '/yitianmall/usercener/memberLoginaccount/loginPop.sc', {title: '您尚未登录',lock:true,width:560,height:272}); //iframe
    });
}

// 订单备注
function initOrderRemark(){
	$("#cancelusertalk").click(function(){
		$("#order_remark_s").parent().parent().show();
		$("#order_remark_s2").hide();
	});
	$("#order_remark_s").click(function(){
		$(this).parent().parent().hide();
		$("#order_remark_s2").show();
	});
	//使用该邮编
	$("#usethiscode").click(function(){
		$("#receivingZipCode").val($("#thispostcode").text());
	});

	//焦点切换
	$("#receivingName").keydown(function(e){
		var e = window.event?window.event:e;
		    if(e.keyCode == 9){
				if(YouGou.Util.isEmpty($("#receivingProvince").val())){
					$("#province_link").click();
					$(this).focus();
	        	}else if(YouGou.Util.isEmpty($("#receivingCity").val())){
					$("#city_link").click();
				    $(this).focus();
	        	}else if(YouGou.Util.isEmpty($("#receivingDistrict").val())){
					$("#area_link").click();
				    $(this).focus();
	        	}
			}
	});
    $("#province_select").keydown(function(e){
		var e = window.event?window.event:e;
    	if(e.keyCode == 9){
			$(this).hide();
		}
	});

	$("#showallad").click(function(){
		var adinfo;
		adinfo = $(this).text().length;
		if(adinfo>4){
			$(this).text("简易显示");
			$("#reciever_list P").each(function(index) {
				$(this).show();
			});
		}else{
			$(this).text("显示全部地址");
			$("#reciever_list P").each(function(index) {
				if(index>5&&index<($("#reciever_list P").length-2)){
					$(this).hide();
				}
			});
		}
		var addressKey = getSelectedAddress("key");
		// 更换其他地址
		if(addressKey != "user_address_otherAddress"){
			$("a[name=address_radio_update]").text("修改");
			$("#addressInfoContainer").hide();
		}
		$("#showallad").toggleClass("easy")
	});

	//配送方式
	$("input[name=deliveryWay]").bind("click",deliveryChanged);

	//支付方式
	$("input[name=payment]").bind("click",paymentChanged);
}

//计算付款方式优惠活动价格
function paymentChanged(){
//	if ($(this).attr("checked") && $(this).attr("Reduction")=="1"){
		calculateCart();		
//	}
}

//配送方式修改时的计算
function deliveryChanged(){
	//根据配送方式，修改支付方式
	$("#pay_div").show();
	if($(this).val() != 1){
		$("#payment_1").attr("checked",true);
		$('#payment_2_p').hide();
		//$('.pareal').hide();
	}else{
		$("#payment_1").attr("checked",false);
		$('#payment_2_p').show();
		dalivertyWayChangeHanlder();
	}

	calculateCart();	
}

//发货地址修改时的计算(目前的实现函数：updateServiceDeliveryWay)
function areaChanged(){
	//计算配送方式
	
	//计算支付方式
	
	calculateCart();	
}

//重新计算购物车价格
function calculateCart(){
	if (typeof(isGroupActive) != 'undefined' && isGroupActive){
		var param = "targetUrl=yitianmall/orderbysingle/orderSettlement" + composeQueryCondition();
		YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCartByGroup.sc",param,null);
	}else{
		var param = "targetUrl=yitianmall/shoppingmgt_new/orderSettlement" + composeQueryCondition();
		YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc",param,null);
	}
}

function composeQueryCondition(){
	var params = "";
	var deliveryWayRadio = $('input:radio[name="deliveryWay"]:checked').val();
	if(!YouGou.Util.isEmpty(deliveryWayRadio)){
		params += "&deliveryWay=" + deliveryWayRadio;
	}
	var paymentRadio = $('input:radio[name="payment"]:checked').val();
	if (!YouGou.Util.isEmpty(paymentRadio)){
		params += "&payment=" + paymentRadio;
	}
	return params;
}

function dalivertyWayChangeHanlder(){
	var areaNo = $('#receivingDistrict').val();
	if(!YouGou.Util.isEmpty(areaNo)){
		updateServiceDeliveryWay(areaNo);
	}else{
		//$('.pareal').hide();
	}
}

// 初始化物流地址
function initAddress(){
	var addressDom = getAddressListDom();
	$("#reciever_list").prepend(addressDom);
	// bing address changge
	bindAddressChangeEvent();
	addressChangeEventHanlder(getSelectedAddress("pk"));
	$("#reciever_list P").each(function(index) {
		if(index>4&&index<($("#reciever_list P").length-2)){
			$(this).hide();
		}
	});
	$("#addressInfoContainer").hide();
	checkPhoneByChangeAddress();
}

function getAddressListDom(){
	if(YouGou.Util.isNull(addressMap)){
		return;
	}
	// 地址template
	var addTpl = [];
  	addTpl.push('<% if (isDefault) { %>');
	addTpl.push('<p class="address_select f_yellow" id="address_radio_<%=id%>">');
	addTpl.push('<% }else {%>');
	addTpl.push('<p class="address_select" id="address_radio_<%=id%>">');
	addTpl.push('<% }%>');
	addTpl.push('<span class="r_user_name"><label for="addressRadio_<%=id%>">');
	addTpl.push('<input type="radio" name="addressRadio" addressKey="user_address_<%=id%>" addressId="<%=id%>" id="addressRadio_<%=id%>" value="address_radio_<%=id%>" <% if (isDefault) { %> checked="checked" <% }%>/>');
	addTpl.push('<%=receivingName%>');
	addTpl.push('</label></span>');
	addTpl.push('<span class="r_user_address">');
	addTpl.push('<%=receivingProvinceName%><%=receivingCityName%><%=receivingDistrictName%><%=receivingAddress%>');
	addTpl.push('</span>');
	addTpl.push('<span class="r_user_postcode">');
	addTpl.push('邮编：<%=receivingZipCode%></span>');
	addTpl.push('<span class="r_user_phone">电话：<%=receivingMobilePhone%></span>');
	addTpl.push('<span class="r_user_change">');
	addTpl.push('<a href="javascript:void(0);" id="address_radio_update_<%=id%>" name="address_radio_update" class="Blue address_update" onclick="updateAddress(\'<%=id%>\');">修改</a>');
	addTpl.push('</span>');
	addTpl.push('<br class="clear"/>');
	addTpl.push('</p>');
	var _html = [];

	var isAlipay = false;
	var is51fanli = false;
	var hasDefault = false;

	// 是否有设置快速地址
	addressMap.each(function(key,value,index){
		if(!YouGou.Util.isNull(value)){
			if(value.isDefaultAddress == 1){
				hasDefault = true;
			}
			if(value.type=="alipay"){
				isAlipay = true;
			}
			if(value.type=="51fanli"){
				is51fanli = true;
			}
		}
	});

	// 选择第一个
	if(!hasDefault){
		addressMap.each(function(key,value,index){
			if(!YouGou.Util.isNull(value) && index == 0){
				value.isDefaultAddress = 1;
			}
		});
	}

	addressMap.each(function(key,value,index){
		if(!YouGou.Util.isNull(value)){
			if(addressMap.size() == 1){
				value.isDefault = true;
			}else{
				if(isAlipay){
					value.isDefault = value.type=="alipay";
				}else if(is51fanli){
					value.isDefault = value.type=="51fanli";
				}else{
					value.isDefault = value.isDefaultAddress == 1;
				}
			}
			_html.push(YouGou.Util.tpl(addTpl.join(''), value));
		}
	});
	// 其他地址dom
	_html.push('<p class="address_select" id="address_radio_other">');
	_html.push('<span class="r_user_name">');
	_html.push('<label for="other_address_radio">');
	_html.push('<input type="radio" name="addressRadio" addressKey="otherAddress" addressId="otherAddress" id="other_address_radio" value="new_address"/>更换其他地址');
	_html.push('</label></span><br class="clear" /></p>');
	return _html.join('');
}

// 修改地址
function updateAddress(addressId){
	if(YouGou.Util.isEmpty(addressId)){
		return;
	}
	var isSelect = $("#address_radio_update_"+addressId).text() == "取消";
	if(isSelect){
		$("a[name=address_radio_update]").text("修改");
		$("#addressInfoContainer").hide();
		checkPhoneByChangeAddress();
	}else{
		$("#address_radio_p").remove();
		$("a[name=address_radio_update]").text("修改");
		$("#address_radio_update_"+addressId).text("取消");
		$("#address_radio_"+addressId).after($("#addressInfoContainer"));
		$("#addressInfoContainer").show();
		$("#addressRadio_"+addressId).attr("checked","checked");
		addressChangeEventHanlder(addressId);
		showCheckPhoneByUpdateAddress();
	}
}

//展开编辑判断是否需要验证手机号码
function showCheckPhoneByUpdateAddress(){
	var selectedAddressData = getSelectedAddress("all");
	if(YouGou.Util.isNull(selectedAddressData)){
		return;
	}
	if(selectedAddressData.data.isCheckPassPhone == "false"){
		$("#checkPhoeOrderContainer,#sendSmsOrderBtnContainer,#sendSmsOrderBtn").show();
	}else{
		$("#checkPhoeOrderContainer,#sendSmsOrderBtnContainer,#sendSmsOrderBtn").hide();
	}
}

// 切换地址
function bindAddressChangeEvent(){
	$("input[name=addressRadio]").bind("click",function(){
		$("#addressInfoContainer").hide();
		$("a[name=address_radio_update]").text("修改");
		addressChangeEventHanlder($(this).attr("addressId"));
		// 单选切换地址
		if(getSelectedAddress("key") !="user_address_otherAddress"){
			checkPhoneByChangeAddress();
		}
	});
}

// 切换地址句柄
function addressChangeEventHanlder(addressId){
	address_reset();
	var addressKey = "user_address_" + addressId;
	if(YouGou.Util.isEmpty(addressKey)){
		return;
	}
	if(YouGou.Util.isNull(addressMap)){
		return;
	}
	// 修改背景色
	$("#address_radio_"+addressId).addClass("f_yellow").siblings().removeClass("f_yellow");
	var areaNo = null;
	// 更换其他地址
	if(addressKey == "user_address_otherAddress"){
		changeOtherAddress();
		$("#address_info").css({"background":"none","height":"200px"});
		$("#addressState").val("1");
		$("#addressId").val("");
		// 其他地址根据区域切换
		areaNo = $("#receivingDistrict").val();
	}else{
		// 修改地址hidden
		var addressObj = addressMap.get(addressKey);
		$("#update_address_div").show();
		$("#addressState").val("2");
		updateAddressHiddenData(addressObj);
		//$("#address_info").css({"background":"url(/template/common/images/order_addressbg.gif) repeat-x scroll 0 0 transparent","height":"250px"});
		// 根据选择的地址切换
		areaNo = addressObj.receivingDistrict;
	}
	updateServiceDeliveryWay(areaNo);
}

// 更换
function changeOtherAddress(){
	resetAddress();
	// 修改背景色
	$("#address_radio_other").addClass("f_yellow").siblings().removeClass("f_yellow");
	$("#address_radio_other").after($("#addressInfoContainer"));
	$("#update_address_div").hide();
	$("#addressInfoContainer").show();
	$("#address_radio_p").remove();
}

// 修改地址hidden input 值
function updateAddressHiddenData(addressObj){
	if(YouGou.Util.isNull(addressObj)){
		return;
	}
	if(addressObj.type=="alipay"){
		$("#update_address_div").hide();
	}
	if(addressObj.type=="51fanli"){
		$("#update_address_div").hide();
	}
	try{
		$("#addressId").val(addressObj.id);
		$("#email").val(addressObj.email);
		$("#receivingName").val(addressObj.receivingName);
		$("#receivingAddress").val(addressObj.receivingAddress);
		$("#receivingMobilePhone").val(addressObj.receivingMobilePhone);
		Loadmyaddress(addressObj.receivingProvince,addressObj.receivingCity,addressObj.receivingDistrict);
		$("#receivingZipCode").val(addressObj.receivingZipCode);
	}catch(e){
		//console.error("修改地址hidden信息失败!");
	}
	try{
		joinChangePayTypeAndDeliveryDate(addressObj.payType,addressObj.distributionType);
	}catch(e){
		//console.error("级联修改支付方式、送货时间失败!");
	}
}

// 级联修改支付方式、送货时间
function joinChangePayTypeAndDeliveryDate(payType,deliveryDate){
	return;
	// 在线支付
	if(parseInt(payType) == 1){
		$("#payment_1").attr("checked","checked");
	}else{
		// 货到付款
		$("#payment_2").attr("checked","checked");
	}

	if(parseInt(deliveryDate) == 1){
		$("#RadioGroup2_0").attr("checked","checked");
	}else if(parseInt(deliveryDate) == 2){
		$("#RadioGroup2_1").attr("checked","checked");
	}else{
		$("#RadioGroup2_2").attr("checked","checked");
	}
}

// 保存修改地址
function saveAddress(){
	if(!$("#orderForm").validate().element("#email")){
		return;
	}
	if(!$("#orderForm").validate().element("#receivingName")){
		return;
	}
	if(!$("#orderForm").validate().element("#receivingDistrict")){
		return;
	}
	if(!$("#orderForm").validate().element("#receivingZipCode")){
		return;
	}
	if(!$("#orderForm").validate().element("#receivingAddress")){
		return;
	}
	if(!$("#orderForm").validate().element("#receivingMobilePhone")){
		return;
	}
	var addressId = getSelectedAddress("pk");
	var addressObj = getAddressInputData();
	$.ajax({
       type: "POST",
       data:{
       		"email" : addressObj.email,
       		"receivingName":addressObj.receivingName,
       		"receivingZipCode":addressObj.receivingZipCode,
       		"receivingAddress":addressObj.receivingAddress,
       		"receivingMobilePhone":addressObj.receivingMobilePhone,
       		"addressId" : addressId,
			"province" : addressObj.receivingProvince,
			"city" : addressObj.receivingCity,
			"area" : addressObj.receivingDistrict
       },
       url : basePath + "/yitianmall/usercenter/memberaddress/u_updateAddressBookAjax.sc",
       dataType : "json",
       success: function(data){
       	   if(!YouGou.Util.isNull(data)){
				if(parseInt(data.result) == 1){
					convertAddressMapData(addressId,{
						id : addressId,
						receivingName : addressObj.receivingName,
						receivingProvince : addressObj.receivingProvince,
						receivingCity : addressObj.receivingCity,
						receivingDistrict : addressObj.receivingDistrict,
						receivingProvinceName : addressObj.receivingProvinceName,
						receivingCityName : addressObj.receivingCityName,
						receivingDistrictName : addressObj.receivingDistrictName,
						receivingAddress : addressObj.receivingAddress,
						receivingMobilePhone : addressObj.receivingMobilePhone,
						constactPhone : addressObj.receivingMobilePhone,
						email : addressObj.email,
						receivingZipCode : addressObj.receivingZipCode
					});
					$("#addressInfoContainer").hide();
					//art.dialog.alert("更新成功!");
				}else{
					art.dialog.error("更新失败!");
				}
       	   }
       }
	});
}

// 用于更新地址后input数据放入Map并且重新渲染
function convertAddressMapData(addressId,addressInputObj){
	var _tempOldData = addressMap.get("user_address_"+addressId);
	if(YouGou.Util.isNull(_tempOldData)){
		return;
	}
	if(YouGou.Util.isNull(addressInputObj)){
		return;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingName)){
		_tempOldData.receivingName = addressInputObj.receivingName;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingProvince)){
		_tempOldData.receivingProvince = addressInputObj.receivingProvince;
		_tempOldData.receivingProvinceName = addressInputObj.receivingProvinceName;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingCity)){
		_tempOldData.receivingCity = addressInputObj.receivingCity;
		_tempOldData.receivingCityName = addressInputObj.receivingCityName;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingDistrict)){
		_tempOldData.receivingDistrict = addressInputObj.receivingDistrict;
		_tempOldData.receivingDistrictName = addressInputObj.receivingDistrictName;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingAddress)){
		_tempOldData.receivingAddress = addressInputObj.receivingAddress;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingMobilePhone)){
		_tempOldData.receivingMobilePhone = addressInputObj.receivingMobilePhone;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.constactPhone)){
		_tempOldData.constactPhone = addressInputObj.constactPhone;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.email)){
		_tempOldData.email = addressInputObj.email;
	}
	if(!YouGou.Util.isEmpty(addressInputObj.receivingZipCode)){
		_tempOldData.receivingZipCode = addressInputObj.receivingZipCode;
	}
	addressMap.put("user_address_"+addressId,_tempOldData);

	// 地址template
	var addTpl = [];
	addTpl.push('<span class="r_user_name"><label for="addressRadio_<%=id%>">');
	addTpl.push('<input type="radio" name="addressRadio" addressKey="user_address_<%=id%>" addressId="<%=id%>" id="addressRadio_<%=id%>" value="address_radio_<%=id%>" checked="checked"/>');
	addTpl.push('<%=receivingName%>');
	addTpl.push('</label></span>');
	addTpl.push('<span class="r_user_address">');
	addTpl.push('<%=receivingProvinceName%><%=receivingCityName%><%=receivingDistrictName%><%=receivingAddress%>');
	addTpl.push('</span>');
	addTpl.push('<span class="r_user_postcode">');
	addTpl.push('邮编：<%=receivingZipCode%></span>');
	addTpl.push('<span class="r_user_phone">电话：<%=receivingMobilePhone%></span>');
	addTpl.push('<span class="r_user_change">');
	addTpl.push('<a href="javascript:void(0);" id="address_radio_update_<%=id%>" name="address_radio_update" class="Blue address_update" onclick="updateAddress(\'<%=id%>\');">修改</a>');
	addTpl.push('</span>');
	addTpl.push('<br class="clear"/>');
	var _html = YouGou.Util.tpl(addTpl.join(''), _tempOldData);
	$("#address_radio_"+addressId).html(_html);
	bindAddressChangeEvent();
}

// 从form中获取地址信息
function getAddressInputData(){
	var obj = {
		email : $("#email").val(),
		receivingName : $("#receivingName").val(),
		receivingZipCode : $("#receivingZipCode").val(),
		receivingAddress : $("#receivingAddress").val(),
		receivingMobilePhone : $("#receivingMobilePhone").val(),
		receivingProvince : $("#receivingProvince").val(),
		receivingCity : $("#receivingCity").val(),
		receivingDistrict : $("#receivingDistrict").val(),
		receivingProvinceName : $("#receivingProvinceName").val(),
		receivingCityName : $("#receivingCityName").val(),
		receivingDistrictName : $("#receivingDistrictName").val()
	};
	return obj;
}

// 修改地址Dom级联更新
jQuery.validator.addMethod("addressUpdateJoinRule", function(value, element) {
	try{
		var addressId = getSelectedAddress("pk");
		convertAddressMapData(addressId,getAddressInputData());
		$("a[name=address_radio_update]").text("修改");
		$("#address_radio_update_"+addressId).text("取消");
	}catch(e){}
	return true;
},"");

// 手机号码验证(常规)
jQuery.validator.addMethod("checkPhoneByOrder", function(value, element) {
	// 设置同步
    $.ajaxSetup({
        async: false
    });
	$("#address_radio_p").remove();
	isCheckPhoneByOrder = true;
	var apiUrl = basePath +"/order/checkphone/checkPhoneByOrder.sc";
	$.ajax( {
		type : "POST",
		url : apiUrl,
		data : {"phone":value},
		success : function(data) {
			$("#codeCheckResult_tips").hide();
			if(parseInt(data) == 0){
				$("#checkPhoeOrderContainer,#sendSmsOrderBtnContainer,#sendSmsOrderBtn").show();
				changeCheckState(false);
				// ga need
				gaPvByCheckPhone("need");
			}else{
				$("#checkPhoeOrderContainer,#sendSmsOrderBtnContainer,#updatePhoneOrder_tips").hide();
				changeCheckState(true);
			}
		}
	});
	// 恢复异步
    $.ajaxSetup({
        async: true
    });
	return true;
},"");

function changeCheckState(flag){
	var addressObj = getSelectedAddress("all");
	if(YouGou.Util.isNull(addressObj.data) || addressObj.key =='otherAddress'){
		if(flag){
			isCheckPhoneByOrder = true;
		}else{
			isCheckPhoneByOrder = false;
		}
	}else{
		if(flag){
			addressMap.each(function(key,value,index){
				if(value.receivingMobilePhone == addressObj.data.receivingMobilePhone){
					value.isCheckPassPhone = "true";
				}
			});
		}else{
			addressMap.each(function(key,value,index){
				if(value.receivingMobilePhone == addressObj.data.receivingMobilePhone){
					value.isCheckPassPhone = "false";
				}
			});
		}
	}
}

//发送手机号码验证
function sendSMSCodeByOrder(isReceive){
	var phone = $("#receivingMobilePhone").val();
	var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;
	if(YouGou.Util.isEmpty(phone)){
		$("#receivingMobilePhone_tips").text("请输入手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}else if(!rePhone.test(phone)){
		$("#receivingMobilePhone_tips").text("请您输入正确格式的手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}
	var phoneCodeTips = null;
	var callBackFun = null;// 回调函数
	// 是否是收缩状态
	if(YouGou.Util.isNull(isReceive) || isReceive){
		phoneCodeTips = $("#phoneCodeOrder_tips");
		callBackFun = function(data){
		   if(YouGou.Util.isEmpty(data)){
       	   		phoneCodeTips.html('<font class="f_red">获取验证码失败!</font>');
       	   }else if(parseInt(data) == 2){
       	   		$("#updatePhoneOrder_tips,#codeCheckOrderResult_tips").hide();
       	   		$("#phoneCodeOrderTxt").val();
       	   		phoneCodeTips.html('&nbsp;&nbsp;验证码已发送到你手机');
       	   		$("#receivingMobilePhoneOrder_tips").removeClass("successHint");
				$("#phoneCodeOrderTxt,#checkSmsCodeOrderBtn").show();
       	   }else if(parseInt(data) == 3){
       	   		phoneCodeTips.html('<font class="f_red">对不起，获取手机验证码系统出错，请联系客服!</font>');
       	   }else if(parseInt(data) == 4){
       	   		phoneCodeTips.html('<font class="f_red">手机号码存在异常，请更换手机号码!</font>');
       	   }else if(parseInt(data) == 1){
       	   		phoneCodeTips.html('<font class="f_red">手机号码格式不正确!</font>');
       	   }else if(parseInt(data) == 5){
       	   		phoneCodeTips.html('<font class="f_red">提示：1分钟内不可重复获取验证码!</font>');
       	   		$("#codeCheckResultOrder_tips").hide();
       	   }
       	   phoneCodeTips.show();
		}
	}else{
		phoneCodeTips = $("#mobiletips");
		callBackFun = function(data){
			if(YouGou.Util.isEmpty(data)){
	   	   		phoneCodeTips.html('<font class="f_red">获取验证码失败!</font>');
	   	   }else if(parseInt(data) == 2){
	   	   		$("#codeCheckOrderResultIsReceiveError_tips,#codeCheckOrderResultIsReceiveSuccess_tips").hide();
	   	   		$("#yzcode2").val();
	   	   		phoneCodeTips.html('&nbsp;&nbsp;验证码已发送到你手机').show();
				$("#yzcode2span,#checkSmsCodeOrderIsReceiveBtn").show();
	   	   }else if(parseInt(data) == 3){
	   	   		phoneCodeTips.html('<font class="f_red">对不起，获取手机验证码系统出错，请联系客服!</font>');
	   	   }else if(parseInt(data) == 4){
	   	   		phoneCodeTips.html('<font class="f_red">手机号码存在异常，请更换手机号码!</font>');
	   	   }else if(parseInt(data) == 1){
	   	   		phoneCodeTips.html('<font class="f_red">手机号码格式不正确!</font>');
	   	   }else if(parseInt(data) == 5){
	   	   		phoneCodeTips.html('<font class="f_red">提示：1分钟内不可重复获取验证码!</font>');
	   	   		$("#codeCheckResultOrder_tips").hide();
	   	   }
	   	   phoneCodeTips.show();
		}
	}
	$.ajax({
       type: "POST",
       data:{"phone" : phone},
       url : basePath + "/order/checkphone/getPhoneCode.sc",
       success: function(data){
    	   callBackFun(data);
    	   yzdjs(isReceive);
       }
	});
}

//Timer
function Timer(interval, functor) {
	this.id = 'timer_'+Math.ceil(Math.random()*900000000+100000000);
	eval(this.id+' = this;');
	this.tid = setInterval(this.id+'.callback()',interval);
	this.functor = functor;
	this.callback = function(){
		this.functor(this);
	};
	this.clear = function(){
		clearInterval(this.tid);
	};
}

var yzmTipTimer = null;
var leftsecond=60;

function yzdjs(isReceive){
	// 是否是收缩状态
	if(YouGou.Util.isNull(isReceive) || isReceive){
		$("#sendSmsOrderBtn").hide();
		$("#yzdjs1").show();
	}else{
		$("#checkyz2").hide();
		$("#yzdjs").show();
	}
	yzmTipTimer = new Timer(1000, function(t){
		__m=parseInt((leftsecond/60)%60);
	    __s=parseInt(leftsecond%60)<=9?+"0"+parseInt(leftsecond%60).toString():parseInt(leftsecond%60);
	    var djsObj = null;
	    if(YouGou.Util.isNull(isReceive) || isReceive){
	    	djsObj = $("#yzdjs1");
		}else{
			djsObj = $("#yzdjs");
		}
	    if(__m==0){djsObj.html("&nbsp;"+__s+"秒后重新获取")}
		else{djsObj.html("&nbsp;"+__m+"分"+__s+"秒后重新获取")}
		leftsecond--;
	    if(leftsecond<0){
			if(YouGou.Util.isNull(isReceive) || isReceive){
				$("#sendSmsOrderBtn").show();
				$("#yzdjs1").hide();
			}else{
				$("#checkyz2").show();
				$("#yzdjs").hide();
			}
	        yzmTipTimer.clear();
			yzmTipTimer = null;
			leftsecond = 60;
	    }
	});
	// ga submit
	gaPvByCheckPhone("submit");
}


// 校验手机验证码
function checkSmsCodeOrder(isReceive){
	var phone = $("#receivingMobilePhone").val();
	var code = $("#phoneCodeOrderTxt").val();
	var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;
	if(YouGou.Util.isEmpty(phone)){
		$("#receivingMobilePhone_tips").text("请输入手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}else if(!rePhone.test(phone)){
		$("#receivingMobilePhone_tips").text("请您输入正确格式的手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}
	// 设置同步
    $.ajaxSetup({
        async: false
    });
	
	var codeCheckResultTips = null;
	var callBackFun = null;// 回调函数
	var isOtherAddress = false;
	var addressObj = getSelectedAddress("all");
	// 是否是收缩状态
	if((YouGou.Util.isNull(isReceive) || !isReceive) && addressObj.pk =='otherAddress'){
		codeCheckResultTips = $("#codeCheckOrderResult_tips");
		callBackFun = function(data){
			$("#phoneCodeOrder_tips").hide();
	       	   if(YouGou.Util.isEmpty(data)){
	       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
	       	   		isCheckPhoneByOrder = false;
	       	   }
	       	   if(parseInt(data) == 1){
	       	   		$("#phoneCodeOrder_tips,#phoneCodeOrderTxt,#checkSmsCodeOrderBtn,#sendSmsOrderBtn,#checkPhoeOrderContainer").hide();
	       	   		codeCheckResultTips.html('<font class="Green">验证成功</font>');
	       	   		isCheckPhoneByOrder = true;
	       	   		resetGetCode();
	       	   }else{
	       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
		       	   	isCheckPhoneByOrder = false;
	       	   }
	       	   codeCheckResultTips.show();
	       	   // ga fail or ok
	       	   if(parseInt(data) == 1){
	       		   gaPvByCheckPhone("ok");
	       	   }else{
	       		   gaPvByCheckPhone("fail");
	       	   }
		};
	}else{
		if(addressObj.pk !='otherAddress' && !isReceive){
			codeCheckResultTips = $("#codeCheckOrderResult_tips");
			callBackFun = function(data){
				$("#phoneCodeOrder_tips").hide();
		       	   if(YouGou.Util.isEmpty(data)){
		       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
		       	   		isCheckPhoneByOrder = false;
		       	   }
		       	   if(parseInt(data) == 1){
		       	   		$("#phoneCodeOrder_tips,#phoneCodeOrderTxt,#checkSmsCodeOrderBtn,#sendSmsOrderBtn,#checkPhoeOrderContainer").hide();
		       	   		codeCheckResultTips.html('<font class="Green">验证成功</font>');
		       	   		// 更新MapData值
		       	   		var addressObj = getSelectedAddress("all");
		       	   		addressMap.each(function(key,value,index){
							if(value.receivingMobilePhone == addressObj.data.receivingMobilePhone){
								value.isCheckPassPhone = "true";
							}
						});
		       	   		resetGetCode();
		       	   }else{
		       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
			       	   	isCheckPhoneByOrder = false;
		       	   }
		       	   codeCheckResultTips.show();
		       	   // ga fail or ok
		       	   if(parseInt(data) == 1){
		       		   gaPvByCheckPhone("ok");
		       	   }else{
		       		   gaPvByCheckPhone("fail");
		       	   }
			};
		}else{
			code = $("#yzcode2").val();
			codeCheckResultTips = $("#codeCheckOrderResultIsReceiveMsg_tips");
			callBackFun = function(data){
		       	   if(YouGou.Util.isEmpty(data)){
		       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
		       	   }
		       	   if(parseInt(data) == 1){
		       	   		codeCheckResultTips.html('<font class="rightmsg Green">验证成功</font>');
		       	   		$("#mobileyzarea >p").remove();
		       	   		$("#mobileyzarea").removeClass("mobileyzarea");
		       	   		// 更新MapData值
		       	   		var addressObj = getSelectedAddress("all");
		       	   		addressMap.each(function(key,value,index){
							if(value.receivingMobilePhone == addressObj.data.receivingMobilePhone){
								value.isCheckPassPhone = "true";
							}
						});
		       	   		resetGetCode();
		       	   }else{
		       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
		       	   }
		       	   codeCheckResultTips.show();
		       	   $("#checkmobile").show();
		       	   
		       	   // ga fail or ok
		       	   if(parseInt(data) == 1){
		       		   gaPvByCheckPhone("ok");
		       	   }else{
		       		   gaPvByCheckPhone("fail");
		       	   }
			};
		}
	}
	
	$.ajax({
       type: "POST",
       data:{"code" : code,"phone":phone},
       url : basePath + "/order/checkphone/checkPhoneCode.sc",
       success: function(data){
    	   callBackFun(data);
       }
	});
	
	// 设置异步
    $.ajaxSetup({
        async: true
    });
}

// Ga手机验证行为监控
function gaPvByCheckPhone(type){
	try{
		// 需要验证
		if(type == "need"){
			_gaq.push(['_trackPageview', '/vp/need.html']);
		}else if(type == "submit"){
			// 获取验证码
			_gaq.push(['_trackPageview', '/vp/submit.html']);
		}else if(type == "fail"){
			// 验证码失败
			_gaq.push(['_trackPageview', '/vp/fail.html']);
		}else if(type == "ok"){
			// 验证码成功
			_gaq.push(['_trackPageview', '/vp/ok.html']);
		}
	}catch(e){}
}

// 重置和隐藏倒计时
function resetGetCode(){
	if(yzmTipTimer != null){
		yzmTipTimer.clear();
		yzmTipTimer = null;
	}
	$("#yzdjs1").hide();
	$("#yzdjs").hide();
}

// 初始化OrderFormValidator
function initOrderFormValidator(){
	// base rules
	var rules = {
		email : {required: true,email:true},
		deliveryWay:{required:true},
		payment:{required:true},
		deliveryDate:{required:true},
		receivingName : {required: true,containSpecial:[],addressUpdateJoinRule:[]},
		receivingDistrict : {required: true,addressUpdateJoinRule:[]},
		receivingMobilePhone : {required: true,phone:[],checkPhoneByOrder:[],addressUpdateJoinRule:[]},
		receivingZipCode : {zipcode:[],addressUpdateJoinRule:[]},
		receivingAddress : {required: true,maxlength:70,containSpecial:[],addressUpdateJoinRule:[]},
		orderNoteInfo : {containSpecial:[]}
	};
	// 未登录 动态切换rules
	if(!window.top.isLogin){
		jQuery.validator.addMethod("noLoginEmailRule", function(value, element) {
			var checkEmailApiUrl = basePath +"/yitianmall/usercener/memberLoginaccount/checkEmail.sc";
			// 校验用户Email是否存在
			$.ajax( {
				type : "POST",
				url : checkEmailApiUrl,
				data : {"reg_email":value},
				success : function(data) {
					var data = eval("("+data+")");
					// 不存在
					if(parseInt(data.result) == 1){
						$("#userAccountTip,#userAccountTip2").hide();
						$("#reg_email").text(value);
						$("#userAccountTip1").show();
					}else{
						// 存在
						$("#userAccountTip,#userAccountTip1").hide();
						$("#userAccountTip2").show();
					}
				}
			});
			return true;
		},"");
		rules.email = {
			required: true,email:true,noLoginEmailRule:[]
		};
	}
	validator = $("#orderForm").validate({
		rules: rules,
		messages: {
			email : {required:"请输入常用Email",email:"请输入正确的Email,格式如：service@yougou.com"},
			deliveryWay:{required:"请选择配送方式"},
			payment:{required:"请选择支付方式"},
			deliveryDate:{required:"请选择送货时间"},
			receivingName : {required: "请输入收货人姓名"},
			receivingDistrict : {required: "请选择地区"},
			receivingMobilePhone : {required: "请输入手机或者固定电话号码"},
			receivingZipCode : {maxlength:""},
			receivingAddress : {required: "请输入详细地址",maxlength:jQuery.format("详细地址长度最多不能超过{0}位")}
		},
		onkeyup : false,
		focusInvalid: true,
		errorPlacement: function(error, element) {
			var errorHint=$("#"+element.attr("id")+"_tips");
			if($("#"+element.attr("id")).attr("type") == "radio"){
				errorHint = $("#"+element.attr("name")+"_tips");
			}
			if(YouGou.Util.isEmpty(error.text())){
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().hide();
					errorHint.html('&nbsp;').removeClass("errorHint");
				}else{
					errorHint.html('&nbsp;').removeClass("errorHint").addClass("successHint");
				}
			}else{
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().show();
					errorHint.text(error.text()).addClass("errorHint");
				}else{
					errorHint.text(error.text()).removeClass("successHint").addClass("errorHint");
				}
			}
	    },
		success: function(element) {
		},
		submitHandler: function(form) {
			submitOrder(form);
		}
	});
}

// 初始化OrderFormValidator
function initOrderFormValidatorByLogin(){
	// base rules
	var rules = {
		email : {required: true,email:true},
		deliveryWay:{required:true},
		payment:{required:true},
		deliveryDate:{required:true},
		receivingName : {required: true,containSpecial:[],addressUpdateJoinRule:[]},
		receivingDistrict : {required: true,addressUpdateJoinRule:[]},
		receivingMobilePhone : {required: true,phone:[],checkPhoneByOrder:[],addressUpdateJoinRule:[]},
		constactPhone : {containSpecial:[]},
		receivingZipCode : {zipcode:[],addressUpdateJoinRule:[]},
		receivingAddress : {required: true,maxlength:70,containSpecial:[],addressUpdateJoinRule:[]},
		orderNoteInfo : {containSpecial:[]}
	};
	validator = $("#orderForm").validate({
		rules: rules,
		messages: {
			email : {required:"请输入常用Email",email:"请输入正确的Email,格式如：service@yougou.com"},
			receivingName : {required: "请输入收货人姓名"},
			deliveryWay:{required:"请选择配送方式"},
			payment:{required:"请选择支付方式"},
			deliveryDate:{required:"请选择送货时间"},
			receivingDistrict : {required: "请选择地区"},
			receivingMobilePhone : {required: "请输入手机或者固定电话号码"},
			receivingZipCode : {maxlength:""},
			receivingAddress : {required: "请输入详细地址",maxlength:jQuery.format("详细地址长度最多不能超过{0}位")}
		},
		onkeyup : false,
		focusInvalid: true,
		errorPlacement: function(error, element) {
			var errorHint=$("#"+element.attr("id")+"_tips");
			if($("#"+element.attr("id")).attr("type") == "radio"){
				errorHint = $("#"+element.attr("name")+"_tips");
			}
			if(YouGou.Util.isEmpty(error.text())){
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().hide();
					errorHint.html('&nbsp;').removeClass("errorHint");
				}else{
					errorHint.html('&nbsp;').removeClass("errorHint").addClass("successHint");
				}
			}else{
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().show();
					errorHint.text(error.text()).addClass("errorHint");
				}else{
					errorHint.text(error.text()).removeClass("successHint").addClass("errorHint");
					var selcetedAdreesObj = $('input:radio[name="addressRadio"]:checked');
					var addressId = selcetedAdreesObj.attr("addressId");
					$("#address_radio_update_"+addressId).text("取消");
					$("#address_radio_"+addressId).after($("#addressInfoContainer"));
					$("#addressInfoContainer").show();
				}
			}
	    },
		success: function(element) {
		},
		submitHandler: function(form) {
			submitOrder(form);
		}
	});
}
var oldPhone = null;
// 初始化orderFormValidatorByLoginAndNewFastActive
function initOrderFormValidatorByLoginAndNewFastActive(){
	jQuery.validator.addMethod("userEnjoyNewFastActiveByPhone", function(value, element) {
		if(oldPhone == value){
			return true;
		}
		var apiUrl = basePath +"/active/newfast/checkPhoneQualification.sc";
		$.ajax( {
			type : "POST",
			url : apiUrl,
			data : {"phone":value},
			success : function(data) {
				$("#codeCheckResult_tips").hide();
				if(YouGou.Util.isEmpty(data)){
					return;
				}else if(parseInt(data) == 0){
					$("#enjoyNewFastActiveContainer,#sendSmsBtnContainer,#sendSmsBtn").show();
				}else{
					$("#enjoyNewFastActiveContainer,#sendSmsBtnContainer,#updatePhone_tips").hide();
					$("#isParticipateActive_tips").show();
				}
				if(isCheckPhone != value && !YouGou.Util.isEmpty(isCheckPhone)){
					$("#updatePhone_tips").show();
					YouGou.Ajax.do_request(cartContainer,cartActionBasePath+"refreshShoppingCart.sc","targetUrl=yitianmall/shoppingmgt_new/shoppingCartList",function(){
						YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc","targetUrl=yitianmall/shoppingmgt_new/orderSettlement",function(){
						});
					});
				}
				oldPhone = value;
			}
		});
		return true;
	},"");

	// base rules
	var rules = {
		email : {required: true,email:true},
		deliveryWay:{required:true},
		payment:{required:true},
		deliveryDate:{required:true},
		receivingName : {required: true,containSpecial:[]},
		receivingDistrict : {required: true},
		receivingMobilePhone : {required: true,phone:[],userEnjoyNewFastActiveByPhone:[]},
		constactPhone : {containSpecial:[]},
		receivingZipCode : {zipcode:[]},
		receivingAddress : {required: true,maxlength:70,containSpecial:[]},
		orderNoteInfo : {containSpecial:[]}
	};
	validator = $("#orderForm").validate({
		rules: rules,
		messages: {
			email : {required:"请输入常用Email",email:"请输入正确的Email,格式如：service@yougou.com"},
			receivingName : {required: "请输入收货人姓名"},
			deliveryWay:{required:"请选择配送方式"},
			payment:{required:"请选择支付方式"},
			deliveryDate:{required:"请选择送货时间"},
			receivingDistrict : {required: "请选择地区"},
			receivingMobilePhone : {required: "请输入手机号码"},
			receivingZipCode : {maxlength:""},
			receivingAddress : {required: "请输入详细地址",maxlength:jQuery.format("详细地址长度最多不能超过{0}位")}
		},
		onkeyup : false,
		focusInvalid: true,
		errorPlacement: function(error, element) {
			var errorHint=$("#"+element.attr("id")+"_tips");
			if($("#"+element.attr("id")).attr("type") == "radio"){
				errorHint = $("#"+element.attr("name")+"_tips");
			}
			if(YouGou.Util.isEmpty(error.text())){
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().hide();
					errorHint.html('&nbsp;').removeClass("errorHint");
				}else{
					errorHint.html('&nbsp;').removeClass("errorHint").addClass("successHint");
				}
			}else{
				if($("#"+element.attr("id")).attr("type") == "radio"){
					errorHint.parent().show();
					errorHint.text(error.text()).addClass("errorHint");
				}else{
					errorHint.text(error.text()).removeClass("successHint").addClass("errorHint");
					var addressId = getSelectedAddress("pk");
					$("#address_radio_update_"+addressId).text("取消");
					$("#address_radio_"+addressId).after($("#addressInfoContainer"));
					$("#addressInfoContainer").show();
				}
			}
	    },
		success: function(element) {
		},
		submitHandler: function(form) {
			submitOrder(form);
		}
	});
}

// 地址reset
function address_reset(){
	$("#address_info input").each(function(){
		$(this).val("");
		$("#"+$(this).attr("id")+"_tips").html("&nbsp;").removeClass("successHint").removeClass("errorHint");
	});
	$("#receivingDistrict_tips").html("&nbsp;").removeClass("successHint").removeClass("errorHint");
	$("#province_i,#city_i,#area_i").text("");
	$("#receivingProvince,#receivingCity,#receivingDistrict,#receivingProvinceName,#receivingCityName,#receivingDistrictName").val("");
	$("#city_link,#area_link").css('color','gray');
	$("#province_link").text("请选择省");
	$("#city_link").text("请选择城市");
	$("#area_link").text("请选择县区");
}

// 清空
function resetAddress(){
	address_reset();
	$("#email,#receivingName,#receivingZipCode,#receivingAddress,#receivingMobilePhone").val();
	$("#phoneCodeOrder_tips,#phoneCodeOrderTxt,#checkSmsCodeOrderBtn,#sendSmsOrderBtn,#checkPhoeOrderContainer").hide();
}

// ajax登录后同步用户物流地址信息
function synUserAddressData(){
	window.location.reload();
}

// ajax注册后句柄
function userAjaxRegHanlder(email){
	window.location.reload();
}

//提交订单
function submitOrder(form){
	// 验证购物车中是否有非法货品
	var warnMsg=$("div [name=num_warntips]");
	if(warnMsg.length>0){
		// 页面移动到货品栏异常提示信息处
		$('html,body').animate({scrollTop: $('#orderForm').offset().top-200},2000);

		warnMsg.fadeIn("fast").delay(2000).fadeOut("slow");
		return;
	}
	
	var orderNum=$('#orderNum').val();
	var limitOrderNum=$('#limitOrderNum').val();
	if(orderNum!='' && parseInt(orderNum)>limitOrderNum){
		alert("抱歉，每个会员每天最多下"+limitOrderNum+"单!");
		return;
	}
	
	// 未登录、无地址
	if(!window.top.isLogin || YouGou.Util.isNull(addressMap) || addressMap.size() == 0){
		if((YouGou.Util.isNull(isCheckPhoneByOrder) || !isCheckPhoneByOrder)){
			$('html,body').animate({scrollTop: $("#receivingMobilePhone").offset().top},1000);
			return;
		}
	}else{
		// 提交前校验手机号码是否验证
		var addressObj = getSelectedAddress("all");
		if(addressObj.pk =='otherAddress' && (YouGou.Util.isNull(isCheckPhoneByOrder) || !isCheckPhoneByOrder)){
			$('html,body').animate({scrollTop: $("#receivingMobilePhone").offset().top},1000);
			return;
		}else if(addressObj.data.isCheckPassPhone != 'true'){
			var tipObjTopVal = 0;
			if($("#addressInfoContainer").is(":hidden")){
				// 单选情况
				tipObjTopVal = addressObj.obj.offset().top;
			}else{
				// 展开情况
				tipObjTopVal = $("#receivingMobilePhone").offset().top;
			}
			showHideAddressByCheck();
			$('html,body').animate({scrollTop: tipObjTopVal},1000);
			return;
		}
	}
	
	$("#submi21t").attr("disabled","disabled");
	form.submit();
}

// 当地址为简易
function showHideAddressByCheck(){
	//$("#reciever_list P").each(function(index) {
	//	$(this).show();
	//});
}

// 手机号码是否参加活动
function checkPhoneQualification(){
	var flag = false;
	var isParticipateActiveTips = $("#isParticipateActive_tips");
	isParticipateActiveTips.hide();
	var checkPhoneByNewFastApiUrl = basePath +"/active/newfast/checkPhoneQualification.sc";
	// 校验用户Email是否存在
	$.ajax({
		type : "POST",
		url : checkPhoneByNewFastApiUrl,
		async : false,
		data : {"phone":$("#receivingMobilePhone").val()},
		success : function(data) {
			if(parseInt(data) == 1){
				isParticipateActiveTips.show();
				flag = true;
			}
		}
	});
	return flag;
}

// 发送手机验证码
function sendSMSCodeByNewFastActive(){
	var phone = $("#receivingMobilePhone").val();
	var email = $("#email").val();
	var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;
	var reMail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
	if(YouGou.Util.isEmpty(email)){
		$("#email_tips").text("请输入常用Email").removeClass("successHint").addClass("errorHint");
		return;
	}else if(!reMail.test(email)){
		$("#email_tips").text("请输入正确的Email,格式如：service@yougou.com").removeClass("successHint").addClass("errorHint");
		return;
	}
	if(YouGou.Util.isEmpty(phone)){
		$("#receivingMobilePhone_tips").text("请输入手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}else if(!rePhone.test(phone)){
		$("#receivingMobilePhone_tips").text("请您输入正确格式的手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}
	if(checkPhoneQualification()){
		return;
	}
	var phoneCodeTips = $("#phoneCode_tips");
	$.ajax({
       type: "POST",
       data:{"phone" : phone,"email":email},
       url : basePath + "/active/newfast/getActiveCode.sc",
       success: function(data){
       	   if(YouGou.Util.isEmpty(data)){
       	   		phoneCodeTips.html('<font class="f_red">获取验证码失败!</font>');
       	   }else if(parseInt(data) == 2){
       	   		isCheckEmail = email;
       	   		isCheckPhone = phone;
       	   		$("#updatePhone_tips").hide();
       	   		$("#phoneCodeTxt").val();
       	   		phoneCodeTips.html('&nbsp;&nbsp;验证码已发送到你手机');
       	   		sendSMSCodeByNewFastActiveHandler();
       	   }else if(parseInt(data) == 3){
       	   		phoneCodeTips.html('<font class="f_red">对不起，获取手机验证码系统出错，请联系客服!</font>');
       	   }else if(parseInt(data) == 4){
       	   		phoneCodeTips.html('<font class="f_red">手机号码存在异常，请更换手机号码!</font>');
       	   }else if(parseInt(data) == 1){
       	   		phoneCodeTips.html('<font class="f_red">手机号码格式不正确!</font>');
       	   }else if(parseInt(data) == 5){
       	   		phoneCodeTips.html('<font class="f_red">提示：3分钟内不可重复获取验证码!</font>');
       	   		$("#codeCheckResult_tips").hide();
       	   }else if(parseInt(data) == 6){
       	   		$("#email_tips").html("&nbsp;&nbsp;该Email不存在对应用户，请更换Email!").removeClass("successHint").addClass("errorHint");
       	   }
       	   phoneCodeTips.show();
       }
	});
}
// 成功获取手机验证码
function sendSMSCodeByNewFastActiveHandler(){
	$("#receivingMobilePhone_tips").removeClass("successHint");
	$("#phoneCodeTxt").show();
	$("#checkSmsCodeBtn").show();
}

// 校验手机验证码
function checkSmsCode(){
	var phone = $("#receivingMobilePhone").val();
	var code = $("#phoneCodeTxt").val();
	var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;
	if(YouGou.Util.isEmpty(phone)){
		$("#receivingMobilePhone_tips").text("请输入手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}else if(!rePhone.test(phone)){
		$("#receivingMobilePhone_tips").text("请您输入正确格式的手机号码").removeClass("successHint").addClass("errorHint");
		return;
	}
	var codeCheckResultTips = $("#codeCheckResult_tips");
	$.ajax({
       type: "POST",
       data:{"code" : code,"phone":phone,"email":$("#email").val()},
       url : basePath + "/active/newfast/checkActiveCode.sc",
       success: function(data){
       	   if(YouGou.Util.isEmpty(data)){
       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
       	   		isCheckPhoneByOrder = false;
       	   }
       	   if(parseInt(data) == 1){
       	   		$("#phoneCode_tips").hide();
       	   		$("#phoneCodeTxt").hide();
       	   		codeCheckResultTips.html('<font class="Green">验证成功，已修改商品价格</font>');
       	   		isCheckPhoneByOrder = true;
       	   		YouGou.Ajax.do_request(cartContainer,cartActionBasePath+"refreshShoppingCart.sc","targetUrl=yitianmall/shoppingmgt_new/shoppingCartList",function(){
					$("#checkSmsCodeBtn").hide();
					$("#sendSmsBtn").hide();
					YouGou.Ajax.do_request(orderSettlementContainer,cartActionBasePath + "refreshShoppingCart.sc","targetUrl=yitianmall/shoppingmgt_new/orderSettlement",function(){
					});
				});
			resetGetCode();
       	   }else{
       		   	isCheckPhoneByOrder = false;
       	   		codeCheckResultTips.html('<font class="f_red">验证码有误，请核实或重新获取</font>');
       	   }
       	   codeCheckResultTips.show();
       }
	});
}

//单选切换地址校验手机号码
function checkPhoneByChangeAddress(){
	var allData = getSelectedAddress("all");
	var data = allData.data;
	$("#address_radio_p").remove();
	// 是否验证过手机号码
	if(data.isCheckPassPhone == "false"){
		var _html = [];
		var rePhone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|2|3|5|6|7|8|9])\d{8}$/;
		// 不是手机号码
		if(!rePhone.test(data.receivingMobilePhone)){
			updateAddress(allData.pk);
		}else{
			_html.push('<div id="address_radio_p">');
			_html.push('<div class="mobileyzarea" id="mobileyzarea">');
			_html.push('<p style="padding-top:5px">');
			_html.push('<span>为了更好的为您服务，请验证手机号码，每个手机号码只验证一次。</span>');
			_html.push('<span id="checkyz2" class="fl" style="padding-left:12px">');
			_html.push('<input type="button" class="mobile_checkcode" onclick="sendSMSCodeByOrder(false);" title="获取手机验证码" style="_margin-top:3px" /></span><span class="yzdjs center none" id="yzdjs"></span>');
			_html.push('<span id="mobiletips" class="none" style="padding-left:12px">验证码已发送到你手机&nbsp;&nbsp;</span>');
			_html.push('<span id="yzcode2span" class="none"><input type="text" class="sinput Gray" value="" id="yzcode2" /></span>');
			_html.push('<span id="checkSmsCodeOrderIsReceiveBtn" class="none" style="padding-left:2px"><input type="button" value=" " class="yzbtn" onclick="checkSmsCodeOrder(true);" /></span>');
			_html.push('</p><div class="tright none" style="padding-right:10px" id="checkmobile">');
			_html.push('<span id="codeCheckOrderResultIsReceiveMsg_tips" class="f_red none">验证码有误，请核实或重新获取</span>');
			_html.push('<span id="codeCheckOrderResultIsReceiveSuccess_tips" class="rightmsg Green none">验证成功</span></div></div></div>');
			$("#address_radio_"+allData.pk).after(_html.join(''));
		}
	}
}

// 根据类型获取选中地址数据
function getSelectedAddress(type){
	var selcetedAdreesObj = $('input:radio[name="addressRadio"]:checked');
	var addressId = selcetedAdreesObj.attr("addressId");
	var addressKey = "user_address_" + addressId;
	if(YouGou.Util.isNull(type)){
		// 默认DataObj
		return addressMap.get(addressKey);
	}else if(type == "pk"){
		// 主键id
		return addressId;
	}else if(type=="id"){
		// dom id
		return addressKey;
	}else if(type == "key"){
		// Map key
		return addressKey;
	}else if(type == "obj"){
		// jquery obj
		return selcetedAdreesObj;
	}else if(type == "data"){
		// Map Data
		return addressMap.get(addressKey);
	}else if(type == "all"){
		return {pk:addressId,id:addressKey,key:addressKey,obj:selcetedAdreesObj,data:addressMap.get(addressKey)};
	}
}

//当发货地址修改时，重新评估配送方式和支付方式，并计算购物车
function updateServiceDeliveryWay(areaNo){
	//重新评估配送方式，是否支持所在区域
	var lastParam = composeQueryCondition();
	if (typeof(isGroupActive) != 'undefined' && isGroupActive){
		$('#payment_1').attr("checked",true);
	}else{
		if(YouGou.Util.isEmpty(areaNo)){
				$('#payment_1').attr("checked",false);
				$('#payment_2').attr("checked",false);
				$('#payment_2').attr("disabled","");
				//$('.pareal').hide();
				$("#notServiceAreaDesc").html('（现金支付，暂不支持刷卡。请当面验货，满意后再付款。如收货时遇到问题，请致电：<font class="f_yellow">400-6963-666</font>）');			
		}else{
			var selcetedDeliveryWayObj = $('input:radio[name="deliveryWay"]:checked');	
			var isSelected = selcetedDeliveryWayObj.val();
			if(YouGou.Util.isEmpty(isSelected) || !isSelected){
				return;
			}else{
				var selcetedDeliveryWay = $('input:radio[name="deliveryWay"]:checked').val();
				// 普通快递
				if(selcetedDeliveryWay == 1){
					var areaObj = getSelectCityObj(areaNo);
					var isPayDeliverty = 0;
					var butTheServiceArea = null;
					var notServiceArea = null;
					if(areaObj != null){
						isPayDeliverty = areaObj.isPayDeliverty;
						butTheServiceArea = areaObj.butTheServiceArea;
						notServiceArea = areaObj.notServiceArea;
					}
					//1=能货到付款
					if(isPayDeliverty == 1){
						$('#payment_1').attr("checked",false);
						$('#payment_2').attr("disabled","");
						$("#butTheServiceAreaInfo").text(butTheServiceArea);
						$("#notServiceAreaInfo").text(notServiceArea);
						//$('.pareal').show();
						$("#notServiceAreaDesc").html('（现金支付，暂不支持刷卡。请当面验货，满意后再付款。如收货时遇到问题，请致电：<font class="f_yellow">400-6963-666</font>）');
					}else{
						//$('.pareal').hide();
						$('#payment_1').attr("checked",true);
						$('#payment_2').attr("checked",false);
						$('#payment_2').attr("disabled","disabled");
						$("#notServiceAreaDesc").html('（很抱歉，<font class="f_red">'+ $("#receivingProvinceName").val()+ $("#receivingCityName").val()+ $("#receivingDistrictName").val() +'不支持货到付款</font>，请选择在线支付）');
					}
					//重新计算
					//oldAreaNo = areaNo;
				}
			}		
		}
		var currentParam = composeQueryCondition();
		if (lastParam!=currentParam)
			calculateCart();
	}
}

function initOrder(){
	if(window.top.isNewFastActive){
		initOrderFormValidatorByLoginAndNewFastActive();
		Loadmyaddress(null,null,null);
	}else{
		if(window.top.isLogin && !YouGou.Util.isNull(addressMap) && addressMap.size() > 0){
			initAddress();
		}else{
			$("#province_i,#city_i,#area_i").text("");
			$("#receivingProvince,#receivingCity,#receivingDistrict").val("");
			$("#city_link,#area_link").css('color','gray');
			Loadmyaddress(null,null,null);
		}
		if(!window.top.isLogin){
			initOrderFormValidator();
		}else{
			initOrderFormValidatorByLogin();
		}
	}
	userLoginOrRegister();
	initOrderRemark();
}