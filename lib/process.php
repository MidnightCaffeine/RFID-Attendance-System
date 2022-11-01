<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
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

function insertRecord() {
    include 'connection.php';
    $cardid = $_POST['cardid'];
    $time = time();
    $stmt = $pdo->prepare("INSERT INTO `rfid`(`cardid`, `logdate`) VALUES (:card, :dt)");
    $stmt->bindParam(":card", $cardid);
    $stmt->bindParam(":dt", $time);
	$stmt->execute();
	
	echo "success";
}

function showProcess()
{
	include 'connection.php';

	$logs = $pdo->query("SELECT * FROM `rfid`");
	while($r = $logs->fetch()){
		echo "<tr>";
		echo "<td>".$r['id']."</td>";
		echo "<td>".$r['cardid']."</td>";
		$dateadded = date("F j, Y, g:i a", $r["logdate"]);
		echo "<td>".$dateadded."</td>";
		echo "</tr>";
	}
}

?>
