/**
 * fileuploader
 * Copyright (c) 2020 Innostudio.de
 * Website: https://innostudio.de/fileuploader/
 * Version: 2.2 (12 Mar 2020)
 * License: https://innostudio.de/fileuploader/documentation/#license
 */
!function () {
    (function () {
        function aa(g) {
            function r() {
                try {
                    L.doScroll("left")
                } catch (ba) {
                    k.setTimeout(r, 50);
                    return
                }
                x("poll")
            }

            function x(r) {
                if ("readystatechange" != r.type || "complete" == z.readyState)
                    ("load" == r.type ? k : z)[B](n + r.type, x, !1), !l && (l = !0) && g.call(k, r.type || r)
            }
            var X = z.addEventListener,
                    l = !1,
                    E = !0,
                    v = X ? "addEventListener" : "attachEvent",
                    B = X ? "removeEventListener" : "detachEvent",
                    n = X ? "" : "on";
            if ("complete" == z.readyState)
                g.call(k, "lazy");
            else {
                if (z.createEventObject && L.doScroll) {
                    try {
                        E = !k.frameElement
                    } catch (ba) {
                    }
                    E && r()
                }
                z[v](n +
                        "DOMContentLoaded", x, !1);
                z[v](n + "readystatechange", x, !1);
                k[v](n + "load", x, !1)
            }
        }

        function T() {
            U && aa(function () {
                var g = M.length;
                ca(g ? function () {
                    for (var r = 0; r < g; ++r)
                        (function (g) {
                            k.setTimeout(function () {
                                k.exports[M[g]].apply(k, arguments)
                            }, 0)
                        })(r)
                } : void 0)
            })
        }
        for (var k = window, z = document, L = z.documentElement, N = z.head || z.getElementsByTagName("head")[0] || L, B = "", F = z.getElementsByTagName("script"), l = F.length; 0 <= --l; ) {
            var O = F[l],
                    Y = O.src.match(/^[^?#]*\/run_prettify\.js(\?[^#]*)?(?:#.*)?$/);
            if (Y) {
                B = Y[1] || "";
                O.parentNode.removeChild(O);
                break
            }
        }
        var U = !0,
                H = [],
                P = [],
                M = [];
        B.replace(/[?&]([^&=]+)=([^&]+)/g, function (g, r, x) {
            x = decodeURIComponent(x);
            r = decodeURIComponent(r);
            "autorun" == r ? U = !/^[0fn]/i.test(x) : "lang" == r ? H.push(x) : "skin" == r ? P.push(x) : "callback" == r && M.push(x)
        });
        l = 0;
        for (B = H.length; l < B; ++l)
            (function () {
                var g = z.createElement("script");
                g.onload = g.onerror = g.onreadystatechange = function () {
                    !g || g.readyState && !/loaded|complete/.test(g.readyState) || (g.onerror = g.onload = g.onreadystatechange = null, --S, S || k.setTimeout(T, 0), g.parentNode && g.parentNode.removeChild(g),
                            g = null)
                };
                g.type = "text/javascript";
                g.src = "https://cdn.rawgit.com/google/code-prettify/master/loader/lang-" + encodeURIComponent(H[l]) + ".js";
                N.insertBefore(g, N.firstChild)
            })(H[l]);
        for (var S = H.length, F = [], l = 0, B = P.length; l < B; ++l)
            F.push("https://cdn.rawgit.com/google/code-prettify/master/loader/skins/" + encodeURIComponent(P[l]) + ".css");
        F.push("https://cdn.rawgit.com/google/code-prettify/master/loader/prettify.css");
        (function (g) {
            function r(l) {
                if (l !== x) {
                    var k = z.createElement("link");
                    k.rel = "stylesheet";
                    k.type =
                            "text/css";
                    l + 1 < x && (k.error = k.onerror = function () {
                        r(l + 1)
                    });
                    k.href = g[l];
                    N.appendChild(k)
                }
            }
            var x = g.length;
            r(0)
        })(F);
        var ca = function () {
            "undefined" !== typeof window && (window.PR_SHOULD_USE_CONTINUATION = !0);
            var g;
            (function () {
                function r(a) {
                    function d(e) {
                        var a = e.charCodeAt(0);
                        if (92 !== a)
                            return a;
                        var c = e.charAt(1);
                        return (a = k[c]) ? a : "0" <= c && "7" >= c ? parseInt(e.substring(1), 8) : "u" === c || "x" === c ? parseInt(e.substring(2), 16) : e.charCodeAt(1)
                    }

                    function f(e) {
                        if (32 > e)
                            return (16 > e ? "\\x0" : "\\x") + e.toString(16);
                        e = String.fromCharCode(e);
                        return "\\" === e || "-" === e || "]" === e || "^" === e ? "\\" + e : e
                    }

                    function c(e) {
                        var c = e.substring(1, e.length - 1).match(RegExp("\\\\u[0-9A-Fa-f]{4}|\\\\x[0-9A-Fa-f]{2}|\\\\[0-3][0-7]{0,2}|\\\\[0-7]{1,2}|\\\\[\\s\\S]|-|[^-\\\\]", "g"));
                        e = [];
                        var a = "^" === c[0],
                                b = ["["];
                        a && b.push("^");
                        for (var a = a ? 1 : 0, h = c.length; a < h; ++a) {
                            var m = c[a];
                            if (/\\[bdsw]/i.test(m))
                                b.push(m);
                            else {
                                var m = d(m),
                                        p;
                                a + 2 < h && "-" === c[a + 1] ? (p = d(c[a + 2]), a += 2) : p = m;
                                e.push([m, p]);
                                65 > p || 122 < m || (65 > p || 90 < m || e.push([Math.max(65, m) | 32, Math.min(p, 90) | 32]), 97 > p || 122 < m ||
                                        e.push([Math.max(97, m) & -33, Math.min(p, 122) & -33]))
                            }
                        }
                        e.sort(function (e, a) {
                            return e[0] - a[0] || a[1] - e[1]
                        });
                        c = [];
                        h = [];
                        for (a = 0; a < e.length; ++a)
                            m = e[a], m[0] <= h[1] + 1 ? h[1] = Math.max(h[1], m[1]) : c.push(h = m);
                        for (a = 0; a < c.length; ++a)
                            m = c[a], b.push(f(m[0])), m[1] > m[0] && (m[1] + 1 > m[0] && b.push("-"), b.push(f(m[1])));
                        b.push("]");
                        return b.join("")
                    }

                    function g(e) {
                        for (var a = e.source.match(RegExp("(?:\\[(?:[^\\x5C\\x5D]|\\\\[\\s\\S])*\\]|\\\\u[A-Fa-f0-9]{4}|\\\\x[A-Fa-f0-9]{2}|\\\\[0-9]+|\\\\[^ux0-9]|\\(\\?[:!=]|[\\(\\)\\^]|[^\\x5B\\x5C\\(\\)\\^]+)",
                                "g")), b = a.length, d = [], h = 0, m = 0; h < b; ++h) {
                            var p = a[h];
                            "(" === p ? ++m : "\\" === p.charAt(0) && (p = +p.substring(1)) && (p <= m ? d[p] = -1 : a[h] = f(p))
                        }
                        for (h = 1; h < d.length; ++h)
                            -1 === d[h] && (d[h] = ++r);
                        for (m = h = 0; h < b; ++h)
                            p = a[h], "(" === p ? (++m, d[m] || (a[h] = "(?:")) : "\\" === p.charAt(0) && (p = +p.substring(1)) && p <= m && (a[h] = "\\" + d[p]);
                        for (h = 0; h < b; ++h)
                            "^" === a[h] && "^" !== a[h + 1] && (a[h] = "");
                        if (e.ignoreCase && A)
                            for (h = 0; h < b; ++h)
                                p = a[h], e = p.charAt(0), 2 <= p.length && "[" === e ? a[h] = c(p) : "\\" !== e && (a[h] = p.replace(/[a-zA-Z]/g, function (a) {
                                    a = a.charCodeAt(0);
                                    return "[" + String.fromCharCode(a & -33, a | 32) + "]"
                                }));
                        return a.join("")
                    }
                    for (var r = 0, A = !1, q = !1, I = 0, b = a.length; I < b; ++I) {
                        var t = a[I];
                        if (t.ignoreCase)
                            q = !0;
                        else if (/[a-z]/i.test(t.source.replace(/\\u[0-9a-f]{4}|\\x[0-9a-f]{2}|\\[^ux]/gi, ""))) {
                            A = !0;
                            q = !1;
                            break
                        }
                    }
                    for (var k = {
                        b: 8,
                        t: 9,
                        n: 10,
                        v: 11,
                        f: 12,
                        r: 13
                    }, u = [], I = 0, b = a.length; I < b; ++I) {
                        t = a[I];
                        if (t.global || t.multiline)
                            throw Error("" + t);
                        u.push("(?:" + g(t) + ")")
                    }
                    return new RegExp(u.join("|"), q ? "gi" : "g")
                }

                function l(a, d) {
                    function f(a) {
                        var b = a.nodeType;
                        if (1 == b) {
                            if (!c.test(a.className)) {
                                for (b =
                                        a.firstChild; b; b = b.nextSibling)
                                    f(b);
                                b = a.nodeName.toLowerCase();
                                if ("br" === b || "li" === b)
                                    g[q] = "\n", A[q << 1] = r++, A[q++ << 1 | 1] = a
                            }
                        } else if (3 == b || 4 == b)
                            b = a.nodeValue, b.length && (b = d ? b.replace(/\r\n?/g, "\n") : b.replace(/[ \t\r\n]+/g, " "), g[q] = b, A[q << 1] = r, r += b.length, A[q++ << 1 | 1] = a)
                    }
                    var c = /(?:^|\s)nocode(?:\s|$)/,
                            g = [],
                            r = 0,
                            A = [],
                            q = 0;
                    f(a);
                    return {
                        a: g.join("").replace(/\n$/, ""),
                        c: A
                    }
                }

                function k(a, d, f, c, g) {
                    f && (a = {
                        h: a,
                        l: 1,
                        j: null,
                        m: null,
                        a: f,
                        c: null,
                        i: d,
                        g: null
                    }, c(a), g.push.apply(g, a.g))
                }

                function z(a) {
                    for (var d = void 0, f = a.firstChild; f; f =
                            f.nextSibling)
                        var c = f.nodeType,
                            d = 1 === c ? d ? a : f : 3 === c ? S.test(f.nodeValue) ? a : d : d;
                    return d === a ? void 0 : d
                }

                function E(a, d) {
                    function f(a) {
                        for (var q = a.i, r = a.h, b = [q, "pln"], t = 0, A = a.a.match(g) || [], u = {}, e = 0, l = A.length; e < l; ++e) {
                            var D = A[e],
                                    w = u[D],
                                    h = void 0,
                                    m;
                            if ("string" === typeof w)
                                m = !1;
                            else {
                                var p = c[D.charAt(0)];
                                if (p)
                                    h = D.match(p[1]), w = p[0];
                                else {
                                    for (m = 0; m < n; ++m)
                                        if (p = d[m], h = D.match(p[1])) {
                                            w = p[0];
                                            break
                                        }
                                    h || (w = "pln")
                                }
                                !(m = 5 <= w.length && "lang-" === w.substring(0, 5)) || h && "string" === typeof h[1] || (m = !1, w = "src");
                                m || (u[D] = w)
                            }
                            p = t;
                            t += D.length;
                            if (m) {
                                m = h[1];
                                var C = D.indexOf(m),
                                        G = C + m.length;
                                h[2] && (G = D.length - h[2].length, C = G - m.length);
                                w = w.substring(5);
                                k(r, q + p, D.substring(0, C), f, b);
                                k(r, q + p + C, m, F(w, m), b);
                                k(r, q + p + G, D.substring(G), f, b)
                            } else
                                b.push(q + p, w)
                        }
                        a.g = b
                    }
                    var c = {},
                            g;
                    (function () {
                        for (var f = a.concat(d), q = [], k = {}, b = 0, t = f.length; b < t; ++b) {
                            var n = f[b],
                                    u = n[3];
                            if (u)
                                for (var e = u.length; 0 <= --e; )
                                    c[u.charAt(e)] = n;
                            n = n[1];
                            u = "" + n;
                            k.hasOwnProperty(u) || (q.push(n), k[u] = null)
                        }
                        q.push(/[\0-\uffff]/);
                        g = r(q)
                    })();
                    var n = d.length;
                    return f
                }

                function v(a) {
                    var d = [],
                            f = [];
                    a.tripleQuotedStrings ? d.push(["str", /^(?:\'\'\'(?:[^\'\\]|\\[\s\S]|\'{1,2}(?=[^\']))*(?:\'\'\'|$)|\"\"\"(?:[^\"\\]|\\[\s\S]|\"{1,2}(?=[^\"]))*(?:\"\"\"|$)|\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$))/, null, "'\""]) : a.multiLineStrings ? d.push(["str", /^(?:\'(?:[^\\\']|\\[\s\S])*(?:\'|$)|\"(?:[^\\\"]|\\[\s\S])*(?:\"|$)|\`(?:[^\\\`]|\\[\s\S])*(?:\`|$))/, null, "'\"`"]) : d.push(["str", /^(?:\'(?:[^\\\'\r\n]|\\.)*(?:\'|$)|\"(?:[^\\\"\r\n]|\\.)*(?:\"|$))/, null, "\"'"]);
                    a.verbatimStrings &&
                            f.push(["str", /^@\"(?:[^\"]|\"\")*(?:\"|$)/, null]);
                    var c = a.hashComments;
                    c && (a.cStyleComments ? (1 < c ? d.push(["com", /^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/, null, "#"]) : d.push(["com", /^#(?:(?:define|e(?:l|nd)if|else|error|ifn?def|include|line|pragma|undef|warning)\b|[^\r\n]*)/, null, "#"]), f.push(["str", /^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h(?:h|pp|\+\+)?|[a-z]\w*)>/, null])) : d.push(["com", /^#[^\r\n]*/, null, "#"]));
                    a.cStyleComments && (f.push(["com", /^\/\/[^\r\n]*/, null]), f.push(["com", /^\/\*[\s\S]*?(?:\*\/|$)/,
                        null
                    ]));
                    if (c = a.regexLiterals) {
                        var g = (c = 1 < c ? "" : "\n\r") ? "." : "[\\S\\s]";
                        f.push(["lang-regex", RegExp("^(?:^^\\.?|[+-]|[!=]=?=?|\\#|%=?|&&?=?|\\(|\\*=?|[+\\-]=|->|\\/=?|::?|<<?=?|>>?>?=?|,|;|\\?|@|\\[|~|{|\\^\\^?=?|\\|\\|?=?|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\\s*(" + ("/(?=[^/*" + c + "])(?:[^/\\x5B\\x5C" + c + "]|\\x5C" + g + "|\\x5B(?:[^\\x5C\\x5D" + c + "]|\\x5C" + g + ")*(?:\\x5D|$))+/") + ")")])
                    }
                    (c = a.types) && f.push(["typ", c]);
                    c = ("" + a.keywords).replace(/^ | $/g, "");
                    c.length && f.push(["kwd",
                        new RegExp("^(?:" + c.replace(/[\s,]+/g, "|") + ")\\b"), null
                    ]);
                    d.push(["pln", /^\s+/, null, " \r\n\t\u00a0"]);
                    c = "^.[^\\s\\w.$@'\"`/\\\\]*";
                    a.regexLiterals && (c += "(?!s*/)");
                    f.push(["lit", /^@[a-z_$][a-z_$@0-9]*/i, null], ["typ", /^(?:[@_]?[A-Z]+[a-z][A-Za-z_$@0-9]*|\w+_t\b)/, null], ["pln", /^[a-z_$][a-z_$@0-9]*/i, null], ["lit", /^(?:0x[a-f0-9]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+\-]?\d+)?)[a-z]*/i, null, "0123456789"], ["pln", /^\\[\s\S]?/, null], ["pun", new RegExp(c), null]);
                    return E(d, f)
                }

                function B(a, d, f) {
                    function c(a) {
                        var b =
                                a.nodeType;
                        if (1 == b && !r.test(a.className))
                            if ("br" === a.nodeName.toLowerCase())
                                g(a), a.parentNode && a.parentNode.removeChild(a);
                            else
                                for (a = a.firstChild; a; a = a.nextSibling)
                                    c(a);
                        else if ((3 == b || 4 == b) && f) {
                            var e = a.nodeValue,
                                    d = e.match(n);
                            d && (b = e.substring(0, d.index), a.nodeValue = b, (e = e.substring(d.index + d[0].length)) && a.parentNode.insertBefore(q.createTextNode(e), a.nextSibling), g(a), b || a.parentNode.removeChild(a))
                        }
                    }

                    function g(a) {
                        function c(a, b) {
                            var e = b ? a.cloneNode(!1) : a,
                                    p = a.parentNode;
                            if (p) {
                                var p = c(p, 1),
                                        d = a.nextSibling;
                                p.appendChild(e);
                                for (var f = d; f; f = d)
                                    d = f.nextSibling, p.appendChild(f)
                            }
                            return e
                        }
                        for (; !a.nextSibling; )
                            if (a = a.parentNode, !a)
                                return;
                        a = c(a.nextSibling, 0);
                        for (var e;
                                (e = a.parentNode) && 1 === e.nodeType; )
                            a = e;
                        b.push(a)
                    }
                    for (var r = /(?:^|\s)nocode(?:\s|$)/, n = /\r\n?|\n/, q = a.ownerDocument, k = q.createElement("li"); a.firstChild; )
                        k.appendChild(a.firstChild);
                    for (var b = [k], t = 0; t < b.length; ++t)
                        c(b[t]);
                    d === (d | 0) && b[0].setAttribute("value", d);
                    var l = q.createElement("ol");
                    l.className = "linenums";
                    d = Math.max(0, d - 1 | 0) || 0;
                    for (var t =
                            0, u = b.length; t < u; ++t)
                        k = b[t], k.className = "L" + (t + d) % 10, k.firstChild || k.appendChild(q.createTextNode("\u00a0")), l.appendChild(k);
                    a.appendChild(l)
                }

                function n(a, d) {
                    for (var f = d.length; 0 <= --f; ) {
                        var c = d[f];
                        V.hasOwnProperty(c) ? Q.console && console.warn("cannot override language handler %s", c) : V[c] = a
                    }
                }

                function F(a, d) {
                    a && V.hasOwnProperty(a) || (a = /^\s*</.test(d) ? "default-markup" : "default-code");
                    return V[a]
                }

                function H(a) {
                    var d = a.j;
                    try {
                        var f = l(a.h, a.l),
                                c = f.a;
                        a.a = c;
                        a.c = f.c;
                        a.i = 0;
                        F(d, c)(a);
                        var g = /\bMSIE\s(\d+)/.exec(navigator.userAgent),
                                g = g && 8 >= +g[1],
                                d = /\n/g,
                                r = a.a,
                                k = r.length,
                                f = 0,
                                q = a.c,
                                n = q.length,
                                c = 0,
                                b = a.g,
                                t = b.length,
                                v = 0;
                        b[t] = k;
                        var u, e;
                        for (e = u = 0; e < t; )
                            b[e] !== b[e + 2] ? (b[u++] = b[e++], b[u++] = b[e++]) : e += 2;
                        t = u;
                        for (e = u = 0; e < t; ) {
                            for (var x = b[e], z = b[e + 1], w = e + 2; w + 2 <= t && b[w + 1] === z; )
                                w += 2;
                            b[u++] = x;
                            b[u++] = z;
                            e = w
                        }
                        b.length = u;
                        var h = a.h;
                        a = "";
                        h && (a = h.style.display, h.style.display = "none");
                        try {
                            for (; c < n; ) {
                                var m = q[c + 2] || k,
                                        p = b[v + 2] || k,
                                        w = Math.min(m, p),
                                        C = q[c + 1],
                                        G;
                                if (1 !== C.nodeType && (G = r.substring(f, w))) {
                                    g && (G = G.replace(d, "\r"));
                                    C.nodeValue = G;
                                    var Z = C.ownerDocument,
                                            W = Z.createElement("span");
                                    W.className = b[v + 1];
                                    var B = C.parentNode;
                                    B.replaceChild(W, C);
                                    W.appendChild(C);
                                    f < m && (q[c + 1] = C = Z.createTextNode(r.substring(w, m)), B.insertBefore(C, W.nextSibling))
                                }
                                f = w;
                                f >= m && (c += 2);
                                f >= p && (v += 2)
                            }
                        } finally {
                            h && (h.style.display = a)
                        }
                    } catch (y) {
                        Q.console && console.log(y && y.stack || y)
                    }
                }
                var Q = "undefined" !== typeof window ? window : {},
                        J = ["break,continue,do,else,for,if,return,while"],
                        K = [
                            [J, "auto,case,char,const,default,double,enum,extern,float,goto,inline,int,long,register,restrict,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"],
                            "catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"
                        ],
                        R = [K, "alignas,alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,delegate,dynamic_cast,explicit,export,friend,generic,late_check,mutable,namespace,noexcept,noreturn,nullptr,property,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"],
                        L = [K, "abstract,assert,boolean,byte,extends,finally,final,implements,import,instanceof,interface,null,native,package,strictfp,super,synchronized,throws,transient"],
                        M = [K, "abstract,add,alias,as,ascending,async,await,base,bool,by,byte,checked,decimal,delegate,descending,dynamic,event,finally,fixed,foreach,from,get,global,group,implicit,in,interface,internal,into,is,join,let,lock,null,object,out,override,orderby,params,partial,readonly,ref,remove,sbyte,sealed,select,set,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,value,var,virtual,where,yield"],
                        K = [K, "abstract,async,await,constructor,debugger,enum,eval,export,from,function,get,import,implements,instanceof,interface,let,null,of,set,undefined,var,with,yield,Infinity,NaN"],
                        N = [J, "and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"],
                        O = [J, "alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"],
                        J = [J, "case,done,elif,esac,eval,fi,function,in,local,set,then,until"],
                        P = /^(DIR|FILE|array|vector|(de|priority_)?queue|(forward_)?list|stack|(const_)?(reverse_)?iterator|(unordered_)?(multi)?(set|map)|bitset|u?(int|float)\d*)\b/,
                        S = /\S/,
                        T = v({
                            keywords: [R, M, L, K, "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END", N, O, J],
                            hashComments: !0,
                            cStyleComments: !0,
                            multiLineStrings: !0,
                            regexLiterals: !0
                        }),
                        V = {};
                n(T, ["default-code"]);
                n(E([], [
                    ["pln", /^[^<?]+/],
                    ["dec", /^<!\w[^>]*(?:>|$)/],
                    ["com", /^<\!--[\s\S]*?(?:-\->|$)/],
                    ["lang-", /^<\?([\s\S]+?)(?:\?>|$)/],
                    ["lang-", /^<%([\s\S]+?)(?:%>|$)/],
                    ["pun", /^(?:<[%?]|[%?]>)/],
                    ["lang-",
                        /^<xmp\b[^>]*>([\s\S]+?)<\/xmp\b[^>]*>/i
                    ],
                    ["lang-js", /^<script\b[^>]*>([\s\S]*?)(<\/script\b[^>]*>)/i],
                    ["lang-css", /^<style\b[^>]*>([\s\S]*?)(<\/style\b[^>]*>)/i],
                    ["lang-in.tag", /^(<\/?[a-z][^<>]*>)/i]
                ]), "default-markup htm html mxml xhtml xml xsl".split(" "));
                n(E([
                    ["pln", /^[\s]+/, null, " \t\r\n"],
                    ["atv", /^(?:\"[^\"]*\"?|\'[^\']*\'?)/, null, "\"'"]
                ], [
                    ["tag", /^^<\/?[a-z](?:[\w.:-]*\w)?|\/?>$/i],
                    ["atn", /^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],
                    ["lang-uq.val", /^=\s*([^>\'\"\s]*(?:[^>\'\"\s\/]|\/(?=\s)))/],
                    ["pun", /^[=<>\/]+/],
                    ["lang-js", /^on\w+\s*=\s*\"([^\"]+)\"/i],
                    ["lang-js", /^on\w+\s*=\s*\'([^\']+)\'/i],
                    ["lang-js", /^on\w+\s*=\s*([^\"\'>\s]+)/i],
                    ["lang-css", /^style\s*=\s*\"([^\"]+)\"/i],
                    ["lang-css", /^style\s*=\s*\'([^\']+)\'/i],
                    ["lang-css", /^style\s*=\s*([^\"\'>\s]+)/i]
                ]), ["in.tag"]);
                n(E([], [
                    ["atv", /^[\s\S]+/]
                ]), ["uq.val"]);
                n(v({
                    keywords: R,
                    hashComments: !0,
                    cStyleComments: !0,
                    types: P
                }), "c cc cpp cxx cyc m".split(" "));
                n(v({
                    keywords: "null,true,false"
                }), ["json"]);
                n(v({
                    keywords: M,
                    hashComments: !0,
                    cStyleComments: !0,
                    verbatimStrings: !0,
                    types: P
                }), ["cs"]);
                n(v({
                    keywords: L,
                    cStyleComments: !0
                }), ["java"]);
                n(v({
                    keywords: J,
                    hashComments: !0,
                    multiLineStrings: !0
                }), ["bash", "bsh", "csh", "sh"]);
                n(v({
                    keywords: N,
                    hashComments: !0,
                    multiLineStrings: !0,
                    tripleQuotedStrings: !0
                }), ["cv", "py", "python"]);
                n(v({
                    keywords: "caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END",
                    hashComments: !0,
                    multiLineStrings: !0,
                    regexLiterals: 2
                }), ["perl", "pl", "pm"]);
                n(v({
                    keywords: O,
                    hashComments: !0,
                    multiLineStrings: !0,
                    regexLiterals: !0
                }), ["rb", "ruby"]);
                n(v({
                    keywords: K,
                    cStyleComments: !0,
                    regexLiterals: !0
                }), ["javascript", "js", "ts", "typescript"]);
                n(v({
                    keywords: "all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,throw,true,try,unless,until,when,while,yes",
                    hashComments: 3,
                    cStyleComments: !0,
                    multilineStrings: !0,
                    tripleQuotedStrings: !0,
                    regexLiterals: !0
                }), ["coffee"]);
                n(E([], [
                    ["str", /^[\s\S]+/]
                ]), ["regex"]);
                var U = Q.PR = {
                    createSimpleLexer: E,
                    registerLangHandler: n,
                    sourceDecorator: v,
                    PR_ATTRIB_NAME: "atn",
                    PR_ATTRIB_VALUE: "atv",
                    PR_COMMENT: "com",
                    PR_DECLARATION: "dec",
                    PR_KEYWORD: "kwd",
                    PR_LITERAL: "lit",
                    PR_NOCODE: "nocode",
                    PR_PLAIN: "pln",
                    PR_PUNCTUATION: "pun",
                    PR_SOURCE: "src",
                    PR_STRING: "str",
                    PR_TAG: "tag",
                    PR_TYPE: "typ",
                    prettyPrintOne: function (a, d, f) {
                        f = f || !1;
                        d = d || null;
                        var c = document.createElement("div");
                        c.innerHTML = "<pre>" + a + "</pre>";
                        c = c.firstChild;
                        f && B(c, f, !0);
                        H({
                            j: d,
                            m: f,
                            h: c,
                            l: 1,
                            a: null,
                            i: null,
                            c: null,
                            g: null
                        });
                        return c.innerHTML
                    },
                    prettyPrint: g = function (a, d) {
                        function f() {
                            for (var c = Q.PR_SHOULD_USE_CONTINUATION ? b.now() + 250 : Infinity; t < r.length && b.now() < c; t++) {
                                for (var d = r[t], k = h, n = d; n = n.previousSibling; ) {
                                    var q = n.nodeType,
                                            l = (7 === q || 8 === q) && n.nodeValue;
                                    if (l ? !/^\??prettify\b/.test(l) : 3 !== q || /\S/.test(n.nodeValue))
                                        break;
                                    if (l) {
                                        k = {};
                                        l.replace(/\b(\w+)=([\w:.%+-]+)/g, function (a, b, c) {
                                            k[b] = c
                                        });
                                        break
                                    }
                                }
                                n = d.className;
                                if ((k !== h || u.test(n)) && !e.test(n)) {
                                    q = !1;
                                    for (l = d.parentNode; l; l = l.parentNode)
                                        if (w.test(l.tagName) && l.className &&
                                                u.test(l.className)) {
                                            q = !0;
                                            break
                                        }
                                    if (!q) {
                                        d.className += " prettyprinted";
                                        q = k.lang;
                                        if (!q) {
                                            var q = n.match(v),
                                                    A;
                                            !q && (A = z(d)) && D.test(A.tagName) && (q = A.className.match(v));
                                            q && (q = q[1])
                                        }
                                        if (x.test(d.tagName))
                                            l = 1;
                                        else
                                            var l = d.currentStyle,
                                                y = g.defaultView,
                                                l = (l = l ? l.whiteSpace : y && y.getComputedStyle ? y.getComputedStyle(d, null).getPropertyValue("white-space") : 0) && "pre" === l.substring(0, 3);
                                        y = k.linenums;
                                        (y = "true" === y || +y) || (y = (y = n.match(/\blinenums\b(?::(\d+))?/)) ? y[1] && y[1].length ? +y[1] : !0 : !1);
                                        y && B(d, y, l);
                                        H({
                                            j: q,
                                            h: d,
                                            m: y,
                                            l: l,
                                            a: null,
                                            i: null,
                                            c: null,
                                            g: null
                                        })
                                    }
                                }
                            }
                            t < r.length ? Q.setTimeout(f, 250) : "function" === typeof a && a()
                        }
                        for (var c = d || document.body, g = c.ownerDocument || document, c = [c.getElementsByTagName("pre"), c.getElementsByTagName("code"), c.getElementsByTagName("xmp")], r = [], k = 0; k < c.length; ++k)
                            for (var n = 0, l = c[k].length; n < l; ++n)
                                r.push(c[k][n]);
                        var c = null,
                                b = Date;
                        b.now || (b = {
                            now: function () {
                                return +new Date
                            }
                        });
                        var t = 0,
                                v = /\blang(?:uage)?-([\w.]+)(?!\S)/,
                                u = /\bprettyprint\b/,
                                e = /\bprettyprinted\b/,
                                x = /pre|xmp/i,
                                D = /^code$/i,
                                w = /^(?:pre|code|xmp)$/i,
                                h = {};
                        f()
                    }
                },
                R = Q.define;
                "function" === typeof R && R.amd && R("google-code-prettify", [], function () {
                    return U
                })
            })();
            return g
        }();
        S || k.setTimeout(T, 0)
    })();
}();
;
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory)
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'))
    } else {
        factory(jQuery)
    }
}(function ($) {
    'use strict';
    $.fn.fileuploader = function (q) {
        return this.each(function (t, r) {
            var s = $(r),
                    p = null,
                    o = null,
                    l = null,
                    sl = [],
                    n = $.extend(true, {}, $.fn.fileuploader.defaults, q),
                    f = {
                        init: function () {
                            if (!s.closest('.fileuploader').length)
                                s.wrap('<div class="fileuploader"></div>');
                            p = s.closest('.fileuploader');
                            f.set('language');
                            f.set('attrOpts');
                            if (!f.isSupported()) {
                                n.onSupportError && $.isFunction(n.onSupportError) ? n.onSupportError(p, s) : null;
                                return false
                            }
                            if (n.beforeRender && $.isFunction(n.beforeRender) && n.beforeRender(p, s) === false)
                                return false;
                            f.redesign();
                            if (n.files)
                                f.files.append(n.files);
                            f.rendered = true;
                            n.afterRender && $.isFunction(n.afterRender) ? n.afterRender(l, p, o, s) : null;
                            if (!f.disabled)
                                f.bindUnbindEvents(true);
                            s.closest('form').on('reset', f.reset);
                            if (!f._itFl.length)
                                f.reset()
                        },
                        bindUnbindEvents: function (bind) {

                            if (bind)
                                f.bindUnbindEvents(false);
                            s[bind ? 'on' : 'off']('focus blur change', f.onEvent);
                            if (n.changeInput && o !== s)
                                o[bind ? 'on' : 'off']('click', f.clickHandler);
                            if (n.dragDrop && n.dragDrop.container.length) {
                                n.dragDrop.container[bind ? 'on' : 'off']('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
                                    e.preventDefault()
                                });
                                n.dragDrop.container[bind ? 'on' : 'off']('drop', f.dragDrop.onDrop);
                                n.dragDrop.container[bind ? 'on' : 'off']('dragover', f.dragDrop.onDragEnter);
                                n.dragDrop.container[bind ? 'on' : 'off']('dragleave', f.dragDrop.onDragLeave)
                            }
                            if (f.isUploadMode() && n.clipboardPaste)
                                $(window)[bind ? 'on' : 'off']('paste', f.clipboard.paste);
                            if (n.sorter && n.thumbnails && n.thumbnails._selectors.sorter)
                                f.sorter[bind ? 'init' : 'destroy']()
                        },
                        redesign: function () {
                            o = s;
                            if (n.theme)
                                p.addClass('fileuploader-theme-' + n.theme);
                            if (n.changeInput) {
                                switch ((typeof n.changeInput + "").toLowerCase()) {
                                    case 'boolean':
                                        o = $('<div class="fileuploader-input">' + '<div class="fileuploader-input-caption"><span>' + f._assets.textParse(n.captions.feedback) + '</span></div>' + '<button type="button" class="fileuploader-input-button"><span>' + f._assets.textParse(n.captions.button) + '</span></button>' + '</div>');
                                        break;
                                    case 'string':
                                        if (n.changeInput != ' ')
                                            o = $(f._assets.textParse(n.changeInput, n));
                                        break;
                                    case 'object':
                                        o = $(n.changeInput);
                                        break;
                                    case 'function':
                                        o = $(n.changeInput(s, p, n, f._assets.textParse));
                                        break
                                }
                                s.after(o);
                                s.css({
                                    position: "absolute",
                                    "z-index": "-9999",
                                    height: '0',
                                    width: '0',
                                    padding: '0',
                                    margin: '0',
                                    "line-height": '0',
                                    outline: '0',
                                    border: '0',
                                    opacity: '0'
                                })
                            }
                            if (n.thumbnails)
                                f.thumbnails.create();
                            if (n.dragDrop) {
                                n.dragDrop = typeof (n.dragDrop) != 'object' ? {
                                    container: null
                                } : n.dragDrop;
                                n.dragDrop.container = n.dragDrop.container ? $(n.dragDrop.container) : o
                            }
                        },
                        clickHandler: function (e) {
                            e.preventDefault();
                            if (f.clipboard._timer) {
                                f.clipboard.clean();
                                return
                            }
                            s.click()
                        },
                        onEvent: function (e) {
                            switch (e.type) {
                                case 'focus':
                                    p ? p.addClass('fileuploader-focused') : null;
                                    break;
                                case 'blur':
                                    p ? p.removeClass('fileuploader-focused') : null;
                                    break;
                                case 'change':
                                    f.onChange.call(this);
                                    break
                            }
                            n.listeners && $.isFunction(n.listeners[e.type]) ? n.listeners[e.type].call(s, p) : null
                        },
                        set: function (type, value) {
                            switch (type) {
                                case 'attrOpts':
                                    var d = ['limit', 'maxSize', 'fileMaxSize', 'extensions', 'changeInput', 'theme', 'addMore', 'listInput', 'files'];
                                    for (var k = 0; k < d.length; k++) {
                                        var j = 'data-fileuploader-' + d[k];
                                        if (f._assets.hasAttr(j)) {
                                            switch (d[k]) {
                                                case 'changeInput':
                                                case 'addMore':
                                                case 'listInput':
                                                    n[d[k]] = (['true', 'false'].indexOf(s.attr(j)) > -1 ? s.attr(j) == 'true' : s.attr(j));
                                                    break;
                                                case 'extensions':
                                                    n[d[k]] = s.attr(j).replace(/ /g, '').split(',');
                                                    break;
                                                case 'files':
                                                    n[d[k]] = JSON.parse(s.attr(j));
                                                    break;
                                                default:
                                                    n[d[k]] = s.attr(j)
                                            }
                                        }
                                        s.removeAttr(j)
                                    }
                                    if (s.attr('disabled') != null || s.attr('readonly') != null || n.limit === 0)
                                        f.disabled = true;
                                    if (!n.limit || (n.limit && n.limit >= 2)) {
                                        s.attr('multiple', 'multiple');
                                        n.inputNameBrackets && s.attr('name').slice(-2) != '[]' ? s.attr('name', s.attr('name') + '[]') : null
                                    }
                                    if (n.listInput === true) {
                                        n.listInput = $('<input type="hidden" name="fileuploader-list-' + s.attr('name').replace('[]', '').split('[').pop().replace(']', '') + '">').insertBefore(s)
                                    }
                                    if (typeof n.listInput == "string" && $(n.listInput).length == 0) {
                                        n.listInput = $('<input type="hidden" name="' + n.listInput + '">').insertBefore(s)
                                    }
                                    f.set('disabled', f.disabled);
                                    if (!n.fileMaxSize && n.maxSize)
                                        n.fileMaxSize = n.maxSize;
                                    break;
                                case 'language':
                                    var languages = $.fn.fileuploader.languages;
                                    if (typeof n.captions == 'string') {
                                        if (n.captions in languages)
                                            n.captions = languages[n.captions];
                                        else
                                            n.captions = $.extend(true, {}, $.fn.fileuploader.defaults.captions)
                                    }
                                    break;
                                case 'disabled':
                                    f.disabled = value;
                                    p[f.disabled ? 'addClass' : 'removeClass']('fileuploader-disabled');
                                    s[f.disabled ? 'attr' : 'removeAttr']('disabled', 'disabled');
                                    if (f.rendered)
                                        f.bindUnbindEvents(!value);
                                    break;
                                case 'feedback':
                                    if (!value)
                                        value = f._assets.textParse(f._itFl.length > 0 ? n.captions.feedback2 : n.captions.feedback, {
                                            length: f._itFl.length
                                        });
                                    $(!o.is(':file')) ? o.find('.fileuploader-input-caption span').html(value) : null;
                                    break;
                                case 'input':
                                    var el = f._assets.copyAllAttributes($('<input type="file">'), s, true);
                                    f.bindUnbindEvents(false);
                                    s.after(s = el).remove();
                                    f.bindUnbindEvents(true);
                                    break;
                                case 'prevInput':
                                    if (sl.length > 0) {
                                        f.bindUnbindEvents(false);
                                        sl[value].remove();
                                        sl.splice(value, 1);
                                        s = sl[sl.length - 1];
                                        f.bindUnbindEvents(true)
                                    }
                                    break;
                                case 'nextInput':
                                    var el = f._assets.copyAllAttributes($('<input type="file">'), s);
                                    f.bindUnbindEvents(false);
                                    if (sl.length > 0 && sl[sl.length - 1].get(0).files.length == 0) {
                                        s = sl[sl.length - 1]
                                    } else {
                                        sl.indexOf(s) == -1 ? sl.push(s) : null;
                                        sl.push(el);
                                        s.after(s = el)
                                    }
                                    f.bindUnbindEvents(true);
                                    break;
                                case 'listInput':
                                    if (n.listInput)
                                        n.listInput.val(f.files.list(true, null, false, value));
                                    break
                            }
                        },
                        onChange: function (e, fileList) {
                            var files = s.get(0).files;
                            if (fileList) {
                                if (fileList.length) {
                                    files = fileList
                                } else {
                                    f.set('input', '');
                                    f.files.clear();
                                    return false
                                }
                            }
                            if (f.clipboard._timer)
                                f.clipboard.clean();
                            if (f.isDefaultMode()) {
                                f.reset();
                                if (files.length == 0)
                                    return
                            }
                            if (n.beforeSelect && $.isFunction(n.beforeSelect) && n.beforeSelect(files, l, p, o, s) == false) {
                                return false
                            }
                            var t = 0;
                            for (var i = 0; i < files.length; i++) {
                                var file = files[i],
                                        item = f._itFl[f.files.add(file, 'choosed')],
                                        status = f.files.check(item, files, i == 0);
                                if (status !== true) {
                                    f.files.remove(item, true);
                                    if (!status[2]) {
                                        if (f.isDefaultMode()) {
                                            f.set('input', '');
                                            f.reset();
                                            status[3] = true
                                        }
                                        status[1] ? f._assets.dialogs.alert(status[1], item, l, p, o, s) : null
                                    }
                                    if (status[3]) {
                                        break
                                    }
                                    continue
                                }
                                if (n.thumbnails)
                                    f.thumbnails.item(item);
                                if (f.isUploadMode())
                                    f.upload.prepare(item);
                                n.onSelect && $.isFunction(n.onSelect) ? n.onSelect(item, l, p, o, s) : null;
                                t++
                            }
                            if (f.isUploadMode() && t > 0)
                                f.set('input', '');
                            f.set('feedback', null);
                            if (f.isAddMoreMode() && t > 0) {
                                f.set('nextInput')
                            }
                            f.set('listInput', null);
                            n.afterSelect && $.isFunction(n.afterSelect) ? n.afterSelect(l, p, o, s) : null
                        },
                        thumbnails: {
                            create: function () {
                                n.thumbnails.beforeShow != null && $.isFunction(n.thumbnails.beforeShow) ? n.thumbnails.beforeShow(p, o, s) : null;
                                var box = $(f._assets.textParse(n.thumbnails.box)).appendTo(n.thumbnails.boxAppendTo ? n.thumbnails.boxAppendTo : p);
                                l = !box.is(n.thumbnails._selectors.list) ? box.find(n.thumbnails._selectors.list) : box;
                                if (n.thumbnails._selectors.popup_open) {
                                    l.on('click', n.thumbnails._selectors.popup_open, function (e) {
                                        e.preventDefault();
                                        var m = $(this).closest(n.thumbnails._selectors.item),
                                                item = f.files.find(m);
                                        if (item && item.popup && item.html.hasClass('file-has-popup'))
                                            f.thumbnails.popup(item)
                                    })
                                }
                                if (f.isUploadMode() && n.thumbnails._selectors.start) {
                                    l.on('click', n.thumbnails._selectors.start, function (e) {
                                        e.preventDefault();
                                        if (f.locked)
                                            return false;
                                        var m = $(this).closest(n.thumbnails._selectors.item),
                                                item = f.files.find(m);
                                        if (item)
                                            f.upload.send(item, true)
                                    })
                                }
                                if (f.isUploadMode() && n.thumbnails._selectors.retry) {
                                    l.on('click', n.thumbnails._selectors.retry, function (e) {
                                        e.preventDefault();
                                        if (f.locked)
                                            return false;
                                        var m = $(this).closest(n.thumbnails._selectors.item),
                                                item = f.files.find(m);
                                        if (item)
                                            f.upload.retry(item)
                                    })
                                }
                                if (n.thumbnails._selectors.rotate) {
                                    l.on('click', n.thumbnails._selectors.rotate, function (e) {
                                        e.preventDefault();
                                        if (f.locked)
                                            return false;
                                        var m = $(this).closest(n.thumbnails._selectors.item),
                                                item = f.files.find(m);
                                        if (item && item.editor) {
                                            item.editor.rotate();
                                            item.editor.save()
                                        }
                                    })
                                }
                                if (n.thumbnails._selectors.remove) {
                                    l.on('click', n.thumbnails._selectors.remove, function (e) {
                                        e.preventDefault();
                                        if (f.locked)
                                            return false;
                                        var m = $(this).closest(n.thumbnails._selectors.item),
                                                item = f.files.find(m),
                                                c = function (a) {
                                                    f.files.remove(item)
                                                };
                                        if (item) {
                                            if (item.upload && item.upload.status != 'successful') {
                                                f.upload.cancel(item)
                                            } else {
                                                if (n.thumbnails.removeConfirmation && !item.choosed) {
                                                    f._assets.dialogs.confirm(f._assets.textParse(n.captions.removeConfirmation, item), c)
                                                } else {
                                                    c()
                                                }
                                            }
                                        }
                                    })
                                }
                            },
                            clear: function () {
                                if (l)
                                    l.html('')
                            },
                            item: function (item, replaceHtml) {
                                item.icon = f.thumbnails.generateFileIcon(item.format, item.extension);
                                item.image = '<div class="fileuploader-item-image"></div>';
                                item.progressBar = f.isUploadMode() ? '<div class="fileuploader-progressbar"><div class="bar"></div></div>' : '';
                                item.html = $(f._assets.textParse(item.appended && n.thumbnails.item2 ? n.thumbnails.item2 : n.thumbnails.item, item));
                                item.progressBar = item.html.find('.fileuploader-progressbar');
                                item.html.addClass('file-type-' + (item.format ? item.format : 'no') + ' file-ext-' + (item.extension ? item.extension : 'no') + '');
                                if (replaceHtml)
                                    replaceHtml.replaceWith(item.html);
                                else
                                    item.html[n.thumbnails.itemPrepend ? 'prependTo' : 'appendTo'](l);
                                if (n.thumbnails.popup && item.data.popup !== false) {
                                    item.html.addClass('file-has-popup');
                                    item.popup = {
                                        open: function () {
                                            f.thumbnails.popup(item)
                                        }
                                    }
                                }
                                f.thumbnails.renderThumbnail(item);
                                item.renderThumbnail = function (src) {
                                    if (src && item.popup && item.popup.close) {
                                        item.popup.close();
                                        item.popup = {
                                            open: item.popup.open
                                        }
                                    }
                                    f.thumbnails.renderThumbnail(item, true, src)
                                };
                                n.thumbnails.onItemShow != null && $.isFunction(n.thumbnails.onItemShow) ? n.thumbnails.onItemShow(item, l, p, o, s) : null
                            },
                            generateFileIcon: function (format, extension) {
                                var el = '<div style="${style}" class="fileuploader-item-icon' + '${class}"><i>' + (extension ? extension : '') + '</i></div>';
                                var bgColor = f._assets.textToColor(extension);
                                if (bgColor) {
                                    var isBgColorBright = f._assets.isBrightColor(bgColor);
                                    if (isBgColorBright)
                                        el = el.replace('${class}', ' is-bright-color');
                                    el = el.replace('${style}', 'background-color: ' + bgColor)
                                }
                                return el.replace('${style}', '').replace('${class}', '')
                            },
                            renderThumbnail: function (item, forceRender, src) {
                                console.log(item);
                                item.html.find('.fileuploader-input').css("background", "url('" + item.local + "') center center / cover no-repeat");
                                item.html.find(".fileuploader-input").addClass("disabled");
                                var m = item.html.find('.fileuploader-item-image'),
                                        readerSkip = item.data && (item.data.readerSkip || item.data.thumbnail === false),
                                        setImageThumb = function (img) {
                                            var $img = $(img);
                                            m.removeClass('fileuploader-no-thumbnail fileuploader-loading').html($img);
                                            if (item.html.hasClass('file-will-popup'))
                                                item.html.removeClass('file-will-popup').addClass('file-has-popup');
                                            if ($img.is('img'))
                                                $img.attr('draggable', 'false').on('load error', function (e) {
                                                    if (e.type == 'error')
                                                        setIconThumb()
                                                });
                                            n.thumbnails.onImageLoaded != null && $.isFunction(n.thumbnails.onImageLoaded) ? n.thumbnails.onImageLoaded(item, l, p, o, s) : null
                                        },
                                        setIconThumb = function () {
                                            m.addClass('fileuploader-no-thumbnail');
                                            m.removeClass('fileuploader-loading').html(item.icon);
                                            if (item.html.hasClass('file-will-popup'))
                                                item.html.removeClass('file-will-popup').addClass('file-has-popup');
                                            n.thumbnails.onImageLoaded != null && $.isFunction(n.thumbnails.onImageLoaded) ? n.thumbnails.onImageLoaded(item, l, p, o, s) : null
                                        },
                                        renderNextItem = function () {
                                            var i = 0;
                                            if (item && f._pfrL.indexOf(item) > -1) {
                                                f._pfrL.splice(f._pfrL.indexOf(item), 1);
                                                while (i < f._pfrL.length) {
                                                    if (f._itFl.indexOf(f._pfrL[i]) > -1) {
                                                        setTimeout(function () {
                                                            f.thumbnails.renderThumbnail(f._pfrL[i], true)
                                                        }, item.format == 'image' && item.size / 1000000 > 1.8 ? 200 : 0);
                                                        break
                                                    } else {
                                                        f._pfrL.splice(i, 1)
                                                    }
                                                    i++
                                                }
                                            }
                                        };
                                if (!m.length) {
                                    renderNextItem();
                                    return
                                }
                                item.image = m.html('').addClass('fileuploader-loading');
                                if ((['image', 'video', 'audio', 'astext'].indexOf(item.format) > -1 || item.data.thumbnail) && f.isFileReaderSupported() && window.dataStorage && !readerSkip && (item.appended || n.thumbnails.startImageRenderer || forceRender)) {
                                    if (item.html.hasClass('file-has-popup'))
                                        item.html.removeClass('file-has-popup').addClass('file-will-popup');
                                    if (n.thumbnails.synchronImages) {
                                        f._pfrL.indexOf(item) == -1 && !forceRender ? f._pfrL.push(item) : null;
                                        if (f._pfrL.length > 1 && !forceRender) {
                                            return
                                        }
                                    }
                                    var process = function (data, fromReader) {
                                        var isIMG = data && data.nodeName && data.nodeName.toLowerCase() == 'img',
                                                src = !isIMG ? data : data.src,
                                                img = null,
                                                onload = function () {
                                                    if (n.thumbnails.canvasImage) {
                                                        var canvas = document.createElement('canvas');
                                                        f.editor.resize(this, canvas, n.thumbnails.canvasImage.width ? n.thumbnails.canvasImage.width : m.width(), n.thumbnails.canvasImage.height ? n.thumbnails.canvasImage.height : m.height(), false, true);
                                                        if (!f._assets.isBlankCanvas(canvas)) {
                                                            setImageThumb(canvas)
                                                        } else {
                                                            setIconThumb()
                                                        }
                                                    } else {
                                                        setImageThumb(this)
                                                    }
                                                    renderNextItem()
                                                },
                                                onerror = function () {
                                                    img = null;
                                                    setIconThumb();
                                                    renderNextItem()
                                                };
                                        if (!data)
                                            return onerror();
                                        if (fromReader && item.format == 'image' && item.reader.node)
                                            return onload.call(item.reader.node);
                                        if (isIMG)
                                            return onload.call(data);
                                        img = new Image();
                                        img.onload = onload;
                                        img.onerror = onerror;
                                        if (item.data && item.data.readerCrossOrigin)
                                            img.setAttribute('crossOrigin', item.data.readerCrossOrigin);
                                        img.src = src
                                    };
                                    if (typeof src == 'string' || typeof src == 'object')
                                        return process(src);
                                    else
                                        return f.files.read(item, function () {
                                            process(item.reader.frame || (item.reader.node && item.reader.node.nodeName.toLowerCase() == 'img' ? item.reader.src : null), true)
                                        }, null, src, true)
                                }
                                setIconThumb()
                            },
                            popup: function (item, isByActions) {
                                if (f.locked || !n.thumbnails.popup || !n.thumbnails._selectors.popup)
                                    return;
                                var container = $(n.thumbnails.popup.container),
                                        box = container.find('.fileuploader-popup'),
                                        hasArrowsClass = 'fileuploader-popup-has-arrows',
                                        renderPopup = function () {
                                            var template = item.popup.html || $(f._assets.textParse(n.thumbnails.popup.template, item)),
                                                    popupIsNew = item.popup.html !== template,
                                                    windowKeyEvent = function (e) {
                                                        var key = e.which || e.keyCode;
                                                        if (key == 27 && item.popup && item.popup.close)
                                                            item.popup.close();
                                                        if ((key == 37 || key == 39) && n.thumbnails.popup.arrows)
                                                            item.popup.move(key == 37 ? 'prev' : 'next')
                                                    };
                                            box.removeClass('loading');
                                            if (box.children(n.thumbnails._selectors.popup).length) {
                                                $.each(f._itFl, function (i, a) {
                                                    if (a != item && a.popup && a.popup.close) {
                                                        a.popup.close(isByActions)
                                                    }
                                                });
                                                box.find(n.thumbnails._selectors.popup).remove()
                                            }
                                            template.show().appendTo(box);
                                            item.popup.html = template;
                                            item.popup.isOpened = true;
                                            item.popup.move = function (to) {
                                                var itemIndex = f._itFl.indexOf(item),
                                                        nextItem = null,
                                                        itL = false;
                                                to = n.thumbnails.itemPrepend ? to == 'prev' ? 'next' : 'prev' : to;
                                                if (to == 'prev') {
                                                    for (var i = itemIndex; i >= 0; i--) {
                                                        var a = f._itFl[i];
                                                        if (a != item && a.popup && a.html.hasClass('file-has-popup')) {
                                                            nextItem = a;
                                                            break
                                                        }
                                                        if (i == 0 && !nextItem && !itL && n.thumbnails.popup.loop) {
                                                            i = f._itFl.length;
                                                            itL = true
                                                        }
                                                    }
                                                } else {
                                                    for (var i = itemIndex; i < f._itFl.length; i++) {
                                                        var a = f._itFl[i];
                                                        if (a != item && a.popup && a.html.hasClass('file-has-popup')) {
                                                            nextItem = a;
                                                            break
                                                        }
                                                        if (i + 1 == f._itFl.length && !nextItem && !itL && n.thumbnails.popup.loop) {
                                                            i = -1;
                                                            itL = true
                                                        }
                                                    }
                                                }
                                                if (nextItem)
                                                    f.thumbnails.popup(nextItem, true)
                                            };
                                            item.popup.close = function (isByActions) {
                                                if (item.popup.node) {
                                                    item.popup.node.pause ? item.popup.node.pause() : null
                                                }
                                                $(window).off('keyup', windowKeyEvent);
                                                container.css({
                                                    overflow: '',
                                                    width: ''
                                                });
                                                if (item.popup.editor && item.popup.editor.cropper)
                                                    item.popup.editor.cropper.hide();
                                                if (item.popup.zoomer)
                                                    item.popup.zoomer.hide();
                                                item.popup.isOpened = false;
                                                item.popup.html && n.thumbnails.popup.onHide && $.isFunction(n.thumbnails.popup.onHide) ? n.thumbnails.popup.onHide(item, l, p, o, s) : (item.popup.html ? item.popup.html.remove() : null);
                                                if (!isByActions)
                                                    box.fadeOut(400, function () {
                                                        box.remove()
                                                    });
                                                delete item.popup.close
                                            };
                                            if (item.popup.node) {
                                                if (popupIsNew)
                                                    template.html(template.html().replace(/\$\{reader\.node\}/, '<div class="reader-node"></div>')).find('.reader-node').html(item.popup.node);
                                                item.popup.node.controls = true;
                                                item.popup.node.currentTime = 0;
                                                item.popup.node.play ? item.popup.node.play() : null
                                            } else {
                                                if (popupIsNew)
                                                    template.find('.fileuploader-popup-node').html('<div class="reader-node"><div class="fileuploader-popup-file-icon file-type-' + item.format + ' file-ext-' + item.extension + '">' + item.icon + '</div></div>')
                                            }
                                            $(window).on('keyup', windowKeyEvent);
                                            container.css({
                                                overflow: 'hidden',
                                                width: container.innerWidth()
                                            });
                                            item.popup.html.find('[data-action="prev"], [data-action="next"]').removeAttr('style');
                                            item.popup.html[f._itFl.length == 1 || !n.thumbnails.popup.arrows ? 'removeClass' : 'addClass'](hasArrowsClass);
                                            if (!n.thumbnails.popup.loop) {
                                                if (f._itFl.indexOf(item) == 0)
                                                    item.popup.html.find('[data-action="prev"]').hide();
                                                if (f._itFl.indexOf(item) == f._itFl.length - 1)
                                                    item.popup.html.find('[data-action="next"]').hide()
                                            }
                                            if (popupIsNew && item.popup.zoomer)
                                                item.popup.zoomer = null;
                                            f.editor.zoomer(item);
                                            if (item.editor) {
                                                if (!item.popup.editor)
                                                    item.popup.editor = {};
                                                f.editor.rotate(item, item.editor.rotation || 0, true);
                                                if (item.popup.editor && item.popup.editor.cropper) {
                                                    item.popup.editor.cropper.hide(true);
                                                    setTimeout(function () {
                                                        f.editor.crop(item, item.editor.crop ? $.extend({}, item.editor.crop) : item.popup.editor.cropper.setDefaultData())
                                                    }, 100)
                                                }
                                            }
                                            item.popup.html.on('click', '[data-action="prev"]', function (e) {
                                                item.popup.move('prev')
                                            }).on('click', '[data-action="next"]', function (e) {
                                                item.popup.move('next')
                                            }).on('click', '[data-action="crop"]', function (e) {
                                                if (item.editor)
                                                    item.editor.cropper()
                                            }).on('click', '[data-action="rotate-cw"]', function (e) {
                                                if (item.editor)
                                                    item.editor.rotate()
                                            }).on('click', '[data-action="zoom-in"]', function (e) {
                                                if (item.popup.zoomer)
                                                    item.popup.zoomer.zoomIn()
                                            }).on('click', '[data-action="zoom-out"]', function (e) {
                                                if (item.popup.zoomer)
                                                    item.popup.zoomer.zoomOut()
                                            });
                                            n.thumbnails.popup.onShow && $.isFunction(n.thumbnails.popup.onShow) ? n.thumbnails.popup.onShow(item, l, p, o, s) : null
                                        };
                                if (box.length == 0)
                                    box = $('<div class="fileuploader-popup"></div>').appendTo(container);
                                box.fadeIn(400).addClass('loading').find(n.thumbnails._selectors.popup).fadeOut(150);
                                if ((['image', 'video', 'audio', 'astext'].indexOf(item.format) > -1 || ['application/pdf'].indexOf(item.type) > -1) && !item.popup.html) {
                                    f.files.read(item, function () {
                                        if (item.reader.node)
                                            item.popup.node = item.reader.node;
                                        if (item.format == 'image' && item.reader.node) {
                                            item.popup.node = item.reader.node.cloneNode();
                                            if (item.popup.node.complete) {
                                                renderPopup()
                                            } else {
                                                item.popup.node.src = '';
                                                item.popup.node.onload = item.popup.node.onerror = renderPopup;
                                                item.popup.node.src = item.reader.node.src
                                            }
                                        } else {
                                            renderPopup()
                                        }
                                    })
                                } else {
                                    renderPopup()
                                }
                            }
                        },
                        editor: {
                            rotate: function (item, degrees, force) {
                                var inPopup = item.popup && item.popup.html && $('html').find(item.popup.html).length;
                                if (!inPopup) {
                                    var rotation = item.editor.rotation || 0,
                                            deg = degrees ? degrees : rotation + 90;
                                    if (deg >= 360)
                                        deg = 0;
                                    if (item.popup.editor)
                                        item.popup.editor.rotation = deg;
                                    return item.editor.rotation = deg
                                } else if (item.popup.node) {
                                    if (item.popup.editor.isAnimating)
                                        return;
                                    item.popup.editor.isAnimating = true;
                                    var $popup = item.popup.html,
                                            $node = $popup.find('.fileuploader-popup-node'),
                                            $readerNode = $node.find('.reader-node'),
                                            $imageEl = $readerNode.find('> img'),
                                            rotation = item.popup.editor.rotation || 0,
                                            scale = item.popup.editor.scale || 1,
                                            animationObj = {
                                                rotation: rotation,
                                                scale: scale
                                            };
                                    if (item.popup.editor.cropper)
                                        item.popup.editor.cropper.$template.hide();
                                    item.popup.editor.rotation = force ? degrees : rotation + 90;
                                    item.popup.editor.scale = ($readerNode.height() / $imageEl[[90, 270].indexOf(item.popup.editor.rotation) > -1 ? 'width' : 'height']()).toFixed(3);
                                    if ($imageEl.height() * item.popup.editor.scale > $readerNode.width() && [90, 270].indexOf(item.popup.editor.rotation) > -1)
                                        item.popup.editor.scale = $readerNode.height() / $imageEl.width();
                                    if (item.popup.editor.scale > 1)
                                        item.popup.editor.scale = 1;
                                    $(animationObj).stop().animate({
                                        rotation: item.popup.editor.rotation,
                                        scale: item.popup.editor.scale
                                    }, {
                                        duration: force ? 2 : 300,
                                        easing: 'swing',
                                        step: function (now, fx) {
                                            var matrix = $imageEl.css('-webkit-transform') || $imageEl.css('-moz-transform') || $imageEl.css('transform') || 'none',
                                                    rotation = 0,
                                                    scale = 1,
                                                    prop = fx.prop;
                                            if (matrix !== 'none') {
                                                var values = matrix.split('(')[1].split(')')[0].split(','),
                                                        a = values[0],
                                                        b = values[1];
                                                rotation = prop == 'rotation' ? now : Math.round(Math.atan2(b, a) * (180 / Math.PI));
                                                scale = prop == 'scale' ? now : Math.round(Math.sqrt(a * a + b * b) * 10) / 10
                                            }
                                            $imageEl.css({
                                                '-webkit-transform': 'rotate(' + rotation + 'deg) scale(' + scale + ')',
                                                '-moz-transform': 'rotate(' + rotation + 'deg) scale(' + scale + ')',
                                                'transform': 'rotate(' + rotation + 'deg) scale(' + scale + ')'
                                            })
                                        },
                                        always: function () {
                                            delete item.popup.editor.isAnimating;
                                            if (item.popup.editor.cropper && !force) {
                                                item.popup.editor.cropper.setDefaultData();
                                                item.popup.editor.cropper.init('rotation')
                                            }
                                        }
                                    });
                                    if (item.popup.editor.rotation >= 360)
                                        item.popup.editor.rotation = 0;
                                    if (item.popup.editor.rotation != item.editor.rotation)
                                        item.popup.editor.hasChanges = true
                                }
                            },
                            crop: function (item, data) {
                                var inPopup = item.popup && item.popup.html && $('html').find(item.popup.html).length;
                                if (!inPopup) {
                                    return item.editor.crop = data || item.editor.crop
                                } else if (item.popup.node) {
                                    if (!item.popup.editor.cropper) {
                                        var template = '<div class="fileuploader-cropper">' + '<div class="fileuploader-cropper-area">' + '<div class="point point-a"></div>' + '<div class="point point-b"></div>' + '<div class="point point-c"></div>' + '<div class="point point-d"></div>' + '<div class="point point-e"></div>' + '<div class="point point-f"></div>' + '<div class="point point-g"></div>' + '<div class="point point-h"></div>' + '<div class="area-move"></div>' + '<div class="area-image"></div>' + '<div class="area-info"></div>' + '</div>' + '</div>',
                                                $popup = item.popup.html,
                                                $imageEl = $popup.find('.fileuploader-popup-node .reader-node > img'),
                                                $template = $(template),
                                                $editor = $template.find('.fileuploader-cropper-area');
                                        item.popup.editor.cropper = {
                                            $imageEl: $imageEl,
                                            $template: $template,
                                            $editor: $editor,
                                            isCropping: false,
                                            crop: data || null,
                                            init: function (data) {
                                                var cropper = item.popup.editor.cropper,
                                                        position = cropper.$imageEl.position(),
                                                        width = cropper.$imageEl[0].getBoundingClientRect().width,
                                                        height = cropper.$imageEl[0].getBoundingClientRect().height,
                                                        isInverted = item.popup.editor.rotation && [90, 270].indexOf(item.popup.editor.rotation) > -1,
                                                        scale = isInverted ? item.popup.editor.scale : 1;
                                                cropper.hide();
                                                if (!cropper.crop)
                                                    cropper.setDefaultData();
                                                if (width == 0 || height == 0)
                                                    return cropper.hide(true);
                                                if (!cropper.isCropping) {
                                                    cropper.$imageEl.clone().appendTo(cropper.$template.find('.area-image'));
                                                    cropper.$imageEl.parent().append($template)
                                                }
                                                cropper.$template.hide().css({
                                                    left: position.left,
                                                    top: position.top,
                                                    width: width,
                                                    height: height
                                                }).fadeIn(150);
                                                cropper.$editor.hide();
                                                clearTimeout(cropper._editorAnimationTimeout);
                                                cropper._editorAnimationTimeout = setTimeout(function () {
                                                    delete cropper._editorAnimationTimeout;
                                                    cropper.$editor.fadeIn(250);
                                                    if (item.editor.crop && $.isPlainObject(data)) {
                                                        cropper.resize();
                                                        cropper.crop.left = cropper.crop.left * cropper.crop.cfWidth * scale;
                                                        cropper.crop.width = cropper.crop.width * cropper.crop.cfWidth * scale;
                                                        cropper.crop.top = cropper.crop.top * cropper.crop.cfHeight * scale;
                                                        cropper.crop.height = cropper.crop.height * cropper.crop.cfHeight * scale
                                                    }
                                                    if (n.editor.cropper && (n.editor.cropper.maxWidth || n.editor.cropper.maxHeight)) {
                                                        if (n.editor.cropper.maxWidth)
                                                            cropper.crop.width = Math.min(n.editor.cropper.maxWidth * cropper.crop.cfWidth, cropper.crop.width);
                                                        if (n.editor.cropper.maxHeight)
                                                            cropper.crop.height = Math.min(n.editor.cropper.maxHeight * cropper.crop.cfHeight, cropper.crop.height);
                                                        if ((!item.editor.crop || data == 'rotation') && data != 'resize') {
                                                            cropper.crop.left = (cropper.$template.width() - cropper.crop.width) / 2;
                                                            cropper.crop.top = (cropper.$template.height() - cropper.crop.height) / 2
                                                        }
                                                    }
                                                    if ((!item.editor.crop || data == 'rotation') && (n.editor.cropper && n.editor.cropper.ratio && data != 'resize')) {
                                                        var ratio = n.editor.cropper.ratio,
                                                                ratioPx = f._assets.ratioToPx(cropper.crop.width, cropper.crop.height, ratio);
                                                        if (ratioPx) {
                                                            cropper.crop.width = Math.min(cropper.crop.width, ratioPx[0]);
                                                            cropper.crop.left = (cropper.$template.width() - cropper.crop.width) / 2;
                                                            cropper.crop.height = Math.min(cropper.crop.height, ratioPx[1]);
                                                            cropper.crop.top = (cropper.$template.height() - cropper.crop.height) / 2
                                                        }
                                                    }
                                                    cropper.drawPlaceHolder(cropper.crop)
                                                }, 400);
                                                if (n.editor.cropper && n.editor.cropper.showGrid)
                                                    cropper.$editor.addClass('has-grid');
                                                cropper.$imageEl.attr('draggable', 'false');
                                                cropper.$template.on('mousedown touchstart', cropper.mousedown);
                                                $(window).on('resize', cropper.resize);
                                                cropper.isCropping = true;
                                                item.popup.editor.hasChanges = true
                                            },
                                            setDefaultData: function () {
                                                var cropper = item.popup.editor.cropper,
                                                        $imageEl = cropper.$imageEl,
                                                        imgClientRect = $imageEl.get(0).getBoundingClientRect(),
                                                        width = imgClientRect.width,
                                                        height = imgClientRect.height,
                                                        isInverted = item.popup.editor.rotation && [90, 270].indexOf(item.popup.editor.rotation) > -1,
                                                        scale = item.popup.editor.scale || 1;
                                                cropper.crop = {
                                                    left: 0,
                                                    top: 0,
                                                    width: isInverted ? height * scale : width,
                                                    height: isInverted ? width * scale : height,
                                                    cfWidth: width / item.reader.width,
                                                    cfHeight: height / item.reader.height
                                                };
                                                return null
                                            },
                                            hide: function (force) {
                                                var cropper = item.popup.editor.cropper;
                                                if (force) {
                                                    cropper.$template.hide();
                                                    cropper.$editor.hide()
                                                }
                                                cropper.$imageEl.attr('draggable', '');
                                                cropper.$template.off('mousedown touchstart', cropper.mousedown);
                                                $(window).off('resize', cropper.resize)
                                            },
                                            resize: function (e) {
                                                var cropper = item.popup.editor.cropper,
                                                        $imageEl = cropper.$imageEl;
                                                if ($imageEl.width() > 0) {
                                                    if (!e) {
                                                        cropper.crop.cfWidth = $imageEl.width() / item.reader.width;
                                                        cropper.crop.cfHeight = $imageEl.height() / item.reader.height
                                                    } else {
                                                        cropper.$template.hide();
                                                        clearTimeout(cropper._resizeTimeout);
                                                        cropper._resizeTimeout = setTimeout(function () {
                                                            delete cropper._resizeTimeout;
                                                            var cfWidth = $imageEl.width() / item.reader.width,
                                                                    cfHeight = $imageEl.height() / item.reader.height;
                                                            cropper.crop.left = cropper.crop.left / cropper.crop.cfWidth * cfWidth;
                                                            cropper.crop.width = cropper.crop.width / cropper.crop.cfWidth * cfWidth;
                                                            cropper.crop.top = cropper.crop.top / cropper.crop.cfHeight * cfHeight;
                                                            cropper.crop.height = cropper.crop.height / cropper.crop.cfHeight * cfHeight;
                                                            cropper.crop.cfWidth = cfWidth;
                                                            cropper.crop.cfHeight = cfHeight;
                                                            cropper.init('resize')
                                                        }, 500)
                                                    }
                                                }
                                            },
                                            drawPlaceHolder: function (css) {
                                                var cropper = item.popup.editor.cropper,
                                                        rotation = item.popup.editor.rotation || 0,
                                                        scale = item.popup.editor.scale || 1,
                                                        translate = [0, 0];
                                                if (!css)
                                                    return;
                                                css = $.extend({}, css);
                                                if (rotation)
                                                    translate = [rotation == 180 || rotation == 270 ? -100 : 0, rotation == 90 || rotation == 180 ? -100 : 0];
                                                cropper.$editor.css(css);
                                                cropper.setAreaInfo();
                                                cropper.$editor.find('.area-image img').removeAttr('style').css({
                                                    width: cropper.$imageEl.width(),
                                                    height: cropper.$imageEl.height(),
                                                    left: cropper.$editor.position().left * -1,
                                                    top: cropper.$editor.position().top * -1,
                                                    '-webkit-transform': 'rotate(' + rotation + 'deg) scale(' + scale + ') translateX(' + translate[0] + '%) translateY(' + translate[1] + '%)',
                                                    '-moz-transform': 'rotate(' + rotation + 'deg) scale(' + scale + ') translateX(' + translate[0] + '%) translateY(' + translate[1] + '%)',
                                                    'transform': 'rotate(' + rotation + 'deg) scale(' + scale + ') translateX(' + translate[0] + '%) translateY(' + translate[1] + '%)'
                                                })
                                            },
                                            setAreaInfo: function (type) {
                                                var cropper = item.popup.editor.cropper,
                                                        scale = item.popup.editor.scale || 1;
                                                cropper.$editor.find('.area-info').html((cropper.isResizing || type == 'size' ? ['W: ' + Math.round(cropper.crop.width / cropper.crop.cfWidth / scale) + 'px', ' ', 'H: ' + Math.round(cropper.crop.height / cropper.crop.cfHeight / scale) + 'px'] : ['X: ' + Math.round(cropper.crop.left / cropper.crop.cfWidth / scale) + 'px', ' ', 'Y: ' + Math.round(cropper.crop.top / cropper.crop.cfHeight / scale) + 'px']).join(''))
                                            },
                                            mousedown: function (e) {
                                                var eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                                        $target = $(e.target),
                                                        cropper = item.popup.editor.cropper,
                                                        points = {
                                                            x: (eventType == 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX) - cropper.$template.offset().left,
                                                            y: (eventType == 'mousedown' ? e.pageY : e.originalEvent.touches[0].pageY) - cropper.$template.offset().top
                                                        },
                                                callback = function () {
                                                    cropper.pointData = {
                                                        el: $target,
                                                        x: points.x,
                                                        y: points.y,
                                                        xEditor: points.x - cropper.crop.left,
                                                        yEditor: points.y - cropper.crop.top,
                                                        left: cropper.crop.left,
                                                        top: cropper.crop.top,
                                                        width: cropper.crop.width,
                                                        height: cropper.crop.height
                                                    };
                                                    if (cropper.isMoving || cropper.isResizing) {
                                                        cropper.setAreaInfo('size');
                                                        cropper.$editor.addClass('moving show-info');
                                                        $('body').css({
                                                            '-webkit-user-select': 'none',
                                                            '-moz-user-select': 'none',
                                                            '-ms-user-select': 'none',
                                                            'user-select': 'none'
                                                        });
                                                        $(document).on('mousemove touchmove', cropper.mousemove)
                                                    }
                                                };
                                                if (e.which == 3)
                                                    return true;
                                                if (item.popup.zoomer && item.popup.zoomer.hasSpacePressed)
                                                    return;
                                                cropper.isMoving = $target.is('.area-move');
                                                cropper.isResizing = $target.is('.point');
                                                if (eventType == 'mousedown') {
                                                    callback()
                                                }
                                                if (eventType == 'touchstart' && e.originalEvent.touches.length == 1) {
                                                    if (cropper.isMoving || cropper.isResizing)
                                                        e.preventDefault();
                                                    cropper.isTouchLongPress = true;
                                                    setTimeout(function () {
                                                        if (!cropper.isTouchLongPress)
                                                            return;
                                                        delete cropper.isTouchLongPress;
                                                        callback()
                                                    }, n.thumbnails.touchDelay ? n.thumbnails.touchDelay : 0)
                                                }
                                                $(document).on('mouseup touchend', cropper.mouseup)
                                            },
                                            mousemove: function (e) {
                                                var eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                                        $target = $(e.target),
                                                        cropper = item.popup.editor.cropper,
                                                        points = {
                                                            x: (eventType == 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX) - cropper.$template.offset().left,
                                                            y: (eventType == 'mousedown' ? e.pageY : e.originalEvent.touches[0].pageY) - cropper.$template.offset().top
                                                        };
                                                if (e.originalEvent.touches && e.originalEvent.touches.length != 1)
                                                    return cropper.mouseup(e);
                                                if (cropper.isMoving) {
                                                    var left = points.x - cropper.pointData.xEditor,
                                                            top = points.y - cropper.pointData.yEditor;
                                                    if (left + cropper.crop.width > cropper.$template.width())
                                                        left = cropper.$template.width() - cropper.crop.width;
                                                    if (left < 0)
                                                        left = 0;
                                                    if (top + cropper.crop.height > cropper.$template.height())
                                                        top = cropper.$template.height() - cropper.crop.height;
                                                    if (top < 0)
                                                        top = 0;
                                                    cropper.crop.left = left;
                                                    cropper.crop.top = top
                                                }
                                                if (cropper.isResizing) {
                                                    var point = cropper.pointData.el.attr('class').substr("point point-".length),
                                                            lastWidth = cropper.crop.left + cropper.crop.width,
                                                            lastHeight = cropper.crop.top + cropper.crop.height,
                                                            minWidth = (n.editor.cropper && n.editor.cropper.minWidth || 0) * cropper.crop.cfWidth,
                                                            minHeight = (n.editor.cropper && n.editor.cropper.minHeight || 0) * cropper.crop.cfHeight,
                                                            maxWidth = (n.editor.cropper && n.editor.cropper.maxWidth) * cropper.crop.cfWidth,
                                                            maxHeight = (n.editor.cropper && n.editor.cropper.maxHeight) * cropper.crop.cfHeight,
                                                            ratio = n.editor.cropper ? n.editor.cropper.ratio : null,
                                                            ratioPx;
                                                    if (minWidth > cropper.$template.width())
                                                        minWidth = cropper.$template.width();
                                                    if (minHeight > cropper.$template.height())
                                                        minHeight = cropper.$template.height();
                                                    if (maxWidth > cropper.$template.width())
                                                        maxWidth = cropper.$template.width();
                                                    if (maxHeight > cropper.$template.height())
                                                        maxHeight = cropper.$template.height();
                                                    if ((point == 'a' || point == 'b' || point == 'c') && !ratioPx) {
                                                        cropper.crop.top = points.y;
                                                        if (cropper.crop.top < 0)
                                                            cropper.crop.top = 0;
                                                        cropper.crop.height = lastHeight - cropper.crop.top;
                                                        if (cropper.crop.top > cropper.crop.top + cropper.crop.height) {
                                                            cropper.crop.top = lastHeight;
                                                            cropper.crop.height = 0
                                                        }
                                                        if (cropper.crop.height < minHeight) {
                                                            cropper.crop.top = lastHeight - minHeight;
                                                            cropper.crop.height = minHeight
                                                        }
                                                        if (cropper.crop.height > maxHeight) {
                                                            cropper.crop.top = lastHeight - maxHeight;
                                                            cropper.crop.height = maxHeight
                                                        }
                                                        ratioPx = ratio ? f._assets.ratioToPx(cropper.crop.width, cropper.crop.height, ratio) : null;
                                                        if (ratioPx) {
                                                            cropper.crop.width = ratioPx[0];
                                                            if (point == 'a' || point == 'b')
                                                                cropper.crop.left = Math.max(0, cropper.pointData.left + ((cropper.pointData.width - cropper.crop.width) / (point == 'b' ? 2 : 1)));
                                                            if (cropper.crop.left + cropper.crop.width > cropper.$template.width()) {
                                                                var newWidth = cropper.$template.width() - cropper.crop.left;
                                                                cropper.crop.width = newWidth;
                                                                cropper.crop.height = newWidth / ratioPx[2] * ratioPx[3];
                                                                cropper.crop.top = lastHeight - cropper.crop.height
                                                            }
                                                        }
                                                    }
                                                    if ((point == 'e' || point == 'f' || point == 'g') && !ratioPx) {
                                                        cropper.crop.height = points.y - cropper.crop.top;
                                                        if (cropper.crop.height + cropper.crop.top > cropper.$template.height())
                                                            cropper.crop.height = cropper.$template.height() - cropper.crop.top;
                                                        if (cropper.crop.height < minHeight)
                                                            cropper.crop.height = minHeight;
                                                        if (cropper.crop.height > maxHeight)
                                                            cropper.crop.height = maxHeight;
                                                        ratioPx = ratio ? f._assets.ratioToPx(cropper.crop.width, cropper.crop.height, ratio) : null;
                                                        if (ratioPx) {
                                                            cropper.crop.width = ratioPx[0];
                                                            if (point == 'f' || point == 'g')
                                                                cropper.crop.left = Math.max(0, cropper.pointData.left + ((cropper.pointData.width - cropper.crop.width) / (point == 'f' ? 2 : 1)));
                                                            if (cropper.crop.left + cropper.crop.width > cropper.$template.width()) {
                                                                var newWidth = cropper.$template.width() - cropper.crop.left;
                                                                cropper.crop.width = newWidth;
                                                                cropper.crop.height = newWidth / ratioPx[2] * ratioPx[3]
                                                            }
                                                        }
                                                    }
                                                    if ((point == 'c' || point == 'd' || point == 'e') && !ratioPx) {
                                                        cropper.crop.width = points.x - cropper.crop.left;
                                                        if (cropper.crop.width + cropper.crop.left > cropper.$template.width())
                                                            cropper.crop.width = cropper.$template.width() - cropper.crop.left;
                                                        if (cropper.crop.width < minWidth)
                                                            cropper.crop.width = minWidth;
                                                        if (cropper.crop.width > maxWidth)
                                                            cropper.crop.width = maxWidth;
                                                        ratioPx = ratio ? f._assets.ratioToPx(cropper.crop.width, cropper.crop.height, ratio) : null;
                                                        if (ratioPx) {
                                                            cropper.crop.height = ratioPx[1];
                                                            if (point == 'c' || point == 'd')
                                                                cropper.crop.top = Math.max(0, cropper.pointData.top + ((cropper.pointData.height - cropper.crop.height) / (point == 'd' ? 2 : 1)));
                                                            if (cropper.crop.top + cropper.crop.height > cropper.$template.height()) {
                                                                var newHeight = cropper.$template.height() - cropper.crop.top;
                                                                cropper.crop.height = newHeight;
                                                                cropper.crop.width = newHeight / ratioPx[3] * ratioPx[2]
                                                            }
                                                        }
                                                    }
                                                    if ((point == 'a' || point == 'g' || point == 'h') && !ratioPx) {
                                                        cropper.crop.left = points.x;
                                                        if (cropper.crop.left > cropper.$template.width())
                                                            cropper.crop.left = cropper.$template.width();
                                                        if (cropper.crop.left < 0)
                                                            cropper.crop.left = 0;
                                                        cropper.crop.width = lastWidth - cropper.crop.left;
                                                        if (cropper.crop.left > cropper.crop.left + cropper.crop.width) {
                                                            cropper.crop.left = lastWidth;
                                                            cropper.crop.width = 0
                                                        }
                                                        if (cropper.crop.width < minWidth) {
                                                            cropper.crop.left = lastWidth - minWidth;
                                                            cropper.crop.width = minWidth
                                                        }
                                                        if (cropper.crop.width > maxWidth) {
                                                            cropper.crop.left = lastWidth - maxWidth;
                                                            cropper.crop.width = maxWidth
                                                        }
                                                        ratioPx = ratio ? f._assets.ratioToPx(cropper.crop.width, cropper.crop.height, ratio) : null;
                                                        if (ratioPx) {
                                                            cropper.crop.height = ratioPx[1];
                                                            if (point == 'a' || point == 'h')
                                                                cropper.crop.top = Math.max(0, cropper.pointData.top + ((cropper.pointData.height - cropper.crop.height) / (point == 'h' ? 2 : 1)));
                                                            if (cropper.crop.top + cropper.crop.height > cropper.$template.height()) {
                                                                var newHeight = cropper.$template.height() - cropper.crop.top;
                                                                cropper.crop.height = newHeight;
                                                                cropper.crop.width = newHeight / ratioPx[3] * ratioPx[2];
                                                                cropper.crop.left = lastWidth - cropper.crop.width
                                                            }
                                                        }
                                                    }
                                                }
                                                cropper.drawPlaceHolder(cropper.crop)
                                            },
                                            mouseup: function (e) {
                                                var cropper = item.popup.editor.cropper;
                                                if (cropper.$editor.width() == 0 || cropper.$editor.height() == 0)
                                                    cropper.init(cropper.setDefaultData());
                                                delete cropper.isTouchLongPress;
                                                delete cropper.isMoving;
                                                delete cropper.isResizing;
                                                cropper.$editor.removeClass('moving show-info');
                                                $('body').css({
                                                    '-webkit-user-select': '',
                                                    '-moz-user-select': '',
                                                    '-ms-user-select': '',
                                                    'user-select': ''
                                                });
                                                $(document).off('mousemove touchmove', cropper.mousemove);
                                                $(document).off('mouseup touchend', cropper.mouseup)
                                            }
                                        };
                                        item.popup.editor.cropper.init()
                                    } else {
                                        if (data)
                                            item.popup.editor.cropper.crop = data;
                                        item.popup.editor.cropper.init(data)
                                    }
                                }
                            },
                            resize: function (img, canvas, width, height, alpha, fixedSize) {
                                var context = canvas.getContext('2d'),
                                        width = !width && height ? height * img.width / img.height : width,
                                        height = !height && width ? width * img.height / img.width : height,
                                        ratio = img.width / img.height,
                                        optimalWidth = ratio >= 1 ? width : height * ratio,
                                        optimalHeight = ratio < 1 ? height : width / ratio;
                                if (fixedSize && optimalWidth < width) {
                                    optimalHeight = optimalHeight * (width / optimalWidth);
                                    optimalWidth = width
                                }
                                if (fixedSize && optimalHeight < height) {
                                    optimalWidth = optimalWidth * (height / optimalHeight);
                                    optimalHeight = height
                                }
                                var steps = Math.min(Math.ceil(Math.log(img.width / optimalWidth) / Math.log(2)), 12);
                                canvas.width = optimalWidth;
                                canvas.height = optimalHeight;
                                if (img.width < canvas.width || img.height < canvas.height || steps < 2) {
                                    if (!fixedSize) {
                                        canvas.width = Math.min(img.width, canvas.width);
                                        canvas.height = Math.min(img.height, canvas.height)
                                    }
                                    var x = img.width < canvas.width ? (canvas.width - img.width) / 2 : 0,
                                            y = img.height < canvas.height ? (canvas.height - img.height) / 2 : 0;
                                    if (!alpha) {
                                        context.fillStyle = "#fff";
                                        context.fillRect(0, 0, canvas.width, canvas.height)
                                    }
                                    context.drawImage(img, x, y, Math.min(img.width, canvas.width), Math.min(img.height, canvas.height))
                                } else {
                                    var oc = document.createElement('canvas'),
                                            octx = oc.getContext('2d'),
                                            factor = 2;
                                    oc.width = img.width / factor;
                                    oc.height = img.height / factor;
                                    octx.fillStyle = "#fff";
                                    octx.fillRect(0, 0, oc.width, oc.height);
                                    octx.imageSmoothingEnabled = false;
                                    octx.imageSmoothingQuality = 'high';
                                    octx.drawImage(img, 0, 0, oc.width, oc.height);
                                    while (steps > 2) {
                                        var factor2 = factor + 2,
                                                widthFactor = img.width / factor,
                                                heightFactor = img.height / factor;
                                        if (widthFactor > oc.width)
                                            widthFactor = oc.width;
                                        if (heightFactor > oc.height)
                                            heightFactor = oc.height;
                                        octx.imageSmoothingEnabled = true;
                                        octx.drawImage(oc, 0, 0, widthFactor, heightFactor, 0, 0, img.width / factor2, img.height / factor2);
                                        factor = factor2;
                                        steps--
                                    }
                                    var widthFactor = img.width / factor,
                                            heightFactor = img.height / factor;
                                    if (widthFactor > oc.width)
                                        widthFactor = oc.width;
                                    if (heightFactor > oc.height)
                                        heightFactor = oc.height;
                                    context.drawImage(oc, 0, 0, widthFactor, heightFactor, 0, 0, optimalWidth, optimalHeight);
                                    oc = octx = null
                                }
                                context = null
                            },
                            zoomer: function (item) {
                                var inPopup = item.popup && item.popup.html && $('html').find(item.popup.html).length;
                                if (!inPopup)
                                    return;
                                if (!item.popup.zoomer) {
                                    var $popup = item.popup.html,
                                            $node = $popup.find('.fileuploader-popup-node'),
                                            $readerNode = $node.find('.reader-node'),
                                            $imageEl = $readerNode.find('> img').attr('draggable', 'false').attr('ondragstart', 'return false;');
                                    item.popup.zoomer = {
                                        html: $popup.find('.fileuploader-popup-zoomer'),
                                        isActive: item.format == 'image' && item.popup.node && n.thumbnails.popup.zoomer,
                                        scale: 100,
                                        zoom: 100,
                                        init: function () {
                                            var zoomer = this;
                                            if (!zoomer.isActive || f._assets.isIE() || f._assets.isMobile())
                                                return zoomer.html.hide() && $node.addClass('has-node-centered');
                                            zoomer.hide();
                                            zoomer.resize();
                                            $(window).on('resize', zoomer.resize);
                                            $(window).on('keyup keydown', zoomer.keyPress);
                                            zoomer.html.find('input').on('input change', zoomer.range);
                                            $readerNode.on('mousedown touchstart', zoomer.mousedown);
                                            $node.on('mousewheel DOMMouseScroll', zoomer.scroll)
                                        },
                                        hide: function () {
                                            var zoomer = this;
                                            $(window).off('resize', zoomer.resize);
                                            $(window).off('keyup keydown', zoomer.keyPress);
                                            zoomer.html.find('input').off('input change', zoomer.range);
                                            $readerNode.off('mousedown', zoomer.mousedown);
                                            $node.off('mousewheel DOMMouseScroll', zoomer.scroll)
                                        },
                                        center: function (prevDimensions) {
                                            var zoomer = this,
                                                    left = 0,
                                                    top = 0;
                                            if (!prevDimensions) {
                                                left = Math.round(($node.width() - $readerNode.width()) / 2);
                                                top = Math.round(($node.height() - $readerNode.height()) / 2)
                                            } else {
                                                left = zoomer.left;
                                                top = zoomer.top;
                                                left -= (($node.width() / 2 - zoomer.left) * (($readerNode.width() / prevDimensions[0]) - 1));
                                                top -= (($node.height() / 2 - zoomer.top) * (($readerNode.height() / prevDimensions[1]) - 1));
                                                if ($readerNode.width() <= $node.width())
                                                    left = Math.round(($node.width() - $readerNode.width()) / 2);
                                                if ($readerNode.height() <= $node.height())
                                                    top = Math.round(($node.height() - $readerNode.height()) / 2);
                                                if ($readerNode.width() > $node.width()) {
                                                    if (left > 0)
                                                        left = 0;
                                                    else if (left + $readerNode.width() < $node.width())
                                                        left = $node.width() - $readerNode.width()
                                                }
                                                if ($readerNode.height() > $node.height()) {
                                                    if (top > 0)
                                                        top = 0;
                                                    else if (top + $readerNode.height() < $node.height())
                                                        top = $node.height() - $readerNode.height()
                                                }
                                                top = Math.min(top, 0)
                                            }
                                            $readerNode.css({
                                                left: (zoomer.left = left) + 'px',
                                                top: (zoomer.top = top) + 'px',
                                                width: $readerNode.width(),
                                                height: $readerNode.height()
                                            })
                                        },
                                        resize: function () {
                                            var zoomer = item.popup.zoomer;
                                            $node.removeClass('is-zoomed');
                                            $readerNode.removeAttr('style');
                                            zoomer.scale = zoomer.getImageScale();
                                            zoomer.updateView()
                                        },
                                        range: function (e) {
                                            var zoomer = item.popup.zoomer,
                                                    $input = $(this),
                                                    val = parseFloat($input.val());
                                            if (zoomer.scale >= 100) {
                                                e.preventDefault();
                                                $input.val(zoomer.scale);
                                                return
                                            }
                                            if (val < zoomer.scale) {
                                                e.preventDefault();
                                                val = zoomer.scale;
                                                $input.val(val)
                                            }
                                            zoomer.updateView(val, true)
                                        },
                                        scroll: function (e) {
                                            var zoomer = item.popup.zoomer,
                                                    delta = -100;
                                            if (e.originalEvent) {
                                                if (e.originalEvent.wheelDelta)
                                                    delta = e.originalEvent.wheelDelta / -40;
                                                if (e.originalEvent.deltaY)
                                                    delta = e.originalEvent.deltaY;
                                                if (e.originalEvent.detail)
                                                    delta = e.originalEvent.detail
                                            }
                                            zoomer[delta < 0 ? 'zoomIn' : 'zoomOut'](3)
                                        },
                                        keyPress: function (e) {
                                            var zoomer = item.popup.zoomer,
                                                    type = e.type,
                                                    key = e.keyCode || e.which;
                                            if (key != 32)
                                                return;
                                            zoomer.hasSpacePressed = type == 'keydown';
                                            if (zoomer.hasSpacePressed && zoomer.isZoomed())
                                                $readerNode.addClass('is-amoving');
                                            else
                                                $readerNode.removeClass('is-amoving')
                                        },
                                        mousedown: function (e) {
                                            var zoomer = item.popup.zoomer,
                                                    $target = $(e.target),
                                                    eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                                    points = {
                                                        x: eventType == 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX,
                                                        y: eventType == 'mousedown' ? e.pageY : e.originalEvent.touches[0].pageY
                                                    },
                                            callback = function () {
                                                zoomer.pointData = {
                                                    x: points.x,
                                                    y: points.y,
                                                    xTarget: points.x - zoomer.left,
                                                    yTarget: points.y - zoomer.top,
                                                };
                                                $('body').css({
                                                    '-webkit-user-select': 'none',
                                                    '-moz-user-select': 'none',
                                                    '-ms-user-select': 'none',
                                                    'user-select': 'none'
                                                });
                                                $readerNode.addClass('is-moving');
                                                $(document).on('mousemove', zoomer.mousemove)
                                            };
                                            if (e.which != 1)
                                                return;
                                            if (zoomer.scale == 100 || zoomer.zoom == zoomer.scale)
                                                return;
                                            if (!zoomer.hasSpacePressed && $target[0] != $imageEl[0] && !$target.is('.fileuploader-cropper'))
                                                return;
                                            if (eventType == 'mousedown') {
                                                callback()
                                            }
                                            if (eventType == 'touchstart') {
                                                zoomer.isTouchLongPress = true;
                                                setTimeout(function () {
                                                    if (!zoomer.isTouchLongPress)
                                                        return;
                                                    delete zoomer.isTouchLongPress;
                                                    callback()
                                                }, n.thumbnails.touchDelay ? n.thumbnails.touchDelay : 0)
                                            }
                                            $(document).on('mouseup touchend', zoomer.mouseup)
                                        },
                                        mousemove: function (e) {
                                            var zoomer = item.popup.zoomer,
                                                    eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                                    points = {
                                                        x: eventType == 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX,
                                                        y: eventType == 'mousedown' ? e.pageY : e.originalEvent.touches[0].pageY
                                                    },
                                            left = points.x - zoomer.pointData.xTarget,
                                                    top = points.y - zoomer.pointData.yTarget;
                                            if (top > 0)
                                                top = 0;
                                            if (top < $node.height() - $readerNode.height())
                                                top = $node.height() - $readerNode.height();
                                            if ($readerNode.height() < $node.height()) {
                                                top = $node.height() / 2 - $readerNode.height() / 2
                                            }
                                            if ($readerNode.width() > $node.width()) {
                                                if (left > 0)
                                                    left = 0;
                                                if (left < $node.width() - $readerNode.width())
                                                    left = $node.width() - $readerNode.width()
                                            } else {
                                                left = $node.width() / 2 - $readerNode.width() / 2
                                            }
                                            $readerNode.css({
                                                left: (zoomer.left = left) + 'px',
                                                top: (zoomer.top = top) + 'px'
                                            })
                                        },
                                        mouseup: function (e) {
                                            var zoomer = item.popup.zoomer;
                                            delete zoomer.pointData;
                                            $('body').css({
                                                '-webkit-user-select': '',
                                                '-moz-user-select': '',
                                                '-ms-user-select': '',
                                                'user-select': ''
                                            });
                                            $readerNode.removeClass('is-moving');
                                            $(document).off('mousemove', zoomer.mousemove);
                                            $(document).off('mouseup', zoomer.mouseup)
                                        },
                                        zoomIn: function (val) {
                                            var zoomer = item.popup.zoomer,
                                                    step = val || 20;
                                            if (zoomer.zoom >= 100)
                                                return;
                                            zoomer.zoom = Math.min(100, zoomer.zoom + step);
                                            zoomer.updateView(zoomer.zoom)
                                        },
                                        zoomOut: function (val) {
                                            var zoomer = item.popup.zoomer,
                                                    step = val || 20;
                                            if (zoomer.zoom <= zoomer.scale)
                                                return;
                                            zoomer.zoom = Math.max(zoomer.scale, zoomer.zoom - step);
                                            zoomer.updateView(zoomer.zoom)
                                        },
                                        updateView: function (val, input) {
                                            var zoomer = this,
                                                    width = zoomer.getImageSize().width / 100 * val,
                                                    height = zoomer.getImageSize().height / 100 * val,
                                                    curWidth = $readerNode.width(),
                                                    curHeight = $readerNode.height(),
                                                    valueChanged = val && val != zoomer.scale;
                                            if (!zoomer.isActive)
                                                return zoomer.center();
                                            if (valueChanged) {
                                                $node.addClass('is-zoomed');
                                                $readerNode.addClass('is-movable').css({
                                                    width: width + 'px',
                                                    height: height + 'px',
                                                    maxWidth: 'none',
                                                    maxHeight: 'none'
                                                })
                                            } else {
                                                $node.removeClass('is-zoomed');
                                                $readerNode.removeClass('is-movable is-amoving').removeAttr('style')
                                            }
                                            zoomer.zoom = val || zoomer.scale;
                                            zoomer.center(valueChanged ? [curWidth, curHeight, zoomer.left, zoomer.top] : null);
                                            zoomer.html.find('span').html(zoomer.zoom + '%');
                                            if (!input)
                                                zoomer.html.find('input').val(zoomer.zoom);
                                            if (val && item.popup.editor && item.popup.editor.cropper)
                                                item.popup.editor.cropper.resize(true)
                                        },
                                        isZoomed: function () {
                                            var zoomer = this;
                                            return zoomer.zoom > zoomer.scale
                                        },
                                        getImageSize: function () {
                                            var zoomer = this;
                                            return {
                                                width: $imageEl.prop('naturalWidth'),
                                                height: $imageEl.prop('naturalHeight')
                                            }
                                        },
                                        getImageScale: function () {
                                            var zoomer = this;
                                            return Math.round(100 / ($imageEl.prop('naturalWidth') / $imageEl.width()))
                                        }
                                    }
                                }
                                item.popup.zoomer.init()
                            },
                            save: function (item, toBlob, mimeType, callback, preventThumbnailRender) {
                                var inPopup = item.popup && item.popup.html && $('html').find(item.popup.html).length,
                                        image = new Image(),
                                        onload = function () {
                                            if (!item.reader.node)
                                                return;
                                            var canvas = document.createElement('canvas'),
                                                    ctx = canvas.getContext('2d'),
                                                    image = this,
                                                    rotationCf = [0, 180],
                                                    type = mimeType || item.type || 'image/jpeg',
                                                    quality = n.editor.quality || 90,
                                                    nextStep = function (exportDataURI, img) {
                                                        var data = exportDataURI;
                                                        if (toBlob) {
                                                            if (data)
                                                                data = f._assets.dataURItoBlob(data, type);
                                                            else
                                                                console.error('Error: Failed to execute \'toDataURL\' on \'HTMLCanvasElement\': Tainted canvases may not be exported.')
                                                        }
                                                        !preventThumbnailRender && data ? f.thumbnails.renderThumbnail(item, true, img || exportDataURI) : null;
                                                        callback ? callback(data, item, l, p, o, s) : null;
                                                        n.editor.onSave != null && typeof n.editor.onSave == "function" ? n.editor.onSave(data, item, l, p, o, s) : null;
                                                        f.set('listInput', null)
                                                    };
                                            try {
                                                canvas.width = item.reader.width;
                                                canvas.height = item.reader.height;
                                                ctx.drawImage(image, 0, 0, item.reader.width, item.reader.height);
                                                if (typeof item.editor.rotation != 'undefined') {
                                                    item.editor.rotation = item.editor.rotation || 0;
                                                    canvas.width = rotationCf.indexOf(item.editor.rotation) > -1 ? item.reader.width : item.reader.height;
                                                    canvas.height = rotationCf.indexOf(item.editor.rotation) > -1 ? item.reader.height : item.reader.width;
                                                    var angle = item.editor.rotation * Math.PI / 180,
                                                            cw = canvas.width * 0.5,
                                                            ch = canvas.height * 0.5;
                                                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                                                    ctx.translate(cw, ch);
                                                    ctx.rotate(angle);
                                                    ctx.translate(-item.reader.width * 0.5, -item.reader.height * 0.5);
                                                    ctx.drawImage(image, 0, 0);
                                                    ctx.setTransform(1, 0, 0, 1, 0, 0)
                                                }
                                                if (item.editor.crop) {
                                                    var cut = ctx.getImageData(item.editor.crop.left, item.editor.crop.top, item.editor.crop.width, item.editor.crop.height);
                                                    canvas.width = item.editor.crop.width;
                                                    canvas.height = item.editor.crop.height;
                                                    ctx.putImageData(cut, 0, 0)
                                                }
                                                var exportDataURI = canvas.toDataURL(type, quality / 100);
                                                if (n.editor.maxWidth || n.editor.maxHeight) {
                                                    var img = new Image();
                                                    img.src = exportDataURI;
                                                    img.onload = function () {
                                                        var canvas2 = document.createElement('canvas');
                                                        f.editor.resize(img, canvas2, n.editor.maxWidth, n.editor.maxHeight, true, false);
                                                        exportDataURI = canvas2.toDataURL(type, quality / 100);
                                                        canvas = ctx = canvas2 = null;
                                                        nextStep(exportDataURI, img)
                                                    }
                                                } else {
                                                    canvas = ctx = null;
                                                    nextStep(exportDataURI)
                                                }
                                            } catch (e) {
                                                item.popup.editor = null;
                                                canvas = ctx = null;
                                                nextStep(null)
                                            }
                                        };
                                if (inPopup) {
                                    if (!item.popup.editor.hasChanges)
                                        return;
                                    var scale = item.popup.editor.scale || 1;
                                    item.editor.rotation = item.popup.editor.rotation || 0;
                                    if (item.popup.editor.cropper) {
                                        item.editor.crop = item.popup.editor.cropper.crop;
                                        item.editor.crop.width = item.editor.crop.width / item.popup.editor.cropper.crop.cfWidth / scale;
                                        item.editor.crop.left = item.editor.crop.left / item.popup.editor.cropper.crop.cfWidth / scale;
                                        item.editor.crop.height = item.editor.crop.height / item.popup.editor.cropper.crop.cfHeight / scale;
                                        item.editor.crop.top = item.editor.crop.top / item.popup.editor.cropper.crop.cfHeight / scale
                                    }
                                }
                                if (f._assets.isMobile()) {
                                    image.onload = onload;
                                    image.src = item.reader.src
                                } else if (item.popup.node) {
                                    onload.call(item.popup.node)
                                } else if (item.reader.node) {
                                    onload.call(item.reader.node)
                                } else {
                                    item.reader.read(item, function () {
                                        onload.call(item.reader.node)
                                    })
                                }
                            }
                        },
                        sorter: {
                            init: function () {
                                p.on('mousedown touchstart', n.thumbnails._selectors.sorter, f.sorter.mousedown)
                            },
                            destroy: function () {
                                p.off('mousedown touchstart', n.thumbnails._selectors.sorter, f.sorter.mousedown)
                            },
                            findItemAtPos: function (points) {
                                var sort = f.sorter.sort,
                                        $list = sort.items.not(sort.item.html),
                                        $item = null;
                                $list.each(function (i, el) {
                                    var $el = $(el);
                                    if (points.x > $el.offset().left && points.x < $el.offset().left + $el.outerWidth() && points.y > $el.offset().top && points.y < $el.offset().top + $el.outerHeight()) {
                                        $item = $el;
                                        return false
                                    }
                                });
                                return $item
                            },
                            mousedown: function (e) {
                                var eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                        $target = $(e.target),
                                        $item = $target.closest(n.thumbnails._selectors.item),
                                        item = f.files.find($item),
                                        points = {
                                            x: eventType == 'mousedown' || !$item.length ? e.pageX : e.originalEvent.touches[0].pageX,
                                            y: eventType == 'mousedown' || !$item.length ? e.pageY : e.originalEvent.touches[0].pageY
                                        },
                                callback = function () {
                                    f.sorter.sort = {
                                        el: $target,
                                        item: item,
                                        items: l.find(n.thumbnails._selectors.item),
                                        x: points.x,
                                        y: points.y,
                                        xItem: points.x - $item.offset().left,
                                        yItem: points.y - $item.offset().top,
                                        left: $item.position().left,
                                        top: $item.position().top,
                                        width: $item.outerWidth(),
                                        height: $item.outerHeight(),
                                        placeholder: n.sorter.placeholder ? $(n.sorter.placeholder) : $(item.html.get(0).cloneNode()).addClass('fileuploader-sorter-placeholder')
                                    };
                                    $('body').css({
                                        '-webkit-user-select': 'none',
                                        '-moz-user-select': 'none',
                                        '-ms-user-select': 'none',
                                        'user-select': 'none'
                                    });
                                    $(document).on('mousemove touchmove', f.sorter.mousemove)
                                };
                                if (f.sorter.sort)
                                    f.sorter.mouseup();
                                if (e.which == 3)
                                    return true;
                                if (!item)
                                    return true;
                                if (n.sorter.selectorExclude && ($target.is(n.sorter.selectorExclude) || $target.closest(n.sorter.selectorExclude).length))
                                    return true;
                                e.preventDefault();
                                if (eventType == 'mousedown') {
                                    callback()
                                }
                                if (eventType == 'touchstart') {
                                    f.sorter.isTouchLongPress = true;
                                    setTimeout(function () {
                                        if (!f.sorter.isTouchLongPress)
                                            return;
                                        delete f.sorter.isTouchLongPress;
                                        callback()
                                    }, n.thumbnails.touchDelay ? n.thumbnails.touchDelay : 0)
                                }
                                $(document).on('mouseup touchend', f.sorter.mouseup)
                            },
                            mousemove: function (e) {
                                var eventType = e.originalEvent.touches && e.originalEvent.touches[0] ? 'touchstart' : 'mousedown',
                                        sort = f.sorter.sort,
                                        item = sort.item,
                                        $list = l.find(n.thumbnails._selectors.item),
                                        $container = $(n.sorter.scrollContainer || window),
                                        scroll = {
                                            left: $(document).scrollLeft(),
                                            top: $(document).scrollTop(),
                                            containerLeft: $container.scrollLeft(),
                                            containerTop: $container.scrollTop()
                                        },
                                points = {
                                    x: eventType == 'mousedown' ? e.clientX : e.originalEvent.touches[0].clientX,
                                    y: eventType == 'mousedown' ? e.clientY : e.originalEvent.touches[0].clientY
                                };
                                var left = points.x - sort.xItem,
                                        top = points.y - sort.yItem,
                                        leftContainer = points.x - ($container.prop('offsetLeft') || 0),
                                        topContainer = points.y - ($container.prop('offsetTop') || 0);
                                if (left + sort.xItem > $container.width())
                                    left = $container.width() - sort.xItem;
                                if (left + sort.xItem < 0)
                                    left = 0 - sort.xItem;
                                if (top + sort.yItem > $container.height())
                                    top = $container.height() - sort.yItem;
                                if (top + sort.yItem < 0)
                                    top = 0 - sort.yItem;
                                if (topContainer <= 0)
                                    $container.scrollTop(scroll.containerTop - 10);
                                if (topContainer > $container.height())
                                    $container.scrollTop(scroll.containerTop + 10);
                                if (leftContainer < 0)
                                    $container.scrollLeft(scroll.containerLeft - 10);
                                if (leftContainer > $container.width())
                                    $container.scrollLeft(scroll.containerLeft + 10);
                                item.html.addClass('sorting').css({
                                    position: 'fixed',
                                    left: left,
                                    top: top,
                                    width: f.sorter.sort.width,
                                    height: f.sorter.sort.height
                                });
                                if (!l.find(sort.placeholder).length)
                                    item.html.after(sort.placeholder);
                                sort.placeholder.css({
                                    width: f.sorter.sort.width,
                                    height: f.sorter.sort.height,
                                });
                                var $hoverEl = f.sorter.findItemAtPos({
                                    x: left + sort.xItem + scroll.left,
                                    y: top + sort.yItem + scroll.top
                                });
                                if ($hoverEl) {
                                    var directionX = sort.placeholder.offset().left != $hoverEl.offset().left,
                                            directionY = sort.placeholder.offset().top != $hoverEl.offset().top;
                                    if (f.sorter.sort.lastHover) {
                                        if (f.sorter.sort.lastHover.el == $hoverEl[0]) {
                                            if (directionY && f.sorter.sort.lastHover.direction == 'before' && points.y < f.sorter.sort.lastHover.y)
                                                return;
                                            if (directionY && f.sorter.sort.lastHover.direction == 'after' && points.y > f.sorter.sort.lastHover.y)
                                                return;
                                            if (directionX && f.sorter.sort.lastHover.direction == 'before' && points.x < f.sorter.sort.lastHover.x)
                                                return;
                                            if (directionX && f.sorter.sort.lastHover.direction == 'after' && points.x > f.sorter.sort.lastHover.x)
                                                return
                                        }
                                    }
                                    var index = $list.index(item.html),
                                            hoverIndex = $list.index($hoverEl),
                                            direction = index > hoverIndex ? 'before' : 'after';
                                    $hoverEl[direction](sort.placeholder);
                                    $hoverEl[direction](item.html);
                                    f.sorter.sort.lastHover = {
                                        el: $hoverEl[0],
                                        x: points.x,
                                        y: points.y,
                                        direction: direction
                                    }
                                }
                            },
                            mouseup: function () {
                                var sort = f.sorter.sort,
                                        item = sort.item;
                                $('body').css({
                                    '-webkit-user-select': '',
                                    '-moz-user-select': '',
                                    '-ms-user-select': '',
                                    'user-select': ''
                                });
                                item.html.removeClass('sorting').css({
                                    position: '',
                                    left: '',
                                    top: '',
                                    width: '',
                                    height: ''
                                });
                                $(document).off('mousemove touchmove', f.sorter.mousemove);
                                $(document).off('mouseup touchend', f.sorter.mouseup);
                                sort.placeholder.remove();
                                delete f.sorter.sort;
                                f.sorter.save()
                            },
                            save: function (isFromList) {
                                var index = 0,
                                        list = [],
                                        cachedList = [],
                                        items = isFromList ? f._itFl : (n.thumbnails.itemPrepend) ? l.children().get().reverse() : l.children(),
                                        hasChanges;
                                $.each(items, function (i, el) {
                                    var item = el.file ? el : f.files.find($(el));
                                    if (item) {
                                        if (item.upload && !item.uploaded)
                                            return;
                                        if (f.rendered && item.index != index && ((f._itSl && f._itSl.indexOf(item.id) != index) || true))
                                            hasChanges = true;
                                        item.index = index;
                                        list.push(item);
                                        cachedList.push(item.id);
                                        index++
                                    }
                                });
                                if (f._itSl && f._itSl.length != cachedList.length)
                                    hasChanges = true;
                                f._itSl = cachedList;
                                if (hasChanges && list.length == f._itFl.length)
                                    f._itFl = list;
                                if (!isFromList)
                                    f.set('listInput', 'ignoreSorter');
                                hasChanges && n.sorter.onSort != null && typeof n.sorter.onSort == "function" ? n.sorter.onSort(list, l, p, o, s) : null
                            }
                        },
                        upload: {
                            prepare: function (item, force_send) {
                                item.upload = {
                                    url: n.upload.url,
                                    data: $.extend({}, n.upload.data),
                                    formData: new FormData(),
                                    type: n.upload.type || 'POST',
                                    enctype: n.upload.enctype || 'multipart/form-data',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    chunk: item.upload ? item.upload.chunk : null,
                                    status: null,
                                    send: function () {
                                        f.upload.send(item, true)
                                    },
                                    cancel: function (isFromRemove) {
                                        f.upload.cancel(item, isFromRemove)
                                    }
                                };
                                item.upload.formData.append(s.attr('name'), item.file, (item.name ? item.name : false));
                                if (n.upload.start || force_send)
                                    f.upload.send(item, force_send)
                            },
                            send: function (item, force_send) {
                                if (!item.upload)
                                    return;
                                var setItemUploadStatus = function (status) {
                                    if (item.html)
                                        item.html.removeClass('upload-pending upload-loading upload-cancelled upload-failed upload-successful').addClass('upload-' + (status || item.upload.status))
                                },
                                        loadNextItem = function () {
                                            var i = 0;
                                            if (f._pfuL.length > 0) {
                                                f._pfuL.indexOf(item) > -1 ? f._pfuL.splice(f._pfuL.indexOf(item), 1) : null;
                                                while (i < f._pfuL.length) {
                                                    if (f._itFl.indexOf(f._pfuL[i]) > -1 && f._pfuL[i].upload && !f._pfuL[i].upload.$ajax) {
                                                        f.upload.send(f._pfuL[i], true);
                                                        break
                                                    } else {
                                                        f._pfuL.splice(i, 1)
                                                    }
                                                    i++
                                                }
                                            }
                                        };
                                if (n.upload.synchron && !item.upload.chunk) {
                                    item.upload.status = 'pending';
                                    if (item.html)
                                        setItemUploadStatus();
                                    if (force_send) {
                                        f._pfuL.indexOf(item) > -1 ? f._pfuL.splice(f._pfuL.indexOf(item), 1) : null
                                    } else {
                                        f._pfuL.indexOf(item) == -1 ? f._pfuL.push(item) : null;
                                        if (f._pfuL.length > 1) {
                                            return
                                        }
                                    }
                                }
                                if (n.upload.chunk && item.file.slice) {
                                    var chunkSize = f._assets.toBytes(n.upload.chunk),
                                            chunks = Math.ceil(item.size / chunkSize, chunkSize);
                                    if (chunks > 1 && !item.upload.chunk)
                                        item.upload.chunk = {
                                            name: item.name,
                                            size: item.file.size,
                                            type: item.file.type,
                                            chunkSize: chunkSize,
                                            temp_name: item.name,
                                            loaded: 0,
                                            total: chunks,
                                            i: -1
                                        };
                                    if (item.upload.chunk) {
                                        item.upload.chunk.i++;
                                        delete item.upload.chunk.isFirst;
                                        delete item.upload.chunk.isLast;
                                        if (item.upload.chunk.i == 0)
                                            item.upload.chunk.isFirst = true;
                                        if (item.upload.chunk.i == item.upload.chunk.total - 1)
                                            item.upload.chunk.isLast = true;
                                        if (item.upload.chunk.i <= item.upload.chunk.total - 1) {
                                            var offset = item.upload.chunk.i * item.upload.chunk.chunkSize,
                                                    filePart = item.file.slice(offset, offset + item.upload.chunk.chunkSize);
                                            item.upload.formData = new FormData();
                                            item.upload.formData.append(s.attr('name'), filePart);
                                            item.upload.data._chunkedd = JSON.stringify(item.upload.chunk)
                                        } else {
                                            delete item.upload.chunk
                                        }
                                    }
                                }
                                if (n.upload.beforeSend && $.isFunction(n.upload.beforeSend) && n.upload.beforeSend(item, l, p, o, s) === false) {
                                    delete item.upload.chunk;
                                    setItemUploadStatus();
                                    loadNextItem();
                                    return
                                }
                                p.addClass('fileuploader-is-uploading');
                                if (item.upload.$ajax)
                                    item.upload.$ajax.abort();
                                delete item.upload.$ajax;
                                delete item.upload.send;
                                item.upload.status = 'loading';
                                if (item.html) {
                                    if (n.thumbnails._selectors.start)
                                        item.html.find(n.thumbnails._selectors.start).remove();
                                    setItemUploadStatus()
                                }
                                if (item.upload.data) {
                                    for (var k in item.upload.data) {
                                        if (!item.upload.data.hasOwnProperty(k))
                                            continue;
                                        item.upload.formData.append(k, item.upload.data[k])
                                    }
                                }
                                item.upload.data = item.upload.formData;
                                item.upload.xhrStartedAt = item.upload.chunk && item.upload.chunk.xhrStartedAt ? item.upload.chunk.xhrStartedAt : new Date();
                                item.upload.xhr = function () {
                                    var xhr = $.ajaxSettings.xhr();
                                    if (xhr.upload) {
                                        xhr.upload.addEventListener("progress", function (e) {
                                            if (item.upload.$ajax) {
                                                item.upload.$ajax.total = item.upload.chunk ? item.upload.chunk.size : e.total
                                            }
                                            f.upload.progressHandling(e, item, item.upload.xhrStartedAt)
                                        }, false)
                                    }
                                    return xhr
                                };
                                item.upload.complete = function (jqXHR, textStatus) {
                                    if (item.upload.chunk && !item.upload.chunk.isLast && textStatus == 'success')
                                        return f.upload.prepare(item, true);
                                    loadNextItem();
                                    delete item.upload.xhrStartedAt;
                                    var g = true;
                                    $.each(f._itFl, function (i, a) {
                                        if (a.upload && a.upload.$ajax)
                                            g = false
                                    });
                                    if (g) {
                                        p.removeClass('fileuploader-is-uploading');
                                        n.upload.onComplete != null && typeof n.upload.onComplete == "function" ? n.upload.onComplete(l, p, o, s, jqXHR, textStatus) : null
                                    }
                                };
                                item.upload.success = function (data, textStatus, jqXHR) {
                                    if (item.upload.chunk && !item.upload.chunk.isLast) {
                                        try {
                                            var json = JSON.parse(data);
                                            item.upload.chunk.temp_name = json.fileuploader.temp_name
                                        } catch (e) {
                                        }
                                        return
                                    }
                                    delete item.upload.chunk;
                                    f.upload.progressHandling(null, item, item.upload.xhrStartedAt, true);
                                    item.uploaded = true;
                                    delete item.upload;
                                    item.upload = {
                                        status: 'successful',
                                        resend: function () {
                                            f.upload.retry(item)
                                        }
                                    };
                                    if (item.html)
                                        setItemUploadStatus();
                                    n.upload.onSuccess != null && $.isFunction(n.upload.onSuccess) ? n.upload.onSuccess(data, item, l, p, o, s, textStatus, jqXHR) : null;
                                    f.set('listInput', null)
                                };
                                item.upload.error = function (jqXHR, textStatus, errorThrown) {
                                    if (item.upload.chunk)
                                        item.upload.chunk.i = Math.max(-1, item.upload.chunk.i - 1);
                                    item.uploaded = false;
                                    item.upload.status = item.upload.status == 'cancelled' ? item.upload.status : 'failed';
                                    item.upload.retry = function () {
                                        f.upload.retry(item)
                                    };
                                    delete item.upload.$ajax;
                                    if (item.html)
                                        setItemUploadStatus();
                                    n.upload.onError != null && $.isFunction(n.upload.onError) ? n.upload.onError(item, l, p, o, s, jqXHR, textStatus, errorThrown) : null
                                };
                                item.upload.$ajax = $.ajax(item.upload)
                            },
                            cancel: function (item, isFromRemove) {
                                if (item && item.upload) {
                                    item.upload.status = 'cancelled';
                                    delete item.upload.chunk;
                                    item.upload.$ajax ? item.upload.$ajax.abort() : null;
                                    delete item.upload.$ajax;
                                    !isFromRemove ? f.files.remove(item) : null
                                }
                            },
                            retry: function (item) {
                                if (item && item.upload) {
                                    if (item.html && n.thumbnails._selectors.retry)
                                        item.html.find(n.thumbnails._selectors.retry).remove();
                                    f.upload.prepare(item, true)
                                }
                            },
                            progressHandling: function (e, item, xhrStartedAt, isManual) {
                                if (!e && isManual && item.upload.$ajax)
                                    e = {
                                        total: item.upload.$ajax.total || item.size,
                                        loaded: item.upload.$ajax.total || item.size,
                                        lengthComputable: true
                                    };
                                if (e.lengthComputable) {
                                    var date = new Date(),
                                            loaded = e.loaded + (item.upload.chunk ? item.upload.chunk.loaded : 0),
                                            total = item.upload.chunk ? item.upload.chunk.size : e.total,
                                            percentage = Math.round(loaded * 100 / total),
                                            timeStarted = item.upload.chunk && item.upload.chunk.xhrStartedAt ? item.upload.chunk.xhrStartedAt : xhrStartedAt,
                                            secondsElapsed = (date.getTime() - timeStarted.getTime()) / 1000,
                                            bytesPerSecond = secondsElapsed ? loaded / secondsElapsed : 0,
                                            remainingBytes = Math.max(0, total - loaded),
                                            secondsRemaining = Math.max(0, secondsElapsed ? remainingBytes / bytesPerSecond : 0),
                                            data = {
                                                loaded: loaded,
                                                loadedInFormat: f._assets.bytesToText(loaded),
                                                total: total,
                                                totalInFormat: f._assets.bytesToText(total),
                                                percentage: percentage,
                                                secondsElapsed: secondsElapsed,
                                                secondsElapsedInFormat: f._assets.secondsToText(secondsElapsed, true),
                                                bytesPerSecond: bytesPerSecond,
                                                bytesPerSecondInFormat: f._assets.bytesToText(bytesPerSecond) + '/s',
                                                remainingBytes: remainingBytes,
                                                remainingBytesInFormat: f._assets.bytesToText(remainingBytes),
                                                secondsRemaining: secondsRemaining,
                                                secondsRemainingInFormat: f._assets.secondsToText(secondsRemaining, true)
                                            };
                                    if (item.upload.chunk) {
                                        if (item.upload.chunk.isFirst)
                                            item.upload.chunk.xhrStartedAt = xhrStartedAt;
                                        if (e.loaded == e.total && !item.upload.chunk.isLast)
                                            item.upload.chunk.loaded += Math.max(e.total, item.upload.chunk.total / item.upload.chunk.chunkSize)
                                    }
                                    if (data.percentage > 99 && !isManual)
                                        data.percentage = 99;
                                    n.upload.onProgress && $.isFunction(n.upload.onProgress) ? n.upload.onProgress(data, item, l, p, o, s) : null
                                }
                            }
                        },
                        dragDrop: {
                            onDragEnter: function (e) {
                                clearTimeout(f.dragDrop._timer);
                                n.dragDrop.container.addClass('fileuploader-dragging');
                                f.set('feedback', f._assets.textParse(n.captions.drop));
                                n.dragDrop.onDragEnter != null && $.isFunction(n.dragDrop.onDragEnter) ? n.dragDrop.onDragEnter(e, l, p, o, s) : null
                            },
                            onDragLeave: function (e) {
                                clearTimeout(f.dragDrop._timer);
                                f.dragDrop._timer = setTimeout(function (e) {
                                    if (!f.dragDrop._dragLeaveCheck(e)) {
                                        return false
                                    }
                                    n.dragDrop.container.removeClass('fileuploader-dragging');
                                    f.set('feedback', null);
                                    n.dragDrop.onDragLeave != null && $.isFunction(n.dragDrop.onDragLeave) ? n.dragDrop.onDragLeave(e, l, p, o, s) : null
                                }, 100, e)
                            },
                            onDrop: function (e) {
                                clearTimeout(f.dragDrop._timer);
                                n.dragDrop.container.removeClass('fileuploader-dragging');
                                f.set('feedback', null);
                                if (e && e.originalEvent && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files && e.originalEvent.dataTransfer.files.length) {
                                    if (f.isUploadMode()) {
                                        f.onChange(e, e.originalEvent.dataTransfer.files)
                                    } else {
                                        s.prop('files', e.originalEvent.dataTransfer.files).trigger('change')
                                    }
                                }
                                n.dragDrop.onDrop != null && $.isFunction(n.dragDrop.onDrop) ? n.dragDrop.onDrop(e, l, p, o, s) : null
                            },
                            _dragLeaveCheck: function (e) {
                                var related = $(e.currentTarget),
                                        insideEls;
                                if (!related.is(n.dragDrop.container)) {
                                    insideEls = n.dragDrop.container.find(related);
                                    if (insideEls.length) {
                                        return false
                                    }
                                }
                                return true
                            }
                        },
                        clipboard: {
                            paste: function (e) {
                                if (!f._assets.isIntoView(o) || !e.originalEvent.clipboardData || !e.originalEvent.clipboardData.items || !e.originalEvent.clipboardData.items.length)
                                    return;
                                var items = e.originalEvent.clipboardData.items;
                                f.clipboard.clean();
                                for (var i = 0; i < items.length; i++) {
                                    if (items[i].type.indexOf("image") !== -1 || items[i].type.indexOf("text/uri-list") !== -1) {
                                        var blob = items[i].getAsFile(),
                                                ms = n.clipboardPaste > 1 ? n.clipboardPaste : 2000;
                                        if (blob) {
                                            blob._name = f._assets.generateFileName(blob.type.indexOf("/") != -1 ? blob.type.split("/")[1].toString().toLowerCase() : 'png', 'Clipboard ');
                                            f.set('feedback', f._assets.textParse(n.captions.paste, {
                                                ms: ms / 1000
                                            }));
                                            f.clipboard._timer = setTimeout(function () {
                                                f.set('feedback', null);
                                                f.onChange(e, [blob])
                                            }, ms - 2)
                                        }
                                    }
                                }
                            },
                            clean: function () {
                                if (f.clipboard._timer) {
                                    clearTimeout(f.clipboard._timer);
                                    delete f.clipboard._timer;
                                    f.set('feedback', null)
                                }
                            }
                        },
                        files: {
                            add: function (file, prop) {
                                var name = file._name || file.name,
                                        size = file.size,
                                        size2 = f._assets.bytesToText(size),
                                        type = file.type,
                                        format = type ? type.split('/', 1).toString().toLowerCase() : '',
                                        extension = name.indexOf('.') != -1 ? name.split('.').pop().toLowerCase() : '',
                                        title = name.substr(0, name.length - (name.indexOf('.') != -1 ? extension.length + 1 : extension.length)),
                                        data = file.data || {},
                                        src = file.file || file,
                                        id = prop == 'updated' ? file.id : Date.now(),
                                        index, item, data = {
                                            name: name,
                                            title: title,
                                            size: size,
                                            size2: size2,
                                            type: type,
                                            format: format,
                                            extension: extension,
                                            data: data,
                                            file: src,
                                            reader: {
                                                read: function (callback, type, force) {
                                                    return f.files.read(item, callback, type, force)
                                                }
                                            },
                                            id: id,
                                            input: prop == 'choosed' ? s : null,
                                            html: null,
                                            choosed: prop == 'choosed',
                                            appended: prop == 'appended' || prop == 'updated',
                                            uploaded: prop == 'uploaded'
                                        };
                                if (!data.data.listProps)
                                    data.data.listProps = {};
                                if (!data.data.url && data.appended)
                                    data.data.url = data.file;
                                if (prop != 'updated' && window.dataStorage) {
                                    f._itFl.push(data);
                                    index = f._itFl.length - 1;
                                    item = f._itFl[index]
                                } else {
                                    index = f._itFl.indexOf(file);
                                    f._itFl[index] = item = data
                                }
                                item.remove = function () {
                                    f.files.remove(item)
                                };
                                if (n.editor && format == 'image')
                                    item.editor = {
                                        rotate: n.editor.rotation !== false ? function (deg) {
                                            f.editor.rotate(item, deg)
                                        } : null,
                                        cropper: n.editor.cropper !== false ? function (data) {
                                            f.editor.crop(item, data)
                                        } : null,
                                        save: function (callback, toBlob, mimeType, preventThumbnailRender) {
                                            f.editor.save(item, toBlob, mimeType, callback, preventThumbnailRender)
                                        }
                                    };
                                if (file.local)
                                    item.local = file.local;
                                return index
                            },
                            read: function (item, callback, type, force, isThumb) {
                                if (f.isFileReaderSupported() && !item.data.readerSkip) {
                                    var reader = new FileReader(),
                                            URL = window.URL || window.webkitURL,
                                            hasThumb = isThumb && item.data.thumbnail,
                                            useFile = typeof item.file != 'string',
                                            execute_callbacks = function () {
                                                var _callbacks = item.reader._callbacks || [];
                                                if (item.reader._timer) {
                                                    clearTimeout(item.reader._timer);
                                                    delete item.reader._timer
                                                }
                                                delete item.reader._callbacks;
                                                delete item.reader._FileReader;
                                                for (var i = 0; i < _callbacks.length; i++) {
                                                    $.isFunction(_callbacks[i]) ? _callbacks[i](item, l, p, o, s) : null
                                                }
                                                n.onFileRead && $.isFunction(n.onFileRead) ? n.onFileRead(item, l, p, o, s) : null
                                            };
                                    if ((!item.reader.src && !item.reader._FileReader) || force)
                                        item.reader = {
                                            _FileReader: reader,
                                            _callbacks: [],
                                            read: item.reader.read
                                        };
                                    if (item.reader.src && !force)
                                        return callback && $.isFunction(callback) ? callback(item, l, p, o, s) : null;
                                    if (callback && item.reader._callbacks) {
                                        item.reader._callbacks.push(callback);
                                        if (item.reader._callbacks.length > 1)
                                            return
                                    }
                                    if (item.format == 'astext') {
                                        reader.onload = function (e) {
                                            var node = document.createElement('div');
                                            item.reader.node = node;
                                            item.reader.src = e.target.result;
                                            item.reader.length = e.target.result.length;
                                            node.innerHTML = item.reader.src.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
                                            execute_callbacks()
                                        };
                                        reader.onerror = function () {
                                            execute_callbacks();
                                            item.reader = {
                                                read: item.reader.read
                                            }
                                        };
                                        if (useFile)
                                            reader.readAsText(item.file);
                                        else
                                            $.ajax({
                                                url: item.file,
                                                success: function (result) {
                                                    reader.onload({
                                                        target: {
                                                            result: result
                                                        }
                                                    })
                                                },
                                                error: function () {
                                                    reader.onerror()
                                                }
                                            })
                                    } else if (item.format == 'image' || hasThumb) {
                                        var src;
                                        reader.onload = function (e) {
                                            var node = new Image(),
                                                    loadNode = function () {
                                                        if (item.data && item.data.readerCrossOrigin)
                                                            node.setAttribute('crossOrigin', item.data.readerCrossOrigin);
                                                        node.src = e.target.result + ((item.data.readerForce || force) && !useFile && !hasThumb && e.target.result.indexOf('data:image') == -1 ? (e.target.result.indexOf('?') == -1 ? '?' : '&') + 'd=' + Date.now() : '');
                                                        node.onload = function () {
                                                            if (item.reader.exifOrientation) {
                                                                var canvas = document.createElement('canvas'),
                                                                        ctx = canvas.getContext('2d'),
                                                                        image = node,
                                                                        rotation = Math.abs(item.reader.exifOrientation),
                                                                        flip = item.reader.exifOrientation < 0 ? item.reader.exifOrientation : 0,
                                                                        rotationCf = [0, 180];
                                                                if (rotation == 1)
                                                                    rotation = 0;
                                                                canvas.width = image.naturalWidth;
                                                                canvas.height = image.naturalHeight;
                                                                ctx.drawImage(image, 0, 0);
                                                                canvas.width = rotationCf.indexOf(rotation) > -1 ? image.naturalWidth : image.naturalHeight;
                                                                canvas.height = rotationCf.indexOf(rotation) > -1 ? image.naturalHeight : image.naturalWidth;
                                                                var angle = rotation * Math.PI / 180,
                                                                        cw = canvas.width * 0.5,
                                                                        ch = canvas.height * 0.5;
                                                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                                                ctx.translate(cw, ch);
                                                                ctx.rotate(angle);
                                                                ctx.translate(-image.naturalWidth * 0.5, -image.naturalHeight * 0.5);
                                                                if (flip) {
                                                                    if ([-1, -180].indexOf(flip) > -1) {
                                                                        ctx.translate(canvas.width, 0);
                                                                        ctx.scale(-1, 1)
                                                                    } else if ([-90, -270].indexOf(flip) > -1) {
                                                                        ctx.translate(0, canvas.width);
                                                                        ctx.scale(1, -1)
                                                                    }
                                                                }
                                                                ctx.drawImage(image, 0, 0);
                                                                ctx.setTransform(1, 0, 0, 1, 0, 0);
                                                                node.src = canvas.toDataURL(item.type, 1);
                                                                delete item.reader.exifOrientation;
                                                                return
                                                            }
                                                            item.reader.node = node;
                                                            item.reader.src = node.src;
                                                            item.reader.width = node.width;
                                                            item.reader.height = node.height;
                                                            item.reader.ratio = f._assets.pxToRatio(item.reader.width, item.reader.height);
                                                            if (src)
                                                                URL.revokeObjectURL(src);
                                                            execute_callbacks();
                                                            if (hasThumb)
                                                                item.reader = {
                                                                    read: item.reader.read
                                                                }
                                                        };
                                                        node.onerror = function () {
                                                            execute_callbacks();
                                                            item.reader = {
                                                                read: item.reader.read
                                                            }
                                                        }
                                                    };
                                            if (n.thumbnails.exif && item.choosed) {
                                                f._assets.getExifOrientation(item.file, function (orientation) {
                                                    if (orientation) {
                                                        var device = f._assets.getDevice.init();
                                                        if (device.browser.name == 'Chrome' && device.browser.version >= 81) {
                                                            delete item.reader.exifOrientation
                                                        } else if (device.browser.name == 'Safari' && device.os.version >= 13.4) {
                                                            delete item.reader.exifOrientation
                                                        } else {
                                                            item.reader.exifOrientation = orientation
                                                        }
                                                    }
                                                    loadNode()
                                                })
                                            } else {
                                                loadNode()
                                            }
                                        };
                                        reader.onerror = function () {
                                            execute_callbacks();
                                            item.reader = {
                                                read: item.reader.read
                                            }
                                        };
                                        if (!hasThumb && item.size > f._assets.toBytes(n.reader.maxSize))
                                            return reader.onerror();
                                        if (useFile) {
                                            if (n.thumbnails.useObjectUrl && n.thumbnails.canvasImage && URL)
                                                reader.onload({
                                                    target: {
                                                        result: src = URL.createObjectURL(item.file)
                                                    }
                                                });
                                            else
                                                reader.readAsDataURL(item.file)
                                        } else {
                                            reader.onload({
                                                target: {
                                                    result: (hasThumb ? item.data.thumbnail : item.file)
                                                }
                                            })
                                        }
                                    } else if (item.format == 'video' || item.format == 'audio') {
                                        var node = document.createElement(item.format),
                                                canPlay = node.canPlayType(item.type),
                                                src;
                                        reader.onerror = function () {
                                            item.reader.node = null;
                                            execute_callbacks();
                                            item.reader = {
                                                read: item.reader.read
                                            }
                                        };
                                        if (URL && canPlay !== '') {
                                            if (isThumb && !n.thumbnails.videoThumbnail) {
                                                item.reader.node = node;
                                                execute_callbacks();
                                                item.reader = {
                                                    read: item.reader.read
                                                };
                                                return
                                            }
                                            src = useFile ? URL.createObjectURL(item.file) : item.file;
                                            node.onloadedmetadata = function () {
                                                item.reader.node = node;
                                                item.reader.src = node.src;
                                                item.reader.duration = node.duration;
                                                item.reader.duration2 = f._assets.secondsToText(node.duration);
                                                if (item.format == 'video') {
                                                    item.reader.width = node.videoWidth;
                                                    item.reader.height = node.videoHeight;
                                                    item.reader.ratio = f._assets.pxToRatio(item.reader.width, item.reader.height)
                                                }
                                            };
                                            node.onerror = function () {
                                                execute_callbacks();
                                                item.reader = {
                                                    read: item.reader.read
                                                }
                                            };
                                            node.onloadeddata = function () {
                                                if (item.format == 'video') {
                                                    setTimeout(function () {
                                                        var canvas = document.createElement('canvas'),
                                                                context = canvas.getContext('2d');
                                                        canvas.width = node.videoWidth;
                                                        canvas.height = node.videoHeight;
                                                        context.drawImage(node, 0, 0, canvas.width, canvas.height);
                                                        item.reader.frame = !f._assets.isBlankCanvas(canvas) ? canvas.toDataURL() : null;
                                                        canvas = context = null;
                                                        execute_callbacks()
                                                    }, 300)
                                                } else {
                                                    execute_callbacks()
                                                }
                                            };
                                            setTimeout(function () {
                                                if (item.data && item.data.readerCrossOrigin)
                                                    node.setAttribute('crossOrigin', item.data.readerCrossOrigin);
                                                node.src = src + '#t=1'
                                            }, 100)
                                        } else {
                                            reader.onerror()
                                        }
                                    } else if (item.type == 'application/pdf' && n.thumbnails.pdf && !type) {
                                        var node = document.createElement('iframe'),
                                                src = useFile ? URL.createObjectURL(item.file) : item.file;
                                        if (n.thumbnails.pdf.viewer || f._assets.hasPlugin('pdf')) {
                                            node.src = (n.thumbnails.pdf.viewer || '') + src;
                                            item.reader.node = node;
                                            item.reader.src = src;
                                            execute_callbacks()
                                        } else {
                                            execute_callbacks()
                                        }
                                    } else {
                                        reader.onload = function (e) {
                                            item.reader.src = e.target.result;
                                            item.reader.length = e.target.result.length;
                                            execute_callbacks()
                                        };
                                        reader.onerror = function (e) {
                                            execute_callbacks();
                                            item.reader = {
                                                read: item.reader.read
                                            }
                                        };
                                        useFile ? reader[type || 'readAsBinaryString'](item.file) : execute_callbacks()
                                    }
                                    item.reader._timer = setTimeout(reader.onerror, isThumb ? n.reader.thumbnailTimeout : n.reader.timeout)
                                } else {
                                    if (callback)
                                        callback(item, l, p, o, s)
                                }
                                return null
                            },
                            list: function (toJson, customKey, triggered, additional) {
                                var files = [];
                                if (n.sorter && !triggered && (!additional || additional != 'ignoreSorter'))
                                    f.sorter.save(true);
                                $.each(f._itFl, function (i, a) {
                                    var file = a;
                                    if (file.upload && !file.uploaded)
                                        return true;
                                    if (customKey || toJson)
                                        file = (file.choosed && !file.uploaded ? '0:/' : '') + (customKey && f.files.getItemAttr(a, customKey) !== null ? f.files.getItemAttr(file, customKey) : (file.local || file[typeof file.file == "string" ? "file" : "name"]));
                                    if (toJson) {
                                        file = {
                                            file: file
                                        };
                                        if (a.editor && (a.editor.crop || a.editor.rotation)) {
                                            file.editor = {};
                                            if (a.editor.rotation)
                                                file.editor.rotation = a.editor.rotation;
                                            if (a.editor.crop)
                                                file.editor.crop = a.editor.crop
                                        }
                                        if (typeof a.index !== 'undefined') {
                                            file.index = a.index
                                        }
                                        if (a.data && a.data.listProps) {
                                            for (var key in a.data.listProps) {
                                                file[key] = a.data.listProps[key]
                                            }
                                        }
                                    }
                                    files.push(file)
                                });
                                files = n.onListInput && $.isFunction(n.onListInput) ? n.onListInput(files, f._itFl, n.listInput, l, p, o, s) : files;
                                return !toJson ? files : JSON.stringify(files)
                            },
                            check: function (item, files, fullCheck) {
                                var r = ["warning", null, false, false];
                                if (n.limit != null && fullCheck && files.length + f._itFl.length - 1 > n.limit) {
                                    r[1] = f._assets.textParse(n.captions.errors.filesLimit);
                                    r[3] = true;
                                    return r
                                }
                                if (n.maxSize != null && fullCheck) {
                                    var g = 0;
                                    $.each(f._itFl, function (i, a) {
                                        g += a.size
                                    });
                                    g -= item.size;
                                    $.each(files, function (i, a) {
                                        g += a.size
                                    });
                                    if (g > f._assets.toBytes(n.maxSize)) {
                                        r[1] = f._assets.textParse(n.captions.errors.filesSizeAll);
                                        r[3] = true;
                                        return r
                                    }
                                }
                                if (n.onFilesCheck != null && $.isFunction(n.onFilesCheck) && fullCheck) {
                                    var onFilesCheck = n.onFilesCheck(files, n, l, p, o, s);
                                    if (onFilesCheck === false) {
                                        r[3] = true;
                                        return r
                                    }
                                }
                                if (n.extensions != null && $.inArray(item.extension, n.extensions) == -1 && !n.extensions.filter(function (val) {
                                    return item.type.length && (val.indexOf(item.type) > -1 || val.indexOf(item.format + '/*') > -1)
                                }).length) {
                                    r[1] = f._assets.textParse(n.captions.errors.filesType, item);
                                    return r
                                }
                                if (n.disallowedExtensions != null && ($.inArray(item.extension, n.disallowedExtensions) > -1 || n.disallowedExtensions.filter(function (val) {
                                    return !item.type.length || val.indexOf(item.type) > -1 || val.indexOf(item.format + '/*') > -1
                                }).length)) {
                                    r[1] = f._assets.textParse(n.captions.errors.filesType, item);
                                    return r
                                }
                                if (n.fileMaxSize != null && item.size > f._assets.toBytes(n.fileMaxSize)) {
                                    r[1] = f._assets.textParse(n.captions.errors.fileSize, item);
                                    return r
                                }
                                if (item.size == 0 && item.type == "") {
                                    r[1] = f._assets.textParse(n.captions.errors.remoteFile, item);
                                    return r
                                }
                                if ((item.size == 4096 || item.size == 64) && item.type == "") {
                                    r[1] = f._assets.textParse(n.captions.errors.folderUpload, item);
                                    return r
                                }
                                if (!n.skipFileNameCheck) {
                                    var g = false;
                                    $.each(f._itFl, function (i, a) {
                                        if (a != item && a.choosed == true && a.file && a.name == item.name) {
                                            g = true;
                                            if (a.file.size == item.size && a.file.type == item.type && (item.file.lastModified && a.file.lastModified ? a.file.lastModified == item.file.lastModified : true) && files.length > 1) {
                                                r[2] = true
                                            } else {
                                                r[1] = f._assets.textParse(n.captions.errors.fileName, item);
                                                r[2] = false
                                            }
                                            return false
                                        }
                                    });
                                    if (g) {
                                        return r
                                    }
                                }
                                return true
                            },
                            append: function (files) {
                                files = $.isArray(files) ? files : [files];
                                if (files.length) {
                                    var item;
                                    for (var i = 0; i < files.length; i++) {
                                        if (!f._assets.keyCompare(files[i], ['name', 'file', 'size', 'type'])) {
                                            continue
                                        }
                                        item = f._itFl[f.files.add(files[i], 'appended')];
                                        n.thumbnails ? f.thumbnails.item(item) : null
                                    }
                                    f.set('feedback', null);
                                    f.set('listInput', null);
                                    n.afterSelect && $.isFunction(n.afterSelect) ? n.afterSelect(l, p, o, s) : null;
                                    return files.length == 1 ? item : true
                                }
                            },
                            update: function (item, data) {
                                if (f._itFl.indexOf(item) == -1 || (item.upload && item.upload.$ajax))
                                    return;
                                var oldItem = item,
                                        index = f.files.add($.extend(item, data), 'updated'),
                                        item = f._itFl[index];
                                if (item.popup && item.popup.close)
                                    item.popup.close();
                                if (n.thumbnails && oldItem.html)
                                    f.thumbnails.item(item, oldItem.html);
                                f.set('listInput', null)
                            },
                            find: function (html) {
                                var item = null;
                                $.each(f._itFl, function (i, a) {
                                    if (a.html && a.html.is(html)) {
                                        item = a;
                                        return false
                                    }
                                });
                                return item
                            },
                            remove: function (item, isFromCheck) {
                                if (!isFromCheck && n.onRemove && $.isFunction(n.onRemove) && n.onRemove(item, l, p, o, s) === false)
                                    return;
                                if (item.html)
                                    n.thumbnails.onItemRemove && $.isFunction(n.thumbnails.onItemRemove) && !isFromCheck ? n.thumbnails.onItemRemove(item.html, l, p, o, s) : item.html.remove();
                                if (item.upload && item.upload.$ajax && item.upload.cancel)
                                    item.upload.cancel(true);
                                if (item.popup && item.popup.close) {
                                    item.popup.node = null;
                                    item.popup.close()
                                }
                                if (item.reader.src) {
                                    item.reader.node = null;
                                    URL.revokeObjectURL(item.reader.src)
                                }
                                if (item.input) {
                                    var g = true;
                                    $.each(f._itFl, function (i, a) {
                                        if (item != a && (item.input == a.input || (isFromCheck && item.input.get(0).files.length > 1))) {
                                            g = false;
                                            return false
                                        }
                                    });
                                    if (g) {
                                        if (f.isAddMoreMode() && sl.length > 1) {
                                            f.set('nextInput');
                                            sl.splice(sl.indexOf(item.input), 1);
                                            item.input.remove()
                                        } else {
                                            f.set('input', '')
                                        }
                                    }
                                }
                                f._pfrL.indexOf(item) > -1 ? f._pfrL.splice(f._pfrL.indexOf(item), 1) : null;
                                f._pfuL.indexOf(item) > -1 ? f._pfuL.splice(f._pfuL.indexOf(item), 1) : null;
                                f._itFl.indexOf(item) > -1 ? f._itFl.splice(f._itFl.indexOf(item), 1) : null;
                                item = null;
                                f._itFl.length == 0 ? f.reset() : null;
                                f.set('feedback', null);
                                f.set('listInput', null)
                            },
                            getItemAttr: function (item, attr) {
                                var result = null;
                                if (item) {
                                    if (typeof item[attr] != "undefined") {
                                        result = item[attr]
                                    } else if (item.data && typeof item.data[attr] != "undefined") {
                                        result = item.data[attr]
                                    }
                                }
                                return result
                            },
                            clear: function (all) {
                                var i = 0;
                                while (i < f._itFl.length) {
                                    var a = f._itFl[i];
                                    if (!all && a.appended) {
                                        i++;
                                        continue
                                    }
                                    if (a.html)
                                        a.html ? f._itFl[i].html.remove() : null;
                                    if (a.upload && a.upload.$ajax)
                                        f.upload.cancel(a);
                                    f._itFl.splice(i, 1)
                                }
                                f.set('feedback', null);
                                f.set('listInput', null);
                                f._itFl.length == 0 && n.onEmpty && $.isFunction(n.onEmpty) ? n.onEmpty(l, p, o, s) : null
                            }
                        },
                        reset: function (all) {
                            if (all) {
                                if (f.clipboard._timer)
                                    f.clipboard.clean();
                                $.each(sl, function (i, a) {
                                    if (!a.is(s))
                                        a.remove()
                                });
                                sl = [];
                                f.set('input', '')
                            }
                            f._itRl = [];
                            f._pfuL = [];
                            f._pfrL = [];
                            f.files.clear(all)
                        },
                        destroy: function () {
                            f.reset(true);
                            f.bindUnbindEvents(false);
                            s.closest('form').off('reset', f.reset);
                            s.removeAttr('style');
                            p.before(s);
                            delete s.get(0).FileUploader;
                            p.remove();
                            p = o = l = null
                        },
                        _assets: {
                            toBytes: function (mb) {
                                return parseInt(mb) * 1048576
                            },
                            bytesToText: function (bytes) {
                                if (bytes == 0)
                                    return '0 Byte';
                                var k = 1024,
                                        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                                        i = Math.floor(Math.log(bytes) / Math.log(k)),
                                        r = bytes / Math.pow(k, i),
                                        t = false;
                                if (r > 1000 && i < 8) {
                                    i = i + 1;
                                    r = bytes / Math.pow(k, i);
                                    t = true
                                }
                                return r.toPrecision(t ? 2 : 3) + ' ' + sizes[i]
                            },
                            escape: function (str) {
                                return ('' + str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;")
                            },
                            secondsToText: function (seconds, textFormat) {
                                seconds = parseInt(Math.round(seconds), 10);
                                var hours = Math.floor(seconds / 3600),
                                        minutes = Math.floor((seconds - (hours * 3600)) / 60),
                                        seconds = seconds - (hours * 3600) - (minutes * 60),
                                        result = "";
                                if (hours > 0 || !textFormat) {
                                    result += (hours < 10 ? "0" : "") + hours + (textFormat ? "h " : ":")
                                }
                                if (minutes > 0 || !textFormat) {
                                    result += (minutes < 10 && !textFormat ? "0" : "") + minutes + (textFormat ? "m " : ":")
                                }
                                result += (seconds < 10 && !textFormat ? "0" : "") + seconds + (textFormat ? "s" : "");
                                return result
                            },
                            pxToRatio: function (width, height) {
                                var gcd = function (a, b) {
                                    return (b == 0) ? a : gcd(b, a % b)
                                },
                                        r = gcd(width, height);
                                return [width / r, height / r]
                            },
                            ratioToPx: function (width, height, ratio) {
                                ratio = (ratio + '').split(':');
                                if (ratio.length < 2)
                                    return null;
                                var rWidth = height / ratio[1] * ratio[0],
                                        rHeight = width / ratio[0] * ratio[1];
                                return [rWidth, rHeight, ratio[0], ratio[1]]
                            },
                            hasAttr: function (attr, el) {
                                var el = !el ? s : el,
                                        a = el.attr(attr);
                                if (!a || typeof a == 'undefined') {
                                    return false
                                } else {
                                    return true
                                }
                            },
                            copyAllAttributes: function (newEl, oldEl) {
                                $.each(oldEl.get(0).attributes, function () {
                                    if (this.name == 'required' || this.name == 'type' || this.name == 'id')
                                        return;
                                    newEl.attr(this.name, this.value)
                                });
                                if (oldEl.get(0).FileUploader)
                                    newEl.get(0).FileUploader = oldEl.get(0).FileUploader;
                                return newEl
                            },
                            isIntoView: function (el) {
                                var windowTop = $(window).scrollTop(),
                                        windowBottom = windowTop + window.innerHeight,
                                        elTop = el.offset().top,
                                        elBottom = elTop + el.outerHeight();
                                return ((windowTop < elTop) && (windowBottom > elBottom))
                            },
                            isBlankCanvas: function (canvas) {
                                var blank = document.createElement('canvas'),
                                        result = false;
                                blank.width = canvas.width;
                                blank.height = canvas.height;
                                try {
                                    result = canvas.toDataURL() == blank.toDataURL()
                                } catch (e) {
                                }
                                blank = null;
                                return result
                            },
                            generateFileName: function (extension, prefix) {
                                var date = new Date(),
                                        addZero = function (x) {
                                            if (x < 10)
                                                x = "0" + x;
                                            return x
                                        },
                                        prefix = prefix ? prefix : '',
                                        extension = extension ? '.' + extension : '';
                                return prefix + date.getFullYear() + '-' + addZero(date.getMonth() + 1) + '-' + addZero(date.getDate()) + ' ' + addZero(date.getHours()) + '-' + addZero(date.getMinutes()) + '-' + addZero(date.getSeconds()) + extension
                            },
                            arrayBufferToBase64: function (buffer) {
                                var binary = '',
                                        bytes = new Uint8Array(buffer);
                                for (var i = 0; i < bytes.byteLength; i++) {
                                    binary += String.fromCharCode(bytes[i])
                                }
                                return window.btoa(binary)
                            },
                            dataURItoBlob: function (dataURI, type) {
                                var byteString = atob(dataURI.split(',')[1]),
                                        mimeType = dataURI.split(',')[0].split(':')[1].split(';')[0],
                                        arrayBuffer = new ArrayBuffer(byteString.length),
                                        _ia = new Uint8Array(arrayBuffer);
                                for (var i = 0; i < byteString.length; i++) {
                                    _ia[i] = byteString.charCodeAt(i)
                                }
                                var dataView = new DataView(arrayBuffer),
                                        blob = new Blob([dataView.buffer], {
                                            type: type || mimeType
                                        });
                                return blob
                            },
                            getExifOrientation: function (file, callback) {
                                var reader = new FileReader(),
                                        rotation = {
                                            1: 0,
                                            2: -1,
                                            3: 180,
                                            4: -180,
                                            5: -90,
                                            6: 90,
                                            7: -270,
                                            8: 270
                                        };
                                reader.onload = function (e) {
                                    var scanner = new DataView(e.target.result),
                                            val = 1;
                                    if (scanner.byteLength && scanner.getUint16(0, false) == 0xFFD8) {
                                        var length = scanner.byteLength,
                                                offset = 2;
                                        while (offset < length) {
                                            if (scanner.getUint16(offset + 2, false) <= 8)
                                                break;
                                            var uint16 = scanner.getUint16(offset, false);
                                            offset += 2;
                                            if (uint16 == 0xFFE1) {
                                                if (scanner.getUint32(offset += 2, false) != 0x45786966)
                                                    break;
                                                var little = scanner.getUint16(offset += 6, false) == 0x4949,
                                                        tags;
                                                offset += scanner.getUint32(offset + 4, little);
                                                tags = scanner.getUint16(offset, little);
                                                offset += 2;
                                                for (var i = 0; i < tags; i++) {
                                                    if (scanner.getUint16(offset + (i * 12), little) == 0x0112) {
                                                        val = scanner.getUint16(offset + (i * 12) + 8, little);
                                                        length = 0;
                                                        break
                                                    }
                                                }
                                            } else if ((uint16 & 0xFF00) != 0xFF00) {
                                                break
                                            } else {
                                                offset += scanner.getUint16(offset, false)
                                            }
                                        }
                                    }
                                    callback ? callback(rotation[val] || 0) : null
                                };
                                reader.onerror = function () {
                                    callback ? callback('') : null
                                };
                                reader.readAsArrayBuffer(file)
                            },
                            textParse: function (text, opts, noOptions) {
                                opts = noOptions ? (opts || {}) : $.extend({}, {
                                    limit: n.limit,
                                    maxSize: n.maxSize,
                                    fileMaxSize: n.fileMaxSize,
                                    extensions: n.extensions ? n.extensions.join(', ') : null,
                                    captions: n.captions
                                }, opts);
                                switch (typeof (text)) {
                                    case 'string':
                                        for (var key in opts) {
                                            if (['name', 'file', 'type', 'size'].indexOf(key) > -1)
                                                opts[key] = f._assets.escape(opts[key])
                                        }
                                        text = text.replace(/\$\{(.*?)\}/g, function (match, a) {
                                            var a = a.replace(/ /g, ''),
                                                    r = typeof opts[a] != "undefined" && opts[a] != null ? opts[a] : '';
                                            if (['reader.node'].indexOf(a) > -1)
                                                return match;
                                            if (a.indexOf('.') > -1 || a.indexOf('[]') > -1) {
                                                var x = a.substr(0, a.indexOf('.') > -1 ? a.indexOf('.') : a.indexOf('[') > -1 ? a.indexOf('[') : a.length),
                                                        y = a.substring(x.length);
                                                if (opts[x]) {
                                                    try {
                                                        r = eval('opts["' + x + '"]' + y)
                                                    } catch (e) {
                                                        r = ''
                                                    }
                                                }
                                            }
                                            r = $.isFunction(r) ? f._assets.textParse(r) : r;
                                            return r || ''
                                        });
                                        break;
                                    case 'function':
                                        text = f._assets.textParse(text(opts, l, p, o, s, f._assets.textParse), opts, noOptions);
                                        break
                                }
                                opts = null;
                                return text
                            },
                            textToColor: function (str) {
                                if (!str || str.length == 0)
                                    return false;
                                for (var i = 0, hash = 0; i < str.length; hash = str.charCodeAt(i++) + ((hash << 5) - hash))
                                    ;
                                for (var i = 0, colour = '#'; i < 3; colour += ('00' + ((hash >> i++ * 2) & 0xFF).toString(16)).slice( - 2))
                                    ;
                                return colour
                            },
                            isBrightColor: function (color) {
                                var getRGB = function (b) {
                                    var a;
                                    if (b && b.constructor == Array && b.length == 3)
                                        return b;
                                    if (a = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(b))
                                        return [parseInt(a[1]), parseInt(a[2]), parseInt(a[3])];
                                    if (a = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(b))
                                        return [parseFloat(a[1]) * 2.55, parseFloat(a[2]) * 2.55, parseFloat(a[3]) * 2.55];
                                    if (a = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(b))
                                        return [parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)];
                                    if (a = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(b))
                                        return [parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)];
                                    return (typeof (colors) != "undefined") ? colors[$.trim(b).toLowerCase()] : null
                                },
                                        luminance_get = function (color) {
                                            var rgb = getRGB(color);
                                            if (!rgb)
                                                return null;
                                            return 0.2126 * rgb[0] + 0.7152 * rgb[1] + 0.0722 * rgb[2]
                                        };
                                return luminance_get(color) > 194
                            },
                            keyCompare: function (obj, structure) {
                                for (var i = 0; i < structure.length; i++) {
                                    if (!$.isPlainObject(obj) || !obj.hasOwnProperty(structure[i])) {
                                        throw new Error('Could not find valid *strict* attribute "' + structure[i] + '" in ' + JSON.stringify(obj, null, 4))
                                    }
                                }
                                return true
                            },
                            dialogs: {
                                alert: n.dialogs.alert,
                                confirm: n.dialogs.confirm
                            },
                            hasPlugin: function (name) {
                                if (navigator.plugins && navigator.plugins.length)
                                    for (var key in navigator.plugins) {
                                        if (navigator.plugins[key].name && navigator.plugins[key].name.toLowerCase().indexOf(name) > -1)
                                            return true
                                    }
                                return false
                            },
                            isIE: function () {
                                return navigator.userAgent.indexOf("MSIE ") > -1 || navigator.userAgent.indexOf("Trident/") > -1 || navigator.userAgent.indexOf("Edge") > -1
                            },
                            isMobile: function () {
                                return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1)
                            },
                            getDevice: {
                                options: [],
                                header: [navigator.platform, navigator.userAgent, navigator.appVersion, navigator.vendor, window.opera],
                                dataos: [{
                                        name: 'Windows Phone',
                                        value: 'Windows Phone',
                                        version: 'OS'
                                    }, {
                                        name: 'Windows',
                                        value: 'Win',
                                        version: 'NT'
                                    }, {
                                        name: 'iPhone',
                                        value: 'iPhone',
                                        version: 'OS'
                                    }, {
                                        name: 'iPad',
                                        value: 'iPad',
                                        version: 'OS'
                                    }, {
                                        name: 'Kindle',
                                        value: 'Silk',
                                        version: 'Silk'
                                    }, {
                                        name: 'Android',
                                        value: 'Android',
                                        version: 'Android'
                                    }, {
                                        name: 'PlayBook',
                                        value: 'PlayBook',
                                        version: 'OS'
                                    }, {
                                        name: 'BlackBerry',
                                        value: 'BlackBerry',
                                        version: '/'
                                    }, {
                                        name: 'Macintosh',
                                        value: 'Mac',
                                        version: 'OS X'
                                    }, {
                                        name: 'Linux',
                                        value: 'Linux',
                                        version: 'rv'
                                    }, {
                                        name: 'Palm',
                                        value: 'Palm',
                                        version: 'PalmOS'
                                    }],
                                databrowser: [{
                                        name: 'Chrome',
                                        value: 'Chrome',
                                        version: 'Chrome'
                                    }, {
                                        name: 'Firefox',
                                        value: 'Firefox',
                                        version: 'Firefox'
                                    }, {
                                        name: 'Safari',
                                        value: 'Safari',
                                        version: 'Version'
                                    }, {
                                        name: 'Internet Explorer',
                                        value: 'MSIE',
                                        version: 'MSIE'
                                    }, {
                                        name: 'Opera',
                                        value: 'Opera',
                                        version: 'Opera'
                                    }, {
                                        name: 'BlackBerry',
                                        value: 'CLDC',
                                        version: 'CLDC'
                                    }, {
                                        name: 'Mozilla',
                                        value: 'Mozilla',
                                        version: 'Mozilla'
                                    }],
                                init: function () {
                                    var agent = this.header.join(' '),
                                            os = this.matchItem(agent, this.dataos),
                                            browser = this.matchItem(agent, this.databrowser);
                                    return {
                                        os: os,
                                        browser: browser
                                    }
                                },
                                matchItem: function (string, data) {
                                    var i = 0,
                                            j = 0,
                                            html = '',
                                            regex, regexv, match, matches, version;
                                    for (i = 0; i < data.length; i += 1) {
                                        regex = new RegExp(data[i].value, 'i');
                                        match = regex.test(string);
                                        if (match) {
                                            regexv = new RegExp(data[i].version + '[- /:;]([\\d._]+)', 'i');
                                            matches = string.match(regexv);
                                            version = '';
                                            if (matches) {
                                                if (matches[1]) {
                                                    matches = matches[1]
                                                }
                                            }
                                            if (matches) {
                                                matches = matches.split(/[._]+/);
                                                for (j = 0; j < matches.length; j += 1) {
                                                    if (j === 0) {
                                                        version += matches[j] + '.'
                                                    } else {
                                                        version += matches[j]
                                                    }
                                                }
                                            } else {
                                                version = '0'
                                            }
                                            return {
                                                name: data[i].name,
                                                version: parseFloat(version)
                                            }
                                        }
                                    }
                                    return {
                                        name: 'unknown',
                                        version: 0
                                    }
                                }
                            }
                        },
                        isSupported: function () {
                            return s && s.get(0).files
                        },
                        isFileReaderSupported: function () {
                            return window.File && window.FileList && window.FileReader
                        },
                        isDefaultMode: function () {
                            return !n.upload && (!n.addMore || n.limit == 1)
                        },
                        isAddMoreMode: function () {
                            return !n.upload && n.addMore && n.limit != 1
                        },
                        isUploadMode: function () {
                            return n.upload
                        },
                        _itFl: [],
                        _pfuL: [],
                        _pfrL: [],
                        disabled: false,
                        locked: false,
                        rendered: false
                    };
            if (n.enableApi) {
                s.get(0).FileUploader = {
                    open: function () {
                        s.trigger('click')
                    },
                    getOptions: function () {
                        return n
                    },
                    getParentEl: function () {
                        return p
                    },
                    getInputEl: function () {
                        return s
                    },
                    getNewInputEl: function () {
                        return o
                    },
                    getListEl: function () {
                        return l
                    },
                    getListInputEl: function () {
                        return n.listInput
                    },
                    getFiles: function () {
                        return f._itFl
                    },
                    getChoosedFiles: function () {
                        return f._itFl.filter(function (a) {
                            return a.choosed
                        })
                    },
                    getAppendedFiles: function () {
                        return f._itFl.filter(function (a) {
                            return a.appended
                        })
                    },
                    getUploadedFiles: function () {
                        return f._itFl.filter(function (a) {
                            return a.uploaded
                        })
                    },
                    getFileList: function (toJson, customKey) {
                        return f.files.list(toJson, customKey, true)
                    },
                    updateFileList: function () {
                        f.set('listInput', null);
                        return true
                    },
                    setOption: function (option, value) {
                        n[option] = value;
                        return true
                    },
                    findFile: function (html) {
                        return f.files.find(html)
                    },
                    add: function (data, type, name) {
                        if (!f.isUploadMode())
                            return false;
                        var blob;
                        if (data instanceof Blob) {
                            blob = data
                        } else {
                            var dataURI = /data:[a-z]+\/[a-z]+\;base64\,/.test(data) ? data : 'data:' + type + ';base64,' + btoa(data);
                            blob = f._assets.dataURItoBlob(dataURI, type)
                        }
                        blob._name = name || f._assets.generateFileName(blob.type.indexOf("/") != -1 ? blob.type.split("/")[1].toString().toLowerCase() : 'File ');
                        f.onChange(null, [blob]);
                        return true
                    },
                    append: function (files) {
                        return f.files.append(files)
                    },
                    update: function (item, data) {
                        return f.files.update(item, data)
                    },
                    remove: function (item) {
                        item = item.jquery ? f.files.find(item) : item;
                        if (f._itFl.indexOf(item) > -1) {
                            f.files.remove(item);
                            return true
                        }
                        return false
                    },
                    uploadStart: function () {
                        var choosedFiles = this.getChoosedFiles() || [];
                        if (f.isUploadMode() && choosedFiles.length > 0 && !choosedFiles[0].uploaded) {
                            for (var i = 0; i < choosedFiles.length; i++) {
                                f.upload.send(choosedFiles[i])
                            }
                        }
                    },
                    reset: function () {
                        f.reset(true);
                        return true
                    },
                    disable: function (lock) {
                        f.set('disabled', true);
                        if (lock)
                            f.locked = true;
                        return true
                    },
                    enable: function () {
                        f.set('disabled', false);
                        f.locked = false;
                        return true
                    },
                    destroy: function () {
                        f.destroy();
                        return true
                    },
                    isEmpty: function () {
                        return f._itFl.length == 0
                    },
                    isDisabled: function () {
                        return f.disabled
                    },
                    isRendered: function () {
                        return f.rendered
                    },
                    assets: f._assets,
                    getPluginMode: function () {
                        if (f.isDefaultMode())
                            return 'default';
                        if (f.isAddMoreMode())
                            return 'addMore';
                        if (f.isUploadMode())
                            return 'upload'
                    }
                }
            }
            f.init();
            return this
        })
    };
    $.fileuploader = {
        getInstance: function (input) {
            var $input = input.prop ? input : $(input);
            return $input.length ? $input.get(0).FileUploader : null
        }
    };
    $.fn.fileuploader.languages = {
        cz: {
            button: function (options) {
                return 'ProchÃ¡zet ' + (options.limit == 1 ? 'soubor' : 'soubory')
            },
            feedback: function (options) {
                return 'Vyberte ' + (options.limit == 1 ? 'soubor' : 'soubory') + ', kterÃ½ chcete nahrÃ¡t'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'vybrÃ¡no souborÅ¯' : 'vybrÃ¡n soubor')
            },
            confirm: 'Potvrdit',
            cancel: 'ZruÅ¡eni',
            name: 'JmÃ©no',
            type: 'Format',
            size: 'Velikost',
            dimensions: 'RozmÄ›ry',
            duration: 'TrvÃ¡nÃ­',
            crop: 'OÅ™Ã­znout',
            rotate: 'OtoÄ�it',
            sort: 'RoztÅ™Ã­dit',
            open: 'OtevÅ™Ã­t',
            download: 'StÃ¡hnout',
            remove: 'Odstranit',
            drop: 'Pro nahrÃ¡nÃ­ pÅ™etahnÄ›te soubor sem',
            paste: '<div class="fileuploader-pending-loader"></div> VklÃ¡dÃ¡nÃ­ souboru, kliknÄ›te zde pro zruÅ¡eni',
            removeConfirmation: 'Jste si jisti, Å¾e chcete odstranit tento soubor?',
            errors: {
                filesLimit: function (options) {
                    return 'Pouze ${limit} ' + (options.limit == 1 ? 'soubor mÅ¯Å¾e bÃ½t nahrÃ¡n' : 'soubory mohou byt nahranÃ©') + '.'
                },
                filesType: 'Pouze ${extensions} soubory mohou byt nahranÃ©.',
                fileSize: '${name} pÅ™Ã­liÅ¡ velkÃ½! ProsÃ­m, vyberte soubor do velikosti ${fileMaxSize} MB.',
                filesSizeAll: 'VybranÃ½ soubor je pÅ™Ã­liÅ¡ velkÃ½! ProsÃ­m, vyberte soubor do velikosti ${maxSize} MB.',
                fileName: 'Soubor s tÃ­mto nÃ¡zvem  ${name} byl uÅ¾ vybran.',
                remoteFile: 'VzdÃ¡lenÃ© soubory nejsou povoleny.',
                folderUpload: 'SloÅ¾ky nejsou povolenÃ©.',
            }
        },
        de: {
            button: function (options) {
                return (options.limit == 1 ? 'Datei' : 'Dateien') + ' durchsuchen'
            },
            feedback: function (options) {
                return (options.limit == 1 ? 'Datei' : 'Dateien') + ' zum Hochladen auswÃ¤hlen'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length == 1 ? 'Datei' : 'Dateien') + ' ausgewÃ¤hlt'
            },
            confirm: 'Speichern',
            cancel: 'SchlieÃŸen',
            name: 'Name',
            type: 'Typ',
            size: 'GrÃ¶ÃŸe',
            dimensions: 'Format',
            duration: 'LÃ¤nge',
            crop: 'Crop',
            rotate: 'Rotieren',
            sort: 'Sortieren',
            open: 'Ã–ffnen',
            download: 'Herunterladen',
            remove: 'LÃ¶schen',
            drop: 'Die Dateien hierher ziehen, um sie hochzuladen',
            paste: '<div class="fileuploader-pending-loader"></div> Eine Datei wird eingefÃ¼gt. Klicken Sie hier zum abzubrechen',
            removeConfirmation: 'MÃ¶chten Sie diese Datei wirklich lÃ¶schen?',
            errors: {
                filesLimit: function (options) {
                    return 'Nur ${limit} ' + (options.limit == 1 ? 'Datei darf' : 'Dateien dÃ¼rfen') + ' hochgeladen werden.'
                },
                filesType: 'Nur ${extensions} Dateien dÃ¼rfen hochgeladen werden.',
                fileSize: '${name} ist zu groÃŸ! Bitte wÃ¤hlen Sie eine Datei bis zu ${fileMaxSize} MB.',
                filesSizeAll: 'Die ausgewÃ¤hlten Dateien sind zu groÃŸ! Bitte wÃ¤hlen Sie Dateien bis zu ${maxSize} MB.',
                fileName: 'Eine Datei mit demselben Namen ${name} ist bereits ausgewÃ¤hlt.',
                remoteFile: 'Remote-Dateien sind nicht zulÃ¤ssig.',
                folderUpload: 'Ordner sind nicht erlaubt.',
            }
        },
        dk: {
            button: function (options) {
                return 'Gennemse ' + (options.limit == 1 ? 'fil' : 'filer')
            },
            feedback: function (options) {
                return 'VÃ¦lg ' + (options.limit == 1 ? 'fil' : 'filer') + ' til upload'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length == 1 ? 'fil' : 'filer') + ' er valgt'
            },
            confirm: 'BekrÃ¦ft',
            cancel: 'Fortrydl',
            name: 'Navn',
            type: 'Type',
            size: 'StÃ¸rrelse',
            dimensions: 'Dimensioner',
            duration: 'Varighedâ€™',
            crop: 'Tilpas',
            rotate: 'RotÃ©r',
            sort: 'Sorter',
            open: 'Ã…ben',
            download: 'Hent',
            remove: 'Slet',
            drop: 'Drop filer her til upload',
            paste: 'OverfÃ¸r fil, klik her for at afbryde',
            removeConfirmation: 'Er du sikker pÃ¥, du Ã¸nsker at slette denne fil?',
            errors: {
                filesLimit: function (options) {
                    return 'Du kan kun uploade ${limit} ' + (options.limit == 1 ? 'fil' : 'filer') + ' ad gangen.'
                },
                filesType: 'Det er kun tilladt at uploade ${extensions} filer.',
                fileSize: '${name} er for stor! VÃ¦lg venligst en fil pÃ¥ hÃ¸jst ${fileMaxSize} MB.',
                filesSizeAll: 'De valgte filer er for store! VÃ¦lg venligst filer op til ${maxSize} MB ialt.',
                fileName: 'Du har allerede valgt en fil med navnet ${name}.',
                remoteFile: 'Fremmede filer er ikke tilladt.',
                folderUpload: 'Mapper er ikke tilladt.',
            }
        },
        en: {
            button: function (options) {
                return 'Browse ' + (options.limit == 1 ? 'file' : 'files')
            },
            feedback: function (options) {
                return 'Choose ' + (options.limit == 1 ? 'file' : 'files') + ' to upload'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? ' files were' : ' file was') + ' chosen'
            },
            confirm: 'Confirm',
            cancel: 'Cancel',
            name: 'Name',
            type: 'Type',
            size: 'Size',
            dimensions: 'Dimensions',
            duration: 'Duration',
            crop: 'Crop',
            rotate: 'Rotate',
            sort: 'Sort',
            open: 'Open',
            download: 'Download',
            remove: 'Delete',
            drop: 'Drop the files here to upload',
            paste: '<div class="fileuploader-pending-loader"></div> Pasting a file, click here to cancel',
            removeConfirmation: 'Are you sure you want to delete this file?',
            errors: {
                filesLimit: function (options) {
                    return 'Only ${limit} ' + (options.limit == 1 ? 'file' : 'files') + ' can be uploaded.'
                },
                filesType: 'Only ${extensions} files are allowed to be uploaded.',
                fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize} MB.',
                filesSizeAll: 'The chosen files are too large! Please select files up to ${maxSize} MB.',
                fileName: 'A file with the same name ${name} is already selected.',
                remoteFile: 'Remote files are not allowed.',
                folderUpload: 'Folders are not allowed.',
            }
        },
        es: {
            button: function (options) {
                return 'Examinar ' + (options.limit == 1 ? 'archivo' : 'archivos')
            },
            feedback: function (options) {
                return 'Selecciona ' + (options.limit == 1 ? 'archivos' : 'archivos') + ' para subir'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'archivos seleccionados' : 'archivo seleccionado')
            },
            confirm: 'Guardar',
            cancel: 'Anular',
            name: 'Nombre',
            type: 'Tipo',
            size: 'TamaÃ±o',
            dimensions: 'Dimensiones',
            duration: 'Duracion',
            crop: 'Corta',
            rotate: 'Rotar',
            sort: 'Ordenar',
            open: 'Abierto',
            download: 'Descargar',
            remove: 'Eliminar',
            drop: 'Suelta los archivos aquÃ­ para subirlos',
            paste: '<div class="fileuploader-pending-loader"></div> Pegar un archivo, haga clic aquÃ­ para cancelar',
            removeConfirmation: 'Â¿EstÃ¡s seguro de que deseas eliminar este archivo?',
            errors: {
                filesLimit: function (options) {
                    return 'Solo se pueden seleccionar ${limit} ' + (options.limit == 1 ? 'archivo' : 'archivos') + '.'
                },
                filesType: 'Solo se pueden seleccionar archivos ${extensions}.',
                fileSize: '${name} es demasiado grande! Por favor, seleccione un archivo hasta ${fileMaxSize} MB.',
                filesSizeAll: 'Â¡Los archivos seleccionados son demasiado grandes! Por favor seleccione archivos de hasta ${maxSize} MB.',
                fileName: 'Un archivo con el mismo nombre ${name} ya estÃ¡ seleccionado.',
                remoteFile: 'Los archivos remotos no estÃ¡n permitidos.',
                folderUpload: 'No se permiten carpetas.',
            }
        },
        fr: {
            button: function (options) {
                return 'Parcourir ' + (options.limit == 1 ? 'le fichier' : 'les fichiers')
            },
            feedback: function (options) {
                return 'Choisir ' + (options.limit == 1 ? 'le fichier ' : 'les fichiers') + ' Ã  tÃ©lÃ©charger'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'fichiers ont Ã©tÃ© choisis' : 'fichier a Ã©tÃ© choisi')
            },
            confirm: 'Confirmer',
            cancel: 'Annuler',
            name: 'Nom',
            type: 'Type',
            size: 'Taille',
            dimensions: 'Dimensions',
            duration: 'DurÃ©e',
            crop: 'Recadrer',
            rotate: 'Pivoter',
            sort: 'Trier',
            download: 'TÃ©lÃ©charger',
            remove: 'Supprimer',
            drop: 'DÃ©posez les fichiers ici pour les tÃ©lÃ©charger',
            paste: '<div class="fileuploader-pending-loader"></div> Collant un fichier, cliquez ici pour annuler.',
            removeConfirmation: 'ÃŠtes-vous sÃ»r de vouloir supprimer ce fichier ?',
            errors: {
                filesLimit: 'Seuls les fichiers ${limit} peuvent Ãªtre tÃ©lÃ©chargÃ©s.',
                filesType: 'Seuls les fichiers ${extensions} peuvent Ãªtre tÃ©lÃ©chargÃ©s.',
                fileSize: '${name} est trop lourd, la limite est de ${fileMaxSize} MB.',
                filesSizeAll: 'Les fichiers que vous avez choisis sont trop lourd, la limite totale est de ${maxSize} MB.',
                fileName: 'Le fichier portant le nom ${name} est dÃ©jÃ  sÃ©lectionnÃ©.',
                folderUpload: 'Vous n\'Ãªtes pas autorisÃ© Ã  tÃ©lÃ©charger des dossiers.'
            }
        },
        it: {
            button: function (options) {
                return 'Sfoglia' + (options.limit == 1 ? 'il file' : 'i file')
            },
            feedback: function (options) {
                return 'Seleziona ' + (options.limit == 1 ? 'file' : 'i file') + ' per caricare'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'i file sono scelti' : 'il file Ã¨ scelto')
            },
            confirm: 'Conferma',
            cancel: 'Cancella',
            name: 'Nome',
            type: 'Tipo file',
            size: 'Dimensione file',
            dimensions: 'Dimensioni',
            duration: 'Durata',
            crop: 'Taglia',
            rotate: 'Ruota',
            sort: 'Ordina',
            open: 'Apri',
            download: 'Scarica',
            remove: 'Elimina',
            drop: 'Posiziona il file qui per caricare',
            paste: '<div class="fileuploader-pending-loader"></div> Incolla file, clicca qui per cancellare',
            removeConfirmation: 'Sei sicuro di voler eliminare il file?',
            errors: {
                filesLimit: 'Solo ${limit} file possono essere caricati.',
                filesType: 'Solo ${extensions} file possono essere caricati.',
                fileSize: '${name} Ã¨ troppo grande! Scegli un file fino a ${fileMaxSize} MB.',
                filesSizeAll: 'I file selezioni sono troppo grandi! Scegli un file fino a ${maxSize} MB.',
                fileName: 'Un file con lo stesso nome ${name} Ã¨ giÃ  selezionato.',
                remoteFile: 'I file remoti non sono consentiti.',
                folderUpload: 'Le cartelle non sono consentite.',
            }
        },
        lv: {
            button: function (options) {
                return 'IzvÄ“lieties ' + (options.limit == 1 ? 'fails' : 'faili')
            },
            feedback: function (options) {
                return 'IzvÄ“liejaties ' + (options.limit == 1 ? 'fails' : 'faili') + ' lejupielÄ�dÄ“t'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'failus izvelÄ“ts' : 'fails izvÄ“lÄ“ts')
            },
            confirm: 'SaglabÄ�t',
            cancel: 'Atcelt',
            name: 'VÄ�rds',
            type: 'FormÄ�ts',
            size: 'IzmÄ“rs',
            dimensions: 'IzmÄ“ri',
            duration: 'Ilgums',
            crop: 'Nogriezt',
            rotate: 'Pagriezt',
            sort: 'KÄ�rtot',
            open: 'AtvÄ“rt',
            download: 'LejupielÄ�dÄ“t',
            remove: 'DzÄ“st',
            drop: 'Lai augÅ¡upielÄ�dÄ“tu, velciet failus Å¡eit',
            paste: '<div class="fileuploader-pending-loader"></div> Ievietojiet failu, noklikÅ¡Ä·iniet Å¡eit, lai atceltu',
            removeConfirmation: 'Vai tieÅ¡Ä�m vÄ“laties izdzÄ“st Å¡o failu?',
            errors: {
                filesLimit: function (options) {
                    return 'Tikai ${limit} ' + (options.limit == 1 ? 'failu var augÅ¡upielÄ�dÄ“t' : 'failus var augÅ¡upielÄ�dÄ“t') + '.'
                },
                filesType: 'Tikai ${extensions} failus var augÅ¡upielÄ�dÄ“t.',
                fileSize: '${name} ir par lielu! LÅ«dzu, atlasiet failu lÄ«dz ${fileMaxSize} MB.',
                filesSizeAll: 'AtlasÄ«tie faili ir pÄ�rÄ�k lieli! LÅ«dzu, atlasiet failus lÄ«dz ${maxSize} MB.',
                fileName: 'Fails ar tÄ�du paÅ¡u nosaukumu ${name} jau ir atlasÄ«ts.',
                remoteFile: 'AttÄ�lie faili nav atÄ¼auti.',
                folderUpload: 'Mapes nav atÄ¼autas.',
            }
        },
        nl: {
            button: function (options) {
                return (options.limit == 1 ? 'Bestand' : 'Bestanden') + ' kiezen'
            },
            feedback: function (options) {
                return 'Kies ' + (options.limit == 1 ? 'een bestand' : 'bestanden') + ' om te uploaden'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'bestanden' : 'bestand') + ' gekozen'
            },
            confirm: 'Opslaan',
            cancel: 'Annuleren',
            name: 'Naam',
            type: 'Type',
            size: 'Grootte',
            dimensions: 'Afmetingen',
            duration: 'Duur',
            crop: 'Uitsnijden',
            rotate: 'Draaien',
            sort: 'Sorteren',
            open: 'Open',
            download: ' Downloaden',
            remove: 'Verwijderen',
            drop: 'Laat de bestanden hier vallen om te uploaden',
            paste: '<div class="fileuploader-pending-loader"></div> Een bestand wordt geplakt, klik hier om te annuleren',
            removeConfirmation: 'Weet u zeker dat u dit bestand wilt verwijderen?',
            errors: {
                filesLimit: function (options) {
                    return 'Er ' + (options.limit == 1 ? 'mag' : 'mogen') + ' slechts ${limit} ' + (options.limit == 1 ? 'bestand' : 'bestanden') + ' worden geÃ¼pload.'
                },
                filesType: 'Alleen ${extensions} mogen worden geÃ¼pload.',
                fileSize: '${name} is te groot! Kies een bestand tot ${fileMaxSize} MB.',
                filesSizeAll: 'De gekozen bestanden zijn te groot! Kies bestanden tot ${maxSize} MB.',
                fileName: 'Een bestand met dezelfde naam ${name} is al gekozen.',
                remoteFile: 'Externe bestanden zijn niet toegestaan.',
                folderUpload: 'Mappen zijn niet toegestaan.',
            }
        },
        pl: {
            button: function (options) {
                return 'Wybierz ' + (options.limit == 1 ? 'plik' : 'pliki')
            },
            feedback: function (options) {
                return 'Wybierz ' + (options.limit == 1 ? 'plik' : 'pliki') + ' do przesÅ‚ania'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'pliki zostaÅ‚y wybrane' : 'plik zostaÅ‚ wybrany')
            },
            confirm: 'PotwierdÅº',
            cancel: 'Anuluj',
            name: 'Nazwa',
            type: 'Typ',
            size: 'Rozmiar',
            dimensions: 'Wymiary',
            duration: 'Czas trwania',
            crop: 'Przytnij',
            rotate: 'ObrÃ³Ä‡',
            sort: 'Sortuj',
            open: 'OtwÃ³rz',
            download: 'Pobierz',
            remove: 'UsuÅ„',
            drop: 'UpuÅ›Ä‡ pliki tutaj do przesÅ‚ania',
            paste: '<div class="fileuploader-pending-loader"></div> WklejajÄ…c plik, kliknij tutaj, aby anulowaÄ‡',
            removeConfirmation: 'Czy jesteÅ› pewien, Å¼e chcesz usunÄ…Ä‡ ten plik?',
            errors: {
                filesLimit: function (options) {
                    return 'Tylko ${limit} ' + (options.limit == 1 ? 'plik' : 'pliki') + ' moÅ¼na wybraÄ‡.'
                },
                filesType: 'Tylko pliki ${extensions} mogÄ… zostaÄ‡ pobrane.',
                fileSize: 'Plik ${name} jest za duÅ¼y! ProszÄ™ wybraÄ‡ plik do ${fileMaxSize} MB.',
                filesSizeAll: 'Wybrane pliki sÄ… za duÅ¼e! ProszÄ™ wybraÄ‡ pliki do  ${maxSize} MB.',
                fileName: ', Plik o tej samej nazwie ${name} juÅ¼ zostaÅ‚ wybrany.',
                remoteFile: 'Zdalne pliki nie sÄ… dozwolone.',
                folderUpload: 'Foldery nie sÄ… dozwolone.',
            }
        },
        pt: {
            button: function (options) {
                return 'Escolher ' + (options.limit == 1 ? 'arquivo' : 'arquivos')
            },
            feedback: function (options) {
                return 'Escolha ' + (options.limit == 1 ? 'arquivo' : 'arquivos') + ' a carregar'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'arquivos foram escolhidos' : 'arquivo foi escolhido')
            },
            confirm: 'Confirmar',
            cancel: 'Cancelar',
            name: 'Nome',
            type: 'Tipo',
            size: 'Tamanho',
            dimensions: 'DimensÃµes',
            duration: 'DuraÃ§Ã£o',
            crop: 'Recorte',
            rotate: 'Girar',
            sort: 'Ordenar',
            open: 'Abrir',
            download: 'Baixar',
            remove: 'Excluir',
            drop: 'Solte os arquivos aqui para fazer o upload',
            paste: '<div class="fileuploader-pending-loader"></div> Colando um arquivo, clique aqui para cancelar',
            removeConfirmation: 'Tem certeza de que deseja excluir este arquivo?',
            errors: {
                filesLimit: function (options) {
                    return 'Apenas ${limit} ' + (options.limit == 1 ? 'arquivo a ser carregado' : 'arquivos a serem carregados') + '.'
                },
                filesType: 'Somente arquivos ${extensions} podem ser carregados.',
                fileSize: '${name} Ã© muito grande! Selecione um arquivo de atÃ© ${fileMaxSize} MB.',
                filesSizeAll: 'Os arquivos selecionados sÃ£o muito grandes! Selecione arquivos de atÃ© ${maxSize} MB.',
                fileName: 'Um arquivo com o mesmo nome ${name} jÃ¡ estÃ¡ selecionado.',
                remoteFile: 'Arquivos remotos nÃ£o sÃ£o permitidos.',
                folderUpload: 'Pastas nÃ£o sÃ£o permitidas.',
            }
        },
        ro: {
            button: function (options) {
                return 'AtaÈ™eazÄƒ ' + (options.limit == 1 ? 'fiÈ™ier' : 'fiÈ™iere')
            },
            feedback: function (options) {
                return 'SelecteazÄƒ ' + (options.limit == 1 ? 'fiÈ™ier' : 'fiÈ™iere') + ' pentru Ã®ncÄƒrcare'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? ' fiÈ™iere' : ' fiÈ™ier') + ' selectate'
            },
            confirm: 'ConfirmÄƒ',
            cancel: 'AnuleazÄƒ',
            name: 'Nume',
            type: 'Tip',
            size: 'MÄƒrimea',
            dimensions: 'Dimensiunea',
            duration: 'Durata',
            crop: 'Crop',
            rotate: 'Rotire',
            sort: 'Sortare',
            open: 'Deschide',
            download: 'Download',
            remove: 'È˜terge',
            drop: 'AruncaÈ›i fiÈ™ierele aici pentru a le Ã®ncÄƒrca',
            paste: '<div class="fileuploader-pending-loader"></div> Se ataÈ™eazÄƒ fiÈ™ier, faceÈ›i click aici pentru anulare',
            removeConfirmation: 'Sigur doriÈ›i sÄƒ È™tergeÈ›i acest fiÈ™ier?',
            errors: {
                filesLimit: function (options) {
                    return 'Doar ${limit} ' + (options.limit == 1 ? 'fiÈ™ier poate fi selectat' : 'fiÈ™iere pot fi selectat') + '.'
                },
                filesType: 'Doar fiÈ™ierele ${extensions} pot fi Ã®ncÄƒrcate.',
                fileSize: '${name} este prea mare! VÄƒ rugÄƒm sÄƒ selectaÈ›i un fiÈ™ier pÃ¢nÄƒ la ${fileMaxSize} MB.',
                filesSizeAll: 'FiÈ™ierele selectate sunt prea mari! VÄƒ rugÄƒm sÄƒ selectaÈ›i fiÈ™iere pÃ¢nÄƒ la ${maxSize} MB.',
                fileName: 'FiÈ™ierul cu acelaÈ™i numele ${nume} a fost deja selectat.',
                remoteFile: 'FiÈ™ierele remote nu sunt permise.',
                folderUpload: 'Folderele nu sunt permise.',
            }
        },
        ru: {
            button: function (options) {
                return 'Ð’Ñ‹Ð±Ñ€Ð°Ñ‚ÑŒ ' + (options.limit == 1 ? 'Ñ„Ð°Ð¹Ð»' : 'Ñ„Ð°Ð¹Ð»Ñ‹')
            },
            feedback: function (options) {
                return 'Ð’Ñ‹Ð±ÐµÑ€Ð¸Ñ‚Ðµ ' + (options.limit == 1 ? 'Ñ„Ð°Ð¹Ð»' : 'Ñ„Ð°Ð¹Ð»Ñ‹') + ' Ð´Ð»Ñ� Ð·Ð°Ð³Ñ€ÑƒÐ·ÐºÐ¸'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'Ñ„Ð°Ð¹Ð»Ð¾Ð² Ð²Ñ‹Ð±Ñ€Ð°Ð½Ð¾' : 'Ñ„Ð°Ð¹Ð» Ð²Ñ‹Ð±Ñ€Ð°Ð½')
            },
            confirm: 'Ð¡Ð¾Ñ…Ñ€Ð°Ð½Ð¸Ñ‚ÑŒ',
            cancel: 'ÐžÑ‚Ð¼ÐµÐ½Ð°',
            name: 'Ð˜Ð¼Ñ�',
            type: 'Ð¤Ð¾Ñ€Ð¼Ð°Ñ‚',
            size: 'Ð Ð°Ð·Ð¼ÐµÑ€',
            dimensions: 'Ð Ð°Ð·Ð¼ÐµÑ€Ñ‹',
            duration: 'Ð”Ð»Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ð¾Ñ�Ñ‚ÑŒ',
            crop: 'ÐžÐ±Ñ€ÐµÐ·Ð°Ñ‚ÑŒ',
            rotate: 'ÐŸÐ¾Ð²ÐµÑ€Ð½ÑƒÑ‚ÑŒ',
            sort: 'Ð¡Ð¾Ñ€Ñ‚Ð¸Ñ€Ð¾Ð²Ñ‚ÑŒ',
            open: 'ÐžÑ‚ÐºÑ€Ñ‹Ñ‚ÑŒ',
            download: 'Ð¡ÐºÐ°Ñ‡Ð°Ñ‚ÑŒ',
            remove: 'Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ',
            drop: 'ÐŸÐµÑ€ÐµÑ‚Ð°Ñ‰Ð¸Ñ‚Ðµ Ñ„Ð°Ð¹Ð»Ñ‹ Ñ�ÑŽÐ´Ð° Ð´Ð»Ñ� Ð·Ð°Ð³Ñ€ÑƒÐ·ÐºÐ¸',
            paste: '<div class="fileuploader-pending-loader"></div> Ð’Ñ�Ñ‚Ð°Ð²ÐºÐ° Ñ„Ð°Ð¹Ð»Ð°, Ð½Ð°Ð¶Ð¼Ð¸Ñ‚Ðµ Ð·Ð´ÐµÑ�ÑŒ, Ñ‡Ñ‚Ð¾Ð±Ñ‹ Ð¾Ñ‚Ð¼ÐµÐ½Ð¸Ñ‚ÑŒ',
            removeConfirmation: 'Ð’Ñ‹ ÑƒÐ²ÐµÑ€ÐµÐ½Ñ‹, Ñ‡Ñ‚Ð¾ Ñ…Ð¾Ñ‚Ð¸Ñ‚Ðµ ÑƒÐ´Ð°Ð»Ð¸Ñ‚ÑŒ Ñ�Ñ‚Ð¾Ñ‚ Ñ„Ð°Ð¹Ð»?',
            errors: {
                filesLimit: function (options) {
                    return 'Ð¢Ð¾Ð»ÑŒÐºÐ¾ ${limit} ' + (options.limit == 1 ? 'Ñ„Ð°Ð¹Ð» Ð¼Ð¾Ð¶ÐµÑ‚ Ð±Ñ‹Ñ‚ÑŒ Ð·Ð°Ð³Ñ€ÑƒÐ¶ÐµÐ½' : 'Ñ„Ð°Ð¹Ð»Ð¾Ð² Ð¼Ð¾Ð³ÑƒÑ‚ Ð±Ñ‹Ñ‚ÑŒ Ð·Ð°Ð³Ñ€ÑƒÐ¶ÐµÐ½Ñ‹') + '.'
                },
                filesType: 'Ð¢Ð¾Ð»ÑŒÐºÐ¾ ${extensions} Ñ„Ð°Ð¹Ð»Ñ‹ Ð¼Ð¾Ð³ÑƒÑ‚ Ð±Ñ‹Ñ‚ÑŒ Ð·Ð°Ð³Ñ€ÑƒÐ¶ÐµÐ½Ñ‹.',
                fileSize: '${name} Ñ�Ð»Ð¸ÑˆÐºÐ¾Ð¼ Ð±Ð¾Ð»ÑŒÑˆÐ¾Ð¹! ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹Ñ�Ñ‚Ð°, Ð²Ñ‹Ð±ÐµÑ€Ð¸Ñ‚Ðµ Ñ„Ð°Ð¹Ð» Ð´Ð¾ ${fileMaxSize} ÐœÐ‘.',
                filesSizeAll: 'Ð’Ñ‹Ð±Ñ€Ð°Ð½Ð½Ñ‹Ðµ Ñ„Ð°Ð¹Ð»Ñ‹ Ñ�Ð»Ð¸ÑˆÐºÐ¾Ð¼ Ð±Ð¾Ð»ÑŒÑˆÐ¸Ðµ! ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹Ñ�Ñ‚Ð°, Ð²Ñ‹Ð±ÐµÑ€Ð¸Ñ‚Ðµ Ñ„Ð°Ð¹Ð»Ñ‹ Ð´Ð¾ ${maxSize} ÐœÐ‘.',
                fileName: 'Ð¤Ð°Ð¹Ð» Ñ� Ñ‚Ð°ÐºÐ¸Ð¼ Ð¸Ð¼ÐµÐ½ÐµÐ¼ ${name} ÑƒÐ¶Ðµ Ð²Ñ‹Ð±Ñ€Ð°Ð½.',
                remoteFile: 'Ð£Ð´Ð°Ð»ÐµÐ½Ð½Ñ‹Ðµ Ñ„Ð°Ð¹Ð»Ñ‹ Ð½Ðµ Ð´Ð¾Ð¿ÑƒÑ�ÐºÐ°ÑŽÑ‚Ñ�Ñ�.',
                folderUpload: 'ÐŸÐ°Ð¿ÐºÐ¸ Ð½Ðµ Ð´Ð¾Ð¿ÑƒÑ�ÐºÐ°ÑŽÑ‚Ñ�Ñ�.',
            }
        },
        tr: {
            button: function (options) {
                return (options.limit == 1 ? 'Dosya' : 'DosyalarÄ±') + ' seÃ§'
            },
            feedback: function (options) {
                return 'YÃ¼klemek istediÄŸiniz ' + (options.limit == 1 ? 'dosyayÄ±' : 'dosyalarÄ±') + ' seÃ§in.'
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? 'dosyalar' : 'dosya') + ' seÃ§ildi.'
            },
            confirm: 'Onayla',
            cancel: 'Ä°ptal',
            name: 'Ä°sim',
            type: 'Tip',
            size: 'Boyut',
            dimensions: 'Boyutlar',
            duration: 'SÃ¼re',
            crop: 'KÄ±rp',
            rotate: 'DÃ¶ndÃ¼r',
            sort: 'SÄ±rala',
            open: 'AÃ§',
            download: 'Ä°ndir',
            remove: 'Sil',
            drop: 'YÃ¼klemek iÃ§in dosyalarÄ± buraya bÄ±rakÄ±n',
            paste: '<div class="fileuploader-pending-loader"></div> Bir dosyayÄ± yapÄ±ÅŸtÄ±rmak veya iptal etmek iÃ§in buraya tÄ±klayÄ±n',
            removeConfirmation: 'Bu dosyayÄ± silmek istediÄŸinizden emin misiniz?',
            errors: {
                filesLimit: function (options) {
                    return 'Sadece ${limit} ' + (options.limit == 1 ? 'dosya' : 'dosyalar') + ' yÃ¼klenmesine izin verilir.'
                },
                filesType: 'Sadece ${extensions} dosyalarÄ±n yÃ¼klenmesine izin verilir.',
                fileSize: '${name} Ã§ok bÃ¼yÃ¼k! LÃ¼tfen ${fileMaxSize} MB\'a kadar bir dosya seÃ§in.',
                filesSizeAll: 'SeÃ§ilen dosyalar Ã§ok bÃ¼yÃ¼k! LÃ¼tfen ${maxSize} MB\'a kadar dosyalarÄ± seÃ§in',
                fileName: 'AynÄ± ada sahip bir dosya ${name} zaten seÃ§ilmiÅŸtir.',
                remoteFile: 'Uzak dosyalara izin verilmez.',
                folderUpload: 'KlasÃ¶rlere izin verilmez.',
            }
        }
    };
    $.fn.fileuploader.defaults = {
        limit: null,
        maxSize: null,
        fileMaxSize: null,
        extensions: null,
        disallowedExtensions: null,
        changeInput: true,
        inputNameBrackets: true,
        theme: 'default',
        thumbnails: {
            box: '<div class="fileuploader-items">' + '<ul class="fileuploader-items-list"></ul>' + '</div>',
            boxAppendTo: null,
            item: '<li class="fileuploader-item">' + '<div class="columns">' + '<div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div>' + '<div class="column-title">' + '<div title="${name}">${name}</div>' + '<span>${size2}</span>' + '</div>' + '<div class="column-actions">' + '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></a>' + '</div>' + '</div>' + '<div class="progress-bar2">${progressBar}<span></span></div>' + '</li>',
            item2: '<li class="fileuploader-item">' + '<div class="columns">' + '<div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div>' + '<div class="column-title">' + '<a href="${file}" target="_blank">' + '<div title="${name}">${name}</div>' + '<span>${size2}</span>' + '</a>' + '</div>' + '<div class="column-actions">' + '<a href="${data.url}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' + '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></a>' + '</div>' + '</div>' + '</li>',
            popup: {
                container: 'body',
                loop: true,
                arrows: true,
                zoomer: true,
                template: function (data) {
                    return '<div class="fileuploader-popup-preview">' + '<button type="button" class="fileuploader-popup-move" data-action="prev"><i class="fileuploader-icon-arrow-left"></i></button>' + '<div class="fileuploader-popup-node node-${format}">' + '${reader.node}' + '</div>' + '<div class="fileuploader-popup-content">' + '<div class="fileuploader-popup-footer">' + '<ul class="fileuploader-popup-tools">' + (data.format == 'image' && data.reader.node && data.editor ? (data.editor.cropper ? '<li>' + '<button type="button" data-action="crop">' + '<i class="fileuploader-icon-crop"></i> ${captions.crop}' + '</button>' + '</li>' : '') + (data.editor.rotate ? '<li>' + '</li>' : '') : '') + (data.format == 'image' ? '<li class="fileuploader-popup-zoomer">' + '<button type="button" data-action="zoom-out">&minus;</button>' + '<input type="range" min="0" max="100">' + '<button type="button" data-action="zoom-in">&plus;</button>' + '<span></span> ' + '</li>' : '') + (data.data.url ? '<li>' + '<a href="' + data.data.url + '" data-action="open" target="_blank">' + '<i class="fileuploader-icon-external"></i> ${captions.open}' + '</a>' + '</li>' : '') + '<li>' + '<button type="button" data-action="remove">' + '<i class="fileuploader-icon-trash"></i> ${captions.remove}' + '</button>' + '</li>' + '</ul>' + '</div>' + '<div class="fileuploader-popup-header">' + '<ul class="fileuploader-popup-meta">' + '<li>' + '<span>${captions.name}:</span>' + '<h5>${name}</h5>' + '</li>' + '<li>' + '<span>${captions.type}:</span>' + '<h5>${extension.toUpperCase()}</h5>' + '</li>' + '<li>' + '<span>${captions.size}:</span>' + '<h5>${size2}</h5>' + '</li>' + (data.reader && data.reader.width ? '<li>' + '<span>${captions.dimensions}:</span>' + '<h5>${reader.width}x${reader.height}px</h5>' + '</li>' : '') + (data.reader && data.reader.duration ? '<li>' + '<span>${captions.duration}:</span>' + '<h5>${reader.duration2}</h5>' + '</li>' : '') + '</ul>' + '<div class="fileuploader-popup-info"></div>' + '<ul class="fileuploader-popup-buttons">' + '<li><button type="button" class="fileuploader-popup-button" data-action="cancel">${captions.cancel}</a></li>' + (data.editor ? '<li><button type="button" class="fileuploader-popup-button button-success" data-action="save">${captions.confirm}</button></li>' : '') + '</ul>' + '</div>' + '</div>' + '<button type="button" class="fileuploader-popup-move" data-action="next"><i class="fileuploader-icon-arrow-right"></i></button>' + '</div>'
                },
                onShow: function (item) {
                    item.popup.html.on('click', '[data-action="remove"]', function (e) {
                        item.popup.close();
                        item.remove()
                    }).on('click', '[data-action="cancel"]', function (e) {
                        item.popup.close()
                    }).on('click', '[data-action="save"]', function (e) {
                        if (item.editor)
                            item.editor.save();
                        if (item.popup.close)
                            item.popup.close()
                    })
                },
                onHide: null
            },
            itemPrepend: false,
            removeConfirmation: true,
            startImageRenderer: true,
            synchronImages: true,
            useObjectUrl: false,
            canvasImage: true,
            videoThumbnail: true,
            pdf: true,
            exif: true,
            touchDelay: 0,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove',
                sorter: '.fileuploader-action-sort',
                rotate: '.fileuploader-action-rotate',
                popup: '.fileuploader-popup-preview',
                popup_open: '.fileuploader-action-popup'
            },
            beforeShow: null,
            onItemShow: null,
            onItemRemove: function (html) {
                html.children().animate({
                    'opacity': 0
                }, 200, function () {
                    setTimeout(function () {
                        html.slideUp(200, function () {
                            html.remove()
                        })
                    }, 100)
                })
            },
            onImageLoaded: null
        },
        editor: false,
        sorter: false,
        reader: {
            thumbnailTimeout: 5000,
            timeout: 12000,
            maxSize: 20
        },
        files: null,
        upload: null,
        dragDrop: true,
        addMore: false,
        skipFileNameCheck: false,
        clipboardPaste: true,
        listInput: true,
        enableApi: false,
        listeners: null,
        onSupportError: null,
        beforeRender: null,
        afterRender: null,
        beforeSelect: null,
        onFilesCheck: null,
        onFileRead: null,
        onSelect: null,
        afterSelect: null,
        onListInput: null,
        onRemove: null,
        onEmpty: null,
        dialogs: {
            alert: function (text) {
                return alert(text)
            },
            confirm: function (text, callback) {
                confirm(text) ? callback() : null
            }
        },
        captions: $.fn.fileuploader.languages.en
    }

}));

(function () {
    var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X = [].slice,
            Y = {}.hasOwnProperty,
            Z = function (a, b) {
                function c() {
                    this.constructor = a
                }
                for (var d in b)
                    Y.call(b, d) && (a[d] = b[d]);
                return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
            },
            $ = [].indexOf || function (a) {
        for (var b = 0, c = this.length; c > b; b++)
            if (b in this && this[b] === a)
                return b;
        return -1
    };
    for (u = {
    catchupTime: 100,
            initialRate: .03,
            minTime: 250,
            ghostTime: 100,
            maxProgressPerFrame: 20,
            easeFactor: 1.25,
            startOnPageLoad: !0,
            restartOnPushState: !0,
            restartOnRequestAfter: 500,
            target: "body",
            elements: {
            checkInterval: 100,
                    selectors: ["body"]
            },
            eventLag: {
            minSamples: 10,
                    sampleCount: 3,
                    lagThreshold: 3
            },
            ajax: {
            trackMethods: ["GET"],
                    trackWebSockets: !0,
                    ignoreURLs: []
            }
    }, C = function () {
        var a;
        return null != (a = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? a : +new Date
    }, E = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, t = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == E && (E = function (a) {
        return setTimeout(a, 50)
    }, t = function (a) {
        return clearTimeout(a)
    }), G = function (a) {
        var b, c;
        return b = C(), (c = function () {
            var d;
            return d = C() - b, d >= 33 ? (b = C(), a(d, function () {
                return E(c)
            })) : setTimeout(c, 33 - d)
        })()
    }, F = function () {
        var a, b, c;
        return c = arguments[0], b = arguments[1], a = 3 <= arguments.length ? X.call(arguments, 2) : [], "function" == typeof c[b] ? c[b].apply(c, a) : c[b]
    }, v = function () {
        var a, b, c, d, e, f, g;
        for (b = arguments[0], d = 2 <= arguments.length ? X.call(arguments, 1) : [], f = 0, g = d.length; g > f; f++)
            if (c = d[f])
                for (a in c)
                    Y.call(c, a) && (e = c[a], null != b[a] && "object" == typeof b[a] && null != e && "object" == typeof e ? v(b[a], e) : b[a] = e);
        return b
    }, q = function (a) {
        var b, c, d, e, f;
        for (c = b = 0, e = 0, f = a.length; f > e; e++)
            d = a[e], c += Math.abs(d), b++;
        return c / b
    }, x = function (a, b) {
        var c, d, e;
        if (null == a && (a = "options"), null == b && (b = !0), e = document.querySelector("[data-pace-" + a + "]")) {
            if (c = e.getAttribute("data-pace-" + a), !b)
                return c;
            try {
                return JSON.parse(c)
            } catch (f) {
                return d = f, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", d) : void 0
            }
        }
    }, g = function () {
        function a() {
        }
        return a.prototype.on = function (a, b, c, d) {
            var e;
            return null == d && (d = !1), null == this.bindings && (this.bindings = {}), null == (e = this.bindings)[a] && (e[a] = []), this.bindings[a].push({
                handler: b,
                ctx: c,
                once: d
            })
        }, a.prototype.once = function (a, b, c) {
            return this.on(a, b, c, !0)
        }, a.prototype.off = function (a, b) {
            var c, d, e;
            if (null != (null != (d = this.bindings) ? d[a] : void 0)) {
                if (null == b)
                    return delete this.bindings[a];
                for (c = 0, e = []; c < this.bindings[a].length; )
                    e.push(this.bindings[a][c].handler === b ? this.bindings[a].splice(c, 1) : c++);
                return e
            }
        }, a.prototype.trigger = function () {
            var a, b, c, d, e, f, g, h, i;
            if (c = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], null != (g = this.bindings) ? g[c] : void 0) {
                for (e = 0, i = []; e < this.bindings[c].length; )
                    h = this.bindings[c][e], d = h.handler, b = h.ctx, f = h.once, d.apply(null != b ? b : this, a), i.push(f ? this.bindings[c].splice(e, 1) : e++);
                return i
            }
        }, a
    }(), j = window.Pace || {}, window.Pace = j, v(j, g.prototype), D = j.options = v({}, u, window.paceOptions, x()), U = ["ajax", "document", "eventLag", "elements"], Q = 0, S = U.length; S > Q; Q++)
        K = U[Q], D[K] === !0 && (D[K] = u[K]);
    i = function (a) {
        function b() {
            return V = b.__super__.constructor.apply(this, arguments)
        }
        return Z(b, a), b
    }(Error), b = function () {
        function a() {
            this.progress = 0
        }
        return a.prototype.getElement = function () {
            var a;
            if (null == this.el) {
                if (a = document.querySelector(D.target), !a)
                    throw new i;
                this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != a.firstChild ? a.insertBefore(this.el, a.firstChild) : a.appendChild(this.el)
            }
            return this.el
        }, a.prototype.finish = function () {
            var a;
            return a = this.getElement(), a.className = a.className.replace("pace-active", ""), a.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
        }, a.prototype.update = function (a) {
            return this.progress = a, this.render()
        }, a.prototype.destroy = function () {
            try {
                this.getElement().parentNode.removeChild(this.getElement())
            } catch (a) {
                i = a
            }
            return this.el = void 0
        }, a.prototype.render = function () {
            var a, b, c, d, e, f, g;
            if (null == document.querySelector(D.target))
                return !1;
            for (a = this.getElement(), d = "translate3d(" + this.progress + "%, 0, 0)", g = ["webkitTransform", "msTransform", "transform"], e = 0, f = g.length; f > e; e++)
                b = g[e], a.children[0].style[b] = d;
            return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (a.children[0].setAttribute("data-progress-text", "" + (0 | this.progress) + "%"), this.progress >= 100 ? c = "99" : (c = this.progress < 10 ? "0" : "", c += 0 | this.progress), a.children[0].setAttribute("data-progress", "" + c)), this.lastRenderedProgress = this.progress
        }, a.prototype.done = function () {
            return this.progress >= 100
        }, a
    }(), h = function () {
        function a() {
            this.bindings = {}
        }
        return a.prototype.trigger = function (a, b) {
            var c, d, e, f, g;
            if (null != this.bindings[a]) {
                for (f = this.bindings[a], g = [], d = 0, e = f.length; e > d; d++)
                    c = f[d], g.push(c.call(this, b));
                return g
            }
        }, a.prototype.on = function (a, b) {
            var c;
            return null == (c = this.bindings)[a] && (c[a] = []), this.bindings[a].push(b)
        }, a
    }(), P = window.XMLHttpRequest, O = window.XDomainRequest, N = window.WebSocket, w = function (a, b) {
        var c, d, e, f;
        f = [];
        for (d in b.prototype)
            try {
                e = b.prototype[d], f.push(null == a[d] && "function" != typeof e ? a[d] = e : void 0)
            } catch (g) {
                c = g
            }
        return f
    }, A = [], j.ignore = function () {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("ignore"), c = b.apply(null, a), A.shift(), c
    }, j.track = function () {
        var a, b, c;
        return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("track"), c = b.apply(null, a), A.shift(), c
    }, J = function (a) {
        var b;
        if (null == a && (a = "GET"), "track" === A[0])
            return "force";
        if (!A.length && D.ajax) {
            if ("socket" === a && D.ajax.trackWebSockets)
                return !0;
            if (b = a.toUpperCase(), $.call(D.ajax.trackMethods, b) >= 0)
                return !0
        }
        return !1
    }, k = function (a) {
        function b() {
            var a, c = this;
            b.__super__.constructor.apply(this, arguments), a = function (a) {
                var b;
                return b = a.open, a.open = function (d, e) {
                    return J(d) && c.trigger("request", {
                        type: d,
                        url: e,
                        request: a
                    }), b.apply(a, arguments)
                }
            }, window.XMLHttpRequest = function (b) {
                var c;
                return c = new P(b), a(c), c
            };
            try {
                w(window.XMLHttpRequest, P)
            } catch (d) {
            }
            if (null != O) {
                window.XDomainRequest = function () {
                    var b;
                    return b = new O, a(b), b
                };
                try {
                    w(window.XDomainRequest, O)
                } catch (d) {
                }
            }
            if (null != N && D.ajax.trackWebSockets) {
                window.WebSocket = function (a, b) {
                    var d;
                    return d = null != b ? new N(a, b) : new N(a), J("socket") && c.trigger("request", {
                        type: "socket",
                        url: a,
                        protocols: b,
                        request: d
                    }), d
                };
                try {
                    w(window.WebSocket, N)
                } catch (d) {
                }
            }
        }
        return Z(b, a), b
    }(h), R = null, y = function () {
        return null == R && (R = new k), R
    }, I = function (a) {
        var b, c, d, e;
        for (e = D.ajax.ignoreURLs, c = 0, d = e.length; d > c; c++)
            if (b = e[c], "string" == typeof b) {
                if (-1 !== a.indexOf(b))
                    return !0
            } else if (b.test(a))
                return !0;
        return !1
    }, y().on("request", function (b) {
        var c, d, e, f, g;
        return f = b.type, e = b.request, g = b.url, I(g) ? void 0 : j.running || D.restartOnRequestAfter === !1 && "force" !== J(f) ? void 0 : (d = arguments, c = D.restartOnRequestAfter || 0, "boolean" == typeof c && (c = 0), setTimeout(function () {
            var b, c, g, h, i, k;
            if (b = "socket" === f ? e.readyState < 2 : 0 < (h = e.readyState) && 4 > h) {
                for (j.restart(), i = j.sources, k = [], c = 0, g = i.length; g > c; c++) {
                    if (K = i[c], K instanceof a) {
                        K.watch.apply(K, d);
                        break
                    }
                    k.push(void 0)
                }
                return k
            }
        }, c))
    }), a = function () {
        function a() {
            var a = this;
            this.elements = [], y().on("request", function () {
                return a.watch.apply(a, arguments)
            })
        }
        return a.prototype.watch = function (a) {
            var b, c, d, e;
            return d = a.type, b = a.request, e = a.url, I(e) ? void 0 : (c = "socket" === d ? new n(b) : new o(b), this.elements.push(c))
        }, a
    }(), o = function () {
        function a(a) {
            var b, c, d, e, f, g, h = this;
            if (this.progress = 0, null != window.ProgressEvent)
                for (c = null, a.addEventListener("progress", function (a) {
                    return h.progress = a.lengthComputable ? 100 * a.loaded / a.total : h.progress + (100 - h.progress) / 2
                }, !1), g = ["load", "abort", "timeout", "error"], d = 0, e = g.length; e > d; d++)
                    b = g[d], a.addEventListener(b, function () {
                        return h.progress = 100
                    }, !1);
            else
                f = a.onreadystatechange, a.onreadystatechange = function () {
                    var b;
                    return 0 === (b = a.readyState) || 4 === b ? h.progress = 100 : 3 === a.readyState && (h.progress = 50), "function" == typeof f ? f.apply(null, arguments) : void 0
                }
        }
        return a
    }(), n = function () {
        function a(a) {
            var b, c, d, e, f = this;
            for (this.progress = 0, e = ["error", "open"], c = 0, d = e.length; d > c; c++)
                b = e[c], a.addEventListener(b, function () {
                    return f.progress = 100
                }, !1)
        }
        return a
    }(), d = function () {
        function a(a) {
            var b, c, d, f;
            for (null == a && (a = {}), this.elements = [], null == a.selectors && (a.selectors = []), f = a.selectors, c = 0, d = f.length; d > c; c++)
                b = f[c], this.elements.push(new e(b))
        }
        return a
    }(), e = function () {
        function a(a) {
            this.selector = a, this.progress = 0, this.check()
        }
        return a.prototype.check = function () {
            var a = this;
            return document.querySelector(this.selector) ? this.done() : setTimeout(function () {
                return a.check()
            }, D.elements.checkInterval)
        }, a.prototype.done = function () {
            return this.progress = 100
        }, a
    }(), c = function () {
        function a() {
            var a, b, c = this;
            this.progress = null != (b = this.states[document.readyState]) ? b : 100, a = document.onreadystatechange, document.onreadystatechange = function () {
                return null != c.states[document.readyState] && (c.progress = c.states[document.readyState]), "function" == typeof a ? a.apply(null, arguments) : void 0
            }
        }
        return a.prototype.states = {
            loading: 0,
            interactive: 50,
            complete: 100
        }, a
    }(), f = function () {
        function a() {
            var a, b, c, d, e, f = this;
            this.progress = 0, a = 0, e = [], d = 0, c = C(), b = setInterval(function () {
                var g;
                return g = C() - c - 50, c = C(), e.push(g), e.length > D.eventLag.sampleCount && e.shift(), a = q(e), ++d >= D.eventLag.minSamples && a < D.eventLag.lagThreshold ? (f.progress = 100, clearInterval(b)) : f.progress = 100 * (3 / (a + 3))
            }, 50)
        }
        return a
    }(), m = function () {
        function a(a) {
            this.source = a, this.last = this.sinceLastUpdate = 0, this.rate = D.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = F(this.source, "progress"))
        }
        return a.prototype.tick = function (a, b) {
            var c;
            return null == b && (b = F(this.source, "progress")), b >= 100 && (this.done = !0), b === this.last ? this.sinceLastUpdate += a : (this.sinceLastUpdate && (this.rate = (b - this.last) / this.sinceLastUpdate), this.catchup = (b - this.progress) / D.catchupTime, this.sinceLastUpdate = 0, this.last = b), b > this.progress && (this.progress += this.catchup * a), c = 1 - Math.pow(this.progress / 100, D.easeFactor), this.progress += c * this.rate * a, this.progress = Math.min(this.lastProgress + D.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
        }, a
    }(), L = null, H = null, r = null, M = null, p = null, s = null, j.running = !1, z = function () {
        return D.restartOnPushState ? j.restart() : void 0
    }, null != window.history.pushState && (T = window.history.pushState, window.history.pushState = function () {
        return z(), T.apply(window.history, arguments)
    }), null != window.history.replaceState && (W = window.history.replaceState, window.history.replaceState = function () {
        return z(), W.apply(window.history, arguments)
    }), l = {
        ajax: a,
        elements: d,
        document: c,
        eventLag: f
    }, (B = function () {
        var a, c, d, e, f, g, h, i;
        for (j.sources = L = [], g = ["ajax", "elements", "document", "eventLag"], c = 0, e = g.length; e > c; c++)
            a = g[c], D[a] !== !1 && L.push(new l[a](D[a]));
        for (i = null != (h = D.extraSources) ? h : [], d = 0, f = i.length; f > d; d++)
            K = i[d], L.push(new K(D));
        return j.bar = r = new b, H = [], M = new m
    })(), j.stop = function () {
        return j.trigger("stop"), j.running = !1, r.destroy(), s = !0, null != p && ("function" == typeof t && t(p), p = null), B()
    }, j.restart = function () {
        return j.trigger("restart"), j.stop(), j.start()
    }, j.go = function () {
        var a;
        return j.running = !0, r.render(), a = C(), s = !1, p = G(function (b, c) {
            var d, e, f, g, h, i, k, l, n, o, p, q, t, u, v, w;
            for (l = 100 - r.progress, e = p = 0, f = !0, i = q = 0, u = L.length; u > q; i = ++q)
                for (K = L[i], o = null != H[i] ? H[i] : H[i] = [], h = null != (w = K.elements) ? w : [K], k = t = 0, v = h.length; v > t; k = ++t)
                    g = h[k], n = null != o[k] ? o[k] : o[k] = new m(g), f &= n.done, n.done || (e++, p += n.tick(b));
            return d = p / e, r.update(M.tick(b, d)), r.done() || f || s ? (r.update(100), j.trigger("done"), setTimeout(function () {
                return r.finish(), j.running = !1, j.trigger("hide")
            }, Math.max(D.ghostTime, Math.max(D.minTime - (C() - a), 0)))) : c()
        })
    }, j.start = function (a) {
        v(D, a), j.running = !0;
        try {
            r.render()
        } catch (b) {
            i = b
        }
        return document.querySelector(".pace") ? (j.trigger("start"), j.go()) : setTimeout(j.start, 50)
    }, "function" == typeof define && define.amd ? define(function () {
        return j
    }) : "object" == typeof exports ? module.exports = j : D.startOnPageLoad && j.start()
});