<?php
	session_start();
	include 'config.php';
	if (!isset($_SESSION['memno'])) {
		header("location:wblogin.php");
	}
	$user = $conn->query("select a.MemNo, Name, TO_CHAR(DOB, 'DD MONTH YYYY') Dt, CASE WHEN Sex = 'M' THEN 'Male' WHEN Sex = 'F' THEN 'Female' END AS Sex, Mobile, Email, Designation, PostedAt, Company from Wbusers a, profiles b where a.MemNo = '{$_SESSION[('memno')]}' and a.MemNo = b.MemNo;")->fetch_assoc();
	//$user = $conn->query("select a.MemNo, Name, TO_CHAR(DOB, 'DD MONTH YYYY') Dt, Sex, Mobile, Email, Designation, PostedAt, Company from Wbusers a, profiles b where a.MemNo = '{$_SESSION[('memno')]}' and a.MemNo = b.MemNo;")->fetch_assoc();
    $myauth = $conn->query("select Page, PageName, PageLink from AuthMatrix a, Pageindex b where a.MemNo = '{$_SESSION[('memno')]}' and a.Page=b.PageNo order by PageName;");
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
</head>
<body>
<?php include 'sidebar.php' ?>
<div style="margin-left:20%">
<div style="margin-right:5%">

<style>
textarea {
  resize: none;
}
</style>
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
        <th style="width:10%"></th>
        <th style="width:5%"></th>
        <th style="width:10%"></th>
        <th style="width:5%"></th>
        <th style="width:70%"></th>
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
        <td rowspan="3" 
            <div style="width:150px;height:150px;overflow:hidden;" >
	            <img src="Images/Members/<?php echo $user['MemNo']; ?>.jpg" width="150px" height="auto">
            </div>
        </td>
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
		<td rowspan="3">
        <b>To change Profile Image</b> <br>
        Upload a square image of size within 200 KB in JPG/ JPEG/ PNG format only.
		<?php
            if(isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
                $expensions= array("jpg", "jpeg", "png");
                $msg="";
                if(in_array($file_ext,$expensions)=== false){
                    $msg=$msg."Fail!! Extension not allowed, please choose a JPG/ JPEG/ PNG file.";
                    //echo nl2br ("\n Fail!! Extension not allowed, please choose a JPG/ JPEG/ PNG file.");
                    $errors[]="extension not allowed, please choose a JPG file.";
                }
      
                if($file_size > 209716){
                    $msg=$msg."Fail!! File size must be within 200 KB";
                    //echo nl2br ("\n Fail!! File size must be within 200 KB");
                    $errors[]='File size must be within 200 KB';
                }
      
                if(empty($errors)==true){
                    //move_uploaded_file($file_tmp,"Images/Members/Requests/".$user["MemNo"].".jpg");
                    move_uploaded_file($file_tmp,"Images/Members/Requests/".$file_name);
                    $msg=$msg."Success!! Image submitted for approval";
                    //echo nl2br ("\n Success!! Image submitted for approval");
                    //echo  nl2br ("\n kings \n garden");
                }else{
                    //print_r($errors);
                }
            }
        ?>

      
        <form action="" method="POST" enctype="multipart/form-data">
            <textarea id="msg" name="msg" rows="3" cols="30" margin: "0px" readonly style="align-content:center; overflow:auto; border:"none" outset #000000;">
                <?php echo $msg; ?>
            </textarea>
            <input type="file" name="image" />
            <input type="submit"/>
        </form>
	    </td>
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

<script>

    function msg(){
        var result = document.getElementById(msg).value;
        console.log(result);
        result = result.trim();
        console.log(result);
        document.getElementById("text-area").value = result
    }
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


</body>

</html>
