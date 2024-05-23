<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $shelter_id = $_POST['shelter_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];

    // Prepare SQL statement
    $sql = "INSERT INTO Shelters (shelter_id, name, address, contact_info)
            VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("sssi", $shelter_id, $name, $address, $contact_info);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>