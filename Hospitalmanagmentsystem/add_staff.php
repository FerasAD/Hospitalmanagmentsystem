<?php require("admin_nav.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Staff</title>
	<style type="text/css">
		 body{
    background-color: rgb(233, 233, 233);
}
    form {
			width: 50%;
			margin: auto;
			padding: 20px;
			border: 1px solid black;
			border-radius: 10px;
      background-color: white;
		}
		input[type="text"], input[type="Email"], input[type="password"], input[type="date"] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type="submit"] {
			background-color: #016b66;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #003a37;
		}
		h1 {
			text-align: center;
		}
		/* Style form error message */
		.error {
			color: red;
		}
		/* Style form success message */
		.success {
			color: green;
		}
	</style>
</head>
<body>
	<br><h1>Add new Staff</h1>
	
	<?php
	// Connect to database
	$database = new SQLite3('C:/xampp/Database/hospital.db');

	// Check if form submitted
	if(isset($_POST['submit'])) {
		// Get user input data
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$Role = $_POST['Role'];
		$Email = $_POST['Email'];
		$Number = $_POST['Number'];
		$Status = $_POST['Status'];

		// Check if Email or Number already exists in database
		$Email_check = $database->querySingle("SELECT COUNT(*) FROM staff WHERE Email='$Email'");
		$Number_check = $database->querySingle("SELECT COUNT(*) FROM staff WHERE Number='$Number'");

		// If Email or Number already exists, display error message
		if($Email_check > 0 && $Number_check > 0) {
			$error_message = "Email address and phone Number are already registered.";
		} else if($Email_check > 0) {
			$error_message = "Email address is already registered.";
		} else if($Number_check > 0) {
			$error_message = "Phone Number is already registered.";
		} else {
			// Generate patient ID
			$Staff_ID = substr($fname, 0, 3) . substr($lname, -3) . rand(100, 999);

			// Insert data into database
			$insert_statement = $database->prepare("INSERT INTO staff (Staff_ID, Fname, Lname, Role, Email, Number, Status) VALUES (:Staff_ID, :fname, :lname, :Role, :Email, :Number, :Status)");
      $insert_statement->bindValue(':Staff_ID', $Staff_ID);
      $insert_statement->bindValue(':fname', $fname);
      $insert_statement->bindValue(':lname', $lname);
      $insert_statement->bindValue(':Role', $Role);
      $insert_statement->bindValue(':Email', $Email);
      $insert_statement->bindValue(':Number', $Number);
      $insert_statement->bindValue(':Status', $Status);
      $insert_statement->execute();

      // Display success message with patient ID
		$success_message = "You have successfully added a staff. This is their ID: $Staff_ID";
	}
}

// Close database connection
$database->close();
?>

<br><form method="post" action="">
	<label for="fname">First Name:</label>
	<input type="text" id="fname" name="fname" required>

	<label for="lname">Surname:</label>
	<input type="text" id="lname" name="lname" required>

	<label for="Role">Role:</label>
	<input type="text" id="Role" name="Role" required>

	<label for="Email">Email:</label>
	<input type="Email" id="Email" name="Email" required>

	<label for="Number">Number:</label>
	<input type="text" id="Number" name="Number" required>

	<label for="Status">Status:</label>
	<input type="text" id="Status" name="Status" required>

	<input type="submit" name="submit" value="Submit">
</form>

<!-- Display error or success message -->
<?php
if(isset($error_message)) {
	echo '<div style="text-align:center;"><p class="error">' . $error_message . '</p></div>';
} else if(isset($success_message)) {
	echo '<div style="text-align:center;"><p class="success">' . $success_message . '</p></div>';
}
?>
</body>
</html>