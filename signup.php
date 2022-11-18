<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/icheck.min.js"></script>
<script src="assets/js/sweetalert.js"></script>
<script src="assets/js/jquery.validate.js"></script>

<?php
include_once 'lib/connection.php';

session_start();

include 'lib/signup.lib.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="assets/img/ascotLogo.png" rel="icon">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/material-design-icons.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/blue.css">

    <link rel="stylesheet" href="assets/css/animate.css">
    <script>
        $().ready(function() {

            // validate signup form on keyup and submit
            $("#signupForm").validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    username: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    firstname: "Please enter your firstname",
                    lastname: "Please enter your lastname",
                    middlename: "Please enter your middlename",
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 5 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address",
                }
            });
        });
    </script>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper d-inline-block">
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">Sign-up</h1>
                        <form id="signupForm" action="" method="post">
                            <fieldset>
                                <div class="row mb-2">
                                    <div class="col-sm-5 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="middlename">Middlename</label>
                                    <input type="middlename" name="middlename" class="form-control" placeholder="Enter Middlename" />
                                </div>
                                <div class="form-group mb-2">
                                    <label for="position">Position</label>
                                    <select name="position" id="position" class="form-select form-control">
                                        <option value="" selected disabled>--Select Position--</option>
                                        <option id="position-option" value="Student">Student</option>
                                        <option id="position-option" value="Instructor">Instructor</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="department">Department</label>
                                    <select name="department" id="department" class="form-select form-control">
                                        <option value="" selected disabled>--Select Department--</option>
                                        <option id="department-option" value="BSIT">BSIT</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="username">Username</label>
                                    <input type="username" name="username" class="form-control" placeholder="Enter Username" required />
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="email@example.com" required />
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" name="password" class="form-control" placeholder="enter your passsword" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="repeat passsword" required />
                                </div>

                                <input name="btn_signup" id="signup" class="btn btn-block login-btn" type="submit" value="Signup" />
                            </fieldset>
                        </form>
                        <p class="login-wrapper-footer-text">Already have an account?<a href="login.php" class="text-reset">Login</a>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block thumbnail text-center">
                    <?php
                    $imagesDir = 'assets/img/bg/';

                    $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                    $randomImage = $images[array_rand($images)];

                    ?>
                    <img src="<?php echo $randomImage; ?>" alt="Random Images" class="login-img" />
                    <div class="caption">
                        <img src="assets/img/ascotLogo.png" alt="logo" class="logo animate__animated animate__bounce" />
                        <h3>ASCOT RFID Class Attendance Monitoring and Student Profiling system</h3>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

</body>

</html>