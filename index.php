<!DOCTYPE html>

<html>
  <head>
	<?php include "php/head.php"; ?>
	
    <link href="stylesheets/main.css" rel="stylesheet" >
    <link href="stylesheets/index.css" rel="stylesheet" >
	
    <title>Homepage - Levi Payne</title>
  </head>
  <body>
		<?php
			include_once("php/constants.php");
			$page = HOME_PAGE;
			include "php/navbar.php";
		?>
		<div class="slide-container">
			<div class="slide container">
				<h1>Levi Payne</h1>
				<div class="row-fluid">
					<div class="col-md-12 col-centered">
						<a id="about-me-button" class="center-block" href="about.html">About Me</a>
					</div>
				</div>
				<div class="info">
				  <h2></h2>
				  <ul></ul>
				</div>
				<div class="slider-nav">
					<ul class="slider-dots"></ul>
				</div>
			</div>
		</div>
		
		<!--Scripts-->
		<script src="jquery-1.11.3.js"></script>
		<script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
		<script src="js/index.js"></script>
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
