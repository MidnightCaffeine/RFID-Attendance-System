<?php include_once '../connection.php';
session_start();
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
?>

<table id="instructorTable" class="display table table-bordered table-striped">
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
        $selectYou = $pdo->prepare("SELECT * from `teacher_list` where teacher_id = '$id'");
        $selectYou->execute();
		while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
			$firstname = $row["teacher_firstname"];
			$mname = $row["teacher_middlename"];
			$lname = $row["teacher_lastname"];
            $fullname = $firstname . " " . $mname . " " . $lname;
		}

            $select = $pdo->prepare("SELECT * FROM `attendance_instructor` WHERE `date_in` = '$d'");


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