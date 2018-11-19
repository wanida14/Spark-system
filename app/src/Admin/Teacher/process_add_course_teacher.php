<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $subject_id = $_POST['subject_id'];
        $student_id = $_POST['student_id'];
        $date_detail = $_POST['date_detail'];
        $time = $_POST['time'];
        $place_id = $_POST['place_id'];
        $id = $_POST['id'];

        $sql = "INSERT INTO teacher_subject (teacher_id, subject_id, student_id, date_detail, time, place_id)
                    VALUES ('$id', '$subject_id', '$student_id', '$date_detail', '$time', '$place_id')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../../views/admin/teacher_course.php?id=$id");
            } 
    }
?>