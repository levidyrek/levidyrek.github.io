<?php
	include_once "constants.php";

	// Get slides
	$_POST["action"] = SELECT_TABLE;
	$_POST["table_name"] = "slides";
	echo include "query.php";

?>