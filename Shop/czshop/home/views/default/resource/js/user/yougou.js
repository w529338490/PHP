/**
 * @class YouGou Core Commons JS Library
 * @author WuYang
 * @history 2011-4-28 Create
 * @singleton
 */

if (typeof Belle == 'undefined') {
	Belle = {
		version : '1.0 beta1'
	};
}

Belle = {
	version : "1.0"
};

window["undefined"] = window["undefined"];

Belle.apply = function(C, D, B) {
	if (B) {
		Belle.apply(C, B);
	}
	if (C && D && typeof D == "object") {
		for (var A in D) {
			C[A] = D[A];
		}
	}
	return C;
};

// print Object
function inspect(obj) {
	var s = obj + "\n";
	for (var a in obj) {
		if (typeof obj[a] != "function") {
			s += a + "=" + obj[a] + ",\n";
		}
	}
	alert("obj=" + s);
}

/*
 * 定义Belle类
 */
(function() {
	var ua = navigator.userAgent.toLowerCase();
	var isStrict = document.compatMode == "CSS1Compat", isOpera = ua.indexOf("opera") > -1, isSafari = (/webkit|khtml/).test(ua), isSafari3 = isSafari
			&& ua.indexOf("webkit/5") != -1, isIE = !isOpera && ua.indexOf("msie") > -1, isIE7 = !isOpera && ua.indexOf("msie 7") > -1, isIE7 = !isOpera
			&& ua.indexOf("msie 8") > -1, isGecko = !isSafari && ua.indexOf("gecko") > -1, isGecko3 = !isSafari && ua.indexOf("rv:1.9") > -1, isBorderBox = isIE
			&& !isStrict, isWindows = (ua.indexOf("windows") != -1 || ua.indexOf("win32") != -1), isMac = (ua.indexOf("macintosh") != -1 || ua
			.indexOf("mac os x") != -1), isAir = (ua.indexOf("adobeair") != -1), isLinux = (ua.indexOf("linux") != -1), isSecure = window.location.href
			.toLowerCase().indexOf("https") === 0;
	if (isIE && !isIE7) {
		try {
			document.execCommand("BackgroundImageCache", false, true);
		} catch (e) {
		}
	}
	Belle.apply(Belle, {
		isStrict : isStrict,
		isSecure : isSecure,
		applyIf : function(o, c) {
			if (o && c) {
				for (var p in c) {
					if (typeof o[p] == "undefined") {
						o[p] = c[p];
					}
				}
			}
			return o;
		},
		urlEncode : function(o) {
			if (!o) {
				return "";
			}
			var buf = [];
			for (var key in o) {
				var ov = o[key], k = encodeURIComponent(key);
				var type = typeof ov;
				if (type == "undefined") {
					buf.push(k, "=&");
				} else {
					if (type != "function" && type != "object") {
						buf.push(k, "=", encodeURIComponent(ov), "&")
					} else {
						if (Belle.isArray(ov)) {
							if (ov.length) {
								for (var i = 0, len = ov.length; i < len; i++) {
									buf.push(k, "=", encodeURIComponent(ov[i] === undefined ? "" : ov[i]), "&")
								}
							} else {
								buf.push(k, "=&");
							}
						}
					}
				}
			}
			buf.pop();
			return buf.join("");
		},
		urlDecode : function(string, overwrite) {
			if (!string || !string.length) {
				return {};
			}
			var obj = {};
			var pairs = string.split("&");
			var pair, name, value;
			for (var i = 0, len = pairs.length; i < len; i++) {
				pair = pairs[i].split("=");
				name = decodeURIComponent(pair[0]);
				value = decodeURIComponent(pair[1]);
				if (overwrite !== true) {
					if (typeof obj[name] == "undefined") {
						obj[name] = value;
					} else {
						if (typeof obj[name] == "string") {
							obj[name] = [obj[name]];
							obj[name].push(value);
						} else {
							obj[name].push(value);
						}
					}
				} else {
					obj[name] = value;
				}
			}
			return obj;
		},
		jsLoader : function(sUrl, fCallback) {
			var _script = document.createElement('script');
			_script.setAttribute('charset', 'utf-8');
			_script.setAttribute('type', 'text/javascript');
			_script.setAttribute('src', sUrl);
			document.getElementsByTagName('head')[0].appendChild(_script);
			if (isIE) {
				_script.onreadystatechange = function() {
					if (this.readyState == 'loaded' || this.readyState == 'complete') {
						fCallback();
					}
				};
			} else if (MiniSite.Browser.moz) {
				_script.onload = function() {
					fCallback();
				};
			} else {
				fCallback();
			}
		},
		/**
		 * 清理指定元素中Flash Object对象
		 */
		cleanSwfById : function(id) {
			if (window.opera || !document.all)
				return;
			try {
				var objects = document.getElementById(id).getElementsByTagName("OBJECT");
				for (var i = 0; i < objects.length; i++) {
					objects[i].style.display = 'none';
					for (var x in objects[i]) {
						if (typeof objects[i][x] == 'function') {
							objects[i][x] = function() {};
						}
					}
				}
			} catch (e) {
			}
		},
		/**
		 * 获取WebRoot 如:http://www.yougou.com
		 */
		getWebRoot : function() {
			var strFullPath = window.document.location.href;
			var strPath = window.document.location.pathname;
			var pos = strFullPath.indexOf(strPath);
			return strFullPath.substring(0, pos);
		},
		/**
		 * 获取访问当前页面的根路径 如:http://www.yougou.com/login
		 */
		getCurWebRoot : function() {
			var strFullPath = window.document.location.href;
			var strPath = window.document.location.pathname;
			var pos = strFullPath.indexOf(strPath);
			return strFullPath.substring(0, pos) + strPath.substring(0, strPath.substr(1).indexOf('/') + 1);
		},
		dateFormat : function(time) {
			var date = new Date(time);
			var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
			var currentDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
			return date.getFullYear() + "-" + month + "-" + currentDate + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
		},
		/**
		 * 参数：str:原始字符串 n:需要返回的长度，汉字=2 返回值：处理后的字符串
		*/
		strEllip : function(str, n) {
			var ilen = str.length;
			if (ilen * 2 <= n)
				return str;
			n -= 3;
			var i = 0;
			while (i < ilen && n > 0) {
				if (escape(str.charAt(i)).length > 4) {
					n--;
				}
				n--;
				i++;
			}
			if (n > 0)
				return str;
			return str.substring(0, i) + "...";
		},
		isEmpty : function(v, allowBlank) {
			return v === null || v === undefined || (!allowBlank ? v === "" : false);
		},
		isNull : function(obj) {
			if (typeof obj == "undefined" || obj == null)
				return true;
			else
				return false;
		},
		value : function(v, defaultValue, allowBlank) {
			return Belle.isEmpty(v, allowBlank) ? defaultValue : v;
		},
		isArray : function(v) {
			return v && typeof v.length == "number" && typeof v.splice == "function";
		},
		addFavorite : function(url, title) {
			var ua = navigator.userAgent.toLowerCase();
			if (ua.indexOf("msie 8") > -1) {
				external.AddToFavoritesBar(url, title);// IE8
			} else {
				try {
					window.external.addFavorite(url, title);
				} catch (e) {
					try {
						window.sidebar.addPanel(title, url, "");// firefox
					} catch (e) {
						alert("加入收藏失败，请使用Ctrl+D进行添加");
					}
				}
			}
			return false;
		},
		/**
		 * Ajax请求替换Dom，并执行目标页面js,css
		 */
		do_request : function(el, url, params, callback) {
			if (!callback) {
				callback = function(data) {
					try {
						$("#_loaddingDiv").remove();
						window.updateInnerHTML(el, data);
					} catch (e) {}
				}
			}
			$.ajax({
				type : "POST",
				url : url,
				data : params,
				success : callback
			});
		},
		getCookie : function(name){
			var start = document.cookie.indexOf(name + "=");
			var len = start + name.length + 1;
			if ((!start) && (name != document.cookie.substring(0, name.length))) {
				return null;
			}
			if (start == -1)
				return null;
			var end = document.cookie.indexOf(';', len);
			if (end == -1)
				end = document.cookie.length;
			return unescape(document.cookie.substring(len, end));
		},
		setCookie : function(name, value, domain, expires, path, secure){
			var today = new Date();
			today.setTime(today.getTime());
			if (expires) {
				expires = expires * 1000 * 60 * 60 * 24;
			}
			var expires_date = new Date(today.getTime() + (expires));
			document.cookie = name + '=' + escape(value) + ((expires) ? ';expires=' + expires_date.toGMTString() : '') + ((path) ? ';path=' + path : '')
					+ ((domain) ? ';domain=' + domain : '') + ((secure) ? ';secure' : '');
		},
		deleteCookie : function(name, path, domain){
			document.cookie = name + '=null; expires=Thu, 01-Jan-1970 00:00:01 GMT' + ((path) ? ';path=' + path : '') + ((domain) ? ';domain=' + domain : '');
		},
		isOpera : isOpera,
		isSafari : isSafari,
		isIE : isIE,
		isIE6 : isIE && !isIE7,
		isIE7 : isIE7,
		isLinux : isLinux,
		isWindows : isWindows
	});
})();

