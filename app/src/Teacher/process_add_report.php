<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $teacher_id = $_POST['teacher_id'];
        $student_id = $_POST['student_id'];
        $subject_id = $_POST['subject_id'];
        $date = $_POST['date'];
        $report = $_POST['report'];    

        $sql = "INSERT INTO report (teacher_id, student_id, subject_id, date, report)
                    VALUES ('$teacher_id', '$student_id', '$subject_id', '$date', '$report')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../views/teacher/report_teacher.php?teacher_id=$teacher_id&id=$student_id&subject_id=$subject_id");
            } 
    }
?>