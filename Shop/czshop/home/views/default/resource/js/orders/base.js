/**
 * @class YouGou Base Library
 * @author WuYang
 * @email crowy@foxmail.com
 * @history 2011-8-6 Create
 */
(function() {
	// 定义YouGou类
	if (typeof YouGou == 'undefined') {
		// 声明框架命名空间
		YouGou = {
			version : '1.1 beta1',
			Biz:{},
			Base : {},
			Util : {},
			UI : {},
			Ajax : {}
		};
	}

	// 基础函数库
	YouGou.Base = {
		// 继承
		apply : function(C, D, B) {
			if (B) {
				YouGou.Base.apply(C, B);
			}
			if (C && D && typeof D == "object") {
				for (var A in D) {
					C[A] = D[A];
				}
			}
			return C;
		},
		// 继承
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
		// 获取类型
		typeOf : function(v) {
            if (v === null) {
                return 'null';
            }
            var type = typeof v;
            if (type === 'undefined' || type === 'string' || type === 'number' || type === 'boolean') {
                return type;
            }
            var typeToString = toString.call(v);
            switch(typeToString) {
                case '[object Array]':
                    return 'array';
                case '[object Date]':
                    return 'date';
                case '[object Boolean]':
                    return 'boolean';
                case '[object Number]':
                    return 'number';
                case '[object RegExp]':
                    return 'regexp';
            }
            if (type === 'function') {
                return 'function';
            }
            if (type === 'object') {
                if (v.nodeType !== undefined) {
                    if (v.nodeType === 3) {
                        return (/\S/).test(v.nodeValue) ? 'textnode' : 'whitespace';
                    }
                    else {
                        return 'element';
                    }
                }
                return 'object';
            }
        }
	};

	// 全局变量、函数
	var isOpera = $.browser.opera, isIE = $.browser.msie, isMoz = $.browser.mozilla;
	if (isIE) {
		try {
			document.execCommand("BackgroundImageCache", false, true);
		} catch (e) {}
	}

	// String扩展去除空格
	String.prototype.trim = function(){
		var str = this;
		str = str.replace(/^\s\s*/, "");
		var ws = /\s/;
		var i = str.length;
		while (ws.test(str.charAt(--i)));
		return str.slice(0, i + 1);
	};
	// Array扩展是否在集合中
    Array.prototype.inArray = function(value){
        for (var i=0,l = this.length ; i < l ; i++) {
            if (this[i] === value) {
                return true;
            }
        }
        return false;
    };
	// Array删除
    Array.prototype.remove = function(value){
	    var newArr = this;
	    for(var i=0,count=newArr.length;i<count;){
	        if(newArr[i] == value){newArr.splice(i,1); count--;continue;}
	        i++;
	    }
	    return newArr;
	};
	Function.prototype.binding = function(){
	    if (arguments.length < 2 && typeof arguments[0] == "undefined") return this;
	    var __method = this, args = jQuery.makeArray(arguments), object = args.shift();
	    return function() {
	        return __method.apply(object, args.concat(jQuery.makeArray(arguments)));
	    }
	};

	// 工具辅助函数库
	YouGou.Util = {
		// 空字符串判断
		isEmpty : function(v, allowBlank) {
			return v === null || v === undefined || (!allowBlank ? v === "" : false);
		},
		// 空对象判断
		isNull : function(obj) {
			if (typeof obj == "undefined" || obj == null)
				return true;
			else
				return false;
		},
		// 取值空判断
		value : function(v, defaultValue, allowBlank) {
			return this.isEmpty(v, allowBlank) ? defaultValue : v;
		},
		// 数组类型判断
		isArray : function(v) {
			return v && typeof v.length == "number" && typeof v.splice == "function";
		},
		// 是否是整型
		isInteger : function(v){
			if(/^-?[0-9]\d*$/.test(v))
				return true;
			else
				return false;
		},
		// 数字类型
		isNumber: function(value) {
            return typeof value === 'number' && isFinite(value);
        },
		// 是否是中文
		isChinese : function(v){
			if (/^[\u4e00-\u9fa5]+$/.test(v))
				return true;
			else
				return false;
		},
		// 计算字符串长度
		strEllip : function(v){
			if(this.isEmpty(v)){
				return 0;
			}
			return v.replace(/[^\x00-\xff]/g,"**").length;
		},
		// 日期类型
		isDate : function(v){
			return toString.call(v) === '[object Date]';
		},
		// 对象类型
		isObject : function(v) {
            return toString.call(v) === '[object Object]';
        },
		// print Object
		inspect : function(obj){
			var s = obj + "\n";
			for (var a in obj) {
				if (typeof obj[a] != "function") {
					s += a + "=" + obj[a] + ",\n";
				}
			}
			alert("obj=" + s);
		},
		// 类似Java的Map
		Map : function(){
			// keys
			this.keys = new Array();
			// values
			this.data = new Object();

			YouGou.Base.apply(this,{
				// 放入一个键值对
				put : function(key, value) {
					if (this.data[key] == null) {
						this.keys.push(key);
					}
					this.data[key] = value;
				},
				// 获取某键对应的值
				get : function(key) {
					return this.data[key];
				},
				// 删除一个键值对
				remove : function(key) {
					this.keys.remove(key);
					this.data[key] = null;
				},
				// 遍历Map,执行处理函数 回调函数 function(key,value,index){..}
				each : function(fn) {
					if (typeof fn != 'function') {
						return;
					}
					var len = this.keys.length;
					for (var i = 0; i < len; i++) {
						var k = this.keys[i];
						fn(k, this.data[k], i);
					}
				},
				// 获取键值数组(类似Java的entrySet()) 键值对象{key,value}的数组
				entrys : function() {
					var len = this.keys.length;
					var entrys = new Array(len);
					for (var i = 0; i < len; i++) {
						entrys[i] = {
							key : this.keys[i],
							value : this.data[i]
						};
					}
					return entrys;
				},
				// key数组字符串
				keyArrString : function(separator){
					var keyArr = new Array();
					var size = this.size();
					this.each(function(key,value,index){
						if(!YouGou.Util.isNull(key)){
							if(size != index+1){
								keyArr.push(key);
								keyArr.push(separator);
							}else{
								keyArr.push(key);
							}
						}
					});
					return keyArr.join('');
				},
				// 仅value为string时调用
				valueArrString : function(separator){
					var valArr = new Array();
					var size = this.size();
					this.each(function(key,value,index){
						if(!YouGou.Util.isNull(value)){
							if(size != index+1){
								valArr.push(value);
								valArr.push(separator);
							}else{
								valArr.push(value);
							}
						}
					});
					return valArr.join('');
				},
				// 判断Map是否为空
				isEmpty : function() {
					return this.keys.length == 0;
				},
				//获取键值对数量
				size : function() {
					return this.keys.length;
				},
				valArray : function(){
					var valArr = new Array();
					this.each(function(key,value,index){
						if(!YouGou.Util.isNull(value)){
							valArr.push(value);
						}
					});
					return valArr;
				},
				//重写toString
				toString : function() {
					var s = "{";
					for (var i = 0; i < this.keys.length; i++, s += ',') {
						var k = this.keys[i];
						s += k + "=" + this.data[k];
					}
					s += "}";
					return s;
				}
			});
		},
		// 对象转换成json字符串
		toJsonString : function(arg) {
		    return YouGou.Util.toJsonStringArray(arg).join('');
		},
		// 对象转换成json字符串数组
		toJsonStringArray : function(arg, out) {
		    out = out || new Array();
		    var u;
		    switch (typeof arg) {
		    case 'object':
		        if (arg) {
		            if (arg.constructor == Array) {
		                out.push('[');
		                for (var i = 0; i < arg.length; ++i) {
		                    if (i > 0)
		                        out.push(',\n');
		                    YouGou.Util.toJsonStringArray(arg[i], out);
		                }
		                out.push(']');
		                return out;
		            } else if (typeof arg.toString != 'undefined') {
		                out.push('{');
		                var first = true;
		                for (var i in arg) {
		                    var curr = out.length;
		                    if (!first)
		                        out.push(',\n');
		                    YouGou.Util.toJsonStringArray(i, out);
		                    out.push(':');
		                    YouGou.Util.toJsonStringArray(arg[i], out);
		                    if (out[out.length - 1] == u)
		                        out.splice(curr, out.length - curr);
		                    else
		                        first = false;
		                }
		                out.push('}');
		                return out;
		            }
		            return out;
		        }
		        out.push('null');
		        return out;
		    case 'unknown':
		    case 'undefined':
		    case 'function':
		        out.push(u);
		        return out;
		    case 'string':
		        out.push('"')
		        out.push(arg.replace(/(["\\])/g, '\\$1').replace(/\r/g, '').replace(/\n/g, '\\n'));
		        out.push('"');
		        return out;
		    default:
		        out.push(String(arg));
		        return out;
		    }
		},
		// 克隆
		clone : function(obj){
		  if(typeof(obj) != 'object') return obj;
			  if(obj == null) return obj;
				  var myNewObj = new Object();
				  for(var i in obj)
				     myNewObj[i] = YouGou.Util.clone(obj[i]);
				  return myNewObj;
		},
		// 参数：str:原始字符串 n:需要返回的长度，汉字=2 返回值：处理后的字符串
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
		// 微型模板引擎
		tpl : function(str, data){
			var fn = !/\W/.test(str) ?
			  cache[str] = cache[str] ||
				YouGou.Util.tpl(document.getElementById(str).innerHTML) :
			  new Function("obj",
				"var p=[],print=function(){p.push.apply(p,arguments);};" +
				"with(obj){p.push('" +
				str.replace(/[\r\t\n]/g, " ")
				  .split("<%").join("\t")
				  .replace(/((^|%>)[^\t]*)'/g, "$1\r")
				  .replace(/\t=(.*?)%>/g, "',$1,'")
				  .split("\t").join("');")
				  .split("%>").join("p.push('")
				  .split("\r").join("\\'")
			  + "');}return p.join('');");
			return data ? fn( data ) : fn;
		}
	};

	// 提供页面端函数
	YouGou.UI = {
		// js动态加载
		jsLoader : function(sUrl, fCallback) {
			$.getScript(sUrl,fCallback);
		},
		// 图片加载失败处理 el如".proList img"
		imgError : function(el,errImgUrl){
			$(el).each(function (i,e){
              var imgsrc = $(e).attr("src");
              $(e).load(function(){
                }).error(function() {
                   $(e).attr("src",errImgUrl);
                }) ;
          });
		},
		// 获取Url参数
		getQueryParameter : function(qs){
			var s = location.href;
		    s = s.replace("?","?&").split("&");
		    var re = "";
		    for(i=1;i<s.length;i++)
		        if(s[i].indexOf(qs+"=")==0)
		            re = s[i].replace(qs+"=","");
		    return re;
		},
		// 取得鼠标当前位置
		mousePosition : function(e) {
			e = e || window.event;
			var X = e.pageX || e.clientX + document.body.scrollLeft, Y = e.pageY || e.clientY + document.body.scrollTop;
			return {positionX : X,positionY : Y}
		},
		//延迟加载
		LazyLoad: {
			_initial: null,
			TYPE: {
				"Image": "Image",
				"Function": "Function"
			},
			LOADANIMATION: {
				FADEIN: "fadeIn"
			},
			fnConfig: (function (){
				var funcs = {};
				var _add = function (id, func){
					funcs[id] = func;
					return this;
				};
				var _get = function (id){
					if (typeof funcs[id] == "undefined"){
						return null;
					}
					return funcs[id];
				};
				var _remove = function (id){
					if (typeof funcs[id] == "undefined"){
						return false;
					}
					delete funcs[id];
					return true;
				};
				return {
					add: _add,
					get: _get,
					remove: _remove
				};
			})(),
			init: function ()
			{
				var lazyObjects = {
					obj: null,
					length: 0
				};

				var getLazyObjects = function (){
					return $("*[original]");
				};

				var getImageLazyObjects = function (){
					return $("img[original]");
				};

				var getConfigFunction = function (id){
					return YouGou.UI.LazyLoad.fnConfig.get(id);
				};

				var initLazyObjects = function (jqObjects, isSetObj){
					var ret = {};
					var _this, _lazy;
					jqObjects.each(function (i){
						_this = $(this);
						_lazy = splitLazyLoadStr($(this).attr("original"));
						ret[i] = {
							entity: $(this),
							type: _lazy.type,
							lazyload: _lazy.lazyload
						};
						lazyObjects.length++;
					});
					if (typeof isSetObj == "boolean" && isSetObj){
						setLazyObjects(ret);
					}
					return ret;
				};

				var setLazyObjects = function (objs){
					lazyObjects.obj = objs;
				};

				var addLazyObjects = function (elem, type, lazyload){
					if (lazyObjects.obj == null)
					{
						lazyObjects.obj = {};
					}
					handler = new Date().getTime() / 1000;
					lazyObjects.obj[handler] = {
						entity: elem,
						type: type,
						lazyload: lazyload
					};
					lazyObjects.length++;
					return;
				};

				var getWindow = function (){
					return {
						left: document.documentElement.scrollLeft || document.body.scrollLeft,
						top: document.documentElement.scrollTop || document.body.scrollTop,
						width: document.documentElement.clientWidth,
						height: document.documentElement.clientHeight
					}
				};

				var getObject = function (obj){
					return {
						left: $(obj).offset().left,
						top: $(obj).offset().top,
						width: $(obj).outerWidth(),
						height: $(obj).outerHeight()
					}
				};

				var splitLazyLoadStr = function (lazyloadstr){
					var splitIndex = lazyloadstr.indexOf(":");
					var lazyType = YouGou.UI.LazyLoad.TYPE;
					if (splitIndex <= 0){
						return {
							type: lazyType.Image,
							lazyload: lazyloadstr
						};
					}
					var prev = lazyloadstr.slice(0, splitIndex++),
							next = typeof lazyType[prev] != "undefined" ? lazyloadstr.slice(splitIndex) : lazyloadstr;
					prev = next == lazyloadstr ? "Image" : prev;
					return {
						type: prev,
						lazyload: next
					};
				};

				var each = function (){
					var obj = null, entity = null, lazytype = null, lazyload = null;
					var lazyType = YouGou.UI.LazyLoad.TYPE;
					var win = getWindow(), dom;
					for (i in lazyObjects.obj){
						obj = lazyObjects.obj[i];
						entity = obj.entity;
						if (entity.length == 0){
							continue;
						}
						dom = getObject(entity);
						if (isIntersect(dom, win) && typeof lazyObjects.obj[i] != "undefined"){
							lazytype = obj.type;
							lazyload = obj.lazyload;
							if (lazytype == lazyType.Image){
								loadImage(entity, lazyload);
								delete lazyObjects.obj[i];
								lazyObjects.length--;
								continue;
							}
							if (lazytype == lazyType.Function){
								loadFunction(entity, lazyload);
								delete lazyObjects.obj[i];
								lazyObjects.length--;
								continue;
							}
						}
					}
				};
				var loadImage = function (elem, src){
					if (typeof loadImage.applying == "undefined"){
						loadImage.applying = function (elem, imgsrc){
							var tagName = elem.attr("tagName") || elem.prop("tagName");
							if (tagName.toLowerCase() == "img"){
								elem.css("display", "none").attr("src", imgsrc).show().removeAttr("original");
							}
							else{
								elem.css("background", "url(" + src + ") no-repeat 0 0").fadeIn(800).removeAttr("original");
							}
							return;
						}
					}
					var img = new Image();
					img.src = src;
					if (img.complete){
						loadImage.applying(elem, img.src);
						img = null;
					}
					else{
						img.onload = function (){
							loadImage.applying(elem, img.src);
							img = null;
						}
					}
				};

				var loadFunction = function (elem, func){
					if (typeof func != "function"){
						func = getConfigFunction(func);
					}
					if (!func){
						return;
					}
					func.apply(elem);
				};

				var isIntersect = function (rec1, rec2){
					var lp1 = rec1.left + rec1.width / 2,
							lp2 = rec2.left + rec2.width / 2,
							tp1 = rec1.top + rec1.height / 2,
							tp2 = rec2.top + rec2.height / 2,
							w1 = (rec1.width + rec2.width) / 2,
							h1 = (rec1.height + rec2.height) / 2;
					return Math.abs(lp1 - lp2) <= w1 && Math.abs(tp1 - tp2) <= h1;
				};

				return {
					getLazyObj: getLazyObjects,
					addLazyObj: addLazyObjects,
					initLazyObj: initLazyObjects,
					setLazyObj: setLazyObjects,
					isInter: isIntersect,
					each: each,
					loadImage: loadImage
				}
			},
			Run: function (objs, outer){
				if (this._initial == null){
					this._initial = this.init();
				}
				var lz = this._initial;
				if (typeof objs == "undefined" || typeof objs.length != "number" || typeof objs.size != "function" || typeof objs.each != "function"){
					lz.initLazyObj(lz.getLazyObj(), true);
				}
				outer = outer || $(window);
				outer.scroll(function (){
					lz.each();
				});
				outer.resize(function (){
					lz.each();
				});
				lz.each();
				return this;
			},
			Add: function (elem, type, lazyload, func){
				if (this._initial == null){
					this._initial = this.init();
				}
				var lz = this._initial;
				lz.addLazyObj(elem, type, lazyload);
				if (type == this.TYPE.Function){
					this.fnConfig.add(lazyload, func);
				}
				lz.each();
				return this;
			}
		}
	};

	// 业务相关函数库
	YouGou.Biz = {
		// 浏览器工具
		WebToolkit : {
			// 添加收藏
			addFavorite : function(){
				var url="http://www.yougou.com/";
				var title="优购网上鞋城-时尚鞋类网购首选-买好鞋,上优购";
				ua = navigator.userAgent.toLowerCase();
				if(document.all){
					try{
						window.external.AddFavorite(url,title);
					}
					catch(e){
						alert("加入收藏失败，\n请您使用菜单栏或Ctrl+D收藏本站。");
					}
				}else if(window.sidebar){
					window.sidebar.addPanel(title,url,"")
				}
				else{
					alert("加入收藏失败，\n请您使用菜单栏或Ctrl+D收藏本站。");
				}
			},
			// 收藏首页
			setHomePage : function(){
				if (document.all){
						document.body.style.behavior='url(#default#homepage)';
						document.body.setHomePage('http://www.yougou.com');
					}else if(window.sidebar){
						if(window.netscape){
							try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");}catch (e){
							alert( "亲爱的用户你好：\n你使用的不是IE浏览器，此操作被浏览器阻挡了，你可以选择手动设置为首页！\n给你带来的不便，本站深表歉意。" );
						}
					}
				}
			},
			// 打开企业QQ客服
			openQQCUS : function(){
				window.open('http://b.qq.com/webc.htm?new=0&sid=800023329&eid=2188z8p8p8p8K8P8P8K80&o=www.yougou.com&q=7', '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');
			},
			// 分享
			Share : {
				gettitle : document.title.split(",",1),
				sharetopeople : function(){
					window.open('http://share.renren.com/share/buttonshare.do?link='+ encodeURIComponent(location.href),'_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes');
				},
				sharetohappy : function(){
					window.open('http://www.kaixin001.com/repaste/share.php?rtitle='+encodeURIComponent(this.gettitle)+'&amp;rurl='+encodeURIComponent(location.href)+'&amp;rcontent=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes');
				},
				sharetodouban : function(){
					window.open('http://www.douban.com/recommend/?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(this.gettitle)+'&amp;content=','_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes');
				},
				sharetosina : function(){
					window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(this.gettitle+' '+location.href)+'&amp;url='+encodeURIComponent(location.href)+'&amp;rcontent='+encodeURIComponent(this.gettitle),'_blank','scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes');
				},
				sharetoqzone : function(){
					window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href),'_blank');
				}
			}
		},
		// 购物车Class
		ShoppingCart : {
			cartDom : null,
			cartContainer : "cartContent",
			cartActionBasePath : "/yitianmall/shoppingcart/cart/",
			targetUrl : "/yitianmall/shoppingmgt_new/simpleShoppingCart",
			// 初始化购物车
			initCart : function(){
				var prodCount = document.getElementById("pordcount");
				if(YouGou.Util.isNull(prodCount)){
					return;
				}
				this.getShoppingCart();
				$("#paymoney,#newshopcar").css("cursor","pointer");
				// 绑定菜单点击事件
				$("#newshopcar").click(function(){
					YouGou.Biz.ShoppingCart.showCart();
			 	});
			 	$("#shoppingcartContainer_close").click(function(){
				 	$("#shoppingcartContainer").animate({opacity:'hide',duration:100},'slow');
				});
			 	$("#paymoney").click(function(){
			 		var prodCount = $("#pordcount").text();
			 		if(parseInt(prodCount) > 0){
			 			YouGou.Biz.ShoppingCart.checkShoppingCart();
			 		}else{
			 			YouGou.Biz.ShoppingCart.showCart();
			 		}
			    });
			},
			// 获取购物车
			getShoppingCart : function(){
				$.ajax({
					type: "POST",
					url:this.cartActionBasePath+"getShoppingCartForHomePage.sc",
					success:function(data){
						if(data){
							YouGou.Biz.ShoppingCart.cartDom = data;
							YouGou.Ajax.updateInnerHTML(YouGou.Biz.ShoppingCart.cartContainer, data);
						}
					}
				});
			},
			// 显示
			showCart : function(){
				if(YouGou.Util.isEmpty(this.cartDom)){
					$.ajax({
						type: "POST",
						url:this.cartActionBasePath+"getShoppingCartForHomePage.sc",
						success:function(data){
							if(data){
								YouGou.Biz.ShoppingCart.cartDom = data;
								YouGou.Biz.ShoppingCart.openCartDialog(data);
							}
						}
					});
				}else{
					this.openCartDialog(YouGou.Biz.ShoppingCart.cartDom);
				}
			},
			// 打开窗口
			openCartDialog: function(data){
				$("#shoppingcartContainer").animate({opacity:'show',duration:100},'slow');
				$(".activitytips").fadeIn("fast").delay(2500).fadeOut("slow");
				var warnMsg=$("div [name=num_warntips]");
				if(warnMsg.length>0){
					$('html,body').animate({scrollTop: $("div [name=num_warntips]").first().offset().top},1000);
					warnMsg.fadeIn("fast").delay(1000).fadeOut("slow");
				}
			},
			// 修改购物车数量
			changeProductNum : function(type,index,simpleShoppingCart){
				var oldNum = parseInt($("#oldNum_"+index).val());
				var newNum = type == "+"?oldNum + 1:oldNum - 1;
				var productNo = $("#productNo_"+index).val();
				if(newNum == 0){
					this.removeProduct(productNo,true);
					return;
				}
				$('.tabimg .subtract').removeAttr('onclick').removeAttr('href');
				$('.tabimg .plus').removeAttr('onclick').removeAttr('href');

				$("#oldNum_"+index).val(newNum);
				var param = "productNum="+ newNum +"&productNo=" + productNo+"&targetUrl="+this.targetUrl;
				YouGou.Ajax.do_request(this.cartContainer,this.cartActionBasePath+"u_updateCart.sc",param,function(data){
					YouGou.Biz.ShoppingCart.cartDom = data;
				});
			},
			// 删除商品
			removeProduct : function(prodNo,isTip){
				if(isTip){
					if(!confirm("您确定要将此商品删除吗？")){return;}
				}
				var param = "productNo=" + prodNo + "&targetUrl="+this.targetUrl;
				// 异步移除商品
				YouGou.Ajax.do_request(this.cartContainer,this.cartActionBasePath + "d_removeProduct.sc",param,function(){
					YouGou.Biz.ShoppingCart.cartDom = data;
				});
			},
			// 收藏
			addCommodityFavorite : function(commodityId,productNo){
				var url = [];
				url.push("/api/addCommodityFavorite.jhtml?id=");
				url.push(commodityId);
				$.ajax({
					 type: 'POST',
					 url: url.join(""),
					 success: function(data){
						YouGou.Biz.ShoppingCart.removeProduct(productNo,false);
					 }
				});
			},
			checkShoppingCart : function(){
				// 验证购物车中是否有非法货品
				var warnMsg=$("div [name=num_warntips]");
				if(warnMsg.length>0){
					this.openCartDialog(YouGou.Biz.ShoppingCart.cartDom);
					$('html,body').animate({scrollTop: $("div [name=num_warntips]").first().offset().top},1000);
					warnMsg.fadeIn("fast").delay(1000).fadeOut("slow");
					return;
				}
				window.open("/order.jhtml");
			}
		},
		// Cookie操作
		cookie : function(name, value, options){
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
		},
	    // TaskRunner任务器
	    TaskRunner : function(interval){
			interval = interval || 10;
		    var tasks = [],
		    removeQueue = [],
		    id = 0,
		    running = false,
		    // private
		    stopThread = function() {
		        running = false;
		        clearInterval(id);
		        id = 0;
		    },
		    // private
		    startThread = function() {
		        if (!running) {
		            running = true;
		            id = setInterval(runTasks, interval);
		        }
		    },
		    // private
		    removeTask = function(t) {
		        removeQueue.push(t);
		        if (t.onStop) {
		            t.onStop.apply(t.scope || t);
		        }
		    },
		    // private
		    runTasks = function() {
		        var rqLen = removeQueue.length,now = new Date().getTime(),i;
		        if (rqLen > 0) {
		            for (i = 0; i < rqLen; i++) {
		                tasks.remove(removeQueue[i]);
		            }
		            removeQueue = [];
		            if (tasks.length < 1) {
		                stopThread();
		                return;
		            }
		        }
		        i = 0;
		        var t,itime,rt,len = tasks.length;
		        for (; i < len; ++i) {
		            t = tasks[i];
		            itime = now - t.taskRunTime;
		            if (t.interval <= itime) {
		                rt = t.run.apply(t.scope || t, t.args || [++t.taskRunCount]);
		                t.taskRunTime = now;
		                if (rt === false || t.taskRunCount === t.repeat) {
		                    removeTask(t);
		                    return;
		                }
		            }
		            if (t.duration && t.duration <= (now - t.taskStartTime)) {
		                removeTask(t);
		            }
		        }
		    };
		    this.start = function(task) {
		        tasks.push(task);
		        task.taskStartTime = new Date().getTime();
		        task.taskRunTime = 0;
		        task.taskRunCount = 0;
		        startThread();
		        return task;
		    };
		    this.stop = function(task) {
		        removeTask(task);
		        return task;
		    };
		    this.stopAll = function() {
		        stopThread();
		        for (var i = 0, len = tasks.length; i < len; i++) {
		            if (tasks[i].onStop) {
		                tasks[i].onStop();
		            }
		        }
		        tasks = [];
		        removeQueue = [];
		    };
	    }
	};

	// Ajax函数库
	YouGou.Ajax = {
		// Ajax请求替换DOM，并执行目标页面js,css
		do_request : function(el, url, params, callback){
			$.ajax({
				type : "POST",
				url : url,
				data : params,
				success : function(data){
					YouGou.Ajax.updateInnerHTML(el, data);
					if(callback){
						try {
							callback(data);
						}catch(e){
							//console.error("执行异步回调删除失败",e);
						}
					}
				}
			});
		},
		// 更新指定元素的innerHTML,并执行其中的script
		updateInnerHTML : function(id, html) {
			YouGou.Ajax._updateHTML(id, html, 'inner');
		},
		// 更新指定元素的innerHTML,并执行其中的script
		updateOuterHTML : function(id, html) {
			YouGou.Ajax._updateHTML(id, html, 'outer');
		},
		// script迭代器
		ScriptIterator : function() {
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
		},
		// 更新指定元素的innerHTML,并执行其中的script
		_updateHTML : function(id, html, type) {
			if (typeof html == "undefined") {
				html = "";
			}
			var el = document.getElementById(id);
			if (!el) {
				//console.error("未找到ID为" + id + "的页面元素");;
			}
			// 容易造成IE崩溃
			html = YouGou.Ajax.loadLinkTags(html);
			html = YouGou.Ajax.loadStyleTags(html);
			var sIterator = new YouGou.Ajax.ScriptIterator();
			html = YouGou.Ajax.loadScriptTags(html, sIterator);
			if (type == 'inner') {
				el.innerHTML = html;
			} else if (type == 'outer') {
				el.outerHTML = html;
			}
			YouGou.Ajax.loadScripts(sIterator);
		},
		// 加载Link标签
		loadLinkTags : function(html) {
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
		},
		// 加载style标签
		loadStyleTags : function(html) {
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
		},
		//加载script标签
		loadScriptTags : function(html, sIterator) {
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
		},
		// 加载多个script标签
		loadScripts : function(sIterator) {
			if (sIterator.hasNext()) {
				var el = sIterator.next();
				if (el) {
					if (el.type == 1) {
						var hd = document.getElementsByTagName("head")[0];
						var script = el.script;
						script.onload = script.onreadystatechange = function() {
							if (!script.readyState || script.readyState == 'loaded' || script.readyState == 'complete') {
								YouGou.Ajax.loadScripts(sIterator);
							}
						}
						hd.appendChild(script);
					} else if (el.type == 2) {
						if (window.execScript) {
							try {
								window.execScript(el.script);
							} catch (e) {
								//console.error(e.description);
							}
						} else {
							window.eval(el.script);
						}
						YouGou.Ajax.loadScripts(sIterator);
					}
				}
			}
		}
	}
})();

// init functions
$(function (){
	try{
		YouGou.Biz.ShoppingCart.initCart();
	}catch(e){}

	//启动延迟加载
	//YouGou.UI.LazyLoad.Run();
});