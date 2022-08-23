<?php
session_start();
require'../core/Database.php';
$database = new Database;
if(!$_SESSION['is_logged_in']){
	header('Location: index.php');
	die();
}else{
$post =	filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);	
if(isset($post['submit'])){
$fname            = $post['fname'];
$email            = $post['email'];
$phone            = $post['phone'];
$city             = $post['city'];	
$state            = strtoupper($post['state']);
$country          = strtoupper($post['country']);	
$address          = $post['address'];
$active           = 1;

	$database->query('INSERT INTO `branch` (fname, email, phone, city, state, country, address, active) VALUES (:fname, :email, :phone, :city, :state, :country, :address, :active)');
	$database->bind(':fname', $fname);
	$database->bind(':email', $email);
	$database->bind(':phone', $phone);
	$database->bind(':city', $city);
	$database->bind(':state', $state);
	$database->bind(':country', $country);
	$database->bind(':address', $address);
	$database->bind(':active', $active);
	$sent = $database->execute();	
	if($sent){
		$success = "Car has been Registered";
	}else{
		$error = "An error occured, please review your forms";
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
  <?php include'head.php'; ?>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include'topnav.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include'nav.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Add Branch</h1>
          <p>Sample branch</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">Add Branch</li>
        </ul>
      </div>
      <?php if(isset($success)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $success; ?></p></center><?php } ?>
      <?php if(isset($error)){ ?><center><p class="btn btn-danger" id="demoNotify"><?php echo $error; ?></p></center><?php } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Add New Branch</h3>
            <div class="tile-body">
              <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<div class="form-group">
                  <label class="control-label">Engineer Name</label>
                  <input class="form-control" type="text" name="fname" placeholder="" required />
                </div>  
				<div class="form-group">
                  <label class="control-label">Email</label>
                  <input class="form-control" type="text" name="email" placeholder="" required />
                </div>
				<div class="form-group">
                  <label class="control-label">Phone</label>
                  <input class="form-control" type="text" name="phone" placeholder="" required />
                </div> 
				<div class="form-group">
                  <label class="control-label">City</label>
                  <input class="form-control" type="text" name="city" placeholder="" required />
                </div>
				<div class="form-group">
                  <label class="control-label">State</label>
                  <input class="form-control" type="text" name="state" placeholder="" required />
                </div>
				<div class="form-group">
                  <label class="control-label">Country</label>
                  <input class="form-control" type="text" name="country" placeholder="" required />
                </div>
				<div class="form-group">
                  <label class="control-label">Address</label>
                  <input class="form-control" type="text" name="address" placeholder="" required />
                </div>  
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">I accept the terms and conditions
                    </label>
                  </div>
                </div>
            </div>
            <div class="tile-footer">
              <input class="btn btn-info" id="demoNotify" type="submit" name="submit" value="Register Branch">
            </div>
            </form>
          </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript">
      $('#demoNotify').click(function(){
      	$.notify({
      		title: "Your form has been ",
      		message: "submitted",
      		icon: 'fa fa-check' 
      	},{
      		type: "info"
      	});
      });
      $('#demoSwal').click(function(){
      	swal({
      		title: "Are you sure?",
      		text: "You will not be able to recover this imaginary file!",
      		type: "warning",
      		showCancelButton: true,
      		confirmButtonText: "Yes, delete it!",
      		cancelButtonText: "No, cancel plx!",
      		closeOnConfirm: false,
      		closeOnCancel: false
      	}, function(isConfirm) {
      		if (isConfirm) {
      			swal("Deleted!", "Your imaginary file has been deleted.", "success");
      		} else {
      			swal("Cancelled", "Your imaginary file is safe :)", "error");
      		}
      	});
      });
    </script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
		var str = "Test\n\n\Test\n\Test";
str.replace(/\r\n|\r|\n/g,'&#13;&#10;');
</script>
  </body>
</html>
<?php
}
?>