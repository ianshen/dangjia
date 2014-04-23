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
});