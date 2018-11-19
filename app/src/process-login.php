<?php
session_start();

require('connect.php');

if ($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    if ($status == "admin") {
        $sql = "SELECT * FROM admins 
                WHERE username = '$username' AND password = '$password'";
        
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result);
    
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
    
        header('Location: ../views/admin/admin.php');
    
    } else {
        $sql = "SELECT * FROM teachers 
                WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result);

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];

        header('Location: ../views/teacher/teacher.php');
    }

}

?>
