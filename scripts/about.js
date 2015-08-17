var main = function() {
	var height = $('.navbar').height();
	$('.navbar a').css('height', height);
	
	$('.dropdown-menu').hide();
	
	$('.dropdown').mouseover(function() {
		$('.dropdown-menu').show();
	});
	$('.dropdown').mouseout(function() {
		$('.dropdown-menu').hide();
	});
}

$(document).ready(main);