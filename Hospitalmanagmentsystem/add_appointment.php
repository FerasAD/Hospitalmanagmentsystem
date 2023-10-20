<?php require("staffNav.php");

?>

<head>
	<title>Appointment</title>
	<link rel="stylesheet" type="text/css" href="appoint.css">
</head>
<?php
	// Open database connection
	$db = new SQLite3('C:\xampp\Database\hospital.db');

	// Retrieve patient data for selected patient
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$results = $db->query("SELECT * FROM Patients WHERE Patient_ID = '$id'");

		// Check if patient has appointments
		$has_appointments = $db->querySingle("SELECT COUNT(*) FROM Appointments WHERE Patient_ID = '$id'");
		
	} else {
		// Redirect to previous page if patient ID is not set
		header('Location: index.php');
		exit;
	}

	// If patient has appointments, retrieve appointment data
	if ($has_appointments) {
		$appointments = $db->query("SELECT * FROM Appointments WHERE Patient_ID = '$id'");
		$appointment_row = $appointments->fetchArray();
	}

	// If form is submitted, update database with new appointment data
	if (isset($_POST['submit'])) {
		$type = $_POST['type'];
		$date = $_POST['date'];

		// If patient has no appointments, insert new appointment into database
		if (!$has_appointments) {
			$db->exec("INSERT INTO Appointments (Patient_ID, TypeOfAppoint, DateOfAppoin) VALUES ('$id', '$type', '$date')");
		} else {
			// If patient has appointments, update existing appointment
			$db->exec("UPDATE Appointments SET TypeOfAppoint = '$type', DateOfAppoin = '$date' WHERE Patient_ID = '$id'");
		}

		// Redirect back to patient appointments page
		header("Location: view.php?id=$id");
    exit;
	}

	// Close database connection
	$db->close();
?>

<!-- Display form with patient appointment data -->
<h2><?php echo $appointment_row['TypeOfAppoint'] ?? 'Add Appointment'; ?></h2>
<form method="post">
	<label for="type">Type of Appointment:</label>
	<input type="text" name="type" id="type" value="<?php echo $appointment_row['TypeOfAppoint'] ?? ''; ?>"><br>

	<label for="date">Date of Appointment:</label>
	<input type="text" name="date" id="date" value="<?php echo $appointment_row['DateOfAppoin'] ?? ''; ?>"><br>

	<input type="submit" name="submit" value="Save">
</form>