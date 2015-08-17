var main = function() {
	$('.slide2').hide();
	$('.slide3').hide();
	$('.dropdown-menu').hide();
	$('.slider-nav').show();
	
	$('.dropdown').mouseover(function() {
		$('.dropdown-menu').show();
	});
	$('.dropdown').mouseout(function() {
		$('.dropdown-menu').hide();
	});
	
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

var slideNext = function() {
		window.alert("Slide function called");
		var next_slide = $('.active-slide').next();
		
		if ($('.active-slide') === $('.slides').last()) {
			next_slide = $('.slides').first();
		}
		
		$(this).fadeOut(600);
		next_slide.fadeIn(600);
		$('.active-slide').removeClass("active-slide");
		next_slide.addClass("active-slide");
}

$(document).ready(main);