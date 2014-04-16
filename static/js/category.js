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
		var price = parseInt($(this).attr("data-price"));
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/ac',
			data : "proid=" + id,
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					// 先判断购物车中是否含有相同商品
					var trObj = $(".table.product-cart-small").find("tr[data-id='"+id+"']");
					var totalPrice = 0;
					var thisTotalPrice = 0;
					if(trObj.attr("data-id") == null){
						var tr = '<tr class="product-item js-product-incart" data-total-price="'+ price +'" data-id="' + id + '"> \
						<td>'+ name +'</td> \
						<td><span>'+ price +'</span></td> \
						<td><span>&nbsp;<em class="quantity-text">1</em>&nbsp;</span></td> \
						</tr>';
						$("tr.js-total-price").before(tr);
					}else{
						var curNumObj = trObj.find("em.quantity-text");
						var curNum = parseInt(curNumObj.text()) + 1;
						curNumObj.text(curNum);
						thisTotalPrice = curNum*price;
						trObj.attr("data-total-price" , thisTotalPrice);
					}
					// 计算总价
					$("table.product-cart-small tbody tr.js-product-incart").each(function(){
						totalPrice += parseInt($(this).attr('data-total-price'));
					});
					$("#total-price").text("¥" + totalPrice);
				}
			}
		});
	});
});