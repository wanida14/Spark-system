<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $teacher_id = $_GET['teacher_id'];
    $sql = "DELETE FROM subject_timetable WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../../views/admin/manage_timetable.php?teacher_id=$teacher_id");
    }

?>