<?php
include_once 'connection.php';
$username = $_POST['username'];
$email = $_POST['email'];
$select = $pdo->prepare("SELECT email from user_list where email='$email'");
$select->execute();

if ($select->rowCount() > 0) {

    echo false;
}

$select = $pdo->prepare("SELECT username from user_list where username='$username'");
$select->execute();

if ($select->rowCount() > 0) {

    echo false;
} else {
    echo true;
}
