const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

var main = function() {
	// Set up buttons
	$('#submit_button').click(addSlide);
	$('#update_button').click(updateSlide);
	$('#delete_button').click(deleteSlide);
	
	// Hide these for now
	$('#update_button').hide();
	$('#delete_button').hide();
	
	// Make it possible to edit existing slide
	setupSelect();
}

function setupSelect() {
	// Retrieve slides from db
	var action = SELECT_TABLE;
	var tableName = "slides";
	var columns = ["id", "title"];
	
	let select = $('#slide_select');
	select.empty();

	$.post("../php/query.php", {action: action, table_name: tableName, columns: columns}, function(data) {
		if (data) {
			let table = JSON.parse(data);
			for (let key in table) {
				let id = table[key].id;
				let title = table[key].title;
				
				select.append($('<option value="' + id + '">' + title + '</option>'));
			}
			
			// Handle when the load button is invoked
			$('#load_button').click(loadSlide);
		}
	});
}

var loadSlide = function() {
	// Submit an AJAX request for the specified row
	let id = $('select').val();
	let action = SELECT_TABLE;
	let tableName = "slides";
	let queries = ["id=" + id];

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries}, function(data) {
		if (data) {
			let table = JSON.parse(data);
			let slide = table[0];

			// Populate fields
			$('#title').val(slide.title);
			$('#items').val(slide.items);
			$('#background').val(slide.background);

			// Set id for later use
			sessionStorage.setItem("slide_id", slide.id);

			// Hide submit button, show update and delete buttons and handle clicks
			$('#submit_button').hide();
			$('#update_button').show();
			$('#delete_button').show();
		}
	});
}

var updateSlide = function() {
	let id = sessionStorage.getItem("slide_id");
	let title = $('#title').val();
	let items = $('#items').val();
	let background = $('#background').val();

	let action = UPDATE_TABLE;
	let tableName = "slides";
	let queries = ["id=" + id];
	let values = {title: title, items: items, background: background};

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries, values: values}, function(data) {
		// Restore buttons to default state

		$('#submit_button').hide();
		$('#update_button').show();
		$('#delete_button').show();
		
		alert(data);
		resetForm();
	});
}

var deleteSlide = function() {
	let id = sessionStorage.getItem("slide_id");

	let action = REMOVE_ROW;
	let tableName = "slides";
	let queries = ["id=" + id];

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries}, function(data) {
		alert(data);
		resetForm();
	});
}

var addSlide = function() {
	let title = $('#title').val();
	let items = $('#items').val();
	let background = $('#background').val();

	// First, check that all fields are filled
	if (title && items && background) {
		// Send an AJAX request
		let action = ADD_ROW;
		let tableName = "slides";
		let values = {title: title, items: items, background: background};
		$.post("../php/query.php", {action: action, table_name: tableName, values: values}, function(data) {
			alert(data);
			resetForm();
		});
	} 
	else alert("Please fill in all fields.");
}

function resetForm() {
	// Clear text boxes
	$('#title').val("");
	$('#items').val("");
	$('#background').val("");
	
	// Show/Hide proper buttons
	$('#submit_button').show();
	$('#update_button').hide();
	$('#delete_button').hide();
	
	// Re-setup the dropdown
	setupSelect();
}

$(document).ready(main);
