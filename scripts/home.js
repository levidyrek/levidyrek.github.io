var main = function() {
	
	// 
	
	// Hide or show elements at first
	$('.slide2').hide();
	$('.slide3').hide();
	$('.projects-menu').hide();
	$('.main-menu').hide();
	$('.slider-nav').show();
	
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
	
	// Functionality of switching between slides and updating the dot indicators
	$('.slides').click(function() {
		var next_slide = $('.active-slide').next();
		var next_dot = $('.active-dot').next();
		
		if ($('.active-slide').hasClass('slide3')) {
			next_slide = $('.slide1');
		}
		
		if ($('.active-dot').hasClass('last-dot')) {
			next_dot = $('.first-dot');
		}
		
		$('.active-slide').fadeOut(600);
		$('.slider-nav').show();
		next_slide.fadeIn(600);
		
		$('.active-dot').removeClass('active-dot');
		next_dot.addClass('active-dot');
		$('.active-slide').removeClass('active-slide');
		next_slide.addClass('active-slide');
	});
}

/*
* Adjusts the positions of the info card and header on the home page
* based on viewport size
*/
/* var adjustView = function() {
	let viewHeight = $('.slides').height();
	$('.)
} */

$(document).ready(main);