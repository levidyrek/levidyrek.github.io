<!DOCTYPE html>
<html>
	<!-- The purpose of this script is to easily add new project pages -->
	<head>
	
	</head>
	<body>
		<h1>Add a new project</h1>
		<?php
			$form = 
				'<form action="add_new_project.php" method="POST" >
				Title: <br>
				<textarea name="title" rows="1" cols="30"></textarea>
				<br><br>
				Picture: <br>
				<textarea name="pic" rows="1" cols="30"></textarea>
				<br><br>
				Brief: <br>
				<textarea name="brief" rows="10" cols="50"></textarea>
				<br><br>
				Description: <br>
				<textarea name="description" rows="10" cols="50"></textarea>
				<br><br>
				<input type="submit" value="Submit"/>
				</form>';
				
			if (isset($_POST["title"]) && $_POST["title"] != "" 
				&& isset($_POST["pic"]) && $_POST["pic"] != ""
				&& isset($_POST["brief"]) && $_POST["brief"] != ""
				&& isset($_POST["description"]) && $_POST["description"] != "") { // Add to database
				
				$server = "localhost";
				$username = "root";
				$password = "ldp1508";
				$db_name = "personal_website";
				
				$conn = new mysqli($server, $username, $password, $db_name);
				if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
				
				$title = $_POST["title"];
				$pic = $_POST["pic"];
				$brief = $_POST["brief"];
				$description = $_POST["description"];
				
				// Escape apostrophes by replacing them with double apostrophes
				$title = str_replace("'", "''", $title);
				$pic = str_replace("'", "''", $pic);
				$brief = str_replace("'", "''", $brief);
				$description = str_replace("'", "''", $description);
				
				$q = "INSERT INTO projects (title, pic, brief, description) VALUES ('$title', '$pic', '$brief', '$description')";
				if ($conn->query($q)) {
					echo "Project added successfully!<br><br>";
					echo $form;
				}
				else die("Query failed: " . $conn->error);
			}
			else { // Show the form
				echo $form;
			}
			
		?>
	</body>
</html>