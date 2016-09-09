<?php
	/** The purpose of this script is to query the database in a number of ways.
	 This script should be called via AJAX. See below for supported actions and 
	 required parameters for each.
	 
	 -------- ACTIONS -----------
	 
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
	// 1. Actions
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
	
	$id = $_POST["id"];
	$q = "SELECT * FROM projects WHERE id='$id'";
	
	$result = $conn->query($q);
	if ($result->num_rows > 0) {
		echo json_encode($result->fetch_assoc());
	}
?>