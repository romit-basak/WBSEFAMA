
<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='EC' AND SortOrder IN (1,4,7,8) ORDER BY SortOrder ");

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
<h1>Contacts</h1>
<h3>Executive Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				WBSEF&AMA Executive Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='KZ' AND SortOrder IN (1,2) ORDER BY SortOrder ");

?>
<h3>Kolkata Zonal Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				Kolkata Zonal Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='BZ' AND SortOrder IN (1,2) ORDER BY SortOrder ");

?>
<h3>Berhampore Zonal Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				Berhampore Zonal Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='BW' AND SortOrder IN (1,2) ORDER BY SortOrder ");

?>
<h3>Burdwan Zonal Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				Burdwan Zonal Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='SZ' AND SortOrder IN (1,2) ORDER BY SortOrder ");

?>
<h3>Siliguri Zonal Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				Siliguri Zonal Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>

<?php

include 'config.php';
$profiles = $conn->query(" SELECT * FROM Committees a, profiles b WHERE a.MemNo = b.MemNo AND CommitteeCode='MZ' AND SortOrder IN (1,2) ORDER BY SortOrder ");

?>
<h3>Midnapore Zonal Committee.</h3>

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
				<?php echo $profile['Position']; ?>
				<br>
				Midnapore Zonal Committee
			</div>
		</div>
		<div class="person-portfolio">
			<span class="material-icons">mail</span> <?php echo $profile['Email']; ?>
			<br><span class="material-icons">call</span> <?php echo $profile['Mobile']; ?>
		</div>
	</div>


<?php } ?>
