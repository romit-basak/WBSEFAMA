<?php
	session_start();
	include 'config.php'
?>

<?php

$error = "";
if ($_REQUEST['btn_submit']=="Request OTP") {
    $otpcounter=0;
    $otpcounter++;
//    echo $otpcounter;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
	    $memno = $_POST['memno'];
	    $password = $_POST['password'];
	    if ($conn->query("select MemNo from Wbusers where BINARY MemNo = '".$memno."' and BINARY Password = MD5('".$password."') ") ->num_rows == 1) {
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
            $dt = date('m/d/Y h:i:s a', time());
            //echo $dt;
            $mailtext = "Your One Time Password (OTP) to Login in wbsefama.org is ";  
            $sql = $conn->query("UPDATE Wbusers SET OTP='$randno', OTPTime='$dt' WHERE MemNo = '$memno'");
            $profiles = $conn->query("SELECT * FROM profiles WHERE MemNo = '$memno'");
            $row = $profiles -> fetch_assoc();
            $to = $row["Email"];
            $subject = "WBSEF&AMA Login OTP (do not reply)";
            $message = "Dear Member,";
            $message .= "<p>$mailtext";
            $message .= $randno;
//            $message .= ".";
            $message .= "<p>This OTP is valid for next 10 minutes only.";
            $message .= "<p>Web service team, WBSEF&AMA";
        
            $header = "From:webadmin@wbsefama.org \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
         
            $retval = mail ($to,$subject,$message,$header);
         
            
	    }

    }
} elseif ($_REQUEST['btn_submit']=="Login") {
    //echo "a";
    //echo $otpcounter;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "b";
	    $otpcounter = $_POST['otpcounter'];
	    $memno = $_POST['memno'];
	    $password = $_POST['password'];
    	$otp = $_POST['otp'];
        //echo $otpcounter;
        //echo $memno;
        //echo $password;
        //echo $otp;

        if ($otpcounter > 0) {
            //echo "c";
            if ($conn->query("select MemNo from Wbusers where BINARY MemNo = '".$memno."' and BINARY Password = MD5('".$password."') and BINARY OTP = '".$otp."' ") ->num_rows == 1) {
                //		echo "Correct";
                $_SESSION['memno'] = $memno;
                header("location:wbprofile.php");
            }
        //	else {
        //        echo = "Incorrect";
        //		$error = "Incorrect Credentials";
        //	}
        $otpcounter = 0;
        //   echo $otpcounter;
        } else {
        //		$error = "Incorrect Credentials";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WBSEF&AMA - Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/StylesMain.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
	<script type="text/javascript" src="JavaScript/ScriptMain.js"></script>
</head>
<body>

<?php include 'sidebar.php' ?>

<div class="content">
<div class="form-container">
		<h2>Login</h2>
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
			<div>
			    <input type="hidden" name="otpcounter" value="<?php echo $otpcounter; ?>" />
				<label for="memno">Membership No.</label>
				<input type="text" name="memno" id="memno" required value="<?php echo $memno;?>">
			</div>
			<div>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required value="<?php echo $password;?>">
			</div>
			<div>
				<label for="otp">OTP</label>
				<input type="text" name="otp" id="otp" >
			</div>
			<input type="submit" name="btn_submit" value="Request OTP">
			<input type="submit" name="btn_submit" value="Login">
			<?php
			if( $retval == true ) {
                echo "Message sent successfully. Please check your registered mail ID for OTP..";
//              header("location:wbsetpwd.php");
            }//else {
            //    echo "Message could not be sent...";
            //}
			?>
			<?php echo $error; ?>
		</form>
	</div>
	Not registered yet? <a href="./wbsign-up.php">Register</a>
	<p>Change password?<a href="./wbsign-up.php">Reset Password</a></p>
</div>

</div>

</div>

</body>
</html>