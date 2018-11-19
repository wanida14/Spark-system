<?php  
  session_start(); // เรียกใช้ฟังก์ชั่น session
  if (! isset($_SESSION['id'])) {
    header('Location: ../../../public/index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../public/css_style/style.css">
  <script src="../../../public/js/jquery-3.3.1.min.js"></script>
  <script src="../../../public/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
</head>

<body>
  <?php
    require('../../src/connect.php'); // เรียกใช้ไฟล์...

      $id = $_SESSION['id'];
      $sql = "SELECT * FROM admins
              WHERE id = '$id'";
      $result = mysqli_query($conn, $sql);
      $admin = mysqli_fetch_array($result);
  ?>
  <!-- menu bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="admin.php">
        <img src="images/spark-image-logo.png" width="40" height="43" class="d-inline-block align-center" alt=""> Spark System
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <?php
                echo $admin["username"];
              ?>
              <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../../src/logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container pt-4">
    <div class="row">
      <!-- Nev bar left -->
      <div class="col-sm-2">
        <div class="row">
          <div class="col-sm-12 text-center">
            <?php
            echo '<img src ="images/' . $admin["image"] . '" width="100" height="100" style="border-radius: 50%;">';
            ?>
            <p style="margin-top: 10px;">
              <?php
                echo $admin["username"];
              ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 nav-left">
            <div class="list-group list-group-borderless">
              <a href="teacher.php" class="list-group-item list-group-item-action">
                <i class="fas fa-chalkboard-teacher fa-lg icon"></i>ครู</a>
              <a href="student.php" class="list-group-item list-group-item-action active">
                <i class="fas fa-child fa-lg icon"></i>นักเรียน</a>
              <a href="subject_timetable.php" class="list-group-item list-group-item-action">
                <i class="fas fa-calendar-alt fa-lg icon"></i>ตารางสอนครู</a>
              <a href="course.php" class="list-group-item list-group-item-action">
                <i class="fas fa-book fa-lg icon"></i>คอร์สเรียน</a>
              <a href="room.php" class="list-group-item list-group-item-action">
                <i class="fas fa-school fa-lg icon"></i>ห้องเรียน</a>
              <a href="chart.php" class="list-group-item list-group-item-action">
                <i class="fas fa-poll fa-lg icon"></i>สถิติ</a>
            </div>
          </div>
        </div>
      </div>
      <!-- content -->
      <div class="col-sm-10">
        <h1 class="text-center">เพิ่มข้อมูลนักเรียน</h1>
        <form method="post" action="../../src/Admin/Student/process_add_student.php" enctype="multipart/form-data" style="margin:40px 20px;">
          <div class="form-group col-md-4" style="padding-left: 0px;">
            <label for="inputAddress">วันที่</label>
            <input id="date" type="date" name="date" class="form-control">
          </div>
          <div class="form-row">
            <div class="col form-group col-md-6">
              <label for="inputEmail4">ชื่อ</label>
              <input id="name" type="text" name="name" class="form-control" placeholder="Full name">
            </div>
            <div class="col form-group col-md-6">
              <label for="inputEmail4">ชื่อเล่น</label>
              <input id="nickname" type="text" name="nickname" class="form-control" placeholder="Nickname">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">อายุ</label>
              <input id="age" type="number" name="age" class="form-control" placeholder="Age">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">เบอร์โทรศัพท์</label>
              <input id="tel" type="text" name="tel" class="form-control" placeholder="Phone">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">โรงเรียน</label>
            <input id="school" type="text" name="school" class="form-control" placeholder="school">
          </div>
          <div class="form-group">
            <label for="inputAddress">ที่อยู่</label>
            <input id="address" type="text" name="address" class="form-control" placeholder="1234 Main St">
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="form-group">
                <label for="exampleFormControlFile1">รูปภาพ</label>
                <input id="myfile" type="file" name="myfile" class="form-control-file">
              </div>
            </div>
          </div>
          <button id="save" type="submit" class="btn btn-outline-info"><i class="fas fa-save fa-lg icon"></i>บันทึก</button>
          <a class="btn btn-outline-danger" href="student.php" role="button"><i class="fas fa-ban fa-lg icon"></i>ยกเลิก</a>
        </form>
      </div>
    </div>
  </div>
</body>
<script> 
  $(document).ready(function(){
    $('#save').click(function(e){
      var date = $('#date').val();
      var name = $('#name').val();
      var nickname = $('#nickname').val();
      var age = $('#age').val();
      var tel    = $('#tel').val();
      var school = $('#school').val();
      var address = $('#address').val();
      var myfile = $('#myfile').val();

      if (date == '' || name == '' || nickname == '' || age == '' || tel == '' || school == '' || address == '' || myfile == '') {
          alert("กรุณาป้อนข้อมูลให้ครบ");
          e.preventDefault();
      }        
    })
  });
</script>
</html>