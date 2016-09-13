<!DOCTYPE html>
<html>
	<!-- The purpose of this script is to easily add new project pages -->
	<head>
	
	</head>
	<body>
		<div id="header">
			<h1>Add a new project</h1>
			<h2>Or edit an existing one: </h2>
			<select id="proj_select"></select>
			<button id="load_button" type="button">Load</button>
		</div>
		<form>
				Title: <br>
				<textarea name="title" rows="1" cols="30"></textarea>
				Picture: <br>
				<textarea name="pic" rows="1" cols="30"></textarea>
				Brief: <br>
				<textarea name="brief" rows="10" cols="50"></textarea>
				Description: <br>
				<textarea name="description" rows="10" cols="50"></textarea>
				<button id="submit_button">Submit</button>
				<button id="update_button" style="visibility:hidden;">Update</button>
				<button id="delete_button" style="visibility:hidden;">Delete</button>
		</form>
		<script src="edit_projects.js"></script>
	</body>
</html>
