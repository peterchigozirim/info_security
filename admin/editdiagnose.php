<?php
session_start();
require'../core/Database.php';
$database = new Database;

if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
$id = $_GET['id'];
	$database->query('SELECT * FROM revenue WHERE id = :id');
    $database->bind(':id', $id);
    $database->execute();
    $rowa = $database->resultset();

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if(isset($post['submit'])){
	$title  = $post['title'];
	$body   = $post['body'];
	$active = $post['active'];
	
	$database->query('UPDATE `revenue` SET title = :title, body = :body, active = :active WHERE id = :id');
	$database->bind(':title', $title);
	$database->bind(':body', $body);
	$database->bind(':active', $active);
	$database->bind(':id', $id);
	$senti = $database->execute();
	if($senti){
		$msg = "Revenue has been edited";
	}else{
	    $msg = "Unablet to edit diagnose";
	}
}

	
	if(isset($_POST['delete'])){
	$delete_id = $_POST['delete_id'];
	$database->query('DELETE FROM revenue WHERE id = :id');
	$database->bind(':id', $delete_id);
	$done = $database->execute();
		if($done){
	header('Location: show.php');
		}else{
			$msg = "unable to delete this revenue with id=" . $id;
		}
}
?>
<?php
foreach($rowa as $rowj) :
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
          <h1><i class="fa fa-edit"></i> Edit Revenue</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
         <i class="fa fa-home fa-lg"></i>
          <li class="breadcrumb-item"><a href="adddiagnose.php">Add Revenue</a></li>
		  <li class="breadcrumb-item"><a href="show.php">Groceries</a></li>
          <li class="breadcrumb-item">Edit revenue</li>
        </ul>
      </div>
      <?php if(isset($msg)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $msg; ?></p></center><?php } ?><div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Edit Revenue</h3>
            <div class="tile-body">
              <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
                <div class="form-group">
                  <label class="control-label">Title</label>
                  <input class="form-control" type="text" name="title" value="<?php echo $rowj['title']; ?>" required/>
                </div>
				<div class="form-group">
                  <label class="control-label">Solution</label>
                  <textarea class="form-control" type="text" rows="8" name="body" required /><?php echo $rowj['body']; ?></textarea>
                </div>
				
                <div class="form-group">
                  <label class="control-label">Activate</label>
                  <select class="form-control" name="active">
                  	<option value="1">Activate</option>
					<option value="0">Deactivate</option>
				  </select>
                </div>
                  <?php endforeach; ?>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox">I accept the terms and conditions
                    </label>
                  </div>
                </div>
            </div>
            <div class="tile-footer">
              <input class="btn btn-info" id="demoNotify" type="submit" name="submit" value="Edit">
            </div>
            </form>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            	<div class="tile-footer">
            	<input type="hidden" name="delete_id" value="<?php echo $rowj['id']; ?>">
              <input class="btn btn-info" id="demoNotify" type="submit" name="delete" value="Delete Post">
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
  </body>
</html>
<?php
}
?>