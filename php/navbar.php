<?php
	// Loads head template and outputs it
	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTMLFile(dirname(__FILE__) . "/../templates/navbar.html"); // CHANGE THIS BEFORE PRODUCTION
	echo $doc->saveHTML();
	libxml_clear_errors();
?>