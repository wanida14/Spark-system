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

    $teacher_id = $_GET['teacher_id'];

    $sql_subject = "SELECT * FROM subjects";
    $subject = mysqli_query($conn, $sql_subject);

    $sql_student = "SELECT * FROM students";
    $student = mysqli_query($conn, $sql_student);

    $sql_room = "SELECT * FROM rooms";
    $room = mysqli_query($conn, $sql_room);

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
      <div class="col-sm-10">
        <h1 class="text-center">เพิ่มคอร์ส</h1>
        <form method="post" action="../../src/Admin/Timetable/process_add_timetable.php" enctype="multipart/form-data" style="margin:40px 20px;">
          <div class="form-row">
            <div class="col form-group col-md-6">
              <label for="inputEmail4">ชื่อคอร์ส</label>
              <input type="hidden" name="teacher_id" value="<?php echo $teacher_id ?>">
              <select id="subject" class="form-control" name="subject_id">
                <option value="" >-- เลือกคอร์ส --</option>
                <?php
                while ($row = mysqli_fetch_array($subject)) {
                        echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    }
                ?>
              </select>
            </div>
            <div class="col form-group col-md-6">
              <label for="inputEmail4">นักเรียน</label>
              <select id="student" class="form-control" name="student_id">
                <option value="" >-- เลือกชื่อนักเรียน --</option>
                <?php
                while ($row = mysqli_fetch_array($student)) {
                        echo "<option value=\"{$row['id']}\">{$row['nickname']}</option>";
                    }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">วันเรียน</label>
              <input id="date_start" type="date" name="date_start" class="form-control">
              
            </div>
            <div class="form-group col-md-6">
              <div class="form-group">
              <label for="inputEmail4">ห้องเรียน</label>
              <select id="room" class="form-control" name="room_id">
                <option value="" >-- เลือกห้องเรียน --</option>
                <?php
                while ($row = mysqli_fetch_array($room)) {
                        echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    }
                ?>
              </select>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">เวลาเริ่มเรียน</label>
              <input id="time_start" type="time" name="time_start" class="form-control"> 
            </div>
            <div class="form-group col-md-6">
              <div class="form-group">
              <label for="inputEmail4">เวลาสิ้นสุด</label>
              <input id="time_end" type="time" name="time_end" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label for="inputEmail4">เลือกสีตาราง</label>
              <input type="color" name="color" value="#e66465" class="form-control"> 
            </div>
          </div>
            <button id="save" type="submit" class="btn btn-outline-info"><i class="fas fa-save fa-lg icon"></i>บันทึก</button>
            <a class="btn btn-outline-danger" href="manage_timetable.php?teacher_id=<?php echo $teacher_id ?>" role="button"><i class="fas fa-ban fa-lg icon"></i>ยกเลิก</a>
        </form>
      </div>
      </div>
    </div>
  </div>
</body>
<script> 
  $(document).ready(function(){
    $('#save').click(function(e){
      var subject    = $('#subject').val();
      var student    = $('#student').val();
      var date_start = $('#date_start').val();
      var room       = $('#room').val();
      var time_start = $('#time_start').val();
      var time_end   = $('#time_end').val();

      if (subject == '' || student == '' || date_start == '' || room == '' || time_start == '' || time_end == '') {
          alert("กรุณาป้อนข้อมูลให้ครบ");
          e.preventDefault();
      }        
    })
  });
</script>
</html>