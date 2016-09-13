var main = function() {
	
	// Hide or show elements at first
	$('.projects-menu').hide();
	$('.main-menu').hide();
	
	// Allows dropdown menu for projects to appear when button is hovered
	$('.projects-button').mouseover(function() {
		$('.projects-menu').show();
	});
	$('.projects-button').mouseout(function() {
		$('.projects-menu').hide();
	});
	
	// Allows main dropdown menu to be shown when menu button is visible (on mobile only)
	$('#menu-a').click(function() {
		$('.main-menu').toggle();
	});
}

$(document).ready(main);