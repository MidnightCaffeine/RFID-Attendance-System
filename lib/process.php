<?php
include 'connection.php';
date_default_timezone_set('Asia/Manila');
$cardid = $_POST['cardid'];
$d = date("Y-m-d");
$t = date("h:i:s A");



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
		

		$select = $pdo->prepare("SELECT * from attendance where fullname='$fullname' AND date_in='$d' AND time_out='' ");
		$select->execute();

		while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
			$ids = $row["id"];
			$temp = $row["time_out"];
			$altemp = strtotime($row["time_in"]);
			$lg = date("H:i:sa", strtotime('+30 minutes', $altemp));
		}

		if ($select->rowCount() > 0) { //logout
			if ($temp != "" && $t < $lg) {//login
				$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`) VALUES (:fullname, :d, :t)");
				$insert->bindParam(":fullname", $fullname);
				$insert->bindParam(":d", $d);
				$insert->bindParam(":t", $t);
				$insert->execute();
			} elseif ($temp == "" && $t > $lg) {
				$update = $pdo->prepare("UPDATE `attendance` SET `time_out` = '$t' WHERE `attendance`.`fullname` = '$fullname' AND `date_in` = '$d' AND `id` = '$ids' ");
				$update->execute();
			}
		}else {//login
			$insert = $pdo->prepare("INSERT INTO `attendance`(`fullname`, `date_in`, `time_in`) VALUES (:fullname, :d, :t)");
			$insert->bindParam(":fullname", $fullname);
			$insert->bindParam(":d", $d);
			$insert->bindParam(":t", $t);
			$insert->execute();
		}

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
