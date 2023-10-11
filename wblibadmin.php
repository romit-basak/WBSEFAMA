<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	} 
	$auth = $_SESSION['memno'];
//	$user = $conn->query("select * from Wbusers where MemNo = '{$_SESSION[('memno')]}';")->fetch_assoc();

//include 'config.php';
//    $profiles = $conn->query("SELECT * FROM profiles WHERE memNo > 0 AND Active = 1 ORDER BY Name");


    $profiles = $conn->query(" SELECT DocNo, OrderNumber, TO_CHAR(OrderDate, 'DD-MM-YYYY') Dt, Subject, Link FROM Resources ORDER BY DocNo DESC ");

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
//<?php include 'sidebar.php' ?>
<div class="content">

<h1>Library & Resources Admin</h1>

<?php
$pageno = 1;

if ($_REQUEST['btn_submit']=="Start") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        echo "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        echo "You are not authorized to perform this action.";
	    }
    }
}


if ($_REQUEST['btn_submit']=="Create") {
    //echo "a";
    //echo $mysubmit;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "b";
        $mysubmit = $_POST['mysubmit'];
        //echo $mysubmit;
        if ($mysubmit == 1) {
    	    $orderno = $_POST['orderno'];
	        $orderdt = $_POST['orderdt'];
	        $subject = $_POST['subject'];
    	    $link = $_POST['link'];
    	    $company = $_POST['company'];
    	    $createorder = $conn->query("INSERT INTO Resources (OrderNumber, OrderDate, Subject, Link, Company) VALUES ('$orderno', '$orderdt', '$subject', '$link', '$company'); ");
    	    echo "Success!! - Order Created";
            //echo $mysubmit;
            //echo $orderno;
            //echo $orderdt;
            //echo $subject;
            //echo $link;
            $mysubmit = 0;
            //echo $mysubmit;
        } else {
        //		$error = "Incorrect Credentials";
            echo "You are not authorized to perform this action.";
        }
    }
}

?>





<div class="content">
    <div class="form-container">
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
			<div>
				<input type="submit" name="btn_submit" value="Start">
				<?php echo $error ?>
			</div>
		</form>
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
            <input type="hidden" name="mysubmit" value="<?php echo $mysubmit; ?>" />
			<div>
				<label for="orderno">Order#</label>
				<input
					type="integer"
					name="orderno"
					id="orderno"
					required
				>
			</div>
			<div>
				<label for="orderdt">Order Date</label>
				<input
					type="date"
					name="orderdt"
					id="orderdt"
				>
			</div>
			<div>
				<label for="subject">Subject</label>
				<input
					type="text"
					name="subject"
					id="subject"
					required
				>
			</div>
			<div>
				<label for="link">Link</label>
				<input
					type="text"
					name="link"
					id="link"
					required
				>
			</div>
			<div>
				<label for="company">Company</label>
				<select name="company" id="company">
					<option value="" hidden></option>
					<option value="B">WBSEB</option>
					<option value="D">WBSEDCL</option>
					<option value="T">WBSETCL</option>
				</select>
			</div>
			<div>
				<input type="submit" name="btn_submit" value="Create">
				<?php echo $error ?>
			</div>
		</form>
		
    </div>
</div>
<table>
  <tr>
    <th>Doc No.</th>
    <th>Order No.</th>
    <th style="width:10%">Date </th>
    <th>Subject</th>
    <th>VIEW</th>
  </tr>
    <?php while ($profile = $profiles->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $profile['DocNo']; ?></td>
            <td><?php echo $profile['OrderNumber']; ?></td>
            <td><?php echo($profile['Dt']); ?></td>
            <td><?php echo $profile['Subject']; ?></td>
			<td><a href=<?php echo $profile['Link']; ?>>VIEW</td>
        </tr>
<?php } ?>
</table>

</body>
</html>
