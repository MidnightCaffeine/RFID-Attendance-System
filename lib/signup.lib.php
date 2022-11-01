<?php
if (isset($_POST['btn_signup'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //echo $username ."-".$useremail."-".$password."-".$userrole;

    if (isset($_POST['email']) or isset($_POST['username'])) {

        $select = $pdo->prepare("SELECT email from user_list where email='$email'");
        $select->execute();

        if ($select->rowCount() > 0) {

            echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Warning!",
text: "Email Already Exist : Please try from different Email !!",
icon: "warning",
button: "Ok",
});


});

</script>';
        }
        $select = $pdo->prepare("SELECT username from user_list where username='$username'");
        $select->execute();
        if ($select->rowCount() > 0) {

            echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Warning!",
text: "Username Already Exist : Please try from different username !!",
icon: "warning",
button: "Ok",
});


});

</script>';
        } else {


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

                echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Good Job!",
text: "Your Registration is Successfull",
icon: "success",
button: "Ok",
});


});

</script>';
            } else {

                echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Error!",
text: "Registration Fail !!!",
icon: "error",
button: "Ok",
});


});

</script>';
            }
        }
    } // end if txtemail




}
