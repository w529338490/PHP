/**
 * @author wuyang
 * @param obj
 * @return
 */
// 前端页面所有商品
var goodsShowMap = new YouGou.Util.Map();
var stock = 0;
// 校验库存
function checkStock() {
	return stock>0;
}

// 购买数量
function checkBuyCount(){
	if($("#newNum").val()==0)
		return false;
	else
		return true;
}

// 立刻购买
function buyNow(){
	if(!checkBuy()){
		return;
	}
	var itemObj = goods.goodsMap.get(getGoodsKey());
	var pId = goods.prodInfo.cId;
	var buyFormObj = $("#buyForm");
	$("#productId").val(pId);
	$("#commodityName").val(getOrderProductName(goods));
	$("#productNum").val($("#newNum").val());
	$("#productNo").val(itemObj.goodsNo);
	$("#productPrice").val(itemObj.price);
	$("#commodityPicture").val(goods.prodInfo.picThumbnail);
	$("#commodityWeight").val(itemObj.commodityWeight);
	$("#commoditySpec").val(getProdSpec());
	buyFormObj.attr("action", goods.buyUrl);
	setTimeout(function() {buyFormObj.submit();}, 0);// ie6 bug
}

// 加入购物车
function addShoppingCart(){
	if(!checkBuy()){
		return;
	}
	var itemObj = goods.goodsMap.get(getGoodsKey());
	var pId = goods.prodInfo.cId;
	var param = [];
	param.push("productId=" + pId);
	param.push("&commodityName=");
	param.push(getOrderProductName(goods));
	param.push("&productNum="+$("#newNum").val());
	param.push("&productNo="+itemObj.goodsNo);
	param.push("&productPrice="+itemObj.price);
	param.push("&commodityPicture="+goods.prodInfo.picThumbnail);
	param.push("&commodityWeight="+itemObj.commodityWeight);
	param.push("&commoditySpec="+getProdSpec());
	param.push("&commodityId="+$("#commodityId").val());
	param.push("&commodityNo="+$("#commodityNo").val());
	param.push("&firstCategoriesId="+$("#firstCategoriesId").val());
	param.push("&firstCategoriesNo="+$("#firstCategoriesNo").val());
	param.push("&firstCategoriesName="+$("#firstCategoriesName").val());
	param.push("&thirdCategoriesId="+$("#thirdCategoriesId").val());
	param.push("&thirdCategoriesNo="+$("#thirdCategoriesNo").val());
	param.push("&thirdCategoriesName="+$("#thirdCategoriesName").val());
	param.push("&brandId="+$("#brandId").val());
	param.push("&brandNo="+$("#brandNo").val());
	param.push("&styleNo="+$("#styleNo").val());
	param.push("&commodityCategoriesPath="+$("#commodityCategoriesPath").val());
	param.push("&targetUrl=/yitianmall/shoppingmgt_new/simpleShoppingCart");

	YouGou.Ajax.do_request(YouGou.Biz.ShoppingCart.cartContainer,YouGou.Biz.ShoppingCart.cartActionBasePath+"c_addProdut.sc",param.join(''),function(data){
		YouGou.Biz.ShoppingCart.cartDom = data;
		$("#priceSum").text(priceSum);
		$("#pordNum").text(pordNum);
		$("#add_to_car").show();
		setTimeout(hideGoOrderWin,3000);
	});
}

// 三秒后自动关闭
function hideGoOrderWin(){
    $("#add_to_car").animate({opacity:'hide',duration:100}, 'slow');
}



//快速购物
function quickBuy(){
	if(!checkUserLogin()){
		alert("请登录后购买");
		return;
	}else if(!checkBuy()){
		return;
	}
	var itemObj = goods.goodsMap.get(getGoodsKey());
	var pId = goods.prodInfo.cId;
	var buyFormObj = $("#buyForm");
	$("#productId").val(pId);
	$("#commodityName").val(getOrderProductName(goods));
	$("#productNum").val($("#newNum").val());
	$("#productNo").val(itemObj.goodsNo);
	$("#productPrice").val(itemObj.price);
	$("#commodityWeight").val(itemObj.commodityWeight);
	$("#commoditySpec").val(getProdSpec());
	$("#commodityPicture").val(goods.prodInfo.picThumbnail);
	buyFormObj.attr("action", goods.quickBuyUrl);
	setTimeout(function() {buyFormObj.submit();}, 0);// ie6 bug
}

function getProdSpec(){
	var prodSpec = [];
	$(".buy > p").each(function(i){
		$(this).children("span").last().children("a").filter(".select").each(function(index){
			if(i == 0){
				prodSpec.push($(this).attr("data-name"));
			}else{
				prodSpec.push(","+ $(this).attr("data-name"));
			}
		});
	});
	return prodSpec.join("");
}

function getOrderProductName(goods){
	var commodityName = [];
	commodityName.push(goods.prodInfo.cName);
	commodityName.push(" ");
	//commodityName.push(goods.prodInfo.cAlias);
	$(".buy > p").each(function(i){
		$(this).children("span").last().children("a").filter(".select").each(function(index){
			if(i == 0){
				commodityName.push($(this).attr("data-name"));
			}else{
				commodityName.push(" "+ $(this).attr("data-name"));
			}
		});
	});
	return commodityName.join("");
}

// 校验购买参数
function checkBuy(){
	$("#stockinfo").html("");
	// 是否选择规格
	if(checkSelected(true)){
		return false;
	}else if(!checkStock()){// 是否有库存
		alert("对不起,该商品没有货了!");
		return false;
	}else if(!checkBuyCount()){
		alert("请选择购买数量");
		return false;
	}else if(!checkBaseActiveRule()){
		// 活动规则
		return false;
	}
	var goodsKey = getGoodsKey();
	if(goodsKey == ""){
		return false;
	}
	var itemObj = goods.goodsMap.get(goodsKey);
	if(YouGou.Util.isNull(itemObj)){
		alert("没有该货品!");
		return false;
	}else{
		return true;
	}
}

function getGoodsByKey(){
	var goodsKey = getGoodsKey();
	if(goodsKey == ""){
		return;
	}
	var itemObj = goods.goodsMap.get(goodsKey);
	if(itemObj!=null){
		return itemObj;
	}
	return null;
}

