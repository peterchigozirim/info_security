<?php
session_start();
include '../config.php';
if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
    if (isset($_GET['empid'])) {
        $empid = $_GET['empid'];
    } else {
        header('Location: show.php');
    }
    
    $employees = $conn->query("SELECT * FROM `employees` WHERE employee_id='$empid'");
    if ($employees->num_rows > 0) {
        $employee = $employees->fetch_array();
    } else {
        header('Location: show.php');
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
          <h1><i class="fa fa-edit"></i> Employee Details</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="show.php">View All Employees</a></li>
          <li class="breadcrumb-item"> <?php ?> Details</li>
        </ul>
      </div>
      
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-5">
                <div class="image-container">
                    <img src="images/employees/<?php echo $employee['photo'] ?>" alt="<?php echo $employee['employee_id'] ?>" class="img-rounded-edge mx-auto">
                </div>
                <h4 class="text-center mt-4">
                  <?php echo $employee['employee_id'] ?> <br>
                  <a href="editemployee.php?empid=<?php echo $employee['employee_id'] ?>" class="btn btn-primary">
                    Edit <?php echo $employee['firstname'] ?>'s Profile
                  </a>
                </h4>
            </div>
            <div class="col-md-7">
              <div class="tile p-0">
              <!-- Start Accordion -->
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Personel Bio-Data
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <input type="hidden" name="empid" value="<?php echo $employee['employee_id'] ?>">
                      <div class="">
                          <label><strong>Firstname: </strong></label> 
                          <?php echo $employee['firstname'] ?>
                      </div>
                      <div class="">
                          <label><strong>Lastname: </strong></label> 
                          <?php echo $employee['lastname'] ?>
                      </div>
                      <div class="">
                          <label><strong>Phone Number: </strong></label> 
                          <?php echo $employee['phone'] ?>
                      </div>
                      <div class="">
                          <label><strong>Gender: </strong></label> 
                          <?php echo $employee['gender'] ?>
                      </div>
                      <div class="">
                          <label><strong>Date of Birth: </strong></label> 
                          <?php echo date('F dS, Y', strtotime($employee['dob'])) ?>
                      </div>
                      <div class="">
                          <label><strong>Address: </strong></label> 
                          <?php echo $employee['address'] ?>
                      </div>
                      <div class="">
                          <label><strong>State of Origin: </strong></label> 
                          <?php echo $employee['soo'] ?>
                      </div>
                      <div class="">
                          <label><strong>Tax No: </strong></label> 
                          <?php echo $employee['tax'] ?>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Position Details
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <div class="">
                          <label><strong>Position: </strong></label> 
                          <?php echo $employee['position'] ?>
                      </div>
                      <div class="">
                          <label><strong>Start Date: </strong></label> 
                          <?php echo date('F dS, Y', strtotime($employee['start_date'])) ?>
                      </div>
                      <div class="">
                          <label><strong>Employment Type: </strong></label> 
                          <?php echo $employee['emp_type'] ?>
                      </div>
                      <div class="">
                          <label><strong>Expected Work Hours: </strong></label> 
                          <?php echo $employee['work_hour'] . ' hrs/Week' ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Bank Details
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      <div class="">
                          <label><strong>Bank: </strong></label> 
                          <?php echo $employee['bank'] ?>
                      </div>
                      <div class="">
                          <label><strong>Account Number: </strong></label> 
                          <?php echo $employee['acc_number'] ?>
                      </div>
                      <div class="">
                          <label><strong>Account Type: </strong></label> 
                          <?php echo $employee['acc_type'] ?>
                      </div>
                      <div class="">
                          <label><strong>Bank Sort Code: </strong></label> 
                          <?php echo $employee['sort'] ?>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- New Details -->
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Qualification and Salary
                      </button>
                    </h5>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      <div class="">
                          <label><strong>Qualification: </strong></label> 
                          <?php echo $employee['qualification'] ?>
                      </div>
                      <div class="">
                          <label><strong>Date Obtained: </strong></label> 
                          <?php echo $employee['date_obtained'] ?>
                      </div>
                      <div class="">
                          <label><strong>Basic Salary: </strong></label> 
                          <?php echo $employee['salary'] ?>
                      </div>
                      <div class="">
                          <label><strong>Entitled Allowances: </strong></label> 
                          <?php echo $employee['allowance'] ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Accordion -->
              </div>
            </div>
        </div>

        <div class="my-4">
            <?php include_once 'charts.php' ?>
        </div>

         
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