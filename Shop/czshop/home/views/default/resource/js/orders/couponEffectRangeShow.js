// 品类品牌组合
CategoriesAndBrandVo = function(config){
	YouGou.Base.apply(this,config);
	this.type = this.type || 3;
	this.id = this.id || "";
	this.brandId = this.brandId || "";
	this.brandNo = this.brandNo || "";
	this.brandName = this.brandName || "";
	this.categories = this.categories || new YouGou.Util.Map();
};
var myDialog = null;
//显示优惠券作用商品范围
function showCouponEffectCommodityRange(couponSchemeId){
	$.ajax({
	   type: "POST",
	   async : false,
	   url: "/yitianmall/usercenter/coupon/getCouponScheme.sc?couponSchemeId="+ couponSchemeId,
	   success: function(result){
	    	var json = eval( "("+result+")" );
	    	var contentHtml='';

	    	//1. 渲染商品范围
	    	var commodityArr=json.marketingCouponCommodities;
	    	if(commodityArr.length>0){
	    		contentHtml+='<div class="sort_select clearfix"><p><strong>商品范围</strong></p>';
	    		for(var i=0;i<commodityArr.length;i++){
	    			contentHtml+='<span style="width:300px;">·'+commodityArr[i].commodityName+'</span>';
	    		}
	    		contentHtml+='</div><p class="blank10"></p>';
	    	}

	    	var brandCategoriesGroup=json.marketingCouponBrandCategories;
	    	var brandArr=new Array();
	    	var categoriesArr=new Array();
	    	var brandArrCateGories=new Array();
	    	for(var i=0;i<brandCategoriesGroup.length;i++){
	    		// 1:品牌 2:品类 3:品牌品类
	    		var obj=brandCategoriesGroup[i];
	    		if(obj.type==1){
					brandArr.push(obj);
	    		}else if(obj.type==2){
					categoriesArr.push(obj);
	    		}else if(obj.type==3){
					brandArrCateGories.push(obj);
	    		}
	    	}

	    	//2. 渲染品牌范围
	    	if(brandArr.length>0){
	    		contentHtml+='<div class="sort_select clearfix"><p><strong>品牌范围</strong></p>';
				for(var i=0;i<brandArr.length;i++){
					contentHtml+='<span style="width:100px;">·'+brandArr[i].brandName+'</span>';
	    		}
				contentHtml+='</div><p class="blank10"></p>';
	    	}

	    	//3. 渲染品类范围
	    	if(categoriesArr.length>0){
	    		contentHtml+='<div class="sort_select clearfix"><p><strong>分类范围</strong></p>';
	    		for(var i=0;i<categoriesArr.length;i++){
	    			var categName=categoriesArr[i].firstCategoriesName+">"+categoriesArr[i].secondCategoriesName+">"+categoriesArr[i].thirdCategoriesName;
					contentHtml+='<span style="width:190px;">·'+categName+'</span>';
	    		}
				contentHtml+='</div><p class="blank10"></p>';
	    	}

	    	//4. 渲染品牌品类范围
	    	if(brandArrCateGories.length>0){
	    		// 获取品牌分组
				var brandGroupMap=new YouGou.Util.Map();
				for(var i=0;i<brandArrCateGories.length;i++){
					if(YouGou.Util.isEmpty(brandGroupMap.get(brandArrCateGories[i].brandId))){
						brandGroupMap.put(brandArrCateGories[i].brandId,brandArrCateGories[i]);
					}
				}
				var brandCategorieArr=new Array();
				brandGroupMap.each(function(key,value,index){
					var tempBrandCategorieArr=new Array();
					for(var i=0;i<brandArrCateGories.length;i++){
						if(value.brandId==brandArrCateGories[i].brandId){
							tempBrandCategorieArr.push(brandArrCateGories[i]);
						}
					}

					var categoriesBrandVo = new CategoriesAndBrandVo({
						brandId : value.brandId,
						brandName : value.brandName ,
						categories : tempBrandCategorieArr
					});
					brandCategorieArr.push(categoriesBrandVo);
				});

				//开始渲染
				for(var i=0;i<brandCategorieArr.length;i++){
					contentHtml+='<div class="sort_select clearfix"><p><strong>'+'品牌分类 '+brandCategorieArr[i].brandName+'</strong></p>';
					for(var j=0;j<brandCategorieArr[i].categories.length;j++){
						var categorieObj=brandCategorieArr[i].categories[j];
						var categName=categorieObj.firstCategoriesName+">"+categorieObj.secondCategoriesName+">"+categorieObj.thirdCategoriesName;
						contentHtml+='<span style="width:190px;">·'+categName+'</span>';
					}
					contentHtml+='</div><p class="blank10"></p>';
	    		}
	    	}
			contentHtml=YouGou.Util.isEmpty(contentHtml)?"暂无信息":contentHtml;

			myDialog = art.dialog({title:"优惠券使用范围",width:650,lock:true});
			myDialog.content(contentHtml);
	   }
	});
}