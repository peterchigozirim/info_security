<?php
session_start();
include '../config.php';
if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
    if (isset($_GET['orgid'])) {
        $orgid = $_GET['orgid'];
    } else {
        header('Location: clientrecord.php');
    }
    
    $organization = $conn->query("SELECT * FROM `organization` WHERE organization_id='$orgid'");
    $conn->error;
    if ($organization->num_rows > 0) {
        $organization = $organization->fetch_array();
    } else {
      echo 'error';
        // header('Location: clientrecord.php');
    }
    
?>	
<!DOCTYPE html>
<html lang="en">
  <?php include'head.php'; ?>
  <script src="js/jquery-3.2.1.min.js"></script>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include'topnav.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include'nav.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Organization Details</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item"> <?php ?> Details</li>
        </ul>
      </div>
      
        <div class="clearfix"></div>

        <div class="row">
           
            <div class="col-md-7">
              <div class="tile p-0">
              <!-- Start Accordion -->

              <div class="card">
                <div class="card-header">
                  <h5>Client Bio-Data</h5>
                </div>
                <div class="card-body">
                      <input type="hidden" name="empid" value="<?php echo $organization['organization_id'] ?>">
                      <div class="">
                          <label><strong>Firstname: </strong></label> 
                          <?php echo $organization['client_firstname'] ?>
                      </div>
                      <div class="">
                          <label><strong>Lastname: </strong></label> 
                          <?php echo $organization['client_lastname'] ?>
                      </div>
                      <div class="">
                          <label><strong>Phone Number: </strong></label> 
                          <?php echo $organization['phone'] ?>
                      </div>
                      
                      <div class="">
                          <label><strong>Address: </strong></label> 
                          <?php echo $organization['address'] ?>
                      </div>
                      <div class="">
                          <label><strong>State of Origin: </strong></label> 
                          <?php echo $organization['soo'] ?>
                      </div>
                      
                    </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h5>
                    Contract Details
                  </h5>
                </div>
                <div class="card-body">
                  <div class="">
                      <label><strong>Organization Name: </strong></label> 
                       <?php echo $organization['org_name'] ?>
                  </div>
                  <div class="">
                      <label><strong>Period: </strong></label> 
                      <?php echo $organization['period'] ?>
                  </div>
                  <div class="">
                      <label><strong>Start Date: </strong></label> 
                      <?php echo date('F dS, Y', strtotime($organization['start_date'])) ?>
                  </div>
                  <div class="">
                      <label><strong>Start Date: </strong></label> 
                      <?php echo date('F dS, Y', strtotime($organization['end_date'])) ?>
                  </div>
                </div>
              </div>
              
              <!-- End Accordion -->
              </div>
            </div>
        </div>

        <!-- <div class="my-4">
            <?php include_once 'charts.php' ?>
        </div> -->

         
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    
    <!-- Google analytics script-->
    <script type="text/javascript">
      // Set Active Nav 
      $('.app-menu > li:nth-child(2) a').addClass('active');
    </script>
  </body>
</html>
<?php
}
?>