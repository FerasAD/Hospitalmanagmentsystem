<?php require("staffNav.php");

?>

<head>
  <title>Update Patient</title>
  <link rel="stylesheet" href="update.css">
</head>

<?php
// Open database connection
$db = new SQLite3('C:\xampp\Database\hospital.db');

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $patient_id = $_POST['patient_id'];
    $HealthIssue = $_POST['HealthIssue'];
    $Medication = $_POST['Medication'];
    $DateOfMed = $_POST['DateOfMed'];

    // Update data for the medical info in the database
    $stmt = $db->prepare("UPDATE Medical_Info SET HealthIssue=?, Medication=?, DateOfMed=? WHERE Patient_ID=?");
    $stmt->bindValue(1, $HealthIssue, SQLITE3_TEXT);
    $stmt->bindValue(2, $Medication, SQLITE3_TEXT);
    $stmt->bindValue(3, $DateOfMed, SQLITE3_TEXT);
    $stmt->bindValue(4, $patient_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Redirect to the patient medical information page
    header('Location: view.php?id='.$patient_id);
    exit;
}

// Retrieve the patient data for editing
$patient_id = $_GET['id'];
$result = $db->query("SELECT * FROM Medical_Info WHERE Patient_ID='$patient_id'");
$row = $result->fetchArray();
?>

<!-- Display the patient data in an HTML form for editing -->
<form method="post">
    <input type="hidden" name="patient_id" value="<?php echo $row['Patient_ID']; ?>">
    Health Issue: <input type="text" name="HealthIssue" value="<?php echo $row['HealthIssue']; ?>"><br>
    Medication: <input type="text" name="Medication" value="<?php echo $row['Medication']; ?>"><br>
    Date of Medication: <input type="text" name="DateOfMed" value="<?php echo $row['DateOfMed']; ?>"><br>
    <input type="submit" value="Save">
</form>

<?php
// Close database connection
$db->close();
?>