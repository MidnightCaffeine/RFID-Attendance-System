<?php include_once '../connection.php';
session_start();
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
?>

<table id="studentTable" class="display table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        $id = $_SESSION['myid'];
        $selectYou = $pdo->prepare("SELECT * from `student_list` where student_id = '$id'");
        $selectYou->execute();
		while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["student_firstname"];
			$mname = $row["student_middlename"];
			$lname = $row["student_lastname"];
		}
		$fullname = $firstname . " " . $mname . " " . $lname;
        if ($_SESSION["position"] == "Student") {
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `fullname` = '$fullname' ");
        }else{
            $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `date_in` = '$d'");
        }

        $select->execute();
        $num = 0;
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $num++;
            $date = date_create($row["date_in"]);
            $dateadded = date_format($date, "F,d Y");

        ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $dateadded; ?></td>
                <td><?php echo $row["time_in"]; ?></td>
                <td><?php echo $row["time_out"]; ?></td>
            </tr> <?php

                }
                    ?>
    </tbody>
</table>