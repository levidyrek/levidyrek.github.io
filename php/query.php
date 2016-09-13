<?php
	/** 
	The purpose of this script is to query the database in a number of ways. 
	This script should be called via AJAX. See below for supported actions and 
	required parameters for each.
	 
	 -------- ACTIONS ($_POST["action"])-----------
	 
	1. UPDATE_TABLE: update a row in a table
		- Parameters: 
			"table_name": [String] name of the table
			"queries": [array] a list of queries, like so: <column>[<relational_operator]<value> to find rows to update
			"values": [array] key=>value pairs for each column to be updated.
		
	2. SELECT_TABLE: select specified columns from specified rows (or all of them)
		- Parameters:
			"table_name": [String] name of the table
			"queries": (optional) [array] a list of queries, like so: <column>[<relational_operator]<value>
			"columns": (optional) [array] a list of column names to be returned. default value is '*', or all columns
		- Returns: [JSON] the rows returned from the query; the entire table if queries and columns are excluded.
		
	3. ADD_ROW: add a row to a table
		- Parameters:
			"table_name": [String] name of the table
			"values": [array] key=>value pairs of columns names and corresponding values for the new row
		
	4. REMOVE_ROW: remove a row or rows from a table
		- Parameters:
			"table_name": [String] name of the table
			"queries": [array] a list of queries, like so: <column>[<relational_operator]<value>
			
	**/
	
	include "constants.php";
	
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
		case UPDATE_TABLE:
			// Check for additional required params
			(checkPOST("values") && checkPOST("queries")) 
				or die($param_err);
			$values = $_POST["values"];
			$queries = $_POST["queries"];
			
			$q = "UPDATE $table";
			
			// Add the values to be set to the query
			$q .= " SET ";
			addQuotesToStrings($values);
			escapeApostrophes($values);
			addItemsToQuery($q, $values, true);
			
			// Add the WHERE clause at the end of the query
			$q .= " WHERE ";
			addItemsToQuery($q, $queries, false);
			
			// Now ready to send off the query to the db and report success or failure
			$conn->query($q) or die("Query '" . $q . "' failed: " . $conn->error);
			echo "Successfully updated " . $conn->affected_rows . " rows.";
			
			break;
		case SELECT_TABLE:
			$q = "SELECT ";
			
			// Add columns if specified
			if (checkPOST("columns")) {
				$columns = $_POST["columns"];
				addItemsToQuery($q, $columns, false);
			}
			else $q .= "* "; // No columns specified. Select all
			
			// Add table name
			$q .= " FROM $table ";
			
			// Add queries
			if (checkPOST("queries")) {
				$q .= "WHERE ";
				$queries = $_POST["queries"];
				addItemsToQuery($q, $queries, false);
			}
			
			// Now, send off query
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
			addQuotesToStrings($values);
			escapeApostrophes($values);
			addItemsToQuery($q, $values, false);
			$q .= ")";
			
			// Run the query
			$conn->query($q) or die("Query '" . $q . "' failed: " . $conn->error);
			echo "Query was successful.";

			break;
		case REMOVE_ROW:
			// Check for queries
			checkPOST("queries") or die($param_err);
			$queries = $_POST["queries"];
			
			$q = "DELETE FROM $table";
			
			// Add queries
			$q .= " WHERE "; 
			addItemsToQuery($q, $queries, false);
			
			// Run query
			$conn->query($q) or die("Query '" . $q . "' failed: " . $conn->error);
			echo "Query affected " . $conn->affected_rows . " rows.";
			
			break;
		default:
			die("Error: POST variable 'action' has an unknown value.");
	}
	
	/**
		Adds items from an array to an SQL query string
		Assumes a space is present before the last keyword of the existing query.
		
		@param	string	&$q		A reference to an SQL query string
		@param	array	$items	An array containing strings that need to be added to a query in a list format (e.g. item1,item2,item3)
		$param	boolean	$pairs	A boolean that indicated whether the items are key=>value pairs or not
	**/
	function addItemsToQuery(&$q, $items, $pairs) {
		$first = true;
		foreach ($items as $name => $item) {
			if (!$first) $q .= ", ";
			else $first = false;
			$q .= $pairs ? $name . "=" . $item  : $item;
		}
	}
	
	/**
		Adds single quotes to each string in a array of items for the purpose of being added to a MySQL query
		
		@param	array	$values	A reference to an array of items
	**/
	function addQuotesToStrings(&$values) {
		foreach ($values as &$value) {
			if (strcmp(gettype($value), "string") == 0) $value = "'" . $value . "'"; 
		}
		unset($value);
	}
	
	/**
		Simple helper function to check if a POST var is set and not empty
		
		@param	string	$name	The name of the POST variable
	**/
	function checkPOST($name) {
		return isset($_POST[$name]) && !empty($_POST[$name]);
	}

	function escapeApostrophes(&$values) {
		foreach ($values as &$value) {
			str_replace("'", "''", $value);
		}
	}
?>
