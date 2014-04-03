$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	// 商品列表table hover事件
	$(".product-item").die().hover(
			function() {
				$(this).addClass('warning');
				$(this).find("img").attr("src",
						$wroot + "static/img/icon-add-on.gif");
			},
			function() {
				$(this).removeClass('warning');
				$(this).find("img").attr("src",
						$wroot + "static/img/icon-add-off.gif");
			});
	// 加入购物车图标hover
	$("img.add-to-cart").die().hover(function() {
		$(this).addClass('f-csp');
	});
	// 加入购物车
	$("img.add-to-cart").die().live('click', function() {
		// 先判断购物车中是否含有相同商品
	});
	// 购物车数量减一
	$("a.js-decrement").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		if (curNum <= 1) {
			confirm("确定从购物车中删除此商品？");
		}
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/uc',
			data : "",
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					// 更新数量
					curNumObj.text(curNum - 1);
					// 更新总价
				}
			}
		});
	});
	// 购物车数量加一
	$("a.js-increment").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		curNumObj.text(curNum + 1);
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/uc',
			data : "",
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					// 更新数量
					curNumObj.text(curNum - 1);
					// 更新总价
				}
			}
		});
	});
});