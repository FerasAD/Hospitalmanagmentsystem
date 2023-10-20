<?php require("staffNav.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Patient Information</title>
	<style>
		 body{
    background-color: rgb(233, 233, 233);
}
		table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
    margin: 20px auto;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

th {
    background-color: #016b66;
    color: white;
    font-weight: bold;
    padding: 12px;
    text-align: center;
}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
h2 {
  text-align: center;
  margin-top: 100px;
}

#appointments-table {
  margin-bottom: 100px;
}
/* Center the links */
a {
		display: block;
		margin: 0 auto;
		width: fit-content;
		text-align: center;
	}

	/* Style the buttons */
	button {
		background-color: #058800;
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		border-radius: 5px;
	}
	</style>
</head>
<body>
<h2>Patient Medical Information</h2>
<?php
	// Open database connection
	$db = new SQLite3('C:\xampp\Database\hospital.db');

	// Retrieve data from Medical_Info table for selected patient
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$results = $db->query("SELECT * FROM Medical_Info WHERE Patient_ID = '$id'");
	} else {
		// Redirect to previous page if patient ID is not set
		header('Location: index.php');
		exit;
	}

	// Create table in HTML
	echo "<table>";
	echo "<tr><th>Patient ID</th><th>Health Issue</th><th>Medication</th><th>Date of Diagnosis</th></tr>";

	// Output data into HTML table
	while ($row = $results->fetchArray()) {
		echo "<tr><td>".$row['Patient_ID']."</td><td>".$row['HealthIssue']."</td><td>".$row['Medication']."</td><td>".$row['DateOfMed']."</td></tr>";
	}

	// Close database connection
	$db->close();

	// Close HTML table
	echo "</table>";

	// Button to view patient medical records
	echo '<a href="edit_medical.php?id='.$id.'"><button>Edit Medical Record</button></a>';
?>

<h2>Patient Appointments</h2>
<?php
	// Open database connection
	$db = new SQLite3('C:\xampp\Database\hospital.db');

	// Retrieve data from Appointments table for selected patient
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$results = $db->query("SELECT * FROM Appointments WHERE Patient_ID = '$id'");
	} else {
		// Redirect to previous page if patient ID is not set
		header('Location: index.php');
		exit;
	}

	// Create table in HTML
	echo "<table>";
	echo "<tr><th>Patient ID</th><th>Type of Appointment</th><th>Date of Appointment</th></tr>";

	// Output data into HTML table
	while ($row = $results->fetchArray()) {
		echo "<tr><td>".$row['Patient_ID']."</td><td>".$row['TypeOfAppoint']."</td><td>".$row['DateOfAppoin']."</td></tr>";
	}

	// Close database connection
	$db->close();

	// Close HTML table
	echo "</table>";

	// Button to view patient appointment history
	echo '<a href="add_appointment.php?id='.$id.'"><button>Add Appointment</button></a>';
?>
</body>
</html>

