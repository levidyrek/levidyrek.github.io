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
			"queries": [JSON] a list of queries, like so: <column>[<relational_operator]<value> to find rows to update
			"values": [JSON] key->value pairs for each column to be updated
		
	3. SELECT_TABLE: select specified columns from specified rows
		- Parameters:
			"table_name": [String] name of the table
			"queries": [JSON] a list of queries, like so: <column>[<relational_operator]<value>
			"columns": (optional) [JSON] a list of column names to be returned. default value is '*', or all columns
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
			// Simply run the query
			$q = "SELECT * FROM '$table'";
			$result = $conn->query($q);
			if ($result->num_rows > 0) {
				$output = array();
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}
				echo json_encode($output);
			}
			break;
		case UPDATE_TABLE:
			// Check for additional required params
			(isset($_POST["values"]) && isset($_POST["queries"])) 
				or die("Error: ensure all required params are set.");
			$values = json_decode($_POST["values"]);
			$queries = json_decode($_POST["queries"]);
			
			$q = "UPDATE '$table_name' SET ";
			
			// Add the values to be set to the query
			$first = true;
			foreach ($values as $name => $value) {
				if (!$first) $q .= ",";
				else $first = false;
				$q .= $name . "=" . $value;
			}
			
			// Add the queries at the end of the query
			addQueriesToQuery($q, $queries);
			
			// Now ready to send off the query to the db and report success or failure
			$conn->query($q) or die("Error: " . $conn->error);
			echo "Successfully updated " . $conn->affected_rows . " rows.";
			
			break;
		case SELECT_TABLE:
			// Check for additional required params
			isset($_POST["queries"]) or die("Error: ensure all required params are set.");
			$queries = json_decode($_POST["queries"]);
			
			$q = "SELECT ";
			
			if (isset($_POST["columns"])) {
				
			}
			else $q .= "* "; // No columns specified. Select all
				
			$columns = json_decode($_POST["columns"]);
			break;
		case ADD_ROW:

			break;
		case REMOVE_ROW:

			break;
		default:
			die("Error: POST variable 'action' has an unknown value.");
	}
	
	/**
		Adds queries (after the WHERE clause) from an array to an SQL query string
		
		@param &$q A reference to an SQL query string
		@param $queries An array containing strings with relational queries (e.g. id=1)
	**/
	function addQueriesToQuery(&$q, $queries) {
		$q .= " WHERE ";
		$first = true;
		foreach ($queries as $query) {
			if (!$first) $q .= ",";
			else $first = false;
			$q .= $query;
		}
	}
	
	/**
	
	**/
	function addSetValsToQuery(&$q, $values) {
		
	}
?>