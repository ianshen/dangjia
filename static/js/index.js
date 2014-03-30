$(function() {
	var $webroot = $CONFIG['webroot'];
	//选择城市
	$("#selcity ul.dropdown-menu li a").die().live("click", function() {
		var curElem = $(this);
		var id = parseInt($(this).attr("data-id"));
		if (id) {
			$.get($webroot + "acc/getlocation", {
				ajax : "1",
				t : "c",
				id : id
			}, function(data) {
				data = $.parseJSON(data);
				if (data.status == '100000') {
					$("#selcity button.jsBtLabel").text(curElem.attr("data-name"));
					$("#selarea ul.dropdown-menu").empty().append(data.data);
				}
			});
		}
	});

	//选择地区
	$("#selarea ul.dropdown-menu li a").die().live("click", function() {
		var curElem = $(this);
		var id = parseInt($(this).attr("data-id"));
		if (id) {
			$.get($webroot + "acc/getlocation", {
				ajax : "1",
				t : "a",
				id : id
			}, function(data) {
				data = $.parseJSON(data);
				if (data.status == '100000') {
					$("#selarea button.jsBtLabel").text(curElem.attr("data-name"));
					$("#selgroup ul.dropdown-menu").empty().append(data.data);
				}
			});
		}
	});
	
	//选择圈子
	$("#selgroup ul.dropdown-menu li a").die().live("click", function() {
		var id = parseInt($(this).attr("data-id"));
		var name = $(this).attr("data-name");
		if(id){
			$(this).parent().addClass("active").siblings().removeClass("active");
			$("#selgroup button.jsBtLabel").text($(this).attr("data-name"));
			$("#selgroup button.jsBtLabel").attr('data-id',id);
			$("#selgroup button.jsBtLabel").attr('data-name',name);
		}
	});
	
	//跳转去选定圈子
	$("#go").die().live('click', function() {
		var id = $("#selgroup button.jsBtLabel").attr("data-id");
		if (id) {
			window.location.href = $webroot + "g/" + id;
		}
	});
});