// 修改商品数量
function updateProdCount(){
	if(stock<=0){// 是否有库存
		$("#stockinfo").html("<b class='Gray'>已售罄</b>");
		return;
	}else if(checkSelected(true)){// 是否选择规格
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>请选择尺码！</span>");
		return;
	}
	var item = getGoodsByKey();
	var maxNum = YouGou.Util.isNull(item)?0:item.stock;
	if(maxNum==0){
		return;
	}
	var oldNum = parseInt($("#oldNum").val());
	var newNum = parseInt($("#newNum").val());
	if(newNum == 1){
		$("#subtract").attr("class","subtract");
	}else{
		$("#subtract").attr("class","subtract plus_yes");
	}
	$("#stockinfo").html("");
	$("#plus").attr("class","plus plus_yes");
	if(oldNum == newNum){
		return;
	}
	if(newNum == ""){
		$("#newNum").val(oldNum);
		return;
	}
	if(parseInt(newNum) > 10 && newNum <= maxNum){
		$("#newNum").val("10");
		$("#oldNum").val("10");
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>一次最多购买10件</span>");
		$("#plus").attr("class","plus");
		hidestock();
		return;
	}
	if(parseInt(newNum)>maxNum){
		$("#newNum").val(maxNum);
		$("#oldNum").val(maxNum);
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>抱歉！您购买的数量超过库存量！</span>");
		$("#plus").attr("class","plus");
		hidestock();
		return;
	}
	$("#newNum").val(newNum);
	$("#oldNum").val(newNum);

}

var goodsInfoTipTimer = null;

function hidestock(){
	$("#stockinfo").show();
	if(goodsInfoTipTimer == null){
		goodsInfoTipTimer = new Timer(3000, function(t){
				$("#stockinfo").animate({opacity:'hide',duration:100}	, 'slow');
				goodsInfoTipTimer.clear();
       	goodsInfoTipTimer = null;
		});
	}
}


// +-商品数量
function changeProdCount(type){
	if(stock<=0){// 是否有库存
		$("#stockinfo").html("<b class='Gray'>已售罄</b>");
		return;
	}else if(checkSelected(true)){// 是否选择规格
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>请选择尺码！</span>");
		return;
	}
	var item = getGoodsByKey();
	var maxNum = YouGou.Util.isNull(item)?0:item.stock;
	if(maxNum==0){
		return;
	}
	var oldNum = parseInt($("#oldNum").val());
	var newNum = parseInt($("#newNum").val());
	if(oldNum == 1){
		$("#subtract").attr("class","subtract");
	}else{
		$("#subtract").attr("class","subtract plus_yes");
	}
	$("#stockinfo").html("");
	$("#plus").attr("class","plus plus_yes");
	var num = 0;
	if(type == "+"){
		num = oldNum + 1;
	}else{
		num = oldNum - 1;
	}
	if(num == 0){
		return;
	}
	if(num > maxNum){
		$("#newNum").val(maxNum);
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>抱歉！您购买的数量超过库存量！</span>");
		$("#plus").attr("class","plus");
		hidestock();
		return;
	}else if(num > 10){
		$("#newNum").val("10");
		$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>一次最多购买10件</span>");
		$("#plus").attr("class","plus");
		hidestock();
		return;
	}
	$("#newNum").val(num);
	$("#oldNum").val(num);
	
}

// 设置商品价格
function getGoodsPrice(){
	$.ajax({
       type: "POST",
       data:{"cId":goods.prodInfo.cId},
       url: goods.goodsPriceApi,
       dataType : "json",
       success: function(data){
       		if(data != null){
       			if(YouGou.Util.isEmpty(data)){
       				var sizeSpecItem = $(".buy >p[data-property]").last().children("span").last().children("a");
					sizeSpecItem.each(function(index){
						var item = $(this);
						item.addClass("no").css("cursor","not-allowed");
					});
       			}else{
       				var strHtml = [];
       				strHtml.push(data.publicPrice);
       				$("#priceSpan").html("￥"+strHtml.join(''));
       				$("#jies").html('（'+data.discount +'折　为您节省：￥'+ data.save+'）');
       				if(activeType == 2){
						$("#yitianPrice").removeClass("priceSpan");
						$("#yitianPrice").html("￥"+data.salePrice);
       				}else{
       					$("#yitianPrice").addClass("priceSpan");
						$("#yitianPrice").html("￥"+data.salePrice);
       				}
       				getGoodsStock();
       			}
       		}
       }});
}

// 设置库存数量
function getGoodsStock(){
	var strKeys = [];
	if(!YouGou.Util.isNull(goodsMap)){
		goodsMap.each(function(key,value,index){
			if(!YouGou.Util.isNull(value)){
				if(index+1 != goodsMap.size()){
					strKeys.push(value.goodsNo+",");
				}else{
					strKeys.push(value.goodsNo);
				}
			}
		});
	}
	$.ajax({
       type: "POST",
       data:{"productNos":strKeys.join("")},
       dataType : "json",
       url: goods.goodsStockApi,
       success: function(data){
       		if(data!=null){
       			for(var i=0;i<data.length;i++){
       				goodsMap.each(function(key,value,index){
						if(value.goodsNo == data[i].pNo){
							value.stock = data[i].stock;
							if(data[i].stock>0){
								stock += data[i].stock;
							}
						}
					});
       			}
				var sizeSpecItem = $(".buy >p[data-property]").last().children("span").last().children("a");
				var colorSpecNo = $(".buy >p").first().children("span").last().children("a").filter(".select").attr("data-value");
				var proStock=[];
				sizeSpecItem.each(function(index){
					var itemKey = colorSpecNo + ":" + $(this).attr("data-value");
					var item = $(this);
					goodsMap.each(function(key,value,index){
						if(itemKey == key){
							if(value.stock<=0){
								item.addClass("no").css("cursor","not-allowed");
							}else{
								item.bind("click",function(){
									if(!$(this).hasClass("select")){
										$(this).addClass("select").siblings().removeClass("select");
								  		changeGoods();
									}
									viewSelected();
								});
								viewSelected();
								changeGoods();
								proStock.push(item);
							}
						}
					});
				});
				if(proStock.length==1){
					proStock[0].addClass("select");
					viewSelected();
				}
       	if(stock>0){
					$("#stockinfo >b").html("<b class='Green'>现在有货</b>");
					$("#oldNum").val("1");
				}else{
					$("#stockinfo").html("<b class='Gray'>已售罄</b>");
			  	    $("#newNum").val("0");
			  	    $("#oldNum").val("0");
			  	     
					//viewSelected();
					changeGoods();
				}
       		}
       }
	});
}

