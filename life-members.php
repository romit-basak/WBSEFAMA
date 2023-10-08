<?php

include 'config.php';
$profiles = $conn->query("SELECT * FROM LifeMembers WHERE Active = 1 ORDER BY Name");

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
<main>
<h1>Our Members</h1>
<h3>The core of the Association is its members. The members are listed in alphabetical order of their names.</h3>
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
				<br>
				<?php echo $profile['Month']; ?>, <?php
					echo $profile['Year']; ?>
			</div>
		</div>
		<div class="person-portfolio">
			Mem # <?php echo $profile['MemNo']; ?>
		</div>
	</div>


<?php } ?>

</main>

</body>
</html>