<?php include_once 'lib/connection.php';
session_start();
$d = date("Y-m-d");
$page = "home";
if ($_SESSION['username'] == '') {
   session_unset();
   session_write_close();
   session_destroy();
   header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>Home</title>
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
   if ($_SESSION["position"] == "Administrator") {
      include 'include/sideNavigation.php';
   } elseif ($_SESSION["position"] == "Instructor") {
      include 'include/instructorSideNavigation.php';
   } elseif ($_SESSION["position"] == "Student") {
      include 'include/studentSideNavigation.php';
   }

   ?>
   <main id="main" class="main">
      <div class="pagetitle">
         <h1>Dashboard</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.html">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </nav>
      </div>
      <section class="section dashboard">
         <div class="row">
            <div class="col-lg-8">
               <div class="row">
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">Total Student</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `student_list`");
                           $countStudent->execute();

                           $count = 0;

                           while ($row = $countStudent->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bxs-face'></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card revenue-card">
                        <div class="card-body">
                           <h5 class="card-title">Total Instructors</span></h5>
                           <?php
                           $countInstructor = $pdo->prepare("SELECT * FROM `teacher_list`");
                           $countInstructor->execute();

                           $count = 0;

                           while ($row = $countInstructor->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bx-group'></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-xl-12">
                     <div class="card info-card customers-card">
                        <div class="card-body">
                           <h5 class="card-title">Available Cards</span></h5>
                           <?php
                           $countCard = $pdo->prepare("SELECT * FROM `rfid_card` WHERE `card_status`='Available'");
                           $countCard->execute();

                           $count = 0;

                           while ($row = $countCard->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bx-id-card'></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <h5 class="card-title">Student Attendance Report<span> | Today</span></h5>
               <div class="row">
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card ontime-card">
                        <div class="card-body">
                           <h5 class="card-title">On Time Students Count</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `attendance` WHERE remark='On Time' AND date_in='$d' ");
                           $countStudent->execute();

                           $count = 0;

                           while ($row = $countStudent->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bxs-bell'></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card late-card">
                        <div class="card-body">
                           <h5 class="card-title">Late Students Count</span></h5>
                           <?php
                           $countInstructor = $pdo->prepare("SELECT * FROM `attendance` WHERE remark='Late' AND date_in='$d'");
                           $countInstructor->execute();

                           $count = 0;

                           while ($row = $countInstructor->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bxs-bell-off'></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-xl-12">
                     <div class="card info-card absent-card">
                        <div class="card-body">
                           <h5 class="card-title">Absent Student Count</span></h5>
                           <?php
                           $countCard = $pdo->prepare("SELECT * FROM `attendance` WHERE remark='Absent' AND date_in='$d'");
                           $countCard->execute();

                           $count = 0;

                           while ($row = $countCard->fetch(PDO::FETCH_ASSOC)) {
                              $count++;
                           }
                           ?>
                           <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bx-calendar-x'></i></i></div>
                              <div class="ps-3">
                                 <h6><?php echo $count; ?></h6>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                     <div class="activity">
                        <div class="activity-item d-flex">
                           <div class="activite-label">32 min</div>
                           <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                           <div class="activity-content"> Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae</div>
                        </div>
                        <div class="activity-item d-flex">
                           <div class="activite-label">56 min</div>
                           <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                           <div class="activity-content"> Voluptatem blanditiis blanditiis eveniet</div>
                        </div>
                        <div class="activity-item d-flex">
                           <div class="activite-label">2 hrs</div>
                           <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                           <div class="activity-content"> Voluptates corrupti molestias voluptatem</div>
                        </div>
                        <div class="activity-item d-flex">
                           <div class="activite-label">1 day</div>
                           <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                           <div class="activity-content"> Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore</div>
                        </div>
                        <div class="activity-item d-flex">
                           <div class="activite-label">2 days</div>
                           <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                           <div class="activity-content"> Est sit eum reiciendis exercitationem</div>
                        </div>
                        <div class="activity-item d-flex">
                           <div class="activite-label">4 weeks</div>
                           <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                           <div class="activity-content"> Dicta dolorem harum nulla eius. Ut quidem quidem sit quas</div>
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
      $(document).ready(function() {
         $('#studentTable').DataTable({
            pagingType: 'full_numbers',
            responsive: true,

         });
      });
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