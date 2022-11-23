<?php include_once 'lib/connection.php';
session_start();

$page = "backup_and_restore";

if ($_SESSION['username'] == '' && $_SESSION['position'] != 'Administrator') {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Backup And Restore</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/ascotLogo.png" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
    <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/quill.snow.css" rel="stylesheet">
    <link href="assets/css/quill.bubble.css" rel="stylesheet">
    <link href="assets/css/remixicon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'include/navigation.php';
    include 'include/sideNavigation.php';


    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Backup And Restore</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</a></li>
                    <li class="breadcrumb-item active">Backup And Restore</a></li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">

            <div class="container">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <h4 class="card-title ms-4">Backup</h4>
                            <p class="card-text ms-4">Save backup of the database.</p>
                            <div class="d-grid gap-2 ms-4 mb-4 me-4">
                                <a class="btn btn-primary" href="lib/backup_function.php">Backup</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title ms-4">Restore</h4>
                                <p class="card-text ms-4">Restore data of the database.</p>
                                <div class="d-grid gap-2 ms-4 mb-4 me-4">
                                    <a class="btn btn-primary" href="restore_function.php">Restore</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        </section>
    </main>
    <footer id="footer" class="footer">
        <div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
        function verifyAnswer() {
            //enable all the radio button   
            document.getElementById("backupStudentTable").disabled = false;
            document.getElementById("backupInstructorTable").disabled = false;
            document.getElementById("backupRFIDTable").disabled = false;
            document.getElementById("backupStudentAttendanceTable").disabled = false;
            document.getElementById("backupInstructorAttendanceTable").disabled = false;

            //get the value if checkbox is checked  
            var backupall = document.getElementById("backupAll").checked;
            var backupStudentTable = document.getElementById("backupStudentTable").checked;
            var backupInstructorTable = document.getElementById("backupInstructorTable").checked;
            var backupRFIDTable = document.getElementById("backupRFIDTable").checked;
            var backupStudentAttendanceTable = document.getElementById("backupStudentAttendanceTable").checked;
            var backupInstructorAttendanceTable = document.getElementById("backupInstructorAttendanceTable").checked;

            if (backupall == true) {
                //enable all the radio button  
                document.getElementById("backupStudentTable").disabled = true;
                document.getElementById("backupStudentTable").checked = false;
                document.getElementById("backupInstructorTable").disabled = true;
                document.getElementById("backupInstructorTable").checked = false;
                document.getElementById("backupRFIDTable").disabled = true;
                document.getElementById("backupRFIDTable").checked = false;
                document.getElementById("backupStudentAttendanceTable").disabled = true;
                document.getElementById("backupStudentAttendanceTable").checked = false;
                document.getElementById("backupInstructorAttendanceTable").disabled = true;
                document.getElementById("backupInstructorAttendanceTable").checked = false;
            }
        }
    </script>

    <script src="assets/js/apexcharts.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/echarts.min.js"></script>
    <script src="assets/js/quill.min.js"></script>
    <script src="assets/js/tinymce.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>