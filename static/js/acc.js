$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	// 加载城市列表
	$.get($uroot + "acc/getlocation", {
		ajax : "1",
		t : "c",
		id : 0,
		type : "select"
	}, function(data) {
		data = $.parseJSON(data);
		if (data.status == '100000') {
			var html = '<option value="0">选择城市</option>';
			$("select#city").html(html + data.data);
		}
	});
	// 选择城市
	$("select#city").die().live("change", function() {
		var id = parseInt($(this).val());
		if (id) {
			$.get($uroot + "acc/getlocation", {
				ajax : "1",
				t : "c",
				id : id,
				type : "select"
			}, function(data) {
				data = $.parseJSON(data);
				if (data.status == '100000') {
					var html = '<option value="0">选择区域</option>';
					$("select#area").html(html + data.data);
				}
			});
		} else {
			$("select#area").html('<option value="0">选择区域</option>');
			$("select#group").html('<option value="0">选择圈子</option>');
		}
	});
	// 选择区域
	$("select#area").die().live("change", function() {
		var id = parseInt($(this).val());
		if (id) {
			$.get($uroot + "acc/getlocation", {
				ajax : "1",
				t : "a",
				id : id,
				type : "select"
			}, function(data) {
				data = $.parseJSON(data);
				if (data.status == '100000') {
					var html = '<option value="0">选择圈子</option>';
					$("select#group").html(html + data.data);
				}
			});
		} else {
			$("select#group").html('<option value="0">选择圈子</option>');
		}
	});
	// 选择圈子
	$("select#group").die().live("change", function() {
		var id = parseInt($(this).val());
		if (id) {
			$.get($uroot + "acc/getgroup", {
				ajax : "1",
				f : "addr_desc_template",
				id : id
			}, function(data) {
				data = $.parseJSON(data);
				if (data.status == '100000') {
					var txt = '如：' + data.data;
					$("input.js-addr-desc").attr("placeholder", txt);
					$("span.js-addr-desc").text(txt);
				}
			});
		}
	});
	// login
	var loginOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
			}
		},
		beforeSubmit : function() {
			var name = $('input#user').val();
			var passwd = $('input#passwd').val();
			if (!name || !passwd) {
				$.scojs_message('请填写帐号或密码', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (name.length > 32) {
				$.scojs_message('帐号最多32位', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!isEmail(name) && !isMobile(name)) {
				$.scojs_message('请填写正确的邮箱或手机号', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (passwd.length < 6 || passwd.length > 16) {
				$.scojs_message('密码6-16位', $.scojs_message.TYPE_ERROR);
				return false;
			}
		}
	};
	$('#loginform').ajaxForm(loginOptions);
	// reg
	var regOptions = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
				$.scojs_message(data.info, $.scojs_message.TYPE_OK);
				window.location.href = $uroot + "acc/login";
			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
			}
		},
		beforeSubmit : function() {
			var email = $('input#email').val();
			var mobile = $('input#mobile').val();
			var city = parseInt($('select#city').val());
			var area = parseInt($('select#area').val());
			var group = parseInt($('select#group').val());
			var addr_desc = $('input#addr_desc').val();
			var passwd = $('input#passwd').val();
			var cpasswd = $('input#cpasswd').val();
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
			if (!mobile) {
				$.scojs_message('请填写常用手机号', $.scojs_message.TYPE_ERROR);
				return false;
			}
			if (!isMobile(mobile)) {
				$.scojs_message('请填写正确的手机号', $.scojs_message.TYPE_ERROR);
				return false;
			}
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
			if (!passwd) {
				$.scojs_message('请输入密码', $.scojs_message.TYPE_ERROR);
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
		}
	};
	$('#regform').ajaxForm(regOptions);
});