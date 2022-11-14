<?php
if (isset($_POST['btn_addStudent'])) {

    $firstname = ucwords(strtolower($_POST['firstname'])) ;
    $lastname = ucwords(strtolower($_POST['lastname']));
    $middlename = ucwords(strtolower($_POST['middlename']));
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //echo $username ."-".$useremail."-".$password."-".$userrole;


    $insert = $pdo->prepare("INSERT into user_list(username,email,password,position) values(:name,:email,:pass,:position)");

    $insert->bindParam(':name', $username);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':pass', $hashedPassword);
    $insert->bindParam(':position', $position);


    if ($insert->execute()) {

        $select = $pdo->prepare("SELECT id FROM user_list WHERE username='$username'");
        $select->execute();

        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
        }

        if ($_POST['position'] == 'Student') {
            $insert = $pdo->prepare("INSERT into student_list(student_id ,student_firstname,student_middlename ,student_lastname, department ) values(:id, :firstname, :middlename, :lastname, :department)");

            $insert->bindParam(':id', $id);
            $insert->bindParam(':firstname', $firstname);
            $insert->bindParam(':middlename', $middlename);
            $insert->bindParam(':lastname', $lastname);
            $insert->bindParam(':department', $department);
            $insert->execute();
        } else if ($_POST['position'] == 'Instructor') {
            $insert = $pdo->prepare("INSERT into teacher_list(teacher_id ,teacher_firstname,teacher_middlename ,teacher_lastname, department ) values(:id, :firstname, :middlename, :lastname, :department)");

            $insert->bindParam(':id', $id);
            $insert->bindParam(':firstname', $firstname);
            $insert->bindParam(':middlename', $middlename);
            $insert->bindParam(':lastname', $lastname);
            $insert->bindParam(':department', $department);
            $insert->execute();
        }

        $_SESSION['status'] = "asuccess";
    } else {
        $_SESSION['status'] = "error";
    }
} // end if txtemail
