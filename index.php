<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Personnel Information System</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="admin/css/main.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php header('location:admin'); ?>
		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.php">PERSONNEL MANAGEMENT <span>INFORMATION SYSTEM</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
					<li><a href="attendance.php">Attendance</a></li>                     
                    <div class="row">
						<div class="col-md-12">
							
							<form class="form" role="form" action="logs.php" method="POST" accept-charset="UTF-8" >
								<div class="form-group">
									<label class="sr-only" for="icPatient">Username</label>
									<input type="text" class="form-control" name="username" placeholder="Enter Your Username" style="color:white;" required>
								</div>
								<div class="form-group">
									<label class="sr-only" for="password">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" style="color:white;" required>
								</div>
								<div class="form-group">
									<button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
								</div>
							</form>
						</div>
					</div>
                    
				</ul>
			</nav>

		<!-- Banner -->
			<section class="banner full">
				<article>
					<img src="images/img1.jpg" alt="" />
					<div class="inner">
						<header>
							<p>Welcome To Personnel Information Management System</p>
							<h3 style="text-transform:uppercase;"> A system that manages all employee and their activities</h3>
						</header>
					</div>
				</article>
				<article>
					<img src="images/img2.jpg" alt="" />
					<div class="inner">
						<header>
							<p>Employment, Development and Compensation</p>
							<h3 style="text-transform:uppercase;"> promoting and stimulating competent work force to make fullest contribution</h3>
						</header>
					</div>
				</article>
				<article>
					<img src="images/img3.jpg"  alt="" />
					<div class="inner">
						<header>
							<p>based on human orientation</p>
							<h3 style="text-transform:uppercase;">helps workers develop their potential fully to the concern</h3>
						</header>
					</div>
				</article>
				<article>
					<img src="images/img4.jpg"  alt="" />
					<div class="inner">
						<header>
							<p>human resources of a concern</p>
							<h3 style="text-transform:uppercase;">Manages both individual as well as blue- collar workers.</h3>
						</header>
					</div>
				</article>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Untitled. All rights reserved.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

<?php
	if (isset($_GET['error'])) {
		$errorMsg = $_GET['error'];
		echo "<script> alert('" . $errorMsg . "') </script>";
	}
?>

	<script>
		$('#attendModal').modal('show');
	</script>
	</body>
</html>
