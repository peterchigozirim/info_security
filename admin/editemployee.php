<?php
session_start();
include '../config.php';

if(!$_SESSION['username']){
	header('location: ../index.php');
	die();
}else{
    // Get the employees details
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

    // Prepare and Update Records
$post =	filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);	
if(isset($post['update'])){
  $fname = $post['fname'];
  $lname = $post['lname'];
  $gender = $post['gender'];
  $dob  = $post['dob'];
  $address  = $post['address'];
  $phone  = $post['phone'];
  $soo  = $post['soo'];
  $taxno  = $post['taxno'];
  $position  = $post['position'];
  $start_date  = $post['start_date'];
  $emp_type  = $post['emp_type'];
  $no_hours  = $post['no_hours'];
  $bank  = $post['bank'];
  $acc_type  = $post['acc_type'];
  $acc_no  = $post['acc_no'];
  $sort  = $post['sort'];
  $qualification  = $post['qualification'];
  $salary  = $post['salary'];
  $allowance  = $post['allowance'];
  $date_obtained  = $post['date_obtained'];
  $process = true;
  $photo = $employee['photo'];

  // Generate Employee ID
  $emps = $conn->query("SELECT * FROM employees");
  $newno = $emps->num_rows + 1;
  

  // Process Image
  if ($_FILES['photo']['name'] != '') {
    $allowedExt = ['png', 'jpg', 'jpeg', 'webm'];
    $photo = $_FILES['photo']['name'];
    $tempfile = $_FILES['photo']['tmp_name'];
    $filename = strtolower(pathinfo($photo, PATHINFO_FILENAME));
    $fileext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
    if (in_array($fileext, $allowedExt)) {
        $photo = strtolower($empid) . time() . '.' . $fileext;
        if(move_uploaded_file($tempfile, 'images/employees/' . $photo)){
            if($employee['photo'] != 'default.png'):
                unlink('images/employees/'.$employee['photo']);
            endif;
            $process = true;
        }else{
            $photo = $employee['photo'];
            $success .= "Image not saved! ";
            $process = true;
        }
    }else{
      $photo = $employee['photo'];
      $error = "Invalid Image Type";
      $process = false;
    }
  }

  if ($process) {
    $sent = $conn->query("UPDATE employees SET firstname='$fname', lastname='$lname', gender='$gender', dob='$dob', address='$address', phone='$phone', soo='$soo', tax='$taxno', position='$position', start_date='$start_date', emp_type='$emp_type', 
        work_hour='$no_hours', bank='$bank', acc_type='$acc_type', acc_number='$acc_no', sort='$sort', qualification='$qualification', date_obtained='$date_obtained', salary='$salary', allowance='$allowance', photo='$photo'
                    WHERE employee_id='$empid'");
    if($sent){
      $success .= $fname . " details has been updated successfully";
      header('refresh:1');
    }else{
      $error = "An error occured, please review your forms: " . $conn->error;
    }
  } 
  	
}
?>
<!DOCTYPE html>
<html lang="en">
  <?php include'head.php'; ?>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'topnav.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include'nav.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Add Personnel</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">Add New Personnel</li>
        </ul>
      </div>
      <?php if(isset($success)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $success; ?></p></center><?php } ?>
      <?php if(isset($error)){ ?><center><p class="btn btn-danger" id="demoNotify"><?php echo $error; ?></p></center><?php } ?>
      <div class="tile">
        <h3 class="tile-title">Add New Personnel </h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <div class="tile-body">
            <div class="row">
              <!-- First Column -->
              <div class="col-md-6">
                <div class="form-group text-center">
                  <img src="<?php echo 'images/employees/' . $employee['photo'] ?>" alt=" " class="mx-auto img" id="photo_preview" style="max-width:100px;">
                  <button type="button" class="btn btn-primary d-block mx-auto" id="btn_upload">
                    Upload Photo
                  </button>
                  <div class="d-none">
                    <input type="file" name="photo" id="photo_inp">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Personnel's Firstname</label>
                  <input class="form-control" type="text" name="fname" placeholder="Personnel's Firstname" required value="<?php echo $employee['firstname'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Personnel's Lastname</label>
                  <input class="form-control" type="text" name="lname" placeholder="Personnel's Lastname" required value="<?php echo $employee['lastname'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Gender</label>
                  <select class="form-control" name="gender" required >
                    <option value="<?php echo $employee['gender'] ?>" selected><?php echo $employee['gender'] ?></option>
                    <?php if ($employee['gender'] == 'female'): ?>
                    <option value="Male">Male</option>
                    <?php else: ?>
                    <option value="Female">Female</option>
                    <?php endif ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Date of Birth</label>
                  <input class="form-control" type="date" name="dob" placeholder="Personnel's Date of Birth" value="<?php echo $employee['dob'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Address</label>
                  <input class="form-control" type="text" name="address" placeholder="Employee Address" value="<?php echo $employee['address'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Contact Phone</label>
                  <input class="form-control" type="tel" name="phone" placeholder="Phone Number" value="<?php echo $employee['phone'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">State of Origin</label>
                  <input class="form-control" type="text" name="soo" placeholder="State of Origin" value="<?php echo $employee['soo'] ?>" />
                </div>
                <div class="form-group mb-5 mb-md-3">
                  <label class="control-label">Tax File Number <small>(If any?)</small></label>
                  <input class="form-control" type="text" name="taxno" placeholder="Enter Tax Number if any?" value="<?php echo $employee['tax'] ?>" />
                </div>
              </div>
              <!-- Second Column -->
              <div class="col-md-6">
                  <h5 class="mt-3">
                    <strong>
                      Position Details
                    </strong>
                  </h5>
                  <hr>
                <div class="form-group">
                  <label class="control-label">Position Title <small>(If any?)</small></label>
                  <select class="custom-select" name="position" required >
                    <option value="<?php echo $employee['position'] ?>"><?php echo $employee['position'] ?></option>
                    <option value="Branch Manager">Branch Manager</option>
                    <option value="Regional Manager">Regional Manager</option>
                    <option value="Managing Director">Managing Director</option>
                    <option value="Procurement Officer">Procurement Officer</option>
                    <option value="Marketer">Marketer</option>
                    <option value="Accountant">Accountant</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Stock Keeper">Stock Keeper</option>
                    <option value="Logistics Manager">Logistics Manager</option>
                    <option value="Human Resource Manager">Human Resource Manager</option>
                    <option value="General Manager">General Manager</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Start Date</label>
                  <input class="form-control" type="date" name="start_date" placeholder="Start Date" required value="<?php echo $employee['start_date'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Employment Type</label>
                  <select class="form-control" name="emp_type" required >
                    <option value="<?php echo $employee['dob'] ?>"><?php echo $employee['emp_type'] ?></option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Casual">Casual</option>
                    <option value="Temporary">Temporary</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Expected Work Hours/week</label>
                  <input class="form-control" type="number" name="no_hours" placeholder="Work Hours Per week" value="<?php echo $employee['work_hour'] ?>"  />
                </div>

                <h5 class="mt-5">
                    <strong>
                      Bank Details
                    </strong>
                  </h5>
                <hr>
                <div class="form-group">
                  <label class="control-label">Bank Name</label>
                  <input class="form-control" type="text" name="bank" placeholder="Enter Bank Name" required value="<?php echo $employee['bank'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Account Number</label>
                  <input class="form-control" type="number" name="acc_no" placeholder="Enter Account Number" required value="<?php echo $employee['acc_number'] ?>" />
                </div>
                <div class="form-group">
                  <label class="control-label">Account Type</label>
                  <select class="form-control" name="acc_type" required >
                    <option value="<?php echo $employee['acc_type'] ?>"><?php echo $employee['acc_type'] ?></option>
                    <option value="Savings">Savings</option>
                    <option value="Current">Current</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Bank Sort Number</label>
                  <input class="form-control" type="text" name="sort" placeholder="Enter Sort Number" value="<?php echo $employee['sort'] ?>" />
                </div>

              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-12">
                <h5 class="mt-3">
                  <strong>
                    Qualification and Salary
                  </strong>
                </h5>
                <hr>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Qualification</label>
                  <select class="custom-select" name="qualification" required >
                    <option value="<?php echo $employee['qualification'] ?>"><?php echo $employee['qualification'] ?></option>
                    <option value="O'Level">O'Level</option>
                    <option value="ND">ND</option>
                    <option value="HND">HND</option>
                    <option value="B.Sc/B.Art/B.Tech">B.Sc/B.Art/B.Tech</option>
                    <option value="PGD">PGD</option>
                    <option value="M.Sc/M.Art">M.Sc/M.Art</option>
                    <option value="PhD">PhD</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Date Obtained</label>
                  <input class="form-control" type="date" name="date_obtained" placeholder="Select Date Qualification was obtained" value="<?php echo $employee['date_obtained'] ?>" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Basic Salary</label>
                  <input class="form-control" type="number" name="salary" placeholder="Enter Basic Salary" value="<?php echo $employee['salary'] ?>" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Entitled Allowances</label>
                  <select class="custom-select" name="allowance" required >
                    <option value="<?php echo $employee['allowance'] ?>"><?php echo $employee['allowance'] ?></option>
                    <option value="No Allowance">No Allowance</option>
                    <option value="Transport Allowance">Transport Allowance</option>
                    <option value="Transport/Feeding Allowance">Transport/Feeding Allowance</option>
                    <option value="Transport/Feeding/Wardrobe Allowance">Transport/Feeding/Wardrobe Allowance</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="tile-footer">
              <button class="btn btn-info" id="demoNotify" type="submit" name="update">
                <i class="fa fa-save"></i> Update Personnel's Record
              </button>
          </div>
        </form>
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
<script>
		var str = "Test\n\n\Test\n\Test";
    str.replace(/\r\n|\r|\n/g,'&#13;&#10;');

    $('#btn_upload').on('click', function(){
      $('#photo_inp').trigger('click');
    })

    $('#photo_inp').on('change', function (e) {
      let reader = new FileReader();
      if (e.target.files && e.target.files[0]) { 
        reader.onload = function(e){
          $('#photo_preview').fadeOut();
          $('#photo_preview').attr('src', e.target.result);
          $('#photo_preview').fadeIn();
        }
        reader.readAsDataURL(e.target.files[0]);
      }
    })

    // Set Active Nav 
    $('.app-menu > li:nth-child(2) a').addClass('active');

  </script>
  </body>
</html>
<?php
}
?>