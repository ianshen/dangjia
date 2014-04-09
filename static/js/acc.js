$(function() {
	var $uroot = $CONFIG['uroot'];
	var $wroot = $CONFIG['wroot'];
	var options = {
		dataType : 'json',
		success : function(data) {
			if (data.status == 100000) {
			}
		},
		beforeSubmit : function validate(formData, jqForm, options) {
			var name = $('input#user').val();
			var passwd = $('input#passwd').val();
			if (!name || !passwd) {
				$.scojs_message('请填写帐号或密码', $.scojs_message.TYPE_ERROR);
				//return false;
			}
			//return false;
		}
	};
	$('#loginform').ajaxForm(options);
});