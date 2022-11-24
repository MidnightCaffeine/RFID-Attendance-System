<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');
$cardid = $_POST['cardid'];
$d = date("Y-m-d");
$t = date("h:i:s A");
$remark = array("On Time", "Late", "Absent");
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
			$guardianEmail = $row["guardian_email"];
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
			if (mail($guardianEmail, "Student " . $fullname . " Leave classroom", "Your Son/Daughter " . $fullname . " has logged out")) {
				echo "success";
			}
		} elseif ($t >= date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`, `time_out`, `remark` ,`instructor`) VALUES (:fullname, :d, :t, '0', :remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[1]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();
			if (mail($guardianEmail, "Student entered classroom", "Your Son/Daughter " . $fullname . " entered class " . $remark[1])) {
				echo "success";
			}
		} elseif ($t < date('H:i:s', strtotime($teacher_login . ' +15 minutes'))) { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`,`time_out`,`remark`,`instructor`) VALUES (:fullname, :d, :t, '0',:remark,:instructor)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->bindParam(":remark", $remark[0]);
			$insert->bindParam(":instructor", $current_instructor);
			$insert->execute();
			if (mail($guardianEmail, "Student entered classroom", "Your Son/Daughter " . $fullname . " Entered Class " . $remark[0])) {
				echo "success";
			}
		} else {
			echo "error";
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

			$selectAbsent = $pdo->prepare("SELECT * FROM student_list");
			if ($selectAbsent->execute()) {
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					$ids = $row["id"];
					$studentName = $row["student_firstname"] . " " . $row["student_middlename"] . " " . $row["student_lastname"];

					$getAttendanceList = $pdo->prepare("SELECT * FROM attendance WHERE fullname='$studentName' ");
					$getAttendanceList->execute();

					if ($getAttendanceList->rowCount() < 1) {

						$d = 0;

						$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`,`time_out`,`remark`,`instructor`) VALUES (:fullname, :d, :t, '0',:remark,:instructor)");
						$insert->bindParam(":fullname", $studentName);
						$insert->bindParam(":d", $d);
						$insert->bindParam(":t", $d);
						$insert->bindParam(":remark", $remark[2]);
						$insert->bindParam(":instructor", $fullname);
						$insert->execute();

						if (mail($guardianEmail, "Student " . $fullname . " Absent", "Your Son/Daughter " . $fullname . " didn't attend the class")) {
							echo "success";
						}
						
					}elseif(($getAttendanceList->rowCount() >= 1 && $row['time_out'] == '0')){

						$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$studentName' AND `date_in` = '$d' AND `id` = '$ids' ");
						$update->execute();

						if (mail($guardianEmail, "Student " . $studentName . " Leave classroom", "The class of your Son/Daughter " . $studentName . " has ended")) {
							echo "success";
						}

					}else {
						echo "success";
				}
				}
			}
		} else { //login
			$insert = $pdo->prepare("INSERT INTO `attendance_instructor`(`fullname`, `date_in`, `time_in`, `time_out`) VALUES (:fullname, :d, :t, '0')");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();

			$selectStudents = $pdo->prepare("SELECT * from user_list WHERE position='Student' ");
			if ($selectStudents->execute()) {
				while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
					$email = $row["email"];
					if (mail($email, "Instructor Arrived", "Your Instructor " . $fullname . " has logged in please proceed to room 1")) {
						echo "success";
					}
				}
			}
		}
	}
}
