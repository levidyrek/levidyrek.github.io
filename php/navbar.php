<?php
	// The purpose of this script is to output the navbar dynamically for all pages

	include_once("constants.php");

	// First, output the parts before the first dropdown, as it will stay constant
	echo 
		"<nav class='navbar navbar-default'>
				<div class='container-fluid'>
				<img src='images/logo35x35.png' id='logo'></img>
				<ul class='menu'>
				  <li class='dropdown' id='menu-button'><a id='menu-a' class='dropdown-toggle disabled' data-toggle='dropdown'><img src='images/menu_icon.png'>Menu</a>
						<ul class='dropdown-menu main-menu' role='menu' aria-labelledby='dLabel'>";

	// Next output links to all pages, except the current one, for the mobile dropdown
	if ($page != HOME_PAGE) echo "<li><a href='index.php'>Home</a></li>";
	if ($page != ABOUT_PAGE) echo "<li><a href='about.php'>About</a></li>";
	if ($page != PROJECT_PAGE) echo "<li><a href='projects.php'>Projects</a></li>";
	if ($page != CONTACT_PAGE) echo "<li><a href='contact.php'>Contact</a></li>";

	// Close the mobile dropdown
	echo 
		"</ul
		></li>";

	// Now, the desktop navbar buttons. Give the current one the 'current-page' id
	$curr_id = " id='current-page'";

	echo 
		"<li" . ($page == HOME_PAGE ? $curr_id : "") . "><a href='index.php'>Home</a></li
		><li" . ($page == ABOUT_PAGE ? $curr_id : "") . "><a href='about.php'>About Me</a></li
		><li" . ($page == PROJECT_PAGE || $page == PROJECT_PROFILE ? $curr_id : "") . 
		" class='dropdown projects-button'><a class='dropdown-toggle disabled' data-toggle='dropdown' href='projects.php'>My Projects</a>
				<ul class='dropdown-menu projects-menu' role='menu' aria-labelledby='dLabel'>";

	// Now, fetch the names of all the projects from the db
	$server = "localhost";
	$username = "root";
	$password = "ldp1508";
	$db_name = "personal_website";
	
	$conn = new mysqli($server, $username, $password, $db_name);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	$q = "SELECT title FROM projects";
	$result = $conn->query($q);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<li><a href='#'>" . $row["title"] . "</a></li>"; // TODO: Update link
		}
	}

	// Close project dropdown, link
	echo 
		"</ul
		></li";

	// Now, the contact page link
	echo 
	"><li" . ($page == CONTACT_PAGE ? $curr_id : "") . "><a href='contact.html'>Contact Me</a></li>";

	// Lastly, close up the navbar
	echo 
		"		</ul>
			</div>
		</nav>";
?>