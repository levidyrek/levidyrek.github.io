<!DOCTYPE html>
<html>

<head>
	<?php include "php/head.php"; ?>
	
	<link href="stylesheets/project-page.css" rel="stylesheet" >
	<title>Personal Website Project - Levi Payne</title>
</head>

<body>
	<div id="nav-container"></div>
	<div class="main container-fluid">
		<h2 id="title"></h2>
		<div class="row">
			<div class="col-md-4 col-md-offset-1">
				<img id="project-pic">
			</div>
			<div class="col-md-6">
				<div class="brief"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="description">
					<h3>Description:</h3>
					<p></p>
				</div>
			</div>
		</div>
	</div>

	<!--Scripts-->
	<script src="js/navbar.js"></script>
	<script src="js/main.js"></script>
	<script src="js/project-page.js"></script>
	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-63481408-1', 'auto');
		ga('send', 'pageview');

	</script>
</body>
