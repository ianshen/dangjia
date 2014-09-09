$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	//删除订单
	$("table.product-cart-big a.js-order-del").die().live('click',function(){
		var oid = $(this).attr('data-oid');
		art.dialog({
			title : '删除订单',
			lock: true,
			content : '<div style="color:#666666;font-size:12px;">确定删除该订单吗？</div>',
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'order/del',
					data : {"oid":oid},
					success : function(data) {
						var data = $.parseJSON(data);
						if (data.status == 100000) {
							$.scojs_message(data.info, $.scojs_message.TYPE_OK);
							setTimeout(function() {
								window.location.reload(true);
							}, 3000);
						}else{
							$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
							return false;
						}
					}
				});
			},
			cancel:function(){
				
			}
		});
	});
});