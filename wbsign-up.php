<?php
	session_start();
	include 'config.php'
?>

<?php

$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$memno = $_POST['memno'];
	$dob = $_POST['dob'];
	$sex = $_POST['sex'];
	$company = $_POST['company'];
	$sapid = $_POST['sapid'];
    //print $memno;
    //print $dob;
    //print $sex;
    //print $company;
    //print $sapid;
    $profiles = $conn->query("SELECT * FROM profiles WHERE MemNo = '$memno' AND DOB = '$dob' AND Sex = '$sex' AND SAPID = '$sapid' ");
    $row = $profiles -> fetch_assoc();
    // Return the number of rows in result set
    $rowcount = mysqli_num_rows($profiles);

    if($rowcount<1){  
        printf ("Details not matching with our records. Please check.");  
    }  else{  
        //printf ("Welcome %s (%d) %s\n", $row["Name"], $row["MemNo"], $row["Email"]);
        $profiles1 = $conn->query("SELECT * FROM Wbusers WHERE MemNo = '$memno' ");
        
        $rowcount1 = mysqli_num_rows($profiles1);
        echo $rowcount1;
        $n=6;
        function getName($n) {
            $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
            $randomString = '';
 
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
                
        }
        $randno=getName($n);
        echo $randno;
        $dt = date('m/d/Y h:i:s a', time());
        //echo $dt;

        if($rowcount1<1){  
            $mailtext = "Your One Time Password (OTP) to Register in wbsefama.org is ";  
    		$profiles2 = $conn->query("INSERT INTO Wbusers (MemNo, OTP, OTPTime) VALUES ('$memno', '$randno', '$dt'); ");
        }  else{  
            $mailtext = "Your One Time Password (OTP) to Reset password in wbsefama.org is ";  
    		$sql = $conn->query("UPDATE Wbusers SET OTP='$randno', OTPTime='$dt' WHERE MemNo = '$memno'");
        }

        $to = $row["Email"];
        $subject = "WBSEF&AMA Login OTP (do not reply)";
        $message = "Dear Member,";
        $message .= "<p>$mailtext";
        $message .= $randno;
    //    $message .= ".";
        $message .= "<p>This OTP is valid for next 10 minutes only.";
        $message .= "<p>Web service team, WBSEF&AMA";
         
        $header = "From:webadmin@wbsefama.org \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
         
        $retval = mail ($to,$subject,$message,$header);
         
        if( $retval == true ) {
            echo "Message sent successfully.  Please check your registered mail ID for OTP..";
            header("location:wbsetpwd.php");
        }else {
            echo "Message could not be sent...";
        }
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
<div class="form-container">
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
				<label for="dob">Date of Birth</label>
				<input
					type="date"
					name="dob"
					id="dob"
				>
			</div>
			<div>
				<label for="sex">Sex</label>
				<select name="sex" id="sex">
					<option value="" hidden></option>
					<option value="F">Female</option>
					<option value="M">Male</option>
				</select>
			</div>
			<div>
				<label for="SAPID">SAP ID</label>
				<input
					type="tel"
					name="sapid"
					id="sapid"
					required
				>
			</div>
			<div>
				<input type="submit" value="Proceed">
				<?php echo $error ?>
			</div>
		</form>
	</div>
	Already have an account? <a href="./login.php">Login</a>
</div>

</div>

</div>

</body>
</html>