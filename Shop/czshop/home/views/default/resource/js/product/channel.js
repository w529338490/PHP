/**
  * TODO: 搜索关键字到品牌名称通用方法
  * @param param0  一级关键字
  * @param param   二级关键字
  * @param brandName  品牌
  * @param url 自定义url
  * @return
  */
 function brandNameAndUrl(param0,param,brandName,url,footer,logoSmallUrl) {
 	var brandUrl = url;
/* 	if(url != "") {
 		brandUrl = encodeURI(encodeURI(url));
 	} else {
 		var brandNameTmp = encodeURI(encodeURI(brandName));
 		var paramStr = param0 == "7p" ? "param0="+param0+"&param3="+brandNameTmp :
 							param0 == "Hi" ? "param0="+param0+"&param4="+brandNameTmp :
 							param0 == "f6" ? "param0="+param0+"&param5="+brandNameTmp :
 							param0 == "6J" ? "param0="+param0+"&param3="+brandNameTmp :
 							param0 == "79" ? "param0="+param0+"&param4="+brandNameTmp :
 							param0 == "w7" ? "param0="+param0+"&param4="+brandNameTmp : "";
 		brandUrl = "/s/search.sc?" + paramStr;
 	}
 */
 	if(footer == "footer") document.write("<a href='"+brandUrl+"' target='_blank'>"+brandName+"</a>");
 	else document.write("<a href='"+brandUrl+"' target='_blank'><img width=\"85\" height=\"40\" src=\""+logoSmallUrl+"\" title=\""+brandName+"\" alt=\""+brandName+"\"/></a>");
 }
 /**
  * TODO: 搜索关键字到品牌名称通用方法
  * @param param0  一级关键字
  * @param param   二级关键字
  * @param brandName  品牌
  * @param url 自定义url
  * @return
  */
 function styleNameAndUrl(param0,param,styleName,url) {
 	var styleUrl = url;
/* 	if(url != "") {
 		styleUrl = encodeURI(encodeURI(url));
 	} else {
 		var styleNameTmp = encodeURI(encodeURI(styleName));
 		var paramStr = param0 == "7p" ? "param0="+param0+"&param4="+styleNameTmp :
 			param0 == "Hi" ? "param0="+param0+"&param5="+styleNameTmp :
 				param0 == "f6" ? "param0="+param0+"&param6="+styleNameTmp :
 					param0 == "6J" ? "param0="+param0+"&param4="+styleNameTmp :
 						param0 == "79" ? "param0="+param0+"&param5="+styleNameTmp :
 							param0 == "w7" ? "param0="+param0+"&param5="+styleNameTmp : "";
 		styleUrl = "/s/search.sc?" + paramStr;
 	}
 */
 	document.write("<a href='"+styleUrl+"' target='_blank'>"+styleName+"</a>");
 }