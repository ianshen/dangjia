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
});