<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
	$user = $conn->query("select a.MemNo, Name, TO_CHAR(DOB, 'DD MONTH YYYY') Dt, Sex, Mobile, Email, Designation, PostedAt, Company from Wbusers a, profiles b where a.MemNo = '{$_SESSION[('memno')]}' and a.MemNo = b.MemNo;")->fetch_assoc();
    $myauth = $conn->query("select Page, PageName, PageLink from AuthMatrix a, Pageindex b where a.MemNo = '{$_SESSION[('memno')]}' and a.Page=b.PageNo order by PageName;");
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

<table>
    <tr>
        <th style="width:40%"></th>
        <th style="width:5%"></th>
        <th></th>
        <thstyle="width:20%"></th>
    </tr>
    <tr>
        <td><h3>Membership Number</h3></td>
        <td></td>
        <td style="text-align:left"><?php echo $user["MemNo"]; ?></td>
    </tr>
    <tr>
        <td><h3>Name</h3></td>
        <td></td>
        <td style="text-align:left"><?php echo $user["Name"]; ?></td>
    </tr>
    <tr>
        <td style="width:10%"><h3>Date of Birth</h3></td>
        <td></td>
        <td style="text-align:left"><?php echo $user["Dt"]; ?></td>
    </tr>
    <tr>
        <td><h3>Sex</h3></td>
        <td></td>
        <td style="text-align:left"><?php echo $user["Sex"]; ?></td>
    </tr>
    <tr>
        <td><h3>Contact Number</h3></td>
        <td></td>
        <td style="text-align:left"><?php echo $user["Mobile"]; ?></td>
    </tr>
    <tr>
        <td><h3>Email</h3></td>
        <td></td>
		<td style="text-align:left"><?php echo $user["Email"]; ?></td>
    </tr>
    <tr>
        <td><h3>Designation</h3></td>
        <td></td>
		<td style="text-align:left"><?php echo $user["Designation"]; ?></td>
    </tr>
    <tr>
        <td><h3>Posted At</h3></td>
        <td></td>
		<td style="text-align:left"><?php echo $user["PostedAt"]; ?></td>
    </tr>
    <tr>
        <td><h3>Company</h3></td>
        <td></td>
		<td style="text-align:left"><?php echo $user["Company"]; ?></td>
    </tr>
</table>
    <a href="wbsubscription.php">Subscription</a>
	<p><a href="wblogout.php">Log Out</a></p>
	
 <?php while ($authloop = $myauth->fetch_assoc()) { ?>	
    <p><a href="<?php echo $authloop['PageLink']; ?>"><?php echo $authloop['PageName']; ?></a></p>
<?php } ?>
</div>

<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>

</body>

</html>
