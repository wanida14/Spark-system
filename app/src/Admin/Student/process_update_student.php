<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session
    
    if ($_POST) {
        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $school = $_POST['school'];
        $date = $_POST['date'];
        $id = $_POST['id'];

        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
            //upload image file
            $ext = pathinfo(basename($_FILES['myfile']['name']), PATHINFO_EXTENSION); //นามสกุลไฟล์
            $new_image_name = 'img-' .uniqid().".".$ext; //สุ่มชื่อไฟล์ใหม่
            $image_path = "images/"; //เส้นทางที่จะเก็บไฟล์ภาพไว้
            move_uploaded_file($_FILES['myfile']['tmp_name'],$image_path.$new_image_name); //ฟังค์ชั่นการอัพโหลดไฟล์

            $picture = $new_image_name;//เก็บชื่อไฟล์ภาพใหม่ไว้ในตัวแปลเพื่อลงฐานข้อมุล
            $sql = "UPDATE students 
                        SET name     = '$name', 
                            nickname = '$nickname', 
                            tel      = '$tel', 
                            address  = '$address',
                            age      = '$age',
                            tel      = '$tel',
                            school   = '$school',
                            date     = '$date',
                            picture  = '$picture'
                    WHERE id = $id";
        } else {
            $sql = "UPDATE students 
                        SET name     = '$name', 
                            nickname = '$nickname', 
                            tel      = '$tel', 
                            address  = '$address',
                            age      = '$age',
                            tel      = '$tel',
                            date     = '$date',
                            school   = '$school'
                    WHERE id = $id";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: ../../../views/admin/student.php');        
        }
    }

?>

