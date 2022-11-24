<?php
if ($_SESSION['username'] == '' && $_SESSION['position'] != 'Administrator') {
	session_unset();
	session_write_close();
	session_destroy();
    header("Location: index.php");
}
session_start();
$page = "edit_cards";
// include database connection file
include_once("lib/connection.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['rfid_update'])) {
	$uid = $_POST['uid'];

	$cardId = $_POST['cardId'];
	$cardNumber = $_POST['cardNumber'];
	$cardStatus = $_POST['cardStatus'];
	$cardHolderId = $_POST['cardHolderId'];
	$cardHolder = $_POST['cardHolder'];

	$update = $pdo->prepare("UPDATE `rfid_card` SET `card_id` = '$uid' , `card_number` = '$cardNumber' , `card_status` = '$cardStatus' , `card_holder` = '$cardHolder' , `card_holder_id` = '$cardHolderId' WHERE `rfid_card`.`card_id` = '$uid'");
	if ($update->execute()) {
		$_SESSION['status'] = "usuccess";

		// Redirect to cardpage to display updated card in list
		header("Location: rfid_cards.php");
	}
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id

$select = $pdo->prepare("SELECT * FROM rfid_card WHERE `card_id` = '$id' ");

$select->execute();
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
	$cardId = $row['card_id'];
	$cardNumber = $row['card_number'];
	$cardStatus = $row['card_status'];
	$cardHolder = $row['card_holder'];
	$cardHolderId = $row['card_holder_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Edit Card <?php echo $cardId ?></title>
	<meta name="robots" content="noindex, nofollow">
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="assets/img/ascotLogo.png" rel="icon">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
			<h1>Edit Card</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">Manage</li>
					<li class="breadcrumb-item">Device</li>
					<li class="breadcrumb-item">RFID Cards</li>
					<li class="breadcrumb-item active"><?php
														echo "Card " . $id;
														?></li>
				</ol>
			</nav>
		</div>
		<section class="section dashboard">
			<div class="row">
				<div>
					<a type="button" class="btn btn-primary ms-auto mb-2" href="manage_student.php"><i class='bx bx-arrow-back'></i> Back</a>
				</div>

				<form name="update_user" method="POST" action="editCard.php">
					<fieldset>
						<div class="row mb-2">
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="cardId">Card ID</label>
									<input type="text" id="cardId" name="cardId" class="form-control" value="<?php echo $cardId ?>" required />
								</div>
							</div>
							<div class="col-sm-5 col-md-6 mb-2">
								<div class="form-group">
									<label for="cardNumber">Card Number</label>
									<input type="text" id="cardNumber" name="cardNumber" class="form-control" value="<?php echo $cardNumber ?>" required />
								</div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label for="cardStatus">Card Status</label>
							<input type="middlename" id="cardStatus" name="cardStatus" class="form-control" value="<?php echo $cardStatus ?>" />
						</div>
						<div class="form-group mb-2">
							<label for="cardHolder">Card Holder</label>
							<input type="text" id="cardHolder" name="cardHolder" class="form-control" value="<?php echo $cardHolder ?>" />
						</div>
						<input type="text" name="uid" hidden value="<?php echo $id; ?>">
						<input class="btn btn-primary ms-auto" type="submit" name="rfid_update" value="Save Changes">
					</fieldset>
				</form>
			</div>
		</section>
	</main>
	<footer id="footer" class="footer">
		<div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/jquery.validate.js"></script>
	<script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
	<script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
	<script src="assets/js/apexcharts.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/echarts.min.js"></script>
	<script src="assets/js/quill.min.js"></script>
	<script src="assets/js/tinymce.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>

</html>