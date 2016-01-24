var main = function() {
	
	/*/** This block of code adjusts the size of the <a> elements in the menu so that when hovered,
		the background matches the bounds of the navbar
	*/
	/*
	var current = $('.menu li').first(); //current list item in navbar
	var nested = current.children().first(); //nested <a> element in current list item
	var aTop = nested.position().top; //top position of <a> elements in list
	var aBot = aTop + nested.outerHeight(true); //bottom position of <a> elements in list
	var count = $('.menu li').length - $('.dropdown li').length; // number of visible navbar list elements
	var navBot = 0 + $('.navbar').outerHeight(true); //navbar bottom position
	for (var i = 0; i < count; i++) { // Corrects padding for each navbar element to fit inside navbar
		nested = current.children().first();
		nested.css('padding-top', aTop);
		nested.css('padding-bottom', navBot - aBot);
		current = current.next();
	}
	*/
	
	/*// Corrects position of dropdown menu
	$('.dropdown-menu').css('top', $('.navbar').outerHeight() + 1 + 'px');
	var ddLeft = $('.projects-menu').position().left - 
		(($('.projects-menu').width() - $('.dropdown-toggle').width()) / 4.0); // dropdown left position
	$('.dropdown-menu').css('left', ddLeft); // centers dropdown beneath button */
	
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
	
	// Restive API stuff. Currently configured to add classes to indicate when page is accessed via mobile
	// devices, orientation, etc.
	$('body').restive({
          breakpoints: ['10000'],
          classes: ['nb'],
          turbo_classes: 'is_mobile=mobi,is_phone=phone,is_tablet=tablet,is_landscape=landscape'
    });
}

$(document).ready(main);