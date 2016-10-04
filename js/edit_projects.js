const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

var main = function() {
	// Set up buttons
	$('#submit_button').click(addProject);
	$('#update_button').click(updateProject);
	$('#delete_button').click(deleteProject);
	
	// Hide these for now
	$('#update_button').hide();
	$('#delete_button').hide();
	
	// Make it possible to edit existing project
	setupSelect();
}

function setupSelect() {
	// Retrieve projects from db
	
	let select = $('#proj_select');
	select.empty();

	$.get("../php/get_projects.php", function(data) {
		if (data) {
			
			let table = JSON.parse(data);
			for (let key in table) {
				let id = table[key].id;
				let title = table[key].title;
				
				select.append($('<option value="' + id + '">' + title + '</option>'));
			}
			
			// Handle when the load button is invoked
			$('#load_button').click(loadProject);
		}
	});
}

var loadProject = function() {
	// Submit an AJAX request for the specified row
	let id = $('select').val();

	$.get("../php/get_project_by_id.php", {id: id}, function(data) {
		if (data) {
			let table = JSON.parse(data);
			let project = table[0];

			// Populate fields
			$('#title').val(project.title);
			$('#pic').val(project.pic);
			$('#brief').val(project.brief);
			$('#description').val(project.description);

			// Set id for later use
			sessionStorage.setItem("proj_id", project.id);

			// Hide submit button, show update and delete buttons and handle clicks
			$('#submit_button').hide();
			$('#update_button').show();
			$('#delete_button').show();
		}
	});
}

var updateProject = function() {
	let id = sessionStorage.getItem("proj_id");
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
		resetForm();
	});
}

var deleteProject = function() {
	let id = sessionStorage.getItem("proj_id");

	let action = REMOVE_ROW;
	let tableName = "projects";
	let queries = ["id=" + id];

	$.post("../php/query.php", {action: action, table_name: tableName, queries: queries}, function(data) {
		alert(data);
		resetForm();
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
			resetForm();
		});
	} 
	else alert("Please fill in all fields.");
}

function resetForm() {
	// Clear text boxes
	$('#title').val("");
	$('#pic').val("");
	$('#brief').val("");
	$('#description').val("");
	
	// Show/Hide proper buttons
	$('#submit_button').show();
	$('#update_button').hide();
	$('#delete_button').hide();
	
	// Re-setup the dropdown
	setupSelect();
}

$(document).ready(main);
