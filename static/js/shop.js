$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var $tmot = $CONFIG['tmot'];
	// 密码设置
	var passOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
				setTimeout(function() {
					window.location.reload(true);
				}, $tmot);
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
				captchachg();
				$("input#captcha").val("");
			}
		},
		beforeSubmit : function() {
			var curpass = $('input#curpass').val();
			var passwd = $('input#passwd').val();
			var cpasswd = $('input#cpasswd').val();
			var captcha = $('input#captcha').val();
			if (!curpass) {
				$.scojs_message('请输入当前密码', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (curpass.length < 6 || curpass.length > 16) {
				$.scojs_message('密码6-16位', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!passwd) {
				$.scojs_message('请输入新密码', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (passwd.length < 6 || passwd.length > 16) {
				$.scojs_message('密码6-16位', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!cpasswd) {
				$.scojs_message('请再次输入密码', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (passwd != cpasswd) {
				$.scojs_message('两次输入的密码不同', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!captcha) {
				$.scojs_message('请输入验证码', $.scojs_message.TYPE_ERROR);
				return false;
			}
		}
	};
	$('#passwordform').ajaxForm(passOptions);
	//暂停营业
	$("table.product-cart-big a.js-store-off").die().live('click',function(){
		var cid = $(this).attr('data-cid');
		art.dialog({
			title : '暂停营业',
			lock: true,
			content : '<div style="color:#666666;font-size:12px;">暂停营业期间，用户将无法再购买您该分类的商品，确定暂停营业吗？</div>',
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'shop/onoff',
					data : {"cid":cid,'op':'off'},
					success : function(data) {
						var data = $.parseJSON(data);
						if (data.status == 100000) {
							$.scojs_message(data.info, $.scojs_message.TYPE_OK);
							setTimeout(function() {
								window.location.reload(true);
							}, $tmot);
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
	//开始营业
	$("table.product-cart-big a.js-store-on").die().live('click',function(){
		var cid = $(this).attr('data-cid');
		art.dialog({
			title : '开始营业',
			lock: true,
			content : '<div style="color:#666666;font-size:12px;">确定开始营业吗？</div>',
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'shop/onoff',
					data : {"cid":cid,'op':'on'},
					success : function(data) {
						var data = $.parseJSON(data);
						if (data.status == 100000) {
							$.scojs_message(data.info, $.scojs_message.TYPE_OK);
							setTimeout(function() {
								window.location.reload(true);
							}, $tmot);
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
	// 密码设置
	var addCateformOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
				setTimeout(function() {
					window.location.reload(true);
				}, $tmot);
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
				captchachg();
				$("input#captcha").val("");
			}
		},
		beforeSubmit : function() {
			var name = $('input#name').val();
			var desc = $('input#desc').val();
			var captcha = $('input#captcha').val();
			if (name.length < 1 || name.length > 16) {
				$.scojs_message('分类名1-16位', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!captcha) {
				$.scojs_message('请输入验证码', $.scojs_message.TYPE_ERROR);
				return false;
			}
		}
	};
	$('#addCateform').ajaxForm(addCateformOptions);
});