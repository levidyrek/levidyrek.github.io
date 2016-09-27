<!DOCTYPE html>
<html>
<head>
	<?php include "php/head.php"; ?>

	<link href="stylesheets/about.css" rel="stylesheet" >
	<title>About Me - Levi Payne</title>
</head>
<body>
	<div id="nav-container"></div>
	<div class="main container-fluid">
		<div class="row">
			<div class="col-md-3 col-sm-offset-1 self-container">
				<img id="self" src="images/self.jpeg" alt="self-portrait">
			</div>	
				<div class="col-md-4">
					<div class="row">
						<div class="bio">
							<h3>bio <span class="bracket">{</span></h3>
							<div class="indent-1">
								<p>Hi! I'm a recent Computer Science graduate from the University of Virginia. I am very passionate about technology and software development, and I am very enthusiastic about what I do.</p>
							</div>
							<h3 class="bracket">}</h3>
						</div>
					</div>
					<div class="row">
						<div class="education">
							<h3>education <span class="bracket">{</span></h3>
							<div class="indent-1">
								<h5>University of Virginia (2014-2016)</h5>
								<ul>
									<li>B.A. in Computer Science</li>
									<li>GPA: 3.665</li>
									<li>Major GPA: 3.883</li>
								</ul>
								<h5>Wytheville Community College (2013-2014)</h5>
								<ul>
									<li>A.A.S. in General Studies</li>
									<li>Member of Phi Theta Kappa</li>
									<li>GPA: 3.8</li>
								</ul>
							</div>
							<h3 class="bracket">}</h3>
						</div>
					</div>
				</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h1 id="skills-header">Skills</h1>
			</div>
		</div>				
		<div class="row skills">
			<div class="col-lg-3 col-md-offset-1">
				<div class="languages">
					<h3>Languages</h3>
					<hr>
					<div class="center-list">
						<h4>Proficient</h4>
						<ul>
							<li>Java</li>
							<li>C++</li>
							<li>Javascript</li>
							<li>PHP</li>
							<li>MySQL</li>
							<li>HTML</li>
							<li>CSS</li>
							<li>XML</li>
						</ul>
						<h4>Competent</h4>
						<ul>
							<li>C</li>
							<li>Python</li>
							<li>x86 Assembly</li>
							<li>Swift</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="soft-dev">
					<h3>Software Development</h3>
					<hr>
					<div class="center-list">
						<h4>Frameworks</h4>
						<ul>
							<li>Android</li>
							<li>iOS</li>
							<li>CSS Bootstrap</li>
							<li>JQuery</li>
						</ul>
						<h4>Project Management</h4>
						<ul>
							<li>Git</li>
							<li>Scrum Methodology</li>
						</ul>
						<h4>Unix</h4>
						<ul>
							<li>Shell Commands</li>
							<li>Scripting</li>
						</ul>
						<h4>Advanced Data Structures</h4>
						<ul>
							<li>Hash Tables</li>
							<li>Trees</li>
							<li>Graphs</li>
							<li>Running Time Analysis</li>
						</ul>	
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="misc">
					<h3>Miscellaneous</h3>
					<hr>
					<div class="center-list">
						<h4>Software</h4>
						<ul>
							<li>Photoshop</li>
							<li>Blender</li>
							<li>Linux</li>
							<li>Windows</li>
						</ul>
						<h4>Other</h4>
						<ul>
							<li>PC Hardware</li>
							<li>Troubleshooting</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Scripts-->
	<script src="js/navbar.js"></script>
	<script src="js/about.js"></script>
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