//校验活动规则
function checkBaseActiveRule(){
	// 限时抢
	var flag = true;
	if(goods.prodInfo.basePromotionActive.activeType!=null && goods.prodInfo.basePromotionActive.activeType == "2"){
		$.ajax({
	       type: "POST",
	       async : false,
	       data:{"commodityId" : goods.prodInfo.cId},
	       url : goods.getDeadLineActiveTimeUrl,
	       success: function(data){
	       	   if(data != ""){
	       	   		if(data <= 0){
						flag = false;
	       	   		}
	       	   }
	       }
		});
		if(!flag){
			alert("非常抱歉，活动已经过期，不能购买该商品!");
			return false;
		}
	}
	return flag;
}

// Timer
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

// 限时抢活动倒计时
var validEndTime = "";
// 倒计时timer
var remainTimeer = null;
function setRemainTime(validTime) {
	if(remainTimeer == null){
		return;
	}
	var day=Math.floor(validTime/(1000*60*60 * 24));
    var hour=Math.floor(validTime/(1000*60*60)) % 24;
    var minute=Math.floor(validTime/(1000*60)) % 60;
    var second=Math.floor(validTime/1000) % 60;
    var html = [];
	if (day > 0 || hour > 0 || minute >0 || second > 0) {
		html.push("还剩");
		if(day > 0){
			html.push("<b>"+ day + "</b>天");
		}
		if(hour != 0 || day != 0){
			html.push("<b>" + hour + "</b>小时");
		}
		html.push("<b>" + minute + "</b>分钟");
		html.push("<b>"+ second +"</b>秒");
		//html.push("结束  ");
	    $("#validTime").html(html.join(""));
	}else {
	   html.push("<strong>抱歉，活动已过期！</strong>");
	   $("#validTime").html(html.join(""));
       remainTimeer.clear();
       remainTimeer = null;
	}
	validEndTime = validTime;
}

// 限时抢活动获取时间
function getDeadLineActiveTime(){
	$.ajax({
       type: "POST",
       data:{"commodityId" : goods.prodInfo.cId},
       url : goods.getDeadLineActiveTimeUrl,
       success: function(data){
       	   if(data != ""){
       	   		validEndTime = data;
       	   		// 倒计时timer
				remainTimeer = new Timer(1000, function(t){
					setRemainTime(validEndTime - 1000);
				});
       	   }
       }
	});
}

// 加载活动
function loadActive(){
	var baseActiveObj = goods.prodInfo.basePromotionActive;
	if(YouGou.Util.isNull(baseActiveObj)){
		return;
	}
	var activeType = parseInt(baseActiveObj.activeType);
	switch(activeType){
		// 限时抢
		case 2 :
			getDeadLineActiveTime();
			break;
		case 3 :
			break;
	}
}

function bindSpecCutover(){
	try{
		$("#spec-list").jdMarquee({
			deriction:"left",
			width:470,
			height:90,
			step:2,
			speed:4,
			delay:10,
			control:true,
			_front:"#spec-right",
			_back:"#spec-left"
		});
	}catch(e){}
}

// 绑定切换图片
function mimgMouseoverEvent(){
	$("#spec-list ul li img").bind("mouseover",function(){

		var loadflag=$(this).attr("loadflag");
		var imgclass=$(this).attr("class");

		if(loadflag=="0"){
			$(".ZoomLoading").show();
		}

		$("#pD-bimg").attr("src",$(this).attr("picBigUrl"));
  		// 绑定放大镜
  		$("#pD-bimg").attr("jqimg",$(this).attr("picLargeUrl"));
		$("#spec-n1 img").eq(0).load(function(){
		  $("."+imgclass).attr("loadflag",1);
          $(".ZoomLoading").hide();
	       }).error(function() {
		   $(".ZoomLoading").show();
	   }) ;

		$("#spec-list ul li img").each(function(){
			$(this).css({"border":"1px solid #ddd","padding":"2px"});
			$(this).parent().css("background","");
		});

		$(this).css({
			"border":"1px solid #F67649",
			"padding":"2px"
		});
		$(this).parent().css("background","url("+basePath+"/images/iconbg.gif) no-repeat 7px -1088px");
	}).bind("mouseout",function(){
		$(this).css({});
	});
}

//校验是否选择规格
function checkSelected(isPrint){
	var isSelected = false;
	$(".buy > p").each(function(index){
		var dataProperty = $(this).attr("data-property");
		if(dataProperty != null){
			if($(this).children("span").last().children("a").filter(".select").length==0){
				isSelected = true;
				// 是否弹出警告
				if(isPrint){
					if(stock<=0){
						$("#stockinfo").html("<b class='Gray'>已售罄</b>");
						return false;
					}else{
						$("#stockinfo").html("<span id="+'stocktips'+"><em class="+'cor'+"></em>请选择"+dataProperty+"</span>");
						return false;
					}
				} 
			}
		}
	});
	return isSelected;
}

//获取货品key
function getGoodsKey(){
	var goodsKey = [];
	var selectedItemObj = $(".prodSpec").children("a").filter(".select");
	selectedItemObj.each(function(index){
		goodsKey.push($(this).attr("data-value"));
		if(selectedItemObj.length != index+1){
			goodsKey.push(":");
		}
	});
	return goodsKey.join("");
}

// 选择各项规格更新货品属性
function changeGoods(){
	// 没有全部选择则返回
	if(checkSelected(false)){
		// 关联属性项值库存过滤
	}else{
		// 更新库存
		changeStockOption();
	}
}

