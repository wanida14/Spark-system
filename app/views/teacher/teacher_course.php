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
    $sql = "SELECT * FROM teachers
            WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $teacher = mysqli_fetch_array($result);

    // $id = $_GET['id'];
    $sql = "SELECT  teacher_subject.time AS time, 
                    teacher_subject.teacher_id AS teacher_id, 
                    subjects.name AS course,
                    subjects.id AS course_id,
                    students.picture AS picture_student, 
                    students.nickname AS name_student,
                    students.id AS student_id,
                    teacher_subject.id AS id 
            FROM teacher_subject
            INNER JOIN subjects ON teacher_subject.subject_id = subjects.id
            INNER JOIN students ON teacher_subject.student_id = students.id
            INNER JOIN places ON teacher_subject.place_id = places.id
            WHERE teacher_subject.teacher_id = $id";

    $result2 = mysqli_query($conn, $sql);
  ?>
  <!-- menu bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="teacher.php">
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
                echo $teacher["username"];
                ?>
              <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="datas_teacher.php">My Profile</a>
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
              echo '<img src ="../../src/Admin/Teacher/images/' . $teacher["picture"] . '" width="100" height="100" style="border-radius: 50%;">';
              ?>
            <p style="margin-top: 10px;">
              <?php
                echo $teacher["username"];
                ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 nav-left">
            <div class="list-group list-group-borderless">
              <a href="teacher_course.php" class="list-group-item list-group-item-action active">
                <i class="fas fa-address-card fa-lg icon"></i>คอร์สที่สอน</a>
              <a href="subject_timetable.php" class="list-group-item list-group-item-action">
                <i class="fas fa-calendar-alt fa-lg icon"></i>ตารางสอน</a>
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
      <h1 class="text-center">คอร์สที่สอน</h1>
        <div class="row">
          <div class="col-sm-12 table-style">
            <table class="table text-center">
              <thead>
                <tr style="background-color:#a29bfe">
                  <th>ลำดับที่</th>
                  <th>ภาพ</th>
                  <th>นักเรียน</th>
                  <th>คอร์ส</th>                  
                  <th>เวลาเรียน</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result2)) {
                  echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo '<td><img src ="../../src/Admin/Student/images/' . $row["picture_student"] . '" height="50" width="50"></td>';
                    echo "<td>" . $row["name_student"] . "</td>";
                    echo "<td>" . $row["course"] . "</td>";
                    echo "<td>" . $row["time"] . "</td>";
                    echo "<td class=\"button-style\" style=\"width: 254px;\">
                              <a href=\"datas_course_teacher.php?id={$row["id"]}\" class='btn btn-outline-info'>
                              <i class='fas fa-address-book fa-lg icon'></i>ดูข้อมูล</a>
                              <a href=\"report_teacher.php?id={$row["id"]}&teacher_id=$id&subject_id={$row["course_id"]}\" class='btn btn-outline-success'>
                              <i class='far fa-file-alt fa-lg icon'></i>Report</a>  
                          </td>";
                  echo "</tr>";
                  $i++;
                }
                echo "</tbody>";
                echo "</table>";
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>