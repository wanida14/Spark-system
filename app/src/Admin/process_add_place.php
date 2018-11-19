<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        
        $insert_place = "INSERT INTO places (name)
                    VALUES ('$name')";
        
        $result = mysqli_query($conn, $insert_place);
        
        if ($result) {
            header('Location: ../../views/admin/add_place.php');
        } 
    }
?>