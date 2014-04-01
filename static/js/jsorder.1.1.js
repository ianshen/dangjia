(function($) {
	$.fn.jsorder = function(setting) {
		//初始化配置
		var opts = $.extend( {}, $.fn.jsorder.defaults, setting);
		//读取cookeie信息
		var initdata ={};
		if(opts.savecookie && $.cookie(opts.cookiename)!=null&&$.cookie(opts.cookiename)!=''){
		    initdata = eval('(' + $.cookie(opts.cookiename) + ')');
		}
		//初始化购物车
		$("body").data(opts.staticname, initdata); 
		//初始化页面
		var jsorder = $('<div><div>' + opts.leftdemo + '</div><div><ul><li style="text-align:center">'+ opts.nomessage + '</li></ul><div></div></div></div>').attr('class', opts.jsorderclass).appendTo($("body")); 
		var jsorderright = jsorder.find('div:eq(1)').attr('class', 'right');
		var jsorderleft = jsorder.find('div:eq(0)').attr('class', 'left').click(function() {jsorderright.toggle();});
		var slide = {
			//计算金额和数量
			info : function(price, count) {
				return "￥" + price * 10000 * count / 10000 + "(数量:" + count+ ")";
			},
			//增加一个订单项
			addjsorder : function(e) {
				var datejsorder = $("body").data(opts.staticname);
				var id = $(this).attr('id');
				var name = $(this).attr(opts.namefiled);
				var price = $(this).attr(opts.pricefiled);
				if (datejsorder[id] == null || datejsorder[id]['count'] == 0) {
					if (datejsorder[id] == null) {
						datejsorder[id] = {};
					}
					datejsorder[id]['count'] = 1;
					datejsorder[id]['name'] = name;
					datejsorder[id]['price'] = price;
					$("div." + opts.jsorderclass + " ul")
							.append("<li id='"+ opts.jsorderpre+ id+ "'><span>"+ name+ "<br><b>"+ slide.info(price,datejsorder[id]['count'])+ "</b><span  class='del'></span><span  class='sub'></span><span class='add'></span></span></li>");
					$("#" + opts.jsorderpre + id + " span.add").click(function() {
						slide.addjsordernum(name, id, price);
					});
					$("#" + opts.jsorderpre + id + " span.sub").click(function() {
						slide.deljsordernum(name, id, price);
					});
					$("#" + opts.jsorderpre + id + " span.del").click(function() {
						slide.deljsorder(id);
					});
				} else {
					datejsorder[id]['count'] += 1;
					$("#" + opts.jsorderpre + id + " b").html(
							slide.info(price, datejsorder[id]['count']));
				}
				slide.reflash();
			},
			//增加一个订单项数量
			addjsordernum : function(name, id, price) {
				var datejsorder = $("body").data(opts.staticname);
				datejsorder[id]['count'] += 1;
				$("#" + opts.jsorderpre + id + " b").html(
						slide.info(price, datejsorder[id]['count']));
				slide.reflash();
			},
			//减少一个订单项数量
			deljsordernum : function(name, id, price) {
				var datejsorder = $("body").data(opts.staticname);
				datejsorder[id]['count'] -= 1;
				if (datejsorder[id]['count'] > 0) {
					$("#" + opts.jsorderpre + id + " b").html(
							slide.info(price, datejsorder[id]['count']));
				} else {
					$("#" + opts.jsorderpre + id).remove();
				}
				slide.reflash();
			},
			//删除一个订单项
			deljsorder : function(id) {
				var datejsorder = $("body").data(opts.staticname);
				datejsorder[id]['count'] = 0;
				$("#" + opts.jsorderpre + id).remove();
				slide.reflash();
			},
			//提交
			subm : function() {
				opts.dosubmit($("body").data(opts.staticname));
				$("body").data(opts.staticname,{});
				$("div."+opts.jsorderclass+" ul li:eq(0)").show(); 
				$("div."+opts.jsorderclass+" ul li:gt(0)").remove();
	         	$('div.'+opts.jsorderclass+' a.button').remove();
	          	if(opts.savecookie){
		        	var date = new Date();  
		          date.setTime(date.getTime() - (1 * 24 * 60 * 60 ));  
		          $.cookie(opts.cookiename, '', { path: '/', expires: date });   
		        }
			},
			//刷新购物车
			reflash : function() {
				jsorderright.show();
				var data = $("body").data(opts.staticname);
				var size = 0;
				for ( var i in data) {
					if (data[i]['count'] != 0)
						size++;
				}
				if (size > 0) { 
					$("div."+opts.jsorderclass+" ul li:eq(0)").hide(); 
					if ($('div.' + opts.jsorderclass + ' a.button').size() == 0)
						$('<a class="button">' + opts.subbuttom + '</a>')
								.appendTo(jsorderright).click(slide.subm);
				} else {
					$("div."+opts.jsorderclass+" ul li:eq(0)").show(); 
					$('div.' + opts.jsorderclass + ' a.button').remove();
				}
				if (opts.savecookie) {
					var date = new Date();
					date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
					$.cookie(opts.cookiename, JSON.stringify(data), {
						path : '/',
						expires : date
					});
				}
			}
		};
		//初始化购物车
		var data = $("body").data(opts.staticname);
		for ( var id in data) { 
			$("div." + opts.jsorderclass + " ul")
					.append("<li id='"+ opts.jsorderpre+ id+ "'><span>"+ data[id]['name']+ "<br><b>"+ slide.info(data[id]['price'],data[id]['count'])+ "</b><span  class='del'></span><span  class='sub'></span><span class='add'></span></span></li>");
			$("#" + opts.jsorderpre + id + " span.add").data('dd',id).click(function() {var d = $(this).data('dd');slide.addjsordernum(data[d]['name'], d, data[d]['price']);}); 
			$("#" + opts.jsorderpre + id + " span.sub").data('dd',id).click(function() {var d = $(this).data('dd');slide.deljsordernum(data[d]['name'], d,data[d]['price']);});
			$("#" + opts.jsorderpre + id + " span.del").data('dd',id).click(function() {var d = $(this).data('dd');slide.deljsorder(d);});
			slide.reflash();
		}
		$(opts.addbuttom).click(slide.addjsorder);
		return jsorder;
	}
	// 配置
	$.fn.jsorder.defaults = {
		//全局数据-保存订单信息
		staticname : 'jsorder',
		//订单class
		jsorderclass : 'jsorder',
		//是否保存cookie
		savecookie : true,
		//cookie的名字
		cookiename : 'jsorder',
		//ID前缀
		numpre : 'no_',
		//订单项前最
		jsorderpre : 'jsorder_', 
		//价格属性
		pricefiled : 'price',
		//订单项名
		namefiled : 'jsordername',
		//购物车左侧显示
		leftdemo : '我的菜单',
		//提交按钮文字
		subbuttom : '',
		//默认加入订单的控件选择
		addbuttom : 'a.jsorderadd', 
		//没有订单时显示
		nomessage : '你今天的食谱是还空的',
		//提交时触发
		dosubmit : function(data) {
			$("body").append(JSON.stringify(data));
			$("body").data(opts.staticname, {});
		}
	};
})(jQuery);