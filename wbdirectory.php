<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
//	$user = $conn->query("select * from Wbusers where MemNo = '{$_SESSION[('memno')]}';")->fetch_assoc();

//include 'config.php';
    $profiles = $conn->query("SELECT * FROM profiles WHERE memNo > 0 AND Active = 1 ORDER BY Name");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<?php include 'sidebar.php' ?>
<div style="margin-left:25%">
<div style="margin-right:5%">
<main>
<h2>Members' Directory</h2>
<?php while ($profile = $profiles->fetch_assoc()) { ?>
	<div class="person-info">
		<img
			src="Images/Members/<?php echo $profile['MemNo']; ?>.jpg"
			class="person-image"
			alt="<?php echo $profile['Name']; ?>"
		>
		<div class="person-details">
			<div class="person-name">
				<?php echo $profile['Name']; ?>
				</div>
			<div class="person-designation">
				<?php echo $profile['Designation']; ?>
				<br>
				<?php echo $profile['PostedAt']; ?>, <?php
					echo $profile['Company']; ?>
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

</main>

</body>
</html>