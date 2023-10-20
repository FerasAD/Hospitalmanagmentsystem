<?php

if (isset($_POST['loginstaff'])) {
    // Get the input values from the form
    $staffID = $_POST['Staff_ID'];
    $password = $_POST['Password'];

    // Connect to the database
    $db = new SQLite3('C:\xampp\Database\hospital.db');

    // Check if the input values match those in the Staff_Login table
    $query = "SELECT * FROM Staff_Login WHERE Staff_ID='$staffID' AND Password='$password'";
    $result = $db->query($query);

    if (!$result->fetchArray()) {
        // Invalid login credentials
        echo "Invalid login credentials!";
        exit();
    }

    // Check if the role is Admin in the Staff table
    $query = "SELECT * FROM Staff WHERE Staff_ID='$staffID' AND Role='Admin' AND Status='Active'";
    $result = $db->query($query);

    if ($result->fetchArray()) {
        // Redirect to AdminPage
        header("Location: view_staff.php");
        exit();
    } else {
        // Check if the status is Active in the Staff table
        $query = "SELECT * FROM Staff WHERE Staff_ID='$staffID' AND Status='Active'";
        $result = $db->query($query);

        if ($result->fetchArray()) {
            // Redirect to StaffPage
            header("Location: viewPatients.php");
            exit();
        } else {
            // Staff status is not Active
            echo "Invalid login credentials.";
            exit();
        }
    }
}

?>