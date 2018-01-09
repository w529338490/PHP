/*
 * artDialog 4.1.0
 * Date: 2011-08-06 22:10
 * http://code.google.com/p/artdialog/
 * (c) 2009-2010 TangBin, http://www.planeArt.cn
 *
 * This is licensed under the GNU LGPL, version 2.1 or later.
 * For details, see: http://creativecommons.org/licenses/LGPL/2.1/
 */
(function(G, I) {
  if (G.jQuery) return jQuery;
  var A = G.art = function(_, $) {
    return new A.fn.init(_, $)
  },
  D = false,
  B = [],
  H,
  $,
  K = "opacity" in document.documentElement.style,
  _ = /^(?:[^<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,
  J = /[\n\t]/g,
  L = /alpha\([^)]*\)/i,
  M = /opacity=([^)]*)/,
  N = /^([+-]=)?([\d+-.]+)(.*)$/;
  if (G.$ === I) G.$ = A;
  A.fn = A.prototype = {
    constructor: A,
    ready: function($) {
      A.bindReady();
      if (A.isReady) $.call(document, A);
      else if (B) B.push($);
      return this
    },
    hasClass: function($) {
      var _ = " " + $ + " ";
      if ((" " + this[0].className + " ").replace(J, " ").indexOf(_) > -1) return true;
      return false
    },
    addClass: function($) {
      if (!this.hasClass($)) this[0].className += " " + $;
      return this
    },
    removeClass: function(_) {
      var $ = this[0];
      if (!_) $.className = "";
      else if (this.hasClass(_)) $.className = $.className.replace(_, " ");
      return this
    },
    css: function(_, B) {
      var D, $ = this[0],
      C = arguments[0];
      if (typeof _ === "string") {
        if (B === I) return A.css($, _);
        else _ === "opacity" ? A.opacity.set($, B) : $.style[_] = B
      } else for (D in C) D === "opacity" ? A.opacity.set($, C[D]) : $.style[D] = C[D];
      return this
    },
    show: function() {
      return this.css("display", "block")
    },
    hide: function() {
      return this.css("display", "none")
    },
    offset: function() {
      var $ = this[0],
      F = $.getBoundingClientRect(),
      D = $.ownerDocument,
      _ = D.body,
      C = D.documentElement,
      A = C.clientTop || _.clientTop || 0,
      B = C.clientLeft || _.clientLeft || 0,
      G = F.top + (self.pageYOffset || C.scrollTop) - A,
      E = F.left + (self.pageXOffset || C.scrollLeft) - B;
      return {
        left: E,
        top: G
      }
    },
    html: function($) {
      if ($ === I) return this[0].innerHTML;
      this[0].innerHTML = $;
      return this
    }
  };
  A.fn.init = function(B, C) {
    var D, $;
    C = C || document;
    if (!B) return this;
    if (B.nodeType) {
      this[0] = B;
      return this
    }
    if (B === "body" && C.body) {
      this[0] = C.body;
      return this
    }
    if (B === "head" || B === "html") {
      this[0] = C.getElementsByTagName(B)[0];
      return this
    }
    if (typeof B === "string") {
      D = _.exec(B);
      if (D && D[2]) {
        $ = C.getElementById(D[2]);
        if ($ && $.parentNode) this[0] = $;
        return this
      }
    }
    if (typeof B === "function") return A(document).ready(B);
    this[0] = B;
    return this
  };
  A.fn.init.prototype = A.fn;
  A.noop = function() {};
  A.isWindow = function($) {
    return $ && typeof $ === "object" && "setInterval" in $
  };
  A.isArray = function($) {
    return Object.prototype.toString.call($) === "[object Array]"
  };
  A.fn.find = function(C) {
    var _, $ = this[0],
    B = C.split(".")[1];
    if (B) {
      if (document.getElementsByClassName) _ = $.getElementsByClassName(B);
      else _ = F(B, $)
    } else _ = $.getElementsByTagName(C);
    return A(_[0])
  };
  function F(C, $, A) {
    $ = $ || document;
    A = A || "*";
    var G = 0,
    E = 0,
    D = [],
    F = $.getElementsByTagName(A),
    B = F.length,
    _ = new RegExp("(^|\\s)" + C + "(\\s|$)");
    for (; G < B; G++) if (_.test(F[G].className)) {
      D[E] = F[G];
      E++
    }
    return D
  }
  A.each = function(C, B) {
    var $, E = 0,
    A = C.length,
    D = A === I;
    if (D) {
      for ($ in C) if (B.call(C[$], $, C[$]) === false) break
    } else for (var _ = C[0]; E < A && B.call(_, E, _) !== false; _ = C[++E]);
    return C
  };
  A.fn.remove = function() {
    var $ = this[0];
    while ($.firstChild) {
      A.event.remove($.firstChild);
      A.removeData($.firstChild);
      $.removeChild($.firstChild)
    }
    A.event.remove($);
    A.removeData($);
    $.parentNode.removeChild($);
    "CollectGarbage" in G && setTimeout(CollectGarbage, 1);
    return this
  };
  A.fn.data = function(_, B) {
    var $ = A.data(this[0], _, B);
    if (B !== I) return $;
    return this
  };
  A.fn.removeData = function($) {
    A.removeData(this[0], $);
    return this
  };
  A.uuid = 0;
  A.cache = {};
  A.expando = "@cache" + (new Date).getTime();
  A.data = function(_, C, D) {
    var B = A.cache,
    $ = A._getUid(_);
    if (!B[$]) B[$] = {};
    if (D !== I) B[$][C] = D;
    return B[$][C]
  };
  A._getUid = function(_) {
    var B = A.expando,
    $ = _ === G ? 0 : _[B];
    if ($ === I) _[B] = $ = ++A.uuid;
    return $
  };
  A.removeData = function(_, E) {
    var C = A.expando,
    B = A.cache,
    $ = A._getUid(_),
    D = $ && B[$];
    if (!D) return;
    if (E) return delete D[E];
    delete B[$];
    if (_.removeAttribute) _.removeAttribute(C);
    else _[C] = null
  };
  A.fn.bind = function(_, $) {
    A.event.add(this[0], _, $);
    return this
  };
  A.fn.unbind = function(_, $) {
    A.event.remove(this[0], _, $);
    return this
  };
  A.event = {
    add: function($, G, D) {
      var F, _, C = A.data($, "@events") || A.data($, "@events", {}),
      B = "addEventListener" in $,
      E = B ? "addEventListener": "attachEvent";
      F = C[G] = C[G] || {};
      _ = F.listeners = F.listeners || [];
      _.push(D);
      if (!F.handler) {
        F.elem = $;
        F.handler = this.handler(A._getUid($));
        G = B ? G: "on" + G;
        $[E](G, F.handler, false)
      }
    },
    remove: function($, G, E) {
      var H, F, _, D = A.data($, "@events"),
      B = "removeEventListener" in $,
      C = B ? "removeEventListener": "detachEvent";
      if (!D) return;
      if (G === I) for (H in D) this.remove($, H);
      F = D[G];
      if (!F) return;
      _ = F.listeners;
      if (E === I) F.listeners = [];
      else for (H = 0; H < _.length; H++) _[H] === E && _.splice(H--, 1);
      if (_.length === 0) {
        delete D[G];
        G = B ? G: "on" + G;
        $[C](G, F.handler, false)
      }
    },
    handler: function($) {
      return function(B) {
        B = A.event.fix(B || G.event);
        var _ = A.cache[$]["@events"][B.type];
        for (var D = 0,
        C; C = _.listeners[D++];) if (C.call(_.elem, B) === false) {
          B.preventDefault();
          B.stopPropagation()
        }
      }
    },
    fix: function($) {
      if ($.target) return $;
      var _ = {
        target: $.srcElement || document,
        preventDefault: function() {
          $.returnValue = false
        },
        stopPropagation: function() {
          $.cancelBubble = true
        }
      };
      for (var A in $) _[A] = $[A];
      return _
    }
  };
  A.isReady = false;
  A.ready = function() {
    if (!A.isReady) {
      if (!document.body) return setTimeout(A.ready, 13);
      A.isReady = true;
      if (B) {
        var $, _ = 0;
        while (($ = B[_++])) $.call(document, A);
        B = null
      }
    }
  };
  A.bindReady = function() {
    if (D) return;
    D = true;
    if (document.readyState === "complete") return A.ready();
    if (document.addEventListener) {
      document.addEventListener("DOMContentLoaded", H, false);
      G.addEventListener("load", A.ready, false)
    } else if (document.attachEvent) {
      document.attachEvent("onreadystatechange", H);
      G.attachEvent("onload", A.ready);
      var $ = false;
      try {
        $ = G.frameElement == null
      } catch(_) {}
      if (document.documentElement.doScroll && $) C()
    }
  };
  if (document.addEventListener) H = function() {
    document.removeEventListener("DOMContentLoaded", H, false);
    A.ready()
  };
  else if (document.attachEvent) H = function() {
    if (document.readyState === "complete") {
      document.detachEvent("onreadystatechange", H);
      A.ready()
    }
  };
  function C() {
    if (A.isReady) return;
    try {
      document.documentElement.doScroll("left")
    } catch($) {
      setTimeout(C, 1);
      return
    }
    A.ready()
  }
  A.css = "defaultView" in document && "getComputedStyle" in document.defaultView ?
  function($, _) {
    return document.defaultView.getComputedStyle($, false)[_]
  }: function(_, B) {
    var $ = B === "opacity" ? A.opacity.get(_) : _.currentStyle[B];
    return $ || ""
  };
  A.opacity = {
    get: function($) {
      return K ? document.defaultView.getComputedStyle($, false).opacity: M.test(($.currentStyle ? $.currentStyle.filter: $.style.filter) || "") ? (parseFloat(RegExp.$1) / 100) + "": 1
    },
    set: function($, B) {
      if (K) return $.style.opacity = B;
      var _ = $.style;
      _.zoom = 1;
      var A = "alpha(opacity=" + B * 100 + ")",
      C = _.filter || "";
      _.filter = L.test(C) ? C.replace(L, A) : _.filter + " " + A
    }
  };
  A.each(["Left", "Top"],
  function(B, $) {
    var _ = "scroll" + $;
    A.fn[_] = function(A) {
      var $ = this[0],
      C;
      C = E($);
      return C ? ("pageXOffset" in C) ? C[B ? "pageYOffset": "pageXOffset"] : C.document.documentElement[_] || C.document.body[_] : $[_]
    }
  });
  function E($) {
    return A.isWindow($) ? $: $.nodeType === 9 ? $.defaultView || $.parentWindow: false
  }
  A.each(["Height", "Width"],
  function(B, $) {
    var _ = $.toLowerCase();
    A.fn[_] = function(B) {
      var _ = this[0];
      if (!_) return B == null ? null: this;
      return A.isWindow(_) ? _.document.documentElement["client" + $] || _.document.body["client" + $] : (_.nodeType === 9) ? Math.max(_.documentElement["client" + $], _.body["scroll" + $], _.documentElement["scroll" + $], _.body["offset" + $], _.documentElement["offset" + $]) : null
    }
  });
  A.ajax = function(C) {
    var B = G.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"),
    D = C.url;
    if (C.cache === false) {
      var _ = (new Date()).getTime(),
      $ = D.replace(/([?&])_=[^&]*/, "$1_=" + _);
      D = $ + (($ === D) ? (/\?/.test(D) ? "&": "?") + "_=" + _: "")
    }
    B.onreadystatechange = function() {
      if (B.readyState === 4 && B.status === 200) {
        C.success && C.success(B.responseText);
        B.onreadystatechange = A.noop
      }
    };
    B.open("GET", D, 1);
    B.send(null)
  };
  A.fn.animate = function(C, _, $, H) {
    _ = _ || 400;
    if (typeof $ === "function") H = $;
    $ = $ && A.easing[$] ? $: "swing";
    var I = this,
    G, B, D, F, J, E, K = {
      speed: _,
      easing: $,
      callback: function() {
        if (G != null) I[0].style.overflow = "";
        H && H()
      }
    };
    K.curAnim = {};
    A.each(C,
    function(_, $) {
      K.curAnim[_] = $
    });
    A.each(C,
    function(_, $) {
      B = new A.fx(I[0], K, _);
      D = N.exec($);
      F = parseFloat(_ === "opacity" || (I[0].style && I[0].style[_] != null) ? A.css(I[0], _) : I[0][_]);
      J = parseFloat(D[2]);
      E = D[3];
      if (_ === "height" || _ === "width") {
        J = Math.max(0, J);
        G = [I[0].style.overflow, I[0].style.overflowX, I[0].style.overflowY]
      }
      B.custom(F, J, E)
    });
    if (G != null) I[0].style.overflow = "hidden";
    return this
  };
  A.timers = [];
  A.fx = function($, A, _) {
    this.elem = $;
    this.options = A;
    this.prop = _
  };
  A.fx.prototype = {
    custom: function(E, _, C) {
      var B = this;
      B.startTime = A.fx.now();
      B.start = E;
      B.end = _;
      B.unit = C;
      B.now = B.start;
      B.state = B.pos = 0;
      function D() {
        return B.step()
      }
      D.elem = B.elem;
      D();
      A.timers.push(D);
      if (!$) $ = setInterval(A.fx.tick, 13)
    },
    step: function() {
      var $ = this,
      _ = A.fx.now(),
      B = true;
      if (_ >= $.options.speed + $.startTime) {
        $.now = $.end;
        $.state = $.pos = 1;
        $.update();
        $.options.curAnim[$.prop] = true;
        for (var D in $.options.curAnim) if ($.options.curAnim[D] !== true) B = false;
        if (B) $.options.callback.call($.elem);
        return false
      } else {
        var C = _ - $.startTime;
        $.state = C / $.options.speed;
        $.pos = A.easing[$.options.easing]($.state, C, 0, 1, $.options.speed);
        $.now = $.start + (($.end - $.start) * $.pos);
        $.update();
        return true
      }
    },
    update: function() {
      var $ = this;
      if ($.prop === "opacity") A.opacity.set($.elem, $.now);
      else if ($.elem.style && $.elem.style[$.prop] != null) $.elem.style[$.prop] = $.now + $.unit;
      else $.elem[$.prop] = $.now
    }
  };
  A.fx.now = function() {
    return new Date().getTime()
  };
  A.easing = {
    linear: function(A, B, $, _) {
      return $ + _ * A
    },
    swing: function(A, B, $, _) {
      return (( - Math.cos(A * Math.PI) / 2) + 0.5) * _ + $
    }
  };
  A.fx.tick = function() {
    var $ = A.timers;
    for (var _ = 0; _ < $.length; _++) ! $[_]() && $.splice(_--, 1); ! $.length && A.fx.stop()
  };
  A.fx.stop = function() {
    clearInterval($);
    $ = null
  };
  A.fn.stop = function() {
    var $ = A.timers;
    for (var _ = $.length - 1; _ >= 0; _--) if ($[_].elem === this[0]) $.splice(_, 1);
    return this
  };
  return A
} (window)); (function(B, K, N) {
  var D, H, $, E, O = 0,
  L = B(K),
  R = B(document),
  J = B("html"),
  Q = B(function() {
    Q = B("body")
  }),
  F = document.documentElement,
  I = !-[1, ] && !("minWidth" in F.style),
  G = "createTouch" in document && !("onmousemove" in F) || /(iPhone|iPad|iPod)/i.test(navigator.userAgent),
  A = G ? "touchstart": "mousedown",
  M = "artDialog" + (new Date).getTime();
  var P = function(F, _, C) {
    F = F || {};
    if (typeof F === "string" || F.nodeType === 1) F = {
      content: F,
      fixed: !G
    };
    var E, H = [],
    A = P.defaults,
    $ = F.follow = this.nodeType === 1 && this || F.follow;
    for (var I in A) if (F[I] === N) F[I] = A[I];
    if (typeof $ === "string") $ = B($)[0];
    F.id = $ && $[M + "follow"] || F.id || M + O;
    E = P.list[F.id];
    if ($ && E) return E.follow($).zIndex().focus();
    if (E) return E.zIndex();
    if (G) F.fixed = false;
    if (!B.isArray(F.button)) F.button = F.button ? [F.button] : [];
    _ = _ || F.yesFn;
    C = C || F.noFn;
    _ && F.button.push({
      name: F.yesText,
      callback: _,
      focus: true
    });
    C && F.button.push({
      name: F.noText,
      callback: C
    });
    P.defaults.zIndex = F.zIndex;
    O++;
    return P.list[F.id] = D ? D._init(F) : new P.fn._init(F)
  };
  P.fn = P.prototype = {
    version: "4.1.0",
    _init: function(B) {
      var _ = this,
      A, $ = B.icon,
      C = $ && (I ? {
        png: "icons/" + $ + ".png"
      }: {
        backgroundImage: "url('" + B.path + "/icons/" + $ + ".png')"
      });
      _.config = B;
      _._listeners = {};
      _._fixed = I ? false: B.fixed;
      _._elemBack = _._timer = _._focus = _._isClose = _._lock = null;
      A = _.DOM = _.DOM || _._getDOM();
      A.wrap.addClass(B.skin);
      A.close[B.noFn === false ? "hide": "show"]();
      A.icon[0].style.display = $ ? "": "none";
      A.iconBg.css(C || {
        background: "none"
      });
      A.se.css("cursor", B.resize ? "se-resize": "auto");
      A.title.css("cursor", B.drag ? "move": "auto");
      A.content.css("padding", B.padding);
      _[B.show ? "show": "hide"](true).button(B.button).title(B.title).content(B.content).size(B.width, B.height).zIndex(B.zIndex).time(B.time);
      B.follow ? _.follow(B.follow) : _.position(B.left, B.top);
      B.lock && _.lock();
      B.focus && _.focus();
      _._addEvent();
      I && _._pngFix();
      D = null;
      B.initFn && B.initFn.call(_, K);
      return _
    },
    content: function(E) {
      var F, B, C, D, A = this,
      _ = A.DOM.content,
      $ = _[0];
      A._elemBack = null;
      if (E === N) return $;
      else if (typeof E === "string") _.html(E);
      else if (E && E.nodeType === 1) {
        D = E.style.display;
        F = E.previousSibling;
        B = E.nextSibling;
        C = E.parentNode;
        A._elemBack = function() {
          if (F && F.parentNode) F.parentNode.insertBefore(E, F.nextSibling);
          else if (B && F.parentNode) B.parentNode.insertBefore(E, B);
          else if (C) C.appendChild(E);
          E.style.display = D
        };
        _.html("");
        $.appendChild(E);
        E.style.display = "block"
      }
      I && A._selectFix();
      A._runScript($);
      return A
    },
    title: function(A) {
      var B = this.DOM,
      $ = B.wrap,
      _ = B.title,
      C = "aui_state_noTitle";
      if (A === N) return _[0];
      if (A === false) {
        _.hide().html("");
        $.addClass(C)
      } else {
        _.show().html(A);
        $.removeClass(C)
      }
      return this
    },
    position: function(K, O) {
      var D = this,
      H = D.config,
      _ = D.DOM.wrap,
      M = I && D.config.fixed,
      E = R.scrollLeft(),
      B = R.scrollTop(),
      J = D._fixed ? 0 : E,
      $ = D._fixed ? 0 : B,
      F = L.width(),
      A = L.height(),
      C = _[0].offsetWidth,
      N = _[0].offsetHeight,
      G = _[0].style;
      if (!K && K !== 0) K = H.left;
      if (!O && O !== 0) O = H.top;
      H.left = K;
      H.top = O;
      K = D._toNumber(K, F - C);
      if (typeof K === "number") K = M ? (K += E) : K + J;
      if (O === "goldenRatio") O = (N < 4 * A / 7 ? A * 0.382 - N / 2 : (A - N) / 2) + $;
      else {
        O = D._toNumber(O, A - N);
        if (typeof O === "number") O = M ? (O += B) : O + $
      }
      if (typeof K === "number") G.left = Math.max(K, J) + "px";
      else if (typeof K === "string") G.left = K;
      if (typeof O === "number") G.top = Math.max(O, $) + "px";
      else if (typeof O === "string") G.top = O;
      D._autoPositionType();
      return D
    },
    size: function(A, E) {
      var J, K, F, _, D = this,
      M = D.config,
      G = D.DOM,
      $ = G.wrap,
      C = G.main,
      B = $[0].style,
      H = C[0].style;
      if (!A && A !== 0) A = M.width;
      if (!E && E !== 0) E = M.height;
      J = L.width() - $[0].offsetWidth + C[0].offsetWidth;
      F = D._toNumber(A, J);
      M.width = A;
      A = F;
      K = L.height() - $[0].offsetHeight + C[0].offsetHeight;
      _ = D._toNumber(E, K);
      M.height = E;
      E = _;
      if (typeof A === "number") {
        B.width = "auto";
        H.width = Math.max(D.config.minWidth, A) + "px";
        B.width = $[0].offsetWidth + "px"
      } else if (typeof A === "string") {
        H.width = A;
        A === "auto" && $.css("width", "auto")
      }
      if (typeof E === "number") H.height = Math.max(D.config.minHeight, E) + "px";
      else if (typeof E === "string") H.height = E;
      I && D._selectFix();
      return D
    },
    follow: function(H) {
      var P, I = this;
      if (typeof H === "string" || H && H.nodeType === 1) P = B(H);
      if (!P || P.css("display") === "none") return I.position(I.config.left, I.config.top);
      var T = L.width(),
      D = L.height(),
      J = R.scrollLeft(),
      G = R.scrollTop(),
      U = P.offset(),
      F = P[0].offsetWidth,
      K = P[0].offsetHeight,
      Q = I._fixed ? U.left - J: U.left,
      V = I._fixed ? U.top - G: U.top,
      A = I.DOM.wrap[0],
      N = A.style,
      E = A.offsetWidth,
      C = A.offsetHeight,
      S = Q - (E - F) / 2,
      _ = V + K,
      O = I._fixed ? 0 : J,
      $ = I._fixed ? 0 : G;
      S = S < O ? Q: (S + E > T) && (Q - E > O) ? Q - E + F: S;
      _ = (_ + C > D + $) && (V - C > $) ? V - C: _;
      N.left = S + "px";
      N.top = _ + "px";
      I.config.follow = H;
      P[0][M + "follow"] = I.config.id;
      I._autoPositionType();
      return I
    },
    button: function() {
      var A = this,
      E = arguments,
      C = A.DOM,
      _ = C.wrap,
      G = C.buttons,
      $ = G[0],
      D = "aui_state_highlight",
      F = B.isArray(E[0]) ? E[0] : [].slice.call(E);
      B.each(F,
      function(H, _) {
        var G = _.name,
        C = A._listeners,
        F = !C[G],
        E = !F ? C[G].elem: document.createElement("button");
        if (!C[G]) C[G] = {};
        if (_.callback) C[G].callback = _.callback;
        if (_.className) E.className = _.className;
        if (_.focus) {
          A._focus && A._focus.removeClass(D);
          A._focus = B(E).addClass(D);
          A.focus()
        }
        E[M + "callback"] = G;
        E.disabled = !!_.disabled;
        if (F) {
          E.innerHTML = G;
          C[G].elem = E;
          $.appendChild(E)
        }
      });
      G[0].style.display = F.length ? "": "none";
      I && A._selectFix();
      return A
    },
    show: function($) {
      this.DOM.wrap.show(); ! $ && this._lockMaskWrap && this._lockMaskWrap.show();
      return this
    },
    hide: function($) {
      this.DOM.wrap.hide(); ! $ && this._lockMaskWrap && this._lockMaskWrap.hide();
      return this
    },
    close: function() {
      var _ = this,
      A = _.DOM,
      $ = A.wrap,
      B = P.list,
      C = _.config.closeFn,
      E = _.config.follow;
      if (_._isClose) return _;
      _.time();
      if (typeof C === "function" && C.call(_, K) === false) return _;
      _.unlock();
      $[0].className = $[0].style.cssText = "";
      _._elemBack && _._elemBack();
      A.title.html("");
      A.content.html("");
      A.buttons.html("");
      if (P.focus === _) P.focus = null;
      if (E) E[M + "follow"] = null;
      delete B[_.config.id];
      _._isClose = true;
      _._removeEvent();
      _.hide(true)._setAbsolute();
      D ? $.remove() : D = _;
      return _
    },
    time: function(_) {
      var $ = this,
      B = $.config.noText,
      A = $._timer;
      A && clearTimeout(A);
      if (_) $._timer = setTimeout(function() {
        $._trigger(B)
      },
      1000 * _);
      return $
    },
    focus: function() {
      var D, $, _ = this,
      C = _.config,
      B = _.DOM;
      D = _._focus && _._focus[0] || B.close[0];
      try {
        D && D.focus()
      } catch(A) {}
      return _
    },
    zIndex: function() {
      var _ = this,
      $ = _.DOM.wrap,
      A = P.defaults.zIndex++,
      B = P.focus;
      $.css("zIndex", A);
      _._lockMask && _._lockMask.css("zIndex", A - 1);
      if (B) B.DOM.wrap.removeClass("aui_state_focus");
      P.focus = _;
      $.addClass("aui_state_focus");
      return _
    },
    lock: function() {
      if (this._lock) return this;
      var _ = this,
      C = P.defaults.zIndex += 2,
      $ = _.DOM.wrap,
      K = _.config,
      D = R.width(),
      J = R.height(),
      L = _._lockMaskWrap || B(Q[0].appendChild(document.createElement("div"))),
      A = _._lockMask || B(L[0].appendChild(document.createElement("div"))),
      H = "(document).documentElement",
      F = G ? "width:" + D + "px;height:" + J + "px": "width:100%;height:100%",
      E = I ? "position:absolute;left:expression(" + H + ".scrollLeft);top:expression(" + H + ".scrollTop);width:expression(" + H + ".clientWidth);height:expression(" + H + ".clientHeight)": "";
      $.css("zIndex", C);
      L[0].style.cssText = F + ";position:fixed;z-index:" + (C - 1) + ";top:0;left:0;overflow:hidden;" + E;
      A[0].style.cssText = "height:100%;background:" + K.background + ";filter:alpha(opacity=0);opacity:0";
      if (I) A.html("<iframe src=\"about:blank\" style=\"width:100%;height:100%;position:absolute;" + "top:0;left:0;z-index:-1;filter:alpha(opacity=0)\"></iframe>");
      A.stop();
      A[0].ondblclick = function() {
        _.close()
      };
      if (K.duration === 0) A.css({
        opacity: K.opacity
      });
      else A.animate({

        opacity: K.opacity
      },
      K.duration);
      _._lockMaskWrap = L;
      _._lockMask = A;
      _._lock = true;
      return _
    },
    unlock: function(A) {
      var $ = this,
      C = $._lockMaskWrap,
      _ = $._lockMask;
      if (!$._lock) return $;
      var B = C[0].style,
      E = function() {
        if (I) {
          B.removeExpression("width");
          B.removeExpression("height");
          B.removeExpression("left");
          B.removeExpression("top")
        }
        B.cssText = "display:none";
        if (D) {
          C.remove();
          $._lockMaskWrap = $._lockMask = null
        }
      };
      _.stop();
      _[0].ondblclick = null;
      if ($.config.duration === 0) E();
      else _.animate({
        opacity: 0
      },
      $.config.duration, E);
      $._lock = false;
      return $
    },
    _getDOM: function($) {
      $ = document.createElement("div");
      $.style.cssText = "position:absolute;left:0;top:0";
      $.innerHTML = P.templates;
      document.body.appendChild($);
      var _ = {
        wrap: B($)
      },
      C = $.getElementsByTagName("*"),
      A = C.length;
      for (var D = 0; D < A; D++) _[C[D].className.split("aui_")[1]] = B(C[D]);
      return _
    },
    _toNumber: function(_, A) {
      if (!_ && _ !== 0 || typeof _ === "number") return _;
      var $ = _.length - 1;
      if (_.lastIndexOf("px") === $) _ = parseInt(_);
      else if (_.lastIndexOf("%") === $) _ = parseInt(A * _.split("%")[0] / 100);
      return _
    },
    _pngFix: function() {
      var E = 0,
      $, A, C, _, B = P.defaults.path + "/",
      D = this.DOM.wrap[0].getElementsByTagName("*");
      for (; E < D.length; E++) {
        $ = D[E];
        A = $.currentStyle["png"];
        if (A) {
          C = B + A;
          _ = $.runtimeStyle;
          _.backgroundImage = "none";
          _.filter = "progid:DXImageTransform.Microsoft." + "AlphaImageLoader(src='" + C + "',sizingMethod='crop')"
        }
      }
    },
    _selectFix: function() {
      var $ = this.DOM.wrap[0],
      B = M + "iframeMask",
      A = $[B],
      C = $.offsetWidth,
      _ = $.offsetHeight,
      D = -(C - $.clientWidth) / 2 + "px",
      E = -(_ - $.clientHeight) / 2 + "px";
      C = C + "px";
      _ = _ + "px";
      if (A) {
        A.style.width = C;
        A.style.height = _
      } else {
        A = $.appendChild(document.createElement("iframe"));
        $[B] = A;
        A.src = "about:blank";
        A.style.cssText = "position:absolute;z-index:-1;left:" + D + ";top:" + E + ";width:" + C + ";height:" + _ + ";filter:alpha(opacity=0)"
      }
    },
    _runScript: function(_) {
      var C, E = 0,
      B = 0,
      $ = _.getElementsByTagName("script"),
      A = $.length,
      D = [];
      for (; E < A; E++) if ($[E].type === "text/dialog") {
        D[B] = $[E].innerHTML;
        B++
      }
      if (D.length) {
        D = D.join("");
        C = new Function(D);
        C.call(this)
      }
    },
    _autoPositionType: function() {
      var $ = this;
      $[$.config.fixed ? "_setFixed": "_setAbsolute"]()
    },
    _setFixed: (function() {
      I && B(function() {
        var $ = "backgroundAttachment";
        if (J.css($) !== "fixed" && Q.css($) !== "fixed") J.css({
          backgroundImage: "url(about:blank)",
          backgroundAttachment: "fixed"
        })
      });
      return function() {
        var A = this.DOM.wrap,
        _ = A[0].style;
        if (I) {
          var B = parseInt(A.css("left")),
          E = parseInt(A.css("top")),
          $ = R.scrollLeft(),
          C = R.scrollTop(),
          D = "(document.documentElement)";
          this._setAbsolute();
          _.setExpression("left", "eval(" + D + ".scrollLeft + " + (B - $) + ") + \"px\"");
          _.setExpression("top", "eval(" + D + ".scrollTop + " + (E - C) + ") + \"px\"")
        } else _.position = "fixed"
      }
    } ()),
    _setAbsolute: function() {
      var $ = this.DOM.wrap[0].style;
      if (I) {
        $.removeExpression("left");
        $.removeExpression("top")
      }
      $.position = "absolute"
    },
    _trigger: function($) {
      var _ = this,
      A = _._listeners[$] && _._listeners[$].callback;
      return typeof A !== "function" || A.call(_, K) !== false ? _.close() : _
    },
    _addEvent: function() {
      var E, B, $ = this,
      C = $.config,
      _ = $.DOM,
      D = L.width() * L.height();
      $._click = function(B) {
        var D = B.target,
        A;
        if (D.disabled) return false;
        if (D === _.close[0]) {
          $._trigger(C.noText);
          return false
        } else {
          A = D[M + "callback"];
          A && $._trigger(A)
        }
      };
      $._eventDown = function() {
        $.zIndex()
      };
      E = function() {
        var H, F = D,
        _ = C.follow,
        B = C.width,
        A = C.height,
        E = C.left,
        G = C.top;
        if ("all" in document) {
          H = L.width() * L.height();
          D = H;
          if (F === H) return
        }
        if (B || A) $.size(B, A);
        if (_) $.follow(_);
        else if (E || G) $.position(E, G)
      };
      $._winResize = function() {
        B && clearTimeout(B);
        B = setTimeout(function() {
          E()
        },
        40)
      };
      _.wrap.bind("click", $._click).bind(A, $._eventDown);
      L.bind("resize", $._winResize)
    },
    _removeEvent: function() {
      var $ = this,
      _ = $.DOM;
      _.wrap.unbind("click", $._click).unbind(A, $._eventDown);
      L.unbind("resize", $._winResize)
    }
  };
  P.fn._init.prototype = P.fn;
  B.fn.dialog = B.fn.artDialog = function() {
    var $ = arguments;
    this[this.live ? "live": "bind"]("click",
    function() {
      P.apply(this, $);
      return false
    });
    return this
  };
  P.focus = null;
  P.list = {};
  R.bind("keydown",
  function(_) {
    var B = _.target,
    A = B.nodeName,
    D = /^INPUT|TEXTAREA$/,
    C = P.focus,
    $ = _.keyCode;
    if (!C || !C.config.esc || D.test(A)) return;
    $ === 27 && C._trigger(C.config.noText)
  });
  E = K["_artDialog_path"] || (function(_, A, $) {
    for (A in _) if (_[A].src && _[A].src.indexOf("artDialog") !== -1) $ = _[A];
    H = $ || _[_.length - 1];
    $ = H.src.replace(/\\/g, "/");
    return $.lastIndexOf("/") < 0 ? ".": $.substring(0, $.lastIndexOf("/"))
  } (document.getElementsByTagName("script")));
  $ = H.src.split("skin=")[1];
  if ($) {
    var C = document.createElement("link");
    C.rel = "stylesheet";
    C.href = E + "/" + $ + ".css?" + P.fn.version;
    H.parentNode.insertBefore(C, H)
  }
  L.bind("load",
  function() {
    setTimeout(function() {
      if (O) return;
      P({
        time: 9,
        left: "-9999em",
        fixed: false,
        lock: false,
        focus: false
      })
    },
    150)
  });
  try {
    document.execCommand("BackgroundImageCache", false, true)
  } catch(_) {}
  P.templates = "<div class=\"aui_outer\"><table class=\"aui_border\"><tbody><tr><td class=\"aui_nw\"></td><td class=\"aui_n\"></td><td class=\"aui_ne\"></td></tr><tr><td class=\"aui_w\"></td><td class=\"aui_center\"><table class=\"aui_inner\"><tbody><tr><td colspan=\"2\" class=\"aui_header\"><div class=\"aui_titleBar\"><div class=\"aui_title\"></div><a class=\"aui_close\" href=\"javascript:/*artDialog*/;\">\关闭</a></div></td></tr><tr><td class=\"aui_icon\"><div class=\"aui_iconBg\"></div></td><td class=\"aui_main\"><div class=\"aui_content\"></div><div class=\"aui_buttons\"></div></td></tr></tbody></table></td><td class=\"aui_e\"></td></tr><tr><td class=\"aui_sw\"></td><td class=\"aui_s\"></td><td class=\"aui_se\"></td></tr></tbody></table></div>";
  P.defaults = {
    content: "<div class=\"aui_loading\"><span>loading..</span></div>",
    title: "\u6d88\u606f",
    button: null,
    yesFn: null,
    noFn: null,
    yesText: "\u786e\u5b9a",
    noText: "\u53d6\u6d88",
    width: "auto",
    height: "auto",
    minWidth: 96,
    minHeight: 32,
    padding: "20px 25px",
    skin: "",
    icon: null,
    initFn: null,
    closeFn: null,
    time: null,
    esc: true,
    focus: true,
    show: true,
    follow: null,
    path: E,
    lock: false,
    background: "#fff",
    opacity: 0.5,
    duration: 300,
    fixed: false,
    left: "50%",
    top: "goldenRatio",
    zIndex: 1987,
    resize: true,
    drag: true
  };
  K.artDialog = B.dialog = B.artDialog = P
} ((window.jQuery && (window.art = jQuery)) || window.art, this)); (function(C) {
  var F, D, A = C(window),
  G = C(document),
  $ = document.documentElement,
  _ = !-[1, ] && !("minWidth" in $.style),
  B = "onlosecapture" in $,
  E = "setCapture" in $;
  artDialog.dragEvent = function() {
    var $ = this,
    _ = function(_) {
      var A = $[_];
      $[_] = function() {
        return A.apply($, arguments)
      }
    };
    _("start");
    _("move");
    _("end")
  };
  artDialog.dragEvent.prototype = {
    onstart: C.noop,
    start: function($) {
      G.bind("mousemove", this.move).bind("mouseup", this.end);
      this._sClientX = $.clientX;
      this._sClientY = $.clientY;
      this.onstart($.clientX, $.clientY);
      return false
    },
    onmove: C.noop,
    move: function($) {
      this._mClientX = $.clientX;
      this._mClientY = $.clientY;
      this.onmove($.clientX - this._sClientX, $.clientY - this._sClientY);
      return false
    },
    onend: C.noop,
    end: function($) {
      G.unbind("mousemove", this.move).unbind("mouseup", this.end);
      this.onend($.clientX, $.clientY);
      return false
    }
  };
  D = function(O) {
    var $, D, P, J, M, K, Q = artDialog.focus,
    R = Q.config,
    N = Q.DOM,
    C = N.wrap,
    L = N.title,
    I = N.main,
    H = "getSelection" in window ?
    function() {
      window.getSelection().removeAllRanges()
    }: function() {
      try {
        document.selection.empty()
      } catch($) {}
    };
    F.onstart = function(H, $) {
      if (K) {
        D = I[0].offsetWidth;
        P = I[0].offsetHeight
      } else {
        J = C[0].offsetLeft;
        M = C[0].offsetTop
      }
      G.bind("dblclick", F.end); ! _ && B ? L.bind("losecapture", F.end) : A.bind("blur", F.end);
      E && L[0].setCapture();
      C.addClass("aui_state_drag");
      Q.focus()
    };
    F.onmove = function(O, L) {
      if (K) {
        var F = C[0].style,
        B = I[0].style,
        E = O + D,
        A = L + P;
        F.width = "auto";
        B.width = Math.max(0, E) + "px";
        R.width = C[0].offsetWidth;
        F.width = R.width + "px";
        R.height = Math.max(0, A);
        B.height = R.height + "px"
      } else {
        var B = C[0].style,
        G = O + J,
        N = L + M;
        B.left = Math.max($.minX, Math.min($.maxX, G)) + "px";
        B.top = Math.max($.minY, Math.min($.maxY, N)) + "px"
      }
      H();
      _ && Q._selectFix()
    };
    F.onend = function(D, $) {
      G.unbind("dblclick", F.end); ! _ && B ? L.unbind("losecapture", F.end) : A.unbind("blur", F.end);
      E && L[0].releaseCapture();
      _ && Q._autoPositionType();
      C.removeClass("aui_state_drag")
    };
    K = O.target === N.se[0] ? true: false;
    $ = (function() {
      var F, E, B = Q.DOM.wrap[0],
      I = B.style.position === "fixed",
      H = B.offsetWidth,
      J = B.offsetHeight,
      C = A.width(),
      _ = A.height(),
      D = I ? 0 : G.scrollLeft(),
      $ = I ? 0 : G.scrollTop(),
      F = C - H + D;
      E = _ - J + $;
      return {
        minX: D,
        minY: $,
        maxX: F,
        maxY: E
      }
    })();
    F.start(O)
  };
  G.bind("mousedown",
  function(_) {
    var C = artDialog.focus;
    if (!C) return;
    var A = _.target,
    B = C.config,
    $ = C.DOM;
    if (B.drag !== false && A === $.title[0] || B.resize !== false && A === $.se[0]) {
      F = F || new artDialog.dragEvent();
      D(_);
      return false
    }
  })
})(window.jQuery || window.art)