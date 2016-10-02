<?php

	include_once "constants.php";
	
	if (isset($_GET["id"])) {
		$id = $_GET["id"];

		// Get projects
		$_POST["action"] = SELECT_TABLE;
		$_POST["table_name"] = "projects";
		$_POST["queries"] = ["id=" . $id];
		echo include "query.php";
	}
	else echo "Error";

?>