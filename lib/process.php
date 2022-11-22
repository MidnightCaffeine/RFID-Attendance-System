<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');
$cardid = $_POST['cardid'];
$d = date("Y-m-d");
$t = date("h:i:s A");
$remark = array("On Time", "Late", "Early Out");
session_start();


$select = $pdo->prepare("SELECT * from user_list where card_number='$cardid'");
$select->execute();

while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
	$id = $row["id"];
	if ($row["position"] == "Student") {

		$selectStudent = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
		$selectStudent->execute();
		while ($row = $selectStudent->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["student_firstname"];
			$mname = $row["student_middlename"];
			$lname = $row["student_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;

		$getInstructor = $pdo->prepare("SELECT * from attendance_instructor WHERE `date_in` = '$d' ");
		$getInstructor->execute();
		while ($row = $getInstructor->fetch(PDO::FETCH_ASSOC)) {
			$teacher_login = date($row["time_in"]);
			$current_instructor = $row["fullname"];
		}


		$select = $pdo->prepare("SELECT * from attendance WHERE fullname='$fullname' AND date_in='$d' AND time_out='0' ");
		$select->execute();


		if ($select->rowCount() > 0) {
			//logout
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				$ids = $row["id"];
			}
			$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$fullname' AND `date_in` = '$d' AND `id` = '$ids' ");
			$update->execute();
			echo "success";
		} elseif ($t >= date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`, `time_out`, `remark` ,`instructor`) VALUES (:fullname, :d, :t, '0', :remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[1]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();
			echo "success";
		} elseif ($t < date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`,`time_out`,`remark`,`instructor`) VALUES (:fullname, :d, :t, '0',:remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[0]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();
			echo "success";
		}
	} elseif ($row["position"] == "Instructor") {

		$selectTeacher = $pdo->prepare("SELECT * from `teacher_list` where teacher_id = '$id'");
		$selectTeacher->execute();
		while ($row = $selectTeacher->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["teacher_firstname"];
			$mname = $row["teacher_middlename"];
			$lname = $row["teacher_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;


		$select = $pdo->prepare("SELECT * from attendance_instructor where fullname='$fullname' AND date_in='$d' AND time_out='0' ");
		$select->execute();

		if ($select->rowCount() > 0) { //logout
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				$ids = $row["id"];
			}
			$update = $pdo->prepare("UPDATE `attendance_instructor` SET `time_out` = '$t' WHERE `attendance_instructor`.`fullname` = '$fullname' AND `date_in` = '$d' AND `id` = '$ids' ");
			$update->execute();
			echo "success";
		} else { //login
			$insert = $pdo->prepare("INSERT INTO `attendance_instructor`(`fullname`, `date_in`, `time_in`, `time_out`) VALUES (:fullname, :d, :t, '0')");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();
			echo "success";
		}
	}
}
