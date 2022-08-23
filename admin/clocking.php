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
          <h1><i class="fa fa-history"></i> Attendance</h1>
          <p>Staff Clocking Module</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="tile">
            <h3 class="tile-title">Find Personnel</h3>
            <form name="frm_search_emp">
                <div class="mb-4">
                    <label for="emp_id">Personnel's ID</label>
                    <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Enter Personnel's ID" required />
                </div>
                
                <div>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-search"></i> Fetch Personnel
                    </button>
                </div>
            </form>
          </div>
        </div>
        <div class="col-md-8">
          <div class="tile" style="min-height:400px;">
            <h3 class="tile-title">Personnel Details</h3>
            <div id="emp_details">
                
            </div>
          </div>
        </div>
      </div>
    </main>

    <div class="modal fade" id="attnd_modal">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    Hello
                </div>
            </div>
        </div>
    </div>
	  
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
     
    // Set Active Nav
    $('.app-menu > li:nth-child(3) a').addClass('active');
    $('form[name=frm_search_emp]').on('submit', function (e) {
        e.preventDefault();
        $emp_id = $('input[name=emp_id]').val();
        $.ajax({
            type:'post',
            url:'backend/attendance_mngr.php',
            data:{action:'fetch_employee_details', empid:$emp_id},
            dataType:'json',
            success:function (res) {
                let employee = res.employee
                let details = `<div class="row">
                    <div class="col-md-4">
                        <div class="image-container">
                            <img src="images/employees/${employee.photo}" alt="${employee.employee_id}" class="img-rounded-edge mx-auto">
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="tile p-0">
                    <!-- Start Accordion -->
                    <div id="accordion">
                        <div class="card">
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                <div class="">
                                    <label><strong>Firstname: </strong></label> 
                                    ${employee.firstname}
                                </div>
                                <div class="">
                                    <label><strong>Lastname: </strong></label> 
                                    ${employee.lastname}
                                </div>
                                <div class="">
                                    <label><strong>Phone Number: </strong></label> 
                                    ${employee.phone}
                                </div>
                                <div class="">
                                    <label><strong>Gender: </strong></label> 
                                    ${employee.gender}
                                </div>
                                <div class="">
                                    <label><strong>Address: </strong></label> 
                                    ${employee.address}
                                </div>
                                <div class="">
                                    <label><strong>State of Origin: </strong></label> 
                                    ${employee.soo}
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Accordion -->
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-md-8">
                            <div class="mb-2 clock_status">
                                
                            </div>
                            <form class="record_frm" method="post">
                                <div class="row">
                                    <input type="hidden" name="empid" value="${employee.employee_id}">
                                    <div class="form-group col-6">
                                        <input type="text" name="token" id="token" placeholder="Daily Secret Token" title="Enter Employee Daily Token" required class="form-control" style="background-color:rgba(255,255,255,0.8);">
                                    </div>
                                    <div class="form-group col-6">
                                        <button class="btn btn-primary text-light">
                                            Record Presence
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>`;
                $('#emp_details').html(details);
            }
        })
    });
    
    $('#emp_details').on('submit', '.record_frm', function (e){
        e.preventDefault();
        $emp_id = $('input[name=empid]').val();
        $token = $('input[name=token]').val();
        $.ajax({
            type:'post',
            url:'backend/attendance_mngr.php',
            data:{action:'record_attendance', empid:$emp_id, token:$token},
            dataType:'json',
            success:function (res) {
                if(res.status == 'success'){
                    $('#attnd_modal .modal-body').html(`<i class="fa fa-check-circle text-success"> ${res.message} </i>`);
                }else if(res.status == 'taken'){
                    $('#attnd_modal .modal-body').html(`<i class="fa fa-times-circle text-danger">  ${res.message}  </i>`);
                }else{
                    $('#attnd_modal .modal-body').html(`<i class="fa fa-times-circle text-danger">  ${res.message} </i>`);
                }
                $('#attnd_modal').modal('show');
            }
        });
    })
    </script>
    
  </body>
</html>
<?php	
}
?>