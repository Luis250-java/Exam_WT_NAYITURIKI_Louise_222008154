<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $volunteer_id = $_POST['volunteer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $interests = $_POST['interests'];

    // Prepare SQL statement
    $sql = "INSERT INTO Volunteers (volunteer_id, first_name, last_name, phone_number, interests)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("issss", $volunteer_id, $first_name, $last_name, $phone_number, $interests);
    if ($stmt->execute()) {
        echo "Volunteer registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>