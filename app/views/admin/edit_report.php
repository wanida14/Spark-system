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
        $student_id = $_GET['student_id'];
        $teacher_id = $_GET['teacher_id'];
        $subject_id = $_GET['subject_id'];
  
        $sql = "SELECT  subjects.name AS subject, 
                        teachers.nickname AS teacher,                     
                        students.nickname AS student,
                        report.date AS date,
                        report.report AS report,
                        report.id AS report_id,
                        students.id AS student_id 
                FROM report
                INNER JOIN subjects ON report.subject_id = subjects.id
                INNER JOIN students ON report.student_id = students.id
                INNER JOIN teachers ON report.teacher_id = teachers.id
                WHERE report.id = $id";
        $result = mysqli_query($conn, $sql);
        $data_report = mysqli_fetch_array($result);
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
              <a href="teacher.php" class="list-group-item list-group-item-action active">
                <i class="fas fa-chalkboard-teacher fa-lg icon"></i>ครู</a>
              <a href="student.php" class="list-group-item list-group-item-action">
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
      <div class="col-sm-10 ">
      <h1 class="text-center">แก้ไขบันทึกหลังการสอน</h1>
          <form method="post" action="../../src/Admin/teacher/process_update_report.php" enctype="multipart/form-data" style="margin:40px 20px;">
            <div class="form-group col-sm-4">
              <label for="inputAddress">วันที่</label>
              <input type="date" name="date" class="form-control" value="<?php echo $data_report["date"]; ?>">
              <input type="hidden" name="teacher_id" value="<?php echo $teacher_id ?>">
              <input type="hidden" name="student_id" value="<?php echo $data_report["student_id"]; ?>">
              <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>">
              <input type="hidden" name="report_id" value="<?php echo $data_report["report_id"]; ?>">
            </div>
            <div class="form-group col-sm-12">
              <label for="inputAddress">บันทึก</label>
              <input type="text" name="report" class="form-control" value="<?php echo $data_report["report"]; ?>">
            </div>
            <button type="submit" class="btn btn-outline-info">
              <i class="fas fa-save fa-lg icon"></i>บันทึก</button>
            <a class="btn btn-outline-danger" href="report.php?id=<?php echo $id ?>&teacher_id=<?php echo $teacher_id ?>&subject_id=<?php echo $subject_id ?>" role="button">
              <i class="fas fa-ban fa-lg icon"></i>ยกเลิก</a>
          </form>
      </div>
    </div>
  </div>

</body>

</html>