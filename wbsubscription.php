<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
	$auth = $_SESSION['memno'];
	$user = $conn->query("select * from Wbusers a, profiles b where a.MemNo = '{$_SESSION[('memno')]}' and a.MemNo = b.MemNo;")->fetch_assoc();
	$yr = $conn->query("SELECT * from FinYear where Active = 1")->fetch_assoc();

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
	<script defer src="https://pyscript.net/alpha/pyscript.js"></script>
</head>
<body>

<py-env>
  - qrcode
  - pillow
</py-env>
<?php include 'sidebar.php' ?>
<div style="margin-left:15%">
<div style="margin-right:25%">
<?php
if ($_REQUEST['btn_submit']=="Submit Payment Details") {
    
	$amount = $_POST['paymentamt'];
    $dop = $_POST['paydt'];
    $utr = $_POST['utrno1'];
    $remarks = $_POST['remarks'];
    $dt = date('d/m/Y h:i:s a', time());
    $msg="";
	if ($utr == $_POST['utrno2']) {
	    if (duppay->query("select UTR from Onlinepay where UTR = $utr ") ->num_rows == 1) {
	        $msg = "UTR number already entered.";
	    else {
            $payinfo = $conn->query("INSERT INTO Onlinepay (MemNo, Amount, UTR, DOP, MemberRemarks, Tdate, Recon) VALUES ('$auth', '$amount', '$utr', '$dop', '$remarks', '$dt', 'I')");
	        $msg = "Success!! Payment information submitted.";
            $mailtext = "Your payment information has been submitted successfully.";
//            $sql = $conn->query("UPDATE Wbusers SET OTP='$randno', OTPTime='$dt' WHERE MemNo = '$memno'");
            $profiles = $conn->query("SELECT * FROM profiles WHERE MemNo = '$auth'");
            $row = $profiles -> fetch_assoc();
            $to = $row["Email"];
            $subject = "Your Payment information submitted successfully (do not reply)";
            $message = "Dear ";
            $message .= $row["Name"];
            $message .= " (";
            $message .= $auth;
            $message .= ")";
            $message .= "<p>$mailtext";
//            $message .= $randno;
//            $message .= ".";
            $message .= "<p>Amount Paid: Rs. ";
            $message .= $amount;
            $message .= ", UTR No.: ";
            $message .= $utr;
            $message .= ", Payment date: ";
            $message .= $dop;
            $message .= ".";
            $message .= "<p>Payment receipt will be issued after reconciliation.";
            $message .= "<p>Treasury team, WBSEF&AMA";
        
            $header = "From:subscription@wbsefama.org \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
         
            $retval = mail ($to,$subject,$message,$header);


	    //echo $auth;
	    //echo $amount;
	    //echo $utr;
	    //echo $dop;
	}
	else { $msg = "Password does not match.";
	}
}
?>


<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>

<div class="content-column">
	<h2>Subscription</h2>

	<?php $BaseYr = $yr['BaseYr']; ?>
    <?php $FinYr = $yr['FinYr']; ?>
    <?php $StartDt = $yr['StartDt']; ?>
    <?php $EndDt = $yr['EndDt']; ?>

    <?php 
        //$due = $conn->query("SELECT Dues.MemNo, Name, Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total, Payment FROM profiles, Dues LEFT JOIN Payments ON Dues.MemNo = Payments.MemNo where Dues.Year= $BaseYr and Dues.MemNo=profiles.MemNo and profiles.MemNo = '{$_SESSION[('memno')]}'")->fetch_assoc(); 
    
        $due = $conn->query("SELECT Dues.MemNo, Name, Dues.Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total, Payment FROM profiles, Dues LEFT JOIN TotPayments ON (Dues.MemNo = TotPayments.MemNo and TotPayments.Year= $BaseYr ) where Dues.Year= $BaseYr and Dues.MemNo=profiles.MemNo and profiles.MemNo = '{$_SESSION[('memno')]}'")->fetch_assoc();
        //$onlpay = $conn->query("SELECT sum(Amount) Onl from Onlinepay where MemNo = $auth and DOP >= $StartDt and DOP <= $EndDt and length(Recon)=0 group by MemNo");
        $onlpay = $conn->query("SELECT sum(Amount) Onl from Onlinepay where MemNo = $auth and DOP >= '$StartDt' and DOP <= '$EndDt' ")->fetch_assoc();
        //echo $onlpay['Onl'];
        //echo $StartDt;
        //echo $EndDt;
        //echo $auth;
        ?>
<?php echo "Financial Year: ", $FinYr; ?>

<table style="width:80%">
    <tr style="height:2px">
        <th style="width:15%"></th>
        <th style="width:20%"></th>
        <th style="width:10%"></th>
        <th style="width:40%"></th>
        <th style="width:35%"></th>
    </tr>

    <tr style="height:2px">
        <td></td>
        <td><h3>Member</h3></td>
        <td></td>
        <td colspan="3" style="text-align:left"><?php echo $user["Name"], "  (", $user["MemNo"], ")" ; ?></td>
        <td></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Prev Dues</h3></td>
        <td></td>
        <td style="text-align:right"><?php echo($due['OpBal']); ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td style="width:10%"><h3>Subscription</h3></td>
        <td></td>
        <td style="text-align:right"><?php echo($due['Membership']); ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Farewell</h3></td>
        <td></td>
        <td style="text-align:right"><?php echo $due['Farewell']; ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Total</h3></td>
        <td></td>
        <td style="text-align:right"><?php echo $due['Total']; ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Payment</h3></td>
        <td></td>
		<td style="text-align:right"><?php echo $due['Payment']; ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Balance</h3></td>
        <td></td>
        <?php $tot=$due['Total']; ?>
        <?php $pay=$due['Payment']; ?>
		<td style="text-align:right"><b><?php echo $tot-$pay; ?></b></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Unreconciled Payment</h3></td>
        <td></td>
        <?php $onl=$onlpay['Onl']; ?>
		<td style="text-align:right"><?php echo $onl; ?></td>
    </tr>
    <tr style="height:2px">
        <td></td>
        <td><h3>Payment Due</h3></td>
        <td></td>
        <?php $baldue=$tot-$pay-$onl; ?>
		<td style="text-align:right"><b><?php echo $baldue; ?></b></td>
    </tr>
</table>
</div>
<?php if ($baldue > 0) { ?>
<p><b>Scan for payment</b>

<py-script>
import qrcode
import base64 
 
# Naprawiam oryginalną zepsutą metodę render_image
def render_image(mime, value, meta):
  data = f"data:{mime};base64,{base64.b64encode(value).decode('utf-8')}"
  return f"\u003cimg src='{data}'\u003e"

img = qrcode.make("upi://pay?pa=9432068009@ucobank&am=<?php echo $baldue; ?>&tn=Mem <?php echo $auth; ?>")
 
# Zwracam referencję do obrazka w ostatniej linii kodu
img
</py-script>  
<font color = "red">After payment please fill the form below for reconciliation and issue of payment receipt.</font>
<div class="content">
    <div class="form-container">
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
    	>
            <div>
                <label for="paymentamt">Payment Amount</label>
                <input
                   type="text" 
                    name="paymentamt" 
                    id="paymentamt"
                    required
                >
                <p>
                <label for="utrno1">UTR Number</label>
                <input
                   type="password" 
                    name="utrno1" 
                    id="utrno1"
                    required
                ></p>
                <label for="utrno2">Re-Enter UTR Number</label>
                <input
                   type="text" 
                    name="utrno2" 
                    id="utrno2"
                    required
                >
                <p>
                <label for="paydt">Payment Date</label>
                <input
                   type="date" 
                    name="paydt" 
                    id="paydt"
                    required
                ></p>
                <p>
                <label for="remarks">Member Remarks (optional)</label>
                <input
                   type="text" 
                    name="remarks" 
                    id="remarks"
                ></p>
                <input type="submit" name="btn_submit" value="Submit Payment Details">
                    <?php echo $error ?>
                <p></p>
                <textarea id="msg" name="msg" rows="3" cols="30" margin: "0px" readonly style="align-content:left; overflow:auto; border:"none" outset #000000;">
                    <?php echo $msg; ?>
                </textarea>
                </p>

            </div>
        
    </div>
<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>
<?php } ?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>



</body>

</html>
