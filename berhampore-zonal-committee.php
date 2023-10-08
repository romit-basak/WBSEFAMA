<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='BZ' ORDER BY SortOrder ");

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

<div class = "content">
<h1>Berhampore Zonal Committee</h1>

<?php while ($profile = $profiles->fetch_assoc()) { ?>
	<div class="person-info">
		<img
			src="Images/Members/<?php echo $profile['MemNo']; ?>.jpg"
			class="person-image"
			alt="<?php echo $profile['a.MemNo']; ?>"
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
			<?php echo $profile['Position']; ?>
		</div>
	</div>


<?php } ?>

</div>

</body>
</html>