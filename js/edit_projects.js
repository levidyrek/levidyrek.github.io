const GET_TABLE = 100;
const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

var main = function() {
	// Set up buttons
	$('#submit_button').click(addProject);
	$('#update_button').click(updateProject);
	$('#delete_button').click(deleteProject);

	// Make it possible to edit existing project
	// Retrieve projects from db
	var action = SELECT_TABLE;
	var tableName = "projects";
	var columns = ["id", "title"];

	$.post("../php/query.php", {action: action, table_name: tableName, columns: columns}, function(data) {
		if (data) {
			alert(data);
			let select = $('#proj_select');
			
			let table = JSON.parse(data);
			for (let row in table) {
				let id = row.id;
				let title = row.title;
				
				select.append($('<option value="' + id + '">' + title + '</option>'));
			}
			
			// Handle when the load button is invoked
			$('load_button').click(loadProject);
		}
	});
}

var loadProject = function() {
	// Submit an AJAX request for the specified row
	let id = $('select').val();
	let action = SELECT_TABLE;
	let tableName = "projects";
	let queries = ["id=" + id];

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries}, function(data) {
		if (data) {
			let table = JSON.parse(data);
			let project = table[0];

			// Populate fields
			$('#title').text(project["title"]);
			$('#pic').text(project["pic"]);
			$('#brief').text(project["brief"]);
			$('#description').text(project["description"]);

			// Set id for later use
			if (typeof(Storage) !== "undefined") {
				sessionStorage.setItem("proj_id", project["id"]);
			} else alert("Web Storage not supported");

			// Hide submit button, show update and delete buttons and handle clicks
			$('#submit_button').hide();
			$('#update_button').show();
			$('#delete_button').show();
		}
	});
}

var updateProject = function() {
	let id = sessionStorage.getItem("id");
	let title = $('#title').val();
	let pic = $('#pic').val();
	let brief = $('#brief').val();
	let description = $('#description').val();

	let action = UPDATE_TABLE;
	let tableName = "projects";
	let queries = ["id=" + id];
	let values = {title: title, pic: pic, brief: brief, description: description};

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries, values: values}, function(data) {
		// Restore buttons to default state

		$('#submit_button').hide();
		$('#update_button').show();
		$('#delete_button').show();
		alert(data);
	});
}

var deleteProject = function() {
	let id = sessionStorage.getItem("id");

	let action = REMOVE_ROW;
	let tableName = "projects";
	let queries = ["id=" + id];

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries}, function(data) {
		alert(data);
	});
}

var addProject = function() {
	let title = $('#title').val();
	let pic = $('#pic').val();
	let brief = $('#brief').val();
	let description = $('#description').val();

	// First, check that all fields are filled
	if (title && pic && brief && description) {
		// Send an AJAX request
		let action = ADD_ROW;
		let tableName = "projects";
		let values = {title: title, pic: pic, brief: brief, description: description};
		$.post("../php/query.php", {action: action, table_name: tableName, values: values}, function(data) {
			alert(data);
		});
	} 
	else alert("Please fill in all fields.");
}

$(document).ready(main);
