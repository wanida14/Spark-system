<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {

        $name = $_POST['name'];
        $place_id = $_POST['place_id'];
        
        $insert_room = "INSERT INTO rooms (name,place_id)
                    VALUES ('$name','$place_id')";
               
        $result = mysqli_query($conn, $insert_room);
        
        if ($result) {
            header('Location: ../../views/admin/room.php');
        } 
    }
?>