<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $teacher_id = $_GET['teacher_id'];
    $student_id = $_GET['student_id'];
    $subject_id = $_GET['subject_id'];
    $sql = "DELETE FROM report WHERE id = $id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../views/teacher/report_teacher.php?id=$id&teacher_id=$teacher_id&subject_id=$subject_id");
    } 
?>