//更新库存选择
function changeStockOption(){
	var itemObj = goods.goodsMap.get(getGoodsKey());
	if(YouGou.Util.isNull(itemObj)){
		return 0;
	}
	var stockCount = itemObj.stock;
	var buyNum = parseInt($("#newNum").val());
	if(stockCount>0){
		$("#stockinfo >b").html("<b class='Green'>现在有货</b>");
		if(stockCount >= buyNum){
			return;
		}else{
			$("#newNum").val(stockCount);
			$("#oldNum").val(stockCount);
		}		
	}else{
		$("#stockinfo").html("<b class='Gray'>已售罄</b>");
  	$("#newNum").val("0");
  	$("#oldNum").val("0");
	}
}

// 展示选择的规格名称
function viewSelected(){
	var innerHtml = [];
	$("#stockinfo").html("");
	innerHtml.push("已选择<span class='Red'>");
	$(".buy > p").each(function(i){
		$(this).children("span").last().children("a").filter(".select").each(function(i){
			innerHtml.push(" <strong>"+ $(this).attr("data-name") +"</strong>");
		});
	});
	innerHtml.push("</span>");
	$("#selected").html(innerHtml.join("")).show();
}

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString();
        }
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

// 商品Cookie Key
var HISTORY_PRODUCT_COOKIES_KEY  = "yg_history_products";

// 浏览商品后写入Cookie
function setHistoryProduct(){
	// 取出历史商品信息
	var strHistory = getHistoryProuct();
	// 清除Cookie
	removeHistoryProuct();
	var str = [];
	str.push("[");
	var historyGoods = window.eval("("+strHistory+")");
	addProuctFormCookie(historyGoods,str);
    str.push("]");
    $.cookie(HISTORY_PRODUCT_COOKIES_KEY, str.join(''), {expires: 30, path: '/', domain: 'www.yougou.com', secure: false });
}

// 构造商品josn
function buildProuctJosn(info,str){
	str.push('{');
    //str.push('"cId" : "'+ info.cId +'",');
    str.push('"cNo" : "'+ info.cNo +'",');
    //str.push('"url" : "'+ info.url +'",');
    str.push('"brandId" : "'+ info.brandId +'",');
    str.push('"catId" : "'+ info.catId +'"');
    //str.push('"publicPrice" : "'+ info.publicPrice +'",');
    //str.push('"salePrice" : "'+ info.salePrice +'",');
    //str.push('"cName" : "'+ info.cName +'",');
    //str.push('"picMiddle" : "'+ info.picMiddle +'"');
    str.push("}");
}

// 添加历史商品
function addProuctFormCookie(historyGoods,str){
	buildProuctJosn(goods.prodInfo,str);
	if(!YouGou.Util.isNull(historyGoods) && historyGoods.length != 0){
		str.push(",");
		for(var i=0;i<3;i++){
			var item = historyGoods[i];
			if(item != null && item.cNo != goods.prodInfo.cNo){
				buildProuctJosn(item,str);
				if(historyGoods.length != 0){
					str.push(",");
				}
			}
		}
	}
}

// 删除历史信息
function removeHistoryProuct(){
	$.cookie("History_Product_Cookies",'',{ expires: -1 });
	$.cookie(HISTORY_PRODUCT_COOKIES_KEY,'',{ expires: -1 });
}

// 获取商品Cookie信息
function getHistoryProuct(){
	return $.cookie(HISTORY_PRODUCT_COOKIES_KEY);
}

// 生成历史浏览过的商品
function generateHistoryProuct(){
	var strHtml = [];
	var strHistoryProuct = getHistoryProuct();
	var historyGoods = null;
	if(!YouGou.Util.isEmpty(strHistoryProuct)){
		historyGoods = window.eval("("+strHistoryProuct+")");
		if(YouGou.Util.isNull(historyGoods) || historyGoods.length==1){
			$("#historyGoods").html('<p class="noinfo">暂时还未浏览过其他商品</p>');
		}else{
			var cNos = [];
			$.each(historyGoods,function(index,item){
				if(!YouGou.Util.isNull(item)){
					if(!YouGou.Util.isNull(item.cNo)){
						goodsShowMap.put("goods_history_" + item.cNo,item.cNo+"-"+ item.brandId +"-"+item.catId);
					}
				}
			});
		}
	}else{
		$("#historyGoods").html('<p class="noinfo">暂时还未浏览过其他商品</p>');
	}

	$.ajax({
       type: "POST",
       url: "/api/getPrice4Commodity.jhtml",
       data:{"cNos" : goodsShowMap.valueArrString(","),"pageType":"detail"},
       dataType : "json",
       success: function(data){
       		if(data != ""){
       			rebuildRecommendGoods(data);
       			if(!YouGou.Util.isNull(historyGoods) && historyGoods.length > 1){
       				$.each(historyGoods,function(index,item){
						if(item!=null && index <= 3 && item.cNo != goods.prodInfo.cNo){

							$.each(data,function(_index,_item){
								if(_item != null){
									if(_item.no == item.cNo){
										item.publicPrice = _item.publicPrice!=null?_item.publicPrice:item.publicPrice;
										item.url = _item.url!=null?_item.url:item.url;
										item.cName = _item.cName!=null?_item.cName:item.cName;
										item.img = _item.img!=null?_item.img:item.img;
										item.salePrice = _item.salePrice!=null?_item.salePrice:item.salePrice;
										item.activePrice = _item.activePrice!=null?_item.activePrice:item.activePrice;
										item.activeDiscount = _item.activeDiscount!=null?_item.activeDiscount:item.activeDiscount;
									}
								}
							});
							var imgUrl = "";
							if(item.img == "" || item.img == null || item.img == "undefined"){
								imgUrl = basePath + "/images/common/160x160.jpg";
							}else{
								imgUrl = item.img;
							}
							var link = item.url;
							strHtml.push('<li id="goods_history_'+ item.cNo +'"><span class="img"><a title="'+ item.cName +'" href="'+link+'">');
							strHtml.push('<img src="/template/common/images/nloading.gif" original="'+ imgUrl +'"/></a></span>');
							strHtml.push('<span><a class="tit" href="'+link+'">'+ item.cName +'</a></span>');
							strHtml.push('<span class="price_sc">市场价：<s>￥'+ item.publicPrice +'</s></span>');
							// 活动价
							if(item.salePrice != item.activePrice){
								//strHtml.push('<span class="price_sc">优购价 <s class="f_body">￥'+ item.salePrice +'</s></span></li>');
								strHtml.push('<span class="Yellow">活动价：<b class="Size14">￥'+ item.activePrice +'</b> <font class="Gray">('+ item.activeDiscount +'折)</font></span></li>');
							}else{
								strHtml.push('<span class="price_sc">优购价： <b class="Yellow Size14">￥'+ item.salePrice +'</b> <font class="price_sc">('+ item.activeDiscount +'折)</font></span></li>');
							}
						}
					});
					$("#historyGoods").html(strHtml.join(""));
					$("#historyGoods img").lazyload({placeholder:"/template/common/images/nloading.gif",effect:"fadeIn",failurelimit: 200});
       			}
			}
   	   }
	});

}

