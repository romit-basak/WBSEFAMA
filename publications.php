
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

<h1>Publications</h1>

<?php while ($profile = $profiles->fetch_assoc()) { ?>
	<div class="person-info">
		<div class="person-details">
			<div class="person-name">
			    Order# 
				<?php echo $profile['OrderNumber']; ?>
			</div>
			<div class="news-date">
				Order Date: 
				<?php 
				    echo($profile['Dt']);
				    //echo ($dt1);
				    //echo date_format($date,"jS F, Y");
				?>
			</div>
		</div>
		<div class="news-summary">
			<?php echo $profile['Subject']; ?>
			<a
				href=<?php echo $profile['Link']; ?>
				class="news-more"
			>
				CORE 2023
			</a>

	<div class="person-info">
		<div class="person-details">
			<div class="person-name">
			    Order# 
				<?php echo $profile['OrderNumber']; ?>
			</div>
			<div class="news-date">
				Order Date: 
				<?php 
				    echo($profile['Dt']);
				    //echo ($dt1);
				    //echo date_format($date,"jS F, Y");
				?>
			</div>
		</div>
		<div class="news-summary">
			<?php echo $profile['Subject']; ?>
			<a
				href=<?php echo $profile['Link']; ?>
				class="news-more"
			>
				CORE 2022
			</a>


			
		</div>
	</div>


<?php } ?>


</main>

</body>
</html>