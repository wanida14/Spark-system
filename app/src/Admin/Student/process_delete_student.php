<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $sql_st = "DELETE FROM students WHERE id = $id";
    $result_st = mysqli_query($conn, $sql_st);

    $sql_st_sub = "DELETE FROM student_subject WHERE student_id = $id";
    $result_st_sub = mysqli_query($conn, $sql_st_sub);

    $sql_tc_sub = "DELETE FROM teacher_subject WHERE student_id = $id";
    $result_tc_sub = mysqli_query($conn, $sql_tc_sub);

    if ($result_st && $result_st_sub && $result_tc_sub) {
        header('Location: ../../../views/admin/student.php');        
    }

?>