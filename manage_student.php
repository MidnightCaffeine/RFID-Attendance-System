<?php include_once 'lib/connection.php';
session_start();
include 'lib/student/addStudent.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>Manage Student</title>
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
   <script src="assets/js/apexcharts.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/chart.min.js"></script>
   <script src="assets/js/echarts.min.js"></script>
   <script src="assets/js/quill.min.js"></script>
   <script src="assets/js/tinymce.min.js"></script>
   <script src="assets/js/main.js"></script>
   <script>
      $(document).ready(function() {
         $('body').on('shown.bs.modal', '.modal', function() {
            e.preventDefault();
            // validate signup form on keyup and submit
            $("#addstudent").validate({
               rules: {
                  firstname: "required",
                  lastname: "required",
                  middlename: "required",
                  username: {
                     required: true,
                     minlength: 5,
                     remote: {
                        url: "lib/ifUserExist.php",
                        type: "post"
                     }
                  },
                  password: {
                     required: true,
                     minlength: 4
                  },
                  confirm_password: {
                     required: true,
                     minlength: 4,
                     equalTo: "#password"
                  },
                  email: {
                     required: true,
                     email: true,
                     remote: {
                        url: "lib/ifUserExist.php",
                        type: "post"
                     }
                  },
               },
               messages: {
                  firstname: "Please enter your firstname",
                  lastname: "Please enter your lastname",
                  middlename: "Please enter your middlename",
                  username: {
                     required: "Please enter a username",
                     minlength: "Your username must consist of at least 5 characters",
                     remote: "Email already in use!"
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
                  email: {
                     required: "Please provide an email address",
                     email: "Please enter a valid email address",
                     remote: "Email already in use!"
                  }
               }
            });
         })

      });
   </script>
</head>

<body>
   <?php
   include 'include/navigation.php';
   include 'include/sideNavigation.php';
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
            <div class="d-flex align-items-center mt-3 mb-2">
               <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort</button>
                  <ul class="dropdown-menu">
                     <li><a href="#" class="dropdown-item">BSIT AP3</a></li>
                     <li><a href="#" class="dropdown-item">BSIT AP4</a></li>
                  </ul>
               </div>

               <!-- add trigger modal -->
               <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addStudent">Add Students</button>

            </div>
            <table id="studentTable" class="display table table-bordered">
               <thead>
                  <tr>
                     <th>Student ID</th>
                     <th>Firstname</th>
                     <th>Middlename</th>
                     <th>Lastname</th>
                     <th>Department</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody class="table-group-divider">
                  <?php
                  $select = $pdo->prepare("SELECT * FROM student_list  ORDER BY student_id ASC");

                  $select->execute();
                  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                     <tr>
                        <td><?php echo $row["student_id"]; ?></td>
                        <td><?php echo $row["student_firstname"]; ?></td>
                        <td><?php echo $row["student_middlename"]; ?></td>
                        <td><?php echo $row["student_lastname"]; ?></td>
                        <td><?php echo $row["department"]; ?></td>
                        <td>
                           <button name="edit" type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#updateStudent" data-toggle="tooltip" title="Edit"><i class="bi bi-pencil-square"></i></button>
                        </td>
                        <td>
                           <form action="lib/student/deleteStudent.php" method="post">
                              <input type="hidden" name="id" value="<?php echo $row['student_id'] ?>">
                              <button type="submit" name="delete" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="bi bi-trash"></i></button>
                           </form>
                        </td>
                     </tr> <?php }
                           ?>
               </tbody>
            </table>
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
            columnDefs: [{
               'targets': [0, 2, 3, 4, 5],
               /* column index */

               'orderable': false,
               /* true or false */
            }, ],
         });
      });
   </script>


   <!-- add User Modal -->

   <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="addstudent" action="" method="post">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
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
                        <select name="position" id="position" class="form-select form-control" hidden>
                           <option id="position-option" value="Student" selected>Student</option>
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
                  </fieldset>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" name="btn_addStudent">Understood</button>
               </div>
            </form>
         </div>
      </div>
   </div>



</body>

</html>