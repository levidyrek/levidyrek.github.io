var main = function() {
	loadProjects();
}

function loadProjects() {
	// Retrieve projects from db
	$.get("php/get_projects.php", makeThumbnails);
}

var makeThumbnails = function(data) {
	if (data) {

		let table = JSON.parse(data);

		// Load template
		$.get("templates/project-thumbnail.html", function(data) {
			let template = $(data);

			for (let key in table) {
				let id = table[key].id;
				let title = table[key].title;
				let pic = table[key].pic;

				let thumbnail = template.clone();

				thumbnail.find('#link').attr("href", "project-page.php?id=" + id); // TODO: Update link when possible
				thumbnail.find('#pic').attr("src", pic);
				thumbnail.find('#title').text(title);
				$('.proj-container').append(thumbnail);
			}
		});

	}
}

$(document).ready(main);