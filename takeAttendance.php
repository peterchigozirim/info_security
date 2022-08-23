<?php

    include_once 'config.php';

    $tokenArray = ['12345', 'asdf1234', 'xyz123', 'zxcvb2021'];

    $empid = $_POST['empid'];
    $token = $_POST['token'];

    if (in_array($token, $tokenArray)) {
        $query = $conn->query("SELECT * FROM employees WHERE employee_id='$empid'");
        if($query->num_rows > 0){
            // Check if he has taken attendance for today
            if(taken($empid, $conn) == false){
                $insert = $conn->query("INSERT INTO attendance(employee_id) VALUES('$empid')");
                if($insert){
                    header('location:attendance.php?taken=Employee attendance recorded successfully!');
                }else{
                    header('location:attendance.php?error=An unexpected error occurred!');
                }
            }else{
                header('location:attendance.php?taken=ALREADY RECORDED! You can not record your attendance twice for a day!');
            }
        }else{
            header('location:attendance.php?error=Employee records not found!');
        }
    }else{
        header('location:attendance.php?error=Invalid Attendance Token');
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