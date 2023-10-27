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
	$dues = $conn->query(" SELECT Dues.MemNo, Name, Dues.Year, Mths_in_Yr, OpBal, Membership, Farewell,OpBal+Membership+Farewell Total, Payment FROM profiles, Dues LEFT JOIN TotPayments ON (Dues.MemNo = TotPayments.MemNo and TotPayments.Year= $BaseYr) where Dues.MemNo=profiles.MemNo and Dues.Year = $BaseYr order by Name"); 
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

<h1>Dues Admin</h1>

<?php
$pageno = 2;

if ($_REQUEST['btn_submit']=="Start") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        $permission = "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        $permission = "You are not authorized to perform this action.";
	    }
    }
}


if ($_REQUEST['btn_submit']=="Insert") {
    //echo "a";
    //echo $mysubmit;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "b";
        $mysubmit = $_POST['mysubmit'];
        echo $mysubmit;
        //$mysubmit = 0;
        if ($mysubmit == 1) {
    	    $memno = $_POST['memno'];
	        $payment = $_POST['payment'];
	        $rcptdt = $_POST['rcptdt'];
    	    $rcptno = $_POST['rcptno'];
    	    $paymode = $_POST['paymode'];
    	    $payperiod = $_POST['payperiod'];
    	    $onldt = $_POST['onldt'];
    	    $onlno = $_POST['onlno'];
    	    $createorder = $conn->query("INSERT INTO Payments (MemNo, Payment, ReceiptNo, ReceiptDate, Mode, Period, OnlineNo, OnlineDate) VALUES ('$memno', '$payment', '$rcptno', '$rcptdt', '$paymode', '$payperiod', '$onlno', '$onldt'); ");
    	    $totpay = $conn->query("SELECT sum(Payment) Tpay FROM `Payments` WHERE MemNo = $memno and ReceiptDate BETWEEN '$StartDt' and '$EndDt' ")->fetch_assoc();
    	    $tpay = $totpay['Tpay'];
    	    $totpay = $conn->query("DELETE FROM TotPayments where Year = $BaseYr and MemNo = '$memno' ");
    	    echo $tpay;
    	    $totpay = $conn->query("INSERT INTO TotPayments (MemNo, Payment, Year) VALUES ('$memno', '$tpay', $BaseYr) ");
            $permission = "Success!! - Payment Inserted";    
            $mysubmit = 0;
            echo $mysubmit;
            $memno=NULL;
            $payment=NULL;
            $rcptno=NULL;
            $rcptdt=NULL;
            $paymode=NULL;
            $payperiod=NULL;
            $onlno=NULL;
            $onldt=NULL;
            //echo $orderno;
            //echo $orderdt;
            //echo $subject;
            //echo $link;
            //echo $mysubmit;
        } else {
        //		$error = "Incorrect Credentials";
            $permission = "You are not authorized to perform this action.";
        }
    }
}
            //$mysubmit = 0;


?>

<? php
    $tpay = $totpay['Tpay'];
    echo $tpay;
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
            <input
                   type="text" 
                    name="permission" 
                    id="permission"
                    value="<?php echo $permission; ?>"
                    readonly="true"
                    
                >
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
				<label for="memno">Membership#</label>
				<input
					type="integer"
					name="memno"
					id="memno"
					required
				>
			</div>
			<div>
				<label for="payment">Payment Amount</label>
				<input
					type="integer"
					name="payment"
					id="payment"
					required
				>
			</div>
			<div>
				<label for="rcptdt">Receipt Date</label>
				<input
					type="date"
					name="rcptdt"
					id="rcptdt"
					required
				>
			</div>
			<div>
				<label for="rcptno">Receipt#</label>
				<input
					type="integer"
					name="rcptno"
					id="rcptno"
					required
				>
			</div>
			<div>
				<label for="paymode">Payment Mode</label>
				<select name="paymode" id="paymode">
                   <option value="" hidden></option>
					<option value="1">Cash</option>
					<option value="2">Online</option>
					required
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
				>
			</div>
			<div>
				<label for="onlno">Online#</label>
				<input
					type="integer"
					name="onlno"
					id="onlno"
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
    </tr>
    <?php while ($due = $dues->fetch_assoc()) { ?>
        <tr>
            <td style="text-align:center"><?php echo $due['MemNo']; ?></td>
            <td><?php echo $due['Name']; ?></td>
            <td style="text-align:right"><?php echo($due['OpBal']); ?></td>
            <td style="text-align:right"><?php echo($due['Membership']); ?></td>
            <td style="text-align:right"><?php echo $due['Farewell']; ?></td>
			<td style="text-align:right"><?php echo $due['Total']; ?></td>
			<?php $tot=$due['Total']; ?>
			<td style="text-align:right"><?php echo $due['Payment']; ?></td>
			<?php $pay=$due['Payment']; ?>
			<td style="text-align:right"><?php echo $tot-$pay; ?></td>
        </tr>
    <?php } ?>

</table>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>
