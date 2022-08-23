<?php
session_start();
require'Database.php';
$database = new Database;
if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
$post =	filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);	
if(isset($post['Register'])){
$a = $_POST['a'];
$f = $_POST['b'];
$l = $_POST['c'];
$qtytaken =0;
$date =date('Y-m-d');
	

	$database->query('INSERT INTO `foodreg` (foodname, qty, foodtype,qtytaken,date) VALUES (:food,:qty, :foodtype, :qtytaken, :date)');
	$database->bind(':food', $a);
	$database->bind(':qty', $f);
	$database->bind(':foodtype', $l);
    $database->bind(':qtytaken', $qtytaken);
	$database->bind(':date', $date);
	$sent = $database->execute();	
	if($sent){
		$success = "Food has been added";
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
          <h1><i class="fa fa-edit"></i> Add Food</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">Add Food</li>
        </ul>
      </div>
      <?php if(isset($success)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $success; ?></p></center><?php } ?>
      <?php if(isset($error)){ ?><center><p class="btn btn-danger" id="demoNotify"><?php echo $error; ?></p></center><?php } ?>
		<div class="row">
		 <fieldset>	     
		 <table align="center">

<form method="Post">

		<tr>
          <td><label>Food Name:<label></td>
          <td ><input type="text" autocomplete="off" class="form-control" name="a" tabindex="2" required /></td>
        </tr>
<tr>
          <td><label>Qty:<label></td>
          <td ><input type="text" autocomplete="off" class="form-control" name="b" tabindex="2" required /></td>
        </tr>
		

		<tr>
          <td><label>FoodType:<label></td>
          <td >
		  <input type="text" autocomplete="off" class="form-control" name="c" tabindex="2" required>
 		  </td>
        </tr>
		<tr>
          <td></td>
          <td><input type="submit" style="background-color:green; color:white;" name="Register" class="form-control" value="Register"/></td>
        </tr>
</fieldset>
	
				
				</table>
				
</form>
</div>
</div>
<!--############################################################################################################################################--


		
		
		
		
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