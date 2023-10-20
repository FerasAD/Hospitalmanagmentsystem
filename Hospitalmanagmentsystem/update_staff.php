<?php require("admin_nav.php");

?>

<head>
  <title>Update Staff</title>
  <link rel="stylesheet" href="update.css">
</head>

<?php
// Open database connection
$db = new SQLite3('C:\xampp\Database\hospital.db');

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $Staff_ID = $_POST['Staff_ID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $Role = $_POST['Role'];
    $Email = $_POST['Email'];
    $Number = $_POST['Number'];
    $Status = $_POST['Status'];
    

    // Update data for the patient in the database
    $stmt = $db->prepare("UPDATE staff SET Fname=?, Lname=?, Role=?, Email=?, Number=?, Status=? WHERE Staff_ID=?");
    $stmt->bindValue(1, $fname, SQLITE3_TEXT);
    $stmt->bindValue(2, $lname, SQLITE3_TEXT);
    $stmt->bindValue(3, $Role, SQLITE3_TEXT);
    $stmt->bindValue(4, $Email, SQLITE3_TEXT);
    $stmt->bindValue(5, $Number, SQLITE3_TEXT);
    $stmt->bindValue(6, $Status, SQLITE3_TEXT);
    $stmt->bindValue(7, $Staff_ID, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Redirect to the patient list page
    header('Location: view_staff.php');
    exit;
}

// Retrieve the patient data for editing
$Staff_ID = $_GET['id'];
$result = $db->query("SELECT * FROM staff WHERE Staff_ID='$Staff_ID'");
$row = $result->fetchArray();
?>

<!-- Display the patient data in an HTML form for editing -->
<form method="post">
    <input type="hidden" name="Staff_ID" value="<?php echo $row['Staff_ID']; ?>">
    First Name: <input type="text" name="fname" value="<?php echo $row['Fname']; ?>"><br>
    Last Name: <input type="text" name="lname" value="<?php echo $row['Lname']; ?>"><br>
    Role: <input type="text" name="Role" value="<?php echo $row['Role']; ?>"><br>
    Email: <input type="email" name="Email" value="<?php echo $row['Email']; ?>"><br>
    Number: <input type="text" name="Number" value="<?php echo $row['Number']; ?>"><br>
    Status: <input type="text" name="Status" value="<?php echo $row['Status']; ?>"><br>
    <input type="submit" value="Save">
</form>

<?php
// Close database connection
$db->close();
?>
