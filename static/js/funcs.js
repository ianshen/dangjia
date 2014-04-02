/*
 Date: 2014-01-21 
 */
function login() {
    return location.href = "https://passport.jd.com/new/login.aspx?ReturnUrl=" + escape(location.href).replace(/\//g, "%2F"), !1
}
function regist() {
    return location.href = "https://reg.jd.com/reg/person?ReturnUrl=" + escape(location.href), !1
}
function createCookie(a, b, c, d) {
    var d = d ? d : "/";
    if (c) {
        var e = new Date;
        e.setTime(e.getTime() + 1e3 * 60 * 60 * 24 * c);
        var f = "; expires=" + e.toGMTString()
    } else var f = "";
    document.cookie = a + "=" + b + f + "; path=" + d
}
function readCookie(a) {
    for (var b = a + "=", c = document.cookie.split(";"), d = 0; d < c.length; d++) {
        for (var e = c[d]; " " == e.charAt(0);)e = e.substring(1, e.length);
        if (0 == e.indexOf(b))return e.substring(b.length, e.length)
    }
    return null
}
function addToFavorite() {
    var a = "http://www.jd.com/", b = "\u4eac\u4e1cJD.COM-\u7f51\u8d2d\u4e0a\u4eac\u4e1c\uff0c\u7701\u94b1\u53c8\u653e\u5fc3";
    document.all ? window.external.AddFavorite(a, b) : window.sidebar && window.sidebar.addPanel ? window.sidebar.addPanel(b, a, "") : alert("\u5bf9\u4e0d\u8d77\uff0c\u60a8\u7684\u6d4f\u89c8\u5668\u4e0d\u652f\u6301\u6b64\u64cd\u4f5c!\n\u8bf7\u60a8\u4f7f\u7528\u83dc\u5355\u680f\u6216Ctrl+D\u6536\u85cf\u672c\u7ad9\u3002"), createCookie("_fv", "1", 30, "/;domain=jd.com")
}
function search(a) {
    var b = "http://search.jd.com/Search?keyword={keyword}&enc={enc}{additional}", c = search.additinal || "", d = document.getElementById(a), e = d.value;
    if (e = e.replace(/^\s*(.*?)\s*$/, "$1"), e.length > 100 && (e = e.substring(0, 100)), "" == e)return window.location.href = window.location.href, void 0;
    var f = 0;
    "undefined" != typeof window.pageConfig && "undefined" != typeof window.pageConfig.searchType && (f = window.pageConfig.searchType);
    var g = "&cid{level}={cid}", h = "string" == typeof search.cid ? search.cid : "", i = "string" == typeof search.cLevel ? search.cLevel : "", j = "string" == typeof search.ev_val ? search.ev_val : "";
    switch (f) {
        case 0:
            break;
        case 1:
            i = "-1", c += "&book=y";
            break;
        case 2:
            i = "-1", c += "&mvd=music";
            break;
        case 3:
            i = "-1", c += "&mvd=movie";
            break;
        case 4:
            i = "-1", c += "&mvd=education";
            break;
        case 5:
            var k = "&other_filters=%3Bcid1%2CL{cid1}M{cid1}[cid2]";
            switch (i) {
                case"51":
                    g = k.replace(/\[cid2]/, ""), g = g.replace(/\{cid1}/g, "5272");
                    break;
                case"52":
                    g = k.replace(/\{cid1}/g, "5272"), g = g.replace(/\[cid2]/, "%3Bcid2%2CL{cid}M{cid}");
                    break;
                case"61":
                    g = k.replace(/\[cid2]/, ""), g = g.replace(/\{cid1}/g, "5273");
                    break;
                case"62":
                    g = k.replace(/\{cid1}/g, "5273"), g = g.replace(/\[cid2]/, "%3Bcid2%2CL{cid}M{cid}");
                    break;
                case"71":
                    g = k.replace(/\[cid2]/, ""), g = g.replace(/\{cid1}/g, "5274");
                    break;
                case"72":
                    g = k.replace(/\{cid1}/g, "5274"), g = g.replace(/\[cid2]/, "%3Bcid2%2CL{cid}M{cid}");
                    break;
                case"81":
                    g = k.replace(/\[cid2]/, ""), g = g.replace(/\{cid1}/g, "5275");
                    break;
                case"82":
                    g = k.replace(/\{cid1}/g, "5275"), g = g.replace(/\[cid2]/, "%3Bcid2%2CL{cid}M{cid}")
            }
            b = "http://search.e.jd.com/searchDigitalBook?ajaxSearch=0&enc=utf-8&key={keyword}&page=1{additional}";
            break;
        case 6:
            i = "-1", b = "http://music.jd.com/8_0_desc_0_0_1_15.html?key={keyword}"
    }
    if ("string" == typeof h && "" != h && "string" == typeof i) {
        var l = /^(?:[1-8])?([1-3])$/;
        i = "-1" == i ? "" : l.test(i) ? RegExp.$1 : "";
        var m = g.replace(/\{level}/, i);
        m = m.replace(/\{cid}/g, h), c += m
    }
    if ("string" == typeof j && "" != j && (c += "&ev=" + j), "undefined" != typeof $o.click && $o.click !== !1 && "undefined" != typeof $o.lastKeyword && $o.lastKeyword !== !1)try {
        JA.tracker.ngloader("search.000002", {prefix:$o.lastKeyword, keyword:e, pos:$o.click})
    } catch (n) {
    }
    e = encodeURIComponent(e), sUrl = b.replace(/\{keyword}/, e), sUrl = sUrl.replace(/\{enc}/, "utf-8"), sUrl = sUrl.replace(/\{additional}/, c), ("undefined" == typeof search.isSubmitted || 0 == search.isSubmitted) && (setTimeout(function () {
        window.location.href = sUrl
    }, 10), search.isSubmitted = !0)
}
function str_replace(search, replace, subject, count) {
    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,
        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = Object.prototype.toString.call(r) === '[object Array]',
        sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);

    if (typeof(search) === 'object' && typeof(replace) === 'string') {
        temp = replace;
        replace = new Array();
        for (i = 0; i < search.length; i += 1) {
            replace[i] = temp;
        }
        temp = '';
        r = [].concat(replace);
        ra = Object.prototype.toString.call(r) === '[object Array]';
    }

    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp)
                .split(f[j])
                .join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}