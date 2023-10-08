<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
	$user = $conn->query("select * from Wbusers a, profiles b where a.MemNo = '{$_SESSION[('memno')]}' and a.MemNo = b.MemNo;")->fetch_assoc();
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
</head>
<body>
<?php include 'sidebar.php' ?>
<div style="margin-left:25%">
<div style="margin-right:5%">


<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>

<div class="content-column">
	<h2>Profile</h2>
	<div>
		<h3>Membership Number</h3>
		<?php echo $user["MemNo"]; ?>
	</div>
	<div>
		<h3>Name</h3>
		<?php echo $user["Name"]; ?>
	</div>
	<div>
		<h3>Date of Birth</h3>
		<?php echo $user["DOB"]; ?>
	</div>
	<div>
		<h3>Sex</h3>
		<?php echo $user["Sex"]; ?>
	</div>
	<div>
		<h3>Phone Number</h3>
		<?php echo $user["Mobile"]; ?>
	</div>
	<div>
		<h3>Email</h3>
		<?php echo $user["Email"]; ?>
	</div>
	<a href="wblogout.php">Log Out</a>
</div>

<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>

</body>

</html>