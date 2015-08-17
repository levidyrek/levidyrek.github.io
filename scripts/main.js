var main = function() {
	$('.dropdown-menu').hide();
	
	$('.dropdown').mouseover(function() {
		$('.dropdown-menu').show();
	});
	$('.dropdown').mouseout(function() {
		$('.dropdown-menu').hide();
	});
}

$(document).ready(main);