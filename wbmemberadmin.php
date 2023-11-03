<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
	$auth = $_SESSION['memno'];

    $myauth = $conn->query("select Page, PageName, PageLink from AuthMatrix a, Pageindex b where a.MemNo = '{$_SESSION[('memno')]}' and a.Page=b.PageNo order by PageName;");
    $BaseYr=2023;


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
</head>
<body>
<?php include 'sidebar.php' ?>
<h2>Member Admin</h2>

    <?php 
    $query ="SELECT Designation FROM desigmast";
    $result = $conn->query($query);
    ?>


<?php
$pageno = 3;
$error = "";
$permission = "";



if ($_REQUEST['btn_submit']=="Get Details") {
//    echo $otpcounter;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $mysubmit=0;
	    if ($conn->query("select MemNo from AuthMatrix where BINARY MemNo = $auth and BINARY Page = $pageno ") ->num_rows == 1) {
	        $mysubmit = 1;
	        $permission = "You are authorized to perform this action.";
	    } else{
	        $mysubmit = 0;
	        $permission = "You are not authorized to perform this action.";
	    }


	    $qmemno = $_POST['qmemno'];
        //$mysubmit = $_POST['mysubmit'];
        if ($mysubmit == 1) {
    	    $qmember = $conn->query("select MemNo, Name, TO_CHAR(DOB, 'DD MONTH YYYY') Dt, Sex, Mobile, Email, Designation, PostedAt, Company from profiles where MemNo = '$qmemno' ;")->fetch_assoc();
    	    $qmemname = $qmember['Name'];
    	    $qdesignation = $qmember['Designation'];
    	    $qpostedat = $qmember['PostedAt'];
    	    $qcompany = $qmember['Company'];
    	    $qdesig = $conn->query(" select * from desigmast where Company = '$qcompany'");
    	    $qposted = $conn->query(" select * from postingmast where Company = '$qcompany'");
            $permission = "You are authorized to perform this action.";
        }
    }
}

if ($_REQUEST['btn_submit']=="Update Designation") {
    //echo "a";
    //echo $mysubmit;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "b";
        $mysubmit = $_POST['mysubmit'];
        //echo $mysubmit;
        $qmemno = $_POST['qmemno'];
        $edesignation = $_POST['edesignation'];
        //echo $mysubmit;
        //$mysubmit = 0;
        if ($mysubmit == 1) {
 	        $rdesi = $_POST['rdesignation'];
            $dt = date('d/m/Y h:i:s a', time());
            $modidesig = $conn->query("UPDATE 
            profiles SET Designation = '$rdesi' WHERE MemNo = '$qmemno' ");
       	    $modidesig = $conn->query("INSERT INTO wblog (KeyNo, PageNo, Item, Value1, Value2, User, Tdate) VALUES ('$qmemno', '$pageno', 'Desig', '$edesignation', '$rdesi', '$auth', '$dt'); ");
    	   
            $permission = "Success!! - Designation updated";    
            $mysubmit = 0;
            //echo $mysubmit;
            $qmemno=NULL;
;
        } else {
        //		$error = "Incorrect Credentials";
            $permission = "You are not authorized to perform this action.";
        }
    }
}
if ($_REQUEST['btn_submit']=="Update Posted At") {
    //echo "a";
    //echo $mysubmit;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "b";
        $mysubmit = $_POST['mysubmit'];
        //echo $mysubmit;
        $qmemno = $_POST['qmemno'];
        //echo $qmemno;
        $epostedat = $_POST['epostedat'];
        //echo $epostedat;
        //echo $mysubmit;
        //$mysubmit = 0;
        if ($mysubmit == 1) {
 	        $rposted = $_POST['rpostedat'];
 	        //echo $rposted;
            $dt = date('d/m/Y h:i:s a', time());
            $modiposted = $conn->query("UPDATE profiles SET PostedAt = '$rposted' WHERE MemNo = '$qmemno' ");
       	    $modiposted = $conn->query("INSERT INTO wblog (KeyNo, PageNo, Item, Value1, Value2, User, Tdate) VALUES ('$qmemno', '$pageno', 'Posting', '$epostedat', '$rposted', '$auth', '$dt') ");
    	   
            $permission = "Success!! - Posting updated";    
            $mysubmit = 0;
            //echo $mysubmit;
            $qmemno=NULL;
;
        } else {
        //		$error = "Incorrect Credentials";
            $permission = "You are not authorized to perform this action.";
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
            <input
                   type="text" 
                    name="memname" 
                    id="memname"
                    value="<?php echo $permission; ?>"
                    readonly="true"
                    
                >
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
            <label for="Membership #">Membership #</label>
            <input 
                type="text" 
                name="qmemno" 
                id="qmemno"
                value="<?php echo $qmemno; ?>" 
            >
			<input type="submit" name="btn_submit" value="Get Details">
            
			</div>
				<div>
                    <label for="memname">Member Name</label>
                    <input
                        type="text" 
                        name="memname" 
                        id="memname"
                        value="<?php echo $qmemname; ?>"
                        readonly="true"
                        style="background-color:#FCF5D8;"
                    >
                
                    <label for="company">Company</label>
                    <input
                        type="text" 
                        name="company" 
                        id="company"
                        value="<?php echo $qcompany; ?>"
                        readonly="true"
                        style="background-color:#FCF5D8;"
                    >
	    		<div>
                    <label for="edesignation">Existing Designation</label>
                    <input
                        type="text" 
                        name="edesignation" 
                        id="edesignation"
                        value="<?php echo $qdesignation; ?>"
                        readonly="true"
                        style="background-color:#FCF5D8;"
                    >
    				<label for="rdesignation">Revised Designation</label>
	    			<select name="rdesignation" id="rdesignation">
                        <option value="" hidden></option>
                        <?php while ($qdes = $qdesig->fetch_assoc()) { ?>
                        <option value="<?php echo $qdes['Designation']; ?>"><?php echo $qdes['Designation']; ?></option>
                        <?php } ?>
				    </select>
				    <input type="submit" name="btn_submit" value="Update Designation">
				    <?php echo $error ?>
			    </div>
			</div>
				<div>
				    <label for="epostedat">Existing Posted At</label>
                    <input 
                        type="text" 
                        name="epostedat" 
                        id="epostedat"
                        value="<?php echo $qpostedat; ?>"
                        readonly="true"
                        style="background-color:#FCF5D8;"
                    >
		    		<label for="rpostedat">Revised Posted At</label>
			    	<select name="rpostedat" id="rpostedat">
                        <option value="" hidden></option>
                        <?php while ($qpost = $qposted->fetch_assoc()) { ?>
                        <option value="<?php echo $qpost['PostedAt']; ?>"><?php echo $qpost['PostedAt']; ?></option>
                        <?php } ?>
	    			</select>
		    		<input type="submit" name="btn_submit" value="Update Posted At">
		        	<?php echo $error ?>
    			</div>
		</form>
	</div>
</div>

<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>


<div class="ad-column">
	<?php
		$adType = "desktop";
		include 'ad.php';
	?>
</div>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

</html>
