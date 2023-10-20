<?php require("staffNav.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Patients Table</title>
	<style>
            body{
    background-color: rgb(233, 233, 233);
}
		table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 80%;
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
    margin-top: 50px;
    font-size: 28px;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

form {
    text-align: right;
    margin-top: 50px;
    margin-right: 20%;
    width: 80%;
}

input[type=text] {
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
    max-width: 300px;
}

input[type=submit] {
    background-color: #016b66;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

input[type=submit]:hover {
    background-color: #003a37;
}
	</style>
</head>
<body>
	<h2>Patients</h2>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="search">Search:</label>
		<input type="text" name="search" id="search" placeholder="Enter a search term...">
		<input type="submit" value="Search">
	</form>

	<?php
	// Open database connection
	$db = new SQLite3('C:\xampp\Database\hospital.db');

	// Check if search form has been submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$search_term = $_POST['search'];

		// Retrieve data from patients table based on search term
		$results = $db->query("SELECT * FROM patients WHERE Patient_ID LIKE '%$search_term%' OR Fname LIKE '%$search_term%' OR Lname LIKE '%$search_term%' OR DOB LIKE '%$search_term%' OR Postcode LIKE '%$search_term%' OR Address LIKE '%$search_term%' OR Email LIKE '%$search_term%' OR Number LIKE '%$search_term%'");
	} else {
		// Retrieve all data from patients table
		$results = $db->query('SELECT * FROM patients');
	}

	    // Create table in HTML
         echo "<table><tr><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Postcode</th><th>Address</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>";

        // Output data into HTML table
         while ($row = $results->fetchArray()) {
         echo "<tr><td>".$row['Patient_ID']."</td><td>".$row['Fname']."</td><td>".$row['Lname']."</td><td>".$row['DOB']."</td><td>".$row['Postcode']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['Number']."</td><td><a href='update.php?id=".$row['Patient_ID']."'>Update</a> | <a href='view.php?id=".$row['Patient_ID']."'>View</a></td></tr>";
    }

	// Close database connection
	$db->close();

	// Close HTML table
	echo "</table>";
	?>
</body>
</html>
