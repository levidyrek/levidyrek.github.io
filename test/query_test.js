// This script is a series of AJAX calls to test query.php
			
const GET_TABLE = 100;
const UPDATE_TABLE = 101;
const SELECT_TABLE = 102;
const ADD_ROW = 103;
const REMOVE_ROW = 104;

/**
	Runs an AJAX request to query.php and displays the result

	@param	{jQuery}	div				A jQuery object div to place results
	@param	{array}		params			An assoc. array of POST variables for the AJAX call
	@param 	{boolean}	displayAsTable 	Determines where the result will be displayed as a table or as it is
	
	@return	{Promise}	A Promise object
**/
function runTest(div, params, displayAsTable) {
	return Promise.resolve($.post("../php/query.php", params, function(data) {
		// Display result
		if (displayAsTable) {
			let tableData = JSON.parse(data);
			let table = $('<table></table>');
			for (let rowKey in tableData) {
				let row = $('<tr></tr>');
				for (let colKey in tableData[rowKey]) {
					let col = $('<td></td>');
					col.html(tableData[rowKey][colKey]);
					row.append(col);
				}
				table.append(row);
			}
			div.append(table);
		}
		else div.append($('<p>' + data + '</p>'));

		div.append($('<br><br>'));
	}));
}

var num = 0;
// Temporary function to test if Promise order holds up
function logOrder(test) {
	num++;
	console.log(test + " finished: " + num);
}

// ----------- Test 1: Retrieve table ----------------
let div = $('<div></div>');
let header = $('<h2>Test 1: Retrieve table</h2><br>');
div.append(header);
$('body').append(div);
let params = {action: GET_TABLE, table_name: "projects"};
var promise = runTest(div, params, true);

// ------------ Test 2: Add Row ----------------------
promise = promise.then(function(value) {
	logOrder("Test 1");
	
	let div = $('<div></div>');
	let header = $('<h2>Test 2: Add Row</h2><br>');
	div.append(header);
	$('body').append(div);
	let values = {title: "test_proj", pic: "none.jpg", brief: "testing", description: "this is a test"};
	let params = {action: ADD_ROW, values: values, table_name: "projects"};
	runTest(div, params, false);
}, function(error) {
	alert(error);
});

// Get table to ensure row has been added
promise = promise.then(function(value) {
	logOrder("Test 2");
	
	let div = $('<div></div>');
	$('body').append(div);
	let params = {action: GET_TABLE, table_name: "projects"};
	runTest(div, params, true);
}, function(error) {
	alert(error);
});

// -------------- Test 3: Select table -------------------
promise = promise.then(function(value) {
	logOrder("Test 2 Check");
	
	let div = $('<div></div>');
	let header = $('<h2>Test 3: Select Table</h2><br>');
	div.append(header);
	$('body').append(div);
	let queries = ["title='test_proj'"];
	let params = {action: SELECT_TABLE, table_name: "projects", queries: queries};
	runTest(div, params, true);
}, function(error) {
	alert(error);
});

// -------------- Test 4: Update table -------------------
promise = promise.then(function(value) {
	logOrder("Test 3");
	
	let div = $('<div></div>');
	let header = $('<h2>Test 4: Update Table</h2><br>');
	div.append(header);
	$('body').append(div);
	let queries = ["title='test_proj'"];
	let values = {brief: "This was updated", description: "This was also updated"};
	let params = {action: UPDATE_TABLE, table_name: "projects", queries: queries, values: values};
	runTest(div, params, false);
}, function(error) {
	alert(error);
});

// Get table to ensure table has been updated
promise = promise.then(function(value) {
	logOrder("Test 4");
	
	let div = $('<div></div>');
	$('body').append(div);
	let params = {action: GET_TABLE, table_name: "projects"};
	runTest(div, params, true);
}, function(error) {
	alert(error);
});

// -------------- Test 5: Remove Row(s) ------------------
promise = promise.then(function(value) {
	logOrder("Test 4 Check");
	
	let div = $('<div></div>');
	let header = $('<h2>Test 5: Remove Row(s)</h2><br>');
	div.append(header);
	$('body').append(div);
	let queries = ["title='test_proj'"];
	let params = {action: REMOVE_ROW, table_name: "projects", queries: queries};
	runTest(div, params, false);
}, function(error) {
	alert(error);
});

// Get table to ensure row has been removed
promise = promise.then(function(value) {
	logOrder("Test 5");
	
	let div = $('<div></div>');
	$('body').append(div);
	let params = {action: GET_TABLE, table_name: "projects"};
	runTest(div, params, true);
}, function(error) {
	alert(error);
}).then(function(value) {
	logOrder("Test 5 Check");
}, function(error) {
	alert(error);
});




