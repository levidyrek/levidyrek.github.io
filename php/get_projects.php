<?php

	include_once "constants.php";

	// Get projects
	$_POST["action"] = SELECT_TABLE;
	$_POST["table_name"] = "projects";
	echo include "query.php";

?>