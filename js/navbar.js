// This script includes and modifies a navbar based on the current page
// NOTE: To use this, include as script in html file, and include an empty div with class "nav-container"

// File name constants
const HOME_PAGE = "index.php";
const ABOUT_PAGE = "about.php";
const PROJECTS_PAGE = "projects.php";
const CONTACT_PAGE = "contact.php";

// query.php actions
const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

var main = function () {
	// Insert template into document. 
	$('#nav-container').load('templates/navbar.html', onNavbarLoaded);

}

var onNavbarLoaded = function () {
	setActivePage();
	fillProjectDropdown();

	// Make project dropdown appear on mouseover
	$('.nav .projects-button').mouseover(function() { $(this).find('ul').show(); });
	$('.nav .projects-button').mouseout(function() { $(this).find('ul').hide(); });

	// Keep dropdown from being visible by default
	$('.projects-menu').hide();
}

function setActivePage() {
	let path = window.location.pathname;
	let page = path.split("/").pop();
	console.log(page);
	// Page will be empty the server serves the index.php file
	if (page == "") page = "index.php";
	$('a[href="' + page + '"]').parent().addClass("active");
}

function fillProjectDropdown() {
	// First, load projects from db
	let action = SELECT_TABLE;
	let tableName = "projects";
	let columns = ["id", "title"];
	$.post("php/query.php", {action: action, table_name: tableName, columns: columns}, function(data) {
		if (data) {
			let parsed = JSON.parse(data);
			for (let key in parsed) {
				let row = parsed[key];
				$('.nav .projects-menu').append($('<li><a href="project-page.php?id=' + row.id + '">' + row.title + "</a></li>"));
			}
		}
	});
}

$(document).ready(main);