<?php
	include_once "constants.php";

	if (isset($_GET["id"])) {
		$id = $_GET["id"];

		// Get slides
		$_POST["action"] = SELECT_TABLE;
		$_POST["table_name"] = "slides";
		$_POST["queries"] = ["id=" . $id];
		echo include "query.php";
	}

?>