// 重新修改推荐商品价格
function rebuildRecommendGoods(data){
	goodsShowMap.each(function(key,value,index){
		if(!YouGou.Util.isNull(value)){
			if(key.indexOf("goods_recommend_") != -1){
				$.each(data,function(_index,item){
					if(item.no == key.substring(key.lastIndexOf("_")+1,key.length)){
						// 活动价
						if(item.salePrice != item.activePrice){
							//$("#"+key+" span:eq(3)").html('优购价： <s class="f_body">￥'+ item.salePrice +'</b>');
							$("#"+key+" span:eq(3)").remove();
							$('#'+key).append('<span class="Yellow">活动价：<b class="Size14">￥'+ item.activePrice +'</b> <font class="price_sc">('+ item.activeDiscount +'折)</font></span>');
						}else{
							$("#"+key+" span:eq(3)").remove();
							$('#'+key).append('<span class="price_sc">优购价： <b class="Yellow Size14">￥'+ item.salePrice +'</b> <font class="price_sc">('+ item.activeDiscount +'折)</font><span>');
						}
					}
				});
			}
		}
	});
}

// 检查是否登录
function checkUserLogin(){
	var isLogin = false;
	$.ajax({
       type: "POST",
       async : false,
       url: goods.checkUserLoginUrl,
       success: function(data){
			if(data == "true"){
				isLogin =  true;
			}
       }
    });
	return isLogin;
}

// 跳转写点评
function toWriteComment(){
	if(!checkUserLogin()){
		alert("请登录后点评");
		window.location.href= goods.loginUrl;
	}else{
		window.location.href = goods.writeCommentUrl;
	}
}

// 商品收藏
function favoriteEvent(){
	$("#favoriteImg").bind("click",function(){
		if(!checkUserLogin()){
			alert("请登录后收藏");
			return;
		}
		$.ajax({
	       type: "POST",
	       url: goods.favoriteApi,
	       dataType:"json",
	       success: function(data){
			var flag = parseInt(data.flag);
			if(flag == 1){
				alert("您已经收藏");
			}else if(flag == 2){
					$("#favorite").text(parseInt($("#favorite").text()) + 1);
	       		  alert("收藏成功");
	       	}
	       }
		});
	});
}

// 最新点评
function newComment(commodityId){
	if(!checkUserLogin()){
		alert("您还没有登录,登录后才能参与点评!");
		return;
	}else if(!checkIsWriteCommodity()){
		alert("对不起,购买过该商品的会员才能评论!");
		return;
	}
	var orderNo = getOrderNoByCommodityId();

	if(orderNo == "" || orderNo == null){
		alert("您可能对该商品没下过订单或已对该商品点评过！");
		return;
	}
	window.location.href= goods.writeCommentUrl + "&orderNo="+orderNo;
}

//根据用户账号，商品id查询下过订单编号
function getOrderNoByCommodityId(){
	var resultCode="";
	$.ajax({
       type: "POST",
       async : false,
       url: goods.getOrderNoByIdUrl + "?commodityId="+goods.prodInfo.cId,
       success: function(data)
       {
			resultCode =  data;
       }
    });
	return resultCode;
}

// 回复商品的回复
function replyComment(itemId){
	if(!checkUserLogin()){
		alert("请登录!");
		return;
	}
	window.location.href= basePath +'/my/queryComment.jhtml?id=' + itemId;
}

function checkIsWriteCommodity(commodityId){
	var isWriteCommodity = false;
	$.ajax({
       type: "POST",
       async : false,
       url: goods.checkIsWriteCommodity,
       success: function(data){
			if(data == "true"){
				isWriteCommodity =  true;
			}
       }
    });
	return isWriteCommodity;
}

// 点评是否有用
function commentByUseful(itemId){
	var isUseCommodityId = $("#isUseCommodityId").val();
	var ccid = itemId;
	if(!checkUserLogin()){
		alert("请登录后点击有用数量");
		window.location.href= goods.loginUrl;
		return;
	}
	$.ajax({
       type: "POST",
       url :basePath+"/api/comment/queryCommentById.jhtml?id="+ccid,
       data : {"commodityId":isUseCommodityId},
       success: function(msg){
    	   if ("0" == msg) {
				alert("对不起，您已经选择该信息对您有用了！");
			}else{
				$("#isusefulCount"+ccid).text("有用("+msg+")");
			}
       }
	});
}

$(document).ready(function(){
	$("#add_to_car_close,#closeBuyLink").click(function(){
		$("#add_to_car").animate({opacity:'hide',duration:100}, 'slow');
	});
	$(".jqzoom").jqueryzoom({xzoom:470,yzoom:440,offset:3,position:"right",preload:1,lens:1});
	try{
		if(!YouGou.Util.isNull(commodityStatus) && commodityStatus == 2){
			bindSpecCutover();
		}
	}catch(e){
		bindSpecCutover();
	}
	setHistoryProduct();
	mimgMouseoverEvent();
	generateHistoryProuct();
	favoriteEvent();
	initOther();
	initCatBrand();
	$("a").css("outline","none");
	initPager(0);
	$("#plus").attr("class","plus plus_yes");
	$.getScript(basePath+"/template/common/js/scrolltopcontrol.js",null);
});

