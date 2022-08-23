<?php 
    include_once 'config.php';

    $action = $_POST['action'];

    if ($action == 'fetch_stats') {
        $empid = $_POST['empid'];
        $attd = $conn->query("SELECT * FROM attendance WHERE employee_id='$empid'");

        if ($attd->num_rows > 0) {
            // Get Month Label
            $mon_labels = computeMonths();

            // Compute statistics
            $mon_data = [];
            foreach ($mon_labels as $month) {
                $no_attd = getMonthlyAttd($empid, $month, $conn);
                array_push($mon_data, $no_attd);
            }



            echo json_encode([
                'status' => 'success',
                'stats' => [
                    'mon_labels' => $mon_labels,
                    'mon_data' => $mon_data,
                ]
            ]);
        } else {
            # code...
        }
        
    }elseif($action == 'fetch_employee_details'){
        $empid = $_POST['empid'];
        $sql_stmt = "SELECT * FROM employees WHERE employee_id='$empid'";
        $sql_query = $conn->query($sql_stmt);
        if($sql_query and $sql_query->num_rows > 0){
            $employee = $sql_query->fetch_assoc();
            echo json_encode([
                'status' => 'success',
                'employee' => $employee
            ]);
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'User not found! Please try again.'
            ]);
        }
    }elseif($action == 'record_attendance'){
        $tokenArray = ['12345', 'asdf1234', 'zx1234', 'qwe2021'];
        
        $empid = $_POST['empid'];
        $token = $_POST['token'];

        if (in_array($token, $tokenArray)) {
            $query = $conn->query("SELECT * FROM employees WHERE employee_id='$empid'");
            if($query->num_rows > 0){
                // Check if he has taken attendance for today
                if(taken($empid, $conn) == false){
                    $insert = $conn->query("INSERT INTO attendance(employee_id) VALUES('$empid')");
                    if($insert){
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Employee attendance recorded successfully'
                        ]);
                    }else{
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'An unexpected error occurred!'
                        ]);
                    }
                }else{
                    echo json_encode([
                        'status' => 'taken',
                        'message' => 'ALREADY RECORDED! You can not record your attendance twice for a day!'
                    ]);
                }
            }else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Employee records not found!'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid Attendance Token!'
            ]);
        }
    }


    function computeMonths(){
        $months = [];
        for ($i=5; $i >= 0; $i--) { 
            array_push($months, date("F", strtotime("-". $i ." months")));
        }
        return $months;
    }

    function getMonthlyAttd($empid, $month, $conn){
        $attd = $conn->query("SELECT * FROM attendance WHERE employee_id='$empid'");
        $no = 0;
        while ($attend = $attd->fetch_array()) {
            $curMonth = date('F', strtotime($attend['date_clocked']));
            if($month == $curMonth){
                ++$no;
            }
        }
        return $no;
    }
    
    function taken($empid, $conn){
        $taken = false;
        $today = date('d-m-Y');
        $getAttendance = $conn->query("SELECT * FROM attendance WHERE employee_id='$empid'");
        if($getAttendance->num_rows > 0){
            while ($attend = $getAttendance->fetch_array()) {
                $date = date('d-m-Y', strtotime($attend['date_clocked']));
                if ($date == $today) {
                    $taken = true;
                }
            }
        }

        return $taken;
    }
?>