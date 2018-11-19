<?php
    require('../../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $facebook = $_POST['facebook'];
        $lindID = $_POST['lindID'];
        $birthday = $_POST['birthday'];
        $permission_id = 2;

        //upload image file
        $ext = pathinfo(basename($_FILES['myfile']['name']), PATHINFO_EXTENSION); //นามสกุลไฟล์
        $new_image_name = 'img-' .uniqid().".".$ext; //สุ่มชื่อไฟล์ใหม่
        $image_path = "images/"; //เส้นทางที่จะเก็บไฟล์ภาพไว้
        $upload_path = $image_path.$new_image_name;
        $success = move_uploaded_file($_FILES['myfile']['tmp_name'],$upload_path); //ฟังค์ชั่นการอัพโหลดไฟล์เก็บค่า true,fales ไว้ในตัวแปล
        if ($success == FALSE) { //เช็คการอัพโหลดไฟล์
            echo "เลือกรูปภาพใหม่";
            exit();
        }
        $picture = $new_image_name;//เก็บชื่อไฟล์ภาพใหม่ไว้ในตัวแปลเพื่อลงฐานข้อมุล

        $sql = "INSERT INTO teachers (name, nickname, username, password, email, tel, address, facebook, lindID, birthday, permission_id, picture)
                    VALUES ('$name', '$nickname', '$username', '$password', '$email', '$tel', '$address', '$facebook', '$lindID', '$birthday', '$permission_id', '$picture')";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('Location: ../../../views/admin/teacher.php');
            } 
    }
?>