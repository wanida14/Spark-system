<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $id = $_POST['id'];
        $teacher_id = $_POST['teacher_id'];
        $subject_id = $_POST['subject_id'];
        $student_id = $_POST['student_id'];
        $date_start = $_POST['date_start'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $room_id = $_POST['room_id'];
        $color = $_POST['color'];

        $sql = "UPDATE subject_timetable 
                    SET teacher_id  = '$teacher_id', 
                        subject_id  = '$subject_id', 
                        student_id  = '$student_id', 
                        date_start  = '$date_start',
                        time_start  = '$time_start',
                        time_end    = '$time_end',
                        room_id     = '$room_id',
                        color       = '$color'
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../../../views/admin/manage_timetable.php?teacher_id=$teacher_id");
        } 
    }
?>