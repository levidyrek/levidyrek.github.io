var main = function() {
	// Check to see if id is present
	var id = getId();
	if (id) loadProject(id);
	else window.location = "projects.php";

}

/**
Gets data for selected project and passes it to fillInData()
**/
function loadProject(id) {
	let action = SELECT_TABLE;
	let tableName = "projects";
	let queries = ["id=" + id];
	$.post("php/query.php", {action: action, table_name: tableName, queries: queries}, fillInData);
}

/**
Takes data and puts it in page
**/
var fillInData = function(data) {
	if (data) {
		let json = JSON.parse(data);
		let project = json[0];

		$('#title').text(project.title);
		$('#project-pic').attr("src", project.pic);
		$('.brief').html(formatBrief(project.brief));
		$('.description p').html(project.description);
	}
}

/**
Takes in the "brief" value of the project and formats it appropriately
**/
function formatBrief(brief) {
	let result = '';
	let lines = brief.split('\n');
	for (let key in lines) {
		let line = lines[key].split(':');
		let header = line[0];
		// Concatenate value with the rest of line, just in case there were more ":" in the string
		let value = "";
		for (let i = 1; i < line.length; i++) value += line[i];
		result += "<h4>" + header + ":</h4>" + value + "<br>";
	}
	
	return result;
}

/**
Gets id variable from url
**/
function getId() {
	var query = window.location.search.substring(1);
	var pair = query.split("=");
	if(pair[0] == "id") return pair[1];
	return false;
}

$(document).ready(main);