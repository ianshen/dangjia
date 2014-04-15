$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var $uroot = $CONFIG['uroot'];
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
		var name = $(this).attr("data-name");
		var id = $(this).attr("data-id");
		var priceDesc = $(this).attr("data-price-desc");
		var price = $(this).attr("data-price");
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/ac',
			data : "proid="+id,
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					var tr = '<tr class="product-item" data-id="666"> \
						<td>TB - Monthly</td> \
						<td><span>9</span></td> \
						<td><span>&nbsp;<em class="quantity-text">3</em>&nbsp;</span></td> \
						</tr>';
					// 先判断购物车中是否含有相同商品
					var trObj=$(".table.product-cart-small").find("tr[data-id='"+id+"']");
					if(trObj.attr("data-id")==null){
						$("tr.js-total-price").before(tr);
					}else{
						var curNumObj=trObj.find("em.quantity-text");
						var curNum = parseInt(curNumObj.text());
						curNumObj.text(curNum + 1);
					}
				}
			}
		});
	});
});