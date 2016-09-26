<?php
	
	$server = "localhost";
	$username = "root";
	$password = "ldp1508";
	
	$conn = new mysqli($server, $username, $password);
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

	// Create database
	$db_name = "personal_website";
	$q = 'CREATE DATABASE IF NOT EXISTS $db_name';
	$conn->query($q) or die("Failed to create database: " . $conn->error);
	echo "Database has been created.\n";

	// Connect to database
	$conn->select_db($db_name);
	echo "Connected to database.\n";

	// Create projects table
	$q = "CREATE TABLE IF NOT EXISTS projects (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, title TINYTEXT NOT NULL, pic TINYTEXT NOT NULL, brief TEXT NOT NULL, description MEDIUMTEXT NOT NULL)";
	$conn->query($q) or die("Failed to create projects table: " . $conn->error);
	echo "Projects table has been created.\n";

	// Create slides table
	$q = "CREATE TABLE IF NOT EXISTS slides (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, title TINYTEXT NOT NULL, items TEXT NOT NULL, background TINYTEXT NOT NULL)";
	$conn->query($q) or die("Failed to create slides table: " . $conn->error);
	echo "Slides table has been created";

?>