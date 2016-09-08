<!DOCTYPE html>

<html>
  <head>
	<?php include "php/head.php"; ?>
	
    <link href="stylesheets/main.css" rel="stylesheet" >
    <link href="stylesheets/home.css" rel="stylesheet" >
	
    <title>Homepage - Levi Payne</title>
  </head>
  <body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<img src="images/logo35x35.png" id="logo"></img>
			<ul class="menu">
			  <li class="dropdown" id="menu-button"><a id="menu-a" class="dropdown-toggle disabled" data-toggle="dropdown"><img src="images/menu_icon.png">Menu</a>
					<ul class="dropdown-menu main-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="about.html">About</a></li>
						<li><a href="projects.html">Projects</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul
			  ></li>
				<li id="current-page"><a href="index.html">Home</a></li
			  ><li><a href="about.html">About Me</a></li
			  ><li class="dropdown projects-button"><a class="dropdown-toggle disabled" data-toggle="dropdown" href="projects.html">My Projects</a>
				<ul class="dropdown-menu projects-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="MyProjects/ghost-project.html">Ghost Hunters App</a></li>
					<li><a href="MyProjects/pweb-project.html">Personal Website</a></li>
					<li><a href="MyProjects/leo-project.html">Raspberry Pi</a></li>
					<li><a href="MyProjects/grocery-list-app.html">Grocery List App</a></li>
					<li><a href="MyProjects/beerlamp.html">BeerLamp Internship</a></li>
				</ul
			  ></li
			  ><li><a href="contact.html">Contact Me</a></li>
			</ul>
			</div>
		</nav>
		<div class="slides">
			<div class="slide1 container active-slide">
					<h1>Levi Payne</h1>
					<div class="row-fluid">
						<div class="col-md-12 col-centered">
							<a id="about-me-button" class="center-block" href="about.html">About Me</a>
						</div>
					</div>
					<div class="programmer info">
						  <h2>Programmer</h2>
						  <ul>
							<li>10+ Languages</li>
							<li>Multiple Frameworks</li>
							<li>Data Structures</li>
						  </ul>
					</div>
					<div class="slider-nav">
				<ul class="slider-dots">
					<li class="dot active-dot first-dot">&bull;</li>
					<li class="dot">&bull;</li>
					<li class="dot last-dot">&bull;</li>
				</ul>
			</div>
					<div class="main-bottom-margin"></div>
			</div>
			<div class="slide2 container">
					<h1>Levi Payne</h1>
					<div class="row-fluid">
						<div class="col-md-12 col-centered">
							<a id="about-me-button" class="center-block" href="about.html">About Me</a>
						</div>
					</div>
					<div class="developer info">
						  <h2>Developer</h2>
						  <ul>
								<li>Git Workflow</li>
								<li>Agile Methodologies</li>
								<li>Team Player</li>
						  </ul>
					</div>
					<div class="slider-nav">
				<ul class="slider-dots">
					<li class="dot active-dot first-dot">&bull;</li>
					<li class="dot">&bull;</li>
					<li class="dot last-dot">&bull;</li>
				</ul>
			</div>
					<div class="main-bottom-margin"></div>
			</div>
			<div class="slide3 container">
					<h1>Levi Payne</h1>
					<div class="row-fluid">
						<div class="col-md-12 col-centered">
							<a id="about-me-button" class="center-block" href="about.html">About Me</a>
						</div>
					</div>
					<div class="creator info">
						  <h2>Creator</h2>
						  <ul>
							<li>Mobile Development</li>
							<li>Web Development</li>
							<li>Photoshop, Blender</li>
						  </ul>
					</div>
					<div class="slider-nav">
				<ul class="slider-dots">
					<li class="dot active-dot first-dot">&bull;</li>
					<li class="dot">&bull;</li>
					<li class="dot last-dot">&bull;</li>
				</ul>
			</div>
					<div class="main-bottom-margin"></div>
			</div>
		</div>
		
		<!--Scripts-->
		<script src="jquery-1.11.3.js"></script>
		<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
		<script src="scripts/home.js"></script>
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
