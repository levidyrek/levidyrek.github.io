<!DOCTYPE html>
<html>
<head>
	<?php include "php/head.php"; ?>

	<link href="stylesheets/projects.css" rel="stylesheet" >
	<title>My Projects - Levi Payne</title>
</head>

<body>
	<div id="nav-container"></div>
	<div class="main projects container-fluid">
		<div class="row-fluid">
			<div class="col-md-2 col-md-offset-1 project1">
				<a href="MyProjects/pweb-project.html">
					<img src="images/frontpage-screenshot.jpg">
					Personal Website	
				</a>
			</div>
			<div class="col-md-2 col-md-offset-1 project2">
				<a href="MyProjects/leo-project.html">
					<img src="images/pi-logo.jpg">
					Raspberry Pi: Project Leo
				</a>
			</div>
			<div class="col-md-2 col-md-offset-1 project3">
				<a href="MyProjects/ghost-project.html">
					<img src="images/gh-screenshot.jpg">
					Ghost Hunters Android App
				</a>
			</div>
		</div>
		<div class="row-fluid">
			<div class="col-md-2 grocery-list-app">
				<a href="MyProjects/grocery-list-app.html">
					<img src="images/grocery-list-tile.png">
					<h4>Grocery List App</h4>
				</a>
			</div>
			<div class="col-md-2 beerlamp-internship">
				<a href="MyProjects/beerlamp.html">
					<img src="images/beerlamp-logo.png">
					<h4>BeerLamp Internship</h4>
				</a>
			</div> 
		</div>
	</div>

	<!--Scripts-->
	<script src="js/navbar.js"></script>
	<script src="js/projects.js"></script>
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
</html>
