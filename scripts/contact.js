var main = function() {
	/** This block of code adjusts the size of the <a> elements in the menu so that when hovered,
		the background matches the bounds of the navbar
	*/
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
	// Corrects position of dropdown menu
	$('.dropdown-menu').css('top', $('.navbar').outerHeight() + 1 + 'px');
	var ddLeft = $('.dropdown-menu').position().left - 
		(($('.dropdown-menu').width() - $('.dropdown-toggle').width()) / 4.0); // dropdown left position
	$('.dropdown-menu').css('left', ddLeft); // centers dropdown beneath button
	
	$('.dropdown-menu').hide();
	
	$('.dropdown').mouseover(function() {
		$('.dropdown-menu').show();
	});
	$('.dropdown').mouseout(function() {
		$('.dropdown-menu').hide();
	});
}

$(document).ready(main);