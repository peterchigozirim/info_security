<?php 
    include_once 'config.php';

    $action = $_POST['action'];
    
    if ($action == 'general') {
        $pie_data = [
            [
                'value' => getEmployeeType('Full Time', $conn),
                'color' => '#46BFBD',
                'highlight' => '#5AD3D1',
                'label' => 'Full Time'
            ],
            [
                'value' => getEmployeeType('Part Time', $conn),
                'color' => '#F7464A',
                'highlight' => '#FF5A5E',
                'label' => 'Part Time'
            ],
            [
                'value' => getEmployeeType('Casual', $conn),
                'color' => '#44C688',
                'highlight' => '#009688',
                'label' => 'Casual'
            ],
            [
                'value' => getEmployeeType('Temporary', $conn),
                'color' => '#222d32',
                'highlight' => '#444d32',
                'label' => 'Temporary'
            ]
        ];
        echo json_encode([
            'piedata' => $pie_data
        ]);
    }elseif ($action == 'fetch_employees_stats') {
        $sql_stmt = "SELECT * FROM organzation ORDER BY client_firstname";
        $sql_query = $conn->query($sql_stmt);
        $employees = [];
        while ($employee = $sql_query->fetch_array()) {
            array_push($employees, $employee);
        }
        echo json_encode([
            'employees' => $employees
        ]);
    }



    function getEmployeeType($type, $conn)
    {
        $sql_stmt = $conn->query("SELECT * FROM employees WHERE emp_type='$type'");
        return $sql_stmt->num_rows;
        if ($type == 'Full Time') {
            
        } elseif ($type == 'Part Time') {
            
        } elseif ($type == 'Casual') {
            
        } elseif ($type == 'Temporary') {
            
        }
    }

    function fetchStats($employee_id, $conn){
        $sql_stmt = $conn->query("SELECT * FROM attendance WHERE employee_id='$employee_id'");
        return $sql_stmt->num_rows;
    }
    ?>