<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	} 
	$auth = $_SESSION['memno'];
//	$user = $conn->query("select * from Wbusers where MemNo = '{$_SESSION[('memno')]}';")->fetch_assoc();
    $yr = $conn->query("SELECT * from FinYear where Active = 1")->fetch_assoc();
?>
<?php $BaseYr = $yr['BaseYr']; ?>
<?php $FinYr = $yr['FinYr']; ?>
<?php $StartDt = $yr['StartDt']; ?>
<?php $EndDt = $yr['EndDt']; ?>


<?php
	//$dues = $conn->query(" SELECT Dues.MemNo, Name, Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total, Payment FROM profiles, Dues LEFT JOIN Payments ON Dues.MemNo = Payments.MemNo where Dues.MemNo=profiles.MemNo order by Name"); 
	//$dues = $conn->query(" SELECT Dues.MemNo, Name, Dues.Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total, Payment FROM profiles, Dues LEFT JOIN TotPayments ON (Dues.MemNo = TotPayments.MemNo and TotPayments.Year= $BaseYr) where Dues.MemNo=profiles.MemNo and Dues.Year = $BaseYr order by Name"); 
    $dues = $conn->query(" SELECT Dues.MemNo, Name, Dues.Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total FROM profiles, Dues where Dues.MemNo=profiles.MemNo and Dues.Year = $BaseYr order by Name"); 
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
<div style="margin-left:15%">
<div style="margin-right:2%">
<div class="content">

<h1>Dues Admin</h1>

<?php
$pageno = 2;
$error = "";
$permission = "";

