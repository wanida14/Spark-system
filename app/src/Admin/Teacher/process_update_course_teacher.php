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

        $sql = "UPDATE teacher_subject 
                    SET subject_id     = '$subject_id', 
                        student_id     = '$student_id', 
                        date_detail    = '$date_detail', 
                        time           = '$time',
                        place_id       = '$place_id'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../../../views/admin/datas_course_teacher.php?id=$id");
        } 
    }
?>