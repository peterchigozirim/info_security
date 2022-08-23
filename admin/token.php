<?php
session_start();
require'../core/Database.php';
$database = new Database;

if(!$_SESSION['is_logged_in']){
	header('Location: index.php');
	die();
}else{
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
      <?php if(isset($success)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $success; ?></p></center><?php } ?>
      <?php if(isset($error)){ ?><center><p class="btn btn-danger" id="demoNotify"><?php echo $error; ?></p></center><?php } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">search for food or store ID</h3>
            <div class="messanger">
             <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
              <div class="sender">
                <input type="text" name="car_name" placeholder="search for token or code">
                <input class="btn btn-primary" name="submit" type="submit" value="check">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      
               <?php 
	  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	if(isset($post['submit'])){
		$car_name = $post['car_name'];
		$database->query('SELECT * FROM registration WHERE car_name LIKE :car_name OR v_number LIKE :car_name OR vehicle_country LIKE :car_name');
		$database->bind(':car_name', '%'.$car_name.'%');
		$picks = $database->resultset();
		$coi = $database->totalcount();
		if($coi > 0){
	  
	  ?>
               <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Search result for <?php echo $car_name; ?></h3>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Store ID</th>
                    <th>Car Name</th>
                    <th>Number</th>
                    <th>Country</th>
                  </tr>
                </thead>
                <tbody>
                 <?php  foreach($picks as $pick) : ?>
                 
                  <tr>                   
                    <td><?php echo $pick['id']; ?></td>
                    <td><a href="editcar.php?id=<?php echo $pick['id']; ?>"><?php echo $pick['car_name']; ?></a></td>
                    <td><?php echo $pick['v_number']; ?></td>
                    <td><a href="editcar.php?id=<?php echo $pick['id']; ?>"><?php echo $pick['country']; ?></a></td>                    
                  </tr>
                 <?php endforeach; ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
                <?php
				  
		}else{ ?>
		<div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">No Such Food Or Store ID Exist</h3>
            <div class="table-responsive">
            </div>
          </div>
        </div>
      </div>
		<?php	
		}
	}
?>
              
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
  </body>
</html>
<?php
}
?>