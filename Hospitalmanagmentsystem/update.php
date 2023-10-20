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
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $postcode = $_POST['postcode'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $number = $_POST['number'];

    // Update data for the patient in the database
    $stmt = $db->prepare("UPDATE patients SET Fname=?, Lname=?, DOB=?, Postcode=?, Address=?, Email=?, Number=? WHERE Patient_ID=?");
    $stmt->bindValue(1, $fname, SQLITE3_TEXT);
    $stmt->bindValue(2, $lname, SQLITE3_TEXT);
    $stmt->bindValue(3, $dob, SQLITE3_TEXT);
    $stmt->bindValue(4, $postcode, SQLITE3_TEXT);
    $stmt->bindValue(5, $address, SQLITE3_TEXT);
    $stmt->bindValue(6, $email, SQLITE3_TEXT);
    $stmt->bindValue(7, $number, SQLITE3_TEXT);
    $stmt->bindValue(8, $patient_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Redirect to the patient list page
    header('Location: viewPatients.php');
    exit;
}

// Retrieve the patient data for editing
$patient_id = $_GET['id'];
$result = $db->query("SELECT * FROM patients WHERE Patient_ID='$patient_id'");
$row = $result->fetchArray();
?>

<!-- Display the patient data in an HTML form for editing -->
<form method="post">
    <input type="hidden" name="patient_id" value="<?php echo $row['Patient_ID']; ?>">
    First Name: <input type="text" name="fname" value="<?php echo $row['Fname']; ?>"><br>
    Last Name: <input type="text" name="lname" value="<?php echo $row['Lname']; ?>"><br>
    Date of Birth: <input type="text" name="dob" value="<?php echo $row['DOB']; ?>"><br>
    Postcode: <input type="text" name="postcode" value="<?php echo $row['Postcode']; ?>"><br>
    Address: <input type="text" name="address" value="<?php echo $row['Address']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $row['Email']; ?>"><br>
    Phone Number: <input type="text" name="number" value="<?php echo $row['Number']; ?>"><br>
    <input type="submit" value="Save">
</form>

<?php
// Close database connection
$db->close();
?>
