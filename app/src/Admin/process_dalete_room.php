<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: ../../views/admin/room.php');        
    }

?>