/**
 * 定义script迭代器类
 */
var ScriptIterator = function() {
	this.elementArray = [];
	this.append = function(el) {
		this.elementArray.push(el);
	}
	this.hasNext = function() {
		return this.elementArray.length > 0;
	}
	this.next = function() {
		return this.elementArray.shift();
	}
}

/**
 * 更新指定元素的innerHTML,并执行其中的script
 */
window.updateInnerHTML = function(id, html) {
	window._updateHTML(id, html, 'inner');
}

/**
 * 更新指定元素的innerHTML,并执行其中的script
 */
window.updateOuterHTML = function(id, html) {
	window._updateHTML(id, html, 'outer');
}

/**
 * 更新指定元素的innerHTML,并执行其中的script
 */
window._updateHTML = function(id, html, type) {
	if (typeof html == "undefined") {
		html = "";
	}
	var el = document.getElementById(id);
	if (!el) {
		alert("未找到ID为" + id + "的页面元素");;
	}
	// 容易造成IE崩溃
	html = window.loadLinkTags(html);

	html = window.loadStyleTags(html);
	var sIterator = new ScriptIterator();
	html = window.loadScriptTags(html, sIterator);
	if (type == 'inner') {
		el.innerHTML = html;
	} else if (type == 'outer') {
		el.outerHTML = html;
	}
	window.loadScripts(sIterator);
}

