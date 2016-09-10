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
			"values": [JSON] key=>value pairs for each column to be updated
		
	3. SELECT_TABLE: select specified columns from specified rows
		- Parameters:
			"table_name": [String] name of the table
			"queries": [JSON] a list of queries, like so: <column>[<relational_operator]<value>
			"columns": (optional) [JSON] a list of column names to be returned. default value is '*', or all columns
		- Returns: [JSON] the rows returned from the query
		
	4. ADD_ROW: add a row to a table
		- Parameters:
			"table_name": [String] name of the table
			"values": [JSON] key=>value pairs of columns names and corresponding values for the new row
		
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
	checkPOST("action") or die("Error: POST variable 'action' must be setand not empty.");
	$action = $_POST["action"];

	// Table name must be given for all actions
	checkPOST("table_name") or die("Error: POST variable 'table_name' must be set and not empty.");
	$table = $_POST["table_name"];
	
	// Generic error message
	$param_err = "Error: ensure all required params are set and not empty.";

	// See which action needs to be done
	switch ($action) {
		case GET_TABLE:
			// Simply run the query
			$q = "SELECT * FROM $table";
			$result = $conn->query($q);
			$result or die("Query '" . $q . "' failed: " . $conn->error);
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
			(checkPOST("values") && checkPOST("queries")) 
				or die($param_err);
			$values = json_decode($_POST["values"]);
			$queries = json_decode($_POST["queries"]);
			
			$q = "UPDATE '$table'";
			
			// Add the values to be set to the query
			$q .= " SET ";
			addItemsToQuery($q, $values, true);
			
			// Add the WHERE clause at the end of the query
			$q .= " WHERE ";
			addItemsToQuery($q, $queries, false);
			
			// Now ready to send off the query to the db and report success or failure
			$conn->query($q) or die("Error: " . $conn->error);
			echo "Successfully updated " . $conn->affected_rows . " rows.";
			
			break;
		case SELECT_TABLE:
			// Check for additional required params
			checkPOST("queries") or die($param_err);
			$queries = json_decode($_POST["queries"]);
			$columns = json_decode($_POST["columns"]);
			
			$q = "SELECT ";
			
			// Add columns if specified
			if (isset($_POST["columns"]) && !empty($_POST["columns"])) {
				$columns = $_POST["columns"];
				addItemsToQuery($q, $columns, false);
			}
			else $q .= "* "; // No columns specified. Select all
			
			// Add table name
			$q .= "FROM $table ";
			
			// Add queries
			$q .= "WHERE ";
			addItemsToQuery($q, $queries, false);
			
			// Now, send off query
			$result = $conn->query($q);
			$result or die("Query failed: " . $conn->error);
			if ($result->num_rows > 0) {
				$output = array();
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}
				echo json_encode($output);
			}
			
			break;
		case ADD_ROW:
			// Check for POST var "values"
			checkPOST("values") or die($param_err);
			$values = $_POST["values"];
			
			$q = "INSERT INTO $table";
			
			// First, add column names
			$q .= " (";
			addItemsToQuery($q, array_keys($values), false);
			$q .= ") ";
			
			// Add the values
			$q .= "VALUES (";
			addItemsToQuery($q, $values, false);
			$q .= ")";
			
			// Run the query
			$conn->query($q) or die("Query failed: " . $conn->error);
			echo "Query was successful.";

			break;
		case REMOVE_ROW:
			// Check for queries
			checkPOST("queries") or die($param_err);
			$queries = $_POST["queries"];
			
			$q = "DELETE FROM $table";
			
			// Add queries
			$q .= "WHERE "; 
			addItemsToQuery($q, $queries, false);
			
			// Run query
			$conn->query($q) or die("Query failed: " . $conn->error);
			echo "Query affected " . $conn->affected_rows . " rows.";
			
			break;
		default:
			die("Error: POST variable 'action' has an unknown value.");
	}
	
	/**
		Adds items from an array to an SQL query string
		Assumes a space is present before the last keyword of the existing query. Adds one after it's done
		
		@param	string	&$q		A reference to an SQL query string
		@param	array	$items	An array containing strings that need to be added to a query in a list format (e.g. item1,item2,item3)
		$param	boolean	$pairs	A boolean that indicated whether the items are key=>value pairs or not
	**/
	function addItemsToQuery(&$q, $items, $pairs) {
		$first = true;
		foreach ($items as $name => $item) {
			if (!$first) $q .= ",";
			else $first = false;
			$q .= $pairs ? $name . "=" . $item  : $item;
		}
		$q .= " ";
	}
	
	/**
		Simple helper function to check if a POST var is set and not empty
		
		@param	string	$name	The name of the POST variable
	**/
	function checkPOST($name) {
		return isset($_POST[$name]) && !empty($_POST[$name]);
	}
?>