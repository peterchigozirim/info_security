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

        <div class="row">
          <div class="col-12">
            <div class="tile">
              <div class="row">
                <div class="col-md-6">
                  <!-- <div class="input-group">
                  <input class="form-control" type="search" name="search_criteria" id="search_criteria" placeholder="Search Client"> -->
                  <!-- <select name="" class="custom-select">
                    <option value="all" selected>All Employees</option>
                    <option value="top">Top Level Managers</option>
                    <option value="mid">Mid Level Managers</option>
                    <option value="low">Low Level Managers</option>
                    <option value="others">Other Employees</option>
                  </select> -->
                  <!-- <select name="" id="emptype" class="custom-select">
                    <option value="all" selected>All Types</option>
                    <option value="Full Time">Full-Time Staff</option>
                    <option value="Part Time">Part-Time Staff</option>
                    <option value="Casual">Casual Staff</option>
                    <option value="Temporary">Temporary Staff</option>
                  </select> -->
                  </div>
                </div>

                <div class="col-md-6 text-left">
                  <a href="addorganization.php" class="btn btn-primary">
                    <i class="fa fa-user-plus"></i> Add New Organzation
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

     
        <div class="row container">
        <?php foreach($rows as $row): ?>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">id</th>
                <th scope="col">Organization Name </th>
                <th scope="col">Organiztion Phone</th>
                <th scope="col">Organization Address</th>
                <th scope="col">Organization State</th>
                <th scope="col">Contract Lenght</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"><?php echo $row['organization_id'] ?></th>
                <td><?php echo $row['org_name'] ?></td>
                <td><?php echo $row['org_phone'] ?></td>
                <td><?php echo $row['org_address'] ?></td>
                <td><?php echo $row['org_state'] ?></td>
                <td><?php echo $row['period'] ?></td>
              </tr>
            </tbody>
          </table>
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
      $('.app-menu > li:nth-child(3) a').addClass('active');
      $('#staticBackdrop').modal('show');

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
        $emp_type = $('#emptype').val();
        $.ajax({
          type: 'post',
          url: 'backend/organzation_mngr.php',
          data: {criteria: $val, action: 'search', emptype: $emp_type},
          dataType: 'json',
          success: function(res){
            $emp_cards = '';
            if(res.no_emp > 0){
              res.employees.forEach(organzation => {
                $emp_cards += `<div class="col-md-4">
                                <div class="tile">
                                  <div class="row">
                                    <div class="col-4">
                                      <a href="employee_details.php?orgid=${organzation.organzation_id}">
                                        <div class="image-container image-container-rounded">
                                          <img src="" alt="${organzation.organzation_id}" class="img">
                                        </div>
                                      </a>
                                    </div>
                                    <div class="col-8">
                                      <h5><a href="employee_details.php?orgid=${organzation.organzation_id}">${organzation.firstname} ${organzation.lastname}</a></h5>
                                      <p class="m-0">
                                        <strong>${organzation.period}</strong> 
                                      </p>
                                      <em>
                                        <a href="employee_details.php?orgid=${organzation.organzation_id}">
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