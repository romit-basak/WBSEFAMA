<?php
	session_start();
	include 'config.php'
?>

<?php

$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$memno = $_POST['memno'];
	$otp = $_POST['otp'];
	$password = $_POST['password'];
	if ($conn->query("select * from Wbusers where MemNo = '".$memno."';")->num_rows == 0) {
		$error = "User not active.";
	}
	elseif ($conn->query("select * from Wbusers where MemNo = '".$memno."' and OTP = '".$otp."';")->num_rows == 0) {
		$error = "Enter correct Membership Number/ OTP.";
	}
	elseif ($password !== $_POST['confirmpassword']) {
		$error = "Password does not match.";
	}
	else {
		$conn->query("UPDATE Wbusers SET Password=MD5('".$password."') WHERE MemNo = '".$memno."' and OTP='".$otp."' ");
		$_SESSION['memno'] == $memno;
		header("location:wbprofile.php");
		echo 1;
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WBSEF&AMA</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
	<script type="text/javascript" src="JavaScript/ScriptMain.js"></script>
</head>
<body>

<?php include 'sidebar.php' ?>

<div class="content">
<h2>Sign Up</h2>
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
			<div>
				<label for="memno">Membership No.</label>
				<input
					type="integer"
					name="memno"
					id="memno"
					required
				>
			</div>

			<div>
				<label for="otp">OTP</label>
				<input
					type="text"
					name="otp"
					id="otp"
					required
				>
			</div>
			<div>
				<label for="password">Password</label>
				<input
					type="password"
					name="password"
					id="password"
					required
				>
			</div>
			<div>
				<label for="confirmpassword">
					Confirm Password
				</label>
				<input
					type="password"
					name="confirmpassword"
					id="confirmpassword"
					required
				>
			</div>
			<div>
				<input type="submit" value="Sign Up">
				<?php echo $error ?>
			</div>
</div>

</div>

</div>

</body>
</html>