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

<style type="text/css">
    .wrap_schedule {
        margin: auto;
        width: 800px;
    }

    .activity {
        background-color: #C6EEC3;
        font-size: 12px;
    }

    .time_schedule {
        font-size: 12px;
    }

    .day_schedule {
        font-size: 12px;
    }

    .time_schedule_text {
        width: 60px;
    }

    .day_schedule_text {
        width: 80px;
    }
</style>

<body>
  <?php
    require('../../src/connect.php'); // เรียกใช้ไฟล์...

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM admins
            WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_array($result);

    $teacher_id = $_GET['teacher_id'];
    $sql = "SELECT  subjects.name AS subject_name,
                    students.nickname AS student_nickname,
                    subject_timetable.date_start AS date_start,
                    subject_timetable.time_start AS time_start,
                    subject_timetable.time_end AS time_end,
                    subject_timetable.id AS id,
                    teachers.id AS teacher_id,
                    rooms.name AS room_name
            FROM subject_timetable
            INNER JOIN subjects ON subject_timetable.subject_id = subjects.id
            INNER JOIN students ON subject_timetable.student_id = students.id
            INNER JOIN teachers ON subject_timetable.teacher_id = teachers.id
            INNER JOIN rooms ON subject_timetable.room_id = rooms.id
            WHERE subject_timetable.teacher_id = $teacher_id";

    $result2 = mysqli_query($conn, $sql);

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
              <a href="student.php" class="list-group-item list-group-item-action">
                <i class="fas fa-child fa-lg icon"></i>นักเรียน</a>
              <a href="subject_timetable.php" class="list-group-item list-group-item-action active">
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
        <div class="row" style="margin-top:30px;">
          <div class="col-sm-12 text-right">
            <a class="btn btn-outline-success" href="add_course_timetable.php?teacher_id=<?php echo $teacher_id ?>" role="button"><i class="fas fa-plus-circle fa-lg icon"></i>เพิ่มคอร์ส</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 table-style">
            <table class="table text-center">
              <thead>
                <tr style="background-color:#a29bfe">
                  <th>ลำดับที่</th>
                  <th>วันที่</th>
                  <th>คอร์ส</th>
                  <th>นักเรียน</th>
                  <th>เวลาเริ่ม</th>
                  <th>เวลาสิ้นสุด</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result2)) {
                  echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["date_start"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>";
                    echo "<td>" . $row["student_nickname"] . "</td>";
                    echo "<td>" . $row["time_start"] . "</td>";
                    echo "<td>" . $row["time_end"] . "</td>";
                    echo "<td class=\"button-style\" style=\"width: 274px;\">
                            <a href=\"edit_timetable.php?id={$row["id"]}&teacher_id={$row["teacher_id"]}\" class='btn btn-outline-warning'>
                            <i class='fas fa-edit fa-lg icon'></i>แก้ไข</a>  
                            <a href=\"../../src/Admin/Timetable/process_delete_timetable.php?id={$row["id"]}&teacher_id={$row["teacher_id"]}\" class='btn btn-outline-danger'>
                            <i class='fas fa-trash-alt fa-lg icon'></i> ลบ</a>
                          </td>";
                  echo "</tr>";
                $i++;
                }
                echo "</tbody>";
                echo "</table>";
            ?>
          </div>
        </div>
        <a class="btn btn-outline-success" href="timetable_teacher.php?teacher_id=<?php echo $teacher_id; ?>" role="button"><i class="fas fa-arrow-alt-circle-left fa-lg icon"></i>ย้อนกลับ</a>
      </div>
    </div>
  </div>

</body>

</html>