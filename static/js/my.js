$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var $tmot = $CONFIG['tmot'];
	// 帐号设置
	var accountOptions = {
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
			var email = $('input#email').val();
			var mobile = $('input#mobile').val();
			var name = $('input#name').val();
			if (!email) {
				$.scojs_message('请填写常用邮箱', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (email.length > 32) {
				$.scojs_message('邮箱最多32位', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!isEmail(email)) {
				$.scojs_message('请填写正确的邮箱', $.scojs_message.TYPE_ERROR);
				return false;
			}
			/*if (!mobile) {
				$.scojs_message('请填写常用手机号', $.scojs_message.TYPE_ERROR);
				return false;
			}*/
			if (mobile && !isMobile(mobile)) {
				$.scojs_message('请填写正确的手机号', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (name.length > 16) {
				$.scojs_message('名称最多16位', $.scojs_message.TYPE_ERROR);
				return false;
			}
		}
	};
	$('#accountform').ajaxForm(accountOptions);
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
	// 圈子/修改按钮
	$("table.product-cart-big a.js-mod-detail").die().live('click', function() {
		var gid = $(this).attr('data-gid');
		var trObj = $("table.product-cart-big").find("tr[data-gid='"+gid+"']");
		var value = trObj.find("td.js-group-detail span.js-addr-desc-input input.js-addr-desc").val();
		var content = '<input id="addr_desc" class="input-large" type="text" placeholder="如：B座3号楼4层" value="'+value+'">';
		art.dialog({
			title : '修改详细地址',
			lock: true,
			content : content,
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				var detail = $("input#addr_desc").val();
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'my/setaddrdesc',
					data : {"gid":gid,'detail':detail},
					success : function(data) {
						var data = $.parseJSON(data);
						if (data.status == 100000) {
							$.scojs_message(data.info, $.scojs_message.TYPE_OK);
							trObj.find("td.js-group-detail span.js-addr-desc-text").text(detail);
							trObj.find("td.js-group-detail span.js-addr-desc-input input.js-addr-desc").val(detail);
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
	//退出圈子
	$("table.product-cart-big a.js-quit-group").die().live('click',function(){
		var gid = $(this).attr('data-gid');
		var trObj = $("table.product-cart-big").find("tr[data-gid='"+gid+"']");
		art.dialog({
			title : '退出圈子',
			lock: true,
			content : '<div style="color:#666666;font-size:12px;">确定退出此圈子吗？</div>',
			okValue : '确定',
			cancelValue : '取消',
			width : '15em',
			ok : function() {
				$.ajax({
					async : false,
					type : "POST",
					url : $uroot + 'my/quitgroup',
					data : {"gid":gid},
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
	//更多按钮
	$("#js-show-more").die().live('click',function(){
		$("#js-more-settings").toggle();
	});
	//加入新的圈子
	var joingroupOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
				setTimeout(function() {
					window.location.reload(true);
				}, $tmot);
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
				$("#captcha_img").attr("src",$uroot + 'acc/captcha?'+(new Date()).getTime());
			}
		},
		beforeSubmit : function() {
			var city = parseInt($('select#city').val());
			var area = parseInt($('select#area').val());
			var group = parseInt($('select#group').val());
			var addr_desc = $('input#addr_desc').val();
			if (!city) {
				$.scojs_message('请选择城市', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!area) {
				$.scojs_message('请选择区域', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!group) {
				$.scojs_message('请选择圈子', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!addr_desc) {
				$.scojs_message('请填写详细位置', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (addr_desc.length > 32) {
				$.scojs_message('详细位置最多32位', $.scojs_message.TYPE_ERROR);
				return false;
			}
		}
	};
	$('#joingroupform').ajaxForm(joingroupOptions);
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
});