function initOther(){
	//商品介绍tab操作
	$("#divtab2>div:not(:first)").hide(); //不是第一个隐藏
	$('#goodsBar2 a').click(function(){
		$(this).blur();//移除焦点
		var index = $("#goodsBar2 a").index(this);
		$('#goodsBar2 a').removeClass('hover');
		$(this).addClass('hover');
		$("#divtab2>div").eq(index).show().siblings().hide();
	  	$(".size_compare dl:odd").css("background-color","#f8f8f8");
	});
	$("#add_to_car_close").click(function(){
		$("#add_to_car").animate({opacity:'hide',duration:100}, 'slow');
	});
	$("#add_to_car2_close").click(function(){
		$("#add_to_car2").animate({opacity:'hide',duration:100}, 'slow');
	});
	$("#sizecompare_close").click(function(){
		$("#sizecompare").animate({opacity:'hide',duration:100}, 'slow');
	});
	$("#sizecompare_link").click(function(){
		$("#sizecompare").animate({opacity:'show',duration:100}, 'slow');
	});
	$("#Detail_Box_close").click(function(){
		$("#Detail_Box").animate({opacity:'hide',duration:100}, 'slow');
	});
	$("#Detail_Btn").click(function(){
		$("#Detail_Box").animate({opacity:'show',duration:100}, 'slow');
	});
	//购买须知
	$("#buy_a1").click(function(){
		$('#goodsBar2 a').removeClass('hover');
		$("#buy_tab1").addClass("hover");
		$("#divtab2>div").hide();
		$("#buy_tab1_con").show();
	});
	//如何购买
	$("#buy_a2").click(function(){
		$('#goodsBar2 a').removeClass('hover');
		$("#buy_tab2").addClass("hover");
		$("#divtab2>div").hide();
		$("#buy_tab2_con").show();
	});
	$("#newNum").bind('keydown',updateProdCount);
}

function initCatBrand(){
	//其他品牌、款式
	$("#showmoreclass").mouseover(function(){
		$("#moreclass").show();
	});
	$("#moreclass").mouseout(function(){
		$(this).hide();
	});
	$("#showmorestyle").mouseover(function(){
		$("#morestyle").show();
	});
	$("#morestyle").mouseout(function(){
		$(this).hide();
	});
}

function initDetailBoxEvent(){
	$("#Detail_Box_close").click(function(){
		$("#Detail_Box").animate({opacity:'hide',duration:100}, 'slow');
	});

	$("#Detail_Btn").click(function(event){
		event.stopPropagation();
		$("#Detail_Box").animate({opacity:'show',duration:100} , 'slow');
	});
	$(document).click(function(event){
		$("#Detail_Box").animate({opacity:'hide',duration:100}, 'slow');
	});
}

(function($){$.fn.jdMarquee=function(option,callback){if(typeof option=="function"){callback=option;option={};};var s=$.extend({deriction:"up",speed:10,auto:false,width:null,height:null,step:1,control:false,_front:null,_back:null,_stop:null,_continue:null,wrapstyle:"",stay:5000,delay:20,dom:"div>ul>li".split(">"),mainTimer:null,subTimer:null,tag:false,convert:false,btn:null,disabled:"disabled",pos:{ojbect:null,clone:null}},option||{});var object=this.find(s.dom[1]);var subObject=this.find(s.dom[2]);var clone;if(s.deriction=="up"||s.deriction=="down"){var height=object.eq(0).outerHeight();var step=s.step*subObject.eq(0).outerHeight();object.css({width:s.width+"px",overflow:"hidden"});};if(s.deriction=="left"||s.deriction=="right"){var width=subObject.length*subObject.eq(0).outerWidth();object.css({width:width+"px",overflow:"hidden"});var step=s.step*subObject.eq(0).outerWidth();};var init=function(){var wrap="<div style='position:relative;overflow:hidden;z-index:1;width:"+s.width+"px;height:"+s.height+"px;"+s.wrapstyle+"'></div>";object.css({position:"absolute",left:0,top:0}).wrap(wrap);s.pos.object=0;clone=object.clone();object.after(clone);switch(s.deriction){default:case "up":object.css({marginLeft:0,marginTop:0});clone.css({marginLeft:0,marginTop:height+"px"});s.pos.clone=height;break;case "down":object.css({marginLeft:0,marginTop:0});clone.css({marginLeft:0,marginTop:-height+"px"});s.pos.clone=-height;break;case "left":object.css({marginTop:0,marginLeft:0});clone.css({marginTop:0,marginLeft:width+"px"});s.pos.clone=width;break;case "right":object.css({marginTop:0,marginLeft:0});clone.css({marginTop:0,marginLeft:-width+"px"});s.pos.clone=-width;break;};if(s.auto){initMainTimer();object.hover(function(){clear(s.mainTimer);},function(){initMainTimer();});clone.hover(function(){clear(s.mainTimer);},function(){initMainTimer();});};if(callback){callback();};if(s.control){initControls();}};var initMainTimer=function(delay){clear(s.mainTimer);s.stay=delay?delay:s.stay;s.mainTimer=setInterval(function(){initSubTimer()},s.stay);};var initSubTimer=function(){clear(s.subTimer);s.subTimer=setInterval(function(){roll()},s.delay);};var clear=function(timer){if(timer!=null){clearInterval(timer);}};var disControl=function(A){if(A){$(s._front).unbind("click");$(s._back).unbind("click");$(s._stop).unbind("click");$(s._continue).unbind("click");}else{initControls();}};var initControls=function(){if(s._front!=null){$(s._front).click(function(){$(s._front).addClass(s.disabled);disControl(true);clear(s.mainTimer);s.convert=true;s.btn="front";if(!s.auto){s.tag=true;};convert();});};if(s._back!=null){$(s._back).click(function(){$(s._back).addClass(s.disabled);disControl(true);clear(s.mainTimer);s.convert=true;s.btn="back";if(!s.auto){s.tag=true;};convert();});};if(s._stop!=null){$(s._stop).click(function(){clear(s.mainTimer);});};if(s._continue!=null){$(s._continue).click(function(){initMainTimer();});}};var convert=function(){if(s.tag&&s.convert){s.convert=false;if(s.btn=="front"){if(s.deriction=="down"){s.deriction="up";};if(s.deriction=="right"){s.deriction="left";}};if(s.btn=="back"){if(s.deriction=="up"){s.deriction="down";};if(s.deriction=="left"){s.deriction="right";}};if(s.auto){initMainTimer();}else{initMainTimer(4*s.delay);}}};var setPos=function(y1,y2,x){if(x){clear(s.subTimer);s.pos.object=y1;s.pos.clone=y2;s.tag=true;}else{s.tag=false;};if(s.tag){if(s.convert){convert();}else{if(!s.auto){clear(s.mainTimer);}}};if(s.deriction=="up"||s.deriction=="down"){object.css({marginTop:y1+"px"});clone.css({marginTop:y2+"px"});};if(s.deriction=="left"||s.deriction=="right"){object.css({marginLeft:y1+"px"});clone.css({marginLeft:y2+"px"});}};var roll=function(){var y_object=(s.deriction=="up"||s.deriction=="down")?parseInt(object.get(0).style.marginTop):parseInt(object.get(0).style.marginLeft);var y_clone=(s.deriction=="up"||s.deriction=="down")?parseInt(clone.get(0).style.marginTop):parseInt(clone.get(0).style.marginLeft);var y_add=Math.max(Math.abs(y_object-s.pos.object),Math.abs(y_clone-s.pos.clone));var y_ceil=Math.ceil((step-y_add)/s.speed);switch(s.deriction){case "up":if(y_add==step){setPos(y_object,y_clone,true);$(s._front).removeClass(s.disabled);disControl(false);}else{if(y_object<=-height){y_object=y_clone+height;s.pos.object=y_object;};if(y_clone<=-height){y_clone=y_object+height;s.pos.clone=y_clone;};setPos((y_object-y_ceil),(y_clone-y_ceil));};break;case "down":if(y_add==step){setPos(y_object,y_clone,true);$(s._back).removeClass(s.disabled);disControl(false);}else{if(y_object>=height){y_object=y_clone-height;s.pos.object=y_object;};if(y_clone>=height){y_clone=y_object-height;s.pos.clone=y_clone;};setPos((y_object+y_ceil),(y_clone+y_ceil));};break;case "left":if(y_add==step){setPos(y_object,y_clone,true);$(s._front).removeClass(s.disabled);disControl(false);}else{if(y_object<=-width){y_object=y_clone+width;s.pos.object=y_object;};if(y_clone<=-width){y_clone=y_object+width;s.pos.clone=y_clone;};setPos((y_object-y_ceil),(y_clone-y_ceil));};break;case "right":if(y_add==step){setPos(y_object,y_clone,true);$(s._back).removeClass(s.disabled);disControl(false);}else{if(y_object>=width){y_object=y_clone-width;s.pos.object=y_object;};if(y_clone>=width){y_clone=y_object-width;s.pos.clone=y_clone;};setPos((y_object+y_ceil),(y_clone+y_ceil));};break;}};if(s.deriction=="up"||s.deriction=="down"){if(height>=s.height&&height>=s.step){init();}};if(s.deriction=="left"||s.deriction=="right"){if(width>=s.width&&width>=s.step){init();}}}})(jQuery);

