<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $id = $_POST['id'];

        $sql = "UPDATE places 
                    SET name = '$name' 
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: ../../views/admin/add_place.php');        
        }
    }
?>