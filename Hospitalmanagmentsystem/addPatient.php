<?php require("staffNav.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Patient</title>
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
		input[type="text"], input[type="email"], input[type="password"], input[type="date"] {
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
	<br><h1>Add a Patient</h1>
	
	<?php
	// Connect to database
	$database = new SQLite3('C:/xampp/Database/hospital.db');

	// Check if form submitted
	if(isset($_POST['submit'])) {
		// Get user input data
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$dob = $_POST['dob'];
		$postcode = $_POST['postcode'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$number = $_POST['number'];
		$password = $_POST['password'];

		// Check if email or number already exists in database
		$email_check = $database->querySingle("SELECT COUNT(*) FROM patients WHERE Email='$email'");
		$number_check = $database->querySingle("SELECT COUNT(*) FROM patients WHERE Number='$number'");

		// If email or number already exists, display error message
		if($email_check > 0 && $number_check > 0) {
			$error_message = "Email address and phone number are already registered.";
		} else if($email_check > 0) {
			$error_message = "Email address is already registered.";
		} else if($number_check > 0) {
			$error_message = "Phone number is already registered.";
		} else {
			// Generate patient ID
			$patient_id = substr($fname, 0, 3) . substr($lname, -3) . rand(10, 99);

			// Insert data into database
			$insert_statement = $database->prepare("INSERT INTO patients (Patient_ID, Fname, Lname, DOB, Postcode, Address, Email, Number, Password) VALUES (:patient_id, :fname, :lname, :dob, :postcode, :address, :email, :number, :password)");
      $insert_statement->bindValue(':patient_id', $patient_id);
      $insert_statement->bindValue(':fname', $fname);
      $insert_statement->bindValue(':lname', $lname);
      $insert_statement->bindValue(':dob', $dob);
      $insert_statement->bindValue(':postcode', $postcode);
      $insert_statement->bindValue(':address', $address);
      $insert_statement->bindValue(':email', $email);
      $insert_statement->bindValue(':number', $number);
      $insert_statement->bindValue(':password', $password);
      $insert_statement->execute();

      // Display success message with patient ID
		$success_message = "You have successfully signed up. This is your ID: $patient_id";
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

	<label for="dob">Date of Birth:</label>
	<input type="date" id="dob" name="dob" required>

	<label for="postcode">Postcode:</label>
	<input type="text" id="postcode" name="postcode" required>

	<label for="address">Address:</label>
	<input type="text" id="address" name="address" required>

	<label for="email">Email:</label>
	<input type="email" id="email" name="email" required>

	<label for="number">Number:</label>
	<input type="text" id="number" name="number" required>

	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required>

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