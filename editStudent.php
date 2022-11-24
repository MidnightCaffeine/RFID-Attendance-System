<?php
session_start();
$page = "edit_student";
if ($_SESSION['username'] == '' && $_SESSION['position'] != 'Administrator' || $_SESSION['position'] != 'Instructor') {
	session_unset();
	session_write_close();
	session_destroy();
	header("Location: index.php");
 }
// include database connection file
include_once("lib/connection.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
	$uid = $_POST['uid'];


	$ufirstname = ucwords(strtolower($_POST['firstname']));
	$ulastname = ucwords(strtolower($_POST['lastname']));
	$umiddlename = ucwords(strtolower($_POST['middlename']));
	$uphone = $_POST['phone'];
	$uyeargroup = $_POST['yeargroup'];
	$usection = $_POST['section'];

	$update = $pdo->prepare("UPDATE `student_list` SET `student_firstname` = '$ufirstname', `student_middlename` = '$umiddlename', `student_lastname` = '$ulastname', `phone` = '$uphone', `year_group` = '$uyeargroup',  `section` = '$usection' WHERE `student_list`.`student_id` = '$uid'");
	if($update->execute()){
		$_SESSION['status'] = "usuccess";

	// Redirect to homepage to display updated user in list
	header("Location: manage_student.php");
	}

}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id

$select = $pdo->prepare("SELECT * FROM student_list WHERE `student_id` = '$id' ");

$select->execute();
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

	$firstname = $row['student_firstname'];
	$lastname = $row['student_lastname'];
	$middlename = $row['student_middlename'];
	$phone = $row['phone'];
	$yeargroup = $row['year_group'];
	$section = $row['section'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title><?php echo $lastname.', '.$firstname.' '.substr($middlename, 0, 1).'.'?> Data</title>
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
			<h1>Edit Student</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Manage</li>
					<li class="breadcrumb-item">Users</li>
					<li class="breadcrumb-item">Student</li>
					<li class="breadcrumb-item active"><?php 
					echo $lastname.', '.$firstname.' '.substr($middlename, 0, 1).'.';
					?></li>
				</ol>
			</nav>
		</div>
		<section class="section dashboard">
			<div class="row">
				<div>
					<a type="button" class="btn btn-primary ms-auto mb-2" href="manage_student.php"><i class='bx bx-arrow-back'></i> Back</a>
				</div>

				<form name="update_user" method="post" action="editStudent.php">
					<fieldset>
						<div class="row mb-2">
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="firstname">Firstname</label>
									<input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" required />
								</div>
							</div>
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="lastname">Lastname</label>
									<input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" required />
								</div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label for="middlename">Middlename</label>
							<input type="middlename" name="middlename" class="form-control" value="<?php echo $middlename ?>" />
						</div>
						<div class="form-group mb-2">
							<label for="phone">Phone</label>
							<input type="text" name="phone" class="form-control" value="<?php echo $phone ?>" />
						</div>
						<div class="row mb-2">
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="yeargroup">Year Group</label>
									<input type="text" name="yeargroup" class="form-control" value="<?php echo $yeargroup ?>" required />
								</div>
							</div>
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="section">Section</label>
									<input type="text" name="section" class="form-control" value="<?php echo $section ?>" required />
								</div>
							</div>
						</div>
						<input type="text" name="uid" hidden value="<?php echo $id; ?>">
						<input class="btn btn-primary ms-auto" type="submit" name="update" value="Save Changes">
					</fieldset>
				</form>
			</div>
		</section>
	</main>
	<footer id="footer" class="footer">
		<div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>