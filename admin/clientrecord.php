<?php
session_start();
include '../config.php';
if(!$_SESSION['username']){
	header('Location: ../index.php');
	die();
}else{
$organzation = $conn->query('SELECT * FROM `organization`');
$rows = [];
while ($data = $organzation->fetch_array()) {
  array_push($rows, $data);
}
?>	
<!DOCTYPE html>
<html lang="en">
  <?php include'head.php'; ?>
  <body class="app sidebar-mini rtl">



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
          <form id="check">
            <div class="modal-header">
              <h5 class="modal-title text-capitalize" id="staticBackdropLabel">access code require</h5>
            
            </div>
            <div class="modal-body">
              <div class="alert alert-danger py-2 hidden alert-d" id="">
                <p class="text-danger mb-0 py-0">incorrect access code</p>
              </div>
              <div class="form-group">
                <label for="text">Access code</label>
                <input type="password" class="form-control" id="access_code" placeholder="Enter Access Code">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Authenticate</button>
            </div>
          </form>
            
        </div>
      </div>
    </div>
    <!-- Navbar-->
    <?php include'topnav.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include'nav.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> List of Client</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">View All Client</li>
        </ul>
      </div>
      
        <div class="clearfix"></div>

        <div class="row">
          <div class="col-12">
            <div class="tile">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                  <input class="form-control" type="search" name="search_criteria" id="search_criteria" placeholder="Search Client">
                  </div>
                </div>

                <div class="col-md-6 text-right">
                  <a href="addorganization.php" class="btn btn-primary">
                    <i class="fa fa-user-plus"></i> Add New Client
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
                  <div class="col-8">
                    <h5><a href="organization_details.php?orgid=<?php echo $row['organization_id'] ?>"><?php echo $row['client_firstname'] . ' ' . $row['client_lastname'] ?></a></h5>
                    <p class="m-0">
                      <strong><?php echo $row['period'] ?></strong>
                    </p>
                    <em>
                      <a href="organization_details.php?orgid=<?php echo $row['organization_id'] ?>">
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
    <style>
      .hidden{
        display: none !important;
      }
    </style>
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
     $(document).ready(function () {
      $('#staticBackdrop').modal('show');
      $('.app-menu > li:nth-child(3) a').addClass('active');


      $('#check').submit(function (e) { 
        e.preventDefault();
        let access_code = $('#access_code').val();
        let code  = 'org1234';
        if (access_code != code) {
            
          $('.alert-d').removeClass('hidden');
          }
        else{
          if (access_code == code) {
          $('#staticBackdrop').modal('hide');
        }
        }
        
        
      });

      function fetchEmployees() {
        $val = $('#search_criteria').val();
        $.ajax({
          type: 'post',
          url: 'backend/organization_mngr.php',
          data: {criteria: $val, action: 'search'},
          dataType: 'json',
          success: function(res){
            $emp_cards = '';
            if(res.no_emp > 0){
              res.employees.forEach(employee => {
                $emp_cards += `<div class="col-md-4">
                                <div class="tile">
                                  <div class="row">
                                    <div class="col-4">
                                      <a href="organization_details.php?orgid=${employee.employee_id}">
                                        <div class="image-container image-container-rounded">
                                          <img src="images/employees/${employee.photo}" alt="${employee.employee_id}" class="img">
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-8">
                                      <h5><a href="organization_details.php?orgid=${employee.employee_id}">${employee.firstname} ${employee.lastname}</a></h5>
                                      <p class="m-0">
                                        <strong>${employee.position}</strong> <br>
                                        ${employee.emp_type}
                                      </p>
                                      <em>
                                        <a href="organization_details.php?orgid=${employee.employee_id}">
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
     });
    </script>
  </body>
</html>
<?php
}
?>