<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
//	$user = $conn->query("select * from Wbusers where MemNo = '{$_SESSION[('memno')]}';")->fetch_assoc();

//include 'config.php';
//    $profiles = $conn->query("SELECT * FROM profiles WHERE memNo > 0 AND Active = 1 ORDER BY Name");


    $profiles = $conn->query(" SELECT OrderNumber, TO_CHAR(OrderDate, 'DD-MM-YYYY') Dt, Subject, Link FROM Resources ORDER BY OrderDate DESC ");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
	<link rel="stylesheet" type="text/css" href="CSS/StylesForm.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
	<script type="text/javascript" src="Javascript/ScriptMain.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>


</head>
<body>
<?php include 'sidebar.php' ?>
<div class="content">

<h1>Library & Resources</h1>

<table>
  <tr>
    <th>Order No.</th>
    <th style="width:10%">Date </th>
    <th>Subject</th>
    <th>VIEW</th>
  </tr>
    <?php while ($profile = $profiles->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $profile['OrderNumber']; ?></td>
            <td><?php echo($profile['Dt']); ?></td>
            <td><?php echo $profile['Subject']; ?></td>
			<td><a href=<?php echo $profile['Link']; ?>>VIEW</td>
        </tr>
<?php } ?>
</table>

</body>
</html>