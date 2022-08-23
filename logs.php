<?php
session_start();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
        include_once "config.php";
        $sql = $conn->query("SELECT * FROM employees WHERE username='$username' AND password='$password'");
		if($sql->num_rows > 0)
		{   
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = $_POST['role'];
            header('location: admin/admin.php');
        }else{
            header('location: index.php?error=Invalid Login Credentials');
        }
                    
}

?>