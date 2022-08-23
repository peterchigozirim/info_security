<?php
session_start();
include '../config.php';
if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
$employees = $conn->query('SELECT * FROM `employees`');
$rows = [];
while ($data = $employees->fetch_array()) {
  array_push($rows, $data);
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
          <h1><i class="fa fa-edit"></i> List of Employees</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">View All Employees</li>
        </ul>
      </div>
      
        <div class="clearfix"></div>

        <div class="row">
          <div class="col-12">
            <div class="tile">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                  <input class="form-control" type="search" name="search_criteria" id="search_criteria" placeholder="Search Personnel">
                  <!-- <select name="" class="custom-select">
                    <option value="all" selected>All Employees</option>
                    <option value="top">Top Level Managers</option>
                    <option value="mid">Mid Level Managers</option>
                    <option value="low">Low Level Managers</option>
                    <option value="others">Other Employees</option>
                  </select> -->
                  <select name="" id="emptype" class="custom-select">
                    <option value="all" selected>All Types</option>
                    <option value="Full Time">Full-Time Staff</option>
                    <option value="Part Time">Part-Time Staff</option>
                    <option value="Casual">Casual Staff</option>
                    <option value="Temporary">Temporary Staff</option>
                  </select>
                  </div>
                </div>

                <div class="col-md-6 text-right">
                  <a href="addpersonnel.php" class="btn btn-primary">
                    <i class="fa fa-user-plus"></i> Add New Personnel
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="emp_cards">
          <?php foreach($rows as $row): ?>
            <div class="col-md-4">
              <div class="tile">
                <div class="row">
                  <div class="col-4">
                    <a href="employee_details.php?empid=<?php echo $row['employee_id'] ?>">
                      <div class="image-container image-container-rounded">
                        <img src="images/employees/<?php echo $row['photo'] ?>" alt="<?php echo $row['employee_id'] ?>" class="img">
                      </div>
                    </a>
                  </div>
                  <div class="col-8">
                    <h5><a href="employee_details.php?empid=<?php echo $row['employee_id'] ?>"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></a></h5>
                    <p class="m-0">
                      <strong><?php echo $row['position'] ?></strong> <br>
                      <?php echo $row['emp_type'] ?>
                    </p>
                    <em>
                      <a href="employee_details.php?empid=<?php echo $row['employee_id'] ?>">
                        View Profile
                      </a>
                    </em>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?> 
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
    <!-- Google analytics script-->
    <script type="text/javascript">
      // Set Active Nav 
      $('.app-menu > li:nth-child(2) a').addClass('active');

      function fetchEmployees() {
        $val = $('#search_criteria').val();
        $emp_type = $('#emptype').val();
        $.ajax({
          type: 'post',
          url: 'backend/employee_mngr.php',
          data: {criteria: $val, action: 'search', emptype: $emp_type},
          dataType: 'json',
          success: function(res){
            $emp_cards = '';
            if(res.no_emp > 0){
              res.employees.forEach(employee => {
                $emp_cards += `<div class="col-md-4">
                                <div class="tile">
                                  <div class="row">
                                    <div class="col-4">
                                      <a href="employee_details.php?empid=${employee.employee_id}">
                                        <div class="image-container image-container-rounded">
                                          <img src="images/employees/${employee.photo}" alt="${employee.employee_id}" class="img">
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-8">
                                      <h5><a href="employee_details.php?empid=${employee.employee_id}">${employee.firstname} ${employee.lastname}</a></h5>
                                      <p class="m-0">
                                        <strong>${employee.position}</strong> <br>
                                        ${employee.emp_type}
                                      </p>
                                      <em>
                                        <a href="employee_details.php?empid=${employee.employee_id}">
                                          View Profile
                                        </a>
                                      </em>
                                    </div>
                                  </div>
                                </div>
                              </div>`;
              });
            }
            $('#emp_cards').html($emp_cards);
          }
        })
      }

      $('input[name=search_criteria]').on('keyup', function(){
          fetchEmployees();
      });
      $('#emptype').on('change', function(){
          fetchEmployees();
      });
    </script>
  </body>
</html>
<?php
}
?>