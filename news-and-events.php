<?php

include 'config.php';
$profiles = $conn->query(" SELECT TO_CHAR(Date, 'DD MONTH YYYY') Dt, Headline, Summary, Image, Link FROM NewsEvents ORDER BY SlNo DESC ");
//$profiles = $conn->query(" SELECT * FROM NewsEvents ORDER BY SlNo DESC ");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
	<script type="text/javascript" src="Javascript/ScriptMain.js"></script>
</head>
<body>
<?php include 'sidebar.php' ?>
<div style="margin-left:25%">
<div style="margin-right:5%">
<main>

<h1>News and Events</h1>

<?php while ($profile = $profiles->fetch_assoc()) { ?>
	<div class="person-info">
		<img
			src="Images/Members/<?php echo $profile['Date']; ?>.jpg"
			class="person-image"
			alt="<?php echo $profile['Date']; ?>"
		>
		<div class="person-details">
			<div class="person-name">
				<?php echo $profile['Headline']; ?>
			</div>
			<div class="news-date">
				<?php 
				    echo($profile['Dt']);
				    //echo date($dt1);
				    //echo date_format($date,"jS F, Y");
				?>
			</div>
		</div>
		<div class="news-summary">
		    <br>
			<?php echo $profile['Summary']; ?>
			<a
				href=<?php $profile['Link']; ?>

				class="news-more"
			>
				More
			</a>
			
		</div>
	</div>


<?php } ?>


</main>

</body>
</html>