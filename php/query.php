<?php
	/** 
	The purpose of this script is to query the database in a number of ways. 
	This script should be called via AJAX. See below for supported actions and 
	required parameters for each.
	 
	 -------- ACTIONS ($_POST["action"])-----------
	 
	1. GET_TABLE: retrieve an entire table
		- Parameters: 
			"table_name": [String] name of the table 
		- Returns: [JSON] the entire table
	 
	2. UPDATE_TABLE: update a row in a table
		- Parameters: 
			"table_name": [String] name of the table
			"values": [JSON] key->value pairs for each column to be updated
		
	3. SELECT_TABLE: query a table
		- Parameters:
			"table_name": [String] name of the table
			"queries": [JSON] a list of queries, like so: <column>[<relational_operator]<value>
		- Returns: [JSON] the rows returned from the query
		
	4. ADD_ROW: add a row to a table
		- Parameters:
			"table_name": [String] name of the table
			"values": [JSON] the values for the row
		
	5. REMOVE_ROW: remove a row or rows from a table
		- Parameters:
			"table_name": [String] name of the table
			"queries": [JSON] a list of queries, like so: <column>[<relational_operator]<value>
			
	**/
	
	// Constants
	// Actions
	define("GET_TABLE", 100); 
	define("UPDATE_TABLE", 101);
	define("SELECT_TABLE", 102); 
	define("ADD_ROW", 103);
	define("REMOVE_ROW", 104);
	
	$server = "localhost";
	$username = "root";
	$password = "ldp1508";
	$db_name = "personal_website";
	
	$conn = new mysqli($server, $username, $password, $db_name);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	
	// Action must be set
	isset($_POST["action"]) or die("Error: POST variable 'action' must be set.");

	// Table name must be given for all actions
	isset($_POST["table_name"]) or die("Error: POST variable 'table_name' must be set");
	$table = $_POST["table_name"];

	// See which action needs to be done
	switch ($_POST["action"]) {
		case GET_TABLE:
			$q = "SELECT * FROM '$table'";
			$result = $conn->query($q);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					
				}
			}
			break;
		case UPDATE_TABLE:

			break;
		case SELECT_TABLE:

			break;
		case ADD_ROW:

			break;
		case REMOVE_ROW:

			break;
		default:
			die("Error: POST variable 'action' has an unknown value.");
	}
?>