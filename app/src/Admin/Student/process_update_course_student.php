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

        $sql = "UPDATE student_subject 
                    SET subject_id     = '$subject_id', 
                        teacher_id     = '$teacher_id', 
                        date_detail    = '$date_detail', 
                        time           = '$time',
                        place_id       = '$place_id',
                        date           = '$date',
                        payment_status = '$payment_status'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../../../views/admin/datas_course_student.php?id=$id");
        } 
    }
?>