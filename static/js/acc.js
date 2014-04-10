$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var options = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {

			} else {
				$.scojs_message(data.info, $.scojs_message.TYPE_ERROR);
			}
		},
		beforeSubmit : function(formData, jqForm, options) {
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
	$('#loginform').ajaxForm(options);
});