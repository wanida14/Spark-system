<?php
  session_start(); // เรียกใช้ฟังก์ชั่น session
  if (!isset($_SESSION['id'])) {
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
    require '../../src/connect.php'; // เรียกใช้ไฟล์...

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM admins
        WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_array($result);

    $sql_subject = "SELECT * FROM subjects";
    $subject = mysqli_query($conn, $sql_subject);

    $sql_teacher = "SELECT * FROM teachers";
    $teacher = mysqli_query($conn, $sql_teacher);

    $sql_place = "SELECT * FROM places";
    $place = mysqli_query($conn, $sql_place);

    $id = $_GET['id'];
  ?>
  <!-- menu bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
      <a class="navbar-brand" href="admin.php">
        <img src="images/spark-image-logo.png" width="40" height="43" class="d-inline-block align-center" alt=""> Spark
        System
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <?php echo $admin["username"]; ?>
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
            <?php echo '<img src ="images/' . $admin["image"] . '" width="100" height="100" style="border-radius: 50%;">'; ?>
            <p style="margin-top: 10px;">
              <?php echo $admin["username"];?>
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
        <h1 class="text-center">เพิ่มคอร์ส</h1>
        <form method="post" action="../../src/Admin/Student/process_add_course.php" enctype="multipart/form-data" style="margin:40px 20px;">
          <div class="form-group col-md-4" style="padding-left: 0px;">
            <label for="inputAddress">วันที่</label>
            <input id="date" type="date" name="date" class="form-control">
          </div>

          <div class="form-row">
            <div class="col form-group col-md-6">
              <label for="inputEmail4">ชื่อคอร์ส</label>
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <select id="subject" class="form-control" name="subject_id">
                <option value="">-- เลือกคอร์ส --</option>
                <?php
                while ($row = mysqli_fetch_array($subject)) {
                        echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    }
                ?>
              </select>
            </div>
            <div class="col form-group col-md-6">
              <label for="inputEmail4">ครูผู้สอน</label>
              <select id="teacher" class="form-control" name="teacher_id">
                <option value="">-- เลือกครูผู้สอน --</option>
                <?php
                while ($row = mysqli_fetch_array($teacher)) {
                        echo "<option value=\"{$row['id']}\">{$row['nickname']}</option>";
                    }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress">รายละเอียดวันเรียน</label>
            <input id="date_detail" type="text" name="date_detail" class="form-control" placeholder="1 june, 8 june">
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">เวลาเรียน</label>
              <input id="time" type="text" name="time" class="form-control" placeholder="09.00 - 11.00 น.">
              
            </div>
            <div class="form-group col-md-6">
              <div class="form-group">
              <label for="inputEmail4">สถานที่เรียน</label>
              <select id="place" class="form-control" name="place_id">
                <option value="">-- เลือกสถานที่เรียน --</option>
                <?php
                while ($row = mysqli_fetch_array($place)) {
                        echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    }
                ?>
              </select>
              </div>
            </div>
          </div>
          <div class="form-group">
          <label for="inputEmail4">การจ่ายเงิน</label><br>
            <input type="radio" name="payment_status" value="ยังไม่จ่าย" checked> ยังไม่จ่าย
            <input type="radio" name="payment_status" value="จ่ายแล้ว"> จ่ายแล้ว
          </div>
            <button id="save" type="submit" class="btn btn-outline-info"><i class="fas fa-save fa-lg icon"></i>บันทึก</button>
            <a class="btn btn-outline-danger" href="student_course.php?id=<?php echo $id ?>" role="button"><i class="fas fa-ban fa-lg icon"></i>ยกเลิก</a>
        </form>
      </div>
    </div>
  </div>
</body>
<script> 
  $(document).ready(function(){
    $('#save').click(function(e){
      var date    = $('#date').val();
      var subject = $('#subject').val();
      var teacher = $('#teacher').val();
      var date_detail = $('#date_detail').val();
      var time = $('#time').val();
      var place    = $('#place').val();

      if (date == '' || subject == '' || teacher == '' || date_detail == '' || time == '' || place == '') {
          alert("กรุณาป้อนข้อมูลให้ครบ");
          e.preventDefault();
      }        
    })
  });
</script>
</html>