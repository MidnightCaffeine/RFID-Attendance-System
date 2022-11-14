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
        $select = $pdo->prepare("SELECT * FROM `attendance` WHERE `date_in` = '$d'");

        $select->execute();
        $num = 0;
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $num++;
            $date = date_create($row["date_in"]);
            $ti = date_create($row["time_in"]);
            $to = date_create($row["time_out"]);
            $dateadded = date_format($date, "F d Y");
            $time_in = date_format($to, "h:i A");
            $time_out = date_format($to, "h:i A");

        ?>

            <tr>
                <td><?php echo $num."."; ?></td>
                <td><?php echo $row["fullname"]; ?></td>
                <td><?php echo $dateadded; ?></td>
                <td><?php echo $time_in; ?></td>
                <td><?php echo $time_out; ?></td>
            </tr> <?php

                }
                    ?>
    </tbody>
</table>