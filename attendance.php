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
		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.php">PERSONNEL MANAGEMENT <span>INFORMATION SYSTEM</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>  
					<li><a href="attendance.php">Home</a></li>                    
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
					<img src="images/employees.jpg" alt="" />
					<div class="inner">
						<header>
							<form action="takeAttendance.php" method="post">
                                <div class="form-group">
                                    <input type="text" name="empid" id="empid" placeholder="Employee ID" title="Enter Employee ID" required class="form-control" style="background-color:rgba(255,255,255,0.8);">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="token" id="token" placeholder="Daily Secret Token" title="Enter Employee Daily Token" required class="form-control" style="background-color:rgba(255,255,255,0.8);">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary text-light">
                                        Record Presence
                                    </button>
                                </div>
                            </form>
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

    if (isset($_GET['taken'])) {
		$Msg = $_GET['taken'];
		echo "<script> alert('" . $Msg . "') </script>";
	}
?>

	<script>
		$('#attendModal').modal('show');
	</script>
	</body>
</html>
