<?php
// Get the values submitted in the login form
$Patient_ID = $_POST['Patient_ID'];
$Email = $_POST['Email'];
$Postcode = $_POST['Postcode'];
$Password = $_POST['Password'];

// Connect to the SQLite database
$db = new SQLite3('C:/xampp/Database/hospital.db');

// Check if the connection was successful
if (!$db) {
    die('Failed to connect to the database.');
}

// Check if the login credentials are valid
$query = "SELECT * FROM Patients WHERE Patient_ID = '$Patient_ID' AND Email = '$Email' AND Postcode = '$Postcode' AND Password = '$Password'";
$result = $db->query($query);

if (!$result) {
    die('Error executing query: ' . $db->lastErrorMsg());
}

$row = $result->fetchArray(SQLITE3_ASSOC);
if ($row) {
    // Start a new session and store the user's ID
    session_start();
    $_SESSION['Patient_ID'] = $row['Patient_ID'];
    
    // Redirect to page1 if the login credentials are valid
    header('Location: myAccount.php');
} else {
    // Redirect to page2 if the login credentials are invalid
    header('Location: Patient_login.php?error=invalid_credentials');
}

// Close the database connection
$db->close();
?>