/* jquery zoom */
(function($){
$.fn.jqueryzoom=function(options){
var settings={
xzoom:200,
yzoom:200,
offset:10,
position:"right",
lens:1,
preload:1};
if(options){
$.extend(settings,options);}
var noalt='';
$(this).hover(function(){
var imageLeft=$(this).offset().left;
var imageTop=$(this).offset().top;
var imageWidth=$(this).children('img').get(0).offsetWidth;
var imageHeight=$(this).children('img').get(0).offsetHeight;
noalt=$(this).children("img").attr("alt");
var bigimage=$(this).children("img").attr("jqimg");
$(this).children("img").attr("alt",'');
if($("div.zoomdiv").get().length==0){

/*添加隐藏层 覆盖select IE6 bug*/
//$(".num").css("display","none");
//$("#numselect").css("display","none");
/*添加隐藏层 覆盖select IE6 bug*/

$(this).after("<div class='zoomdiv'><img class='bigimg' src='"+bigimage+"'/></div>");
$(this).append("<div class='jqZoomPup'>&nbsp;</div>");}
if(settings.position=="right"){
if(imageLeft+imageWidth+settings.offset+settings.xzoom>screen.width){
leftpos=imageLeft-settings.offset-settings.xzoom;}else{
leftpos=imageLeft+imageWidth+settings.offset;}}else{
leftpos=imageLeft-settings.xzoom-settings.offset;
if(leftpos<0){
leftpos=imageLeft+imageWidth+settings.offset;}}
//$("div.zoomdiv").css({top:imageTop,left:leftpos});
$("div.zoomdiv").width(settings.xzoom);
$("div.zoomdiv").height(settings.yzoom);
$("div.zoomdiv").show();
if(!settings.lens){
$(this).css('cursor','crosshair');}
$(document.body).mousemove(function(e){
mouse=new MouseEvent(e);
var bigwidth=$(".bigimg").get(0).offsetWidth;
var bigheight=$(".bigimg").get(0).offsetHeight;
var scaley='x';
var scalex='y';
if(isNaN(scalex)|isNaN(scaley)){
var scalex=(bigwidth/imageWidth);
var scaley=(bigheight/imageHeight);
//$("div.jqZoomPup").width((settings.xzoom)/(scalex*1));
//$("div.jqZoomPup").height((settings.yzoom)/(scaley*1));

if((settings.xzoom)/(scalex*1)>480){
	$("div.jqZoomPup").width(80);
	}
else{
$("div.jqZoomPup").width((settings.xzoom)/(scalex*1));}

if((settings.yzoom)/(scaley*1)>480){
	$("div.jqZoomPup").height(80);
}
else{
$("div.jqZoomPup").height((settings.yzoom)/(scaley*1));
}

if(settings.lens){
$("div.jqZoomPup").css('visibility','visible');}}
xpos=mouse.x-$("div.jqZoomPup").width()/2-imageLeft;
ypos=mouse.y-$("div.jqZoomPup").height()/2-imageTop;
if(settings.lens){
xpos=(mouse.x-$("div.jqZoomPup").width()/2 < imageLeft ) ? 0 : (mouse.x + $("div.jqZoomPup").width()/2>imageWidth+imageLeft)?(imageWidth-$("div.jqZoomPup").width()-2):xpos;
ypos=(mouse.y-$("div.jqZoomPup").height()/2 < imageTop ) ? 0 : (mouse.y + $("div.jqZoomPup").height()/2>imageHeight+imageTop)?(imageHeight-$("div.jqZoomPup").height()-2):ypos;}
if(settings.lens){
$("div.jqZoomPup").css({top:ypos,left:xpos});
if($(".jqZoomPup").height()>480){
$(".jqZoomPup").hide();
$(".zoomdiv").hide();}}
scrolly=ypos;
$("div.zoomdiv").get(0).scrollTop=scrolly*scaley;
scrollx=xpos;
$("div.zoomdiv").get(0).scrollLeft=(scrollx)*scalex;});},function(){
$(this).children("img").attr("alt",noalt);
$(document.body).unbind("mousemove");
if(settings.lens){

/*添加隐藏层 覆盖select IE6 bug*/
//$(".num").css("display","");
/*添加隐藏层 覆盖select IE6 bug*/

$("div.jqZoomPup").remove();}
$("div.zoomdiv").remove();});
count=0;
if(settings.preload){
$('body').append("<div style='display:none;' class='jqPreload"+count+"'>UGO</div>");
$(this).each(function(){
var imagetopreload=$(this).children("img").attr("jqimg");
var content=jQuery('div.jqPreload'+count+'').html();
jQuery('div.jqPreload'+count+'').html(content+'<img src=\"'+imagetopreload+'\">');});}}})(jQuery);
function MouseEvent(e){
this.x=e.pageX;
this.y=e.pageY;}

