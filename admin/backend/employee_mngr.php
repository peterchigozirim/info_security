<?php 
    include_once 'config.php';

    $action = $_POST['action'];

    if ($action == 'search') {
        $criteria = $_POST['criteria'];
        $emptype = $_POST['emptype'];
        $employees = [];

        // Build Sql Statement
        if ($criteria == '') {
            $sql_stmt = "SELECT * FROM employees";
        } else {
            if(hasSpace($criteria) == true){
                $crits = explode(' ', $criteria);
                $sql_stmt = "SELECT * FROM employees 
                    WHERE ((firstname LIKE '%" . $crits[0] . "%' AND lastname LIKE '%" . $crits[1] . "%')
                    OR (lastname LIKE '%" . $crits[0] . "%' AND firstname LIKE '%" . $crits[1] . "%'))";
            }else{
                $sql_stmt = "SELECT * FROM employees 
                    WHERE (firstname LIKE '%" . $criteria . "%'
                    OR lastname LIKE '%" . $criteria . "%')";
            }
        }

        if($emptype != 'all'){
            if ($criteria == '') {
                $sql_stmt .= " WHERE emp_type='$emptype'";
            }else{
                $sql_stmt .= " AND emp_type='$emptype'";
            }
        }

        $query = $conn->query($sql_stmt);
        if($query->num_rows > 0){
            while ($data = $query->fetch_array()) {
                array_push($employees, $data);
            }
        }

        echo json_encode([
            'no_emp' => $query->num_rows,
            'employees' => $employees
        ]);
    }


    function hasSpace($criteria){
        $has = false;
        $criteria = trim($criteria);
        $array = explode(' ', $criteria);
        if(strpos($criteria, ' ') !== false){
            $has = true;
        }
        return $has;
    }

?>