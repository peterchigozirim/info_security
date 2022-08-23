<?php
session_start();
include '../config.php';

if(!$_SESSION['username']){
	header('location: ../index.php');
	die();
}else{
$post =	filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);	
if(isset($post['submit'])){
  $fname = $post['fname'];
  $lname = $post['lname'];
  // $gender = $post['gender'];
  // $dob  = $post['dob'];
  $address  = $post['address'];
  $phone  = $post['phone'];
  $soo  = $post['soo'];
  // Organzation Details

  $oname = $post['oname'];
  $oaddress = $post['oaddress'];
  $ophone = $post['ophone'];
  $osoo = $post['osoo'];
  // $taxno  = $post['taxno'];
  $period  = $post['period'];
  $start_date  = $post['start_date'];
  $end_date  = $post['end_date'];
  // $emp_type  = $post['emp_type'];
  // $no_hours  = $post['no_hours'];
  // $bank  = $post['bank'];
  // $acc_type  = $post['acc_type'];
  // $acc_no  = $post['acc_no'];
  // $sort  = $post['sort'];
  $process = true;
  // $photo = 'default.png';

  // Generate Employee ID
  $emps = $conn->query("SELECT * FROM organzation");
  $newno = $emps->num_rows + 1;

  $orgid = sprintf('%04d', $newno);
  $orgid = strtoupper('org-' . $orgid);
  

  // Process Image
  // if ($_FILES['photo']['name'] != '') {
  //   $allowedExt = ['png', 'jpg', 'jpeg', 'webm'];
  //   $photo = $_FILES['photo']['name'];
  //   $tempfile = $_FILES['photo']['tmp_name'];
  //   $filename = strtolower(pathinfo($photo, PATHINFO_FILENAME));
  //   $fileext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
  //   if (in_array($fileext, $allowedExt)) {
  //     $photo = strtolower($empid) . '.' . $fileext;
  //     if(move_uploaded_file($tempfile, 'images/employees/' . $photo)){
  //       $process = true;
  //     }else{
  //       $photo = 'default.png';
  //       $success .= "Image not saved! ";
  //       $process = true;
  //     }
  //   }else{
  //     $photo = 'default.png';
  //     $error = "Invalid Image Type";
  //     $process = false;
  //   }
  // }

  if ($process) {
    $sent = $conn->query("INSERT INTO organzation(organzation_id,  client_firstname, client_lastname, address, phone, soo, org_name, org_address, org_phone, org_state,  period, start_date, end_date) 
                    VALUES ('$orgid','$fname', '$lname',  '$address', '$phone', '$soo', '$oname', '$oaddress', '$ophone', '$osoo', '$period', '$start_date', '$end_date')");
    if($sent){
      $success .= $fname . " details has been added!";
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
          <h1><i class="fa fa-edit"></i> Add Client</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
          <li class="breadcrumb-item">Add New Client</li>
        </ul>
      </div>
      <?php if(isset($success)){ ?><center><p class="btn btn-info" id="demoNotify"><?php echo $success; ?></p></center><?php } ?>
      <?php if(isset($error)){ ?><center><p class="btn btn-danger" id="demoNotify"><?php echo $error; ?></p></center><?php } ?>
      <div class="tile">
        <h3 class="tile-title">Add Organzation </h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <div class="tile-body">
            <div class="row">
              <!-- First Column -->
              <div class="col-md-6">
                <h5 class="mt-3">
                  <strong>
                    Client's Details
                  </strong>
                </h5>
                  <hr>
                <div class="form-group">
                  <label class="control-label">Client's Firstname</label>
                  <input class="form-control" type="text" name="fname" placeholder="Client Firstname" required />
                </div>
                <div class="form-group">
                  <label class="control-label">Client's Lastname</label>
                  <input class="form-control" type="text" name="lname" placeholder="Client Lastname" required />
                </div>
               
                <div class="form-group">
                  <label class="control-label">Address</label>
                  <input class="form-control" type="text" name="address" placeholder="Client Address" />
                </div>
                <div class="form-group">
                  <label class="control-label">Contact Phone</label>
                  <input class="form-control" type="tel" name="phone" placeholder="Phone Number" />
                </div>
                <div class="form-group">
                  <label class="control-label">State of Origin</label>
                  <input class="form-control" type="text" name="soo" placeholder="State of Origin" />
                </div>
                <hr>
                <h5 class="mt-3">
                    <strong>
                      Organzation Details
                    </strong>
                  </h5>
                  <hr>
                <!-- <div class="form-group text-center">
                  <img src="images/file-upload.png" alt=" " class="mx-auto img" id="photo_preview" style="max-width:100px;">
                  <button type="button" class="btn btn-primary d-block mx-auto" id="btn_upload">
                    Upload Photo
                  </button>
                  <div class="d-none">
                    <input type="file" name="photo" id="photo_inp">
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="control-label">Organzation Name</label>
                  <input class="form-control" type="text" name="oname" placeholder="Organzation Name" required />
                </div>
                
                <div class="form-group">
                  <label class="control-label">Contact Address</label>
                  <input class="form-control" type="text" name="oaddress" placeholder="Contact Address" />
                </div>
                <div class="form-group">
                  <label class="control-label">Contact Phone</label>
                  <input class="form-control" type="tel" name="ophone" placeholder="Contact Phone" />
                </div>
                <div class="form-group">
                  <label class="control-label">State of Origin</label>
                  <input class="form-control" type="text" name="osoo" placeholder="State of Origin" />
                </div>
                

              </div>
              <!-- Second Column -->
              <div class="col-md-6">
                  <h5 class="mt-3">
                    <strong>
                      Contract Type
                    </strong>
                  </h5>
                  <hr>
                <div class="form-group">
                  <label class="control-label">Contract period </label>
                  <select class="custom-select text-capitalize" name="period" required >
                    <option value="">Select contract period</option>
                    <option value="Six month">Six month</option>
                    <option value="One Year">One Year</option>
                    <option value="Two Years">Two Years</option>
                    <option value="Five Years">Five years</option>
                    <option value="Ten Years">Ten Years</option>
                  </select>
                </div>
                <div class="form-group text-capitalize">
                  <label class="control-label">contract start Date</label>
                  <input class="form-control" type="date" name="start_date" placeholder="Start Date" required />
                </div>
                <div class="form-group text-capitalize">
                  <label class="control-label">contract end Date</label>
                  <input class="form-control" type="date" name="end_date" placeholder="End Date" required />
                </div>

              </div>
            </div>
            <!-- <div class="row mt-2">
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
                    <option value="">SELECT QUALIFICATION</option>
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
                  <input class="form-control" type="date" name="date_obtained" placeholder="Select Date Qualification was obtained" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Basic Salary</label>
                  <input class="form-control" type="number" name="salary" placeholder="Enter Basic Salary" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Entitled Allowances</label>
                  <select class="custom-select" name="allowance" required >
                    <option value="">CHOOSE ENTITLEMENT</option>
                    <option value="No Allowance">No Allowance</option>
                    <option value="Transport Allowance">Transport Allowance</option>
                    <option value="Transport/Feeding Allowance">Transport/Feeding Allowance</option>
                    <option value="Transport/Feeding/Wardrobe Allowance">Transport/Feeding/Wardrobe Allowance</option>
                  </select>
                </div>
              </div>
            </div> -->
          </div>
          <div class="tile-footer">
              <button class="btn btn-info" id="demoNotify" type="submit" name="submit">
                <i class="fa fa-save"></i> Save Details
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
    $('.app-menu > li:nth-child(3) a').addClass('active');

  </script>
  </body>
</html>
<?php
}
?>