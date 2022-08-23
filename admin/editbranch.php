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
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Edit Branch</h1>
          <p>Sample branch</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
         <i class="fa fa-home fa-lg"></i>
          <li class="breadcrumb-item"><a href="addbranch.php">Add Branch</a></li>
		  <li class="breadcrumb-item"><a href="viewbranch.php">Branches</a></li>
          <li class="breadcrumb-item">Edit Branch</li>
        </ul>
      </div>
       <fieldset>	     
		 <table align="center">
		 <?php
    if(isset($_POST['Register'])){

$a = $_POST['a'];
$f = $_POST['b'];
$l = $_POST['c'];
$qtytaken =0;
$date =date('Y-m-d');



$qry1 = mysql_query("
	insert into  foodreg
	
	values(
	'',
		'$a',
		'$f',
		'$qtytaken',
		'$date',
		'$l'
		
		
	)
	");
	

			if($qry1){

				echo 'successfully registered... ';

				echo '<script type="text/javascript">

						var myVar=setInterval(function(){myTimer()},2000);

				function myTimer()
				{
					window.location="regfood.php";

				}
			</script>';
			}else {	echo mysql_error();	}

	
	}
?>
<form method="Post">
<legend style="background-color:purple; width:800px; color:white; border-radius: 10px;">Register Food here!</legend>

		<tr>
          <td><label>Food Name:<label></td>
          <td ><input type="text" autocomplete="off" name="a" tabindex="2" required /></td>
        </tr>
<tr>
          <td><label>Qty:<label></td>
          <td ><input type="text" autocomplete="off" name="b" tabindex="2" required /></td>
        </tr>
		

		<tr>
          <td><label>FoodType:<label></td>
          <td >
		  <select name="c" tabindex="2" required />
		  <option>Select<------->value</option>
	<?php	
		$result = mysql_query("SELECT * FROM  foodtype ORDER BY typeid  ASC");
		while( $row = mysql_fetch_array($result)){
		echo '<option value="'.$row['typeid'].'">'.$row['typeid'].'-'.$row['1'].'</option>';
		}
	?>
	</select>
		  
		  </td>
        </tr>
		<tr>
          <td></td>
          <td><input type="submit" style="background-color:green; width: 150px; color:white; border-radius: 10px;" name="Register" value="Register"/></td>
        </tr>
</fieldset>
	
				
				</table>
				
</form>
</div>
</div>
<!--############################################################################################################################################-->
<div id="footer"> 
<p>Copy right! <?php echo date('d-m-Y');?></p>




</div>
<!--##############################################################################################################################################-->

</body>
</html>

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