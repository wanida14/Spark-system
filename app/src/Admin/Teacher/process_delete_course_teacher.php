<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $teacher_id = $_GET['teacher_id'];
    $id = $_GET['id'];
    $sql = "DELETE FROM teacher_subject WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../../views/admin/teacher_course.php?id=$teacher_id");        
    }

?>