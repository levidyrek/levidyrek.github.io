// query.php actions
const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

var slides;
var slideIndex = 0;

var main = function() {
	
	// Hide or show elements at first
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

	// Retrieve slides from DB
	retrieveSlides();
}

/**
	Changes the data and background on slide to the next slide and manages the slider dots
**/
var handleSlideChange = function() {
	console.log("Slide change handler called");

	// Unbind click handler for slide container
	$('.slide-container').unbind('click');

	// Switch slider
	let active = $('.active-dot');
	let next = active.next();
	if (active.is(":last-child")) {
		next = $('.first-dot');
		slideIndex = 0;
	}
	else slideIndex++;
	active.removeClass('active-dot');
	next.addClass('active-dot');

	// Change data and background
	changeToSlide(slideIndex);
}

/**
	Loads slide data upon loading of the page. Also sets up slider 
**/
function retrieveSlides() {
	let tableName = "slides";
	let action = SELECT_TABLE;
	$.post("php/query.php", {action: action, table_name: tableName}, function(data) {
		if (data) {
			slides = JSON.parse(data);

			// Add appropriate number of slider dots
			for (let i = 0; i < slides.length; i++) {
				let dot = $("<li class='dot'>&bull;</li>");
				if (i == 0) dot.addClass("first-dot active-dot");
				if (i + 1 >= slides.length) dot.addClass("last-dot");
				$('.slider-dots').append(dot);
			}

			// Set up first slide
			changeToSlide(0);
		}

	});
}

/**
	Creates a copy of given slide, fills in new data and inserts it behind the current slide.
	This is for aesthetic purposes, so that fading out slides looks right.
**/
function changeToSlide(i) {
	console.log("Slide being change");

	let slideData = slides[i];
	let current = $('.slide');
	let next = current.clone();
	next.insertBefore(current);

	// Header
	next.find('.info h2').text(slideData.title);
	// List items
	let items = slideData.items.split('\n');
	let card = next.find('.info ul');
	card.empty();	
	for (let key in items) {
		card.append($('<li>' + items[key] + "</li>"));
	}
	// Background
	next.css("background-image", "url(" + slideData.background + ")");
	
	
	current.fadeOut(600, function() {
		console.log("Fade out finished");
		current.remove();

		// Handle slide change
		if (slides.length > 1) $('.slide-container').click(handleSlideChange);
	});
}

$(document).ready(main);