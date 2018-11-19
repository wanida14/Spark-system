<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $place_id = $_POST['place_id'];
        $id = $_POST['id'];

        $sql = "UPDATE rooms 
                    SET name = '$name',
                        place_id = '$place_id' 
                WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: ../../views/admin/room.php');        
        }
    }
?>