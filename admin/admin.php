<?php
session_start();
include_once('../config.php');
if(!$_SESSION['username']){
	header('Location: ../index.php');
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
    <?php include 'nav.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Admin Dashboard</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Clients Analysis</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
            <div class="row" style="margin-top:10px;">
              <div class="col-md-6"><span class="key" id="key5"></span> Clients</div>
              <div class="col-md-6"><span class="key" id="key6"></span> Contracts</div>
            </div>
          </div>
        </div>
      </div>

<!-- Table -->
      <div class="clearfix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">
              Clients General Records
              <a href="addpersonnel.php" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-user-plus"></i> Add New Security Personnel
              </a>
            </h3>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Client Firstname</th>
                    <th>Client Lastname</th>
                    <th>Phone</th>
					          <th>Organization</th>    
					          <th></th>  
                  </tr>
                </thead>
                <tbody id="employees">
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </main>
	  
	  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href);
    }
</script>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May", "June", "July"],
      	datasets: [
      		{
      			label: "Sick Refugee",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56, 32, 50]
      		},
      		{
      			label: "Healthy Refugee",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86, 42, 56]
      		}
      	]
      };
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);

      function loadClients() {
        $.ajax({
          type:'post',
          url:'backend/statistics.php',
          data:{action:'fetch_employees_stats'},
          dataType:'json',
          success:function (res) {
            employees = '';
            console.log(res);
            res.employees.forEach(employee => {
              employees += `<tr>                   
                    <td>${employee.organzation_id}</td>
                    <td>${employee.client_firstname}</td>
                    <td>${employee.client_lastname}</td>
                    <td>${employee.phone}</td>
                    <td>${employee.org_name}</td>
					          <td>
                    <a href="employee_details.php?empid=${employee.organzation_id}"><i class="fa fa-eye mr-2"></i></a>
                      <a href="editemployee.php?empid=${employee.organzation_id}"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>`;
            });
            $('#employees').html(employees)
          }
        })
      }
      loadClients();
      
    // Set Active Nav
    $('.app-menu > li:nth-child(1) a').addClass('active');
    function fetchStatistics() {
      $.ajax({
        type:'post',
        url:'backend/statistics.php',
        data:{action:'general'},
        dataType:'json',
        success:function (stats) {
          console.log(stats);
        }
      })
    }
    fetchStatistics();
    </script>
    
  </body>
</html>
<?php	
}
?>