// 获取活动内容
function getActiveDetailContent(){
	$.ajax({
		type : "POST",
		url : goods.getActiveDetailContentUrl,
		data : {"cId":$("#commodityId").val()},
		success : function(data){
			if(!YouGou.Util.isEmpty(data)){
				$("#activeContent").html(data);
			}
		}
	});
}

// 初始化第一页
function initPager (pageNo) {
	 window.eval("pageClickCallback("+pageNo+")");
}
var pageCount;
var totalCount;
// 回调函数
pageClickCallback = function(pageNo) {
	if(pageNo > pageCount) pageNo = pageCount;

	if(pageNo < 1) pageNo = 1;
	if(totalCount>0){
		renderPager(pageNo,pageCount,"pageClickCallback");
		var param = "cId="+goods.prodInfo.cId+"&pageNo="+pageNo;
		YouGou.Ajax.do_request("userCommentContainer",goods.queryCommentUrl,param,null);
	}else{
		$("#paginator").hide();
		var param = "cId="+goods.prodInfo.cId+"&pageNo=1";
		YouGou.Ajax.do_request("userCommentContainer",goods.queryCommentUrl,param,function(){
			if(pageCount > 0){
				renderPager(pageNo,pageCount,"pageClickCallback");
				$("#paginator").show();
			}
		});
	}
}

//跳转到某页
function jumpPage(){
	var toPage = $("#jumpToPage").val();
	$("#jumpToPage").val("");
	if(toPage=="")return;
	if(!/^[1-9]\d*$/.test(toPage)){
		alert("输入的页数有误，请重新输入！");
		return ;
	}
	if(toPage<1){
		toPage = 1;
	}
	if(toPage>pageCount){
		toPage = pageCount;
	}
	initPager(toPage);
}

function renderPager(currentpage, pagecount, buttonClickCallback){
	var pagestr = ""; //组装的填充HTML字符串
	var breakpage = 4;
	var currentposition = 4;
	var breakspace = 2;
	var maxspace = 4;
	var prevnum = currentpage-currentposition;
	var nextnum = currentpage+currentposition;
	if(prevnum<1) prevnum = 1;
	if(nextnum>pagecount) nextnum = pagecount;
	pagestr += (currentpage==1)?'<span class="prev prev1"></span>':'<a class="prev" href="javascript:'+buttonClickCallback+'('+(currentpage-1)+')">上一页</a>';
	if(prevnum-breakspace>maxspace){
		for(i=1;i<=breakspace;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
		pagestr += '<span class="break">...</span>';
		for(i=pagecount-breakpage+1;i<prevnum;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
	}else{
		for(i=1;i<prevnum;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
	}
	for(i=prevnum;i<=nextnum;i++){
		pagestr += (currentpage==i)?'<span class="thispage">'+i+'</span>':'<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
	}
	if(pagecount-breakspace-nextnum+1>maxspace){
		for(i=nextnum+1;i<=breakpage;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
		pagestr += '<span class="break">...</span>';
		for(i=pagecount-breakspace+1;i<=pagecount;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
	}else{
		for(i=nextnum+1;i<=pagecount;i++)
			pagestr += '<a href="javascript:'+buttonClickCallback+'('+i+')">'+i+'</a>';
	}
	pagestr += (currentpage==pagecount)?'<span class="next">下一页</span>':'<a class="next" href="javascript:'+buttonClickCallback+'('+(currentpage+1)+')">下一页</a>';
	document.getElementById("page").innerHTML = pagestr;
}

var gettitle;
gettitle=document.title.split(",",1);
function sharetopeople() {
	window.open('http://share.renren.com/share/buttonshare.do?link='+ encodeURIComponent(location.href),'_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes')
}

function sharetohappy() {
	window.open('http://www.kaixin001.com/repaste/share.php?rtitle='+encodeURIComponent(gettitle)+'&amp;rurl='+encodeURIComponent(location.href)+'&amp;rcontent=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes')
}

function sharetodouban() {
	window.open('http://www.douban.com/recommend/?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(gettitle)+'&amp;content=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes')
}

function sharetosina() {
	window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(gettitle+' '+location.href)+'&amp;url='+encodeURIComponent(location.href)+'&amp;rcontent='+encodeURIComponent(gettitle),'_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes')
}

function sharetoqzone() {
	window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href),'_blank')
}