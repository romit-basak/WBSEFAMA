include 'config.php';

<?php

if ($_REQUEST['btn_submit']=="View regulation") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Store the file name into variable
        //$file = 'https://drive.google.com/file/d/19pPmz90MWBGJ0Wy8Ih4qJPjqvNy0kg9M/view';
        $file = 'Docs/Benevolance Regulation.pdf';
        $filename = 'Docs/Benevolance Regulation.pdf';
        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        // Read the file
        @readfile($file);
    }
}
if ($_REQUEST['btn_submit']=="Claim Form") {
    echo "cgcvhgv  j                                              gbjgjhk                     jvjbvba";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Store the file name into variable
        //$file = 'https://drive.google.com/file/d/19pPmz90MWBGJ0Wy8Ih4qJPjqvNy0kg9M/view';
        $file = 'Docs/Benevolence Form.pdf';
        $filename = 'Docs/Benevolence Form.pdf';
        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        // Read the file
        @readfile($file);
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
	<link rel="stylesheet" type="text/css" href="CSS/StylesForm.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
	<script type="text/javascript" src="Javascript/ScriptMain.js"></script>
	
</head>
<body>

<?php include 'sidebar.php' ?>
<div style="margin-left:5%">
<div style="margin-right:5%">
<h2>Members' Benevolence Scheme</h2>

<div class="content">
    <div class="form-container">
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
			<div>
				<input type="submit" name="btn_submit" value="View regulation">
				<input type="submit" name="btn_submit" value="Claim Form">
				<?php echo $error ?>
			</div>
		</form>
		<form
			method="post"
			action="<?php
						echo htmlspecialchars($_SERVER['PHP_SELF'])
					;?>"
		>
			<div>
				<label for="beneficiary">Name of beneficiary</label>
				<input
					type="text"
					name="beneficiary"
					id="beneficiary"
					required
				>
			</div>
			<div>
				<label for="add1">Adress of beneficiary <p></p>House No.</label>
				<input
					type="text"
					name="add1"
					id="add1"
					required
				>
			</div>
			<div>
				<label for="add2">Road/ Street</label>
				<input
					type="text"
					name="add2"
					id="add2"
					required
				>
			</div>
			<div>
				<label for="add3">Area/ Locality</label>
				<input
					type="text"
					name="add3"
					id="add3"
					required
				>
			</div>
			<div>
				<label for="add4">Landmark</label>
				<input
					type="text"
					name="add4"
					id="add4"
					required
				>
			</div>
			<div>
				<label for="state">State</label>
				<select name="state" id="state">
					<option value="" hidden></option>
                    <option value=1>Andaman and Nicobar Island</option>
                    <option value=2>Andhra Pradesh</option>
                    <option value=3>Arunachal Pradesh</option>
                    <option value=4>Assam</option>
                    <option value=5>Bihar</option>
                    <option value=6>Chandigarh</option>
                    <option value=7>Chhattisgarh</option>
                    <option value=8>Dadra and Nagar Haveli</option>
                    <option value=9>Daman and Diu</option>
                    <option value=10>Delhi</option>
                    <option value=11>Goa</option>
                    <option value=12>Gujarat</option>
                    <option value=13>Haryana</option>
                    <option value=14>Himachal Pradesh</option>
                    <option value=15>Jammu and Kashmir</option>
                    <option value=16>Jharkhand</option>
                    <option value=17>Karnataka</option>
                    <option value=18>Kerala</option>
                    <option value=19>Ladakh</option>
                    <option value=20>Lakshadweep</option>
                    <option value=21>Madhya Pradesh</option>
                    <option value=22>Maharashtra</option>
                    <option value=23>Manipur</option>
                    <option value=24>Meghalaya</option>
                    <option value=25>Mizoram</option>
                    <option value=26>Nagaland</option>
                    <option value=27>Odisha</option>
                    <option value=28>Puducherry</option>
                    <option value=29>Punjab</option>
                    <option value=30>Rajasthan</option>
                    <option value=31>Sikkim</option>
                    <option value=32>Tamil Nadu</option>
                    <option value=33>Telangana</option>
                    <option value=34>Tripura</option>
                    <option value=35>Uttar Pradesh</option>
                    <option value=36>Uttarakhand</option>
                    <option value=37>West Bengal</option>
				</select>
			</div>
			<div>
				<label for="pin">PIN</label>
				<input
					type="integer"
					name="pin"
					id="pin"
					required
				>
			</div>
			<div>
				<label for="relation">Relationship with Member</label>
				<select name="relation" id="relation">
					<option value="" hidden></option>
                    <option value=1>Wife</option>
                    <option value=2>Husband</option>
                    <option value=3>Daughter</option>
                    <option value=4>Son</option>
                    <option value=5>Mother</option>
                    <option value=6>Father</option>
                    <option value=7>Niece</option>
                    <option value=8>Nephew</option>
				</select>
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
				<label for="aadhar">AADHAR No.</label>
				<input
					type="integer"
					name="aadhar"
					id="aadhar"
					required
				>
			</div>
			<div>
				<label for="pan">PAN No.</label>
				<input
					type="text"
					name="pan"
					id="pan"
					required
				>
			</div>
			<div>
				<label for="share">% Share</label>
				<input
					type="integer"
					name="share"
					id="share"
					required
				>
			</div>
			<div>
				<label for="guardian"><p>Name of guardian</label>
				<input
					type="text"
					name="guardian"
					id="guardian"
					required
				>
			</div>
			<div>
				<label for="add1">Adress of guardian <p></p>House No.</label>
				<input
					type="text"
					name="add1"
					id="add1"
					required
				>
			</div>
			<div>
				<label for="add2">Road/ Street</label>
				<input
					type="text"
					name="add2"
					id="add2"
					required
				>
			</div>
			<div>
				<label for="add3">Area/ Locality</label>
				<input
					type="text"
					name="add3"
					id="add3"
					required
				>
			</div>
			<div>
				<label for="add4">Landmark</label>
				<input
					type="text"
					name="add4"
					id="add4"
					required
				>
			</div>
			<div>
				<label for="state">State</label>
				<select name="state" id="state">
					<option value="" hidden></option>
                    <option value=1>Andaman and Nicobar Island</option>
                    <option value=2>Andhra Pradesh</option>
                    <option value=3>Arunachal Pradesh</option>
                    <option value=4>Assam</option>
                    <option value=5>Bihar</option>
                    <option value=6>Chandigarh</option>
                    <option value=7>Chhattisgarh</option>
                    <option value=8>Dadra and Nagar Haveli</option>
                    <option value=9>Daman and Diu</option>
                    <option value=10>Delhi</option>
                    <option value=11>Goa</option>
                    <option value=12>Gujarat</option>
                    <option value=13>Haryana</option>
                    <option value=14>Himachal Pradesh</option>
                    <option value=15>Jammu and Kashmir</option>
                    <option value=16>Jharkhand</option>
                    <option value=17>Karnataka</option>
                    <option value=18>Kerala</option>
                    <option value=19>Ladakh</option>
                    <option value=20>Lakshadweep</option>
                    <option value=21>Madhya Pradesh</option>
                    <option value=22>Maharashtra</option>
                    <option value=23>Manipur</option>
                    <option value=24>Meghalaya</option>
                    <option value=25>Mizoram</option>
                    <option value=26>Nagaland</option>
                    <option value=27>Odisha</option>
                    <option value=28>Puducherry</option>
                    <option value=29>Punjab</option>
                    <option value=30>Rajasthan</option>
                    <option value=31>Sikkim</option>
                    <option value=32>Tamil Nadu</option>
                    <option value=33>Telangana</option>
                    <option value=34>Tripura</option>
                    <option value=35>Uttar Pradesh</option>
                    <option value=36>Uttarakhand</option>
                    <option value=37>West Bengal</option>
				</select>
			</div>
			<div>
				<label for="pin">PIN</label>
				<input
					type="integer"
					name="pin"
					id="pin"
					required
				>
			</div>
			<div>
				<label for="relation">Relationship with Minor Beneficiary</label>
				<select name="relation" id="relation">
					<option value="" hidden></option>
                    <option value=1>Wife</option>
                    <option value=2>Husband</option>
                    <option value=3>Daughter</option>
                    <option value=4>Son</option>
                    <option value=5>Mother</option>
                    <option value=6>Father</option>
                    <option value=7>Niece</option>
                    <option value=8>Nephew</option>
				</select>
			</div>
			<div>
				<label for="aadhar">AADHAR No.</label>
				<input
					type="integer"
					name="aadhar"
					id="aadhar"
					required
				>
			</div>
			<div>
				<label for="pan">PAN No.</label>
				<input
					type="text"
					name="pan"
					id="pan"
					required
				>
			</div>
		</form>
	</div>
</div>


<!-- <a href="https://drive.google.com/file/d/19pPmz90MWBGJ0Wy8Ih4qJPjqvNy0kg9M/view?usp=sharing">View regulation</a> -->

</body>
</html>