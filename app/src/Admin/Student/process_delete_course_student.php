<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $student_id = $_GET['student_id'];
    $id = $_GET['id'];
    $sql = "DELETE FROM student_subject WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../../views/admin/student_course.php?id=$student_id");        
    }

?>