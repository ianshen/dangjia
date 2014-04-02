$(function() {
	$(".product-item").die().hover(
			function() {
				$(this).addClass('warning');
				$(this).find("img").attr("src",
						$CONFIG['wroot'] + "static/img/icon-add-on.gif");
			},
			function() {
				$(this).removeClass('warning');
				$(this).find("img").attr("src",
						$CONFIG['wroot'] + "static/img/icon-add-off.gif");
			});
	$(".img-pick-product").die().hover(function() {
		$(this).addClass('f-csp');
	});
});