<?php
	// Loads head template and outputs it
	$doc = new DOMDocument();
	$doc->loadHTMLFile(dirname(__FILE__) . "/../templates/head.html"); // CHANGE THIS BEFORE PRODUCTION
	echo $doc->saveHTML();
?>