/**
 * 加载Link标签
 */
window.loadLinkTags = function(html) {
	var reLink = /(?:<link.*?\/(link)?>)/ig;
	var head = document.getElementsByTagName("head")[0];
	var match;
	while (match = reLink.exec(html)) {
		if (match && match[0]) {
			var link = document.createElement(match[0]);
			link.setAttribute('rel', 'stylesheet');
			link.setAttribute('type', 'text/css');
			head.appendChild(link);
		}
	}
	html = html.replace(/(?:<link.*?\/(link)?>)/ig, "");
	return html;
}

/**
 * 加载style标签
 */
window.loadStyleTags = function(html) {
	var reStyle = /(?:<style([^>]*)?>)((\n|\r|.)*?)(?:<\/style>)/ig;
	var match;
	var head = document.getElementsByTagName("head")[0];
	while (match = reStyle.exec(html)) {
		if (match[2] && match[2].length > 0) {
			var styleTag = document.createElement('style');
			styleTag.setAttribute('type', 'text/css');
			if (styleTag.styleSheet) {
				styleTag.styleSheet.cssText = match[2];
			} else {
				styleTag.appendChild(document.createTextNode(match[2]));
			}
			head.appendChild(styleTag);
		}
	}
	html = html.replace(/(?:<style.*?>)((\n|\r|.)*?)(?:<\/style>)/ig, "");
	return html;
}

