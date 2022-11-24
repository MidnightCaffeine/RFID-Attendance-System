<?php

if(isset($_POST['exportInstructorAttendance'])){
    $filename = $_FILES['importFile']['name'];
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext,$allowed_ext)){

    }else{
        $_SESSION['status'] = "invalid file";
        header("Location: manage_student.php");
    }
}

?>