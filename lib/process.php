<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');
$cardid = $_POST['cardid'];
$d = date("Y-m-d");
$t = date("H:i:sa");


$select = $pdo->prepare("SELECT * from user_list where card_number='$cardid'");
$select->execute();

while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
	$id = $row["id"];
	if ($row["position"] == "Student") {

		$select = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
		$select->execute();
		while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["student_firstname"];
			$mname = $row["student_middlename"];
			$lname = $row["student_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;

		$select = $pdo->prepare("SELECT * from attendance where fullname='$fullname' AND date_in='$d'");
		$select->execute();

		if ($select->rowCount() > 0) { //logout
			while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
				$temp = $row["time_out"];
			}
			if ($temp == "") {
				$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$fullname' AND `date_in` = '$d'");
				$update->execute();
			} else {//login
				$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`) VALUES (:fullname, :d, :t)");
				$insert->bindParam(":fullname", $fullname);
				$insert->bindParam(":d", $d);
				$insert->bindParam(":t", $t);
				$insert->execute();
			}
		} else { 
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`) VALUES (:fullname, :d, :t)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();
		}//end of login

		echo "success";
	} else {
		$select = $pdo->prepare("SELECT * from `teacher_list` where teacher_id = '$id'");
		$select->execute();
		while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["teacher_firstname"];
			$mname = $row["teacher_middlename"];
			$lname = $row["teacher_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;

		$select = $pdo->prepare("SELECT fullname FROM attendance WHERE fullname='$fullname' AND date_in='$d'");
		$select->execute();

		if ($select->rowCount() > 0) { //logout
			$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$fullname'");
			$update->execute();
		} else { //login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`) VALUES (:fullname, :d, :t)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();
		}

		echo "success";
	}
}