/**
 * 加载Link标签
 */
window.loadScriptTags = function(html, sIterator) {
	var re = /(?:<script([^>]*)?>)((\n|\r|.)*?)(?:<\/script>)/ig;
	var srcRe = /\ssrc=([\'\"])(.*?)\1/i;
	var idRe = /\sid=([\'\"])(.*?)\1/i;
	var typeRe = /\stype=([\'\"])(.*?)\1/i;

	var match;
	while (match = re.exec(html)) {
		var attrs = match[1];
		var idMatch = attrs ? attrs.match(idRe) : false;
		if (idMatch && idMatch[2]) {
			var el = document.getElementById(idMatch[2]);
			if (el) {
				continue;
			}
		}
		var srcMatch = attrs ? attrs.match(srcRe) : false;
		if (srcMatch && srcMatch[2]) {
			var script = document.createElement("script");
			script.src = srcMatch[2];
			var typeMatch = attrs.match(typeRe);
			if (typeMatch && typeMatch[2]) {
				script.type = typeMatch[2];
			}
			sIterator.append({
				type : 1,
				script : script
			});
		} else if (match[2] && match[2].length > 0) {
			sIterator.append({
				type : 2,
				script : match[2]
			});
		}
	}
	html = html.replace(/(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)/ig, "");
	return html;
}

/**
 * 确保通过Ajax技术获得js脚本能够执行
 */
window.loadScripts = function(sIterator) {
	if (sIterator.hasNext()) {
		var el = sIterator.next();
		if (el) {
			if (el.type == 1) {
				var hd = document.getElementsByTagName("head")[0];
				var script = el.script;
				script.onload = script.onreadystatechange = function() {
					if (!script.readyState || script.readyState == 'loaded' || script.readyState == 'complete') {
						window.loadScripts(sIterator);
					}
				}
				hd.appendChild(script);
			} else if (el.type == 2) {
				// alert(el.script);
				if (window.execScript) {
					try {
						window.execScript(el.script);
					} catch (e) {
						alert(e.description);
					}
				} else {
					window.eval(el.script);
				}
				window.loadScripts(sIterator);
			}
		}
	}
}

/*
///参数设置： 
scaling 是否等比例自动缩放 
width 图片最大高 
height 图片最大宽 
loadpic 加载中的图片路径 
*/ 
jQuery.fn.LoadImage=function(scaling,width,height,loadpic){ 
if(loadpic==null)loadpic="/template/common/images/nloading.gif"; 
return this.each(function(){ 
var t=$(this); 
var src=$(this).attr("src");
var img=new Image(); 
//alert("Loading") 
img.src=src; 
//自动缩放图片 
var autoScaling=function(){ 
if(scaling){ 
if(img.width>0 && img.height>0){ 
if(img.width/img.height>=width/height){ 
if(img.width>width){ 
t.width(width); 
t.height((img.height*width)/img.width); 
}else{ 
t.width(img.width); 
t.height(img.height); 
} 
} 
else{ 
if(img.height>height){ 
t.height(height); 
t.width((img.width*height)/img.height); 
}else{ 
t.width(img.width); 
t.height(img.height); 
} 
} 
} 
} 
};
//处理ff下会自动读取缓存图片 
if(img.complete){ 
//alert("getToCache!"); 
autoScaling(); 
return; 
} 
$(this).attr("src",""); 
var loading=$("<img alt=\"加载中\" title=\"图片加载中\" src=\""+loadpic+"\" />"); 
t.hide(); 
t.after(loading); 
$(img).load(function(){ 
autoScaling(); 
loading.remove(); 
t.attr("src",this.src); 
t.show(); 
//alert("finally!") 
}); 
}); 
};


