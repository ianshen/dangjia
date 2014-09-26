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
});