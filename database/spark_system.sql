-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 11:53 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spark_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `image` varchar(40) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `image`, `permission_id`) VALUES
(1, 'admin', '1414', 'admin.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `status`) VALUES
(1, 'admin'),
(2, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`) VALUES
(1, 'Town in Town'),
(2, 'central festival eastville'),
(5, 'The Walk'),
(6, 'CW Tower');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `report` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `teacher_id`, `student_id`, `subject_id`, `report`, `date`) VALUES
(1, 1, 1, 1, 'ตั้งใจเรียนดีมาก', '2018-10-31'),
(4, 1, 1, 1, 'ตั้งใจเรียนมากกกก', '2018-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `place_id`) VALUES
(1, 'T001', 1),
(2, 'T002', 1),
(3, 'E001', 2),
(4, 'E002', 2),
(6, 'W001', 5),
(7, 'W002', 5),
(8, 'C001', 6),
(9, 'C002', 6);

-- --------------------------------------------------------

--
-- Table structure for table `room_timetable`
--

CREATE TABLE `room_timetable` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `teachar_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `nickname` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `school` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `nickname`, `age`, `school`, `address`, `tel`, `picture`, `date`) VALUES
(4, 'วชิรวิทย์ ปกทิม', 'เอ', 8, 'SISB ', 'กรุงเทพมหานคร', '0234124100', 'img-5be18d88decd5.jpg', '2017-11-09'),
(5, 'ปิติภัทร สุธรรม', 'บอย', 8, 'SISB', 'กรุงเทพมหานคร', '0265412589', 'img-5be18dc983d38.jpg', '2017-11-09'),
(7, 'ภัทรวรรธ เสาเวียง', 'นาย', 9, 'SISB', 'กรุงเทพมหานคร', '0236257852', 'img-5be1907d22260.png', '2017-11-11'),
(8, 'ฤทธิเดช เดชเรืองศรี', 'ออกัส', 9, 'SISB', 'กรุงเทพมหานคร', '0235261245', 'img-5be190afbd461.jpg', '2017-11-20'),
(9, 'พลวัฒน์ พันซักทรัพย์', 'ออย', 9, 'SISB', 'กรุงเทพมหานคร', '0253614586', 'img-5be190e84daf9.jpg', '2017-11-23'),
(10, 'ธีรพงษ์ ชัยธงรัตน์', 'ไทก้า', 8, 'SISB', 'กรุงเทพมหานคร', '0127586952', 'img-5be19118bb7fe.jpg', '2017-11-29'),
(11, 'ดณุพันธ์ มีชัย', 'ฟาร์', 11, 'SISB', 'กรุงเทพมหานคร', '0145236985', 'img-5be19166edc4d.jpg', '2017-12-10'),
(12, 'สุระเกียรติ ทองสินธ์', 'ฟลุ๊ค', 9, 'SISB', 'กรุงเทพมหานคร', '0861452563', 'img-5be191abdde58.JPG', '2018-01-24'),
(13, 'ชุติกาญจน์ ทองสินธ์', 'พลอย', 8, 'SISB', 'กรุงเทพมหานคร', '0152395875', 'img-5be1933003b93.jpg', '2018-01-30'),
(14, 'จิณัฐตา ใจสุข', 'ปันปัน', 8, 'SISB', 'กรุงเทพมหานคร', '0789632574', 'img-5be1935ef2b6f.jpg', '2018-02-20'),
(15, 'บัณฑิตา วิจิตรจันทร์', 'เชียร์', 8, 'SISB', 'กรุงเทพมหานคร', '0456985478', 'img-5be1939ae0396.jpg', '2018-02-27'),
(16, 'ศริญญา ดาวหาง', 'เฌอปาง', 9, 'SISB ', 'กรุงเทพมหานคร', '0789654785', 'img-5be193e25fd26.png', '2018-03-14'),
(17, 'นิตยา ด่วนตะคุ', 'นิหน่า', 9, 'SISB', 'กรุงเทพมหานคร', '0789610252', 'img-5be1940de20b6.jpg', '2018-04-23'),
(18, 'ปริยากร ลาดแดง', 'แต้ว', 9, 'SISB', 'กรุงเทพมหานคร', '0125478963', 'img-5be19439d0058.jpg', '2018-05-16'),
(19, 'จิณัฐตา สายเล็ก', 'แก้ว', 9, 'SISB', 'กรุงเทพมหานคร', '0459632552', 'img-5be1947b85854.jpg', '2018-06-14'),
(20, 'กาญจนา พ่วงมา', 'พาย', 11, 'SISB', 'กรุงเทพมหานคร', '028965478', 'img-5be194a82e975.jpg', '2018-08-22'),
(21, 'ชาลิดา ส่งสมบูรณ์', 'มายด์', 10, 'SISB', 'กรุงเทพมหานคร', '0789651120', 'img-5be194d891fef.jpg', '2018-09-20'),
(22, 'กฤตติกา ล้วนศรี', 'พิ้ง', 9, 'SISB', 'กรุงเทพมหานคร', '0125963220', 'img-5be194fe15c20.jpg', '2018-10-24'),
(23, 'ชลลดา เดชสยา', 'ณดา', 10, 'SISB', 'กรุงเทพมหานคร', '0872314520', 'img-5be1954244db4.jpg', '2018-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date_detail` varchar(40) NOT NULL,
  `time` varchar(30) NOT NULL,
  `place_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`id`, `student_id`, `subject_id`, `teacher_id`, `date_detail`, `time`, `place_id`, `date`, `payment_status`) VALUES
(5, 4, 1, 1, '2 3 4 5 6', '09.00 - 10.00', 2, '2017-11-03', 'จ่ายแล้ว'),
(6, 4, 2, 1, '2 3 4 5 6', '09.00 - 10.00', 2, '2017-12-01', 'จ่ายแล้ว'),
(7, 5, 1, 1, '2 3 4 5 6', '09.00 - 10.00', 2, '2017-11-03', 'จ่ายแล้ว'),
(8, 5, 2, 1, '2 3 4 5 6', '09.00 - 10.00', 2, '2017-12-01', 'จ่ายแล้ว'),
(9, 7, 3, 5, '2 3 4 5 6', '09.00 - 10.00', 1, '2017-11-12', 'จ่ายแล้ว'),
(10, 7, 4, 5, '2 3 4 5 6', '09.00 - 10.00', 1, '2017-12-01', 'จ่ายแล้ว'),
(11, 8, 3, 6, '2 3 4 5 6', '09.00 - 10.00', 2, '2017-11-21', 'จ่ายแล้ว'),
(12, 9, 3, 7, '2 3 4 5 6', '09.00 - 10.00', 5, '2017-11-26', 'จ่ายแล้ว'),
(13, 9, 4, 7, '2 3 4 5 6', '09.00 - 10.00', 5, '2017-12-05', 'จ่ายแล้ว'),
(14, 10, 3, 8, '2 3 4 5 6', '09.00 - 10.00', 1, '2017-12-01', 'จ่ายแล้ว'),
(15, 11, 5, 9, '2 3 4 5 6', '09.00 - 10.00', 1, '2017-12-12', 'จ่ายแล้ว'),
(16, 11, 6, 9, '2 3 4 5 6', '09.00 - 10.00', 1, '2018-01-10', 'จ่ายแล้ว'),
(17, 12, 3, 6, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-01-26', 'จ่ายแล้ว'),
(18, 13, 3, 7, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-02-05', 'จ่ายแล้ว'),
(19, 14, 1, 8, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-02-22', 'จ่ายแล้ว'),
(20, 15, 3, 8, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-03-01', 'จ่ายแล้ว'),
(21, 16, 3, 5, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-03-16', 'จ่ายแล้ว'),
(22, 16, 4, 5, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-04-01', 'จ่ายแล้ว'),
(23, 17, 3, 9, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-04-25', 'จ่ายแล้ว'),
(24, 18, 3, 1, '2 3 4 5 6', '09.00 - 10.00', 1, '2018-05-18', 'จ่ายแล้ว'),
(25, 19, 1, 7, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-06-15', 'จ่ายแล้ว'),
(26, 20, 5, 9, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-08-24', 'จ่ายแล้ว'),
(27, 20, 6, 9, '2 3 4 5 6', '09.00 - 10.00', 6, '2018-09-10', 'จ่ายแล้ว'),
(28, 21, 5, 8, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-09-27', 'จ่ายแล้ว'),
(29, 22, 3, 6, '2 3 4 5 6', '09.00 - 10.00', 5, '2018-10-26', 'จ่ายแล้ว'),
(30, 23, 3, 1, '2 3 4 5 6', '09.00 - 10.00', 2, '2018-11-01', 'จ่ายแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `price`, `detail`) VALUES
(1, 'animation and basic coding', 6500, 'สอนเขียน coding ผ่านการสร้างชิ้นงาน animation เบื้องต้น'),
(2, 'animation and coding', 7500, 'สอนเขียน coding ผ่านการสร้างชิ้นงาน animation ที่ซับซ้อนขึ้นกว่าเดิม'),
(3, 'Game Creator 1', 8300, 'เรียนเขียน coding โดยการสร้างชิ้นงานออกมาเป็น Game อย่างง่าย'),
(4, 'Game Creator 2', 8300, 'เรียนเขียน coding โดยการสร้างชิ้นงานออกมาเป็น Game ที่ซับซ้อนกว่าเดิม'),
(5, 'Web delverlopment 1', 12000, 'เรียนเขียนเว็บไซต์ด้วยภาษา HTML5 และ CSS เพื่อสร้างเว็บไซต์อย่างง่าย'),
(6, 'Web delverlopment 2', 12000, 'เรียนเขียนเว็บไซต์ด้วยภาษา HTML5 และ CSS เพื่อสร้างเว็บไซต์อย่างง่าย และมีคำสั่งหรือโครงสร้างภาษาที่ซับซ้อนมากขึ้น');

-- --------------------------------------------------------

--
-- Table structure for table `subject_timetable`
--

CREATE TABLE `subject_timetable` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `color` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_timetable`
--

INSERT INTO `subject_timetable` (`id`, `subject_id`, `teacher_id`, `student_id`, `room_id`, `date_start`, `time_start`, `time_end`, `color`) VALUES
(1, 1, 1, 1, 1, '2018-10-30', '08:00:00', '10:00:00', '#fd79a8'),
(2, 2, 1, 1, 2, '2018-10-31', '10:00:00', '12:00:00', '#55efc4'),
(3, 3, 2, 3, 3, '2018-10-30', '13:30:00', '15:30:00', '#ff7675'),
(7, 1, 3, 1, 2, '2018-10-31', '09:00:00', '11:00:00', '#fd79a8'),
(13, 1, 1, 2, 3, '2018-11-02', '09:00:00', '11:00:00', '#fd79a8'),
(15, 3, 1, 2, 4, '2018-11-01', '15:00:00', '17:00:00', '#f558ca'),
(16, 1, 1, 5, 3, '2018-11-09', '10:00:00', '12:00:00', '#5e2244');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `nickname` varchar(40) NOT NULL,
  `birthday` date NOT NULL,
  `address` text NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` text NOT NULL,
  `lindID` varchar(40) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `password`, `name`, `nickname`, `birthday`, `address`, `tel`, `email`, `facebook`, `lindID`, `picture`, `permission_id`) VALUES
(1, 'wanida', '1414', 'วนิดา กระต่ายจันทร์', 'ครูก้อย', '1993-06-28', '123/2 ตำบลหนองช้าง อำเภอสามชัย จังหวัดกาฬสินธุ์ รหัสไปรษณี 46180', '0833408348', 'wanidacool14@gmail.com', 'wanida niwkoy', 'wanida14.', 'koy.jpg', 2),
(5, 'wanthana', '1234', 'วันทนา ทองแสน', 'ครูอุ้ม', '1993-11-12', '124/3 ตำบลหนองหาน อำเภอหนองหาน จังหวัดอุดรธานี', '0836257450', 'wanthana@gmail.com', 'wanthana', 'wanthana123', 'img-5be1873ada9c7.png', 2),
(6, 'penpak', '1234', 'เพ็ญพักตร์ บัวติ๊ก', 'ครูตั๊ก', '1993-11-15', '123/1 จังหวัดหนองคาย', '0935864750', 'penpak@gmail.com', 'penpak', 'penpak123', 'img-5be18bb4b26dc.jpg', 2),
(7, 'theerachai', '1234', 'ธีระชัย ใจใส', 'ครูบันบัน', '1993-02-07', '214/3 จังหวัดชัยภูมิ', '0833408652', 'theerachail@gmail.com', 'theerachai', 'theerachai123', 'img-5be18c35433b6.jpg', 2),
(8, 'phasitthon', '1234', 'พสิษธนฐ์ พรมแดง', 'ครูพราว', '1993-06-13', '231/4 อำเภอศรีธาตุ จังหวัดอุดรธานี', '0357895230', 'phasitthon@gmail.com', 'phasitthon', 'phasithon123', 'img-5be18cabd233d.jpg', 2),
(9, 'thanu', '1234', 'ธนู ศิลป์เลิศ', 'ครูขุน', '1993-04-24', '123/2 ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี', '0633072884', 'thanu@gmail.com', 'thanu', 'thanu123', 'img-5be18d0aa709c.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_detail` varchar(300) NOT NULL,
  `time` varchar(40) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`id`, `teacher_id`, `subject_id`, `student_id`, `date_detail`, `time`, `place_id`) VALUES
(4, 1, 1, 4, '2 3 4 5 6', '09.00 - 10.00', 2),
(5, 1, 2, 4, '2 3 4 5 6', '09.00 - 10.00', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_timetable`
--
ALTER TABLE `room_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `room_timetable`
--
ALTER TABLE `room_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_timetable`
--
ALTER TABLE `subject_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
