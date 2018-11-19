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
        background-color: #9b59b6;
        color:#ffff;
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
            <a class="btn btn-outline-warning" href="manage_timetable.php?teacher_id=<?php echo $teacher_id; ?>" role="button"><i class="fas fa-edit fa-lg icon"></i>จัดการข้อมูลตางสอน</a>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 table-style">
            <?php
                $thai_day_arr = ["จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์", "อาทิตย์"];
                $thai_day_color = ['#fdcb6e', '#fd79a8', '#00cec9', '#fab1a0', '#74b9ff', '#a29bfe', '#ff7675'];

                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                $sc_startTime = date("Y-m-d 08:00:00");  // กำหนดเวลาเริ่มต้ม เปลี่ยนเฉพาะเลขเวลา
                $sc_endtTime = date("Y-m-d 18:00:00");  // กำหนดเวลาสื้นสุด เปลี่ยนเฉพาะเลขเวลา
                $sc_t_startTime = strtotime($sc_startTime);
                $sc_t_endTime = strtotime($sc_endtTime);
                $sc_numStep = "30"; // ช่วงช่องว่างเวลา หน่ายนาที 60 นาที = 1 ชั่วโมง
                $num_dayShow = 7;  // จำนวนวันที่โชว์ 1 - 7
                $sc_timeStep = [];
                $sc_numCol = 0;

                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                // ส่วนของการกำหนดวัน สามารถนำไปประยุกต์กรณีทำตารางเวลาแบบ เลื่อนดูแต่ละสัปดาห์ได้
                $now_day = date("Y-m-d"); // วันปัจจุบัน ให้แสดงตารางที่มีวันปัจจุบัน เมื่อแสดงครั้งแรก

                // หาตัวบวก หรือลบ เพื่อหาวันที่ของวันจันทร์ในสัปดาห์
                $startWeekDay_back = (date("w", strtotime($now_day)) != 0) ? -(date("w", strtotime($now_day))) : -6; // -4
                $startWeekDay_back = $startWeekDay_back + 1;
                $start_weekDay = date("Y-m-d", strtotime("+$startWeekDay_back day")); // หาวันที่ของวันจันทร์ของสัปดาห์


                // หววันที่วันอาทิตย์ของสัปดาห์นั้นๆ
                $end_weekDay = date("Y-m-d", strtotime($start_weekDay . " +7 day"));

                while ($sc_t_startTime <= $sc_t_endTime) {
                    $sc_timeStep[$sc_numCol] = date("H:i", $sc_t_startTime);
                    $sc_t_startTime = $sc_t_startTime + ($sc_numStep * 60);
                    $sc_numCol++;    // ได้จำนวนคอลัมน์ที่จะแสดง   
                }


                ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูบ ////////////////////////
                $data_schedule = [];
                $sql = "SELECT  subjects.name AS subject_name,
                                students.nickname AS student_nickname,
                                subject_timetable.date_start AS date_start,
                                subject_timetable.time_start AS time_start,
                                subject_timetable.time_end AS time_end,
                                subject_timetable.color AS color,
                                rooms.name AS room_name
                        FROM subject_timetable
                        INNER JOIN subjects ON subject_timetable.subject_id = subjects.id
                        INNER JOIN students ON subject_timetable.student_id = students.id
                        INNER JOIN teachers ON subject_timetable.teacher_id = teachers.id
                        INNER JOIN rooms ON subject_timetable.room_id = rooms.id
                        WHERE subject_timetable.teacher_id = $teacher_id 
                        AND date_start BETWEEN '$start_weekDay' 
                        AND '$end_weekDay'";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    $data_schedule[$row['date_start']][] = [
                        "start_time" => $row['time_start'],
                        "end_time" => $row['time_end'],
                        "student_name" => $row['student_nickname'],
                        "room_name" => $row['room_name'],
                        "color" => $row['color'],
                        "detail" => $row['subject_name']
                    ];
                }


            ?>

            <div style = "overflow-y:hidden">
              <div class="wrap_schedule" style = "margin-left:0px;">
                  <table align="center" border="1" cellspacing="2" cellpadding="2" style="border-collapse:collapse;">
                      <tr class="time_schedule">
                          <td align="center" valign="middle" height="50">
                              &nbsp;
                          </td>
                          <?php
                          for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
                              ?>
                              <td align="center" valign="middle" height="50">
                                  <div class="time_schedule_text">
                                      <?= $sc_timeStep[$i_time] ?> - <?= $sc_timeStep[$i_time + 1] ?>
                                  </div>
                              </td>
                          <?php } ?>
                      </tr>
                      <?php
                      // วนลูปแสดงจำนวนวันตามที่กำหนด
                      for ($i_day = 0; $i_day < $num_dayShow; $i_day++) {
                          $dayInSchedule_chk = date("Y-m-d", strtotime($start_weekDay . " +" . $i_day . " day"));
                          $dayInSchedule_show = date("d-m-Y", strtotime($start_weekDay . " +" . $i_day . " day"));
                          ?>
                          <tr>
                              <td align="center" valign="middle" height="50" class="day_schedule" style="background-color:<?= $thai_day_color[$i_day] ?>">
                                  <div class="day_schedule_text">
                                      <?= $thai_day_arr[$i_day] ?>
                                      <br>
                                      <?= $dayInSchedule_show ?>
                                  </div>
                              </td>
                              <?php
                              // ตรวจสอบและกำหนดช่วงเวลาให้สอดคล้องกับช้อมูล
                              if (isset($data_schedule[$dayInSchedule_chk])) {
                                  $num_data = count($data_schedule[$dayInSchedule_chk]);
                              } else {
                                  $num_data = 0;
                              }
                              $arr_checkSpan = array();
                              $arr_detailShow = array();
                              $real_sc_numCol = $sc_numCol;
                              for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
                                  if ($num_data > 0) {
                                      $haveIN = 0;
                                      $dataShow = "";
                                      $dataColor= '';
                                      foreach ($data_schedule[$dayInSchedule_chk] as $k => $v) {
                                          if (strtotime($dayInSchedule_chk . " " . $sc_timeStep[$i_time] . ":00") == strtotime($dayInSchedule_chk . " " . $v['start_time'])) {
                                              $haveIN++;
                                              $dataShow = "{$v['detail']} <br> {$v['student_name']} <br> {$v['room_name']}";
                                              $dataColor = $v['color'];
                                              $add = 1;
                                              while (strtotime($dayInSchedule_chk . " " . $sc_timeStep[$i_time + $add] . ":00") < strtotime($dayInSchedule_chk . " " . $v['end_time'])) {
                                                  $haveIN++;
                                                  $dataShow = "{$v['detail']} <br> {$v['student_name']} <br> {$v['room_name']}";
                                                  $dataColor = $v['color'];
                                                  $add++;
                                              }
                                          }
                                      }
                                      $arr_checkSpan[$i_time] = $haveIN;
                                      $arr_detailShow[$i_time] = $dataShow;
                                      $arr_color[$i_time] = $dataColor;
                                  }
                              }

                              for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
                                  $colspan = "";
                                  $css_use = "";
                                  $dataShowIN = "";
                                  $dataColor = '';
                                  if (isset($arr_checkSpan[$i_time])) {
                                      if ($arr_checkSpan[$i_time] > 0) {
                                          $dataShowIN = $arr_detailShow[$i_time];
                                          $dataColor = $arr_color[$i_time];
                                          $css_use = "class=\"activity\"";
                                      }
                                      if ($arr_checkSpan[$i_time] > 1) {
                                          $colspan = "colspan=\"" . $arr_checkSpan[$i_time] . "\"";
                                          $step_add = $arr_checkSpan[$i_time] - 1;
                                          $i_time += $step_add;
                                      }
                                  }
                                  ?>
                                  <td <?= $css_use ?> <?= $colspan ?> style="background-color:<?= $dataColor ?>" align="center" valign="middle" height="50">
                                      <?php
                                      echo $dataShowIN;
                                      ?>
                                  </td>
                              <?php } ?>
                          </tr>
                      <?php } ?>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <br>
        <a class="btn btn-outline-success" href="subject_timetable.php" role="button" style="margin-bottom:30px;"><i class="fas fa-arrow-alt-circle-left fa-lg icon"></i>ย้อนกลับ</a>
      </div>
    </div>
  </div>

</body>

</html>