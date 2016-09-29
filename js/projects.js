var main = function() {
	loadProjects();
}

function loadProjects() {
	// Retrieve projects from db
	let action = SELECT_TABLE;
	let tableName = "projects";
	let columns = ["id", "title", "pic"];
	$.post("php/query.php", {action: action, table_name: tableName, columns: columns}, makeThumbnails);
}

var makeThumbnails = function(data) {
	if (data) {

		let table = JSON.parse(data);
		for (let key in table) {
			let id = table[key].id;
			let title = table[key].title;
			let pic = table[key].pic;

			// Load template
			$.get("templates/project-thumbnail.html", function(data) {
				let thumbnail = $(data);
				thumbnail.find('#link').attr("href", "#"); // TODO: Update link when possible
				thumbnail.find('#pic').attr("src", pic);
				thumbnail.find('#title').text(title);

				$('.proj-container').append(thumbnail);
			});
		}

	}
}

$(document).ready(main);