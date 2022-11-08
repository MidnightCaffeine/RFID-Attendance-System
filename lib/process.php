<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
	switch ($_POST['action']) {
		case 'insertRecord':
			insertRecord();
			break;
		case 'showProcess':
			showProcess();
		default:
			break;
	}
}

function insertRecord()
{
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
			$insert = $pdo->prepare("INSERT INTO `attendance`(`name`, `date`, `time_in`) VALUES ($fullname, $d, $t)");
			$insert->execute();

			echo "success";
		}
	}
}

function showProcess()
{
	include 'connection.php';

	$logs = $pdo->query("SELECT * FROM `rfid`");
	while ($r = $logs->fetch()) {
		echo "<tr>";
		echo "<td>" . $r['id'] . "</td>";
		echo "<td>" . $r['cardid'] . "</td>";
		$dateadded = date("F j, Y, g:i a", $r["logdate"]);
		echo "<td>" . $dateadded . "</td>";
		echo "</tr>";
	}
}
