<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $detail = $_POST['detail'];

        $sql = "INSERT INTO subjects (name, price, detail)
                    VALUES ('$name', '$price', '$detail')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../views/admin/course.php");
            } 
    }
?>