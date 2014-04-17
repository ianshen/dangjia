$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	$(".product-item").die().hover(function() {
		$(this).addClass('warning');
	}, function() {
		$(this).removeClass('warning');
	});
	// 购物车数量减一
	$("a.js-decrement").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		var id = $(this).parent().parent().attr("data-id");
		if (curNum <= 1) {
			art.dialog({
				id : 'id-js-rm-product',
				title : '删除商品',
				follow : this,
				content : '<div style="color:#666666;font-size:12px;">确定删除此商品吗？</div>',
				okValue : '确定',
				width : '15em',
				ok : function() {
					$.ajax({
						async : false,
						type : "POST",
						url : $uroot + 'order/uc',
						data : "type=dec&proid="+id,
						success : function(data) {
							var data = $.parseJSON(data);
							if (data.status == 100000) {
								$(".table.product-cart").find("tr[data-id='"+id+"']").remove();
								var len=$(".table.product-cart tbody tr").length;
								if (len < 1) {
									window.location.reload(true);
								}
							}
						}
					});
				}
			});
		}else{
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
		}
	});
	// 购物车数量加一
	$("a.js-increment").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/uc',
			data : "type=inc&proid="+id,
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					// 更新数量
					curNumObj.text(curNum + 1);
					// 更新总价
				}
			}
		});
	});
	// 删除商品
	$("a.js-rm-product").die().live("click", function() {
		var obj=$(this);
		var id=obj.attr("data-id");
		art.dialog({
			id : 'id-js-rm-product',
			title : '删除商品',
			follow : this,
			content : '<div style="color:#666666;font-size:12px;">确定删除此商品吗？</div>',
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'order/uc',
					data : "type=rm&proid=" + id,
					success : function(data) {
						var data = $.parseJSON(data);
						if (data.status == 100000) {
							window.location.reload(true);
							/*$(".table.product-cart").find("tr[data-id='"+id+"']").remove();
							var len=$(".table.product-cart tbody tr").length;
							if (len < 1) {
								window.location.reload(true);
							}*/
						}
					}
				});
			},
			cancel:function(){}
		});
	});
});