<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $teacher_id = $_POST['teacher_id'];
        $subject_id = $_POST['subject_id'];
        $student_id = $_POST['student_id'];
        $date_start = $_POST['date_start'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];
        $room_id = $_POST['room_id'];
        $color = $_POST['color'];

        $sql = "INSERT INTO subject_timetable (teacher_id, subject_id, student_id, date_start, time_start, time_end, room_id, color)
                    VALUES ('$teacher_id', '$subject_id', '$student_id', '$date_start', '$time_start', '$time_end', '$room_id', '$color')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../../views/admin/manage_timetable.php?teacher_id=$teacher_id");
            } 
    }
?>