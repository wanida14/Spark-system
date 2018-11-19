<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];
        $date_detail = $_POST['date_detail'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $place_id = $_POST['place_id'];
        $payment_status = $_POST['payment_status'];
        $id = $_POST['id'];

        $sql = "INSERT INTO student_subject (student_id, subject_id, teacher_id, date_detail, time, place_id, payment_status, date)
                    VALUES ('$id', '$subject_id', '$teacher_id', '$date_detail', '$time', '$place_id', '$payment_status', '$date')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../../views/admin/student_course.php?id=$id");
            } 
    }
?>