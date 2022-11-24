<?php
session_start();
include_once '../connection.php';
if ($_SESSION['username'] == '' && $_SESSION['position'] != 'Administrator') {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $pdo->prepare("DELETE FROM `student_list` WHERE student_id='$id' ");
    $delete->execute();
    $delete = $pdo->prepare("DELETE FROM `user_list` WHERE id='$id' ");
    if ($delete->execute()) {

        $_SESSION['status'] = "dsuccess";

        header("location:../../manage_student.php");
    } else {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
