<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $sql = "DELETE FROM teachers WHERE id = $id";
    $sql_sub = "DELETE FROM teacher_subject WHERE teacher_id = $id";
    $result = mysqli_query($conn, $sql);
    $result_sub = mysqli_query($conn, $sql_sub);
    if ($result && $result_sub) {
        header('Location: ../../../views/admin/teacher.php');        
    }

?>