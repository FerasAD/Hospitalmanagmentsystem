<?php require("Navbar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
    <style>
        body{
    background-color: rgb(233, 233, 233);
}
        table {
    border-collapse: collapse;
    width: 30%;
    margin: auto;
    font-family: Arial, sans-serif; /* change the font family */
}

th, td {
    text-align: left;
    padding: 11px;
    border: 1px solid #ddd;
}

th {
    background-color: #295057;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

h1 {
    font-family: Arial, sans-serif; /* change the font family */
    text-align: center; /* center the heading */
    color: black; /* change the heading color */
    font-weight: bold;
}
    </style>
</head>
<body>
    <?php
    // Get the Patient_ID submitted in the login form
    session_start();
    $Patient_ID = $_SESSION['Patient_ID'];

    // Connect to the SQLite database
    $db = new SQLite3('C:/xampp/Database/hospital.db');

    // Check if the connection was successful
    if (!$db) {
        die('Failed to connect to the database.');
    }

    // Fetch the user's information from the Patients table in the database
    $query = "SELECT * FROM Medical_Info WHERE Patient_ID = '$Patient_ID'";
    $result = $db->query($query);

    if (!$result) {
        die('Error executing query: ' . $db->lastErrorMsg());
    }

    $row = $result->fetchArray(SQLITE3_ASSOC);

    // Display the user's information in a table
    echo '<br><br><br><br><br><br><br><h1>Medical Information </h1>';
    echo '<table>';
    echo '<br><br><tr><th>Current Health problem</th><td>'.$row['HealthIssue'].'</td></tr>';
    echo '<tr><th>Current Medication taken</th><td>'.$row['Medication'].'</td></tr>';
    echo '<tr><th>Date of Medication</th><td>'.$row['DateOfMed'].'</td></tr>';
    echo '</table>';

    // Close the database connection
    $db->close();
    ?>
</body>
</html>


<?php require("footer.php");?>