if ($_REQUEST['btn_submit']=="Get Details") {
//    echo $otpcounter;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $qmemno = $_POST['qmemno'];
        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        $permission = "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        $permission = "You are not authorized to perform this action.";
	    }
	    
        //$mysubmit = $_POST['mysubmit'];
        if ($mysubmit == 1) {
            echo $qmemno;
	        $onlinepay = $conn->query("select count(*) cnt from Onlinepay where MemNo = '$qmemno' and DOP between '$StartDt' and '$EndDt' ")->fetch_assoc();
            $onlcoun = $onlinepay['cnt'];
	        $onlinepay = $conn->query("select * from Onlinepay where MemNo = '$qmemno' and DOP between '$StartDt' and '$EndDt' ");
            
        }
    }
} elseif ($_REQUEST['btn_submit']=="Pull") {
    echo "k";
    $qmemno = $_POST['qmemno'];
    echo $qmemno;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        //$permission = "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        $permission = "You are not authorized to perform this action.";
	    }
        if ($mysubmit == 1) {
            echo $qmemno;
	        $onlinepay = $conn->query("select count(*) cnt from Onlinepay where MemNo = '$qmemno' and DOP between '$StartDt' and '$EndDt' ")->fetch_assoc();
            $onlcoun = $onlinepay['cnt'];
	        $onlinepay = $conn->query("select * from Onlinepay where MemNo = '$qmemno' and DOP between '$StartDt' and '$EndDt' ");
	        $pull = $_POST['onlinepay'];
	        $pullarr = explode("~",$pull);
	        $onldt = $pullarr[0];
	        $payment = $pullarr[1];
	        $onlno = $pullarr[2];
    	    $permission = $payment."M".$onldt."M".$onlno
        }
    }
} elseif ($_REQUEST['btn_submit']=="Insert") {
    echo "Z";
    echo $qmemno;
    
    echo $onldt;
    echo $payment;
    echo $onlno;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        //$permission = "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        $permission = "You are not authorized to perform this action.";
	    }
        if ($mysubmit == 1) {
            $qmemno = $_POST['qmemno'];
            $payment = $_POST['payment'];
            if (empty($payment))  {
                $payment = 0;
            }
	        $rcptdt = $_POST['rcptdt'];
    	    $rcptno = $_POST['rcptno'];
            if (empty($rcptno))  {
                $rcptno = 0;
            }
    	    $paymode = $_POST['paymode'];
    	    $payperiod = $_POST['payperiod'];
            $onldt = $_POST['onldt'];
            $onlno =$_POST['onlno'];
            if ($qmemno > 0) {
                if ($payment > 0) {
                        if (empty($rcptdt)) {
                            else {
                                if ($rcptno > 0) {
                                    if (empty($paymode)) {
                                        $msg= "Select appropriate Payment Mode";
                                        else {
                                            if (empty($payperiod)) {
                                               $msg= "Select appropriate Payment Period";
                                               else {
                                                   if ($paymode = 2) {
                                                        if (empty($onldt) or empty($onlno)) {
                                                            $msg= "UTR No and Date is required for online collection."
                                                            else { $insert = 1; 
                                                            }
                                                        }
                                               }
                                            }
                                        }
                                    else {
                                        $msg= "Enter appropriate Receipt#";
                                        
                                    }
                            }
                        }
                    else {
                    $msg= "Enter appropriate Payment Amount";    
                    }
                }
                else {
                $msg= "Select appropriate Membership#";
                }
            }
	        echo $qmemno; 
	    
	    
    }
}

?>
<?php echo $qmemno; 
echo $onlcoun; ?>

<div class="content">
    <h1>Member Admin</h1>
    <div class="form-container">
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
		    <div>
            <input
                   type="text" 
                    name="memname" 
                    id="memname"
                    value="<?php echo $permission; ?>"
                    readonly="true"
                    
                >
			    <?php echo $error ?>
		    </div>
            <input type="hidden" name="mysubmit" value="<?php echo $mysubmit; ?>" />
            <label for="Membership #">Membership #</label>
            <input 
                type="text" 
                name="qmemno" 
                id="qmemno"
                value="<?php echo $qmemno; ?>" 
            >
			<input type="submit" name="btn_submit" value="Get Details">
			<div>
				<label for="onlinepay">Online Payment</label>
				<select name="onlinepay" id="onlinepay">
                    <option value="" hidden></option>
					<?php 
					if ($onlcoun > 0) { ?>
    					<?php while ($onlpay = $onlinepay->fetch_assoc()) { ?>	
                        <option value="<?php echo $onlpay['DOP']."~".$onlpay['Amount']."~".$onlpay['UTR'] ; ?>"><?php echo "DOP: ".$onlpay['DOP'].", Rs.: ".$onlpay['Amount'].", UTR: ".$onlpay['UTR']; ?></option>
                    <?php }} ?>
				</select>
			</div>
			<div>
				<input type="submit" name="btn_submit" value="Pull">
			</div>
			<div>
                <label for="payment"se>Payment Amount</label>
                <input 
					type="integer"
					name="payment"
					id="payment"
                    value="<?php echo $payment; ?>"
    			>
			</div>

			<div>
				<label for="rcptdt">Receipt Date</label>
				<input
					type="date"
					name="rcptdt"
					id="rcptdt"
				>
			</div>
			<div>
				<label for="rcptno">Receipt#</label>
				<input
					type="integer"
					name="rcptno"
					id="rcptno"
				>
			</div>

            <div>
				<label for="paymode">Payment Mode</label>
				<select name="paymode" id="paymode">
                   <option value="" hidden></option>
					<option value="1">Cash</option>
					<option value="2">Online</option>
				</select>
			</div>
			<div>
				<label for="payperiod">Payment Period</label>
				<select name="payperiod" id="payperiod">
				    <option value="" hidden></option>
					<option value="A">Arrear</option>
					<option value="C">Current</option>
					<option value="B">Both</option>
				</select>
			</div>
			<div>
				<label for="onldt">Online Date</label>
				<input
					type="date"
					name="onldt"
					id="onldt"
					value="<?php echo $onldt; ?>"
				>
			</div>
			<div>
				<label for="onlno">Online#</label>
				<input
					type="integer"
					name="onlno"
					id="onlno"
					value="<?php echo $onlno; ?>"
				>
			</div>
			<div>
				<input type="submit" name="btn_submit" value="Insert">
				<?php echo $error ?>
			</div>
			
		</form>
	</div>
</div>
			

<table>
    <tr>
        <th>Mem No.</th>
        <th>Name</th>
        <th style="width:10%">Prev Dues </th>
        <th>Subscription</th>
        <th>Farewell</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Balance</th>
        <th>Unreconciled</th>
        <th>Payment Due</th>
    </tr>
    <?php while ($due = $dues->fetch_assoc()) { ?>
        <tr>
            <td style="text-align:center"><?php echo $due['MemNo']; ?></td>
            <?php $mno=$due['MemNo']; ?>
            <td><?php echo $due['Name']; ?></td>
            <td style="text-align:right"><?php echo($due['OpBal']); ?></td>
            <td style="text-align:right"><?php echo($due['Membership']); ?></td>
            <td style="text-align:right"><?php echo $due['Farewell']; ?></td>
			<td style="text-align:right"><?php echo $due['Total']; ?></td>
			<?php $tot=$due['Total']; ?>
			<?php $pmnt = $conn->query("SELECT sum(Payment) Pay FROM `Payments` WHERE MemNo = '$mno' and ReceiptDate BETWEEN '$StartDt' and '$EndDt' ")->fetch_assoc(); ?>
			<?php $pay=$pmnt['Pay']; ?>
			<td style="text-align:right"><?php echo $pay; ?></td>
			<td style="text-align:right"><?php echo $tot-$pay; ?></td>
			<?php $opay = $conn->query("SELECT sum(Amount) opay FROM `Onlinepay` WHERE MemNo = '$mno' and DOP BETWEEN '$StartDt' and '$EndDt' ")->fetch_assoc(); ?>
			<td style="text-align:right"><?php echo $opay['opay']; ?></td>
			<td style="text-align:right"><?php echo $tot-$pay-$opay['opay']; ?></td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
