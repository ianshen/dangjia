$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var isLogin = $CONFIG['islogin'];
	$(".product-item").die().hover(function() {
		$(this).addClass('warning');
	}, function() {
		$(this).removeClass('warning');
	});
	// 购物车数量减一
	$("a.js-decrement").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		var id = $(this).attr("data-id");
		var price = parseInt($(this).attr("data-price"));
		if (curNum <= 1) {
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
						data : "type=rm&proid="+id,
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
				cancel:function(){
					
				}
			});
		}else{
			$.ajax({
				async : false,
				type : "POST",
				url : $uroot + 'order/uc',
				data : "type=dec&proid="+id,
				success : function(data) {
					var data = $.parseJSON(data);
					if (data.status == 100000) {
						// 更新数量
						var trObj = $(".table.product-cart-big").find("tr[data-id='"+id+"']");
						var totalPrice = 0;
						var thisTotalPrice = 0;
						curNum = curNum - 1;
						thisTotalPrice = curNum*price;
						curNumObj.text(" "+curNum+" ");
						trObj.attr("data-total-price" , thisTotalPrice);
						// 更新总价
						$("table.product-cart-big tbody tr.js-product-incart").each(function(){
							totalPrice += parseInt($(this).attr('data-total-price'));
						});
						$("#total-price").text("¥" + totalPrice);
					}
				}
			});
		}
	});
	// 购物车数量加一
	$("a.js-increment").die().live("click", function() {
		var curNumObj = $(this).parent().find("em.quantity-text");
		var curNum = parseInt(curNumObj.text());
		var id = $(this).attr("data-id");
		var price = parseInt($(this).attr("data-price"));
		$.ajax({
			async : false,
			type : "POST",
			url : $uroot + 'order/uc',
			data : "type=inc&proid="+id,
			success : function(data) {
				var data = $.parseJSON(data);
				if (data.status == 100000) {
					// 更新数量
					var trObj = $(".table.product-cart-big").find("tr[data-id='"+id+"']");
					var totalPrice = 0;
					var thisTotalPrice = 0;
					curNum = curNum + 1;
					thisTotalPrice = curNum*price;
					curNumObj.text(" "+curNum+" ");
					trObj.attr("data-total-price" , thisTotalPrice);
					// 更新总价
					$("table.product-cart-big tbody tr.js-product-incart").each(function(){
						totalPrice += parseInt($(this).attr('data-total-price'));
					});
					$("#total-price").text("¥" + totalPrice);
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
	// 提交订单
	var goOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
				setTimeout(function() {
					
				}, 3000);
			} else if(data.status == 100002) {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
				setTimeout(function() {
					var curUrl = window.location.href;
					window.location.href = $uroot + "acc/login?returnUrl=" + urlencode(curUrl);
				}, 3000);
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
			}
		},
		beforeSubmit : function() {
			var mobile = $('input#mobile').val();
			var receiver = $('input#receiver').val();
			var addr_desc = $('input#addr_desc').val();
			if(isLogin){
				if (!mobile) {
					$.scojs_message('请填写常用手机号', $.scojs_message.TYPE_ERROR);
					return false;
				}
				if (!isMobile(mobile)) {
					$.scojs_message('请填写正确的手机号', $.scojs_message.TYPE_ERROR);
					return false;
				}
				if (receiver.length>16) {
					$.scojs_message('收货人姓名最多16位', $.scojs_message.TYPE_ERROR);
					return false;
				}
			}
		}
	};
	$('#goform').ajaxForm(goOptions);
});