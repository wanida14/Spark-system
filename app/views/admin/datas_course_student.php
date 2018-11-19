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
    
    if ($_GET) {
        $id = $_GET['id'];
        $sql = "SELECT  student_subject.date_detail AS date_detail, 
                        student_subject.time AS time,
                        student_subject.date AS date,
                        student_subject.id AS st_sub_id, 
                        student_subject.payment_status AS payment_status,
                        student_subject.student_id AS student_id, 
                        subjects.name AS course, 
                        subjects.price AS price, 
                        teachers.nickname AS name_teacher, 
                        places.name AS place
                FROM student_subject
                INNER JOIN subjects ON student_subject.subject_id = subjects.id
                INNER JOIN teachers ON student_subject.teacher_id = teachers.id
                INNER JOIN places ON student_subject.place_id = places.id
                WHERE student_subject.id = $id";
      $result = mysqli_query($conn, $sql);
      $student_sub = mysqli_fetch_array($result);
    }

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
        <div class="card">
          <h5 class="card-header">ข้อมูลคอร์ส</h5>
          <div class="card-body">
          <div class="row">
        </div>
        <form style="margin-left:40px; font-size:25px;">
          <div class="form-group text-right">
            <label>วันที่ : </label>
            <?php echo $student_sub["date"]; ?>
          </div>
          <div class="form-group">
            <label>ชื่อคอร์ส : </label>
            <?php echo $student_sub["course"]; ?>
          </div>
          <div class="form-group">
            <label>ครูผู้สอน : </label>
            <?php echo $student_sub["name_teacher"]; ?>
          </div>

          <div class="form-group">
            <label>เวลาเรียน : </label>
            <?php echo $student_sub["time"]; ?>
          </div>
          <div class="form-group">
            <label>สถานที่เรียน : </label>
            <?php echo $student_sub["place"]; ?>
          </div>

          <div class="form-group">
            <label>รายละเอียดวันเรียน : </label>
            <?php echo $student_sub["date_detail"]; ?>
          </div>
          <div class="form-group">
            <label>ราคาคอร์ส : </label>
            <?php echo $student_sub["price"]; ?>
          </div>
          <div class="form-group">
            <label>สถานะการจ่ายเงิน : </label>
            <?php echo $student_sub["payment_status"]; ?>
          </div>
          <div class="form-group" style="margin:40px 0px;">
            <a class="btn btn-outline-warning" href="edit_course_student.php?id=<?php echo $student_sub["st_sub_id"]; ?>" role="button"><i class="fas fa-edit fa-lg icon"></i>แก้ไขข้อมูล</a>
            <a class="btn btn-outline-success" href="student_course.php?id=<?php echo $student_sub["student_id"]; ?>" role="button"><i class="fas fa-arrow-alt-circle-left fa-lg icon"></i>ย้อนกลับ</a>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
        